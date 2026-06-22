<?php
/**
 * My Nest Chapter — Exclusive Freebie Unlock Notifications
 *
 * Set this up in Hostinger → Hosting → Cron Jobs:
 *   Command: php /home/u540670132/domains/mynestchapter.com/public_html/cron/send-exclusive-unlocks.php
 *   Schedule: 0 9 * * *   (runs daily at 9 AM server time)
 *
 * Finds every (member, queue_item) pair that has unlocked but not yet been
 * emailed, sends the unlock notification, and logs it to prevent re-sending.
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';

$db = getDB();

// Find all unlocked items that haven't been emailed yet
$stmt = $db->query("
    SELECT u.id as member_id, u.email, u.first_name, q.id as queue_id,
           q.title, q.sequence_number, q.description,
           DATEDIFF(NOW(), u.created_at) as days_as_member
    FROM users u
    CROSS JOIN exclusive_content_queue q
    WHERE q.unlock_offset_days <= DATEDIFF(NOW(), u.created_at)
      AND NOT EXISTS (
          SELECT 1 FROM member_freebie_notifications n
          WHERE n.member_id = u.id AND n.queue_item_id = q.id
      )
    ORDER BY u.id, q.sequence_number
");
$pending = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($pending)) {
    echo "No unlock notifications to send today.\n";
    exit;
}

$log   = $db->prepare("INSERT IGNORE INTO member_freebie_notifications (member_id, queue_item_id) VALUES (?, ?)");
$sent  = 0;
$fails = 0;

foreach ($pending as $row) {
    $firstName = htmlspecialchars($row['first_name']);
    $title     = htmlspecialchars($row['title']);
    $desc      = htmlspecialchars($row['description']);
    $dashLink  = 'https://mynestchapter.com/dashboard';

    $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head>
<body style="margin:0;padding:0;background:#FAFAFA;font-family:Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#FAFAFA;padding:40px 0;">
    <tr><td align="center">
      <table width="580" cellpadding="0" cellspacing="0" style="background:#FFFFFF;max-width:580px;width:100%;border:1px solid #E8E4F0;">

        <tr><td style="background:#252535;padding:24px 40px;">
          <p style="margin:0;font-family:Arial,sans-serif;font-weight:800;font-size:11px;letter-spacing:3px;text-transform:uppercase;color:#8BA7D4;">MY NEST CHAPTER</p>
        </td></tr>

        <tr><td style="padding:40px 40px 28px;">
          <p style="font-family:Arial,sans-serif;font-size:22px;font-weight:700;color:#252535;margin:0 0 6px;">Something new just unlocked.</p>
          <p style="font-family:Arial,sans-serif;font-size:14px;color:#8BA7D4;margin:0 0 24px;">For you, ' . $firstName . '</p>
          <p style="font-family:Arial,sans-serif;font-size:15px;color:#252535;line-height:1.7;margin:0 0 8px;font-weight:700;">' . $title . '</p>
          <p style="font-family:Arial,sans-serif;font-size:14px;color:#252535;line-height:1.7;margin:0 0 28px;">' . $desc . '</p>
        </td></tr>

        <tr><td style="padding:0 40px 28px;">
          <a href="' . $dashLink . '"
             style="display:inline-block;background:#E87AAA;color:#fff;font-family:Arial,sans-serif;font-weight:700;font-size:13px;text-transform:uppercase;letter-spacing:1px;padding:14px 28px;text-decoration:none;">
            Go to my dashboard
          </a>
        </td></tr>

        <tr><td style="padding:0 40px 40px;">
          <p style="font-family:Arial,sans-serif;font-size:14px;color:#8BA7D4;margin:0;">— Cece</p>
        </td></tr>

        <tr><td style="padding:20px 40px;border-top:1px solid #F0ECF8;">
          <p style="margin:0;font-family:Arial,sans-serif;font-size:12px;color:#ABABAB;line-height:1.6;">
            You\'re receiving this because you\'re a My Nest Chapter member.
            <a href="https://mynestchapter.com" style="color:#ABABAB;">mynestchapter.com</a>
          </p>
        </td></tr>

      </table>
    </td></tr>
  </table>
</body></html>';

    $mailed = mail(
        $row['email'],
        'You just unlocked: ' . $row['title'],
        $html,
        implode("\r\n", [
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=UTF-8',
            'From: Cece at My Nest Chapter <hello@mynestchapter.com>',
            'Reply-To: hello@mynestchapter.com',
        ])
    );

    if ($mailed) {
        $log->execute([$row['member_id'], $row['queue_id']]);
        echo "Sent to {$row['email']}: {$row['title']}\n";
        $sent++;
    } else {
        echo "FAILED: {$row['email']} — {$row['title']}\n";
        $fails++;
    }
}

echo "\nDone. Sent: $sent, Failed: $fails\n";
