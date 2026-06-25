<?php
require_once __DIR__ . '/auth.php';

$page = $_GET['page'] ?? 'dashboard';
$validPages = ['dashboard', 'products', 'blog', 'queue', 'members', 'orders', 'files', 'quiz'];
if (!in_array($page, $validPages)) $page = 'dashboard';

$pageTitles = [
    'dashboard' => 'Dashboard',
    'products'  => 'Products',
    'blog'      => 'Blog Posts',
    'queue'     => 'Exclusive Queue',
    'members'   => 'Members',
    'orders'    => 'Orders',
    'files'     => 'File Manager',
    'quiz'      => 'Quiz Results',
];

$navItems = [
    'dashboard' => 'Dashboard',
    'products'  => 'Products',
    'blog'      => 'Blog Posts',
    'queue'     => 'Exclusive Queue',
    'members'   => 'Members',
    'orders'    => 'Orders',
    'files'     => 'File Manager',
    'quiz'      => 'Quiz Results',
];

$successMsg = $_GET['success'] ?? '';
$errorMsg   = $_GET['err'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $pageTitles[$page] ?> — MNC Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
<style>
/* === RESET === */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html, body { height: 100%; }
body { font-family: Arial, sans-serif; background: #f5f4f0; color: #252535; font-size: 14px; line-height: 1.5; }
a { color: inherit; text-decoration: none; }
button { cursor: pointer; }

/* === LAYOUT === */
.admin-wrap { display: flex; min-height: 100vh; }
.sidebar { width: 210px; min-width: 210px; background: #252535; display: flex; flex-direction: column; }
.main-content { flex: 1; display: flex; flex-direction: column; min-width: 0; overflow: hidden; }

/* === SIDEBAR === */
.sidebar-brand { padding: 24px 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); }
.sidebar-brand .brand-name {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 9px;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #E87AAA;
    margin-bottom: 4px;
}
.sidebar-brand .panel-label {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 15px;
    color: #ffffff;
}
.sidebar-nav { flex: 1; padding: 12px 0; }
.nav-item {
    display: block;
    padding: 11px 20px;
    font-family: Arial, sans-serif;
    font-size: 13px;
    color: rgba(255,255,255,0.65);
}
.nav-item:hover { background: rgba(255,255,255,0.06); color: #ffffff; }
.nav-item.active { background: #E87AAA; color: #ffffff; font-weight: bold; }
.sidebar-footer { padding: 16px 20px; border-top: 1px solid rgba(255,255,255,0.1); }
.sidebar-footer a { font-size: 12px; color: rgba(255,255,255,0.45); }
.sidebar-footer a:hover { color: rgba(255,255,255,0.8); }

/* === TOP BAR === */
.top-bar { background: #ffffff; padding: 18px 32px; border-bottom: 1px solid #e0ddd8; }
.top-bar h1 {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 18px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* === BODY === */
.section-body { padding: 28px 32px; flex: 1; overflow-y: auto; }

/* === ALERTS === */
.alert { padding: 12px 16px; margin-bottom: 20px; font-size: 13px; line-height: 1.5; }
.alert-success { background: #edf7e6; border-left: 4px solid #B5CC6A; color: #2d6a1e; }
.alert-error   { background: #fde8e8; border-left: 4px solid #c0392b; color: #c0392b; }

/* === SECTION HEADER === */
.section-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
.section-title {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* === STAT CARDS === */
.stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); gap: 16px; margin-bottom: 32px; }
.stat-card { background: #ffffff; border: 2px solid #8BA7D4; padding: 20px 24px; }
.stat-label {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #666;
    margin-bottom: 8px;
}
.stat-value {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 34px;
    color: #252535;
    line-height: 1;
}

/* === ACTION ITEMS === */
.checklist-section { background: #ffffff; padding: 24px; }
.checklist-section h2 {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 2px solid #252535;
}
.checklist { list-style: none; }
.checklist li {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 10px 0;
    border-bottom: 1px solid #f0ece6;
    font-size: 13px;
    line-height: 1.5;
}
.checklist li:last-child { border-bottom: none; }
.check-box {
    width: 16px;
    height: 16px;
    min-width: 16px;
    border: 2px solid #8BA7D4;
    margin-top: 2px;
}

/* === TABLES === */
.table-wrap { background: #ffffff; overflow-x: auto; }
.admin-table { width: 100%; border-collapse: collapse; }
.admin-table th {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 12px 16px;
    text-align: left;
    border-bottom: 2px solid #252535;
    background: #f5f4f0;
    white-space: nowrap;
}
.admin-table td { padding: 11px 16px; border-bottom: 1px solid #ede9e3; vertical-align: middle; }
.admin-table tr:last-child td { border-bottom: none; }
.admin-table tr:hover td { background: #faf9f7; }

/* === BUTTONS === */
.btn {
    display: inline-block;
    padding: 8px 16px;
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1px;
    border: none;
    cursor: pointer;
    vertical-align: middle;
}
.btn-primary  { background: #E87AAA; color: #ffffff; }
.btn-primary:hover  { background: #d96899; }
.btn-secondary { background: #252535; color: #ffffff; }
.btn-secondary:hover { background: #3a3a4a; }
.btn-outline   { background: transparent; border: 2px solid #252535; color: #252535; }
.btn-outline:hover { background: #252535; color: #ffffff; }
.btn-sm { padding: 5px 10px; font-size: 10px; }
.btn-ghost { background: transparent; border: 1px solid #ccc; color: #555; font-size: 11px; padding: 4px 10px; }
.btn-ghost:hover { background: #f0ece6; }
.btn-danger { background: #c0392b; color: #ffffff; }
.btn-danger:hover { background: #a93226; }

/* === BADGES === */
.badge {
    display: inline-block;
    padding: 3px 8px;
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.badge-active    { background: #B5CC6A; color: #252535; }
.badge-draft     { background: #e0ddd8; color: #666; }
.badge-coming    { background: #EDD96A; color: #252535; }
.badge-published { background: #B5CC6A; color: #252535; }
.badge-warning   { background: #F2A57A; color: #ffffff; }
.no-thumb {
    display: inline-block;
    background: #F2A57A;
    color: #252535;
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 9px;
    padding: 2px 6px;
    text-transform: uppercase;
    letter-spacing: 1px;
    vertical-align: middle;
    margin-left: 6px;
}

/* === FORMS === */
.form-group { margin-bottom: 18px; }
.form-label {
    display: block;
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #252535;
    margin-bottom: 6px;
}
.form-control {
    width: 100%;
    padding: 10px 12px;
    border: 2px solid #e0ddd8;
    background: #ffffff;
    font-family: Arial, sans-serif;
    font-size: 14px;
    color: #252535;
}
.form-control:focus { outline: none; border-color: #8BA7D4; }
textarea.form-control { min-height: 120px; resize: vertical; }
select.form-control { cursor: pointer; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.form-hint { font-size: 12px; color: #888; margin-top: 4px; }
.form-check { display: flex; align-items: center; gap: 8px; }
.form-check input[type="checkbox"] { width: 16px; height: 16px; cursor: pointer; }
.form-check label { font-family: Arial, sans-serif; font-size: 13px; cursor: pointer; }

/* === MODALS === */
.modal-overlay { display: none; position: fixed; inset: 0; background: rgba(37,37,53,0.72); z-index: 200; overflow-y: auto; padding: 40px 16px; }
.modal-overlay.open { display: block; }
.modal { background: #FFF8EE; max-width: 640px; margin: 0 auto; padding: 32px; position: relative; }
.modal-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; }
.modal-title {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 17px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.modal-close {
    background: none;
    border: none;
    font-size: 22px;
    cursor: pointer;
    color: #252535;
    padding: 0;
    line-height: 1;
    margin-left: 12px;
}
.modal-footer { margin-top: 24px; display: flex; gap: 12px; padding-top: 20px; border-top: 1px solid #e8e2d8; }

/* === CALLOUT === */
.callout { padding: 14px 16px; background: #f0edf8; border-left: 4px solid #C4B0E8; margin-bottom: 24px; font-size: 13px; line-height: 1.6; }

/* === SEARCH === */
.search-form { display: flex; gap: 12px; margin-bottom: 20px; align-items: center; }
.search-form .form-control { max-width: 300px; }

/* === FILE MANAGER === */
.file-section { margin-bottom: 28px; }
.file-section-title {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding-bottom: 10px;
    margin-bottom: 12px;
    border-bottom: 2px solid #252535;
}
.file-row {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 9px 0;
    border-bottom: 1px solid #ede9e3;
    font-size: 13px;
}
.file-row:last-child { border-bottom: none; }
.file-name { flex: 1; font-family: Arial, monospace; word-break: break-all; }
.file-meta { color: #888; font-size: 12px; min-width: 140px; text-align: right; }

/* === QUIZ BARS === */
.quiz-bars { margin: 20px 0 28px; }
.bar-row { display: flex; align-items: center; gap: 16px; margin-bottom: 12px; }
.bar-label {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1px;
    min-width: 90px;
}
.bar-track { flex: 1; background: #e0ddd8; height: 30px; }
.bar-fill { height: 100%; display: flex; align-items: center; padding-left: 10px; min-width: 4px; }
.bar-fill.nester   { background: #C4B0E8; }
.bar-fill.busyer   { background: #F2A57A; }
.bar-fill.wonderer { background: #8BA7D4; }
.bar-pct {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 12px;
    min-width: 44px;
    color: #252535;
}

/* === EMPTY STATE === */
.empty-state { padding: 48px 32px; text-align: center; background: #ffffff; color: #888; font-size: 14px; }

/* === UPLOAD FORM === */
.upload-panel { background: #ffffff; padding: 24px; margin-top: 28px; }
.upload-panel h3 {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #252535;
}

/* === TOTAL ROW === */
.table-totals { background: #f5f4f0; border-top: 2px solid #252535; }
.table-totals td { padding: 12px 16px; font-weight: bold; }
</style>
</head>
<body>
<div class="admin-wrap">

    <!-- SIDEBAR -->
    <nav class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-name">My Nest Chapter</div>
            <div class="panel-label">Admin Panel</div>
        </div>
        <div class="sidebar-nav">
            <?php foreach ($navItems as $key => $label): ?>
                <a href="/admin/dashboard.php?page=<?= $key ?>"
                   class="nav-item<?= $page === $key ? ' active' : '' ?>">
                    <?= $label ?>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="sidebar-footer">
            <a href="/admin/logout.php">Sign Out</a>
        </div>
    </nav>

    <!-- MAIN -->
    <div class="main-content">
        <div class="top-bar">
            <h1><?= $pageTitles[$page] ?></h1>
        </div>
        <div class="section-body">
            <?php if ($successMsg): ?>
                <div class="alert alert-success"><?= htmlspecialchars($successMsg) ?></div>
            <?php endif; ?>
            <?php if ($errorMsg): ?>
                <div class="alert alert-error"><?= htmlspecialchars($errorMsg) ?></div>
            <?php endif; ?>
            <?php include __DIR__ . '/sections/' . $page . '.php'; ?>
        </div>
    </div>

</div>

<script>
// Modal open/close
function openModal(id) {
    document.getElementById(id).classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeModal(id) {
    document.getElementById(id).classList.remove('open');
    document.body.style.overflow = '';
}
// Close on overlay click
document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
    overlay.addEventListener('click', function(e) {
        if (e.target === this) closeModal(this.id);
    });
});
// Close on Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-overlay.open').forEach(function(m) {
            closeModal(m.id);
        });
    }
});

// Slug auto-generation from title
function initSlugField(titleId, slugId) {
    var title = document.getElementById(titleId);
    var slug  = document.getElementById(slugId);
    if (!title || !slug) return;
    title.addEventListener('input', function() {
        if (!slug.dataset.manual) {
            slug.value = title.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/[\s-]+/g, '-')
                .replace(/^-|-$/g, '');
        }
    });
    slug.addEventListener('input', function() {
        slug.dataset.manual = '1';
    });
}

// Toggle product status via AJAX
function toggleProduct(id, currentStatus) {
    if (!confirm('Toggle this product status?')) return;
    fetch('/admin/ajax/toggle-product.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({id: id, current: currentStatus})
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.success) location.reload();
        else alert('Error: ' + (data.error || 'Unknown'));
    });
}

// Populate product edit modal
function editProduct(data) {
    var m = document.getElementById('modal-product');
    m.querySelector('[name="id"]').value         = data.id;
    m.querySelector('[name="title"]').value      = data.title;
    m.querySelector('[name="slug"]').value       = data.slug;
    m.querySelector('[name="price"]').value      = data.price;
    m.querySelector('[name="category"]').value   = data.category;
    m.querySelector('[name="short_description"]').value = data.short_description || '';
    m.querySelector('[name="file_path"]').value  = data.file_path || '';
    m.querySelector('[name="stripe_product_id"]').value = data.stripe_product_id || '';
    m.querySelector('.modal-title').textContent  = 'Edit Product';
    m.querySelector('[name="slug"]').dataset.manual = '1';
    openModal('modal-product');
}

function newProduct() {
    var m = document.getElementById('modal-product');
    m.querySelector('[name="id"]').value = '';
    m.querySelector('[name="title"]').value = '';
    m.querySelector('[name="slug"]').value = '';
    m.querySelector('[name="price"]').value = '';
    m.querySelector('[name="category"]').value = 'interactive_tool';
    m.querySelector('[name="short_description"]').value = '';
    m.querySelector('[name="file_path"]').value = '';
    m.querySelector('[name="stripe_product_id"]').value = '';
    m.querySelector('.modal-title').textContent = 'Add Product';
    delete m.querySelector('[name="slug"]').dataset.manual;
    openModal('modal-product');
    initSlugField('product-title', 'product-slug');
}

// Populate blog edit modal
function editPost(data) {
    var m = document.getElementById('modal-blog');
    m.querySelector('[name="id"]').value      = data.id;
    m.querySelector('[name="title"]').value   = data.title;
    m.querySelector('[name="slug"]').value    = data.slug;
    m.querySelector('[name="excerpt"]').value = data.excerpt || '';
    m.querySelector('[name="body"]').value    = data.body || '';
    m.querySelector('.modal-title').textContent = 'Edit Post';
    m.querySelector('[name="slug"]').dataset.manual = '1';
    openModal('modal-blog');
}

function newPost() {
    var m = document.getElementById('modal-blog');
    m.querySelector('[name="id"]').value = '';
    m.querySelector('[name="title"]').value = '';
    m.querySelector('[name="slug"]').value = '';
    m.querySelector('[name="excerpt"]').value = '';
    m.querySelector('[name="body"]').value = '';
    m.querySelector('.modal-title').textContent = 'Add Post';
    delete m.querySelector('[name="slug"]').dataset.manual;
    openModal('modal-blog');
    initSlugField('post-title', 'post-slug');
}

// Toggle blog publish/draft
function togglePost(id, currentStatus) {
    if (!confirm(currentStatus === 'published' ? 'Unpublish this post?' : 'Publish this post?')) return;
    fetch('/admin/ajax/save-post.php?action=toggle', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({id: id, current: currentStatus})
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.success) location.reload();
        else alert('Error: ' + (data.error || 'Unknown'));
    });
}

// Populate queue edit modal
function editQueueItem(data) {
    var m = document.getElementById('modal-queue');
    m.querySelector('[name="id"]').value             = data.id;
    m.querySelector('[name="sequence_number"]').value = data.sequence_number;
    m.querySelector('[name="title"]').value           = data.title;
    m.querySelector('[name="description"]').value     = data.description || '';
    m.querySelector('[name="file_path"]').value       = data.file_path || '';
    m.querySelector('[name="unlock_offset_days"]').value = data.unlock_offset_days;
    m.querySelector('.modal-title').textContent       = 'Edit Queue Item';
    openModal('modal-queue');
}

function newQueueItem() {
    var m = document.getElementById('modal-queue');
    m.querySelector('[name="id"]').value = '';
    m.querySelector('[name="sequence_number"]').value = '';
    m.querySelector('[name="title"]').value = '';
    m.querySelector('[name="description"]').value = '';
    m.querySelector('[name="file_path"]').value = '';
    m.querySelector('[name="unlock_offset_days"]').value = '0';
    m.querySelector('.modal-title').textContent = 'Add Queue Item';
    openModal('modal-queue');
}
</script>
</body>
</html>
