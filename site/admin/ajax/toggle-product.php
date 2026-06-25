<?php
require_once __DIR__ . '/../auth.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$body    = json_decode(file_get_contents('php://input'), true);
$id      = (int)($body['id'] ?? 0);
$current = $body['current'] ?? '';

if (!$id) {
    echo json_encode(['error' => 'Invalid product ID']);
    exit;
}

$newStatus = ($current === 'active') ? 'draft' : 'active';

try {
    $db   = getDB();
    $stmt = $db->prepare("UPDATE products SET status = ? WHERE id = ?");
    $stmt->execute([$newStatus, $id]);
    echo json_encode(['success' => true, 'status' => $newStatus]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
exit;
