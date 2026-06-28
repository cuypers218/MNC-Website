<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://mynestchapter.com');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['error' => 'Method not allowed']); exit; }

require_once __DIR__ . '/../includes/config.php';

$file = $_FILES['photo'] ?? null;
if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode(['error' => 'No file received']);
    exit;
}

$allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp', 'image/gif'];
$mimeType = mime_content_type($file['tmp_name']);
if (!in_array($mimeType, $allowedTypes)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid file type']);
    exit;
}

if ($file['size'] > 5 * 1024 * 1024) {
    http_response_code(400);
    echo json_encode(['error' => 'File too large — maximum 5MB']);
    exit;
}

$imageData = base64_encode(file_get_contents($file['tmp_name']));

$systemPrompt = 'You are an item identification assistant. Look at this photo and identify the item being sold. Return ONLY valid JSON — no markdown, no explanation, no preamble:
{
  "category": "[one of: Womens Clothing, Mens Clothing, Kids Teens, Shoes Accessories, Electronics, Furniture, Kitchen Home, Tools Sports, Other]",
  "brand": "[brand name visible on item or tag, or empty string]",
  "item_description": "[brief description of item type and style, e.g. leather crossbody bag or zip-up hoodie]",
  "color": "[primary color, or empty string]",
  "size": "[size if visible on item or tag, otherwise empty string]",
  "model_number": "[model number if visible, otherwise empty string]"
}';

$payload = json_encode([
    'model'      => 'claude-sonnet-4-6',
    'max_tokens' => 500,
    'system'     => $systemPrompt,
    'messages'   => [[
        'role'    => 'user',
        'content' => [
            ['type' => 'image', 'source' => ['type' => 'base64', 'media_type' => $mimeType, 'data' => $imageData]],
            ['type' => 'text',  'text'   => 'Please identify this item.']
        ]
    ]]
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

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if (!$response) { http_response_code(502); echo json_encode(['error' => 'API unreachable']); exit; }

http_response_code($httpCode);
echo $response;
