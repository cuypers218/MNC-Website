<?php
// Shared header for the small extra pages (404, quiz) in the one-page site look.
// Set $pageTitle and $pageDescription before including.
$hub = 'https://hub.mynestchapter.com/';
$__title = isset($pageTitle) ? $pageTitle . ' | My Nest Chapter' : 'My Nest Chapter';
$__desc  = isset($pageDescription) ? $pageDescription : 'A free Hub for single and solo moms in the empty nest chapter.';
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($__title) ?></title>
<meta name="description" content="<?= htmlspecialchars($__desc) ?>">
<?php if (!empty($noIndex)): ?><meta name="robots" content="noindex"><?php endif; ?>
<meta name="theme-color" content="#1F6F78">
<link rel="icon" type="image/svg+xml" href="/assets/images/favicon.svg">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;700&family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/home.css?v=3">
</head>
<body>
<a class="skip" href="#main">Skip to content</a>
<header class="top">
  <div class="wrap top-in">
    <a class="brand" href="/" aria-label="My Nest Chapter, home">My Nest <span>Chapter</span></a>
    <nav class="top-nav" aria-label="Main">
      <a class="nav-link hide-sm" href="/#hub">The Hub</a>
      <a class="nav-link hide-sm" href="/#about">About me</a>
      <a class="nav-link" href="<?= $hub ?>">Log in</a>
      <a class="btn btn-sm" href="<?= $hub ?>">Join the Hub</a>
    </nav>
  </div>
</header>
<main id="main">
