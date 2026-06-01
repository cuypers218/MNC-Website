<?php
/**
 * My Nest Chapter — Secure Download Handler
 * Validates download token and serves protected files.
 */

require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/functions.php';

requireLogin();

$token = $_GET['token'] ?? '';
$user = getCurrentUser();

if (empty($token)) {
    header('Location: /dashboard');
    exit;
}

$db = getDB();

// Look up the token
$stmt = $db->prepare('
    SELECT dt.*, p.file_path, p.title, p.slug 
    FROM download_tokens dt 
    JOIN products p ON dt.product_id = p.id 
    WHERE dt.token = ? AND dt.user_id = ? AND dt.product_id > 0
');
$stmt->execute([$token, $user['id']]);
$record = $stmt->fetch();

// Validate
if (!$record) {
    $error = 'Invalid download link.';
} elseif ($record['used']) {
    $error = 'This download link has already been used.';
} elseif (strtotime($record['expires_at']) < time()) {
    $error = 'This download link has expired. Go to your dashboard to get a new one.';
} elseif (empty($record['file_path'])) {
    $error = 'This product doesn\'t have a downloadable file yet.';
} else {
    $filePath = DOWNLOAD_DIR . $record['file_path'];
    
    if (!file_exists($filePath)) {
        $error = 'File not found. Please contact support.';
        error_log('Download file not found: ' . $filePath);
    }
}

// If there's an error, show it
if (isset($error)) {
    $pageTitle = 'Download';
    require_once __DIR__ . '/includes/header.php';
    ?>
    <section class="section">
        <div class="container text-center" style="padding: 3rem 0;">
            <h1>Download Issue</h1>
            <p style="color: #666; margin: 1rem 0 2rem;"><?= esc($error) ?></p>
            <a href="/dashboard" class="btn btn-primary">Go to Dashboard</a>
        </div>
    </section>
    <?php
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

// Mark token as used
$stmt = $db->prepare('UPDATE download_tokens SET used = 1 WHERE token = ?');
$stmt->execute([$token]);

// Determine content type
$ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
$contentTypes = [
    'pdf' => 'application/pdf',
    'zip' => 'application/zip',
    'html' => 'text/html',
    'epub' => 'application/epub+zip',
];
$contentType = $contentTypes[$ext] ?? 'application/octet-stream';

// Serve the file
$fileName = slugify($record['title']) . '.' . $ext;

header('Content-Type: ' . $contentType);
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Content-Length: ' . filesize($filePath));
header('Cache-Control: no-cache, no-store, must-revalidate');

readfile($filePath);
exit;
