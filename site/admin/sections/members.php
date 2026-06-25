<?php
$db = getDB();

$members = $db->query("
    SELECT
        u.id,
        u.first_name,
        u.email,
        u.created_at,
        u.is_admin,
        COUNT(pu.id) AS purchase_count
    FROM users u
    LEFT JOIN purchases pu ON pu.user_id = u.id
    GROUP BY u.id
    ORDER BY u.created_at DESC
")->fetchAll();
?>

<div class="section-header">
    <span class="section-title">Members (<?= count($members) ?>)</span>
    <span style="font-size:13px;color:#888;">Read-only — delete via Hostinger DB if needed.</span>
</div>

<?php if (!$members): ?>
    <div class="empty-state">No members yet.</div>
<?php else: ?>
<div class="table-wrap">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Joined</th>
                <th>Purchases</th>
                <th>Admin</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($members as $m): ?>
                <tr>
                    <td><?= esc($m['first_name']) ?></td>
                    <td style="color:#444;"><?= esc($m['email']) ?></td>
                    <td style="color:#666;font-size:13px;"><?= date('M j, Y', strtotime($m['created_at'])) ?></td>
                    <td>
                        <?php if ($m['purchase_count'] > 0): ?>
                            <span style="font-family:'Montserrat',Arial,sans-serif;font-weight:800;"><?= (int)$m['purchase_count'] ?></span>
                        <?php else: ?>
                            <span style="color:#ccc;">—</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($m['is_admin']): ?>
                            <span class="badge badge-active">Admin</span>
                        <?php else: ?>
                            <span style="color:#ccc;font-size:12px;">—</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>
