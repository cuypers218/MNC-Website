<?php
// ONE-TIME migration — allow blog comments without a Hub/member account.
// Gated behind a secret token, and deleted from the repo right after it runs.
// Do not leave this file live — see CLAUDE.md's security history for why
// leftover one-time scripts are a real risk (check-users.php, gen-hash.php, etc.).

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$SECRET = '3e11010b60a2b2017ca3f19f6d5c54f2e1a1238beb1fa9fb';
if (($_GET['token'] ?? '') !== $SECRET) {
    http_response_code(404);
    exit;
}

header('Content-Type: text/plain');
$db = getDB();

function columnExists(PDO $db, string $table, string $column): bool {
    $stmt = $db->prepare("SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND COLUMN_NAME = ?");
    $stmt->execute([$table, $column]);
    return (int) $stmt->fetchColumn() > 0;
}

echo "Checking blog_comments schema...\n";

if (!columnExists($db, 'blog_comments', 'guest_name')) {
    $db->exec("ALTER TABLE blog_comments ADD COLUMN guest_name VARCHAR(100) NULL AFTER user_id");
    echo "Added guest_name column.\n";
} else {
    echo "guest_name column already exists.\n";
}

if (!columnExists($db, 'blog_comments', 'guest_email')) {
    $db->exec("ALTER TABLE blog_comments ADD COLUMN guest_email VARCHAR(255) NULL AFTER guest_name");
    echo "Added guest_email column.\n";
} else {
    echo "guest_email column already exists.\n";
}

$stmt = $db->prepare("SELECT IS_NULLABLE FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'blog_comments' AND COLUMN_NAME = 'user_id'");
$stmt->execute();
$nullable = $stmt->fetchColumn();

if ($nullable === 'NO') {
    $db->exec("ALTER TABLE blog_comments MODIFY user_id INT NULL");
    echo "Made user_id nullable.\n";
} else {
    echo "user_id already nullable ($nullable).\n";
}

echo "Done.\n";
