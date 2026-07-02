<?php
require_once __DIR__ . '/auth.php';

$db      = getDB();
$results = [];

// Fix 6pm Cheat Sheet: category 'freebie' is invalid ENUM — stored as blank. Set to 'free'.
$s = $db->prepare("UPDATE products SET category = 'free' WHERE slug = '6pm-cheat-sheet'");
$s->execute();
$results[] = ['ok', '6pm Cheat Sheet — category fixed to "free" (' . $s->rowCount() . ' row updated)'];

// Delete the DRAFT duplicate 6pm Cheat Sheet (keep the active one)
$s = $db->prepare("DELETE FROM products WHERE title = 'The 6pm Cheat Sheet' AND status = 'draft'");
$s->execute();
$results[] = ['ok', 'Draft duplicate 6pm Cheat Sheet — deleted (' . $s->rowCount() . ' row)'];

// Delete the DRAFT "The Someday List Companion" at $9.99 (keep active "Someday Companion" at $7.99)
$s = $db->prepare("DELETE FROM products WHERE title = 'The Someday List Companion' AND status = 'draft'");
$s->execute();
$results[] = ['ok', 'Draft Someday List Companion ($9.99) — deleted (' . $s->rowCount() . ' row)'];

// Final product list
$after = $db->query("SELECT id, title, slug, price, category, status FROM products ORDER BY sort_order, title")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Cleanup Done — MNC Admin</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
<style>
body { font-family: Arial, sans-serif; max-width: 860px; margin: 40px auto; padding: 20px; background: #f5f4f0; }
h1 { font-family: 'Montserrat', Arial, sans-serif; font-weight: 800; font-size: 18px; text-transform: uppercase; color: #E87AAA; margin-bottom: 20px; }
h2 { font-family: 'Montserrat', Arial, sans-serif; font-weight: 800; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; margin: 24px 0 10px; }
.row { padding: 10px 14px; margin-bottom: 8px; font-size: 13px; background: #edf7e6; border-left: 4px solid #B5CC6A; }
table { width: 100%; border-collapse: collapse; background: #fff; }
th { background: #f5f4f0; font-family: 'Montserrat', Arial, sans-serif; font-weight: 800; font-size: 10px; text-transform: uppercase; padding: 10px 12px; text-align: left; border-bottom: 2px solid #252535; }
td { padding: 9px 12px; border-bottom: 1px solid #ede9e3; font-size: 13px; }
.warn { margin-top: 24px; padding: 16px; background: #FFF3CD; border: 1px solid #FFEEBA; font-size: 13px; }
a { color: #E87AAA; }
</style>
</head>
<body>
<h1>Product Cleanup — Done</h1>

<?php foreach ($results as [$type, $msg]): ?>
    <div class="row"><?= htmlspecialchars($msg) ?></div>
<?php endforeach; ?>

<h2>Products now in DB</h2>
<table>
    <thead><tr><th>ID</th><th>Title</th><th>Slug</th><th>Price</th><th>Category</th><th>Status</th></tr></thead>
    <tbody>
    <?php foreach ($after as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['title']) ?></td>
            <td style="font-family:monospace;font-size:12px;"><?= htmlspecialchars($p['slug']) ?></td>
            <td><?= $p['price'] > 0 ? '$' . number_format($p['price'], 2) : 'Free' ?></td>
            <td><?= htmlspecialchars($p['category']) ?></td>
            <td><?= htmlspecialchars($p['status']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="warn">
    <strong>Tell Claude Code "done, delete it"</strong> and it will remove this file from the server.<br><br>
    <a href="/admin/dashboard.php?page=products">Back to Products</a>
</div>
</body>
</html>
