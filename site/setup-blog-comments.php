<?php
/**
 * One-time setup: creates the blog_comments table.
 * UPLOAD, VISIT IN BROWSER, THEN DELETE.
 */
require_once __DIR__ . '/includes/db.php';
$db = getDB();
$results = [];

try {
    $db->exec("
        CREATE TABLE IF NOT EXISTS blog_comments (
            id INT AUTO_INCREMENT PRIMARY KEY,
            post_id INT NOT NULL,
            user_id INT NOT NULL,
            body TEXT NOT NULL,
            status ENUM('visible', 'hidden') NOT NULL DEFAULT 'visible',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (post_id) REFERENCES blog_posts(id) ON DELETE CASCADE,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            INDEX idx_post_visible (post_id, status, created_at)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    $results[] = 'blog_comments — OK';
} catch (Exception $e) {
    $results[] = 'blog_comments — ERROR: ' . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Blog Comments Setup — My Nest Chapter</title>
<style>body{font-family:Arial,sans-serif;max-width:600px;margin:50px auto;padding:20px;}.r{padding:8px 0;border-bottom:1px solid #eee;}.warn{margin-top:2rem;padding:1rem;background:#FFF3CD;border:1px solid #FFEEBA;font-size:0.85rem;}</style>
</head>
<body>
<h1>Blog Comments Setup</h1>
<?php foreach ($results as $r): ?><div class="r"><?= htmlspecialchars($r) ?></div><?php endforeach; ?>
<div class="warn">
    <strong>Next step:</strong> DELETE THIS FILE from the server.
</div>
</body>
</html>
