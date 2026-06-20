<?php
/**
 * My Nest Chapter — Authentication Helpers
 * Handles login state, CSRF tokens, and user session management
 */

require_once __DIR__ . '/db.php';

/**
 * Check if user is currently logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0;
}

/**
 * Get the current logged-in user's data
 * Returns associative array or null
 */
function getCurrentUser() {
    if (!isLoggedIn()) return null;
    
    static $user = null;
    if ($user !== null) return $user;
    
    $db = getDB();
    $stmt = $db->prepare('SELECT id, first_name, email, created_at, is_admin, quiz_result, highest_tier_seen FROM users WHERE id = ?');
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    
    return $user;
}

/**
 * Require login — redirect to login page if not authenticated
 */
function requireLogin() {
    if (!isLoggedIn()) {
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
        header('Location: /login');
        exit;
    }
}

/**
 * Log a user in (set session)
 */
function loginUser($userId, $firstName) {
    session_regenerate_id(true); // Prevent session fixation
    $_SESSION['user_id'] = $userId;
    $_SESSION['user_name'] = $firstName;
}

/**
 * Log the user out
 */
function logoutUser() {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'],
            $params['secure'], $params['httponly']
        );
    }
    session_destroy();
}

/**
 * Generate a CSRF token for forms
 */
function csrfToken() {
    if (empty($_SESSION[CSRF_TOKEN_NAME])) {
        $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
    }
    return $_SESSION[CSRF_TOKEN_NAME];
}

/**
 * Output a hidden CSRF input field for forms
 */
function csrfField() {
    return '<input type="hidden" name="' . CSRF_TOKEN_NAME . '" value="' . csrfToken() . '">';
}

/**
 * Validate CSRF token from form submission
 */
function validateCsrf() {
    if (empty($_POST[CSRF_TOKEN_NAME]) || empty($_SESSION[CSRF_TOKEN_NAME])) {
        return false;
    }
    return hash_equals($_SESSION[CSRF_TOKEN_NAME], $_POST[CSRF_TOKEN_NAME]);
}

/**
 * Check if a user ID belongs to an admin account
 */
function isAdminUser($userId) {
    static $cache = [];
    if (isset($cache[$userId])) return $cache[$userId];
    $db = getDB();
    $stmt = $db->prepare('SELECT is_admin FROM users WHERE id = ?');
    $stmt->execute([$userId]);
    $row = $stmt->fetch();
    $cache[$userId] = $row && !empty($row['is_admin']);
    return $cache[$userId];
}

/**
 * Check if a user has purchased a specific product
 */
function userOwnsPurchase($userId, $productId) {
    if (isAdminUser($userId)) return true;
    $db = getDB();
    $stmt = $db->prepare('SELECT id FROM purchases WHERE user_id = ? AND product_id = ?');
    $stmt->execute([$userId, $productId]);
    return $stmt->fetch() !== false;
}

/**
 * Get all products a user has purchased
 */
function getUserPurchases($userId) {
    $db = getDB();
    if (isAdminUser($userId)) {
        $stmt = $db->query('SELECT *, NOW() as purchased_at FROM products WHERE status = "active" ORDER BY sort_order, title');
        return $stmt->fetchAll();
    }
    $stmt = $db->prepare('
        SELECT p.*, pu.purchased_at
        FROM products p
        JOIN purchases pu ON p.id = pu.product_id
        WHERE pu.user_id = ?
        ORDER BY pu.purchased_at DESC
    ');
    $stmt->execute([$userId]);
    return $stmt->fetchAll();
}

/**
 * Generate a secure download token for a purchased product
 */
function generateDownloadToken($userId, $productId) {
    $db = getDB();
    $token = bin2hex(random_bytes(32));
    $expiresAt = date('Y-m-d H:i:s', strtotime('+' . DOWNLOAD_TOKEN_EXPIRY . ' hours'));
    
    $stmt = $db->prepare('
        INSERT INTO download_tokens (user_id, product_id, token, expires_at) 
        VALUES (?, ?, ?, ?)
    ');
    $stmt->execute([$userId, $productId, $token, $expiresAt]);
    
    return $token;
}
