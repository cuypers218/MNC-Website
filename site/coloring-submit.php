<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }

$data      = json_decode(file_get_contents('php://input'), true);
$email     = filter_var(trim($data['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$firstName = trim($data['first_name'] ?? '');
$mood      = trim($data['mood'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email']);
    exit;
}

$apiToken = '6MIeMuGCJNf9Fp6NpRLB2xCAW5mmy2gIXQyKxdmS1e9982ba';
$baseUrl  = 'https://developers.hostinger.com/api/reach/v1';
$segment  = 'cfc1a709-13cf-4071-a970-a5fc8776a380';

$moodFiles = [
    'distraction' => 'https://mynestchapter.com/downloads/mnc-coloring-distraction.pdf',
    'unwind'      => 'https://mynestchapter.com/downloads/mnc-coloring-unwind.pdf',
    'coloring'    => 'https://mynestchapter.com/downloads/mnc-coloring-coloring.pdf',
];
$downloadUrl = $moodFiles[$mood] ?? 'https://mynestchapter.com/downloads/mnc-coloring-coloring.pdf';

// ── Add to Reach ──────────────────────────────────────────
$payload = ['email' => $email];
if ($firstName) $payload['name'] = $firstName;

$ch = curl_init($baseUrl . '/contacts');
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => json_encode($payload),
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

// ── Send email ────────────────────────────────────────────
$greeting = $firstName ? "Hi $firstName," : "Hi,";

$html = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head>
<body style="margin:0;padding:0;background:#FAFAFA;font-family:Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#FAFAFA;padding:40px 0;">
    <tr><td align="center">
      <table width="580" cellpadding="0" cellspacing="0" style="background:#252535;max-width:580px;width:100%;">
        <tr><td style="background:#252535;padding:24px 40px;">
          <p style="margin:0;font-family:Arial,sans-serif;font-weight:800;font-size:11px;letter-spacing:3px;text-transform:uppercase;color:#8BA7D4;">MY NEST CHAPTER</p>
        </td></tr>
        <tr><td style="padding:40px;color:#FFF8EE;font-size:16px;line-height:1.7;">
          <p>' . $greeting . '</p>
          <p style="margin-top:16px;">Your coloring page is here.</p>
          <p style="margin-top:16px;">A few quiet minutes, just for you.</p>
          <p style="text-align:center;margin:32px 0;">
            <a href="' . $downloadUrl . '"
               style="background:#E87AAA;color:#ffffff;font-family:Arial,sans-serif;font-weight:800;font-size:14px;text-transform:uppercase;letter-spacing:1px;text-decoration:none;padding:16px 32px;border-radius:50px;display:inline-block;">
              Download Your Coloring Page &rarr;
            </a>
          </p>
          <p style="color:#C4B0E8;font-size:14px;">— Cece</p>
          <p style="color:#8BA7D4;font-size:13px;margin-top:8px;font-style:italic;">P.S. If the quiet house gets loud again, come back and pick a different mood anytime.</p>
        </td></tr>
        <tr><td style="padding:20px 40px;border-top:1px solid #3A3A4A;">
          <p style="margin:0;font-family:Arial,sans-serif;font-size:12px;color:#8BA7D4;line-height:1.6;">
            You\'re receiving this because you picked up a free coloring page at <a href="https://mynestchapter.com" style="color:#8BA7D4;">mynestchapter.com</a>
          </p>
        </td></tr>
      </table>
    </td></tr>
  </table>
</body></html>';

mail(
    $email,
    'Your coloring page is here 🎨',
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
