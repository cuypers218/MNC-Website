<?php
// workbook.php — Now What? Workbook Product Page
$AMAZON_LINK = "https://www.amazon.com/YOUR_BOOK_LINK"; // replace with Amazon listing URL
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Now What? A Workbook for Solo Moms in the Empty Nest | My Nest Chapter</title>
<meta name="description" content="14 activities across 4 weeks. Written by a solo mom who raised five kids alone and fell apart when they left. This is the workbook I wish I'd had.">
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --charcoal: #252535;
    --vanilla: #FFF8EE;
    --pink: #E87AAA;
    --periwinkle: #8BA7D4;
    --lavender: #C4B0E8;
    --peach: #F2A57A;
    --soft-peach: #F5C4A8;
    --lemon: #EDD96A;
    --lime: #B5CC6A;
    --powder-blue: #A8C5DA;
    --text: #1a1a2e;
    --text-light: #555566;
    --border: #E8E0D5;
    --bg-warm: #FDFAF6;
  }

  html { scroll-behavior: smooth; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--vanilla);
    color: var(--text);
    line-height: 1.6;
  }

  /* ── NAV ── */
  .site-nav {
    background: var(--charcoal);
    padding: 0 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 64px;
    position: sticky;
    top: 0;
    z-index: 100;
  }
  .nav-logo {
    font-family: 'Lora', serif;
    font-weight: 700;
    font-size: 1rem;
    letter-spacing: 0.12em;
    color: var(--periwinkle);
    text-decoration: none;
  }
  .nav-logo span { color: var(--pink); }
  .nav-links { display: flex; gap: 28px; list-style: none; }
  .nav-links a {
    color: rgba(255,248,238,0.7);
    text-decoration: none;
    font-size: 0.82rem;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    font-weight: 500;
    transition: color 0.2s;
  }
  .nav-links a:hover { color: var(--soft-peach); }

  /* ── BREADCRUMB ── */
  .breadcrumb {
    background: var(--charcoal);
    padding: 10px 40px;
    border-bottom: 3px solid var(--pink);
  }
  .breadcrumb a, .breadcrumb span {
    font-size: 0.78rem;
    color: rgba(255,248,238,0.5);
    text-decoration: none;
    letter-spacing: 0.06em;
  }
  .breadcrumb a:hover { color: var(--soft-peach); }
  .breadcrumb .sep { margin: 0 8px; }
  .breadcrumb .current { color: rgba(255,248,238,0.85); }

  /* ── HERO PRODUCT SECTION ── */
  .product-hero {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0;
    min-height: 580px;
    background: var(--vanilla);
  }

  /* LEFT — product image */
  .product-visual {
    background: var(--charcoal);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 50px;
    position: relative;
    overflow: hidden;
  }
  .product-visual::before {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(232,122,170,0.12) 0%, transparent 70%);
  }
  /* 3D BOOK MOCKUP */
  .book-scene {
    perspective: 1200px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
  }
  .book-mockup {
    --thickness: 28px;
    position: relative;
    width: 256px;
    height: 340px;
    transform-style: preserve-3d;
    transform: rotateY(-30deg) rotateX(2deg);
    transition: transform 0.55s ease;
    filter: drop-shadow(20px 28px 40px rgba(0,0,0,0.7));
  }
  .book-mockup:hover {
    transform: rotateY(-16deg) rotateX(2deg);
  }
  /* Front cover */
  .book-mockup img {
    position: absolute;
    inset: 0;
    width: 100%; height: 100%;
    display: block;
    object-fit: cover;
    transform: translateZ(calc(var(--thickness) / 2));
    backface-visibility: hidden;
    border-radius: 0 3px 3px 0;
  }
  /* Spine — translateX(-50%) centers the rotated face on the left edge */
  .book-mockup::before {
    content: '';
    position: absolute;
    top: 3px; left: 0;
    width: var(--thickness);
    height: calc(100% - 6px);
    background: linear-gradient(to right, #4a0820, #7a1438, #a82850);
    transform: translateX(-50%) rotateY(90deg);
    border-radius: 2px 0 0 2px;
  }
  /* Back face — hidden when facing viewer */
  .book-mockup::after {
    content: '';
    position: absolute;
    inset: 0;
    background: #1a0a10;
    transform: translateZ(calc(var(--thickness) / -2)) rotateY(180deg);
    backface-visibility: hidden;
  }
  .book-badge {
    position: absolute;
    top: -12px; right: -14px;
    background: var(--lemon);
    color: var(--charcoal);
    font-family: 'DM Sans', sans-serif;
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 6px 10px;
    transform: translateZ(calc(var(--thickness) / 2 + 1px));
    z-index: 10;
  }

  /* RIGHT — product info */
  .product-info {
    padding: 56px 56px 56px 48px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    background: var(--bg-warm);
    border-left: 1px solid var(--border);
  }
  .product-label {
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--pink);
  }
  .product-title {
    font-family: 'Lora', serif;
    font-size: 1.9rem;
    font-weight: 700;
    line-height: 1.2;
    color: var(--charcoal);
  }
  .product-hook {
    font-size: 1rem;
    color: var(--text-light);
    line-height: 1.65;
    font-family: 'Lora', serif;
    font-style: italic;
    border-left: 3px solid var(--peach);
    padding-left: 16px;
  }
  .product-meta {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
  }
  .meta-pill {
    background: white;
    border: 1px solid var(--border);
    padding: 6px 14px;
    font-size: 0.78rem;
    font-weight: 500;
    color: var(--text-light);
    letter-spacing: 0.04em;
  }

  /* Buy options */
  .buy-section { display: flex; flex-direction: column; gap: 12px; }
  .buy-divider {
    border: none;
    border-top: 1px solid var(--border);
    margin: 4px 0;
  }
  .buy-label {
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--text-light);
  }

  .buy-option {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    padding: 18px 20px;
    background: white;
    border: 2px solid var(--border);
    transition: border-color 0.2s, box-shadow 0.2s;
  }
  .buy-option:hover { border-color: var(--pink); box-shadow: 4px 4px 0 var(--soft-peach); }
  .buy-option-info { display: flex; flex-direction: column; gap: 3px; }
  .buy-option-type {
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--text-light);
  }
  .buy-option-desc {
    font-size: 0.88rem;
    color: var(--text);
    font-weight: 500;
  }
  .buy-option-note {
    font-size: 0.75rem;
    color: var(--text-light);
  }
  .buy-option-right { display: flex; align-items: center; gap: 14px; flex-shrink: 0; }
  .buy-price {
    font-family: 'Lora', serif;
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--charcoal);
  }
  .btn-buy {
    display: inline-block;
    padding: 12px 22px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    text-decoration: none;
    cursor: pointer;
    border: none;
    transition: background 0.2s, transform 0.15s;
    white-space: nowrap;
  }
  .btn-buy:active { transform: translateY(1px); }
  .btn-pdf {
    background: var(--pink);
    color: white;
  }
  .btn-pdf:hover { background: #d96898; }
  .btn-amazon {
    background: var(--charcoal);
    color: var(--vanilla);
  }
  .btn-amazon:hover { background: #1a1a28; }

  /* ── PRODUCT BODY ── */
  .product-body {
    max-width: 960px;
    margin: 0 auto;
    padding: 0 40px 80px;
  }

  /* About section */
  .about-section {
    padding: 64px 0 48px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: start;
    border-bottom: 1px solid var(--border);
  }
  .section-label {
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--pink);
    margin-bottom: 16px;
  }
  .about-text p {
    font-family: 'Lora', serif;
    font-size: 1rem;
    line-height: 1.8;
    color: var(--text);
    margin-bottom: 18px;
  }
  .about-text p:last-child { margin-bottom: 0; }
  .about-callout {
    background: var(--charcoal);
    color: var(--vanilla);
    padding: 36px 32px;
    position: sticky;
    top: 84px;
  }
  .callout-quote {
    font-family: 'Lora', serif;
    font-size: 1.1rem;
    font-style: italic;
    line-height: 1.7;
    color: var(--soft-peach);
    margin-bottom: 20px;
  }
  .callout-attr {
    font-size: 0.78rem;
    letter-spacing: 0.08em;
    color: rgba(255,248,238,0.5);
    text-transform: uppercase;
  }

  /* What's inside */
  .inside-section {
    padding: 60px 0;
    border-bottom: 1px solid var(--border);
  }
  .inside-section h2 {
    font-family: 'Lora', serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--charcoal);
    margin-bottom: 8px;
  }
  .inside-intro {
    color: var(--text-light);
    font-size: 0.95rem;
    margin-bottom: 36px;
  }
  .weeks-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2px;
    background: var(--border);
    border: 2px solid var(--border);
  }
  .week-card {
    background: white;
    padding: 28px 24px;
    position: relative;
    overflow: hidden;
  }
  .week-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 4px; height: 100%;
  }
  .week-card:nth-child(1)::before { background: var(--pink); }
  .week-card:nth-child(2)::before { background: var(--periwinkle); }
  .week-card:nth-child(3)::before { background: var(--peach); }
  .week-card:nth-child(4)::before { background: var(--lime); }

  .week-number {
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--text-light);
    margin-bottom: 6px;
  }
  .week-title {
    font-family: 'Lora', serif;
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--charcoal);
    margin-bottom: 10px;
  }
  .week-activities {
    font-size: 0.82rem;
    color: var(--text-light);
    margin-bottom: 12px;
    font-weight: 500;
  }
  .week-desc {
    font-size: 0.88rem;
    color: var(--text-light);
    line-height: 1.6;
  }

  /* Activity format */
  .activity-format {
    margin-top: 36px;
    background: var(--bg-warm);
    border: 1px solid var(--border);
    padding: 28px 28px 24px;
  }
  .format-title {
    font-size: 0.72rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--charcoal);
    margin-bottom: 18px;
  }
  .format-steps {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
  }
  .format-step { display: flex; flex-direction: column; gap: 6px; }
  .step-num {
    width: 28px; height: 28px;
    background: var(--charcoal);
    color: var(--vanilla);
    font-size: 0.78rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .step-label {
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--charcoal);
  }
  .step-desc {
    font-size: 0.78rem;
    color: var(--text-light);
    line-height: 1.5;
  }

  /* Who it's for */
  .for-section {
    padding: 60px 0;
    border-bottom: 1px solid var(--border);
  }
  .for-section h2 {
    font-family: 'Lora', serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--charcoal);
    margin-bottom: 28px;
  }
  .for-list { display: flex; flex-direction: column; gap: 0; }
  .for-item {
    display: flex;
    gap: 16px;
    align-items: flex-start;
    padding: 16px 0;
    border-bottom: 1px solid var(--border);
  }
  .for-item:last-child { border-bottom: none; }
  .for-dash {
    width: 20px;
    height: 2px;
    background: var(--pink);
    margin-top: 11px;
    flex-shrink: 0;
  }
  .for-text {
    font-family: 'Lora', serif;
    font-size: 0.98rem;
    line-height: 1.6;
    color: var(--text);
  }

  /* Bottom CTA */
  .bottom-cta {
    background: var(--charcoal);
    padding: 64px 40px;
    text-align: center;
  }
  .cta-label {
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--soft-peach);
    margin-bottom: 16px;
  }
  .cta-headline {
    font-family: 'Lora', serif;
    font-size: 1.9rem;
    font-weight: 700;
    color: var(--vanilla);
    margin-bottom: 12px;
    line-height: 1.3;
  }
  .cta-sub {
    color: rgba(255,248,238,0.6);
    font-size: 0.95rem;
    margin-bottom: 36px;
  }
  .cta-buttons {
    display: flex;
    gap: 16px;
    justify-content: center;
    flex-wrap: wrap;
  }
  .cta-btn {
    display: inline-block;
    padding: 16px 32px;
    font-family: 'DM Sans', sans-serif;
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    text-decoration: none;
    transition: transform 0.15s;
  }
  .cta-btn:hover { transform: translateY(-2px); }
  .cta-pdf { background: var(--pink); color: white; }
  .cta-paperback { background: transparent; color: var(--vanilla); border: 2px solid rgba(255,248,238,0.3); }
  .cta-paperback:hover { border-color: var(--soft-peach); }

  /* Footer */
  .site-footer {
    background: var(--charcoal);
    border-top: 1px solid rgba(255,248,238,0.08);
    padding: 32px 40px;
    text-align: center;
  }
  .footer-logo {
    font-family: 'Lora', serif;
    font-size: 0.85rem;
    letter-spacing: 0.18em;
    font-weight: 700;
    color: var(--periwinkle);
    margin-bottom: 6px;
  }
  .footer-logo span { color: var(--pink); }
  .footer-sub {
    font-size: 0.72rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: rgba(255,248,238,0.35);
    margin-bottom: 20px;
  }
  .footer-links { display: flex; gap: 24px; justify-content: center; flex-wrap: wrap; }
  .footer-links a {
    font-size: 0.78rem;
    color: rgba(255,248,238,0.45);
    text-decoration: none;
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }
  .footer-links a:hover { color: var(--soft-peach); }
  .footer-copy {
    margin-top: 20px;
    font-size: 0.72rem;
    color: rgba(255,248,238,0.25);
  }

  @media (max-width: 768px) {
    .product-hero { grid-template-columns: 1fr; }
    .product-visual { padding: 48px 32px; min-height: 320px; }
    .product-info { padding: 40px 24px; }
    .about-section { grid-template-columns: 1fr; gap: 32px; }
    .about-callout { position: static; }
    .weeks-grid { grid-template-columns: 1fr; }
    .format-steps { grid-template-columns: 1fr 1fr; }
    .product-body { padding: 0 20px 60px; }
    .site-nav { padding: 0 20px; }
    .nav-links { display: none; }
    .breadcrumb { padding: 10px 20px; }
    .bottom-cta { padding: 48px 20px; }
  }
</style>
</head>
<body>

<!-- NAV -->
<nav class="site-nav">
  <a href="/" class="nav-logo">MY NEST <span>Chapter</span></a>
  <ul class="nav-links">
    <li><a href="/">Home</a></li>
    <li><a href="/about">About</a></li>
    <li><a href="/blog">Blog</a></li>
    <li><a href="/shop">Shop</a></li>
    <li><a href="/resources">Resources</a></li>
    <li><a href="/freebies">Freebies</a></li>
  </ul>
</nav>

<!-- BREADCRUMB -->
<div class="breadcrumb">
  <a href="/">Home</a>
  <span class="sep">→</span>
  <a href="/shop">Shop</a>
  <span class="sep">→</span>
  <span class="current">Now What? Workbook</span>
</div>

<!-- PRODUCT HERO -->
<div class="product-hero">

  <!-- Book cover image -->
  <div class="product-visual">
    <div class="book-scene">
      <div class="book-mockup">
        <div class="book-badge">WORKBOOK</div>
        <img src="/assets/images/workbook-cover.png" alt="Now What? A Workbook for Solo Moms in the Empty Nest by Cecilia Ann">
      </div>
    </div>
  </div>

  <!-- Product info -->
  <div class="product-info">
    <div class="product-label">Workbook · Reclaiming You Series</div>
    <h1 class="product-title">Now What? A Workbook for Solo Moms in the Empty Nest</h1>

    <p class="product-hook">"I made this because nothing out there was written for someone like me — a mom who raised her kids mostly alone, who gave everything she had, and then had no idea what to do when they left."</p>

    <div class="product-meta">
      <div class="meta-pill">14 Activities</div>
      <div class="meta-pill">4 Sections · 4 Weeks</div>
      <div class="meta-pill">140+ Pages</div>
      <div class="meta-pill">Not therapy. Real work.</div>
    </div>

    <hr class="buy-divider">
    <div class="buy-label">Choose your format</div>

    <div class="buy-section">
      <!-- PDF via dashboard checkout -->
      <div class="buy-option">
        <div class="buy-option-info">
          <div class="buy-option-type">PDF Download</div>
          <div class="buy-option-desc">Instant access — print at home or use digitally</div>
          <div class="buy-option-note">Download immediately after purchase</div>
        </div>
        <div class="buy-option-right">
          <div class="buy-price">$14.99</div>
          <a href="/checkout?product=now-what-workbook" class="btn-buy btn-pdf">Buy PDF</a>
        </div>
      </div>

      <!-- Amazon paperback -->
      <div class="buy-option">
        <div class="buy-option-info">
          <div class="buy-option-type">Paperback · Amazon</div>
          <div class="buy-option-desc">Physical copy — write directly in the workbook</div>
          <div class="buy-option-note">Ships from Amazon · Standard delivery</div>
        </div>
        <div class="buy-option-right">
          <div class="buy-price">$24.99</div>
          <a href="<?= htmlspecialchars($AMAZON_LINK) ?>" target="_blank" rel="noopener" class="btn-buy btn-amazon">Buy on Amazon</a>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- PRODUCT BODY -->
<div class="product-body">

  <!-- About / Story -->
  <div class="about-section">
    <div class="about-text">
      <div class="section-label">Why I made this</div>
      <p>When my youngest left, I fell apart. The house went quiet in a way I wasn't ready for. I went looking for something — a book, a workbook, a resource — written for someone like me. A mom who had done it alone. Who had no co-parent to turn to and say "now what do we do."</p>
      <p>I couldn't find anything. Everything I found was written for empty nesters in general — or for women with partners. Nothing for the mom who had stretched every dollar, made every decision by herself, stayed up every night alone, and then suddenly had no one to take care of.</p>
      <p>So I made this. 14 activities across 4 weeks. Not therapy. Not a self-help program. Just the work that actually helped me start to figure out who I was when I wasn't just their mom anymore.</p>
      <p>It might help you too. I can't promise that. But it helped me.</p>
    </div>
    <div class="about-callout">
      <div class="callout-quote">"I raised five kids mostly on my own. When they left, I fell apart. Then I rebuilt my life. This is the workbook I wish I'd had."</div>
      <div class="callout-attr">— Cecilia Ann, founder of My Nest Chapter</div>
    </div>
  </div>

  <!-- What's Inside -->
  <div class="inside-section">
    <div class="section-label">What's inside</div>
    <h2>14 Activities. 4 Weeks. All of it real.</h2>
    <p class="inside-intro">Each section builds on the last. Move through them in order — or go at your own pace. There's no wrong way to do this.</p>

    <div class="weeks-grid">
      <div class="week-card">
        <div class="week-number">Week 1 · Activities 1–4</div>
        <div class="week-title">The Weight You Lived</div>
        <div class="week-activities">4 activities</div>
        <div class="week-desc">You kept the lights on, the kids fed, everything running — alone. This section helps you finally see everything you were actually doing. The roles, the decisions, the losses. Written down, it's a lot.</div>
      </div>
      <div class="week-card">
        <div class="week-number">Week 2 · Activities 5–7</div>
        <div class="week-title">Why You Feel Lost</div>
        <div class="week-activities">3 activities</div>
        <div class="week-desc">The quiet hits different when there's no co-parent in the next room. When the structure they needed — and you built — disappears overnight. This section looks at what changed and why it feels the way it feels.</div>
      </div>
      <div class="week-card">
        <div class="week-number">Week 3 · Activities 8–10</div>
        <div class="week-title">Who You Were Before</div>
        <div class="week-activities">3 activities</div>
        <div class="week-desc">Before you were Mom, you were someone. Before the school schedules and the solo bedtimes and the decisions that fell only on you — there was a version of you with interests, wants, and things she loved. This section goes back to find her.</div>
      </div>
      <div class="week-card">
        <div class="week-number">Week 4 · Activities 11–14</div>
        <div class="week-title">Building Your Foundation</div>
        <div class="week-activities">4 activities</div>
        <div class="week-desc">Your values. Your strengths. What gives you energy and what takes it. All of it on one page — for the first time, about you. This is where you start seeing what you actually have to work with.</div>
      </div>
    </div>

    <div class="activity-format">
      <div class="format-title">How each activity works</div>
      <div class="format-steps">
        <div class="format-step">
          <div class="step-num">1</div>
          <div class="step-label">Why Do This</div>
          <div class="step-desc">The purpose and what it might show you</div>
        </div>
        <div class="format-step">
          <div class="step-num">2</div>
          <div class="step-label">How To Do It</div>
          <div class="step-desc">Clear instructions — no guessing what comes next</div>
        </div>
        <div class="format-step">
          <div class="step-num">3</div>
          <div class="step-label">The Activity</div>
          <div class="step-desc">Where you do the actual work</div>
        </div>
        <div class="format-step">
          <div class="step-num">4</div>
          <div class="step-label">What You Gained</div>
          <div class="step-desc">What this activity showed you — a moment to reflect before moving on</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Who it's for -->
  <div class="for-section">
    <div class="section-label">Who this is for</div>
    <h2>This might be for you if —</h2>
    <div class="for-list">
      <div class="for-item">
        <div class="for-dash"></div>
        <div class="for-text">You raised your kids mostly alone and now the house is quiet in a way that doesn't feel peaceful</div>
      </div>
      <div class="for-item">
        <div class="for-dash"></div>
        <div class="for-text">You've tried to "move on" or "stay busy" and it hasn't worked — because you skipped something</div>
      </div>
      <div class="for-item">
        <div class="for-dash"></div>
        <div class="for-text">You don't know who you are when you're not someone's mom anymore</div>
      </div>
      <div class="for-item">
        <div class="for-dash"></div>
        <div class="for-text">You want something concrete to do — not advice, not inspiration, actual work you can sit down and do</div>
      </div>
      <div class="for-item">
        <div class="for-dash"></div>
        <div class="for-text">You don't want therapy-speak or coaching language — you want something that sounds like a real person who has actually been through it</div>
      </div>
      <div class="for-item">
        <div class="for-dash"></div>
        <div class="for-text">You're not looking for promises — you're looking for a place to start</div>
      </div>
    </div>
  </div>

</div><!-- end product-body -->

<!-- BOTTOM CTA -->
<div class="bottom-cta">
  <div class="cta-label">Ready to start?</div>
  <h2 class="cta-headline">Pick your format and get started today.</h2>
  <p class="cta-sub">PDF download · $14.99 &nbsp;|&nbsp; Amazon paperback · $24.99</p>
  <div class="cta-buttons">
    <a href="/checkout?product=now-what-workbook" class="cta-btn cta-pdf">Get the PDF — $14.99</a>
    <a href="<?= htmlspecialchars($AMAZON_LINK) ?>" target="_blank" rel="noopener" class="cta-btn cta-paperback">Buy the Paperback on Amazon</a>
  </div>
</div>

<!-- FOOTER -->
<footer class="site-footer">
  <div class="footer-logo">MY NEST <span>Chapter</span></div>
  <div class="footer-sub">For Single &amp; Solo Moms</div>
  <div class="footer-links">
    <a href="/">Home</a>
    <a href="/about">About</a>
    <a href="/blog">Blog</a>
    <a href="/shop">Shop</a>
    <a href="/resources">Resources</a>
    <a href="/freebies">Freebies</a>
  </div>
  <div class="footer-copy">&copy; 2026 My Nest Chapter. All rights reserved.</div>
</footer>

</body>
</html>
