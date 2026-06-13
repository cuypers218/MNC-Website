<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }

$data      = json_decode(file_get_contents('php://input'), true);
$email     = filter_var(trim($data['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$result    = trim($data['result'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email']);
    exit;
}

if (!in_array($result, ['nester', 'busyer', 'wonderer'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid result type']);
    exit;
}

$apiToken = '6MIeMuGCJNf9Fp6NpRLB2xCAW5mmy2gIXQyKxdmS1e9982ba';
$baseUrl  = 'https://developers.hostinger.com/api/reach/v1';

$segments = [
    'nester'   => 'f599dcb4-7ea9-41cf-9481-f1b71c41d631',
    'busyer'   => '2e2083ba-2132-4ace-9298-774c22104f13',
    'wonderer' => '1fcaf85e-1a33-4038-8131-36f276775ae0',
];

// ── Add to Reach ──────────────────────────────────────────
$ch = curl_init($baseUrl . '/contacts');
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => json_encode(['email' => $email]),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => [
        'Authorization: Bearer ' . $apiToken,
        'Content-Type: application/json',
        'Accept: application/json',
    ],
]);
$response    = curl_exec($ch);
$httpCode    = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$contact     = json_decode($response, true);
$contactUuid = $contact['uuid'] ?? null;

if ($contactUuid && isset($segments[$result])) {
    $ch2 = curl_init($baseUrl . '/segments/' . $segments[$result] . '/contacts');
    curl_setopt_array($ch2, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode(['contact_uuid' => $contactUuid]),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . $apiToken,
            'Content-Type: application/json',
            'Accept: application/json',
        ],
    ]);
    curl_exec($ch2);
    curl_close($ch2);
}

// ── Save result to local DB if user account exists ───────
try {
    $db = getDB();
    $stmt = $db->prepare('UPDATE users SET quiz_result = ? WHERE email = ?');
    $stmt->execute([$result, $email]);
} catch (Exception $e) {
    error_log('quiz_result save failed: ' . $e->getMessage());
}

// ── Email content per result ──────────────────────────────
$emails = [
    'nester' => [
        'subject' => "You're The Nester 🪺",
        'body'    => '
<p>The extra plates. The juice boxes. The room that hasn\'t changed since move-in day.</p>
<p>I see you.</p>
<p>I made something for exactly where you are. One page, yours to keep.</p>
<p style="text-align:center;margin:28px 0;">
  <a href="https://mynestchapter.com/downloads/freebie_the_nester.pdf"
     style="background:#E87AAA;color:#ffffff;font-family:\'Montserrat\',Arial,sans-serif;font-weight:800;font-size:14px;text-transform:uppercase;letter-spacing:1px;text-decoration:none;padding:14px 28px;display:inline-block;">
    Get Your Free Guide &rarr;
  </a>
</p>
<p>When you\'re ready for more &mdash; the workbook is where I actually started figuring things out. Every page written for a mom who did this alone.</p>
<p style="text-align:center;margin:28px 0;">
  <a href="https://mynestchapter.com/shop/now-what-workbook"
     style="background:#252535;color:#ffffff;font-family:\'Montserrat\',Arial,sans-serif;font-weight:800;font-size:14px;text-transform:uppercase;letter-spacing:1px;text-decoration:none;padding:14px 28px;display:inline-block;">
    Get the Workbook &rarr;
  </a>
</p>
<p>&mdash; Cece</p>
<p style="color:#ABABAB;font-size:13px;font-style:italic;">P.S. Put the juice boxes back. Nobody\'s coming for them.</p>
',
    ],
    'busyer' => [
        'subject' => "You're The Busy-er 🏃‍♀️",
        'body'    => '
<p>Calendar full. Coffee cold. Completely fine.</p>
<p>I made something for the five minutes between things. One page, yours to keep.</p>
<p style="text-align:center;margin:28px 0;">
  <a href="https://mynestchapter.com/downloads/freebie_the_busyer.pdf"
     style="background:#E87AAA;color:#ffffff;font-family:\'Montserrat\',Arial,sans-serif;font-weight:800;font-size:14px;text-transform:uppercase;letter-spacing:1px;text-decoration:none;padding:14px 28px;display:inline-block;">
    Get Your Free Guide &rarr;
  </a>
</p>
<p>When you\'re ready to look at what\'s underneath all the busy &mdash; the workbook is where I started. Written for a mom who did this alone.</p>
<p style="text-align:center;margin:28px 0;">
  <a href="https://mynestchapter.com/shop/now-what-workbook"
     style="background:#252535;color:#ffffff;font-family:\'Montserrat\',Arial,sans-serif;font-weight:800;font-size:14px;text-transform:uppercase;letter-spacing:1px;text-decoration:none;padding:14px 28px;display:inline-block;">
    Get the Workbook &rarr;
  </a>
</p>
<p>&mdash; Cece</p>
<p style="color:#ABABAB;font-size:13px;font-style:italic;">P.S. The quiet will wait. It\'s very patient.</p>
',
    ],
    'wonderer' => [
        'subject' => "You're The Wonderer 🗺️",
        'body'    => '
<p>Questions you haven\'t let yourself ask in a while. A someday list that\'s been sitting in your head. A thrift shop across town you\'ve never been in.</p>
<p>I made something for right where you are. One page, yours to keep.</p>
<p style="text-align:center;margin:28px 0;">
  <a href="https://mynestchapter.com/downloads/freebie_the_wonderer.pdf"
     style="background:#E87AAA;color:#ffffff;font-family:\'Montserrat\',Arial,sans-serif;font-weight:800;font-size:14px;text-transform:uppercase;letter-spacing:1px;text-decoration:none;padding:14px 28px;display:inline-block;">
    Get Your Free Guide &rarr;
  </a>
</p>
<p>If you want to go further &mdash; the workbook is where I figured out what actually came next. Every page written for a mom who did this alone.</p>
<p style="text-align:center;margin:28px 0;">
  <a href="https://mynestchapter.com/shop/now-what-workbook"
     style="background:#252535;color:#ffffff;font-family:\'Montserrat\',Arial,sans-serif;font-weight:800;font-size:14px;text-transform:uppercase;letter-spacing:1px;text-decoration:none;padding:14px 28px;display:inline-block;">
    Get the Workbook &rarr;
  </a>
</p>
<p>&mdash; Cece</p>
<p style="color:#ABABAB;font-size:13px;font-style:italic;">P.S. Go to the thrift shop.</p>
',
    ],
];

$emailData = $emails[$result];

// ── Send direct email ─────────────────────────────────────
$html = '<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"></head>
<body style="margin:0;padding:0;background:#FAFAFA;font-family:Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#FAFAFA;padding:40px 0;">
    <tr><td align="center">
      <table width="580" cellpadding="0" cellspacing="0" style="background:#ffffff;max-width:580px;width:100%;">
        <tr>
          <td style="background:#E87AAA;padding:20px 40px;">
            <p style="margin:0;font-family:\'Montserrat\',Arial,sans-serif;font-weight:800;font-size:11px;letter-spacing:3px;text-transform:uppercase;color:#ffffff;">MY NEST CHAPTER</p>
          </td>
        </tr>
        <tr>
          <td style="padding:40px;color:#252535;font-size:16px;line-height:1.7;">
            ' . $emailData['body'] . '
          </td>
        </tr>
        <tr>
          <td style="padding:20px 40px;border-top:1px solid #F0ECF8;">
            <p style="margin:0;font-family:Arial,sans-serif;font-size:12px;color:#ABABAB;line-height:1.6;">
              You\'re receiving this because you took the What Kind of Empty Nester Are You? quiz at <a href="https://mynestchapter.com" style="color:#E87AAA;">mynestchapter.com</a>
            </p>
          </td>
        </tr>
      </table>
    </td></tr>
  </table>
</body>
</html>';

$to      = $email;
$subject = $emailData['subject'];
$from    = 'Cece at My Nest Chapter <hello@mynestchapter.com>';
$headers = implode("\r\n", [
    'MIME-Version: 1.0',
    'Content-Type: text/html; charset=UTF-8',
    'From: ' . $from,
    'Reply-To: hello@mynestchapter.com',
    'X-Mailer: PHP/' . phpversion(),
]);

$sent = mail($to, $subject, $html, $headers);

http_response_code(200);
echo json_encode(['success' => true, 'email_sent' => $sent]);
