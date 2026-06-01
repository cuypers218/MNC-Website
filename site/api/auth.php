<?php
/**
 * My Nest Chapter — Auth API Handler
 * Handles logout and other auth actions via GET/POST
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';

$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'logout':
        logoutUser();
        header('Location: /?logged_out=1');
        exit;
        break;
        
    default:
        header('Location: /');
        exit;
}
