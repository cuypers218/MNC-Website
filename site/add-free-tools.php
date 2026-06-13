<?php
require_once __DIR__ . '/includes/db.php';
$db = getDB();

$tools = [
    [
        'title'             => 'The 6pm Cheat Sheet',
        'slug'              => '6pm-cheat-sheet',
        'category'          => 'freebie',
        'price'             => 0,
        'status'            => 'active',
        'file_path'         => 'https://drive.google.com/uc?export=download&id=1dVTgwgBjwsg0jz9HCcGkPgif6edNhyQR',
        'image_path'        => null,
        'short_description' => '7 things that actually helped me get through the 6pm hour. Short. Honest. Free.',
        'description'       => "The 6pm hour is the hardest part of the day. Nobody tells you that until you're already in it.\n\nI put together 7 things that actually helped me get through it.",
        'sort_order'        => 1,
    ],
    [
        'title'             => 'Pick Your Mood Coloring Pages',
        'slug'              => 'coloring-widget',
        'category'          => 'interactive_tool',
        'price'             => 0,
        'status'            => 'active',
        'file_path'         => null,
        'image_path'        => null,
        'short_description' => 'Choose your mood and download a coloring page made for that exact feeling.',
        'description'       => "Sometimes you don't need to talk about it. You just need something to do with your hands.\n\nPick your mood and get a coloring page made for exactly where you are right now.",
        'sort_order'        => 2,
    ],
    [
        'title'             => 'Empty Nester Quiz',
        'slug'              => 'empty-nester-quiz',
        'category'          => 'interactive_tool',
        'price'             => 0,
        'status'            => 'active',
        'file_path'         => null,
        'image_path'        => null,
        'short_description' => 'Find out where you actually are in your empty nest transition.',
        'description'       => "Nobody warned you it would feel like this.\n\nThis quiz helps you figure out where you are right now — so you know what you actually need next.",
        'sort_order'        => 3,
    ],
];

$stmt = $db->prepare('INSERT IGNORE INTO products (title, slug, category, price, status, file_path, image_path, short_description, description, sort_order) VALUES (?,?,?,?,?,?,?,?,?,?)');

$added = 0;
foreach ($tools as $t) {
    $stmt->execute([$t['title'], $t['slug'], $t['category'], $t['price'], $t['status'], $t['file_path'], $t['image_path'], $t['short_description'], $t['description'], $t['sort_order']]);
    if ($stmt->rowCount()) {
        echo 'Added: ' . $t['title'] . '<br>';
        $added++;
    } else {
        echo 'Skipped (already exists): ' . $t['title'] . '<br>';
    }
}
echo '<br>' . $added . ' new tool(s) added.';
?>
