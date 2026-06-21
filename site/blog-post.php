<?php
require_once __DIR__ . '/includes/functions.php';

$slug = $_GET['slug'] ?? '';
$post = getPostBySlug($slug);

if (!$post) {
    http_response_code(404);
    $pageTitle = 'Not Found';
    require_once __DIR__ . '/includes/header.php';
    echo '<section class="section"><div class="container text-center"><h1>Post Not Found</h1><p style="color:#666;margin-top:1rem;">This post doesn\'t exist or hasn\'t been published yet.</p><a href="/blog" class="btn btn-outline" style="margin-top:1.5rem;">Back to Blog</a></div></section>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

$pageTitle = $post['title'];
$pageDescription = $post['meta_description'] ?? $post['excerpt'] ?? '';
require_once __DIR__ . '/includes/header.php';

// Get related posts
$db = getDB();
$stmt = $db->prepare('SELECT id, title, slug, excerpt, featured_image, category, published_at FROM blog_posts WHERE status = "published" AND id != ? ORDER BY published_at DESC LIMIT 3');
$stmt->execute([$post['id']]);
$related = $stmt->fetchAll();
?>

<article class="blog-post">
    
    <?php if ($post['category']): ?>
        <span style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.12em; color: #666666;"><?= esc($post['category']) ?></span>
    <?php endif; ?>
    
    <h1 class="blog-post-title fade-in"><?= esc($post['title']) ?></h1>
    
    <div class="blog-post-meta fade-in-delay-1"><?= formatDate($post['published_at']) ?></div>
    
    <?php if ($post['featured_image']): ?>
        <img src="<?= esc($post['featured_image']) ?>" alt="" style="width: 100%; margin-bottom: 2rem; border: 1px solid #ABABAB;">
    <?php endif; ?>
    
    <div class="blog-post-body fade-in-delay-2">
        <?= $post['body'] ?>
    </div>
    
    <!-- Email Capture -->
    <div class="email-capture" style="margin-top: 3rem;">
        <h3>I Write About This Every Week</h3>
        <p>If this one landed, there's more where it came from. Real updates, not advice.</p>
        <form class="email-capture-form" onsubmit="event.preventDefault(); submitEmailCapture(this, 'blog-<?= esc($post['slug']) ?>');">
            <input type="email" placeholder="Your email" required aria-label="Email address">
            <button type="submit" class="btn btn-primary">Send It</button>
        </form>
    </div>
    
    <!-- Back to blog -->
    <div style="margin-top: 2.5rem; padding-top: 1.5rem; border-top: 1px solid #D3D3D3;">
        <a href="/blog" style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; color: #E87AAA;">&larr; Back to Blog</a>
    </div>
    
</article>

<!-- Related Posts -->
<?php if (!empty($related)): ?>
<section class="section-alt">
    <div class="container">
        <h2 class="text-center" style="margin-bottom: 2rem;">More from the Blog</h2>
        <div class="blog-grid">
            <?php foreach ($related as $rel): ?>
            <article class="blog-card">
                <?php if ($rel['featured_image']): ?>
                    <img src="<?= esc($rel['featured_image']) ?>" alt="" class="blog-card-image">
                <?php endif; ?>
                <div class="blog-card-content">
                    <?php if ($rel['category']): ?>
                        <span class="blog-card-category"><?= esc($rel['category']) ?></span>
                    <?php endif; ?>
                    <h3 class="blog-card-title">
                        <a href="/blog/<?= esc($rel['slug']) ?>"><?= esc($rel['title']) ?></a>
                    </h3>
                    <p class="blog-card-excerpt"><?= esc(truncateWords($rel['excerpt'], 20)) ?></p>
                    <span class="blog-card-date"><?= formatDate($rel['published_at']) ?></span>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
