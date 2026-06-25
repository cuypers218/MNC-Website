<?php
// Hostinger Reach API — read-only stats for the admin panel
$apiToken   = '6MIeMuGCJNf9Fp6NpRLB2xCAW5mmy2gIXQyKxdmS1e9982ba';
$baseUrl    = 'https://developers.hostinger.com/api/reach/v1';

function reachGet($url, $token) {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_HTTPHEADER     => [
            'Authorization: Bearer ' . $token,
            'Accept: application/json',
        ],
    ]);
    $body = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($code !== 200) return null;
    return json_decode($body, true);
}

// Total subscribers
$contactsData = reachGet($baseUrl . '/contacts?subscription_status=subscribed&per_page=1', $apiToken);
$totalSubs    = $contactsData['meta']['total'] ?? '—';

// Recent signups (last 6)
$recentData   = reachGet($baseUrl . '/contacts?subscription_status=subscribed&per_page=6', $apiToken);
$recentContacts = $recentData['data'] ?? [];

// Plan info
$profilesData = reachGet($baseUrl . '/profiles', $apiToken);
$plan         = null;
if ($profilesData && !empty($profilesData[0])) {
    $plan = $profilesData[0];
}
$subLimit     = $plan['limits']['subscribers_limit']   ?? 500;
$emailLimit   = $plan['limits']['emails_monthly_limit'] ?? 3500;
$expires      = $plan ? date('M j, Y', strtotime($plan['expires_at'])) : '—';

// All segments with contact counts
$segmentsData = reachGet($baseUrl . '/segments', $apiToken);
$segments     = $segmentsData ?? [];

$segmentCounts = [];
foreach ($segments as $seg) {
    $r = reachGet($baseUrl . '/segments/' . $seg['uuid'] . '/contacts?per_page=1', $apiToken);
    $segmentCounts[$seg['uuid']] = $r['meta']['total'] ?? 0;
}

// Sort segments by count desc
usort($segments, function($a, $b) use ($segmentCounts) {
    return ($segmentCounts[$b['uuid']] ?? 0) - ($segmentCounts[$a['uuid']] ?? 0);
});

$subPct = $subLimit > 0 ? min(100, round(($totalSubs / $subLimit) * 100)) : 0;
?>

<!-- Plan + totals row -->
<div class="stats-grid" style="margin-bottom:28px;">
    <div class="stat-card">
        <div class="stat-label">Total Subscribers</div>
        <div class="stat-value"><?= $totalSubs ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Plan Limit</div>
        <div class="stat-value"><?= number_format($subLimit) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Monthly Email Limit</div>
        <div class="stat-value"><?= number_format($emailLimit) ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Plan Expires</div>
        <div class="stat-value" style="font-size:18px;margin-top:4px;"><?= $expires ?></div>
    </div>
</div>

<!-- Subscriber usage bar -->
<div style="background:#ffffff;padding:20px 24px;margin-bottom:28px;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
        <span style="font-family:'Montserrat',Arial,sans-serif;font-weight:800;font-size:11px;text-transform:uppercase;letter-spacing:1px;">Subscriber Usage</span>
        <span style="font-size:13px;color:#666;"><?= $totalSubs ?> of <?= number_format($subLimit) ?> (<?= $subPct ?>%)</span>
    </div>
    <div style="background:#e0ddd8;height:16px;">
        <div style="width:<?= $subPct ?>%;height:100%;background:<?= $subPct > 80 ? '#F2A57A' : '#B5CC6A' ?>;"></div>
    </div>
</div>

<!-- Subscribers per segment -->
<div class="section-header">
    <span class="section-title">Subscribers by Source</span>
</div>

<?php if (!$segments): ?>
    <div class="empty-state">Could not load segment data from Reach. Check API connection.</div>
<?php else: ?>
<div class="quiz-bars" style="background:#ffffff;padding:24px;margin-bottom:28px;">
    <?php
    $barColors = [
        '#C4B0E8','#8BA7D4','#F2A57A','#B5CC6A','#EDD96A',
        '#E87AAA','#F5C4A8','#A8C5DA','#C4B0E8','#8BA7D4',
    ];
    $maxCount = max(1, max(array_values($segmentCounts)));
    $i = 0;
    foreach ($segments as $seg):
        $count = $segmentCounts[$seg['uuid']] ?? 0;
        $pct   = round(($count / $maxCount) * 100);
        $color = $barColors[$i % count($barColors)];
        $i++;
    ?>
    <div class="bar-row" style="margin-bottom:14px;">
        <span class="bar-label" style="min-width:200px;font-size:11px;"><?= esc($seg['name']) ?></span>
        <div class="bar-track" style="height:24px;">
            <div class="bar-fill" style="width:<?= max(2, $pct) ?>%;background:<?= $color ?>;min-width:<?= $count > 0 ? '4px' : '0' ?>;">
                <?php if ($pct > 12): ?>
                    <span style="font-family:'Montserrat',Arial,sans-serif;font-weight:800;font-size:11px;color:#252535;"><?= $count ?></span>
                <?php endif; ?>
            </div>
        </div>
        <span class="bar-pct" style="min-width:30px;"><?= $count ?></span>
    </div>
    <?php endforeach; ?>
</div>

<!-- Segment table -->
<div class="table-wrap" style="margin-bottom:28px;">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Segment / Source</th>
                <th>Subscribers</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($segments as $seg): ?>
                <tr>
                    <td><?= esc($seg['name']) ?></td>
                    <td style="font-family:'Montserrat',Arial,sans-serif;font-weight:800;">
                        <?= $segmentCounts[$seg['uuid']] ?? 0 ?>
                    </td>
                    <td style="color:#666;font-size:13px;"><?= date('M j, Y', strtotime($seg['created_at'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

<!-- Recent signups -->
<div class="section-header">
    <span class="section-title">Recent Signups</span>
</div>

<?php if (!$recentContacts): ?>
    <div class="empty-state">No subscribers yet.</div>
<?php else: ?>
<div class="table-wrap" style="margin-bottom:28px;">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Signed Up</th>
                <th>Source</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recentContacts as $c): ?>
                <tr>
                    <td><?= esc(trim(($c['name'] ?? '') . ' ' . ($c['surname'] ?? '')) ?: '—') ?></td>
                    <td style="color:#444;"><?= esc($c['email']) ?></td>
                    <td style="color:#666;font-size:13px;"><?= date('M j, Y', strtotime($c['subscribed_at'])) ?></td>
                    <td style="font-size:12px;color:#888;"><?= esc($c['source'] ?? '—') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>

<!-- Web traffic note -->
<div class="callout" style="margin-top:4px;">
    <strong>Web traffic, page views, and link clicks are not in Hostinger Reach</strong> — Reach is email-only.
    For full site analytics (sessions, page flow, referrals, conversions), go to
    <strong>Hostinger hPanel → Statistics</strong> for server-level traffic,
    or connect <strong>Google Analytics</strong> to your site for complete visitor tracking.
    Campaigns you send through Reach (open rates, click rates) are visible in
    <strong>hPanel → Emails → Hostinger Reach → Campaigns</strong>.
</div>
