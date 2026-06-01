<?php
/**
 * My Nest Chapter — Database Setup
 * 
 * HOW TO USE:
 * 1. Fill in your credentials in includes/config.php first
 * 2. Upload this file to your Hostinger public_html folder
 * 3. Visit mynestchapter.com/setup-database.php in your browser
 * 4. You'll see a success message for each table created
 * 5. DELETE THIS FILE after running it (security)
 */

require_once __DIR__ . '/includes/db.php';

$db = getDB();
$results = [];

// --- Users ---
try {
    $db->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(100) NOT NULL,
            email VARCHAR(255) UNIQUE NOT NULL,
            password_hash VARCHAR(255) NOT NULL,
            email_verified BOOLEAN DEFAULT FALSE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    $results[] = 'users table — CREATED';
} catch (Exception $e) {
    $results[] = 'users table — ERROR: ' . $e->getMessage();
}

// --- Products ---
try {
    $db->exec("
        CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            slug VARCHAR(255) UNIQUE NOT NULL,
            short_description TEXT,
            description TEXT,
            price DECIMAL(8,2) DEFAULT 0.00,
            category ENUM('workbook','companion','checklist','interactive_tool','free') NOT NULL,
            file_path VARCHAR(500),
            image_path VARCHAR(500),
            status ENUM('active','draft','coming_soon') DEFAULT 'draft',
            sort_order INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    $results[] = 'products table — CREATED';
} catch (Exception $e) {
    $results[] = 'products table — ERROR: ' . $e->getMessage();
}

// --- Purchases ---
try {
    $db->exec("
        CREATE TABLE IF NOT EXISTS purchases (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            product_id INT NOT NULL,
            stripe_payment_id VARCHAR(255),
            amount_paid DECIMAL(8,2),
            purchased_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (product_id) REFERENCES products(id),
            UNIQUE KEY unique_purchase (user_id, product_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    $results[] = 'purchases table — CREATED';
} catch (Exception $e) {
    $results[] = 'purchases table — ERROR: ' . $e->getMessage();
}

// --- Download Tokens ---
try {
    $db->exec("
        CREATE TABLE IF NOT EXISTS download_tokens (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            product_id INT NOT NULL,
            token VARCHAR(64) UNIQUE NOT NULL,
            expires_at TIMESTAMP NOT NULL,
            used BOOLEAN DEFAULT FALSE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (product_id) REFERENCES products(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    $results[] = 'download_tokens table — CREATED';
} catch (Exception $e) {
    $results[] = 'download_tokens table — ERROR: ' . $e->getMessage();
}

// --- Blog Posts ---
try {
    $db->exec("
        CREATE TABLE IF NOT EXISTS blog_posts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            slug VARCHAR(255) UNIQUE NOT NULL,
            excerpt TEXT,
            body TEXT,
            featured_image VARCHAR(500),
            category VARCHAR(100),
            meta_title VARCHAR(255),
            meta_description TEXT,
            status ENUM('published','draft') DEFAULT 'draft',
            published_at TIMESTAMP NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    $results[] = 'blog_posts table — CREATED';
} catch (Exception $e) {
    $results[] = 'blog_posts table — ERROR: ' . $e->getMessage();
}

// --- Email Subscribers ---
try {
    $db->exec("
        CREATE TABLE IF NOT EXISTS email_subscribers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) UNIQUE NOT NULL,
            first_name VARCHAR(100),
            source VARCHAR(100),
            subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    $results[] = 'email_subscribers table — CREATED';
} catch (Exception $e) {
    $results[] = 'email_subscribers table — ERROR: ' . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Database Setup — My Nest Chapter</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; color: #101010; }
        h1 { font-family: 'Arial', sans-serif; font-size: 1.2rem; color: #811453; text-transform: uppercase; }
        .result { padding: 8px 0; border-bottom: 1px solid #D3D3D3; font-size: 0.95rem; }
        .warning { margin-top: 2rem; padding: 1rem; background: #FFF3CD; border: 1px solid #FFEEBA; font-size: 0.85rem; }
    </style>
</head>
<body>
    <h1>My Nest Chapter — Database Setup</h1>
    <?php foreach ($results as $r): ?>
        <div class="result"><?= $r ?></div>
    <?php endforeach; ?>
    <div class="warning">
        <strong>DELETE THIS FILE NOW.</strong> Go to Hostinger File Manager and delete setup-database.php. Leaving it online is a security risk.
    </div>
</body>
</html>
