<?php
$db = getDB();
$products = $db->query("SELECT * FROM products ORDER BY sort_order, title")->fetchAll();

// Valid category values from the ENUM
$categories = [
    'workbook'         => 'Workbook',
    'companion'        => 'Companion',
    'checklist'        => 'Checklist',
    'interactive_tool' => 'Interactive Tool',
    'free'             => 'Free',
];

// Products that live at a non-standard URL (not /shop/{slug})
$urlOverrides = [
    'now-what-workbook' => '/workbook',
    '6pm-cheat-sheet'   => '/6pm-cheat-sheet',
    'coloring-widget'   => '/coloring',
    'nester-quiz'       => '/nester-quiz',
];

function getProductViewUrl(string $slug, string $category, array $overrides): string {
    if (isset($overrides[$slug])) return $overrides[$slug];
    if ($category === 'interactive_tool') return '/widgets/' . $slug . '/widget.html';
    return '/shop/' . $slug;
}
?>

<div class="section-header">
    <span class="section-title">All Products (<?= count($products) ?>)</span>
    <button class="btn btn-primary" onclick="newProduct()">Add Product</button>
</div>

<div class="table-wrap">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Status</th>
                <th>Thumbnail</th>
                <th>Actions</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!$products): ?>
                <tr><td colspan="7" style="text-align:center;color:#888;padding:32px;">No products yet.</td></tr>
            <?php endif; ?>
            <?php foreach ($products as $p): ?>
                <tr>
                    <td><?= esc($p['title']) ?></td>
                    <td><?= $p['price'] > 0 ? '$' . number_format($p['price'], 2) : '<span style="color:#888;">Free</span>' ?></td>
                    <td><?= esc($categories[$p['category']] ?? $p['category']) ?></td>
                    <td>
                        <?php if ($p['status'] === 'active'): ?>
                            <span class="badge badge-active">Active</span>
                        <?php elseif ($p['status'] === 'draft'): ?>
                            <span class="badge badge-draft">Draft</span>
                        <?php else: ?>
                            <span class="badge badge-coming">Coming Soon</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!empty($p['image_path'])): ?>
                            <span style="color:#2d6a1e;font-size:12px;">Set</span>
                        <?php else: ?>
                            <span class="no-thumb">No Image</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-outline"
                            onclick="editProduct(<?= htmlspecialchars(json_encode([
                                'id'                => $p['id'],
                                'title'             => $p['title'],
                                'slug'              => $p['slug'],
                                'price'             => $p['price'],
                                'category'          => $p['category'],
                                'short_description' => $p['short_description'] ?? '',
                                'file_path'         => $p['file_path'] ?? '',
                                'stripe_product_id' => $p['stripe_product_id'] ?? $p['stripe_id'] ?? '',
                                'image_path'        => $p['image_path'] ?? '',
                                'view_url'          => getProductViewUrl($p['slug'], $p['category'], $urlOverrides),
                            ]), ENT_QUOTES) ?>)">
                            Edit
                        </button>
                        <button class="btn btn-sm btn-ghost"
                            onclick="toggleProduct(<?= (int)$p['id'] ?>, '<?= esc($p['status']) ?>')">
                            <?= $p['status'] === 'active' ? 'Hide' : 'Activate' ?>
                        </button>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-secondary"
                           href="<?= esc(getProductViewUrl($p['slug'], $p['category'], $urlOverrides)) ?>"
                           target="_blank" rel="noopener">
                            View &rarr;
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- PRODUCT MODAL -->
<div class="modal-overlay" id="modal-product">
    <div class="modal">
        <div class="modal-header">
            <span class="modal-title">Add Product</span>
            <button class="modal-close" onclick="closeModal('modal-product')">&times;</button>
        </div>
        <form method="POST" action="/admin/ajax/save-product.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="">

            <div id="product-view-bar" style="display:none;margin-bottom:18px;padding:10px 14px;background:#f0edf8;border-left:4px solid #8BA7D4;display:flex;align-items:center;justify-content:space-between;gap:12px;">
                <span id="product-view-url" style="font-size:12px;color:#555;font-family:Arial,monospace;word-break:break-all;"></span>
                <a id="product-view-link" href="#" target="_blank" rel="noopener" class="btn btn-sm btn-secondary" style="white-space:nowrap;">Open &rarr;</a>
            </div>

            <div id="product-thumb-bar" style="display:none;margin-bottom:18px;">
                <div style="font-family:'Montserrat',Arial,sans-serif;font-weight:800;font-size:10px;text-transform:uppercase;letter-spacing:1px;color:#252535;margin-bottom:6px;">Current Thumbnail</div>
                <img id="product-thumb-preview" src="" alt="" style="max-height:80px;max-width:180px;display:block;object-fit:contain;">
            </div>

            <div class="form-group">
                <label class="form-label" for="product-title">Product Name</label>
                <input class="form-control" type="text" id="product-title" name="title" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="product-slug">URL Slug</label>
                    <input class="form-control" type="text" id="product-slug" name="slug" required>
                    <p class="form-hint">Lowercase, hyphens only</p>
                </div>
                <div class="form-group">
                    <label class="form-label" for="product-price">Price</label>
                    <input class="form-control" type="text" id="product-price" name="price" placeholder="27.00 (blank = free)">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="product-category">Category</label>
                <select class="form-control" id="product-category" name="category">
                    <?php foreach ($categories as $val => $label): ?>
                        <option value="<?= $val ?>"><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="product-desc">Short Description</label>
                <textarea class="form-control" id="product-desc" name="short_description" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Thumbnail Image</label>
                <input class="form-control" type="file" name="thumbnail" accept="image/*">
                <p class="form-hint">Saved to /uploads/thumbnails/. Leave blank to keep existing.</p>
            </div>

            <div class="form-group">
                <label class="form-label" for="product-filepath">File Path or URL</label>
                <input class="form-control" type="text" id="product-filepath" name="file_path" placeholder="/downloads/products/my-file.pdf">
            </div>

            <div class="form-group">
                <label class="form-label" for="product-stripe">Stripe Product ID</label>
                <input class="form-control" type="text" id="product-stripe" name="stripe_product_id" placeholder="prod_xxx (optional)">
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" id="product-active" name="set_active" value="1" checked>
                    <label for="product-active">Set as Active immediately</label>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="button" class="btn btn-outline" onclick="closeModal('modal-product')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
initSlugField('product-title', 'product-slug');
</script>
