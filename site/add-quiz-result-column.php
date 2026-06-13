<?php
require_once __DIR__ . '/includes/db.php';
$db = getDB();
$db->exec("ALTER TABLE users ADD COLUMN IF NOT EXISTS quiz_result VARCHAR(20) DEFAULT NULL");
echo 'Done — quiz_result column added to users table.';
?>
