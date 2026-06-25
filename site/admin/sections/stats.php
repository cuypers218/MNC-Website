<?php
$db = getDB();

// Stat queries — adjust column names to confirmed live schema
$totalMembers = (int)$db->query("SELECT COUNT(*) FROM users")->fetchColumn();

$totalProductsLive = (int)$db->query("SELECT COUNT(*) FROM products WHERE status = 'active'")->fetchColumn();

$totalOrders = (int)$db->query("SELECT COUNT(*) FROM purchases")->fetchColumn();

// Revenue from amount_paid on purchases (actual charge, not product price)
$totalRevenue = (float)($db->query("SELECT COALESCE(SUM(amount_paid), 0) FROM purchases")->fetchColumn());

$blogPublished = (int)$db->query("SELECT COUNT(*) FROM blog_posts WHERE status = 'published'")->fetchColumn();

$queueBuilt = 0;
try {
    $queueBuilt = (int)$db->query("SELECT COUNT(*) FROM exclusive_content_queue")->fetchColumn();
} catch (Exception $e) {
    // Table may not exist yet
}

$stats = [
    ['label' => 'Total Members',       'value' => $totalMembers],
    ['label' => 'Products Live',       'value' => $totalProductsLive],
    ['label' => 'Total Orders',        'value' => $totalOrders],
    ['label' => 'Total Revenue',       'value' => '$' . number_format($totalRevenue, 2)],
    ['label' => 'Posts Published',     'value' => $blogPublished],
    ['label' => 'Queue Items Built',   'value' => $queueBuilt],
];

$actionItems = [
    'Upload thumbnail images for: 6pm Cheat Sheet, Coloring Pages, Someday List Builder',
    'Build Exclusive Content section on dashboard.php for members',
    'Add Slot 3 to exclusive content drip queue (Weekend Structure Sheet)',
    'Fix banned phrase in Quiet House Meter description (site/index.php ~line 429)',
    'Fix banned word "Carried" in workbook.php ~line 722',
];
?>

<div class="stats-grid">
    <?php foreach ($stats as $s): ?>
        <div class="stat-card">
            <div class="stat-label"><?= esc($s['label']) ?></div>
            <div class="stat-value"><?= esc((string)$s['value']) ?></div>
        </div>
    <?php endforeach; ?>
</div>

<div class="checklist-section">
    <h2>Action Items</h2>
    <ul class="checklist">
        <?php foreach ($actionItems as $item): ?>
            <li>
                <div class="check-box"></div>
                <span><?= esc($item) ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
