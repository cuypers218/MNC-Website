<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /blog');
    exit;
}

$slug = trim($_POST['slug'] ?? '');
$post = $slug ? getPostBySlug($slug) : null;

if (!$post) {
    header('Location: /blog');
    exit;
}

$backTo = '/blog/' . $post['slug'];

if (!isLoggedIn()) {
    $_SESSION['redirect_after_login'] = $backTo;
    header('Location: /login');
    exit;
}

if (!validateCsrf()) {
    header('Location: ' . $backTo . '?comment_error=1#comments');
    exit;
}

$body = trim($_POST['body'] ?? '');

if ($body === '' || mb_strlen($body) < 2) {
    header('Location: ' . $backTo . '?comment_error=1#comments');
    exit;
}

// A generous cap, not a fight — just keeps one comment from becoming a second blog post.
if (mb_strlen($body) > 2000) {
    $body = mb_substr($body, 0, 2000);
}

$db = getDB();
$stmt = $db->prepare('INSERT INTO blog_comments (post_id, user_id, body) VALUES (?, ?, ?)');
$stmt->execute([$post['id'], $_SESSION['user_id'], $body]);

header('Location: ' . $backTo . '?commented=1#comments');
exit;
