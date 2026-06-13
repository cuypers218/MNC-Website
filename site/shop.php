<?php
$pageTitle = 'Shop';
$pageDescription = 'Tools and resources built from lived experience, for single and solo moms navigating the empty nest.';
require_once __DIR__ . '/includes/header.php';

$allProducts = getProducts();
?>

<section class="section">
    <div class="container">

        <h1 class="text-center fade-in" style="margin-bottom: 0.25rem;">Shop</h1>
        <p class="text-center fade-in-delay-1" style="color: #666666; font-size: 0.95rem; margin-bottom: 0;">Tools built from lived experience.</p>

        <!-- Filter Tabs -->
        <nav class="filter-nav">
            <button class="filter-tab active" onclick="filterShop('all')">All</button>
            <button class="filter-tab" onclick="filterShop('workbook')">Workbooks</button>
            <button class="filter-tab" onclick="filterShop('companion')">Companions</button>
            <button class="filter-tab" onclick="filterShop('interactive_tool')">Interactive Tools</button>
        </nav>

        <!-- Product Grid — paid products only -->
        <div class="product-grid" id="shopGrid">

            <?php
            $paidProducts = array_filter($allProducts, fn($p) => $p['price'] > 0);
            if (empty($paidProducts)): ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                    <p style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; color: #D3D3D3; margin-bottom: 0.5rem;">MY NEST CHAPTER</p>
                    <p style="color: #666666; font-size: 0.9rem;">Products are on the way. Check back soon.</p>
                </div>
            <?php else: ?>
                <?php foreach ($paidProducts as $product):
                    $isComingSoon = $product['status'] === 'coming_soon';
                ?>
                <div class="product-card fade-in" data-category="<?= esc($product['category']) ?>">
                    <?php if ($isComingSoon): ?>
                        <span class="badge badge-coming">COMING SOON</span>
                    <?php else: ?>
                        <span class="badge"><?= formatPrice($product['price']) ?></span>
                    <?php endif; ?>

                    <?php if ($product['image_path']): ?>
                        <img src="<?= esc($product['image_path']) ?>" alt="" class="product-card-image">
                    <?php else: ?>
                        <div class="product-card-image" style="background: linear-gradient(135deg, #F4E8C1 0%, #F8BBD0 100%);"></div>
                    <?php endif; ?>

                    <div class="product-card-content">
                        <span class="product-card-category"><?= esc(str_replace('_', ' ', $product['category'])) ?></span>
                        <h3 class="product-card-title"><?= esc($product['title']) ?></h3>
                        <p class="product-card-description"><?= esc(truncateWords($product['short_description'], 25)) ?></p>

                        <?php if ($isComingSoon): ?>
                            <button class="btn btn-disabled" disabled>Coming Soon</button>
                        <?php else: ?>
                            <a href="/shop/<?= esc($product['slug']) ?>" class="btn btn-primary">Get the <?= esc($product['title']) ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Freebies nudge -->
        <div style="text-align:center;margin-top:3rem;padding-top:2rem;border-top:1px solid #D3D3D3;">
            <p style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.1em;color:#ABABAB;margin-bottom:0.5rem;">Looking for the free stuff?</p>
            <a href="/freebies" style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:0.8rem;text-transform:uppercase;letter-spacing:0.05em;color:#E87AAA;">Browse the Freebies Page &rarr;</a>
        </div>
    </div>
</section>

<script>
function filterShop(category) {
    var cards = document.querySelectorAll('#shopGrid .product-card');
    var tabs = document.querySelectorAll('.filter-tab');
    tabs.forEach(function(tab) { tab.classList.remove('active'); });
    event.target.classList.add('active');
    cards.forEach(function(card) {
        if (category === 'all') { card.style.display = 'flex'; }
        else { card.style.display = (card.getAttribute('data-category') === category) ? 'flex' : 'none'; }
    });
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
