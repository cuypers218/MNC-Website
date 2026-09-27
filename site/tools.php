<?php
/**
 * Tools: the café menu (2026-09-26 book redesign).
 * Replaces the separate Shop, Resources and Freebies pages (those addresses
 * now redirect here; see .htaccess).
 *
 *  - "On the house": the freebies. Every one unlocks by joining the Hub, free.
 *  - "To take home": paid products, read from the database (getProducts()).
 *  - "For when it's really hard": the crisis resources that used to live on the
 *    Resources page, kept word for word on purpose.
 */
$pageTitle = 'Empty Nest Tools for Single Moms';
$pageDescription = 'Free tools and paid planners built from lived experience, for solo and single moms in the empty nest. Join the Hub, free, to unlock every freebie.';
require_once __DIR__ . '/includes/header-book.php';

// The freebies inside the Hub (same six the Hub's Freebies page lists).
$freebies = [
    'The 6pm Cheat Sheet',
    'The 6pm Survival Plan',
    'Who Am I Now',
    'Someday List Builder',
    'Pick Your Mood Coloring Pages',
    'What Kind of Nester Are You? quiz',
];

// One line per product saying which kind of chapter it helps with. Products
// without a line here fall back to their own short description.
$chapterLines = [
    'garage-sale-planner' => "Clear out the past to make room for what's next.",
    'cooking-for-one'     => 'For the chapter where dinner is yours.',
    'now-what-workbook'   => "For starting a chapter you haven't named yet.",
];

$paid = array_values(array_filter(getProducts(), fn($p) => $p['price'] > 0));
?>
<section class="spread" id="p-tools" aria-label="Tools">
  <div class="page l">
    <div class="pager desk"><a class="bk" href="/blog"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 12H5M11 6l-6 6 6 6"/></svg> Back</a></div>
    <span class="ring" aria-hidden="true"></span>
    <div class="menu-head">
      <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 20h26v9a10 10 0 0 1-10 10h-6A10 10 0 0 1 9 29z"/><path d="M35 23h3a4 4 0 0 1 0 8h-4"/><path d="M6 43h32"/><path d="M17 7c-2 3 2 4 0 8M25 7c-2 3 2 4 0 8"/></svg>
      <h1 class="as-h2">On the house.</h1>
    </div>
    <p class="menu-sub">Free, once you have your card.</p>
    <ul class="menu">
<?php foreach ($freebies as $name): ?>
      <li><div class="row"><span class="nm"><?= esc($name) ?></span><span class="lead"></span><span class="pr">free</span></div></li>
<?php endforeach; ?>
    </ul>
    <a class="link" href="/start-here" style="margin-top:1rem">Get your card →</a>
  </div>

  <div class="page r">
    <h2>To take <span class="hl">home.</span></h2>
    <p class="menu-sub">Each one is a tool for a chapter. Buy it inside the Hub and it's waiting for you there.</p>
    <ul class="menu take">
<?php if (empty($paid)): ?>
      <li><div><p class="for">New tools are on the way. Check back soon.</p></div></li>
<?php else: foreach ($paid as $p):
        $line = $chapterLines[$p['slug']] ?? truncateWords($p['short_description'] ?? '', 14);
        $soon = ($p['status'] ?? '') === 'coming_soon';
        $n = (float)$p['price'];
        // "$27" for whole dollars, "$14.99" otherwise
        $priceLabel = $soon ? 'soon' : '$' . (floor($n) == $n ? number_format($n, 0) : number_format($n, 2));
?>
      <li>
        <?php if (!empty($p['image_path'])): ?><img src="<?= esc($p['image_path']) ?>" alt="" width="84" height="63" loading="lazy"><?php else: ?><span class="thumb-blank" aria-hidden="true"></span><?php endif; ?>
        <div>
          <div class="row"><a class="nm" href="/shop/<?= esc($p['slug']) ?>"><?= esc($p['title']) ?></a><span class="lead"></span><span class="pr"><?= esc($priceLabel) ?></span></div>
          <p class="for"><?= esc($line) ?></p>
          <?php if (!$soon): ?><a class="link" href="<?= esc(hubBuyUrl($p['slug'])) ?>">See it in the Hub →</a><?php endif; ?>
        </div>
      </li>
<?php endforeach; endif; ?>
    </ul>
    <div class="pager"><a class="bk mob" href="/blog"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 12H5M11 6l-6 6 6 6"/></svg> Back</a><a class="nx" href="/start-here">Turn the page <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12h15M13 6l6 6-6 6"/></svg></a></div>
    <a class="curl" href="/start-here" tabindex="-1" aria-hidden="true"></a>
  </div>
</section>

<!-- Crisis resources, moved here from the old Resources page. Wording is unchanged on purpose. -->
<section class="spread" id="when-its-hard" aria-labelledby="hard-h">
  <div class="page one hard">
    <h2 id="hard-h" tabindex="-1">For when it's really hard</h2>
    <p>Sometimes the empty nest isn't just quiet — it's heavy. If that's where you are right now, these are real resources with real people on the other end.</p>
    <div class="hard-grid">
      <div><h3>988 Suicide &amp; Crisis Lifeline</h3><p>Call or text <a href="tel:988">988</a>. Available 24/7.</p></div>
      <div><h3>Crisis Text Line</h3><p>Text <a href="sms:741741?body=HOME">HOME to 741741</a>. Free, confidential, available 24/7.</p></div>
      <div><h3>SAMHSA National Helpline</h3><p><a href="tel:+18006624357">1-800-662-4357</a>. Free referrals and information, 24/7.</p></div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer-book.php'; ?>
