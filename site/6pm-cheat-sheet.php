<?php
require_once __DIR__ . '/includes/auth.php';

if (isLoggedIn()) {
    header('Location: /dashboard');
} else {
    header('Location: /6pm-experience/');
}
exit;
