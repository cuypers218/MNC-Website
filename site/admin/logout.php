<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../includes/db.php';

unset($_SESSION[ADMIN_SESSION_KEY]);

header('Location: /admin/');
exit;
