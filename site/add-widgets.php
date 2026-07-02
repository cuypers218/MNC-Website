<?php
/**
 * One-time script — adds Cooking for One widget and updates Garage Sale Planner.
 * UPLOAD, VISIT IN BROWSER, THEN DELETE.
 */
require_once __DIR__ . '/admin/auth.php';
$db = getDB();
$results = [];

// Update Garage Sale Planner: set active at $27
$stmt = $db->prepare("UPDATE products SET price = 27.00, status = 'active', short_description = 'An interactive planner to organize, price, and run your garage sale from start to finish. Track every item, set a money goal, and keep everything in one place.' WHERE slug = 'garage-sale-planner'");
$stmt->execute();
$results[] = 'Garage Sale Planner — updated to $27 active (' . $stmt->rowCount() . ' row)';

// Add Cooking for One
$stmt = $db->prepare("INSERT IGNORE INTO products (title, slug, short_description, description, price, category, file_path, image_path, status, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([
    'Cooking for One Planner',
    'cooking-for-one',
    'A weekly meal planner built for one. Plan seven days, build your grocery list, and email yourself the whole thing.',
    "Cooking for one sounds simple until you\'re standing in the kitchen with no idea what to make.\n\nThis planner helps you figure out the week before the week happens. Seven days, every meal slot, a grocery list that builds itself as you go. You can email the whole plan to yourself so you have it when you\'re at the store.\n\nBuilt for empty nesters, solo women, and anyone who got tired of making dinner for a crowd and now has to figure out what dinner even looks like for one person.",
    27.00,
    'interactive_tool',
    null,
    null,
    'active',
    9
]);
$results[] = 'Cooking for One — ' . ($stmt->rowCount() ? 'ADDED' : 'already exists');
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Widget Update — My Nest Chapter</title>
<style>body{font-family:Arial,sans-serif;max-width:600px;margin:50px auto;padding:20px;}.result{padding:8px 0;border-bottom:1px solid #ddd;}.warning{margin-top:2rem;padding:1rem;background:#FFF3CD;border:1px solid #FFEEBA;font-size:0.85rem;}</style>
</head>
<body>
<h1>Widget Update</h1>
<?php foreach ($results as $r): ?><div class="result"><?= htmlspecialchars($r) ?></div><?php endforeach; ?>
<div class="warning"><strong>DELETE THIS FILE NOW.</strong> Go to Hostinger File Manager and delete add-widgets.php from the site/ folder.</div>
</body>
</html>
