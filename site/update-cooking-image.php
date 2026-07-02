<?php
require_once __DIR__ . '/admin/auth.php';
$db = getDB();
$stmt = $db->prepare("UPDATE products SET image_path = '/assets/images/cooking-for-one-cover.png' WHERE slug = 'cooking-for-one'");
$stmt->execute();
echo $stmt->rowCount() ? 'Done — image wired to Cooking for One product.' : 'No rows updated — check slug.';
?>
