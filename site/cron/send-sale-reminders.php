<?php
/**
 * Garage Sale Planner — Day-Before Reminder Cron Script
 *
 * Set this up in Hostinger → Hosting → Cron Jobs:
 *   Command: php /home/u540670132/domains/mynestchapter.com/public_html/cron/send-sale-reminders.php
 *   Schedule: 0 8 * * *   (runs daily at 8 AM server time)
 *
 * Sends a reminder email to anyone whose sale is tomorrow.
 * Marks the record as sent so it won't fire again.
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';

// Find all unsent reminders where the sale is tomorrow
$stmt = $pdo->prepare(
    "SELECT * FROM sale_reminders
     WHERE sale_date = CURDATE() + INTERVAL 1 DAY
       AND sent = 0"
);
$stmt->execute();
$reminders = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($reminders)) {
    echo "No reminders to send today.\n";
    exit;
}

$prepChecklist = [
    "Gather tables, racks, or folding surfaces",
    "Sort cash — $1 bills, $5 bills, and quarters",
    "Print or write price tags for individual items",
    "Confirm your sign plan and pickup time for signs",
    "Charge your phone and pack a portable charger",
    "Tell someone your sale hours",
    "Prep your checkout area — bag, fanny pack, digital payment app",
    "Set out water, sunscreen, and a chair for yourself",
    "Choose your leftovers plan now so nothing sneaks back inside",
];

foreach ($reminders as $reminder) {
    $email        = $reminder['email'];
    $saleTitle    = htmlspecialchars($reminder['sale_title'] ?? 'Garage Sale');
    $saleDateFmt  = date('l, F j, Y', strtotime($reminder['sale_date']));
    $moneyPurpose = htmlspecialchars($reminder['money_purpose'] ?? '');

    $checklistHtml = '';
    foreach ($prepChecklist as $item) {
        $checklistHtml .= '
            <tr>
              <td style="padding:10px 0;border-bottom:1px solid #F0ECF8;">
                <span style="font-family:Arial,sans-serif;font-size:14px;color:#252535;">&#9633; &nbsp;' . $item . '</span>
              </td>
            </tr>';
    }

    $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head>
<body style="margin:0;padding:0;background:#FAFAFA;font-family:Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#FAFAFA;padding:40px 0;">
    <tr><td align="center">
      <table width="580" cellpadding="0" cellspacing="0" style="background:#FFFFFF;max-width:580px;width:100%;border:1px solid #E8E4F0;">

        <tr><td style="background:#252535;padding:24px 40px;">
          <p style="margin:0;font-family:Arial,sans-serif;font-weight:800;font-size:11px;letter-spacing:3px;text-transform:uppercase;color:#8BA7D4;">MY NEST CHAPTER</p>
        </td></tr>

        <tr><td style="padding:40px 40px 28px;">
          <p style="font-family:Arial,sans-serif;font-size:22px;font-weight:700;color:#252535;margin:0 0 6px;">Your sale is tomorrow.</p>
          <p style="font-family:Arial,sans-serif;font-size:14px;color:#8BA7D4;margin:0 0 24px;">' . $saleTitle . ' &nbsp;&middot;&nbsp; ' . $saleDateFmt . '</p>
          <p style="font-family:Arial,sans-serif;font-size:15px;color:#252535;line-height:1.7;margin:0 0 28px;">
            Here is a quick checklist to get ready. Everything you put into your planner is waiting for you when you get there.
          </p>
        </td></tr>

        <tr><td style="padding:0 40px 28px;">
          <p style="font-family:Arial,sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:#E87AAA;margin:0 0 12px;">Day-Before Checklist</p>
          <table width="100%" cellpadding="0" cellspacing="0">' . $checklistHtml . '</table>
        </td></tr>

        <tr><td style="padding:0 40px 28px;">
          <a href="https://mynestchapter.com/widgets/garage-sale-planner/"
             style="display:inline-block;background:#E87AAA;color:#fff;font-family:Arial,sans-serif;font-weight:700;font-size:13px;text-transform:uppercase;letter-spacing:1px;padding:14px 28px;text-decoration:none;">
            Open my planner
          </a>
        </td></tr>

        ' . ($moneyPurpose ? '<tr><td style="padding:0 40px 28px;">
          <div style="background:#FDEEF5;padding:18px 22px;">
            <p style="font-family:Arial,sans-serif;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#E87AAA;margin:0 0 4px;">What the money is for</p>
            <p style="font-family:Arial,sans-serif;font-size:14px;color:#252535;line-height:1.6;margin:0;">' . $moneyPurpose . '</p>
          </div>
        </td></tr>' : '') . '

        <tr><td style="padding:0 40px 40px;">
          <p style="font-family:Arial,sans-serif;font-size:14px;color:#252535;line-height:1.7;margin:0 0 8px;">You have done the hard part. Tomorrow is just showing up. You have got this.</p>
          <p style="font-family:Arial,sans-serif;font-size:14px;color:#8BA7D4;margin:0;">— Cece</p>
        </td></tr>

        <tr><td style="padding:20px 40px;border-top:1px solid #F0ECF8;">
          <p style="margin:0;font-family:Arial,sans-serif;font-size:12px;color:#ABABAB;line-height:1.6;">
            You requested this reminder from the Garage Sale Planner at
            <a href="https://mynestchapter.com" style="color:#ABABAB;">mynestchapter.com</a>
          </p>
        </td></tr>

      </table>
    </td></tr>
  </table>
</body></html>';

    $sent = mail(
        $email,
        'Your sale is tomorrow — ' . $saleTitle,
        $html,
        implode("\r\n", [
            'MIME-Version: 1.0',
            'Content-Type: text/html; charset=UTF-8',
            'From: Cece at My Nest Chapter <hello@mynestchapter.com>',
            'Reply-To: hello@mynestchapter.com',
        ])
    );

    if ($sent) {
        $upd = $pdo->prepare("UPDATE sale_reminders SET sent = 1 WHERE id = :id");
        $upd->execute([':id' => $reminder['id']]);
        echo "Sent reminder to {$email} for {$reminder['sale_date']}\n";
    } else {
        echo "Failed to send to {$email}\n";
    }
}

echo "Done. Processed " . count($reminders) . " reminder(s).\n";
