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
