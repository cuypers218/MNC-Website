<?php
require_once __DIR__ . '/includes/db.php';
$db = getDB();

$stmt = $db->prepare("
    INSERT INTO products (title, slug, category, price, status, file_path, image_path, short_description, description, sort_order)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->execute([
    'Someday Companion',
    'someday-companion',
    'companion',
    7.99,
    'active',
    '/downloads/someday-companion.pdf',
    '/assets/images/someday-companion-cover.png',
    'A guided workbook to move your Someday List from wishful thinking to actually happening — one small, honest step at a time.',
    "You wrote the list. Now what?\n\nThe Someday Companion is a guided workbook that helps you take the things you wrote down in the Someday List Builder and actually look at them — with honesty, with grace, and without pressure.\n\nOne item at a time. No timeline. No one watching.\n\nJust you, the page, and a real starting point.",
    20
]);

echo $stmt->rowCount() ? 'Done — Someday Companion added to shop.' : 'No rows inserted — check for duplicate slug.';
?>
