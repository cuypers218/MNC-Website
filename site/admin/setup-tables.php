<?php
/**
 * Admin one-time setup — run once in a browser, then DELETE this file.
 * Adds the stripe_product_id column to products and confirms other tables exist.
 * VISIT: mynestchapter.com/admin/setup-tables.php
 */
require_once __DIR__ . '/auth.php';

$db      = getDB();
$results = [];

// Add stripe_product_id to products if missing
try {
    $db->exec("ALTER TABLE products ADD COLUMN IF NOT EXISTS stripe_product_id VARCHAR(100) DEFAULT NULL");
    $results[] = ['ok', 'products.stripe_product_id — added (or already existed)'];
} catch (Exception $e) {
    $results[] = ['err', 'products.stripe_product_id — ' . $e->getMessage()];
}

// Confirm exclusive_content_queue exists
try {
    $count = $db->query("SELECT COUNT(*) FROM exclusive_content_queue")->fetchColumn();
    $results[] = ['ok', 'exclusive_content_queue — exists with ' . $count . ' item(s)'];
} catch (Exception $e) {
    $results[] = ['err', 'exclusive_content_queue — NOT FOUND. Run site/mnc-setup-exclusive.php first.'];
}

// Confirm quiz_result column on users
try {
    $db->exec("ALTER TABLE users ADD COLUMN IF NOT EXISTS quiz_result VARCHAR(20) DEFAULT NULL");
    $results[] = ['ok', 'users.quiz_result — confirmed'];
} catch (Exception $e) {
    $results[] = ['err', 'users.quiz_result — ' . $e->getMessage()];
}

// Confirm is_admin column on users
try {
    $db->exec("ALTER TABLE users ADD COLUMN IF NOT EXISTS is_admin TINYINT(1) NOT NULL DEFAULT 0");
    $results[] = ['ok', 'users.is_admin — confirmed'];
} catch (Exception $e) {
    $results[] = ['err', 'users.is_admin — ' . $e->getMessage()];
}

// Confirm highest_tier_seen column on users
try {
    $db->exec("ALTER TABLE users ADD COLUMN IF NOT EXISTS highest_tier_seen INT NOT NULL DEFAULT 0");
    $results[] = ['ok', 'users.highest_tier_seen — confirmed'];
} catch (Exception $e) {
    $results[] = ['err', 'users.highest_tier_seen — ' . $e->getMessage()];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Setup — My Nest Chapter</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
<style>
body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; background: #f5f4f0; }
h1 { font-family: 'Montserrat', Arial, sans-serif; font-weight: 800; font-size: 18px; text-transform: uppercase; letter-spacing: 1px; color: #E87AAA; margin-bottom: 24px; }
.row { padding: 10px 14px; margin-bottom: 8px; font-size: 13px; }
.ok  { background: #edf7e6; border-left: 4px solid #B5CC6A; }
.err { background: #fde8e8; border-left: 4px solid #c0392b; }
.warn { margin-top: 24px; padding: 16px; background: #FFF3CD; border: 1px solid #FFEEBA; font-size: 13px; }
a { color: #E87AAA; }
</style>
</head>
<body>
<h1>Admin — Table Setup</h1>
<?php foreach ($results as [$type, $msg]): ?>
    <div class="row <?= $type ?>"><?= htmlspecialchars($msg) ?></div>
<?php endforeach; ?>
<div class="warn">
    <strong>Done.</strong> Delete this file from the server now — go to Hostinger File Manager and remove
    <code>public_html/admin/setup-tables.php</code>.<br><br>
    <a href="/admin/dashboard.php">Go to Admin Dashboard</a>
</div>
</body>
</html>
