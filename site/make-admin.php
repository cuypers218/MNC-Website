<?php
require_once __DIR__ . '/includes/db.php';
$db = getDB();

// Add is_admin column if it doesn't exist
$db->exec("ALTER TABLE users ADD COLUMN IF NOT EXISTS is_admin TINYINT(1) NOT NULL DEFAULT 0");

// Grant admin to both of Cece's accounts
$db->exec("UPDATE users SET is_admin = 1 WHERE id IN (1, 2)");

$stmt = $db->query("SELECT id, email, is_admin FROM users WHERE id IN (1, 2)");
foreach ($stmt->fetchAll() as $r) {
    echo 'ID ' . $r['id'] . ' | ' . $r['email'] . ' | is_admin=' . $r['is_admin'] . '<br>';
}
?>
