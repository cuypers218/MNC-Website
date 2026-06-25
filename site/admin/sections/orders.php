<?php
$db = getDB();

$search = trim($_GET['q'] ?? '');
$searchParam = '%' . $search . '%';

$sql = "
    SELECT
        u.first_name,
        u.email,
        p.title AS product_name,
        p.price AS product_price,
        pu.amount_paid,
        pu.stripe_payment_id,
        pu.purchased_at
    FROM purchases pu
    JOIN users u    ON pu.user_id    = u.id
    JOIN products p ON pu.product_id = p.id
";

if ($search) {
    $sql .= " WHERE u.email LIKE :q OR u.first_name LIKE :q OR p.title LIKE :q";
}

$sql .= " ORDER BY pu.purchased_at DESC";

$stmt = $db->prepare($sql);
if ($search) {
    $stmt->execute([':q' => $searchParam]);
} else {
    $stmt->execute();
}
$orders = $stmt->fetchAll();

// Totals
$totalCount   = count($orders);
$totalRevenue = array_sum(array_column($orders, 'amount_paid'));
?>

<div class="search-form">
    <form method="GET" action="/admin/dashboard.php" style="display:flex;gap:12px;align-items:center;">
        <input type="hidden" name="page" value="orders">
        <input
            class="form-control"
            type="text"
            name="q"
            placeholder="Search by name, email, or product..."
            value="<?= esc($search) ?>"
            style="max-width:320px;"
        >
        <button type="submit" class="btn btn-secondary btn-sm">Search</button>
        <?php if ($search): ?>
            <a href="/admin/dashboard.php?page=orders" class="btn btn-ghost btn-sm">Clear</a>
        <?php endif; ?>
    </form>
</div>

<?php if (!$orders): ?>
    <div class="empty-state"><?= $search ? 'No orders matching "' . esc($search) . '".' : 'No orders yet.' ?></div>
<?php else: ?>
<div class="table-wrap">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Email</th>
                <th>Product</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Stripe ID</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $o): ?>
                <tr>
                    <td><?= esc($o['first_name']) ?></td>
                    <td style="color:#444;font-size:13px;"><?= esc($o['email']) ?></td>
                    <td><?= esc($o['product_name']) ?></td>
                    <td>
                        <?php
                        $amt = (float)$o['amount_paid'];
                        echo $amt > 0 ? '$' . number_format($amt, 2) : '<span style="color:#888;">Free</span>';
                        ?>
                    </td>
                    <td style="color:#666;font-size:13px;"><?= date('M j, Y', strtotime($o['purchased_at'])) ?></td>
                    <td style="font-size:11px;color:#888;font-family:monospace;">
                        <?= esc($o['stripe_payment_id'] ?: '—') ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="table-totals">
                <td colspan="3" style="font-family:'Montserrat',Arial,sans-serif;font-weight:800;font-size:11px;text-transform:uppercase;letter-spacing:1px;">
                    <?= $totalCount ?> order<?= $totalCount !== 1 ? 's' : '' ?>
                </td>
                <td style="font-family:'Montserrat',Arial,sans-serif;font-weight:800;">$<?= number_format($totalRevenue, 2) ?></td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
    </table>
</div>
<?php endif; ?>
