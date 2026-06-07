<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(200); exit; }
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }

$data  = json_decode(file_get_contents('php://input'), true);
$email = filter_var(trim($data['email'] ?? ''), FILTER_SANITIZE_EMAIL);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email']);
    exit;
}

$saleTitle      = htmlspecialchars(strip_tags($data['sale_title']      ?? 'My Garage Sale'));
$saleDate       = htmlspecialchars(strip_tags($data['sale_date']       ?? ''));
$moneyPurpose   = htmlspecialchars(strip_tags($data['money_purpose']   ?? ''));
$totalEarned    = htmlspecialchars(strip_tags($data['total_earned']    ?? '0.00'));
$moneyGoal      = htmlspecialchars(strip_tags($data['money_goal']      ?? ''));
$goalProgress   = (int)($data['goal_progress'] ?? 0);
$totalItems     = (int)($data['total_items']   ?? 0);
$garageSaleItems= (int)($data['garage_sale_items'] ?? 0);
$onlineItems    = (int)($data['online_items']  ?? 0);
$donateItems    = (int)($data['donate_items']  ?? 0);
$totalTx        = (int)($data['total_transactions'] ?? 0);
$donate         = htmlspecialchars(strip_tags($data['leftovers_donate']      ?? ''));
$sellOnline     = htmlspecialchars(strip_tags($data['leftovers_sell_online'] ?? ''));
$keep           = htmlspecialchars(strip_tags($data['leftovers_keep']        ?? ''));
$trash          = htmlspecialchars(strip_tags($data['leftovers_trash']       ?? ''));
$lessons        = htmlspecialchars(strip_tags($data['lessons_learned']       ?? ''));

$apiToken = '6MIeMuGCJNf9Fp6NpRLB2xCAW5mmy2gIXQyKxdmS1e9982ba';
$baseUrl  = 'https://developers.hostinger.com/api/reach/v1';
$segment  = 'a2728a84-f141-4023-a8a7-f2bfa20b4eb9';

// ── Add to Reach ──────────────────────────────────────────────────────────────
$ch = curl_init($baseUrl . '/contacts');
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => json_encode(['email' => $email]),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiToken, 'Content-Type: application/json', 'Accept: application/json'],
]);
$response    = curl_exec($ch);
$httpCode    = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$contact     = json_decode($response, true);
$contactUuid = $contact['uuid'] ?? null;

if ($contactUuid) {
    $ch2 = curl_init($baseUrl . '/segments/' . $segment . '/contacts');
    curl_setopt_array($ch2, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode(['contact_uuid' => $contactUuid]),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiToken, 'Content-Type: application/json', 'Accept: application/json'],
    ]);
    curl_exec($ch2);
    curl_close($ch2);
}

// ── Build email HTML ──────────────────────────────────────────────────────────
$saleDateFmt = $saleDate ? date('F j, Y', strtotime($saleDate)) : '';
$goalRow     = $moneyGoal ? '
  <tr>
    <td style="padding:10px 0;border-bottom:1px solid #F0ECF8;">
      <span style="font-family:Arial,sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#8BA7D4;">Goal</span>
    </td>
    <td style="padding:10px 0;border-bottom:1px solid #F0ECF8;text-align:right;">
      <span style="font-family:Arial,sans-serif;font-size:15px;font-weight:700;color:#252535;">$' . $moneyGoal . ' (' . $goalProgress . '% reached)</span>
    </td>
  </tr>' : '';

function wrapRow($label, $value) {
    if (!$value) return '';
    return '
  <tr>
    <td colspan="2" style="padding:12px 0;border-bottom:1px solid #F0ECF8;">
      <div style="font-family:Arial,sans-serif;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#8BA7D4;margin-bottom:4px;">' . $label . '</div>
      <div style="font-family:Arial,sans-serif;font-size:14px;color:#252535;line-height:1.6;">' . nl2br($value) . '</div>
    </td>
  </tr>';
}

$html = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head>
<body style="margin:0;padding:0;background:#FAFAFA;font-family:Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#FAFAFA;padding:40px 0;">
    <tr><td align="center">
      <table width="580" cellpadding="0" cellspacing="0" style="background:#FFFFFF;max-width:580px;width:100%;border:1px solid #E8E4F0;">

        <!-- Header -->
        <tr><td style="background:#252535;padding:24px 40px;">
          <p style="margin:0;font-family:Arial,sans-serif;font-weight:800;font-size:11px;letter-spacing:3px;text-transform:uppercase;color:#8BA7D4;">MY NEST CHAPTER</p>
        </td></tr>

        <!-- Hero -->
        <tr><td style="padding:40px 40px 28px;">
          <p style="font-family:Georgia,serif;font-size:24px;font-weight:bold;color:#252535;margin:0 0 6px;">' . $saleTitle . '</p>
          ' . ($saleDateFmt ? '<p style="font-family:Arial,sans-serif;font-size:13px;color:#8BA7D4;margin:0 0 28px;">' . $saleDateFmt . '</p>' : '') . '
          <p style="font-family:Arial,sans-serif;font-size:15px;color:#252535;line-height:1.7;margin:0 0 28px;">Here&rsquo;s a record of your sale &mdash; what you earned, where things went, and what you learned. Keep this somewhere you can find it.</p>
        </td></tr>

        <!-- Numbers -->
        <tr><td style="padding:0 40px 28px;">
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td style="padding:10px 0;border-bottom:1px solid #F0ECF8;">
                <span style="font-family:Arial,sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#8BA7D4;">Total earned</span>
              </td>
              <td style="padding:10px 0;border-bottom:1px solid #F0ECF8;text-align:right;">
                <span style="font-family:Georgia,serif;font-size:22px;font-weight:bold;color:#E87AAA;">$' . $totalEarned . '</span>
              </td>
            </tr>
            ' . $goalRow . '
            <tr>
              <td style="padding:10px 0;border-bottom:1px solid #F0ECF8;">
                <span style="font-family:Arial,sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#8BA7D4;">Items</span>
              </td>
              <td style="padding:10px 0;border-bottom:1px solid #F0ECF8;text-align:right;">
                <span style="font-family:Arial,sans-serif;font-size:15px;font-weight:700;color:#252535;">' . $totalItems . ' total &nbsp;&middot;&nbsp; ' . $garageSaleItems . ' for sale &nbsp;&middot;&nbsp; ' . $onlineItems . ' online &nbsp;&middot;&nbsp; ' . $donateItems . ' donated</span>
              </td>
            </tr>
            <tr>
              <td style="padding:10px 0;border-bottom:1px solid #F0ECF8;">
                <span style="font-family:Arial,sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#8BA7D4;">Transactions</span>
              </td>
              <td style="padding:10px 0;border-bottom:1px solid #F0ECF8;text-align:right;">
                <span style="font-family:Arial,sans-serif;font-size:15px;font-weight:700;color:#252535;">' . $totalTx . '</span>
              </td>
            </tr>
          </table>
        </td></tr>

        <!-- Leftovers + Lessons -->
        <tr><td style="padding:0 40px 28px;">
          <p style="font-family:Arial,sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1.5px;color:#E87AAA;margin:0 0 12px;">What Happens Next</p>
          <table width="100%" cellpadding="0" cellspacing="0">
            ' . wrapRow('Donating', $donate) . '
            ' . wrapRow('Selling online', $sellOnline) . '
            ' . wrapRow('Keeping', $keep) . '
            ' . wrapRow('Tossing', $trash) . '
            ' . wrapRow('Lessons learned', $lessons) . '
          </table>
        </td></tr>

        <!-- Purpose -->
        ' . ($moneyPurpose ? '
        <tr><td style="padding:0 40px 28px;">
          <div style="background:#FDEEF5;padding:20px 24px;">
            <p style="font-family:Arial,sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#E87AAA;margin:0 0 6px;">What the money is for</p>
            <p style="font-family:Arial,sans-serif;font-size:15px;color:#252535;line-height:1.6;margin:0;">' . $moneyPurpose . '</p>
          </div>
        </td></tr>' : '') . '

        <!-- Sign off -->
        <tr><td style="padding:0 40px 40px;">
          <p style="font-family:Arial,sans-serif;font-size:15px;color:#252535;line-height:1.7;margin:0 0 8px;">You did this. Every item sorted, priced, and moved out the door &mdash; that took real effort. Here&rsquo;s to your next chapter.</p>
          <p style="font-family:Arial,sans-serif;font-size:14px;color:#8BA7D4;margin:0;">— Cece</p>
        </td></tr>

        <!-- Footer -->
        <tr><td style="padding:20px 40px;border-top:1px solid #F0ECF8;">
          <p style="margin:0;font-family:Arial,sans-serif;font-size:12px;color:#ABABAB;line-height:1.6;">
            You\'re receiving this because you used the Garage Sale Planner at <a href="https://mynestchapter.com" style="color:#ABABAB;">mynestchapter.com</a>
          </p>
        </td></tr>

      </table>
    </td></tr>
  </table>
</body></html>';

mail(
    $email,
    'Your Sale Summary — ' . $saleTitle,
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
