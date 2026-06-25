<?php
require_once __DIR__ . '/../auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /admin/dashboard.php?page=queue');
    exit;
}

$db             = getDB();
$id             = (int)($_POST['id'] ?? 0);
$seqNum         = (int)($_POST['sequence_number'] ?? 0);
$title          = trim($_POST['title'] ?? '');
$description    = trim($_POST['description'] ?? '');
$filePath       = trim($_POST['file_path'] ?? '');
$unlockDays     = (int)($_POST['unlock_offset_days'] ?? 0);

if (!$seqNum || !$title) {
    header('Location: /admin/dashboard.php?page=queue&err=' . urlencode('Sequence number and title are required.'));
    exit;
}

// Handle PDF upload
if (!empty($_FILES['pdf_file']['name'])) {
    $uploadDir = __DIR__ . '/../../downloads/exclusive/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $ext = strtolower(pathinfo($_FILES['pdf_file']['name'], PATHINFO_EXTENSION));
    if ($ext !== 'pdf') {
        header('Location: /admin/dashboard.php?page=queue&err=' . urlencode('Only PDF files are allowed.'));
        exit;
    }
    $size = $_FILES['pdf_file']['size'];
    if ($size > 20 * 1024 * 1024) {
        header('Location: /admin/dashboard.php?page=queue&err=' . urlencode('File exceeds 20 MB limit.'));
        exit;
    }
    $originalName = pathinfo($_FILES['pdf_file']['name'], PATHINFO_FILENAME);
    $safeFilename = preg_replace('/[^a-z0-9\-]/', '', strtolower(str_replace(' ', '-', $originalName))) . '.pdf';
    $dest         = $uploadDir . $safeFilename;
    if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $dest)) {
        $filePath = $safeFilename;
    }
}

try {
    if ($id > 0) {
        $stmt = $db->prepare("
            UPDATE exclusive_content_queue
            SET sequence_number=?, title=?, description=?, file_path=?, unlock_offset_days=?
            WHERE id=?
        ");
        $stmt->execute([$seqNum, $title, $description, $filePath, $unlockDays, $id]);
        header('Location: /admin/dashboard.php?page=queue&success=' . urlencode('Queue item updated.'));
    } else {
        $stmt = $db->prepare("
            INSERT INTO exclusive_content_queue (sequence_number, title, description, file_path, unlock_offset_days)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$seqNum, $title, $description, $filePath, $unlockDays]);
        header('Location: /admin/dashboard.php?page=queue&success=' . urlencode('Queue item added.'));
    }
} catch (Exception $e) {
    $msg = strpos($e->getMessage(), 'Duplicate') !== false
        ? 'Sequence number ' . $seqNum . ' is already in use. Choose a different number.'
        : 'Database error: ' . $e->getMessage();
    header('Location: /admin/dashboard.php?page=queue&err=' . urlencode($msg));
}
exit;
