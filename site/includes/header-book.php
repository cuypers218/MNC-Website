<?php
/**
 * header-book.php: the open-book header (2026-09-26 redesign).
 *
 * Opt-in: a page uses this INSTEAD of header.php. It loads book.css only (not
 * style.css), so old pages are untouched until they move over one by one.
 *
 * Page variables (same names header.php already uses):
 *   $pageTitle, $pageDescription, $pageImage
 * The page then outputs one or more <section class="spread"> blocks and ends
 * with: require __DIR__ . '/includes/footer-book.php';
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/auth.php';

$__desc  = $pageDescription ?? 'Solo mom. Empty nest. Now what? Tools and resources built from lived experience, for single and solo moms.';
$__title = ($pageTitle ?? 'My Nest Chapter') . ' | My Nest Chapter';
$__path  = esc(strtok($_SERVER['REQUEST_URI'] ?? '/', '?'));
$__img   = !empty($pageImage) ? $pageImage : '/assets/images/logo.png';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($__title) ?></title>
    <meta name="description" content="<?= esc($__desc) ?>">
    <link rel="canonical" href="https://mynestchapter.com<?= $__path ?>">
    <link rel="icon" type="image/svg+xml" href="/assets/images/favicon.svg">

    <!-- Open Graph -->
    <meta property="og:site_name" content="My Nest Chapter">
    <meta property="og:locale" content="en_US">
    <meta property="og:title" content="<?= esc($__title) ?>">
    <meta property="og:description" content="<?= esc($__desc) ?>">
    <meta property="og:url" content="https://mynestchapter.com<?= $__path ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://mynestchapter.com<?= esc($__img) ?>">

    <!-- Social Profiles (SEO signal) -->
    <meta property="og:see_also" content="https://www.facebook.com/profile.php?id=61590806030391">
    <meta property="og:see_also" content="https://www.instagram.com/my.nest.chapter/">
    <meta property="og:see_also" content="https://www.pinterest.com/mynestchapter">

    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= esc($__title) ?>">
    <meta name="twitter:description" content="<?= esc($__desc) ?>">
    <meta name="twitter:image" content="https://mynestchapter.com<?= esc($__img) ?>">

    <!-- Fonts are hosted here (see book.css); preload the three used above the fold -->
    <link rel="preload" href="/assets/fonts/young-serif-400.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/source-serif-4-400.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/assets/fonts/atkinson-hyperlegible-next-400.woff2" as="font" type="font/woff2" crossorigin>

    <link rel="stylesheet" href="/assets/css/book.css?v=<?= @filemtime(__DIR__ . '/../assets/css/book.css') ?: '1' ?>">
    <script>document.documentElement.classList.add('js');</script>
</head>
<body>

<a class="skip" href="#main-content">Skip to the page</a>

<div class="top">
<header class="nav">
    <div class="nav-in">
        <a class="mark" href="/" aria-label="My Nest Chapter, home">
            <svg viewBox="0 0 32 32" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" aria-hidden="true"><path d="M3 15c1 8 7 12 13 12s12-4 13-12"/><path d="M6 17c4 2.5 16 2.5 20 0M9 22c4 1.5 10 1.5 14 0"/><ellipse cx="12" cy="13" rx="3" ry="4" transform="rotate(-12 12 13)"/><ellipse cx="20" cy="13" rx="3" ry="4" transform="rotate(12 20 13)"/></svg>
            My Nest Chapter
        </a>
        <nav class="nav-links" id="tabs" aria-label="Main">
            <a href="/"<?= ariaCurrentPage('home') ?>>Home</a>
            <a href="/about"<?= ariaCurrentPage('about') ?>>About</a>
            <a href="/blog"<?= ariaCurrentPage('blog') ?>>Blog</a>
            <a href="/tools"<?= ariaCurrentPage('tools') ?>>Tools</a>
        </nav>
        <a class="btn sm" href="/start-here">The Hub <span class="arr" aria-hidden="true">→</span></a>
    </div>
</header>
</div>

<main id="main-content" tabindex="-1">
<div class="book" id="book">
