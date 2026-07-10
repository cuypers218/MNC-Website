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

// Handle thumbnail upload.
// Normalizes every upload to a JPG on the server rather than trusting the
// source extension -- previously any format outside a hardcoded whitelist
// (notably HEIC, the default format for iPhone camera photos) silently did
// nothing: no error, no image, just the "PRODUCT IMAGE" placeholder staying
// up forever with zero feedback that the upload had failed.
$imagePath   = null;
$uploadError = null;
if (!empty($_FILES['thumbnail']['name'])) {
    $file = $_FILES['thumbnail'];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $uploadError = 'Upload failed (error code ' . $file['error'] . '). Try a smaller file.';
    } else {
        $uploadDir = __DIR__ . '/../../uploads/thumbnails/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $safeSlug = $slug ?: 'product-' . time();
        $dest     = $uploadDir . $safeSlug . '.jpg';
        $loaded   = false;

        // Try Imagick first -- it can read HEIC/HEIF (iPhone default) and
        // just about anything else, which GD cannot.
        if (extension_loaded('imagick')) {
            try {
                $im = new Imagick($file['tmp_name']);
                $im->setImageFormat('jpeg');
                $im->setImageCompressionQuality(85);
                if ($im->getImageWidth() > 1600) {
                    $im->scaleImage(1600, 0);
                }
                $im->writeImage($dest);
                $im->clear();
                $loaded = true;
            } catch (Exception $e) {
                $loaded = false;
            }
        }

        // Fall back to GD for standard web formats if Imagick isn't available
        // or couldn't read this particular file.
        if (!$loaded) {
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $gdLoaders = [
                'jpg' => 'imagecreatefromjpeg', 'jpeg' => 'imagecreatefromjpeg',
                'png' => 'imagecreatefrompng', 'webp' => 'imagecreatefromwebp',
                'gif' => 'imagecreatefromgif',
            ];
            if (isset($gdLoaders[$ext]) && function_exists($gdLoaders[$ext])) {
                $img = @$gdLoaders[$ext]($file['tmp_name']);
                if ($img) {
                    $w = imagesx($img);
                    $h = imagesy($img);
                    if ($w > 1600) {
                        $newH = (int) round($h * (1600 / $w));
                        $resized = imagecreatetruecolor(1600, $newH);
                        imagecopyresampled($resized, $img, 0, 0, 0, 0, 1600, $newH, $w, $h);
                        imagedestroy($img);
                        $img = $resized;
                    }
                    imagejpeg($img, $dest, 85);
                    imagedestroy($img);
                    $loaded = true;
                }
            }
        }

        if ($loaded) {
            $imagePath = '/uploads/thumbnails/' . $safeSlug . '.jpg';
        } else {
            $uploadError = 'That image format isn\'t supported. If this came straight from an iPhone, it may be HEIC -- try Settings > Camera > Formats > "Most Compatible" so new photos save as JPG, or use "Share" > "Save as JPG" on this one.';
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
        if ($uploadError) {
            header('Location: /admin/dashboard.php?page=products&err=' . urlencode('Product updated, but the image failed: ' . $uploadError));
        } else {
            header('Location: /admin/dashboard.php?page=products&success=' . urlencode('Product updated.'));
        }
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
        if ($uploadError) {
            header('Location: /admin/dashboard.php?page=products&err=' . urlencode('Product added, but the image failed: ' . $uploadError));
        } else {
            header('Location: /admin/dashboard.php?page=products&success=' . urlencode('Product added.'));
        }
    }
} catch (Exception $e) {
    $msg = strpos($e->getMessage(), 'Duplicate') !== false
        ? 'A product with that slug already exists. Choose a different slug.'
        : 'Database error: ' . $e->getMessage();
    header('Location: /admin/dashboard.php?page=products&err=' . urlencode($msg));
}
exit;
