<?php
/**
 * My Nest Chapter — Exclusive Content Download
 * Verifies member is logged in and item is unlocked before serving PDF.
 */
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

requireLogin();

$user   = getCurrentUser();
$itemId = (int)($_GET['id'] ?? 0);

if (!$itemId) {
    header('Location: /dashboard');
    exit;
}

$db   = getDB();
$stmt = $db->prepare('SELECT * FROM exclusive_content_queue WHERE id = ?');
$stmt->execute([$itemId]);
$item = $stmt->fetch();

if (!$item) {
    header('Location: /dashboard');
    exit;
}

// Verify unlock: days as member must meet or exceed the unlock offset
$daysStmt = $db->prepare('SELECT DATEDIFF(NOW(), created_at) FROM users WHERE id = ?');
$daysStmt->execute([$user['id']]);
$daysAsMember = (int)$daysStmt->fetchColumn();

if ($daysAsMember < $item['unlock_offset_days']) {
    header('Location: /dashboard');
    exit;
}

if (empty($item['file_path'])) {
    header('Location: /dashboard?exclusive=coming-soon');
    exit;
}

$filePath = __DIR__ . '/downloads/' . $item['file_path'];

if (!file_exists($filePath)) {
    // PDF not uploaded yet — redirect gracefully
    header('Location: /dashboard?exclusive=coming-soon');
    exit;
}

$fileName = slugify($item['title']) . '.pdf';

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Content-Length: ' . filesize($filePath));
header('Cache-Control: no-cache, no-store, must-revalidate');

readfile($filePath);
exit;
