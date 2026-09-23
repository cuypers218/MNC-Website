<?php
// ONE-TIME — diagnose + fix character encoding on blog_comments' new guest
// columns (added by the now-deleted _migrate-guest-comments.php without an
// explicit CHARACTER SET, so they may have inherited a non-utf8mb4 default),
// and clean up the test comment used to verify the new comment form.
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

$stmt = $db->prepare("SELECT COLUMN_NAME, CHARACTER_SET_NAME, COLLATION_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'blog_comments' AND COLUMN_NAME IN ('body','guest_name','guest_email')");
$stmt->execute();
echo "Current column charsets:\n";
foreach ($stmt->fetchAll() as $row) {
    echo "  {$row['COLUMN_NAME']}: {$row['CHARACTER_SET_NAME']} / {$row['COLLATION_NAME']}\n";
}

echo "\nFixing guest_name / guest_email to utf8mb4...\n";
$db->exec("ALTER TABLE blog_comments MODIFY guest_name VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL");
$db->exec("ALTER TABLE blog_comments MODIFY guest_email VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL");
echo "Done.\n";

echo "\nDeleting the QA test comment...\n";
$del = $db->prepare("DELETE FROM blog_comments WHERE guest_name LIKE 'Claude QA Test%'");
$del->execute();
echo "Deleted {$del->rowCount()} row(s).\n";
