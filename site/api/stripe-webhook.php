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
    }
}

// Return 200 to Stripe
http_response_code(200);
echo json_encode(['received' => true]);
