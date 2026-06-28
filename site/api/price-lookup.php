<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://mynestchapter.com');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['error' => 'Method not allowed']); exit; }

require_once __DIR__ . '/../includes/config.php';

$body    = json_decode(file_get_contents('php://input'), true);
$message = isset($body['message']) ? trim($body['message']) : '';

if (!$message) { http_response_code(400); echo json_encode(['error' => 'Message required']); exit; }

$system_prompt = 'You are a resale pricing expert with deep knowledge of current US secondhand market values. The user will describe an item with its condition and details. Return ONLY a valid JSON object — no markdown, no preamble, no explanation. Use this exact structure:
{
  "garage_sale": "$X – $Y",
  "garage_sale_note": "One sentence of practical context.",
  "quick_sell_note": "One sentence: if she needs cash fast, what garage sale price to expect. e.g. Need cash fast? You could realistically get $5–8 at a garage sale.",
  "key_insight": "One sentence summarizing whether this is worth listing online vs. selling at a garage sale.",
  "too_vague": false,
  "platforms": [
    {
      "name": "Poshmark",
      "price_range": "$X – $Y",
      "recommendation": "Best Bet",
      "tip": "One specific, practical sentence for this exact item."
    }
  ]
}
recommendation must be exactly one of: Best Bet, Worth Listing, Skip It.
For Skip It items, set price_range to empty string — do not return $0.
platforms array must always contain all 8 in this exact order: Poshmark, Mercari, eBay, Facebook Marketplace, Depop, ThredUp, OfferUp, Vinted.
If the item description is too vague to price accurately, set too_vague to true and return empty strings for all price fields.
Base all prices on realistic current US resale market values, accounting for brand, item type, condition, and authenticity if provided.';

$payload = json_encode([
    'model'      => 'claude-sonnet-4-6',
    'max_tokens' => 1000,
    'system'     => $system_prompt,
    'messages'   => [['role' => 'user', 'content' => $message]]
]);

$ch = curl_init('https://api.anthropic.com/v1/messages');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $payload,
    CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        'x-api-key: ' . ANTHROPIC_API_KEY,
        'anthropic-version: 2023-06-01'
    ],
    CURLOPT_TIMEOUT => 30
]);

$response  = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if (!$response) { http_response_code(502); echo json_encode(['error' => 'API unreachable']); exit; }

http_response_code($http_code);
echo $response;
