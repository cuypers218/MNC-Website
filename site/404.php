<?php
http_response_code(404);
$pageTitle = 'Page not found';
$pageDescription = "This page isn't here anymore.";
$noIndex = true;
require_once __DIR__ . '/includes/simple-header.php';
?>
<section class="simple-page">
  <div class="wrap simple-in">
    <p class="script label">Oops</p>
    <h1 class="simple-h">This page isn't here anymore.</h1>
    <p class="simple-p">Maybe it moved, or maybe the link had a typo. Either way, everything I make lives in one place now.</p>
    <div class="cta-row center-row">
      <a class="btn" href="/">Go to the home page <span aria-hidden="true">&rarr;</span></a>
      <a class="text-link" href="https://hub.mynestchapter.com/">Join the free Hub</a>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/simple-footer.php'; ?>
