<?php
// ============================================================
// booking.php — Book a time with Cece
// PHPMailer files go in: site/includes/phpmailer/
//   PHPMailer.php, SMTP.php, Exception.php
// Add to site/includes/config.php:
//   define('MAIL_PASS', 'your-cc@mynestchapter.com-password');
// ============================================================

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';

require_once __DIR__ . '/includes/phpmailer/PHPMailer.php';
require_once __DIR__ . '/includes/phpmailer/SMTP.php';
require_once __DIR__ . '/includes/phpmailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;

const MAIL_HOST      = 'smtp.hostinger.com';
const MAIL_PORT      = 465;
const MAIL_USER      = 'cece@mynestchapter.com';
const MAIL_FROM_NAME = 'Cece at My Nest Chapter';
const ADMIN_EMAIL    = 'cece@mynestchapter.com';

// ── Helpers ──────────────────────────────────────────────────

function getTimeSlots(): array {
    $slots = [];
    for ($h = 9; $h <= 16; $h++) {
        foreach ([0, 30] as $m) {
            if ($h === 16 && $m === 30) break;
            $slots[] = sprintf('%02d:%02d', $h, $m);
        }
    }
    return $slots;
}

function getAvailableDates(): array {
    $dates = [];
    for ($i = 0; count($dates) < 30; $i++) {
        $ts  = strtotime("+$i days");
        $dow = (int) date('N', $ts);
        if ($dow >= 1 && $dow <= 5) {
            $dates[] = date('Y-m-d', $ts);
        }
        if ($i > 90) break;
    }
    return $dates;
}

function formatDisplayTime(string $t): string {
    return date('g:i A', strtotime("2000-01-01 $t"));
}

function formatDisplayDate(string $d): string {
    return date('l, F j, Y', strtotime($d));
}

// ── Handle POST ──────────────────────────────────────────────

$errors  = [];
$success = false;
$form    = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name   = trim($_POST['first_name']   ?? '');
    $email        = trim($_POST['email']        ?? '');
    $phone        = trim($_POST['phone']        ?? '');
    $comm_pref    = trim($_POST['comm_pref']    ?? '');
    $message      = trim($_POST['message']      ?? '');
    $booking_date = trim($_POST['booking_date'] ?? '');
    $booking_time = trim($_POST['booking_time'] ?? '');

    $form = compact('first_name','email','phone','comm_pref','message','booking_date','booking_time');

    // Validate
    if ($first_name === '') $errors[] = 'Please share your name or nickname.';
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    $validPrefs = ['💬 Text Chat', '📞 Voice Call', '🎥 Video Call'];
    if (!in_array($comm_pref, $validPrefs, true)) {
        $errors[] = 'Please choose how you\'d like to connect.';
    }

    if ($booking_date === '') {
        $errors[] = 'Please select a date.';
    } else {
        $dateTs = strtotime($booking_date);
        if ($dateTs === false || (int) date('N', $dateTs) > 5) {
            $errors[] = 'Please pick a weekday (Monday–Friday).';
        }
        if ($dateTs < strtotime('today')) {
            $errors[] = 'Please select a future date.';
        }
    }

    $validSlots = getTimeSlots();
    if ($booking_time === '' || !in_array($booking_time, $validSlots, true)) {
        $errors[] = 'Please select a valid time slot.';
    } elseif ($booking_date !== '') {
        $bookingTs = strtotime($booking_date . ' ' . $booking_time);
        if ($bookingTs !== false && $bookingTs < time() + 7200) {
            $errors[] = 'Please book at least 2 hours in advance.';
        }
    }

    if (empty($errors)) {
        try {
            $pdo  = getDB();
            $stmt = $pdo->prepare(
                'INSERT INTO bookings (first_name, email, phone, comm_pref, message, booking_date, booking_time)
                 VALUES (?, ?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute([
                $first_name,
                $email,
                $phone   ?: null,
                $comm_pref,
                $message ?: null,
                $booking_date,
                $booking_time,
            ]);

            $displayDate = formatDisplayDate($booking_date);
            $displayTime = formatDisplayTime($booking_time);

            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host       = MAIL_HOST;
                $mail->SMTPAuth   = true;
                $mail->Username   = MAIL_USER;
                $mail->Password   = defined('MAIL_PASS') ? MAIL_PASS : '';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = MAIL_PORT;
                $mail->CharSet    = 'UTF-8';
                $mail->setFrom(MAIL_USER, MAIL_FROM_NAME);

                // Email 1 — admin notification
                $mail->addAddress(ADMIN_EMAIL, 'Cece');
                $mail->Subject = "New Booking: {$first_name} — {$displayDate} at {$displayTime}";
                $mail->isHTML(false);
                $phoneStr = $phone   ?: 'Not provided';
                $msgStr   = $message ?: 'No message left';
                $mail->Body =
                    "New booking received!\n\n" .
                    "Name:              {$first_name}\n" .
                    "Email:             {$email}\n" .
                    "Phone:             {$phoneStr}\n" .
                    "How we'll connect: {$comm_pref}\n" .
                    "Date:              {$displayDate}\n" .
                    "Time:              {$displayTime}\n\n" .
                    "What they'd like to talk about:\n{$msgStr}";
                $mail->send();

                // Email 2 — client confirmation
                $mail->clearAllRecipients();
                $mail->addAddress($email, $first_name);
                $mail->Subject = "Got your message, {$first_name} \xe2\x80\x94 I\xe2\x80\x99m looking forward to our chat";
                $mail->Body =
                    "Hi {$first_name},\n\n" .
                    "Thank you so much for reaching out and scheduling a time to connect. I want you to know that " .
                    "this is a completely safe, private, and judgment-free space, and I am here to listen to " .
                    "whatever is on your mind.\n\n" .
                    "\xf0\x9f\x97\x93\xef\xb8\x8f Date: {$displayDate}\n" .
                    "\xe2\x8f\xb0\xef\xb8\x8f Time: {$displayTime}\n" .
                    "\xf0\x9f\x92\xac How we\xe2\x80\x99ll connect: {$comm_pref}\n\n" .
                    "What happens next: If you chose a Phone Call, I will give you a call directly at our start time. " .
                    "If you chose Video or Text Chat, I will email you a direct link about 15 minutes before we begin.\n\n" .
                    "Take a deep breath. You are not alone, and I look forward to talking with you soon.\n\n" .
                    "Warmly,\nCece\nMy Nest Chapter";
                $mail->send();

            } catch (MailException $e) {
                error_log('Booking mail error: ' . $e->getMessage());
                // Booking saved — don't block success on mail failure
            }

            $success = true;

        } catch (\PDOException $e) {
            error_log('Booking DB error: ' . $e->getMessage());
            $errors[] = 'Something went wrong saving your booking. Please try again or email me directly at cece@mynestchapter.com.';
        }
    }
}

$availableDates = getAvailableDates();
$timeSlots      = getTimeSlots();

$pageTitle       = 'Book a Time with Cece';
$pageDescription = 'Schedule a private, warm, judgment-free conversation with Cece at My Nest Chapter.';

require_once __DIR__ . '/includes/header.php';
?>

<style>
.booking-hero {
    background: #252535;
    padding: 64px 24px 56px;
    text-align: center;
}
.booking-hero-eyebrow {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 11px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #E87AAA;
    margin-bottom: 14px;
}
.booking-hero-heading {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: clamp(22px, 4vw, 36px);
    color: #FFF8EE;
    line-height: 1.3;
    margin-bottom: 16px;
}
.booking-hero-sub {
    font-family: Arial, sans-serif;
    font-size: 16px;
    color: rgba(255,248,238,0.72);
    line-height: 1.7;
    max-width: 560px;
    margin: 0 auto;
}

.booking-section {
    background: #FFF8EE;
    padding: 64px 24px 80px;
}
.booking-wrap {
    max-width: 600px;
    margin: 0 auto;
}

.booking-errors {
    background: #fde8e8;
    border-left: 4px solid #E87AAA;
    padding: 16px 20px;
    margin-bottom: 28px;
    font-family: Arial, sans-serif;
    font-size: 14px;
    color: #7a1a1a;
    line-height: 1.6;
}
.booking-errors ul { margin: 8px 0 0 16px; }

.booking-success {
    background: #EEE8F8;
    border-left: 4px solid #C4B0E8;
    padding: 40px 32px;
    text-align: center;
}
.booking-success h2 {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 22px;
    color: #252535;
    margin-bottom: 14px;
}
.booking-success p {
    font-family: Arial, sans-serif;
    font-size: 15px;
    color: #5a5a72;
    line-height: 1.7;
}

.booking-intro {
    font-family: Arial, sans-serif;
    font-size: 15px;
    color: #5a5a72;
    line-height: 1.7;
    margin-bottom: 28px;
}

.booking-form { display: flex; flex-direction: column; gap: 22px; }

.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-label {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 11px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #252535;
}
.form-label .optional {
    font-weight: 400;
    font-family: Arial, sans-serif;
    font-size: 11px;
    letter-spacing: 0;
    color: #9b9ba8;
    text-transform: none;
}
.form-input,
.form-select,
.form-textarea {
    width: 100%;
    padding: 13px 16px;
    border: 1.5px solid #C4B0E8;
    border-radius: 0;
    font-family: Arial, sans-serif;
    font-size: 15px;
    color: #252535;
    background: #fff;
    outline: none;
    transition: border-color 0.2s;
    box-sizing: border-box;
    -webkit-appearance: none;
    appearance: none;
}
.form-input:focus,
.form-select:focus,
.form-textarea:focus { border-color: #E87AAA; }

.form-select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23C4B0E8' stroke-width='2' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 16px center;
    padding-right: 40px;
    cursor: pointer;
}
.form-textarea {
    resize: vertical;
    min-height: 110px;
    line-height: 1.6;
}
.form-hint {
    font-family: Arial, sans-serif;
    font-size: 12px;
    color: #9b9ba8;
}

.row-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}
.booking-divider {
    height: 1px;
    background: #DDD6F0;
    margin: 4px 0;
}

.booking-submit {
    display: inline-block;
    background: #E87AAA;
    color: #fff;
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 13px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    padding: 16px 40px;
    border: none;
    border-radius: 9999px;
    cursor: pointer;
    transition: background 0.2s;
    align-self: flex-start;
    margin-top: 6px;
}
.booking-submit:hover { background: #d9608f; }

.booking-privacy {
    font-family: Arial, sans-serif;
    font-size: 13px;
    color: #9b9ba8;
    font-style: italic;
}

@media (max-width: 520px) {
    .row-2 { grid-template-columns: 1fr; }
    .booking-submit { width: 100%; text-align: center; }
}
</style>

<!-- HERO -->
<section class="booking-hero">
    <p class="booking-hero-eyebrow">One Conversation at a Time</p>
    <h1 class="booking-hero-heading">Book a Time with Cece</h1>
    <p class="booking-hero-sub">This is a private, low-pressure space. Come as you are. Say as little or as much as you want. I'm here.</p>
</section>

<!-- FORM SECTION -->
<section class="booking-section">
    <div class="booking-wrap">

    <?php if ($success): ?>

        <div class="booking-success">
            <h2>You're on my calendar.</h2>
            <p>Check your inbox — I sent you a confirmation with everything you need.<br>
            If anything comes up, just reply to that email.<br><br>
            I'm looking forward to talking with you.</p>
        </div>

    <?php else: ?>

        <?php if (!empty($errors)): ?>
        <div class="booking-errors">
            <strong>Just a couple of things to check:</strong>
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <p class="booking-intro">Fill in a few details and we'll get something on the calendar. Nothing you share here leaves this conversation.</p>

        <form class="booking-form" method="POST" action="/booking">

            <!-- Name -->
            <div class="form-group">
                <label class="form-label" for="first_name">First Name or Nickname</label>
                <input class="form-input" type="text" id="first_name" name="first_name"
                       value="<?= htmlspecialchars($form['first_name'] ?? '') ?>"
                       placeholder="Whatever you go by is fine" required>
            </div>

            <!-- Email + Phone -->
            <div class="row-2">
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input class="form-input" type="email" id="email" name="email"
                           value="<?= htmlspecialchars($form['email'] ?? '') ?>"
                           placeholder="your@email.com" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="phone">Phone <span class="optional">(optional)</span></label>
                    <input class="form-input" type="tel" id="phone" name="phone"
                           value="<?= htmlspecialchars($form['phone'] ?? '') ?>"
                           placeholder="Only if you choose Voice Call">
                </div>
            </div>

            <!-- Communication Preference -->
            <div class="form-group">
                <label class="form-label" for="comm_pref">How Would You Like to Connect?</label>
                <select class="form-select" id="comm_pref" name="comm_pref" required>
                    <option value="" disabled <?= empty($form['comm_pref']) ? 'selected' : '' ?>>Choose one...</option>
                    <?php foreach (['💬 Text Chat', '📞 Voice Call', '🎥 Video Call'] as $opt): ?>
                        <option value="<?= htmlspecialchars($opt) ?>"
                            <?= ($form['comm_pref'] ?? '') === $opt ? 'selected' : '' ?>>
                            <?= $opt ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="booking-divider"></div>

            <!-- Date + Time -->
            <div class="row-2">
                <div class="form-group">
                    <label class="form-label" for="booking_date">Date</label>
                    <select class="form-select" id="booking_date" name="booking_date" required>
                        <option value="" disabled <?= empty($form['booking_date']) ? 'selected' : '' ?>>Pick a date...</option>
                        <?php foreach ($availableDates as $d): ?>
                            <option value="<?= $d ?>"
                                data-is-today="<?= ($d === date('Y-m-d')) ? '1' : '0' ?>"
                                <?= ($form['booking_date'] ?? '') === $d ? 'selected' : '' ?>>
                                <?= date('D, M j', strtotime($d)) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="form-hint">Monday–Friday only</span>
                </div>
                <div class="form-group">
                    <label class="form-label" for="booking_time">Time</label>
                    <select class="form-select" id="booking_time" name="booking_time" required>
                        <option value="" disabled <?= empty($form['booking_time']) ? 'selected' : '' ?>>Pick a time...</option>
                        <?php foreach ($timeSlots as $slot): ?>
                            <option value="<?= $slot ?>"
                                data-h="<?= (int) explode(':', $slot)[0] ?>"
                                data-m="<?= (int) explode(':', $slot)[1] ?>"
                                <?= ($form['booking_time'] ?? '') === $slot ? 'selected' : '' ?>>
                                <?= formatDisplayTime($slot) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="form-hint">9:00 AM – 4:30 PM &nbsp;·&nbsp; Book 2 hrs ahead</span>
                </div>
            </div>

            <div class="booking-divider"></div>

            <!-- Message -->
            <div class="form-group">
                <label class="form-label" for="message">
                    What would you like to talk about today?
                    <span class="optional">(Optional)</span>
                </label>
                <textarea class="form-textarea" id="message" name="message"
                          placeholder="Share whatever feels right — or leave this blank. There's no wrong way to show up."><?= htmlspecialchars($form['message'] ?? '') ?></textarea>
            </div>

            <button type="submit" class="booking-submit">Book My Time &rarr;</button>
            <p class="booking-privacy">Your information stays private. No sharing, no selling, ever.</p>

        </form>

    <?php endif; ?>
    </div>
</section>

<script>
(function () {
    var dateSelect = document.getElementById('booking_date');
    var timeSelect = document.getElementById('booking_time');
    if (!dateSelect || !timeSelect) return;

    var now = new Date();
    var bufferMs = 2 * 60 * 60 * 1000;

    function filterTimes() {
        var selectedDate = dateSelect.value;
        var todayStr = now.getFullYear() + '-' +
            String(now.getMonth() + 1).padStart(2, '0') + '-' +
            String(now.getDate()).padStart(2, '0');
        var isToday = selectedDate === todayStr;
        var cutoff = new Date(now.getTime() + bufferMs);

        timeSelect.querySelectorAll('option[data-h]').forEach(function (opt) {
            var h = parseInt(opt.dataset.h, 10);
            var m = parseInt(opt.dataset.m, 10);
            if (isToday) {
                var slotTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), h, m);
                opt.disabled = slotTime <= cutoff;
            } else {
                opt.disabled = false;
            }
        });

        if (timeSelect.value && timeSelect.options[timeSelect.selectedIndex].disabled) {
            timeSelect.value = '';
        }
    }

    dateSelect.addEventListener('change', filterTimes);
    if (dateSelect.value) filterTimes();
})();
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
