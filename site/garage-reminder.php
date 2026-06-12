<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$data      = json_decode(file_get_contents('php://input'), true);
$email     = filter_var(trim($data['email'] ?? ''), FILTER_SANITIZE_EMAIL);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email']);
    exit;
}

$saleDate     = htmlspecialchars(strip_tags($data['sale_date']     ?? ''));
$saleTitle    = htmlspecialchars(strip_tags($data['sale_title']    ?? 'Garage Sale'));
$moneyPurpose = htmlspecialchars(strip_tags($data['money_purpose'] ?? ''));

if (!$saleDate || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $saleDate)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid sale date']);
    exit;
}

// Create table if it doesn't exist (runs once, harmless after)
$pdo->exec("CREATE TABLE IF NOT EXISTS sale_reminders (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    email      VARCHAR(255) NOT NULL,
    sale_date  DATE NOT NULL,
    sale_title VARCHAR(255),
    money_purpose TEXT,
    sent       TINYINT(1) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uq_reminder (email, sale_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

// Insert or update if same email + sale_date already exists
$stmt = $pdo->prepare(
    "INSERT INTO sale_reminders (email, sale_date, sale_title, money_purpose, sent)
     VALUES (:email, :sale_date, :sale_title, :money_purpose, 0)
     ON DUPLICATE KEY UPDATE sale_title=VALUES(sale_title), money_purpose=VALUES(money_purpose), sent=0"
);
$stmt->execute([
    ':email'         => $email,
    ':sale_date'     => $saleDate,
    ':sale_title'    => $saleTitle,
    ':money_purpose' => $moneyPurpose,
]);

// Send confirmation email
$saleDateFmt  = date('l, F j, Y', strtotime($saleDate));
$reminderDate = date('l, F j', strtotime($saleDate . ' -1 day'));

$html = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head>
<body style="margin:0;padding:0;background:#FAFAFA;font-family:Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#FAFAFA;padding:40px 0;">
    <tr><td align="center">
      <table width="580" cellpadding="0" cellspacing="0" style="background:#FFFFFF;max-width:580px;width:100%;border:1px solid #E8E4F0;">

        <tr><td style="background:#252535;padding:24px 40px;">
          <p style="margin:0;font-family:Arial,sans-serif;font-weight:800;font-size:11px;letter-spacing:3px;text-transform:uppercase;color:#8BA7D4;">MY NEST CHAPTER</p>
        </td></tr>

        <tr><td style="padding:40px 40px 28px;">
          <p style="font-family:Arial,sans-serif;font-size:22px;font-weight:700;color:#252535;margin:0 0 8px;">Reminder set.</p>
          <p style="font-family:Arial,sans-serif;font-size:14px;color:#8BA7D4;margin:0 0 24px;">' . $saleTitle . ' &nbsp;&middot;&nbsp; ' . $saleDateFmt . '</p>
          <p style="font-family:Arial,sans-serif;font-size:15px;color:#252535;line-height:1.7;margin:0 0 20px;">
            You will get an email on <strong>' . $reminderDate . '</strong> with a prep checklist and a direct link back to your planner. You do not need to do anything else.
          </p>
          ' . ($moneyPurpose ? '<div style="background:#FDEEF5;padding:18px 22px;margin-bottom:20px;">
            <p style="font-family:Arial,sans-serif;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#E87AAA;margin:0 0 4px;">What the money is for</p>
            <p style="font-family:Arial,sans-serif;font-size:14px;color:#252535;line-height:1.6;margin:0;">' . $moneyPurpose . '</p>
          </div>' : '') . '
          <p style="font-family:Arial,sans-serif;font-size:14px;color:#5A5A72;line-height:1.7;margin:0;">Keep going. The hardest part is the sorting.</p>
        </td></tr>

        <tr><td style="padding:20px 40px;border-top:1px solid #F0ECF8;">
          <p style="margin:0;font-family:Arial,sans-serif;font-size:12px;color:#ABABAB;line-height:1.6;">
            You\'re receiving this because you requested a reminder from the Garage Sale Planner at
            <a href="https://mynestchapter.com" style="color:#ABABAB;">mynestchapter.com</a>
          </p>
        </td></tr>

      </table>
    </td></tr>
  </table>
</body></html>';

mail(
    $email,
    'Reminder set — ' . $saleTitle . ' on ' . $saleDateFmt,
    $html,
    implode("\r\n", [
        'MIME-Version: 1.0',
        'Content-Type: text/html; charset=UTF-8',
        'From: Cece at My Nest Chapter <hello@mynestchapter.com>',
        'Reply-To: hello@mynestchapter.com',
    ])
);

http_response_code(200);
echo json_encode(['success' => true]);
