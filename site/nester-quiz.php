<?php
$pageTitle = 'What Kind of Empty Nester Are You?';
$pageDescription = 'Ten questions, three possible types. Find out which one fits where you are right now.';
require_once __DIR__ . '/includes/header.php';
?>

<section class="section-cream">
    <div class="container-narrow text-center" style="padding-bottom: 0;">
        <p style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; color: #8BA7D4; margin-bottom: 1.5rem;">Not sure where you fit? Start here.</p>
        <h1 style="font-size: 1.6rem; color: #252535; margin-bottom: 1.5rem;">What Kind of Empty Nester Are You?</h1>
    </div>
    <div class="container-narrow" style="padding-top: 0.5rem; padding-bottom: 2.5rem;">
        <iframe src="/widgets/empty-nester-quiz/" style="width:100%; height:min(95vh,900px); border:none; border-radius:10px; overflow:hidden; display:block; max-width:610px; margin:0 auto;" title="What Kind of Empty Nester Are You?"></iframe>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
