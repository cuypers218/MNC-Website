<?php
$pageTitle = 'Free Tools';
$pageDescription = 'Free tools I made for solo moms navigating the empty nest. No catch. Just things that helped me.';
require_once __DIR__ . '/includes/header.php';

$freeProducts = getFreeProducts();
?>

<section class="section">
    <div class="container">
        
        <h1 class="text-center fade-in" style="margin-bottom: 0.5rem;">Free Tools</h1>
        <p class="text-center fade-in-delay-1" style="color: #666666; font-size: 0.95rem; margin-bottom: 0.25rem;">I made these for you. They're free.</p>
        <p class="text-center fade-in-delay-2" style="color: #666666; font-size: 0.95rem; margin-bottom: 3rem;">No catch. No upsell on the other side. Just things that helped me and might help you.</p>
        
        <?php if (!empty($freeProducts)): ?>
        <div class="product-grid">
            <?php foreach ($freeProducts as $product): ?>
            <div class="product-card fade-in">
                <span class="badge badge-free">FREE</span>
                
                <?php if ($product['image_path']): ?>
                    <img src="<?= esc($product['image_path']) ?>" alt="" class="product-card-image">
                <?php else: ?>
                    <div class="product-card-image" style="background: linear-gradient(135deg, #F4E1DC 0%, #F8D4D4 100%);"></div>
                <?php endif; ?>
                
                <div class="product-card-content">
                    <span class="product-card-category"><?= esc(str_replace('_', ' ', $product['category'])) ?></span>
                    <h3 class="product-card-title"><?= esc($product['title']) ?></h3>
                    <p class="product-card-description"><?= esc($product['short_description']) ?></p>
                    <a href="/shop/<?= esc($product['slug']) ?>" class="btn btn-primary">Get This Free</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center" style="padding: 3rem;">
            <p style="color: #666666;">Free tools are on the way. Check back soon.</p>
        </div>
        <?php endif; ?>
        
    </div>
</section>

<!-- Email Capture -->
<section class="section-cream">
    <div class="container">
        <div class="email-capture" style="border: none; background: transparent;">
            <h3>I Write About This Every Week</h3>
            <p>Real updates from where I am right now. No advice. No coaching. Just one mom being honest about what this looks like.</p>
            <form class="email-capture-form" onsubmit="event.preventDefault(); submitEmailCapture(this, 'freebies');">
                <input type="email" placeholder="Your email" required aria-label="Email address">
                <button type="submit" class="btn btn-primary">Send It</button>
            </form>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
