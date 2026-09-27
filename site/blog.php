<?php
/**
 * Blog: the table of contents (2026-09-26 book redesign).
 * Same data as before (published posts, optional ?category=), plus simple
 * paging (?page=2) so a long list never breaks the two-page spread.
 */
$pageTitle = 'Blog';
$pageDescription = 'Monthly updates from a solo mom figuring out the empty nest. No advice. Just what this looks like from where I am.';
require_once __DIR__ . '/includes/header-book.php';

$category = trim($_GET['category'] ?? '');
$page     = max(1, (int)($_GET['page'] ?? 1));
$perPage  = 6;

$db = getDB();
if ($category !== '') {
    $countStmt = $db->prepare('SELECT COUNT(*) FROM blog_posts WHERE status = "published" AND category = ?');
    $countStmt->execute([$category]);
} else {
    $countStmt = $db->query('SELECT COUNT(*) FROM blog_posts WHERE status = "published"');
}
$total = (int)$countStmt->fetchColumn();
$pages = max(1, (int)ceil($total / $perPage));
$page  = min($page, $pages);
$offset = ($page - 1) * $perPage;

if ($category !== '') {
    $stmt = $db->prepare('SELECT id, title, slug, excerpt, category, published_at FROM blog_posts WHERE status = "published" AND category = ? ORDER BY published_at DESC LIMIT ? OFFSET ?');
    $stmt->bindValue(1, $category);
    $stmt->bindValue(2, $perPage, PDO::PARAM_INT);
    $stmt->bindValue(3, $offset, PDO::PARAM_INT);
} else {
    $stmt = $db->prepare('SELECT id, title, slug, excerpt, category, published_at FROM blog_posts WHERE status = "published" ORDER BY published_at DESC LIMIT ? OFFSET ?');
    $stmt->bindValue(1, $perPage, PDO::PARAM_INT);
    $stmt->bindValue(2, $offset, PDO::PARAM_INT);
}
$stmt->execute();
$posts = $stmt->fetchAll();

$categories = $db->query('SELECT DISTINCT category FROM blog_posts WHERE status = "published" AND category IS NOT NULL ORDER BY category')->fetchAll(PDO::FETCH_COLUMN);

// The post the old Resources page told new readers to start with.
// Only worth pointing at once there are a few posts to choose from.
$startPost = ($category === '' && $page === 1 && $total > 2) ? getPostBySlug('what-i-do-at-6pm') : null;

$q = function ($p) use ($category) {
    $args = [];
    if ($category !== '') $args['category'] = $category;
    if ($p > 1) $args['page'] = $p;
    return '/blog' . ($args ? '?' . http_build_query($args) : '');
};
$arrL = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 12H5M11 6l-6 6 6 6"/></svg>';
$arrR = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12h15M13 6l6 6-6 6"/></svg>';
?>
<section class="spread" id="p-blog" aria-label="Blog">
  <div class="page l">
    <div class="pager desk"><a class="bk" href="/about"><?= $arrL ?> Back</a></div>
    <h1 class="as-h2">Stories from <span class="hl">this stage of life.</span></h1>
    <p>What's helped, what hasn't, and what I wish someone had told me.</p>
    <p class="menu-sub">Monthly updates from where I am right now, not where I've been.</p>

<?php if (!empty($categories)): ?>
    <ul class="filters" aria-label="Filter posts">
      <li><a href="/blog"<?= $category === '' ? ' aria-current="page"' : '' ?>>All</a></li>
<?php foreach ($categories as $cat): ?>
      <li><a href="/blog?category=<?= urlencode($cat) ?>"<?= $category === $cat ? ' aria-current="page"' : '' ?>><?= esc($cat) ?></a></li>
<?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if ($startPost): ?>
    <div class="startpick">
      <p class="startpick-label">Start with this one</p>
      <a class="startpick-title" href="/blog/<?= esc($startPost['slug']) ?>"><?= esc($startPost['title']) ?></a>
      <p class="startpick-text"><?= esc(truncateWords($startPost['excerpt'] ?? '', 26)) ?></p>
    </div>
<?php endif; ?>
    <figure class="album blogphoto"><div class="corners"><img src="/assets/images/kitchen-6pm.jpg" alt="A quiet kitchen at six in the evening, a mug on a wooden table in low golden light" width="340" height="255" loading="lazy"><i></i><i></i><i></i><i></i></div></figure>
  </div>

  <div class="page r">
<?php if (empty($posts)): ?>
    <h2>First posts are on the way.</h2>
    <p>Check back soon.</p>
<?php else: ?>
    <h2>The <span class="hl">contents.</span></h2>
    <ul class="menu posts">
<?php foreach ($posts as $post): ?>
      <li>
        <div class="row"><a class="nm" href="/blog/<?= esc($post['slug']) ?>"><?= esc($post['title']) ?></a><span class="lead"></span><span class="pr"><?= esc(date('M Y', strtotime($post['published_at']))) ?></span></div>      </li>
<?php endforeach; ?>
    </ul>
<?php if ($pages > 1): ?>
    <nav class="pagelinks" aria-label="More posts">
      <?php if ($page > 1): ?><a class="link" href="<?= esc($q($page - 1)) ?>">← Newer posts</a><?php else: ?><span></span><?php endif; ?>
      <?php if ($page < $pages): ?><a class="link" href="<?= esc($q($page + 1)) ?>">Older posts →</a><?php endif; ?>
    </nav>
<?php endif; ?>
<?php endif; ?>
    <div class="pager"><a class="bk mob" href="/about"><?= $arrL ?> Back</a><a class="nx" href="/tools">Turn the page <?= $arrR ?></a></div>
    <a class="curl" href="/tools" tabindex="-1" aria-hidden="true"></a>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer-book.php'; ?>
