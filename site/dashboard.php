<?php
$pageTitle = 'My Dashboard';
$pageDescription = 'Your My Nest Chapter dashboard — all your tools in one place.';
require_once __DIR__ . '/includes/header.php';

requireLogin();

$user = getCurrentUser();
$purchases = getUserPurchases($user['id']);
$purchasedIds = array_column($purchases, 'id');
$allProducts = getProducts();
$freeProducts = getFreeProducts();

// Welcome message for new accounts
$isWelcome = isset($_GET['welcome']);
?>

<section class="section">
    <div class="container">
        
        <!-- Welcome -->
        <h1 class="dashboard-welcome fade-in">Hey <?= esc($user['first_name']) ?></h1>
        
        <?php if ($isWelcome): ?>
            <p class="fade-in-delay-1" style="color: #444444; margin-bottom: 2rem;">Welcome to My Nest Chapter. This is your home base — everything you unlock shows up here.</p>
        <?php endif; ?>
        
        <!-- Filter Tabs -->
        <nav class="filter-nav" style="justify-content: flex-start;">
            <button class="filter-tab active" onclick="filterDashboard('all')">All Tools</button>
            <button class="filter-tab" onclick="filterDashboard('unlocked')">My Unlocked Tools</button>
            <button class="filter-tab" onclick="filterDashboard('free')">Free Tools</button>
            <button class="filter-tab" onclick="filterDashboard('locked')">Available to Unlock</button>
        </nav>
        
        <!-- Product Grid -->
        <div class="product-grid" id="dashboardGrid">
            
            <?php if (empty($allProducts) && empty($freeProducts)): ?>
                <!-- Empty state when no products exist yet -->
                <div style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                    <p style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; color: #D3D3D3; margin-bottom: 0.5rem;">MY NEST CHAPTER</p>
                    <p style="color: #666666; font-size: 0.9rem;">New tools are on the way. Check back soon.</p>
                </div>
            <?php else: ?>
            
                <?php foreach ($allProducts as $product): 
                    $isOwned = in_array($product['id'], $purchasedIds);
                    $isFree = $product['price'] == 0;
                    $isUnlocked = $isOwned || $isFree;
                    $cardClass = $isUnlocked ? '' : 'product-card-locked';
                    $dataStatus = $isFree ? 'free' : ($isOwned ? 'unlocked' : 'locked');
                ?>
                <div class="product-card <?= $cardClass ?> fade-in" data-status="<?= $dataStatus ?>" data-category="<?= esc($product['category']) ?>">
                    
                    <!-- Badge -->
                    <?php if ($isFree): ?>
                        <span class="badge badge-free">FREE</span>
                    <?php elseif ($isOwned): ?>
                        <span class="badge badge-unlocked">UNLOCKED</span>
                    <?php elseif ($product['status'] === 'coming_soon'): ?>
                        <span class="badge badge-coming">COMING SOON</span>
                    <?php else: ?>
                        <span class="badge"><?= formatPrice($product['price']) ?></span>
                    <?php endif; ?>
                    
                    <!-- Image -->
                    <?php if ($product['image_path']): ?>
                        <img src="<?= esc($product['image_path']) ?>" alt="" class="product-card-image">
                    <?php else: ?>
                        <div class="product-card-image" style="background: linear-gradient(135deg, #F4E8C1 0%, #F8BBD0 100%);"></div>
                    <?php endif; ?>
                    
                    <!-- Content -->
                    <div class="product-card-content">
                        <span class="product-card-category"><?= esc(str_replace('_', ' ', $product['category'])) ?></span>
                        <h3 class="product-card-title"><?= esc($product['title']) ?></h3>
                        <p class="product-card-description"><?= esc(truncateWords($product['short_description'], 20)) ?></p>
                        
                        <?php if ($isUnlocked): ?>
                            <?php if ($product['file_path']): ?>
                                <a href="/shop/<?= esc($product['slug']) ?>?download=1" class="btn btn-primary">Download</a>
                            <?php else: ?>
                                <a href="/shop/<?= esc($product['slug']) ?>" class="btn btn-primary">Open</a>
                            <?php endif; ?>
                        <?php elseif ($product['status'] === 'coming_soon'): ?>
                            <button class="btn btn-disabled" disabled>Coming Soon</button>
                        <?php else: ?>
                            <a href="/shop/<?= esc($product['slug']) ?>" class="btn btn-outline">Unlock — <?= formatPrice($product['price']) ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
                
            <?php endif; ?>
        </div>
        
        <!-- Quick Links -->
        <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #D3D3D3;">
            <p class="dashboard-section-title">Quick Links</p>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="/blog" class="btn btn-outline">Read the Blog</a>
                <a href="/shop" class="btn btn-outline">Browse the Shop</a>
                <a href="/freebies" class="btn btn-outline">Free Tools</a>
                <a href="/resources" class="btn btn-outline">Resources</a>
            </div>
        </div>
        
        <!-- Account -->
        <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #D3D3D3;">
            <p class="dashboard-section-title">Account</p>
            <p style="color: #666666; font-size: 0.9rem; margin-bottom: 0.5rem;">Logged in as <?= esc($user['email']) ?></p>
            <a href="/api/auth?action=logout" style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: #811453;">Log Out</a>
        </div>
        
    </div>
</section>

<script>
function filterDashboard(filter) {
    var cards = document.querySelectorAll('#dashboardGrid .product-card');
    var tabs = document.querySelectorAll('.filter-tab');
    
    // Update active tab
    tabs.forEach(function(tab) { tab.classList.remove('active'); });
    event.target.classList.add('active');
    
    // Filter cards
    cards.forEach(function(card) {
        var status = card.getAttribute('data-status');
        
        if (filter === 'all') {
            card.style.display = 'flex';
        } else if (filter === 'unlocked') {
            card.style.display = (status === 'unlocked' || status === 'free') ? 'flex' : 'none';
        } else if (filter === 'free') {
            card.style.display = (status === 'free') ? 'flex' : 'none';
        } else if (filter === 'locked') {
            card.style.display = (status === 'locked') ? 'flex' : 'none';
        }
    });
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
