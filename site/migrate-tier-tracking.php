<?php
/**
 * One-time migration — adds highest_tier_seen to users table.
 * Run once at mynestchapter.com/migrate-tier-tracking.php, then DELETE THIS FILE.
 */
require_once __DIR__ . '/includes/db.php';
$db = getDB();

try {
    $db->exec("ALTER TABLE users ADD COLUMN highest_tier_seen TINYINT UNSIGNED NOT NULL DEFAULT 0");
    $status = '<p style="color:green;font-size:1rem;">✓ Column <strong>highest_tier_seen</strong> added to users table successfully.</p>';
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'Duplicate column') !== false) {
        $status = '<p style="color:orange;font-size:1rem;">Column already exists — nothing to do.</p>';
    } else {
        $status = '<p style="color:red;font-size:1rem;">Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Migration — My Nest Chapter</title>
    <style>body{font-family:Arial,sans-serif;max-width:560px;margin:60px auto;padding:20px;color:#252535;} .warn{margin-top:2rem;padding:1rem;background:#FFF3CD;border:1px solid #FFEEBA;font-size:0.9rem;}</style>
</head>
<body>
    <h2 style="font-family:Arial;font-size:1rem;text-transform:uppercase;letter-spacing:0.1em;">MNC Migration — Tier Tracking</h2>
    <?= $status ?>
    <div class="warn"><strong>Delete this file now.</strong> Go to Hostinger File Manager and remove <code>migrate-tier-tracking.php</code> from public_html. Leaving it online is a security risk.</div>
</body>
</html>
