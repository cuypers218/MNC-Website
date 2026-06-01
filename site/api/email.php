<?php
/**
 * My Nest Chapter — Email Capture API
 * Receives email submissions from widgets, blog, and freebies page
 * Stores in database and (when configured) sends to Hostinger Reach
 */

require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';

header('Content-Type: application/json');

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
    exit;
}

// Parse JSON body
$input = json_decode(file_get_contents('php://input'), true);
$email = trim($input['email'] ?? '');
$source = trim($input['source'] ?? 'unknown');
$firstName = trim($input['first_name'] ?? '');

// Validate email
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'error' => 'Invalid email']);
    exit;
}

$db = getDB();

try {
    // Insert or ignore if already exists
    $stmt = $db->prepare('INSERT IGNORE INTO email_subscribers (email, first_name, source) VALUES (?, ?, ?)');
    $stmt->execute([$email, $firstName, $source]);
    
    // TODO: Send to Hostinger Reach API when configured
    // This is where the Reach API call would go:
    // if (REACH_API_KEY !== 'PASTE_YOUR_REACH_API_KEY_HERE') {
    //     // Make API call to Hostinger Reach
    // }
    
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    error_log('Email capture error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'error' => 'Something went wrong']);
}
