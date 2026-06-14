<?php
/**
 * One-time script — adds Goal & Habit Tracker to the products table.
 * UPLOAD, VISIT IN BROWSER, THEN DELETE.
 */
require_once __DIR__ . '/includes/db.php';
$db = getDB();
$results = [];

$stmt = $db->prepare("INSERT IGNORE INTO products (title, slug, short_description, description, price, category, file_path, image_path, status, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->execute([
    '30-Day Goal & Habit Tracker',
    'goal-habit-tracker',
    'A 30-day interactive tracker for the goals and habits that actually matter to you. Set up in 5 steps, check in daily, and watch your consistency build.',
    "You've tried the apps. You've bought the planners. You've started and stopped more times than you can count.\n\nThis is different because it starts with you — your life, your values, your goals — before it ever asks you to track a single thing.\n\nThe 5-step setup walks you through a full life assessment, helps you name what you actually value, and builds three real goals with a weekly action plan for each. Then the daily tracker takes five minutes. That's it. One entry per day, one habit at a time.\n\nAt the end of 30 days, your Monthly tab shows you exactly what you showed up for — every habit, every day, a visual record of the month you chose yourself.\n\nIncludes the full 103-page printable workbook PDF. The digital tracker and the workbook work together — the PDF is for the deep setup and writing exercises, the tracker is for showing up every single day.",
    27.00,
    'interactive_tool',
    null,
    null,
    'active',
    10
]);
$results[] = 'Goal & Habit Tracker — ' . ($stmt->rowCount() ? 'ADDED' : 'already exists');
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Product Add — My Nest Chapter</title>
<style>body{font-family:Arial,sans-serif;max-width:600px;margin:50px auto;padding:20px;}.result{padding:8px 0;border-bottom:1px solid #ddd;}.warning{margin-top:2rem;padding:1rem;background:#FFF3CD;border:1px solid #FFEEBA;font-size:0.85rem;}</style>
</head>
<body>
<h1>Product Add</h1>
<?php foreach ($results as $r): ?><div class="result"><?= htmlspecialchars($r) ?></div><?php endforeach; ?>
<div class="warning"><strong>DELETE THIS FILE NOW.</strong> Go to Hostinger File Manager and delete add-goal-habit-tracker.php from the site/ folder.</div>
</body>
</html>
