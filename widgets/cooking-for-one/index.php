<?php
require_once dirname(__DIR__, 2) . '/includes/config.php';
require_once dirname(__DIR__, 2) . '/includes/db.php';
require_once dirname(__DIR__, 2) . '/includes/auth.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';

requireLogin();

$product = getProductBySlug('cooking-for-one');
if (!$product || ($product['price'] > 0 && !userOwnsPurchase($_SESSION['user_id'], $product['id']))) {
    header('Location: /shop/cooking-for-one');
    exit;
}

readfile(__DIR__ . '/widget.html');
