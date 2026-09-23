<?php
/**
 * Kitchen Rescue — Cooking for One widget
 * Reads up to 3 photos (fridge/freezer/pantry) + a confirmed pantry-staples list,
 * and returns up to 2 real suggestions built only from what was actually detected.
 *
 * Two-phase flow, both calls to the same Anthropic key already used by
 * photo-identify.php / price-lookup.php elsewhere on this site:
 *   Phase A — vision call: identify real items in the photos, try to build up
 *             to 2 direct suggestions from (detected items + confirmed staples).
 *   Phase B — for any slot Phase A couldn't fill on its own, a web-search call
 *             (Claude's web_search tool, restricted to trusted recipe sites)
 *             finds one real recipe that only needs what's on that same list.
 * Nothing is ever suggested that needs an ingredient outside that combined list.
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://mynestchapter.com');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['error' => 'Method not allowed']); exit; }

// This orchestrates up to 3 Anthropic calls (1 vision + up to 2 search) in one request.
set_time_limit(120);

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Please log in to use Kitchen Rescue.']);
    exit;
}

$product = getProductBySlug('cooking-for-one');
if (!$product || ($product['price'] > 0 && !userOwnsPurchase($_SESSION['user_id'], $product['id']))) {
    http_response_code(403);
    echo json_encode(['error' => 'Kitchen Rescue is part of Cooking for One.']);
    exit;
}

$userId = $_SESSION['user_id'];
$db = getDB();

// ── Daily usage cap (each real scan costs real API money) ─────────────────
const KITCHEN_RESCUE_DAILY_CAP = 5;

$db->exec("CREATE TABLE IF NOT EXISTS kitchen_rescue_scans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (user_id, created_at)
)");

$stmt = $db->prepare('SELECT COUNT(*) FROM kitchen_rescue_scans WHERE user_id = ? AND created_at >= CURDATE()');
$stmt->execute([$userId]);
$scansUsedBeforeThis = (int)$stmt->fetchColumn();
if ($scansUsedBeforeThis >= KITCHEN_RESCUE_DAILY_CAP) {
    http_response_code(429);
    echo json_encode(['error' => "You've used your " . KITCHEN_RESCUE_DAILY_CAP . " kitchen scans for today — come back tomorrow."]);
    exit;
}

// ── Validate photos (1–3, matching photo-identify.php's own rules) ────────
$allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/gif'];
$images = [];
foreach (['photo1', 'photo2', 'photo3'] as $key) {
    if (empty($_FILES[$key]) || $_FILES[$key]['error'] === UPLOAD_ERR_NO_FILE) continue;
    $file = $_FILES[$key];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        http_response_code(400);
        echo json_encode(['error' => 'One of your photos didn\'t upload correctly — please try again.']);
        exit;
    }
    $mimeType = mime_content_type($file['tmp_name']);
    if (!in_array($mimeType, $allowedTypes)) {
        http_response_code(400);
        echo json_encode(['error' => 'Please use JPG, PNG, WEBP, or GIF photos.']);
        exit;
    }
    if ($file['size'] > 5 * 1024 * 1024) {
        http_response_code(400);
        echo json_encode(['error' => 'Each photo needs to be under 5MB.']);
        exit;
    }
    $images[] = ['media_type' => $mimeType, 'data' => base64_encode(file_get_contents($file['tmp_name']))];
}
if (count($images) === 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Add at least one photo of your fridge, freezer, or pantry.']);
    exit;
}

// ── Staples (her confirmed always-have list) ───────────────────────────────
$staplesRaw = json_decode($_POST['staples'] ?? '[]', true);
$staples = [];
if (is_array($staplesRaw)) {
    foreach (array_slice($staplesRaw, 0, 40) as $s) {
        $s = trim(strip_tags((string)$s));
        if ($s !== '') $staples[] = mb_substr($s, 0, 60);
    }
}

// ── Anthropic call helper ──────────────────────────────────────────────────
function callAnthropic($payload, $timeout = 45) {
    $ch = curl_init('https://api.anthropic.com/v1/messages');
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode($payload),
        CURLOPT_HTTPHEADER     => [
            'Content-Type: application/json',
            'x-api-key: ' . ANTHROPIC_API_KEY,
            'anthropic-version: 2023-06-01'
        ],
        CURLOPT_TIMEOUT => $timeout
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if (!$response) return [null, 0];
    $decoded = json_decode($response, true);
    return [$decoded, $httpCode];
}

// Finds the LAST text content block (Claude's final answer, after any tool use)
// and parses it as JSON, tolerating stray markdown fences.
function extractFinalJson($content) {
    if (!is_array($content)) return null;
    $lastText = null;
    foreach ($content as $block) {
        if (($block['type'] ?? '') === 'text') $lastText = $block['text'];
    }
    if ($lastText === null) return null;
    $lastText = trim(preg_replace('/^```(?:json)?|```$/m', '', $lastText));
    $parsed = json_decode($lastText, true);
    return is_array($parsed) ? $parsed : null;
}

// ── Phase A — vision + direct-suggestion attempt ───────────────────────────
$staplesText = count($staples) ? implode(', ', $staples) : '(none confirmed)';

$phaseASystem = 'You are the kitchen assistant behind My Nest Chapter\'s "Kitchen Rescue" tool. Someone is showing you 1-3 photos of their fridge, freezer, and/or pantry because they need something to cook RIGHT NOW from what they actually have — no shopping trip.

Step 1 — Look carefully at every photo. List every distinct food or drink item you can actually see. Never include anything you cannot see, and never guess at common kitchen items that are not visible.

Step 2 — This person has also confirmed they always keep these staples on hand: ' . $staplesText . '. Combine the items you detected with this staples list — this combined list is the ONLY set of ingredients any suggestion below may use.

Step 3 — Try to build up to 2 real, sensible meal or snack suggestions using ONLY items from that combined list (a suggestion may use a subset, not everything). Give each a realistic title, exactly which items it uses, simple step-by-step instructions, and a total time estimate in minutes.

Step 4 — If you cannot confidently build something sensible for a slot from only what is available, do not invent something shaky. Mark that slot as needing a real-recipe search instead, with the exact ingredient list to search with.

Return ONLY valid JSON — no markdown, no explanation, no preamble. Use this exact structure:
{
  "detected_items": ["item one", "item two"],
  "suggestions": [
    {"status": "built", "title": "...", "time": 15, "uses": ["..."], "instructions": ["Step one.", "Step two."]},
    {"status": "needs_search", "search_ingredients": ["..."]}
  ]
}
suggestions should contain exactly 2 entries unless fewer than 2 sensible options (built or needs_search) exist at all — never pad with a weak or repeated entry just to reach 2. If truly nothing usable is visible, return an empty suggestions array.';

$contentBlocks = [];
foreach ($images as $img) {
    $contentBlocks[] = ['type' => 'image', 'source' => ['type' => 'base64', 'media_type' => $img['media_type'], 'data' => $img['data']]];
}
$contentBlocks[] = ['type' => 'text', 'text' => 'Here is what\'s in my kitchen right now.'];

[$phaseAResp, $phaseACode] = callAnthropic([
    'model'      => 'claude-sonnet-5',
    'max_tokens' => 1500,
    'system'     => $phaseASystem,
    'messages'   => [['role' => 'user', 'content' => $contentBlocks]]
]);

if (!$phaseAResp || $phaseACode >= 400) {
    http_response_code(502);
    echo json_encode(['error' => 'Could not reach the kitchen assistant — please try again.']);
    exit;
}

$phaseAData = extractFinalJson($phaseAResp['content'] ?? null);
if (!$phaseAData) {
    http_response_code(502);
    echo json_encode(['error' => 'Had trouble reading your photos — please try again with clearer shots.']);
    exit;
}

$detectedItems = array_values(array_filter((array)($phaseAData['detected_items'] ?? [])));
$rawSuggestions = (array)($phaseAData['suggestions'] ?? []);
$combinedList = array_values(array_unique(array_merge($detectedItems, $staples)));

$finalSuggestions = [];

// ── Phase B — real-recipe search fallback for any "needs_search" slot ─────
$phaseBSystem = 'You are the kitchen assistant behind My Nest Chapter\'s "Kitchen Rescue" tool. Search the web for ONE real, existing recipe that uses ONLY these ingredients (plus basic staples like salt, pepper, cooking oil, and water, even if not explicitly listed): %s. It must be a genuine recipe from a real source — never invent one. If you cannot find a real recipe that only needs these ingredients, say so honestly rather than forcing a loose match.

After searching, return ONLY valid JSON as your final message — no markdown, no explanation. Use this exact structure:
{"found": true, "title": "...", "source_name": "...", "source_url": "...", "time": 20, "uses": ["..."], "instructions": ["Step one.", "Step two."]}
or, if nothing real fits:
{"found": false}';

foreach ($rawSuggestions as $s) {
    if (count($finalSuggestions) >= 2) break;

    if (($s['status'] ?? '') === 'built' && !empty($s['title'])) {
        $finalSuggestions[] = [
            'title'        => (string)$s['title'],
            'source'       => 'built',
            'source_name'  => null,
            'source_url'   => null,
            'time'         => (int)($s['time'] ?? 20),
            'uses'         => array_values((array)($s['uses'] ?? [])),
            'instructions' => array_values((array)($s['instructions'] ?? [])),
        ];
        continue;
    }

    if (($s['status'] ?? '') === 'needs_search') {
        $searchIngredients = array_values((array)($s['search_ingredients'] ?? $combinedList));
        if (empty($searchIngredients)) continue;

        [$phaseBResp, $phaseBCode] = callAnthropic([
            'model'      => 'claude-sonnet-5',
            'max_tokens' => 1500,
            'system'     => sprintf($phaseBSystem, implode(', ', $searchIngredients)),
            'messages'   => [['role' => 'user', 'content' => 'Find a real recipe for me.']],
            'tools'      => [[
                'type'            => 'web_search_20250305',
                'name'            => 'web_search',
                'max_uses'        => 2,
                'allowed_domains' => [
                    'allrecipes.com', 'foodnetwork.com', 'bettycrocker.com', 'simplyrecipes.com',
                    'delish.com', 'tasteofhome.com', 'seriouseats.com', 'budgetbytes.com'
                ]
            ]]
        ], 60);

        if (!$phaseBResp || $phaseBCode >= 400) continue;
        $found = extractFinalJson($phaseBResp['content'] ?? null);
        if (!$found || empty($found['found']) || empty($found['title'])) continue;

        $finalSuggestions[] = [
            'title'        => (string)$found['title'],
            'source'       => 'web',
            'source_name'  => $found['source_name'] ?? null,
            'source_url'   => $found['source_url'] ?? null,
            'time'         => (int)($found['time'] ?? 25),
            'uses'         => array_values((array)($found['uses'] ?? [])),
            'instructions' => array_values((array)($found['instructions'] ?? [])),
        ];
    }
}

// Log the scan for the daily cap (only after a genuine attempt was made)
$stmt = $db->prepare('INSERT INTO kitchen_rescue_scans (user_id) VALUES (?)');
$stmt->execute([$userId]);

http_response_code(200);
echo json_encode([
    'success'         => true,
    'detected_items'  => $detectedItems,
    'suggestions'     => $finalSuggestions,
    'scans_remaining' => max(0, KITCHEN_RESCUE_DAILY_CAP - ($scansUsedBeforeThis + 1)),
]);
