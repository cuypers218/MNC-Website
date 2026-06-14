<?php
/**
 * My Nest Chapter — Stripe Webhook Handler
 * Receives events from Stripe when a payment succeeds.
 * Records the purchase in the database.
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';

// Read the raw POST body
$payload = file_get_contents('php://input');
$sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';

// If webhook secret is configured, verify signature
if (STRIPE_WEBHOOK_SECRET !== 'PASTE_YOUR_WEBHOOK_SECRET_HERE' && !empty($sigHeader)) {
    // Simple signature verification
    $elements = [];
    foreach (explode(',', $sigHeader) as $part) {
        $kv = explode('=', $part, 2);
        if (count($kv) === 2) {
            $elements[$kv[0]] = $kv[1];
        }
    }
    
    $timestamp = $elements['t'] ?? '';
    $signature = $elements['v1'] ?? '';
    $signedPayload = $timestamp . '.' . $payload;
    $expectedSig = hash_hmac('sha256', $signedPayload, STRIPE_WEBHOOK_SECRET);
    
    if (!hash_equals($expectedSig, $signature)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid signature']);
        exit;
    }
}

// Parse the event
$event = json_decode($payload, true);

if (!$event || !isset($event['type'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid payload']);
    exit;
}

// Handle checkout.session.completed
if ($event['type'] === 'checkout.session.completed') {
    $session = $event['data']['object'];
    
    $userId = $session['metadata']['user_id'] ?? null;
    $productId = $session['metadata']['product_id'] ?? null;
    $paymentId = $session['payment_intent'] ?? $session['id'];
    $amountPaid = ($session['amount_total'] ?? 0) / 100; // Convert from cents
    
    if ($userId && $productId) {
        $db = getDB();

        // Record the purchase (INSERT IGNORE prevents duplicates)
        try {
            $stmt = $db->prepare('INSERT IGNORE INTO purchases (user_id, product_id, stripe_payment_id, amount_paid) VALUES (?, ?, ?, ?)');
            $stmt->execute([$userId, $productId, $paymentId, $amountPaid]);

            error_log('Purchase recorded: user=' . $userId . ' product=' . $productId . ' amount=' . $amountPaid);
        } catch (Exception $e) {
            error_log('Purchase recording failed: ' . $e->getMessage());
        }

        // Send post-purchase welcome email
        $productSlug = $session['metadata']['product_slug'] ?? '';
        $customerEmail = $session['customer_email'] ?? '';

        // Tag buyer in Reach for goal-habit-tracker purchases
        if ($customerEmail && $productSlug === 'goal-habit-tracker') {
            try {
                $reachToken   = '6MIeMuGCJNf9Fp6NpRLB2xCAW5mmy2gIXQyKxdmS1e9982ba';
                $reachBase    = 'https://developers.hostinger.com/api/reach/v1';
                $reachSegment = '1fda3952-0309-46c3-ad2e-0d197a24b574';

                $ch = curl_init($reachBase . '/contacts');
                curl_setopt_array($ch, [
                    CURLOPT_POST           => true,
                    CURLOPT_POSTFIELDS     => json_encode(['email' => $customerEmail]),
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $reachToken, 'Content-Type: application/json', 'Accept: application/json'],
                ]);
                $reachResponse = curl_exec($ch);
                curl_close($ch);

                $reachContact = json_decode($reachResponse, true);
                $contactUuid  = $reachContact['uuid'] ?? null;

                if ($contactUuid) {
                    $ch2 = curl_init($reachBase . '/segments/' . $reachSegment . '/contacts');
                    curl_setopt_array($ch2, [
                        CURLOPT_POST           => true,
                        CURLOPT_POSTFIELDS     => json_encode(['contact_uuid' => $contactUuid]),
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $reachToken, 'Content-Type: application/json', 'Accept: application/json'],
                    ]);
                    curl_exec($ch2);
                    curl_close($ch2);
                    error_log('Reach tagged: ' . $customerEmail . ' → goal-habit-tracker-buyers');
                }
            } catch (Exception $e) {
                error_log('Reach tagging failed: ' . $e->getMessage());
            }
        }

        if ($customerEmail && in_array($productSlug, ['cooking-for-one', 'garage-sale-planner', 'someday-companion', 'goal-habit-tracker'])) {
            try {
                // Get first name from DB
                $uStmt = $db->prepare('SELECT first_name FROM users WHERE id = ?');
                $uStmt->execute([$userId]);
                $uRow = $uStmt->fetch();
                $firstName = $uRow['first_name'] ?? 'there';

                if ($productSlug === 'cooking-for-one') {
                    $subject = 'Your Cooking for One Planner is ready';
                    $productName = 'Cooking for One Planner';
                    $directUrl = 'https://mynestchapter.com/widgets/cooking-for-one/';
                    $ctaLabel = 'Open Your Planner';
                    $steps = [
                        ['title' => 'Go to your dashboard', 'text' => 'Head to mynestchapter.com/dashboard and click "Open Planner" on your Cooking for One card.'],
                        ['title' => 'Plan your week', 'text' => 'Fill in breakfast, lunch, dinner, and a snack for each day. Add prep time and notes — just for you.'],
                        ['title' => 'Build your grocery list', 'text' => 'Switch to the Grocery tab and add exactly what you need. No overbuying, no waste.'],
                        ['title' => 'Email yourself the plan', 'text' => 'When your week is set, tap the email icon in the top right and send the whole plan to yourself for when you\'re at the store.'],
                    ];
                } elseif ($productSlug === 'someday-companion') {
                    $subject = 'Your Someday Companion is ready';
                    $productName = 'Someday Companion';
                    $directUrl = 'https://mynestchapter.com/dashboard';
                    $ctaLabel = 'Download Your Companion';
                    $steps = [
                        ['title' => 'Go to your dashboard', 'text' => 'Head to mynestchapter.com/dashboard — your Someday Companion will be there waiting.'],
                        ['title' => 'Click Download', 'text' => 'Hit the Download button on your Someday Companion card. The PDF saves straight to your device.'],
                        ['title' => 'Find a quiet moment', 'text' => 'Open the companion when you have 20 minutes alone. No rush, no timeline — it moves at your pace.'],
                        ['title' => 'Start wherever feels right', 'text' => 'There\'s no wrong page to begin on. Just you, your list, and a real starting point.'],
                    ];
                } elseif ($productSlug === 'goal-habit-tracker') {
                    $subject = 'Your 30-Day Goal & Habit Tracker is ready';
                    $productName = '30-Day Goal & Habit Tracker';
                    $directUrl = 'https://mynestchapter.com/widgets/goal-habit-tracker/';
                    $ctaLabel = 'Open Your Tracker';
                    $steps = [
                        ['title' => 'Go to your dashboard', 'text' => 'Head to mynestchapter.com/dashboard and click "Open Planner" on your Goal & Habit Tracker card.'],
                        ['title' => 'Complete the 5-step setup', 'text' => 'Walk through the life assessment, values, goals, action plan, and habits tabs. Take your time — this is the foundation everything builds on.'],
                        ['title' => 'Start your daily check-in', 'text' => 'Once setup is done, the Daily tab opens up. Five minutes a day. One entry. Be honest — it\'s just for you.'],
                        ['title' => 'Watch your month build', 'text' => 'Visit the Monthly tab anytime to see your habit grid fill in and your streak grow. On Day 30, your full review is waiting.'],
                    ];
                } else {
                    $subject = 'Your Garage Sale Planner is ready';
                    $productName = 'Garage Sale Planner';
                    $directUrl = 'https://mynestchapter.com/widgets/garage-sale-planner/';
                    $ctaLabel = 'Open Your Planner';
                    $steps = [
                        ['title' => 'Go to your dashboard', 'text' => 'Head to mynestchapter.com/dashboard and click "Open Planner" on your Garage Sale Planner card.'],
                        ['title' => 'Set your money goal', 'text' => 'Start on the Setup tab — enter your sale date and what you want to earn. The planner tracks everything from there.'],
                        ['title' => 'Add your items', 'text' => 'Use the Inventory tab to list everything you\'re selling. Set prices, mark conditions, track what sells.'],
                        ['title' => 'Log sales on the day', 'text' => 'On sale day, use the Sales Log to record each transaction and watch your total climb toward your goal.'],
                    ];
                }

                $stepsHtml = '';
                foreach ($steps as $i => $step) {
                    $num = $i + 1;
                    $stepsHtml .= '
                    <tr>
                      <td style="padding:0 0 20px 0;">
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                          <tr>
                            <td width="36" valign="top" style="padding-right:14px;">
                              <div style="width:28px;height:28px;background:#E87AAA;color:#252535;font-family:Arial,sans-serif;font-size:13px;font-weight:700;text-align:center;line-height:28px;border-radius:50%;">' . $num . '</div>
                            </td>
                            <td valign="top">
                              <p style="margin:0 0 4px;font-family:Arial,sans-serif;font-size:15px;font-weight:700;color:#252535;">' . htmlspecialchars($step['title']) . '</p>
                              <p style="margin:0;font-family:Arial,sans-serif;font-size:14px;color:#5A5A72;line-height:1.6;">' . htmlspecialchars($step['text']) . '</p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>';
                }

                $body = '<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"></head>
<body style="margin:0;padding:0;background:#FAFAFA;font-family:Arial,sans-serif;">
<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background:#FAFAFA;padding:40px 20px;">
  <tr><td align="center">
    <table cellpadding="0" cellspacing="0" border="0" width="560" style="max-width:560px;width:100%;background:#ffffff;border:1px solid #D3D3D3;">

      <!-- Header -->
      <tr>
        <td style="background:#252535;padding:28px 40px 24px;text-align:left;">
          <p style="margin:0 0 2px;font-family:Arial,sans-serif;font-size:9px;font-weight:700;letter-spacing:4px;text-transform:uppercase;color:#A8C5DA;">MY NEST CHAPTER</p>
          <p style="margin:0;font-family:Arial,sans-serif;font-size:22px;font-weight:700;color:#E87AAA;letter-spacing:1px;">You\'re in.</p>
        </td>
      </tr>

      <!-- Body -->
      <tr>
        <td style="padding:36px 40px 0;">
          <p style="margin:0 0 8px;font-family:Arial,sans-serif;font-size:18px;font-weight:700;color:#252535;">Hey ' . htmlspecialchars($firstName) . ',</p>
          <p style="margin:0 0 28px;font-family:Arial,sans-serif;font-size:15px;color:#5A5A72;line-height:1.7;">Your <strong style="color:#252535;">' . htmlspecialchars($productName) . '</strong> is ready and waiting. Here\'s how to get started:</p>

          <table cellpadding="0" cellspacing="0" border="0" width="100%">
            ' . $stepsHtml . '
          </table>

          <!-- CTA -->
          <table cellpadding="0" cellspacing="0" border="0" style="margin:8px 0 32px;">
            <tr>
              <td style="background:#E87AAA;padding:0;">
                <a href="' . $directUrl . '" style="display:inline-block;padding:14px 32px;font-family:Arial,sans-serif;font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#252535;text-decoration:none;">' . $ctaLabel . '</a>
              </td>
            </tr>
          </table>

          <p style="margin:0 0 36px;font-family:Arial,sans-serif;font-size:13px;color:#5A5A72;line-height:1.7;">If the button doesn\'t work, copy this link into your browser:<br><a href="' . $directUrl . '" style="color:#E87AAA;">' . $directUrl . '</a></p>
        </td>
      </tr>

      <!-- Footer -->
      <tr>
        <td style="padding:20px 40px 28px;border-top:1px solid #D3D3D3;">
          <p style="margin:0;font-family:Arial,sans-serif;font-size:12px;color:#ABABAB;">My Nest Chapter &nbsp;&middot;&nbsp; mynestchapter.com<br>You\'re receiving this because you made a purchase.</p>
        </td>
      </tr>

    </table>
  </td></tr>
</table>
</body></html>';

                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
                $headers .= 'From: My Nest Chapter <hello@mynestchapter.com>' . "\r\n";
                $headers .= 'Reply-To: hello@mynestchapter.com' . "\r\n";

                mail($customerEmail, $subject, $body, $headers);
                error_log('Welcome email sent: ' . $customerEmail . ' product=' . $productSlug);
            } catch (Exception $e) {
                error_log('Welcome email failed: ' . $e->getMessage());
            }
        }
    }
}

// Return 200 to Stripe
http_response_code(200);
echo json_encode(['received' => true]);
