<?php
/**
 * My Nest Chapter — Product Seed Script
 * Adds your products to the database.
 * 
 * UPLOAD TO public_html, VISIT IN BROWSER, THEN DELETE.
 */

require_once __DIR__ . '/includes/db.php';

$db = getDB();
$results = [];

$products = [
    // REAL PRODUCT — Workbook 1
    [
        'title' => 'Now What? A Workbook for Solo Moms in the Empty Nest',
        'slug' => 'now-what-workbook',
        'short_description' => 'The workbook I made because nothing out there sounded like me. Activities, reflections, and honest space for solo moms figuring out what comes next.',
        'description' => "I wrote this because I couldn't find anything for solo moms hitting the empty nest. Everything I found was written for couples or by therapists. None of it sounded like me.\n\nThis workbook has activities and reflections built around what I actually went through — the quiet, the identity shift, the weird mix of relief and grief. It's not advice. It's space to figure out what you want now that the house is yours.\n\nWhat's inside:\n- Activities you can do at your own pace\n- Reflections that don't tell you how to feel\n- Space for the hard stuff and the good stuff\n- Built for solo moms, by a solo mom\n\nDigital PDF download. Print it, write in it, come back to it.",
        'price' => 14.99,
        'category' => 'workbook',
        'file_path' => null,
        'image_path' => null,
        'status' => 'active',
        'sort_order' => 1
    ],
    // FREE — Quiet House Meter
    [
        'title' => 'The Quiet House Meter',
        'slug' => 'quiet-house-meter',
        'short_description' => 'Five questions about where you are with the quiet right now. No judgment. Takes 60 seconds.',
        'description' => "Five questions. That's it. You answer honestly, and I'll point you to the thing I made that fits where you are today.\n\nThis isn't a diagnosis or a score that means anything clinical. It's just a way to name where you are right now — because sometimes that's the hardest part.",
        'price' => 0.00,
        'category' => 'free',
        'file_path' => null,
        'image_path' => null,
        'status' => 'active',
        'sort_order' => 2
    ],
    // FREE — Someday List Builder
    [
        'title' => 'The Someday List Builder',
        'slug' => 'someday-list-builder',
        'short_description' => 'All those things you said you\'d do someday? This is where you finally write them down.',
        'description' => "You've been saying someday for years. Someday I'll take that trip. Someday I'll try that class. Someday I'll figure out what I actually want.\n\nThis tool gives you a place to dump all of it — no organizing, no prioritizing, no pressure. Just get it out of your head and onto a list you can actually look at.",
        'price' => 0.00,
        'category' => 'free',
        'file_path' => null,
        'image_path' => null,
        'status' => 'active',
        'sort_order' => 3
    ],
    // FREE — The 6pm Cheat Sheet
    [
        'title' => 'The 6pm Cheat Sheet',
        'slug' => 'the-6pm-cheat-sheet',
        'short_description' => 'For when 6pm hits and you don\'t know what to do with yourself. A real list of things that actually helped me.',
        'description' => "6pm used to be the worst part of my day. The kids weren't coming home, dinner felt pointless, and the silence was loud.\n\nThis is a list of things I actually did on those nights. Not advice. Not self-care platitudes. Real things that got me from 6pm to bedtime without falling apart.",
        'price' => 0.00,
        'category' => 'free',
        'file_path' => null,
        'image_path' => null,
        'status' => 'active',
        'sort_order' => 4
    ],
    // PLACEHOLDER — The Someday List Companion
    [
        'title' => 'The Someday List Companion',
        'slug' => 'someday-list-companion',
        'short_description' => 'Take your someday list and actually start doing the things on it. A companion guide with steps, not pressure.',
        'description' => 'Coming soon. This companion picks up where the free Someday List Builder leaves off.',
        'price' => 9.99,
        'category' => 'companion',
        'file_path' => null,
        'image_path' => null,
        'status' => 'coming_soon',
        'sort_order' => 5
    ],
    // PLACEHOLDER — Garage Sale Planner
    [
        'title' => 'The Garage Sale Planner',
        'slug' => 'garage-sale-planner',
        'short_description' => 'An interactive tool to plan, price, and track your garage sale from start to finish.',
        'description' => 'Coming soon. Built for when you\'re ready to clear out the stuff and make some cash doing it.',
        'price' => 7.99,
        'category' => 'interactive_tool',
        'file_path' => null,
        'image_path' => null,
        'status' => 'coming_soon',
        'sort_order' => 6
    ],
    // PLACEHOLDER — The New Grandma Planner
    [
        'title' => 'The New Grandma Planner',
        'slug' => 'new-grandma-planner',
        'short_description' => 'For when your kid makes you a grandma and you have no idea what that looks like as a solo mom.',
        'description' => 'Coming soon. Built from my own experience becoming a grandma after doing it all alone.',
        'price' => 9.99,
        'category' => 'interactive_tool',
        'file_path' => null,
        'image_path' => null,
        'status' => 'coming_soon',
        'sort_order' => 7
    ],
    // PLACEHOLDER — The Solo Travel Planner
    [
        'title' => 'The Solo Travel Planner',
        'slug' => 'solo-travel-planner',
        'short_description' => 'Plan a trip just for you. Budget, packing, itinerary — all in one interactive tool.',
        'description' => 'Coming soon.',
        'price' => 7.99,
        'category' => 'interactive_tool',
        'file_path' => null,
        'image_path' => null,
        'status' => 'coming_soon',
        'sort_order' => 8
    ],
];

foreach ($products as $p) {
    try {
        $stmt = $db->prepare('INSERT IGNORE INTO products (title, slug, short_description, description, price, category, file_path, image_path, status, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $p['title'], $p['slug'], $p['short_description'], $p['description'],
            $p['price'], $p['category'], $p['file_path'], $p['image_path'],
            $p['status'], $p['sort_order']
        ]);
        $results[] = $p['title'] . ' — ADDED';
    } catch (Exception $e) {
        $results[] = $p['title'] . ' — ERROR: ' . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Product Seed — My Nest Chapter</title>
<style>body{font-family:Arial,sans-serif;max-width:600px;margin:50px auto;padding:20px;color:#101010;}h1{font-size:1.2rem;color:#811453;text-transform:uppercase;}.result{padding:8px 0;border-bottom:1px solid #D3D3D3;font-size:0.95rem;}.warning{margin-top:2rem;padding:1rem;background:#FFF3CD;border:1px solid #FFEEBA;font-size:0.85rem;}</style>
</head>
<body>
<h1>Product Seed Complete</h1>
<?php foreach ($results as $r): ?>
<div class="result"><?= $r ?></div>
<?php endforeach; ?>
<div class="warning"><strong>DELETE THIS FILE NOW.</strong> Go to Hostinger File Manager and delete seed-products.php.</div>
</body>
</html>
