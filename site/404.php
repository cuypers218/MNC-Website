<?php
$pageTitle = 'Page Not Found';
$pageDescription = 'This page doesn\'t exist.';
require_once __DIR__ . '/includes/header.php';
?>

<section class="section">
    <div class="container text-center" style="padding: 4rem 0;">
        <h1 style="font-size: 3rem; color: #E87AAA; margin-bottom: 0.5rem;">404</h1>
        <p style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; color: #666666; margin-bottom: 2rem;">This page doesn't exist</p>
        <p style="color: #444444; margin-bottom: 2rem;">It might have moved, or maybe the link was wrong. Either way, here are some places to go.</p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="/" class="btn btn-primary">Go Home</a>
            <a href="/shop" class="btn btn-outline">Browse the Shop</a>
            <a href="/blog" class="btn btn-outline">Read the Blog</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
