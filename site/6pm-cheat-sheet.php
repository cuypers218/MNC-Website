<?php
require_once __DIR__ . '/includes/auth.php';

if (isLoggedIn()) {
    header('Location: /dashboard');
} else {
    header('Location: /widgets/6pm-experience/');
}
exit;
