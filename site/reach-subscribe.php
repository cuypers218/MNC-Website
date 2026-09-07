<?php
/**
 * Generic Hostinger Reach signup endpoint.
 * Called by: homepage newsletter ("COUNT ME IN"), the Freebies page's
 * 6pm Cheat Sheet gate, and the 6pm Experience widget's email gate.
 * All three were pointing here before this file existed — see CLAUDE.md
 * 2026-09-06 entry.
 */
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/email-template.php';

$data      = json_decode(file_get_contents('php://input'), true);
$email     = filter_var(trim($data['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$firstName = trim($data['first_name'] ?? '');
$segment   = trim($data['segment'] ?? '');
$freebie   = trim($data['freebie'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email']);
    exit;
}

// ── Save locally regardless of what Reach does ─────────────
try {
    $db = getDB();
    $stmt = $db->prepare('INSERT IGNORE INTO email_subscribers (email, first_name, source) VALUES (?, ?, ?)');
    $stmt->execute([$email, $firstName, $freebie !== '' ? $freebie : 'reach-subscribe']);
} catch (Exception $e) {
    error_log('reach-subscribe local save failed: ' . $e->getMessage());
}

// ── Add to Reach ────────────────────────────────────────────
$apiToken = REACH_API_KEY;
$baseUrl  = 'https://developers.hostinger.com/api/reach/v1';

$ch = curl_init($baseUrl . '/contacts');
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => json_encode(['email' => $email]),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiToken, 'Content-Type: application/json', 'Accept: application/json'],
]);
$response = curl_exec($ch);
curl_close($ch);

$contact     = json_decode($response, true);
$contactUuid = $contact['uuid'] ?? null;

if ($contactUuid && $segment !== '') {
    $ch2 = curl_init($baseUrl . '/segments/' . $segment . '/contacts');
    curl_setopt_array($ch2, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode(['contact_uuid' => $contactUuid]),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiToken, 'Content-Type: application/json', 'Accept: application/json'],
    ]);
    curl_exec($ch2);
    curl_close($ch2);
}

// ── Deliver the freebie itself, if this call is for one ────
if ($freebie === '6pm-cheat-sheet') {
    $pdfUrl = 'https://drive.google.com/uc?export=download&id=1dVTgwgBjwsg0jz9HCcGkPgif6edNhyQR';
    $body = '<p>Here it is — the 6pm Cheat Sheet, yours to keep.</p>'
        . mnc_email_button($pdfUrl, 'Get Your Free Guide')
        . '<p>When you\'re ready for more, I\'m here.</p>'
        . '<p>&mdash; Cece</p>';
    mnc_send_email($email, 'Your 6pm Cheat Sheet', $body,
        'You\'re receiving this because you requested the 6pm Cheat Sheet at <a href="https://mynestchapter.com" style="color:#6B655C;">mynestchapter.com</a>');
}

http_response_code(200);
echo json_encode(['success' => true]);
