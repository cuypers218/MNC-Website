<?php require_once __DIR__ . '/config.php'; ?>
<?php require_once __DIR__ . '/functions.php'; ?>
<?php require_once __DIR__ . '/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle ?? 'My Nest Chapter') ?> | My Nest Chapter</title>
    <meta name="description" content="<?= esc($pageDescription ?? 'Solo mom. Empty nest. Now what? Tools and resources built from lived experience, for single and solo moms.') ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= esc($pageTitle ?? 'My Nest Chapter') ?>">
    <meta property="og:description" content="<?= esc($pageDescription ?? 'Solo mom. Empty nest. Now what?') ?>">
    <meta property="og:url" content="<?= SITE_URL . ($_SERVER['REQUEST_URI'] ?? '') ?>">
    <meta property="og:type" content="website">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;800&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<a href="#main-content" class="skip-link">Skip to main content</a>

<header class="site-header">
    <div class="header-inner">
        <a href="/" class="brand-mark">My Nest Chapter</a>
        
        <!-- Desktop Nav -->
        <nav class="main-nav" aria-label="Main navigation">
            <a href="/" class="<?= isPage('home') ?>">Home</a>
            <a href="/about" class="<?= isPage('about') ?>">About</a>
            <a href="/blog" class="<?= isPage('blog') ?>">Blog</a>
            <a href="/shop" class="<?= isPage('shop') ?>">Shop</a>
            <a href="/resources" class="<?= isPage('resources') ?>">Resources</a>
            <a href="/freebies" class="<?= isPage('freebies') ?>">Freebies</a>
        </nav>
        
        <!-- Auth Link -->
        <div class="nav-auth">
            <?php if (isLoggedIn()): ?>
                <a href="/dashboard"><?= esc($_SESSION['user_name'] ?? 'Dashboard') ?></a>
            <?php else: ?>
                <a href="/login">Log In</a>
            <?php endif; ?>
        </div>
        
        <!-- Mobile Toggle -->
        <button class="mobile-toggle" aria-label="Open menu" onclick="openMobileNav()">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

<!-- Mobile Nav Overlay -->
<div class="mobile-overlay" id="mobileOverlay" onclick="closeMobileNav()"></div>

<!-- Mobile Nav Panel -->
<nav class="mobile-nav" id="mobileNav" aria-label="Mobile navigation">
    <button class="mobile-close" aria-label="Close menu" onclick="closeMobileNav()">&#x2715;</button>
    <a href="/" class="<?= isPage('home') ?>">Home</a>
    <a href="/about" class="<?= isPage('about') ?>">About</a>
    <a href="/blog" class="<?= isPage('blog') ?>">Blog</a>
    <a href="/shop" class="<?= isPage('shop') ?>">Shop</a>
    <a href="/resources" class="<?= isPage('resources') ?>">Resources</a>
    <a href="/freebies" class="<?= isPage('freebies') ?>">Freebies</a>
    <?php if (isLoggedIn()): ?>
        <a href="/dashboard">My Dashboard</a>
        <a href="/api/auth?action=logout">Log Out</a>
    <?php else: ?>
        <a href="/login">Log In</a>
        <a href="/register">Create Account</a>
    <?php endif; ?>
</nav>

<main id="main-content" tabindex="-1">
