<?php
// ONE-TIME — isolate whether the em-dash corruption seen in the guest-comment
// QA test happens at storage time or read/display time. Inserts a known-good
// UTF-8 string directly via SQL (bypassing the PHP form path entirely) and
// hex-dumps it back raw, so a PDO/PHP-side issue can't hide behind htmlspecialchars.
// Gated behind a secret token, deleted from the repo right after it runs.

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$SECRET = 'a2ef189b2169d9c0d21097423d65ff31336ac3c1a651a17d';
if (($_GET['token'] ?? '') !== $SECRET) {
    http_response_code(404);
    exit;
}

header('Content-Type: text/plain');
$db = getDB();

$test = "Test \xe2\x80\x94 dash"; // raw UTF-8 bytes for "Test — dash"
echo "Bytes we're sending (hex): " . bin2hex($test) . "\n\n";

$stmt = $db->prepare("SELECT id FROM blog_posts LIMIT 1");
$stmt->execute();
$postId = $stmt->fetchColumn();

$ins = $db->prepare("INSERT INTO blog_comments (post_id, guest_name, body) VALUES (?, ?, 'charset probe, safe to delete')");
$ins->execute([$postId, $test]);
$id = $db->lastInsertId();

$sel = $db->prepare("SELECT guest_name, HEX(guest_name) AS hex FROM blog_comments WHERE id = ?");
$sel->execute([$id]);
$row = $sel->fetch();

echo "Read back from DB:\n";
echo "  Raw string   : {$row['guest_name']}\n";
echo "  Bytes (hex)  : " . strtolower($row['hex']) . "\n";
echo "  Match original: " . ($row['hex'] === strtoupper(bin2hex($test)) ? 'YES — storage is fine' : 'NO — corrupted in storage') . "\n";

$db->prepare("DELETE FROM blog_comments WHERE id = ?")->execute([$id]);
echo "\nCleaned up probe row.\n";
