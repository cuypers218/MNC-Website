<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['success' => false]); exit; }

$data = json_decode(file_get_contents('php://input'), true);
$email = filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL);
$summary = trim($data['summary'] ?? '');
$weekLabel = trim($data['week_label'] ?? 'This week');

if (!$email) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Invalid email']);
    exit;
}

// ── SEND EMAIL ────────────────────────────────────────────────
$subject = 'Your Week Plan — My Nest Chapter';
$headers  = "From: My Nest Chapter <hello@mynestchapter.com>\r\n";
$headers .= "Reply-To: hello@mynestchapter.com\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

$body  = "Hi,\n\n";
$body .= "Here's your meal plan for the week of " . $weekLabel . ".\n\n";
$body .= "────────────────────────\n\n";
$body .= $summary . "\n\n";
$body .= "────────────────────────\n\n";
$body .= "Come back anytime to update your plan or build your grocery list.\n\n";
$body .= "— My Nest Chapter\n";
$body .= "mynestchapter.com\n";

mail($email, $subject, $body, $headers);

// ── ADD TO REACH ──────────────────────────────────────────────
// Segment: Cooking for One Subscribers
// TODO: Create this segment in Reach and replace the UUID below
$segmentId = '70b39fa6-44c6-47f1-b4ba-edad574e4472';

$reachApiKey = '6MIeMuGCJNf9Fp6NpRLB2xCAW5mmy2gIXQyKxdmS1e9982ba';
$profileId   = 'c35b23af-4088-4bb8-b52d-51f4f7694c73';

$contact = [
    'email'      => $email,
    'profile_id' => $profileId,
    'segments'   => [$segmentId],
];

$ch = curl_init('https://developers.hostinger.com/api/reach/v1/contacts');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => json_encode($contact),
    CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $reachApiKey,
    ],
]);
curl_exec($ch);
curl_close($ch);

echo json_encode(['success' => true]);
