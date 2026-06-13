<?php
require_once __DIR__ . '/includes/db.php';
$db = getDB();
$stmt = $db->query("SELECT id, email, first_name FROM users ORDER BY id");
$rows = $stmt->fetchAll();
foreach ($rows as $r) {
    echo $r['id'] . ' | ' . $r['email'] . ' | ' . $r['first_name'] . '<br>';
}
?>
