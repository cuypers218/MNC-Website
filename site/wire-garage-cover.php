<?php
require_once __DIR__ . '/includes/db.php';
$db = getDB();
$stmt = $db->prepare("UPDATE products SET image_path = '/assets/images/garage-sale-planner-cover.png' WHERE slug = 'garage-sale-planner'");
$stmt->execute();
echo $stmt->rowCount() ? 'Done — cover image wired to Garage Sale Planner.' : 'No rows updated — check slug.';
?>
