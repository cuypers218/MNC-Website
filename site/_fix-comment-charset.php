<?php
// ONE-TIME — check what a real POST request through blog-comment-submit.php's
// exact code path (trim($_POST['name'])) actually stores, hex-dumped raw.
// Gated behind a secret token, deleted from the repo right after it runs.

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$SECRET = 'a2ef189b2169d9c0d21097423d65ff31336ac3c1a651a17d';
if (($_GET['token'] ?? '') !== $SECRET) {
    http_response_code(404);
    exit;
}

header('Content-Type: text/plain');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $raw = file_get_contents('php://input');
    echo "Raw POST body received: $raw\n";
    echo "Raw POST body (hex)   : " . bin2hex($raw) . "\n\n";

    $name = trim($_POST['name'] ?? '');
    echo "\$_POST['name'] after trim(), as PHP sees it: $name\n";
    echo "Its bytes (hex): " . bin2hex($name) . "\n";
    exit;
}

echo "POST to this same URL with name=Test%20%E2%80%94%20dash to run the check.\n";
