<?php
$pageTitle = 'Blog';
$pageDescription = 'Weekly updates from a solo mom figuring out the empty nest. No advice. Just what this looks like from where I am.';
require_once __DIR__ . '/includes/header.php';

// Get category filter
$category = $_GET['category'] ?? '';

$db = getDB();
if ($category) {
    $stmt = $db->prepare('SELECT * FROM blog_posts WHERE status = "published" AND category = ? ORDER BY published_at DESC');
    $stmt->execute([$category]);
} else {
    $stmt = $db->query('SELECT * FROM blog_posts WHERE status = "published" ORDER BY published_at DESC');
}
$posts = $stmt->fetchAll();

// Get all categories for filter
$categories = $db->query('SELECT DISTINCT category FROM blog_posts WHERE status = "published" AND category IS NOT NULL ORDER BY category')->fetchAll(PDO::FETCH_COLUMN);
?>

<section class="section">
    <div class="container">
        
        <h1 class="text-center fade-in" style="margin-bottom: 0.5rem;">Blog</h1>
        <p class="text-center fade-in-delay-1" style="color: #666666; font-size: 0.95rem; margin-bottom: 2rem;">Weekly updates from where I am right now — not where I've been.</p>
        
        <!-- Category Filter -->
        <?php if (!empty($categories)): ?>
        <nav class="filter-nav">
            <a href="/blog" class="filter-tab <?= empty($category) ? 'active' : '' ?>" style="text-decoration: none;">All</a>
            <?php foreach ($categories as $cat): ?>
                <a href="/blog?category=<?= urlencode($cat) ?>" class="filter-tab <?= $category === $cat ? 'active' : '' ?>" style="text-decoration: none;"><?= esc($cat) ?></a>
            <?php endforeach; ?>
        </nav>
        <?php endif; ?>
        
        <!-- Posts Grid -->
        <?php if (!empty($posts)): ?>
        <div class="blog-grid">
            <?php foreach ($posts as $post): ?>
            <article class="blog-card fade-in">
                <?php if ($post['featured_image']): ?>
                    <img src="<?= esc($post['featured_image']) ?>" alt="" class="blog-card-image">
                <?php endif; ?>
                <div class="blog-card-content">
                    <?php if ($post['category']): ?>
                        <span class="blog-card-category"><?= esc($post['category']) ?></span>
                    <?php endif; ?>
                    <h3 class="blog-card-title">
                        <a href="/blog/<?= esc($post['slug']) ?>"><?= esc($post['title']) ?></a>
                    </h3>
                    <p class="blog-card-excerpt"><?= esc(truncateWords($post['excerpt'], 25)) ?></p>
                    <span class="blog-card-date"><?= formatDate($post['published_at']) ?></span>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center" style="padding: 3rem;">
            <p style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; color: #D3D3D3; margin-bottom: 0.5rem;">MY NEST CHAPTER</p>
            <p style="color: #666666; font-size: 0.95rem;">First posts are on the way. Check back soon.</p>
        </div>
        <?php endif; ?>
        
    </div>
</section>

<!-- Email Capture -->
<section class="section-alt">
    <div class="container">
        <div class="email-capture">
            <h3>Get New Posts in Your Inbox</h3>
            <p>I write about this every week. Real updates, not advice.</p>
            <form class="email-capture-form" onsubmit="event.preventDefault(); submitEmailCapture(this, 'blog');">
                <input type="email" placeholder="Your email" required aria-label="Email address">
                <button type="submit" class="btn btn-primary">Send It</button>
            </form>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
