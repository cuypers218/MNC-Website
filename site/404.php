<?php
$pageTitle = 'Page Not Found';
$pageDescription = "This page doesn't exist.";
require_once __DIR__ . '/includes/header-book.php';
?>
<section class="spread" aria-label="Page not found">
  <div class="page one plain">
    <p class="err-code">404</p>
    <h1 class="as-h2">This page doesn't exist.</h1>
    <p>It might have moved, or maybe the link was wrong. Either way, here are some places to go.</p>
    <div class="cta-row">
      <a class="btn" href="/">Go home <span class="arr" aria-hidden="true">→</span></a>
      <a class="link" href="/tools">Browse Tools →</a>
      <a class="link" href="/blog">Read the blog →</a>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer-book.php'; ?>
