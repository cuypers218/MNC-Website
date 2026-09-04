<?php
require_once __DIR__ . '/includes/functions.php';

$slug = $_GET['slug'] ?? '';
$post = getPostBySlug($slug);

if (!$post) {
    http_response_code(404);
    $pageTitle = 'Not Found';
    require_once __DIR__ . '/includes/header.php';
    echo '<section class="section"><div class="container text-center"><h1>Post Not Found</h1><p style="color:#8BA7D4;margin-top:1rem;">This post doesn\'t exist or hasn\'t been published yet.</p><a href="/blog" class="btn btn-outline" style="margin-top:1.5rem;">Back to Blog</a></div></section>';
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

// Comments
$comments = getCommentsForPost($post['id']);
$commented = ($_GET['commented'] ?? '') === '1';
$commentError = ($_GET['comment_error'] ?? '') === '1';
if (!isLoggedIn()) {
    // So clicking "Log in" below sends the visitor back to this exact post afterward.
    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
}
?>

<article class="blog-post">
    
    <?php if ($post['category']): ?>
        <span style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.12em; color: #8BA7D4;"><?= esc($post['category']) ?></span>
    <?php endif; ?>
    
    <h1 class="blog-post-title fade-in"><?= esc($post['title']) ?></h1>
    
    <div class="blog-post-meta fade-in-delay-1"><?= formatDate($post['published_at']) ?></div>
    
    <?php if ($post['featured_image']): ?>
        <img src="<?= esc($post['featured_image']) ?>" alt="<?= esc($post['title']) ?>" style="width: 100%; margin-bottom: 2rem; border: 1px solid #ABABAB;">
    <?php endif; ?>
    
    <div class="blog-post-body fade-in-delay-2">
        <?= $post['body'] ?>
    </div>
    
    <!-- Product CTA -->
    <?php
    $cat = strtolower($post['category'] ?? '');
    if (str_contains($cat, 'cook') || str_contains($cat, 'food') || str_contains($cat, 'meal')) {
        $ctaText  = 'Cooking for yourself after years of cooking for everyone else is its own adjustment.';
        $ctaLink  = '/shop/cooking-for-one';
        $ctaLabel = 'Get the Cooking for One Planner';
    } elseif (str_contains($cat, 'garage') || str_contains($cat, 'declutter') || str_contains($cat, 'organiz')) {
        $ctaText  = 'Ready to clear out the house and actually make money doing it?';
        $ctaLink  = '/shop/garage-sale-planner';
        $ctaLabel = 'Get the Garage Sale Planner';
    } else {
        $ctaText  = 'If you\'re figuring out what comes next, the Now What? Workbook is where most women start.';
        $ctaLink  = '/shop/now-what-workbook';
        $ctaLabel = 'Get the Now What? Workbook';
    }
    ?>
    <div style="background:#252535;padding:28px 32px;margin-top:3rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1.5rem;">
        <p style="font-family:Arial,sans-serif;font-size:0.95rem;color:#FAF7ED;margin:0;line-height:1.6;max-width:520px;"><?= esc($ctaText) ?></p>
        <a href="<?= esc($ctaLink) ?>" style="font-family:'Montserrat',sans-serif;font-weight:800;font-size:0.75rem;text-transform:uppercase;letter-spacing:0.05em;color:#C44570;white-space:nowrap;flex-shrink:0;"><?= esc($ctaLabel) ?> &rarr;</a>
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
        <a href="/blog" style="font-family: 'Montserrat', sans-serif; font-weight: 800; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; color: #C44570;">&larr; Back to Blog</a>
    </div>

</article>

<!-- Comments — gated to logged-in members, see includes/functions.php getCommentsForPost() and blog-comment-submit.php -->
<section class="blog-comments" id="comments">
    <div class="blog-comments-inner">
        <h2 class="blog-comments-heading"><?= count($comments) ?> <?= count($comments) === 1 ? 'Comment' : 'Comments' ?></h2>

        <?php if ($commented): ?>
            <p class="blog-comment-note blog-comment-note-success">Your comment is up — thank you.</p>
        <?php endif; ?>

        <?php if (empty($comments)): ?>
            <p class="blog-comments-empty">No comments yet — be the first to say something.</p>
        <?php else: ?>
            <ul class="blog-comments-list">
                <?php foreach ($comments as $c): ?>
                    <li class="blog-comment">
                        <div class="blog-comment-meta">
                            <span class="blog-comment-name"><?= esc($c['first_name']) ?></span>
                            <span class="blog-comment-date"><?= formatDate($c['created_at']) ?></span>
                        </div>
                        <p class="blog-comment-body"><?= nl2br(esc($c['body'])) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (isLoggedIn()): ?>
            <?php if ($commentError): ?>
                <p class="blog-comment-note blog-comment-note-error">That didn't go through — say a little more and try again.</p>
            <?php endif; ?>
            <form class="blog-comment-form" method="POST" action="/blog-comment-submit.php">
                <?= csrfField() ?>
                <input type="hidden" name="slug" value="<?= esc($post['slug']) ?>">
                <label for="comment-body" class="blog-comment-label">Add a comment</label>
                <textarea id="comment-body" name="body" rows="4" required maxlength="2000" placeholder="What's on your mind?"></textarea>
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>
        <?php else: ?>
            <p class="blog-comment-login-prompt"><a href="/login">Log in</a> to join the conversation.</p>
        <?php endif; ?>
    </div>
</section>

<!-- Related Posts -->
<?php if (!empty($related)): ?>
<section class="section-alt">
    <div class="container">
        <h2 class="text-center" style="margin-bottom: 2rem;">More from the Blog</h2>
        <div class="blog-grid">
            <?php foreach ($related as $rel): ?>
            <article class="blog-card">
                <?php if ($rel['featured_image']): ?>
                    <img src="<?= esc($rel['featured_image']) ?>" alt="<?= esc($rel['title']) ?>" class="blog-card-image">
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
