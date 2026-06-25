<?php
require_once __DIR__ . '/../auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /admin/dashboard.php?page=files');
    exit;
}

$validFolders = ['products', 'freebies', 'exclusive'];
$folder       = $_POST['folder'] ?? '';

if (!in_array($folder, $validFolders)) {
    header('Location: /admin/dashboard.php?page=files&err=' . urlencode('Invalid destination folder.'));
    exit;
}

if (empty($_FILES['upload_file']['name'])) {
    header('Location: /admin/dashboard.php?page=files&err=' . urlencode('No file was selected.'));
    exit;
}

// Enforce PDF only
$ext = strtolower(pathinfo($_FILES['upload_file']['name'], PATHINFO_EXTENSION));
if ($ext !== 'pdf') {
    header('Location: /admin/dashboard.php?page=files&err=' . urlencode('Only PDF files are allowed.'));
    exit;
}

// Enforce 20 MB limit
if ($_FILES['upload_file']['size'] > 20 * 1024 * 1024) {
    header('Location: /admin/dashboard.php?page=files&err=' . urlencode('File exceeds the 20 MB limit.'));
    exit;
}

// Determine filename
$customName = trim($_POST['filename'] ?? '');
if ($customName) {
    // Sanitize: lowercase, hyphens, must end in .pdf
    $customName = preg_replace('/[^a-z0-9\-\.]/', '', strtolower($customName));
    if (!str_ends_with($customName, '.pdf')) {
        $customName .= '.pdf';
    }
    $filename = $customName;
} else {
    $original  = pathinfo($_FILES['upload_file']['name'], PATHINFO_FILENAME);
    $safe      = preg_replace('/[^a-z0-9\-]/', '', strtolower(str_replace(' ', '-', $original)));
    $filename  = $safe . '.pdf';
}

$uploadDir = __DIR__ . '/../../downloads/' . $folder . '/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$dest = $uploadDir . $filename;

if (move_uploaded_file($_FILES['upload_file']['tmp_name'], $dest)) {
    header('Location: /admin/dashboard.php?page=files&success=' . urlencode($filename . ' uploaded to ' . $folder . '.'));
} else {
    header('Location: /admin/dashboard.php?page=files&err=' . urlencode('Upload failed. Check server permissions.'));
}
exit;
