<?php
$pageTitle = 'My Dashboard';
$pageDescription = 'Your My Nest Chapter dashboard — all your tools in one place.';
require_once __DIR__ . '/includes/header.php';

requireLogin();

$user = getCurrentUser();
$purchases = getUserPurchases($user['id']);
$freeProducts = getFreeProducts();

$isWelcome = isset($_GET['welcome']);

$quizResult = $user['quiz_result'] ?? null;
$typeLabels = ['nester' => 'The Nester', 'busyer' => 'The Busy-er', 'wonderer' => 'The Wonderer'];
?>

<section class="section">
    <div class="container">

        <!-- Welcome -->
        <h1 class="dashboard-welcome fade-in">Hey <?= esc($user['first_name']) ?></h1>

        <?php if ($isWelcome): ?>
            <p class="fade-in-delay-1" style="color:#444444;margin-bottom:2rem;">Welcome to My Nest Chapter. This is your home base — everything you unlock shows up here.</p>
        <?php endif; ?>

        <!-- Your Empty Nest Type -->
        <div style="background:#252535;padding:28px 32px;margin-bottom:2.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
            <div>
                <p style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:0.65rem;text-transform:uppercase;letter-spacing:0.15em;color:#A8C5DA;margin-bottom:0.35rem;">YOUR EMPTY NEST TYPE</p>
                <?php if ($quizResult && isset($typeLabels[$quizResult])): ?>
                    <p style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:1.1rem;color:#FFF8EE;margin:0;"><?= esc($typeLabels[$quizResult]) ?></p>
                <?php else: ?>
                    <p style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:1rem;color:#FFF8EE;margin:0;">Not sure which one you are yet</p>
                <?php endif; ?>
            </div>
            <a href="/nest-type" style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.05em;color:#E87AAA;white-space:nowrap;"><?= $quizResult ? 'View Your Type &amp; Download &rarr;' : 'Find Out &rarr;' ?></a>
        </div>

        <!-- ===== YOUR PRODUCTS ===== -->
        <p class="dashboard-section-title">Your Products</p>

        <?php if (empty($purchases)): ?>
            <div style="padding:20px 0 2.5rem;">
                <p style="color:#666666;font-size:0.95rem;margin:0 0 0.5rem;">Nothing here yet. Once you buy something, it'll show up here.</p>
                <a href="/shop" style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.05em;color:#E87AAA;">Browse the Shop &rarr;</a>
            </div>
        <?php else: ?>
            <div class="product-grid" style="margin-bottom:3rem;">
                <?php foreach ($purchases as $product): ?>
                <div class="product-card fade-in">
                    <span class="badge badge-unlocked">UNLOCKED</span>

                    <?php if ($product['image_path']): ?>
                        <img src="<?= esc($product['image_path']) ?>" alt="" class="product-card-image">
                    <?php else: ?>
                        <div class="product-card-image" style="background:linear-gradient(135deg,#F4E8C1 0%,#F8BBD0 100%);"></div>
                    <?php endif; ?>

                    <div class="product-card-content">
                        <span class="product-card-category"><?= esc(str_replace('_', ' ', $product['category'])) ?></span>
                        <h3 class="product-card-title"><?= esc($product['title']) ?></h3>
                        <p class="product-card-description"><?= esc(truncateWords($product['short_description'], 20)) ?></p>

                        <?php if ($product['category'] === 'interactive_tool'): ?>
                            <a href="/widgets/<?= esc($product['slug']) ?>/" class="btn btn-primary">Open Tool</a>
                        <?php elseif ($product['file_path']): ?>
                            <?php if (strpos($product['file_path'], 'http') === 0): ?>
                                <a href="<?= esc($product['file_path']) ?>" target="_blank" rel="noopener" class="btn btn-primary">Download Again</a>
                            <?php else: ?>
                                <a href="/shop/<?= esc($product['slug']) ?>?download=1" class="btn btn-primary">Download Again</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="/shop/<?= esc($product['slug']) ?>" class="btn btn-primary">Open</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- ===== FREEBIES ===== -->
        <p class="dashboard-section-title">Freebies</p>
        <div class="product-grid" style="margin-bottom:3rem;">

            <?php foreach ($freeProducts as $product):
                if ($product['slug'] === 'empty-nester-quiz') continue;
            ?>
            <div class="product-card fade-in">
                <span class="badge badge-free">FREE</span>

                <?php if ($product['image_path']): ?>
                    <img src="<?= esc($product['image_path']) ?>" alt="" class="product-card-image">
                <?php else: ?>
                    <div class="product-card-image" style="background:linear-gradient(135deg,#F4E8C1 0%,#F8BBD0 100%);"></div>
                <?php endif; ?>

                <div class="product-card-content">
                    <span class="product-card-category"><?= esc(str_replace('_', ' ', $product['category'])) ?></span>
                    <h3 class="product-card-title"><?= esc($product['title']) ?></h3>
                    <p class="product-card-description"><?= esc(truncateWords($product['short_description'], 20)) ?></p>

                    <?php if ($product['category'] === 'interactive_tool'): ?>
                        <?php $memberParam = in_array($product['slug'], ['someday-list', 'coloring-widget']) ? '?member=1' : ''; ?>
                        <a href="/widgets/<?= esc($product['slug']) ?>/<?= $memberParam ?>" class="btn btn-primary">Open Tool</a>
                    <?php elseif ($product['file_path']): ?>
                        <?php if (strpos($product['file_path'], 'http') === 0): ?>
                            <a href="<?= esc($product['file_path']) ?>" target="_blank" rel="noopener" class="btn btn-primary">Download</a>
                        <?php else: ?>
                            <a href="/shop/<?= esc($product['slug']) ?>?download=1" class="btn btn-primary">Download</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="/shop/<?= esc($product['slug']) ?>" class="btn btn-primary">Open</a>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($product['slug'] === 'someday-list'): ?>
            <div class="product-card fade-in" style="background:#FFF8EE;border:1.5px solid #cfc7e8;">
                <span class="badge" style="background:#E87AAA;color:#FFFFFF;">$7.99</span>
                <div style="height:140px;background:linear-gradient(135deg,#F4E8C1 0%,#F8BBD0 100%);display:flex;align-items:center;justify-content:center;">
                    <p style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:0.7rem;text-transform:uppercase;letter-spacing:0.1em;color:#C45C88;">SOMEDAY COMPANION</p>
                </div>
                <div class="product-card-content">
                    <span class="product-card-category">companion</span>
                    <h3 class="product-card-title">Ready to do something with your list?</h3>
                    <p class="product-card-description">The Someday Companion is where your list becomes a real starting point. One item at a time.</p>
                    <a href="/shop/someday-companion" class="btn btn-primary">Get the Companion</a>
                </div>
            </div>
            <?php endif; ?>

            <?php endforeach; ?>

            <!-- Quiz card — handled separately since it depends on quiz_result -->
            <div class="product-card fade-in">
                <span class="badge badge-free">FREE</span>
                <div style="height:140px;background:#252535;display:flex;align-items:center;justify-content:center;padding:0 20px;text-align:center;">
                    <p style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:0.7rem;text-transform:uppercase;letter-spacing:0.1em;color:#A8C5DA;margin:0;">WHAT KIND OF NESTER ARE YOU?</p>
                </div>
                <div class="product-card-content">
                    <span class="product-card-category">quiz</span>
                    <h3 class="product-card-title">What Kind of Nester Are You?</h3>
                    <?php if ($quizResult && isset($typeLabels[$quizResult])): ?>
                        <p class="product-card-description">You're <?= esc($typeLabels[$quizResult]) ?>. View your full result and download your type guide.</p>
                        <a href="/nest-type" class="btn btn-primary">View Your Type &rarr;</a>
                    <?php else: ?>
                        <p class="product-card-description">Ten questions. Three possible types. Find out which one fits where you are right now.</p>
                        <a href="/nester-quiz" class="btn btn-primary">Discover Your Type &rarr;</a>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- ===== FOR MEMBERS ===== -->
        <p class="dashboard-section-title">For Members</p>
        <div style="background:#FFF8EE;padding:28px 32px;margin-bottom:3rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1.5rem;">
            <div>
                <p style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:0.65rem;text-transform:uppercase;letter-spacing:0.15em;color:#A8C5DA;margin-bottom:0.5rem;">MEMBER EXCLUSIVE</p>
                <p style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:1rem;color:#252535;margin:0 0 0.25rem;">Members get [X]% off [product].</p>
                <p style="font-family:Arial,sans-serif;font-size:0.85rem;color:#666666;margin:0 0 0.4rem;">Use this code at checkout:</p>
                <p style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:1.3rem;color:#E87AAA;letter-spacing:0.12em;margin:0;" id="couponCode">MEMBER[XX]</p>
            </div>
            <button onclick="copyCode()" id="copyBtn" style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.05em;background:#E87AAA;color:#FFFFFF;border:none;padding:14px 32px;cursor:pointer;">Copy Code</button>
        </div>

        <!-- Quick Links -->
        <div style="margin-top:3rem;padding-top:2rem;border-top:1px solid #D3D3D3;">
            <p class="dashboard-section-title">Quick Links</p>
            <div style="display:flex;gap:1rem;flex-wrap:wrap;">
                <a href="/blog" class="btn btn-outline">Read the Blog</a>
                <a href="/shop" class="btn btn-outline">Browse the Shop</a>
                <a href="/freebies" class="btn btn-outline">Freebies</a>
                <a href="/resources" class="btn btn-outline">Resources</a>
            </div>
        </div>

        <!-- Account -->
        <div style="margin-top:3rem;padding-top:2rem;border-top:1px solid #D3D3D3;">
            <p class="dashboard-section-title">Account</p>
            <p style="color:#666666;font-size:0.9rem;margin-bottom:0.5rem;">Logged in as <?= esc($user['email']) ?></p>
            <a href="/api/auth?action=logout" style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.05em;color:#E87AAA;">Log Out</a>
        </div>

    </div>
</section>

<script>
function copyCode() {
    var code = document.getElementById('couponCode').textContent;
    navigator.clipboard.writeText(code).then(function() {
        var btn = document.getElementById('copyBtn');
        btn.textContent = 'Copied!';
        setTimeout(function() { btn.textContent = 'Copy Code'; }, 2000);
    });
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
