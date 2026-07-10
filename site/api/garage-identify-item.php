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

// This list must stay in sync with sortPriceCategories in widgets/garage-sale-planner/widget.html
// (Garage Sale Planner — Sort + Price Interactive brief, Section 4). It exists here only so the
// model can choose an exact categoryKey/itemType match — this endpoint never computes a price.
$categoryList = 'clothingShoes: Denim jeans, Designer jeans/denim, Winter coat, Hoodie/sweatshirt, Sweatpants, Leggings, Dress shirt, Women\'s blouse, Kids\' jacket, Sneakers, Boots, Winter hats/gloves, Baseball hats, Designer handbag/purse, Purse (not designer)
furniture: Dining chair, Folding card table, End table, Coffee table, Dresser, Nightstand, Bookshelf, Desk, Floor lamp
kitchenItems: Pyrex baking dish, Cast iron skillet, Set of plates, Mixing bowls, Coffee maker, Toaster, Blender, Measuring cups, Silverware set
homeDecor: Picture frame, Wall mirror, Table lamp, Candlesticks, Throw pillows, Decorative vase, Wall art, Clock
babyKids: Stroller, High chair, Pack-and-play, Car seat, Toy bin (full), Stuffed animals, LEGO set (complete), Board game, Children\'s books
toolsGarage: Hammer, Screwdriver set, Wrench set, Power drill, Circular saw, Extension cord, Tool box, Lawn rake, Shovel
electronicsMedia: Flat-screen TV, DVD player, Game console, Wireless speaker, Headphones, Laptop (older model), Tablet, VHS tapes (lot), Vinyl records (each)
sportsOutdoor: Bicycle, Tennis racket, Golf clubs (set), Camping tent, Sleeping bag, Fishing rod, Ice skates, Dumbbells (pair)
collectiblesExtras: Costume jewelry, Comic books, Baseball cards, Vintage toy car, Antique doll, Postcards, Sewing machine';

$systemPrompt = "You are a garage-sale item classifier. Look at this photo and match it to the closest category and item type from the list below. Return ONLY valid JSON — no markdown, no explanation, no preamble:
{
  \"categoryKey\": \"[one of the 9 category keys below, exactly as written]\",
  \"itemType\": \"[the closest matching item name from that category's list, exactly as written — or empty string if genuinely nothing fits]\",
  \"brand\": [true if a recognized brand name, designer logo, or manufacturer label is visibly readable in the photo, otherwise false]
}

Categories and item types (format is categoryKey: item, item, item...):
$categoryList

Never estimate or return a price — that is not your job here. If the photo is unclear or the item doesn't match anything well, set itemType to an empty string rather than guessing.";

$payload = json_encode([
    'model'      => 'claude-sonnet-4-6',
    'max_tokens' => 300,
    'system'     => $systemPrompt,
    'messages'   => [[
        'role'    => 'user',
        'content' => [
            ['type' => 'image', 'source' => ['type' => 'base64', 'media_type' => $mimeType, 'data' => $imageData]],
            ['type' => 'text',  'text'   => 'Identify this item.']
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
        'x-api-key: ' . ANTHROPIC_API_KEY_SORT_PRICE,
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
