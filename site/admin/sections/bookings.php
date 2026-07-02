<?php
// ── Handle admin actions ─────────────────────────────────────
$actionMsg = '';
$actionErr = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Send video link to client
    if (isset($_POST['send_video_link'])) {
        $clientEmail  = trim($_POST['client_email']  ?? '');
        $clientName   = trim($_POST['client_name']   ?? '');
        $bookingDate  = trim($_POST['booking_date']  ?? '');
        $bookingTime  = trim($_POST['booking_time']  ?? '');
        $videoUrl     = trim($_POST['video_url']     ?? '');

        if (!$videoUrl) {
            $actionErr = 'Please paste the video link before sending.';
        } elseif (!filter_var($clientEmail, FILTER_VALIDATE_EMAIL)) {
            $actionErr = 'Invalid client email — could not send.';
        } else {
            require_once __DIR__ . '/../../includes/phpmailer/PHPMailer.php';
            require_once __DIR__ . '/../../includes/phpmailer/SMTP.php';
            require_once __DIR__ . '/../../includes/phpmailer/Exception.php';
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception as MailException;

            $displayDate = date('l, F j, Y', strtotime($bookingDate));
            $displayTime = date('g:i A', strtotime("2000-01-01 $bookingTime"));

            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host       = 'smtp.hostinger.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'cece@mynestchapter.com';
                $mail->Password   = defined('MAIL_PASS') ? MAIL_PASS : '';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;
                $mail->CharSet    = 'UTF-8';
                $mail->setFrom('cece@mynestchapter.com', 'Cece at My Nest Chapter');
                $mail->addAddress($clientEmail, $clientName);
                $mail->Subject = "Your video link for our chat — {$displayDate}";
                $mail->isHTML(false);
                $mail->Body =
                    "Hi {$clientName},\n\n" .
                    "We're almost there! Here is your link for our video call:\n\n" .
                    "{$videoUrl}\n\n" .
                    "📅 Date: {$displayDate}\n" .
                    "⏰ Time: {$displayTime}\n\n" .
                    "Click the link above a minute or two before we start and I'll be there. " .
                    "If anything comes up, just reply to this email.\n\n" .
                    "See you soon.\n\nWarmly,\nCece\nMy Nest Chapter";
                $mail->send();
                $actionMsg = "Video link sent to {$clientEmail}.";
            } catch (MailException $e) {
                $actionErr = 'Mail error: ' . $e->getMessage();
            }
        }
    }

    // Update booking status
    if (isset($_POST['update_status'])) {
        $bid    = (int) ($_POST['booking_id'] ?? 0);
        $status = $_POST['new_status'] ?? '';
        $validStatuses = ['pending', 'confirmed', 'cancelled'];
        if ($bid > 0 && in_array($status, $validStatuses, true)) {
            try {
                $pdo  = getDB();
                $stmt = $pdo->prepare('UPDATE bookings SET status = ? WHERE id = ?');
                $stmt->execute([$status, $bid]);
                $actionMsg = 'Status updated.';
            } catch (\PDOException $e) {
                $actionErr = 'DB error: ' . $e->getMessage();
            }
        }
    }
}

// ── Fetch bookings ───────────────────────────────────────────
try {
    $pdo      = getDB();
    $filter   = $_GET['status'] ?? 'all';
    $validF   = ['all', 'pending', 'confirmed', 'cancelled'];
    if (!in_array($filter, $validF, true)) $filter = 'all';

    if ($filter === 'all') {
        $bookings = $pdo->query('SELECT * FROM bookings ORDER BY booking_date ASC, booking_time ASC')->fetchAll();
    } else {
        $stmt = $pdo->prepare('SELECT * FROM bookings WHERE status = ? ORDER BY booking_date ASC, booking_time ASC');
        $stmt->execute([$filter]);
        $bookings = $stmt->fetchAll();
    }
} catch (\PDOException $e) {
    $bookings = [];
    $actionErr = 'Could not load bookings: ' . $e->getMessage();
}
?>

<style>
.bk-filter-bar { display:flex; gap:8px; flex-wrap:wrap; margin-bottom:24px; }
.bk-filter-btn {
    padding:6px 16px;
    font-family:'Montserrat',Arial,sans-serif;
    font-weight:800;
    font-size:11px;
    letter-spacing:1px;
    text-transform:uppercase;
    border:2px solid #DDD6F0;
    background:#fff;
    color:#252535;
    text-decoration:none;
    cursor:pointer;
}
.bk-filter-btn.active { background:#252535; color:#FFF8EE; border-color:#252535; }
.bk-filter-btn:hover:not(.active) { border-color:#E87AAA; color:#E87AAA; }

.bk-table-wrap { overflow-x:auto; }
table.bk-table { width:100%; border-collapse:collapse; font-size:13px; }
.bk-table th {
    text-align:left;
    padding:10px 12px;
    font-family:'Montserrat',Arial,sans-serif;
    font-weight:800;
    font-size:10px;
    letter-spacing:1.5px;
    text-transform:uppercase;
    background:#252535;
    color:#FFF8EE;
    white-space:nowrap;
}
.bk-table td {
    padding:12px 12px;
    border-bottom:1px solid #e5e0d9;
    vertical-align:middle;
    color:#252535;
    background:#fff;
}
.bk-table tr:hover td { background:#faf8f4; }

.bk-name { font-weight:bold; }
.bk-email { font-size:12px; color:#5a5a72; }
.bk-phone { font-size:12px; color:#9b9ba8; }

.bk-date { white-space:nowrap; font-weight:bold; }
.bk-time { font-size:12px; color:#5a5a72; }

.bk-pref { font-size:13px; }

.bk-msg { font-size:12px; color:#5a5a72; max-width:200px; }

.status-badge {
    display:inline-block;
    padding:3px 10px;
    font-family:'Montserrat',Arial,sans-serif;
    font-weight:800;
    font-size:10px;
    letter-spacing:1px;
    text-transform:uppercase;
}
.status-pending   { background:#EEE8F8; color:#252535; }
.status-confirmed { background:#edf7e6; color:#2d6a1e; }
.status-cancelled { background:#fde8e8; color:#7a1a1a; }

.bk-status-form { display:flex; gap:6px; align-items:center; }
.bk-status-select {
    font-family:Arial,sans-serif;
    font-size:12px;
    padding:4px 8px;
    border:1.5px solid #C4B0E8;
    background:#fff;
    color:#252535;
    cursor:pointer;
}
.bk-status-btn {
    padding:4px 10px;
    font-family:'Montserrat',Arial,sans-serif;
    font-weight:800;
    font-size:10px;
    letter-spacing:1px;
    text-transform:uppercase;
    background:#C4B0E8;
    color:#252535;
    border:none;
    cursor:pointer;
}
.bk-status-btn:hover { background:#E87AAA; color:#fff; }

.btn-send-link {
    padding:5px 12px;
    font-family:'Montserrat',Arial,sans-serif;
    font-weight:800;
    font-size:10px;
    letter-spacing:1px;
    text-transform:uppercase;
    background:#A8C5DA;
    color:#252535;
    border:none;
    cursor:pointer;
    white-space:nowrap;
}
.btn-send-link:hover { background:#8BA7D4; color:#fff; }

.bk-video-form { display:flex; flex-direction:column; gap:4px; }
.bk-video-input {
    font-family:Arial,sans-serif;
    font-size:12px;
    padding:4px 8px;
    border:1.5px solid #C4B0E8;
    width:180px;
    color:#252535;
}
.bk-video-input:focus { border-color:#E87AAA; outline:none; }

.text-muted { color:#9b9ba8; font-size:12px; }
.bk-empty { text-align:center; padding:48px 0; color:#9b9ba8; font-size:14px; }
</style>

<div class="section-header">
    <span class="section-title">Bookings</span>
</div>

<?php if ($actionMsg): ?>
    <div class="alert alert-success" style="margin-bottom:16px;"><?= htmlspecialchars($actionMsg) ?></div>
<?php endif; ?>
<?php if ($actionErr): ?>
    <div class="alert alert-error" style="margin-bottom:16px;"><?= htmlspecialchars($actionErr) ?></div>
<?php endif; ?>

<!-- Filter bar -->
<div class="bk-filter-bar">
    <?php foreach (['all' => 'All', 'pending' => 'Pending', 'confirmed' => 'Confirmed', 'cancelled' => 'Cancelled'] as $val => $label): ?>
        <a href="?page=bookings&status=<?= $val ?>"
           class="bk-filter-btn <?= $filter === $val ? 'active' : '' ?>">
            <?= $label ?>
        </a>
    <?php endforeach; ?>
</div>

<!-- Table -->
<div class="bk-table-wrap">
    <?php if (empty($bookings)): ?>
        <p class="bk-empty">No bookings yet.</p>
    <?php else: ?>
    <table class="bk-table">
        <thead>
            <tr>
                <th>Client</th>
                <th>Date &amp; Time</th>
                <th>How</th>
                <th>Notes</th>
                <th>Status</th>
                <th>Video Link</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($bookings as $b): ?>
            <tr>
                <!-- Client -->
                <td>
                    <div class="bk-name"><?= htmlspecialchars($b['first_name']) ?></div>
                    <div class="bk-email"><?= htmlspecialchars($b['email']) ?></div>
                    <?php if ($b['phone']): ?>
                        <div class="bk-phone"><?= htmlspecialchars($b['phone']) ?></div>
                    <?php endif; ?>
                </td>

                <!-- Date & Time -->
                <td>
                    <div class="bk-date"><?= date('D, M j, Y', strtotime($b['booking_date'])) ?></div>
                    <div class="bk-time"><?= date('g:i A', strtotime('2000-01-01 ' . $b['booking_time'])) ?></div>
                </td>

                <!-- Communication pref -->
                <td class="bk-pref"><?= htmlspecialchars($b['comm_pref']) ?></td>

                <!-- Notes -->
                <td class="bk-msg">
                    <?= $b['message'] ? htmlspecialchars(mb_strimwidth($b['message'], 0, 120, '…')) : '<span class="text-muted">—</span>' ?>
                </td>

                <!-- Status -->
                <td>
                    <span class="status-badge status-<?= htmlspecialchars($b['status']) ?>">
                        <?= htmlspecialchars($b['status']) ?>
                    </span>
                    <form method="POST" class="bk-status-form" style="margin-top:6px;">
                        <input type="hidden" name="booking_id" value="<?= (int) $b['id'] ?>">
                        <select name="new_status" class="bk-status-select">
                            <?php foreach (['pending','confirmed','cancelled'] as $s): ?>
                                <option value="<?= $s ?>" <?= $b['status'] === $s ? 'selected' : '' ?>>
                                    <?= ucfirst($s) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" name="update_status" class="bk-status-btn">Save</button>
                    </form>
                </td>

                <!-- Video Link (user-supplied snippet, extended with URL input) -->
                <td>
                    <?php if (strpos($b['comm_pref'], 'Video Call') !== false): ?>
                        <form method="POST" class="bk-video-form">
                            <input type="hidden" name="client_email"  value="<?= htmlspecialchars($b['email']) ?>">
                            <input type="hidden" name="client_name"   value="<?= htmlspecialchars($b['first_name']) ?>">
                            <input type="hidden" name="booking_date"  value="<?= htmlspecialchars($b['booking_date']) ?>">
                            <input type="hidden" name="booking_time"  value="<?= htmlspecialchars($b['booking_time']) ?>">
                            <input type="text" name="video_url" class="bk-video-input"
                                   placeholder="Paste Zoom / Meet link"
                                   required>
                            <button type="submit" name="send_video_link" class="btn-send-link"
                                    onclick="return confirm('Send this video link to <?= htmlspecialchars(addslashes($b['first_name'])) ?>?');">
                                &#x2709;&#xfe0f; Send Video Link
                            </button>
                        </form>
                    <?php else: ?>
                        <span class="text-muted">N/A</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
