<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }

require_once __DIR__ . '/includes/config.php';

$data  = json_decode(file_get_contents('php://input'), true);
$email = filter_var(trim($data['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$items = $data['items'] ?? [];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email']);
    exit;
}

$items = array_filter(array_map('strip_tags', $items));

$apiToken = REACH_API_KEY;
$baseUrl  = 'https://developers.hostinger.com/api/reach/v1';
$segment  = '985fc203-668e-44d0-8805-5ce8989b7972';

// ── Add to Reach ──────────────────────────────────────────
$ch = curl_init($baseUrl . '/contacts');
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => json_encode(['email' => $email]),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiToken, 'Content-Type: application/json', 'Accept: application/json'],
]);
$response    = curl_exec($ch);
$httpCode    = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$contact     = json_decode($response, true);
$contactUuid = $contact['uuid'] ?? null;

if ($contactUuid) {
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

// ── Build list HTML ───────────────────────────────────────
$listRows = '';
foreach (array_values($items) as $i => $item) {
    $listRows .= '<tr><td style="padding:10px 0;border-bottom:1px solid #D9C7AC;font-family:Arial,sans-serif;font-size:15px;color:#2B1F18;line-height:1.5;">'
        . '<span style="font-family:Georgia,serif;color:#A35E33;font-weight:bold;margin-right:12px;">' . ($i + 1) . '.</span>'
        . htmlspecialchars($item)
        . '</td></tr>';
}

$count = count($items);
$plural = $count === 1 ? 'someday' : 'somedays';

// ── Send email ────────────────────────────────────────────
$html = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head>
<body style="margin:0;padding:0;background:#FAFAFA;font-family:Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#FAFAFA;padding:40px 0;">
    <tr><td align="center">
      <table width="580" cellpadding="0" cellspacing="0" style="background:#FFFFFF;max-width:580px;width:100%;border:1px solid #D9C7AC;">
        <tr><td style="background:#0A2F3A;padding:24px 40px;">
          <p style="margin:0;font-family:Arial,sans-serif;font-weight:800;font-size:11px;letter-spacing:3px;text-transform:uppercase;color:#F6F1E6;">MY NEST CHAPTER</p>
        </td></tr>
        <tr><td style="padding:40px;">
          <p style="font-family:Georgia,serif;font-size:22px;font-weight:bold;color:#2B1F18;margin:0 0 8px;">Your Someday List</p>
          <p style="font-family:Arial,sans-serif;font-size:14px;color:#6B655C;margin:0 0 32px;">' . $count . ' ' . $plural . ' — written down and real now.</p>
          <table width="100%" cellpadding="0" cellspacing="0">
            ' . $listRows . '
          </table>
          <p style="font-family:Arial,sans-serif;font-size:15px;color:#2B1F18;line-height:1.7;margin:32px 0 8px;">Now that they\'re written down — the Someday List Companion is what you use to actually look at them. No pressure to do everything. Just a way to figure out where to start.</p>
          <p style="margin:0 0 32px;">
            <a href="https://mynestchapter.com/shop/someday-list-builder"
               style="font-family:Arial,sans-serif;font-weight:800;font-size:14px;text-transform:uppercase;letter-spacing:1px;color:#A35E33;text-decoration:none;border-bottom:2px solid #A35E33;padding-bottom:2px;">
              Get the Companion &rarr;
            </a>
          </p>
          <p style="font-family:Arial,sans-serif;font-size:14px;color:#6B655C;margin:0;">— Cece</p>
        </td></tr>
        <tr><td style="padding:20px 40px;border-top:1px solid #D9C7AC;">
          <p style="margin:0;font-family:Arial,sans-serif;font-size:12px;color:#6B655C;line-height:1.6;">
            You\'re receiving this because you built a Someday List at <a href="https://mynestchapter.com" style="color:#6B655C;">mynestchapter.com</a>
          </p>
        </td></tr>
      </table>
    </td></tr>
  </table>
</body></html>';

mail(
    $email,
    'Your Someday List — ' . $count . ' ' . $plural . ' written down',
    $html,
    implode("\r\n", [
        'MIME-Version: 1.0',
        'Content-Type: text/html; charset=UTF-8',
        'From: Cece at My Nest Chapter <hello@mynestchapter.com>',
        'Reply-To: hello@mynestchapter.com',
    ])
);

http_response_code(200);
echo json_encode(['success' => true]);
