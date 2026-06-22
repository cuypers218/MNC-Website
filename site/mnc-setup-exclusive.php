<?php
/**
 * One-time setup: creates exclusive content tables and seeds initial queue.
 * UPLOAD, VISIT IN BROWSER, THEN DELETE.
 */
require_once __DIR__ . '/includes/db.php';
$db = getDB();
$results = [];

// exclusive_content_queue
try {
    $db->exec("
        CREATE TABLE IF NOT EXISTS exclusive_content_queue (
            id INT AUTO_INCREMENT PRIMARY KEY,
            sequence_number INT NOT NULL,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            file_path VARCHAR(500),
            unlock_offset_days INT NOT NULL DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            UNIQUE KEY unique_sequence (sequence_number)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    $results[] = 'exclusive_content_queue — OK';
} catch (Exception $e) {
    $results[] = 'exclusive_content_queue — ERROR: ' . $e->getMessage();
}

// member_freebie_notifications
try {
    $db->exec("
        CREATE TABLE IF NOT EXISTS member_freebie_notifications (
            id INT AUTO_INCREMENT PRIMARY KEY,
            member_id INT NOT NULL,
            queue_item_id INT NOT NULL,
            emailed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            UNIQUE KEY unique_notification (member_id, queue_item_id),
            FOREIGN KEY (member_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (queue_item_id) REFERENCES exclusive_content_queue(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    $results[] = 'member_freebie_notifications — OK';
} catch (Exception $e) {
    $results[] = 'member_freebie_notifications — ERROR: ' . $e->getMessage();
}

// Seed the initial queue (INSERT IGNORE — safe to re-run)
$items = [
    [1, 'The 6pm Survival Plan',
        'A deeper look at getting through the hardest hour — more tools, more honesty, more of what actually worked.',
        'exclusive-6pm-survival-plan.pdf', 0],
    [2, 'Who Am I Now',
        'A guided reflection for the identity shift that comes with an empty nest. Not a quiz — a real sit-down with yourself.',
        'exclusive-who-am-i-now.pdf', 30],
];

$stmt = $db->prepare("
    INSERT IGNORE INTO exclusive_content_queue (sequence_number, title, description, file_path, unlock_offset_days)
    VALUES (?, ?, ?, ?, ?)
");
foreach ($items as $item) {
    $stmt->execute($item);
    $results[] = 'Queue item ' . $item[0] . ' (' . $item[1] . ') — ' . ($stmt->rowCount() ? 'ADDED' : 'already exists');
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><title>Exclusive Setup — My Nest Chapter</title>
<style>body{font-family:Arial,sans-serif;max-width:600px;margin:50px auto;padding:20px;}.r{padding:8px 0;border-bottom:1px solid #eee;}.warn{margin-top:2rem;padding:1rem;background:#FFF3CD;border:1px solid #FFEEBA;font-size:0.85rem;}</style>
</head>
<body>
<h1>Exclusive Content Setup</h1>
<?php foreach ($results as $r): ?><div class="r"><?= htmlspecialchars($r) ?></div><?php endforeach; ?>
<div class="warn">
    <strong>Next steps:</strong><br>
    1. Upload <code>exclusive-6pm-survival-plan.pdf</code> and <code>exclusive-who-am-i-now.pdf</code> to the <code>downloads/</code> folder on Hostinger.<br>
    2. Register the daily cron in Hostinger → Hosting → Cron Jobs:<br>
    <code>php /home/u540670132/domains/mynestchapter.com/public_html/cron/send-exclusive-unlocks.php</code> — daily at 9 AM.<br>
    3. DELETE THIS FILE from the server.
</div>
</body>
</html>
