<?php
$db = getDB();

// Quiz results are stored in users.quiz_result (confirmed from quiz-submit.php)
// A separate quiz_results table does not exist — querying the users table directly
$rows = $db->query("
    SELECT quiz_result AS result_type, COUNT(*) AS count
    FROM users
    WHERE quiz_result IS NOT NULL AND quiz_result != ''
    GROUP BY quiz_result
")->fetchAll();

$totalTakers = 0;
$counts = ['nester' => 0, 'busyer' => 0, 'wonderer' => 0];
foreach ($rows as $row) {
    if (isset($counts[$row['result_type']])) {
        $counts[$row['result_type']] = (int)$row['count'];
        $totalTakers += (int)$row['count'];
    }
}

$totalMembers  = (int)$db->query("SELECT COUNT(*) FROM users")->fetchColumn();
$notTaken      = max(0, $totalMembers - $totalTakers);

$labels = ['nester' => 'The Nester', 'busyer' => 'The Busy-er', 'wonderer' => 'The Wonderer'];
$colors = ['nester' => 'nester', 'busyer' => 'busyer', 'wonderer' => 'wonderer'];

// Interpretation
$interpretation = '';
if ($totalTakers > 0) {
    $maxKey   = array_search(max($counts), $counts);
    $maxPct   = round(($counts[$maxKey] / $totalTakers) * 100);
    $maxLabel = $labels[$maxKey];

    if ($maxKey === 'nester') {
        $interpretation = $maxLabel . ' is your biggest segment at ' . $maxPct . '% — content about reclaiming home, routines, and space will land broadest.';
    } elseif ($maxKey === 'busyer') {
        $interpretation = $maxLabel . ' is your biggest segment at ' . $maxPct . '% — content about slowing down, finding stillness, and looking underneath the busy will land broadest.';
    } else {
        $interpretation = $maxLabel . ' is your biggest segment at ' . $maxPct . '% — content about curiosity, reinvention, and exploring what comes next will land broadest.';
    }
}
?>

<!-- Stat row -->
<div style="display:flex;gap:16px;margin-bottom:28px;flex-wrap:wrap;">
    <div class="stat-card" style="min-width:160px;">
        <div class="stat-label">Total Quiz Takers</div>
        <div class="stat-value"><?= $totalTakers ?></div>
    </div>
    <div class="stat-card" style="min-width:160px;">
        <div class="stat-label">Members Not Yet Taken</div>
        <div class="stat-value"><?= $notTaken ?></div>
    </div>
</div>

<?php if ($totalTakers === 0): ?>
    <div class="empty-state">No quiz results yet. Once members take the quiz and results are recorded, they'll appear here.</div>
<?php else: ?>

<!-- Bar chart -->
<div class="quiz-bars">
    <?php foreach ($counts as $key => $count): ?>
        <?php $pct = $totalTakers > 0 ? round(($count / $totalTakers) * 100) : 0; ?>
        <div class="bar-row">
            <span class="bar-label"><?= esc($labels[$key]) ?></span>
            <div class="bar-track">
                <div class="bar-fill <?= $key ?>" style="width:<?= $pct ?>%;">
                    <?php if ($pct > 8): ?>
                        <span style="font-family:'Montserrat',Arial,sans-serif;font-weight:800;font-size:11px;color:#252535;">
                            <?= $count ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
            <span class="bar-pct"><?= $pct ?>%</span>
        </div>
    <?php endforeach; ?>
</div>

<?php if ($interpretation): ?>
    <div class="callout"><?= esc($interpretation) ?></div>
<?php endif; ?>

<!-- Breakdown table -->
<div class="table-wrap">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Type</th>
                <th>Count</th>
                <th>Share</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($counts as $key => $count): ?>
                <tr>
                    <td><?= esc($labels[$key]) ?></td>
                    <td><?= $count ?></td>
                    <td>
                        <?php $pct = $totalTakers > 0 ? round(($count / $totalTakers) * 100) : 0; ?>
                        <?= $pct ?>%
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php endif; ?>
