<?php
/**
 * One-time script — updates Garage Sale Planner to active at $27.
 * VISIT IN BROWSER, THEN DELETE THIS FILE.
 */
require_once __DIR__ . '/includes/db.php';

$db = getDB();

try {
    $stmt = $db->prepare("UPDATE products SET status = 'active', price = 27.00, short_description = 'Plan, price, and track your garage sale from start to finish. Built for solo moms who are ready to clear out and cash in.', description = 'Everything you need to run a garage sale — in one interactive tool. Add items, set prices, track transactions, log what sells, and wrap up with a full summary sent to your inbox.\n\nBuilt for solo moms clearing out the nest. No spreadsheets, no sticky notes, no chaos.\n\nWhat you get:\n- Item list with pricing and sorting\n- Live transaction tracker with running total\n- Goal tracker so you know how close you are\n- PDF export of your full sale summary\n- Email delivery of your results\n- Works on your phone on sale day' WHERE slug = 'garage-sale-planner'");
    $stmt->execute();
    $affected = $stmt->rowCount();
    $message = $affected > 0 ? 'Garage Sale Planner updated — active at $27.00.' : 'No rows updated. Product may not exist yet — run seed-products.php first.';
    $color = $affected > 0 ? '#E87AAA' : '#c0392b';
} catch (Exception $e) {
    $message = 'Error: ' . $e->getMessage();
    $color = '#c0392b';
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Update — My Nest Chapter</title>
<style>body{font-family:Arial,sans-serif;max-width:500px;margin:60px auto;padding:20px;color:#252535;}</style>
</head>
<body>
<p style="font-size:1.1rem;font-weight:700;color:<?= $color ?>;"><?= $message ?></p>
<p style="color:#c0392b;font-weight:700;margin-top:2rem;">DELETE THIS FILE NOW from Hostinger File Manager.</p>
</body>
</html>
