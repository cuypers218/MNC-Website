<?php
/**
 * A single blog post, as a reading page (2026-09-26 book redesign).
 * Same data and behavior as before: post body from the database, a product
 * suggestion by category, guest comments (posted to /blog-comment-submit.php
 * with CSRF and a honeypot field), and related posts.
 */
require_once __DIR__ . '/includes/functions.php';

$slug = $_GET['slug'] ?? '';
$post = getPostBySlug($slug);

if (!$post) {
    http_response_code(404);
    $pageTitle = 'Not Found';
    require_once __DIR__ . '/includes/header-book.php';
    ?>
<section class="spread"><div class="page one" style="padding-bottom:2.5rem">
    <h1 class="as-h2">Post not found.</h1>
    <p>This post doesn't exist or hasn't been published yet.</p>
    <div class="cta-row"><a class="btn" href="/blog">Back to the blog <span class="arr" aria-hidden="true">→</span></a></div>
</div></section>
<?php
    require_once __DIR__ . '/includes/footer-book.php';
    exit;
}

$pageTitle = $post['title'];
$pageDescription = $post['meta_description'] ?? $post['excerpt'] ?? '';
if (!empty($post['featured_image'])) $pageImage = $post['featured_image'];
require_once __DIR__ . '/includes/header-book.php';

$db = getDB();
$stmt = $db->prepare('SELECT id, title, slug, excerpt, category, published_at FROM blog_posts WHERE status = "published" AND id != ? ORDER BY published_at DESC LIMIT 3');
$stmt->execute([$post['id']]);
$related = $stmt->fetchAll();

$comments     = getCommentsForPost($post['id']);
$commented    = ($_GET['commented'] ?? '') === '1';
$commentError = ($_GET['comment_error'] ?? '') === '1';

// Product suggestion by category (unchanged from the old page)
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
    $ctaText  = "If you're figuring out what comes next, the Now What? Workbook is where most women start.";
    $ctaLink  = '/workbook';
    $ctaLabel = 'Get the Now What? Workbook';
}
?>
<section class="spread" id="p-post" aria-label="<?= esc($post['title']) ?>">
  <article class="page one post-page">
    <div class="post-inner">
<?php if (!empty($post['category'])): ?>
      <p class="post-cat"><a href="/blog?category=<?= urlencode($post['category']) ?>"><?= esc($post['category']) ?></a></p>
<?php endif; ?>
      <h1 class="post-title"><?= esc($post['title']) ?></h1>
      <p class="post-meta"><?= esc(formatDate($post['published_at'])) ?></p>
<?php if (!empty($post['featured_image'])): ?>
      <div class="post-hero"><img src="<?= esc($post['featured_image']) ?>" alt="<?= esc($post['title']) ?>"></div>
<?php endif; ?>
      <div class="post-body"><?= $post['body'] /* trusted HTML written in the admin */ ?></div>

      <div class="post-cta">
        <p><?= esc($ctaText) ?></p>
        <a class="btn" href="<?= esc($ctaLink) ?>"><?= esc($ctaLabel) ?> <span class="arr" aria-hidden="true">→</span></a>
      </div>
      <p class="post-back"><a class="link" href="/blog">← Back to the blog</a></p>
    </div>
  </article>
</section>

<section class="spread" aria-labelledby="comments-h">
  <div class="page one post-page" id="comments">
    <div class="post-inner">
      <h2 id="comments-h" tabindex="-1"><?= count($comments) ?> <?= count($comments) === 1 ? 'Comment' : 'Comments' ?></h2>

<?php if ($commented): ?>
      <p class="cnote ok" role="status">Your comment is up. Thank you.</p>
<?php endif; ?>

<?php if (empty($comments)): ?>
      <p class="menu-sub">No comments yet. Be the first to say something.</p>
<?php else: ?>
      <ul class="comments-list">
<?php foreach ($comments as $c): ?>
        <li>
          <p class="cmeta"><span class="cname"><?= esc($c['first_name']) ?></span> <span class="cdate"><?= esc(formatDate($c['created_at'])) ?></span></p>
          <p class="cbody"><?= nl2br(esc($c['body'])) ?></p>
        </li>
<?php endforeach; ?>
      </ul>
<?php endif; ?>

<?php if ($commentError): ?>
      <p class="cnote bad" role="alert">That didn't go through. Check your name and comment and try again.</p>
<?php endif; ?>
      <form class="cform" method="POST" action="/blog-comment-submit.php">
        <?= csrfField() ?>
        <input type="hidden" name="slug" value="<?= esc($post['slug']) ?>">
        <div class="hp-field" aria-hidden="true">
          <label for="comment-website">Leave this blank</label>
          <input type="text" id="comment-website" name="website" tabindex="-1" autocomplete="off">
        </div>
        <label for="comment-name">Name</label>
        <input type="text" id="comment-name" name="name" required maxlength="100" placeholder="Your first name" autocomplete="given-name">
        <label for="comment-body">Comment</label>
        <textarea id="comment-body" name="body" rows="4" required maxlength="2000" placeholder="What's on your mind?"></textarea>
        <button type="submit" class="btn">Post comment <span class="arr" aria-hidden="true">→</span></button>
      </form>
    </div>
  </div>
</section>

<?php if (!empty($related)): ?>
<section class="spread" aria-labelledby="more-h">
  <div class="page one post-page">
    <div class="post-inner">
      <h2 id="more-h">More from the blog</h2>
      <ul class="menu posts">
<?php foreach ($related as $rel): ?>
        <li>
          <div class="row"><a class="nm" href="/blog/<?= esc($rel['slug']) ?>"><?= esc($rel['title']) ?></a><span class="lead"></span><span class="pr"><?= esc(date('M Y', strtotime($rel['published_at']))) ?></span></div>        </li>
<?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>
<?php endif; ?>
<?php require_once __DIR__ . '/includes/footer-book.php'; ?>
