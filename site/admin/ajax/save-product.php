<?php
require_once __DIR__ . '/../auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /admin/dashboard.php?page=products');
    exit;
}

$db    = getDB();
$id    = (int)($_POST['id'] ?? 0);
$title = trim($_POST['title'] ?? '');
$slug  = trim($_POST['slug'] ?? '');
$price = trim($_POST['price'] ?? '');

if (!$title || !$slug) {
    header('Location: /admin/dashboard.php?page=products&err=' . urlencode('Title and slug are required.'));
    exit;
}

// Sanitize slug
$slug = preg_replace('/[^a-z0-9\-]/', '', strtolower($slug));

$priceVal  = ($price === '' || $price === null) ? 0.00 : (float)$price;
$category  = $_POST['category'] ?? 'free';
$validCats = ['workbook', 'companion', 'checklist', 'interactive_tool', 'free'];
if (!in_array($category, $validCats)) $category = 'free';

$shortDesc       = trim($_POST['short_description'] ?? '');
$filePath        = trim($_POST['file_path'] ?? '');
$stripeProductId = trim($_POST['stripe_product_id'] ?? '');
$setActive       = !empty($_POST['set_active']);
$status          = $setActive ? 'active' : 'draft';

// Handle thumbnail upload
$imagePath = null;
if (!empty($_FILES['thumbnail']['name'])) {
    $uploadDir = __DIR__ . '/../../uploads/thumbnails/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $ext      = strtolower(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION));
    $allowed  = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    if (in_array($ext, $allowed)) {
        $safeSlug  = $slug ?: 'product-' . time();
        $filename  = $safeSlug . '.' . $ext;
        $dest      = $uploadDir . $filename;
        if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $dest)) {
            $imagePath = '/uploads/thumbnails/' . $filename;
        }
    }
}

try {
    if ($id > 0) {
        // UPDATE
        if ($imagePath) {
            $stmt = $db->prepare("
                UPDATE products
                SET title=?, slug=?, price=?, category=?, short_description=?,
                    file_path=?, image_path=?, status=?
                WHERE id=?
            ");
            $stmt->execute([$title, $slug, $priceVal, $category, $shortDesc, $filePath, $imagePath, $status, $id]);
        } else {
            $stmt = $db->prepare("
                UPDATE products
                SET title=?, slug=?, price=?, category=?, short_description=?,
                    file_path=?, status=?
                WHERE id=?
            ");
            $stmt->execute([$title, $slug, $priceVal, $category, $shortDesc, $filePath, $status, $id]);
        }
        // Save stripe_product_id if the column exists (added via setup-tables.php)
        if ($stripeProductId) {
            try {
                $s2 = $db->prepare("UPDATE products SET stripe_product_id=? WHERE id=?");
                $s2->execute([$stripeProductId, $id]);
            } catch (Exception $ignored) {}
        }
        header('Location: /admin/dashboard.php?page=products&success=' . urlencode('Product updated.'));
    } else {
        // INSERT
        $stmt = $db->prepare("
            INSERT INTO products (title, slug, price, category, short_description, file_path, image_path, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$title, $slug, $priceVal, $category, $shortDesc, $filePath, $imagePath, $status]);
        $newId = (int)$db->lastInsertId();
        // Save stripe_product_id if the column exists
        if ($stripeProductId && $newId) {
            try {
                $s2 = $db->prepare("UPDATE products SET stripe_product_id=? WHERE id=?");
                $s2->execute([$stripeProductId, $newId]);
            } catch (Exception $ignored) {}
        }
        header('Location: /admin/dashboard.php?page=products&success=' . urlencode('Product added.'));
    }
} catch (Exception $e) {
    $msg = strpos($e->getMessage(), 'Duplicate') !== false
        ? 'A product with that slug already exists. Choose a different slug.'
        : 'Database error: ' . $e->getMessage();
    header('Location: /admin/dashboard.php?page=products&err=' . urlencode($msg));
}
exit;
