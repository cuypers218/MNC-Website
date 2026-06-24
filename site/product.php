<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';

// Handle download request — generate a secure token and redirect to /download/{token}
if (isset($_GET['download']) && $_GET['download'] == '1') {
    requireLogin();
    $dlSlug = $_GET['slug'] ?? '';
    $dlProduct = getProductBySlug($dlSlug);
    if (!$dlProduct) { header('Location: /shop'); exit; }
    $dlUser = getCurrentUser();
    $dlFree  = $dlProduct['price'] == 0;
    $dlOwned = userOwnsPurchase($dlUser['id'], $dlProduct['id']);
    if (!$dlFree && !$dlOwned) { header('Location: /shop/' . rawurlencode($dlSlug)); exit; }
    if (empty($dlProduct['file_path'])) { header('Location: /shop/' . rawurlencode($dlSlug)); exit; }
    $token = generateDownloadToken($dlUser['id'], $dlProduct['id']);
    header('Location: /download/' . $token);
    exit;
}

$slug = $_GET['slug'] ?? '';
$product = getProductBySlug($slug);

if (!$product) {
    http_response_code(404);
    $pageTitle = 'Not Found';
    require_once __DIR__ . '/includes/header.php';
    echo '<section class="section"><div class="container text-center"><h1>Not Found</h1><p style="color:#666;margin-top:1rem;">This product doesn\'t exist or isn\'t available yet.</p><a href="/shop" class="btn btn-outline" style="margin-top:1.5rem;">Back to Shop</a></div></section>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

$pageTitle = $product['title'];
$pageDescription = $product['short_description'] ?? 'A tool from My Nest Chapter.';
require_once __DIR__ . '/includes/header.php';

$isFree = $product['price'] == 0;
$isComingSoon = $product['status'] === 'coming_soon';
$isInteractiveTool = $product['category'] === 'interactive_tool';
$isOwned = false;

if (isLoggedIn()) {
    $user = getCurrentUser();
    $isOwned = userOwnsPurchase($user['id'], $product['id']);
}

// Get related products
$db = getDB();
$stmt = $db->prepare('SELECT * FROM products WHERE category = ? AND id != ? AND status IN ("active","coming_soon") ORDER BY sort_order LIMIT 3');
$stmt->execute([$product['category'], $product['id']]);
$related = $stmt->fetchAll();
?>

<section class="section">
    <div class="container">
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: start;">
            
            <!-- Product Image / Video -->
            <div>
                <?php if ($product['slug'] === 'garage-sale-planner'): ?>
                    <video autoplay loop muted playsinline controls style="width:100%;border:1px solid #ABABAB;display:block;">
                        <source src="/assets/videos/garage-sale-planner-demo.mp4" type="video/mp4">
                    </video>
                <?php elseif ($product['image_path']): ?>
                    <img src="<?= esc($product['image_path']) ?>" alt="" style="width: 100%; border: 1px solid #ABABAB;">
                <?php else: ?>
                    <div style="width: 100%; height: 400px; background: linear-gradient(135deg, #F5C4A8 0%, #C4B0E8 100%); border: 1px solid #ABABAB; display: flex; align-items: center; justify-content: center;">
                        <span style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; color: #D3D3D3;">PRODUCT IMAGE</span>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Product Details -->
            <div>
                <span style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: #666666;"><?= esc(str_replace('_', ' ', $product['category'])) ?></span>
                
                <h1 style="font-size: 1.75rem; margin: 0.5rem 0 1rem;"><?= esc($product['title']) ?></h1>
                
                <?php if (!$isComingSoon): ?>
                    <p style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 1.5rem; color: #E87AAA; margin-bottom: 1.5rem;">
                        <?= formatPrice($product['price']) ?>
                    </p>
                <?php endif; ?>
                
                <div style="line-height: 1.7; color: #101010; margin-bottom: 2rem;">
                    <?= nl2br(esc($product['description'] ?? $product['short_description'])) ?>
                </div>
                
                <!-- CTA Button -->
                <?php if ($isComingSoon): ?>
                    <button class="btn btn-disabled btn-full" disabled>Coming Soon</button>
                <?php elseif ($isOwned): ?>
                    <?php if ($isInteractiveTool): ?>
                        <a href="/widgets/<?= esc($product['slug']) ?>/" class="btn btn-primary btn-full">Open The Planner</a>
                    <?php else: ?>
                        <a href="/shop/<?= esc($product['slug']) ?>?download=1" class="btn btn-primary btn-full">Download</a>
                    <?php endif; ?>
                    <p style="color: #666666; font-size: 0.85rem; margin-top: 0.75rem; text-align: center;">You own this product.</p>
                <?php elseif ($isFree): ?>
                    <?php if (strpos($product['file_path'] ?? '', 'http') === 0): ?>
                        <a href="<?= esc($product['file_path']) ?>" target="_blank" rel="noopener" class="btn btn-primary btn-full">Download Free</a>
                    <?php elseif (isLoggedIn()): ?>
                        <a href="/shop/<?= esc($product['slug']) ?>?download=1" class="btn btn-primary btn-full">Download Free</a>
                    <?php else: ?>
                        <a href="/register" class="btn btn-primary btn-full">Create Free Account to Download</a>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if (isLoggedIn()): ?>
                        <a href="/checkout?product=<?= esc($product['slug']) ?>" class="btn btn-primary btn-full">Get the <?= esc($product['title']) ?></a>
                    <?php else: ?>
                        <a href="/register" class="btn btn-primary btn-full">Create Account to Purchase</a>
                        <p style="color: #666666; font-size: 0.85rem; margin-top: 0.75rem; text-align: center;">You'll need an account to buy and access your download.</p>
                    <?php endif; ?>
                    <?php
                    $slugsWithDemo = ['cooking-for-one'];
                    $slugsWithQueryDemo = ['goal-habit-tracker'];
                    $slugsWithDirectDemo = ['garage-sale-planner'];
                    if ($isInteractiveTool && in_array($product['slug'], $slugsWithDemo)): ?>
                        <p style="margin-top: 1rem; text-align: center;">
                            <a href="/widgets/<?= esc($product['slug']) ?>-demo/" style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; color: #E87AAA;">Try the demo first &rarr;</a>
                        </p>
                    <?php elseif ($isInteractiveTool && in_array($product['slug'], $slugsWithQueryDemo)): ?>
                        <p style="margin-top: 1rem; text-align: center;">
                            <a href="/widgets/<?= esc($product['slug']) ?>/?demo=1" style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; color: #E87AAA;">Try the demo first &rarr;</a>
                        </p>
                    <?php elseif ($isInteractiveTool && in_array($product['slug'], $slugsWithDirectDemo)): ?>
                        <p style="margin-top: 1rem; text-align: center;">
                            <a href="/widgets/<?= esc($product['slug']) ?>/" style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; color: #E87AAA;">Try it free — no account needed &rarr;</a>
                        </p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Back to shop -->
        <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #D3D3D3;">
            <a href="/shop" style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; color: #E87AAA;">&larr; Back to Shop</a>
        </div>
        
    </div>
</section>

<!-- Related Products -->
<?php if (!empty($related)): ?>
<section class="section-alt">
    <div class="container">
        <h2 class="text-center" style="margin-bottom: 2rem;">You Might Also Like</h2>
        <div class="product-grid">
            <?php foreach ($related as $rel): ?>
            <div class="product-card">
                <?php if ($rel['price'] == 0): ?>
                    <span class="badge badge-free">FREE</span>
                <?php elseif ($rel['status'] === 'coming_soon'): ?>
                    <span class="badge badge-coming">COMING SOON</span>
                <?php else: ?>
                    <span class="badge"><?= formatPrice($rel['price']) ?></span>
                <?php endif; ?>
                
                <?php if ($rel['image_path']): ?>
                    <img src="<?= esc($rel['image_path']) ?>" alt="" class="product-card-image">
                <?php else: ?>
                    <div class="product-card-image" style="background: linear-gradient(135deg, #F5C4A8 0%, #C4B0E8 100%);"></div>
                <?php endif; ?>
                
                <div class="product-card-content">
                    <span class="product-card-category"><?= esc(str_replace('_', ' ', $rel['category'])) ?></span>
                    <h3 class="product-card-title"><?= esc($rel['title']) ?></h3>
                    <p class="product-card-description"><?= esc(truncateWords($rel['short_description'], 20)) ?></p>
                    <a href="/shop/<?= esc($rel['slug']) ?>" class="btn btn-outline">View</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<style>
@media (max-width: 768px) {
    .section > .container > div[style*="grid-template-columns"] {
        display: block !important;
    }
    .section > .container > div[style*="grid-template-columns"] > div:first-child {
        margin-bottom: 2rem;
    }
}
</style>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
