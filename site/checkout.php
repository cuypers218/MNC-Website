<?php
/**
 * My Nest Chapter — Stripe Checkout
 * Creates a checkout session and redirects to Stripe's hosted payment page.
 * Called when user clicks "Buy Now" on a product page.
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

// Must be logged in
requireLogin();

$user = getCurrentUser();

// Handle success redirect from Stripe
if (isset($_GET['success']) && $_GET['success'] === '1') {
    $productSlug = $_GET['product'] ?? '';
    $pageTitle = 'Purchase Complete';
    require_once __DIR__ . '/includes/header.php';
    ?>
    <section class="section">
        <div class="container text-center" style="padding: 3rem 0;">
            <h1 style="color: #E87AAA;">You're In</h1>
            <p style="color: #444; font-size: 1.05rem; margin: 1rem 0 0.5rem;">Your purchase is confirmed.</p>
            <p style="color: #666; margin-bottom: 2rem;">It's now in your dashboard, ready to download.</p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="/dashboard" class="btn btn-primary">Go to Dashboard</a>
                <?php if ($productSlug): ?>
                    <a href="/shop/<?= esc($productSlug) ?>" class="btn btn-outline">View Product</a>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

$productSlug = $_GET['product'] ?? '';

if (empty($productSlug)) {
    header('Location: /shop');
    exit;
}

$product = getProductBySlug($productSlug);

if (!$product || $product['price'] <= 0) {
    header('Location: /shop');
    exit;
}

// Check if already purchased
if (userOwnsPurchase($user['id'], $product['id'])) {
    header('Location: /dashboard');
    exit;
}

// Create Stripe Checkout Session using curl (no SDK needed)
$stripeData = [
    'mode' => 'payment',
    'success_url' => SITE_URL . '/checkout?success=1&product=' . $product['slug'],
    'cancel_url' => SITE_URL . '/shop/' . $product['slug'],
    'customer_email' => $user['email'],
    'line_items[0][price_data][currency]' => 'usd',
    'line_items[0][price_data][product_data][name]' => $product['title'],
    'line_items[0][price_data][product_data][description]' => $product['short_description'] ?? '',
    'line_items[0][price_data][unit_amount]' => intval($product['price'] * 100), // Stripe uses cents
    'line_items[0][quantity]' => 1,
    'metadata[user_id]' => $user['id'],
    'metadata[product_id]' => $product['id'],
    'metadata[product_slug]' => $product['slug'],
];

$ch = curl_init('https://api.stripe.com/v1/checkout/sessions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($stripeData));
curl_setopt($ch, CURLOPT_USERPWD, STRIPE_SECRET_KEY . ':');
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$session = json_decode($response, true);

if ($httpCode === 200 && isset($session['url'])) {
    // Redirect to Stripe's checkout page
    header('Location: ' . $session['url']);
    exit;
} else {
    // Something went wrong
    error_log('Stripe checkout error: ' . $response);
    $pageTitle = 'Checkout Error';
    require_once __DIR__ . '/includes/header.php';
    ?>
    <section class="section">
        <div class="container text-center" style="padding: 3rem 0;">
            <h1>Something Went Wrong</h1>
            <p style="color: #666; margin: 1rem 0 2rem;">The checkout couldn't be started. Please try again.</p>
            <a href="/shop/<?= esc($product['slug']) ?>" class="btn btn-primary">Try Again</a>
        </div>
    </section>
    <?php
    require_once __DIR__ . '/includes/footer.php';
}
