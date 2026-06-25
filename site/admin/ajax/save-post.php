<?php
require_once __DIR__ . '/../auth.php';

$db     = getDB();
$action = $_GET['action'] ?? '';

// GET a single post for the edit modal
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $action === 'get') {
    header('Content-Type: application/json');
    $id   = (int)($_GET['id'] ?? 0);
    $stmt = $db->prepare("SELECT id, title, slug, excerpt, body, status FROM blog_posts WHERE id = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch();
    if ($post) {
        echo json_encode($post);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Post not found']);
    }
    exit;
}

// Toggle publish/draft via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'toggle') {
    header('Content-Type: application/json');
    $body    = json_decode(file_get_contents('php://input'), true);
    $id      = (int)($body['id'] ?? 0);
    $current = $body['current'] ?? '';

    if (!$id) {
        echo json_encode(['error' => 'Invalid post ID']);
        exit;
    }

    if ($current === 'published') {
        $stmt = $db->prepare("UPDATE blog_posts SET status = 'draft' WHERE id = ?");
        $stmt->execute([$id]);
    } else {
        $stmt = $db->prepare("UPDATE blog_posts SET status = 'published', published_at = NOW() WHERE id = ?");
        $stmt->execute([$id]);
    }
    echo json_encode(['success' => true]);
    exit;
}

// POST — save new or updated post
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /admin/dashboard.php?page=blog');
    exit;
}

$id         = (int)($_POST['id'] ?? 0);
$title      = trim($_POST['title'] ?? '');
$slug       = trim($_POST['slug'] ?? '');
$excerpt    = trim($_POST['excerpt'] ?? '');
$body       = trim($_POST['body'] ?? '');
$publishNow = !empty($_POST['publish_now']);

if (!$title || !$slug) {
    header('Location: /admin/dashboard.php?page=blog&err=' . urlencode('Title and slug are required.'));
    exit;
}

$slug   = preg_replace('/[^a-z0-9\-]/', '', strtolower($slug));
$status = $publishNow ? 'published' : 'draft';

// Handle social image upload
$featuredImage = null;
if (!empty($_FILES['social_image']['name'])) {
    $uploadDir = __DIR__ . '/../../uploads/blog/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $ext     = strtolower(pathinfo($_FILES['social_image']['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    if (in_array($ext, $allowed)) {
        $filename = $slug . '-social.' . $ext;
        $dest     = $uploadDir . $filename;
        if (move_uploaded_file($_FILES['social_image']['tmp_name'], $dest)) {
            $featuredImage = '/uploads/blog/' . $filename;
        }
    }
}

try {
    if ($id > 0) {
        if ($featuredImage) {
            $stmt = $db->prepare("
                UPDATE blog_posts
                SET title=?, slug=?, excerpt=?, body=?, featured_image=?, status=?
                    " . ($publishNow ? ", published_at = NOW()" : "") . "
                WHERE id=?
            ");
            $stmt->execute([$title, $slug, $excerpt, $body, $featuredImage, $status, $id]);
        } else {
            $stmt = $db->prepare("
                UPDATE blog_posts
                SET title=?, slug=?, excerpt=?, body=?, status=?
                    " . ($publishNow ? ", published_at = NOW()" : "") . "
                WHERE id=?
            ");
            $stmt->execute([$title, $slug, $excerpt, $body, $status, $id]);
        }
        header('Location: /admin/dashboard.php?page=blog&success=' . urlencode('Post updated.'));
    } else {
        $publishedAt = $publishNow ? date('Y-m-d H:i:s') : null;
        $stmt = $db->prepare("
            INSERT INTO blog_posts (title, slug, excerpt, body, featured_image, status, published_at)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$title, $slug, $excerpt, $body, $featuredImage, $status, $publishedAt]);
        header('Location: /admin/dashboard.php?page=blog&success=' . urlencode('Post added.'));
    }
} catch (Exception $e) {
    $msg = strpos($e->getMessage(), 'Duplicate') !== false
        ? 'A post with that slug already exists. Choose a different slug.'
        : 'Database error: ' . $e->getMessage();
    header('Location: /admin/dashboard.php?page=blog&err=' . urlencode($msg));
}
exit;
