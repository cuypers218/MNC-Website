<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

if (
    !isset($_SESSION[ADMIN_SESSION_KEY]) ||
    $_SESSION[ADMIN_SESSION_KEY] !== ADMIN_SESSION_VALUE
) {
    header('Location: /admin/');
    exit;
}

// Also set a member session so admin can view any product page without re-logging in
if (!isLoggedIn()) {
    $db = getDB();
    $adminUser = $db->query("SELECT id, first_name FROM users WHERE is_admin = 1 LIMIT 1")->fetch();
    if ($adminUser) {
        $_SESSION['user_id']   = $adminUser['id'];
        $_SESSION['user_name'] = $adminUser['first_name'];
    }
}
