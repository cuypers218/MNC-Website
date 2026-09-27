<?php
/**
 * A single product page (2026-09-26 book redesign).
 * Same data and logic as before: ownership, free/paid/coming-soon states,
 * the Garage Sale Planner demo video, and per-product "try the demo" links.
 * Restyled only; no branch removed or changed.
 */
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';

if (isset($_GET['download']) && $_GET['download'] == '1') {
    requireLogin();
    $dlSlug = $_GET['slug'] ?? '';
    $dlProduct = getProductBySlug($dlSlug);
    if (!$dlProduct) { header('Location: /tools'); exit; }
    $dlUser = getCurrentUser();
    $dlFree  = $dlProduct['price'] == 0;
    $dlOwned = userOwnsPurchase($dlUser['id'], $dlProduct['id']);
    if (!$dlFree && !$dlOwned) { header('Location: /shop/' . rawurlencode($dlSlug)); exit; }
    if (empty($dlProduct['file_path'])) { header('Location: /shop/' . rawurlencode($dlSlug)); exit; }
    $token = generateDownloadToken($dlUser['id'], $dlProduct['id']);
    header('Location: /download/' . $token);
    exit;
}

$slug = $_GET['slug'] ?? '';
$product = getProductBySlug($slug);

if (!$product) {
    http_response_code(404);
    $pageTitle = 'Not Found';
    require_once __DIR__ . '/includes/header-book.php';
    ?>
<section class="spread"><div class="page one plain">
    <h1 class="as-h2">Not found.</h1>
    <p>This product doesn't exist or isn't available yet.</p>
    <div class="cta-row"><a class="btn" href="/tools">Back to Tools <span class="arr" aria-hidden="true">→</span></a></div>
</div></section>
<?php
    require_once __DIR__ . '/includes/footer-book.php';
    exit;
}

$pageTitle = $product['title'];
$pageDescription = $product['short_description'] ?? 'A tool from My Nest Chapter.';
$pageImage = $product['image_path'] ?? null;
require_once __DIR__ . '/includes/header-book.php';

$isFree = $product['price'] == 0;
$isComingSoon = $product['status'] === 'coming_soon';
$isInteractiveTool = $product['category'] === 'interactive_tool';
$isOwned = false;

$widgetFolderOverrides = ['someday-list-builder' => 'someday-list'];
$widgetSlug = $widgetFolderOverrides[$product['slug']] ?? $product['slug'];

if (isLoggedIn()) {
    $user = getCurrentUser();
    $isOwned = userOwnsPurchase($user['id'], $product['id']);
}

$db = getDB();
$stmt = $db->prepare('SELECT * FROM products WHERE category = ? AND id != ? AND status IN ("active","coming_soon") ORDER BY sort_order LIMIT 3');
$stmt->execute([$product['category'], $product['id']]);
$related = $stmt->fetchAll();
$hasRealFile = !empty($product['file_path']);
?>
<section class="spread" aria-label="<?= esc($product['title']) ?>">
  <div class="page l">
<?php if ($product['slug'] === 'garage-sale-planner'): ?>
    <video class="pd-video" autoplay loop muted playsinline controls>
        <source src="/assets/videos/garage-sale-planner-demo.mp4" type="video/mp4">
    </video>
<?php elseif ($product['image_path']): ?>
    <img class="pd-image" src="<?= esc($product['image_path']) ?>" alt="<?= esc($product['title']) ?> cover">
<?php else: ?>
    <div class="pd-image pd-image-blank" aria-hidden="true"></div>
<?php endif; ?>
    <div class="pager desk"><a class="bk" href="/tools"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 12H5M11 6l-6 6 6 6"/></svg> Back to Tools</a></div>
  </div>

  <div class="page r">
    <p class="menu-sub"><?= esc(str_replace('_', ' ', $product['category'])) ?></p>
    <h1 class="as-h2"><?= esc($product['title']) ?></h1>
<?php if (!$isComingSoon): ?>
    <p class="pd-price"><?= formatPrice($product['price']) ?></p>
<?php endif; ?>
    <div class="pd-desc"><?= nl2br(esc($product['description'] ?? $product['short_description'])) ?></div>

<?php if ($isComingSoon): ?>
    <button class="btn" disabled style="opacity:.6;cursor:not-allowed">Coming soon</button>
<?php elseif ($isOwned): ?>
    <?php if ($hasRealFile): ?>
    <a class="btn" href="/shop/<?= esc($product['slug']) ?>?download=1">Download <span class="arr" aria-hidden="true">→</span></a>
    <?php else: ?>
    <a class="btn" href="/widgets/<?= esc($widgetSlug) ?>/">Open <?= esc(ctaTitle($product['title'])) ?> <span class="arr" aria-hidden="true">→</span></a>
    <?php endif; ?>
    <p class="note-line" style="margin-top:.8rem">You own this product.</p>
<?php elseif ($isFree): ?>
    <?php if (strpos($product['file_path'] ?? '', 'http') === 0): ?>
    <a class="btn" href="<?= esc($product['file_path']) ?>" target="_blank" rel="noopener">Download free <span class="arr" aria-hidden="true">→</span></a>
    <?php elseif ($hasRealFile && isLoggedIn()): ?>
    <a class="btn" href="/shop/<?= esc($product['slug']) ?>?download=1">Download free <span class="arr" aria-hidden="true">→</span></a>
    <?php elseif ($hasRealFile): ?>
    <a class="btn" href="/start-here">Join the Hub, it's free <span class="arr" aria-hidden="true">→</span></a>
    <?php else: ?>
    <a class="btn" href="/widgets/<?= esc($widgetSlug) ?>/">Try it free, no account needed <span class="arr" aria-hidden="true">→</span></a>
    <?php endif; ?>
<?php else: ?>
    <a class="btn" href="<?= esc(hubBuyUrl($product['slug'])) ?>">Get <?= esc(ctaTitle($product['title'])) ?> <span class="arr" aria-hidden="true">→</span></a>
    <p class="note-line" style="margin-top:.7rem">Free to join. Secure checkout via Stripe. Instant access after purchase.</p>
    <?php
    $slugsWithDemo = ['cooking-for-one'];
    $slugsWithQueryDemo = ['goal-habit-tracker'];
    $slugsWithDirectDemo = ['garage-sale-planner'];
    if ($isInteractiveTool && in_array($product['slug'], $slugsWithDemo)): ?>
    <p class="pd-demo"><a class="link" href="/widgets/<?= esc($product['slug']) ?>-demo/">Try the demo first →</a></p>
    <?php elseif ($isInteractiveTool && in_array($product['slug'], $slugsWithQueryDemo)): ?>
    <p class="pd-demo"><a class="link" href="/widgets/<?= esc($product['slug']) ?>/?demo=1">Try the demo first →</a></p>
    <?php elseif ($isInteractiveTool && in_array($product['slug'], $slugsWithDirectDemo)): ?>
    <p class="pd-demo"><a class="link" href="/widgets/<?= esc($product['slug']) ?>/">Try it free, no account needed →</a></p>
    <?php endif; ?>
<?php endif; ?>
    <div class="pager"><a class="bk mob" href="/tools"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 12H5M11 6l-6 6 6 6"/></svg> Back to Tools</a></div>
  </div>
</section>

<?php if (!empty($related)): ?>
<section class="spread" aria-labelledby="related-h">
  <div class="page one plain">
    <h2 id="related-h">You might also like</h2>
    <ul class="menu take">
    <?php foreach ($related as $rel): $n = (float)$rel['price']; $price = $rel['status'] === 'coming_soon' ? 'soon' : ($n == 0 ? 'free' : '$' . (floor($n) == $n ? number_format($n, 0) : number_format($n, 2))); ?>
      <li>
        <?php if (!empty($rel['image_path'])): ?><img src="<?= esc($rel['image_path']) ?>" alt="" width="84" height="63" loading="lazy"><?php else: ?><span class="thumb-blank" aria-hidden="true"></span><?php endif; ?>
        <div>
          <div class="row"><a class="nm" href="/shop/<?= esc($rel['slug']) ?>"><?= esc($rel['title']) ?></a><span class="lead"></span><span class="pr"><?= esc($price) ?></span></div>
          <p class="for"><?= esc(truncateWords($rel['short_description'], 16)) ?></p>
        </div>
      </li>
    <?php endforeach; ?>
    </ul>
  </div>
</section>
<?php endif; ?>
<?php require_once __DIR__ . '/includes/footer-book.php'; ?>
