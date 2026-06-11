<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Free Coloring Pages — Pick Your Mood | My Nest Chapter</title>
<meta name="description" content="Some nights you don't need advice. Pick where you are right now and get a free coloring page that fits. From My Nest Chapter.">

<!-- Open Graph -->
<meta property="og:title" content="Free Coloring Pages — Pick Your Mood">
<meta property="og:description" content="Some nights you don't need advice. Pick your mood and get a free coloring page sent straight to your inbox.">
<meta property="og:url" content="https://mynestchapter.com/coloring">
<meta property="og:type" content="website">

<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --charcoal: #252535;
    --vanilla: #FFF8EE;
    --pink: #E87AAA;
    --periwinkle: #8BA7D4;
    --soft-peach: #F5C4A8;
    --text: #1a1a2e;
    --text-light: #555566;
    --border: #E8E0D5;
    --bg-warm: #FDFAF6;
  }

  html { scroll-behavior: smooth; }
  body { font-family: 'DM Sans', sans-serif; background: var(--vanilla); color: var(--text); line-height: 1.6; }

  /* NAV */
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

  /* BREADCRUMB */
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

  /* HERO */
  .hero {
    background: var(--bg-warm);
    border-bottom: 1px solid var(--border);
    padding: 64px 40px 56px;
    text-align: center;
  }
  .hero-eyebrow {
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--pink);
    margin-bottom: 20px;
  }
  .hero h1 {
    font-family: 'Lora', serif;
    font-size: 2.4rem;
    font-weight: 700;
    color: var(--charcoal);
    line-height: 1.2;
    margin-bottom: 20px;
    max-width: 640px;
    margin-left: auto;
    margin-right: auto;
  }
  .hero-sub {
    font-size: 1.05rem;
    color: var(--text-light);
    line-height: 1.7;
    max-width: 520px;
    margin: 0 auto 12px;
  }
  .hero-note {
    font-size: 0.82rem;
    color: var(--text-light);
    font-style: italic;
    opacity: 0.8;
  }

  /* WIDGET SECTION */
  .widget-section {
    padding: 56px 20px 72px;
    display: flex;
    justify-content: center;
  }
  .widget-wrap {
    width: 100%;
    max-width: 590px;
  }
  .widget-wrap iframe {
    width: 100%;
    height: 620px;
    border: none;
    display: block;
  }

  /* WHAT YOU GET */
  .what-section {
    background: var(--charcoal);
    padding: 56px 40px;
    text-align: center;
  }
  .what-eyebrow {
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--soft-peach);
    margin-bottom: 16px;
  }
  .what-section h2 {
    font-family: 'Lora', serif;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--vanilla);
    margin-bottom: 40px;
  }
  .what-grid {
    display: flex;
    gap: 0;
    justify-content: center;
    max-width: 760px;
    margin: 0 auto;
    border: 1px solid rgba(255,248,238,0.1);
  }
  .what-item {
    flex: 1;
    padding: 28px 24px;
    border-right: 1px solid rgba(255,248,238,0.1);
    text-align: left;
  }
  .what-item:last-child { border-right: none; }
  .what-label {
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--pink);
    margin-bottom: 8px;
  }
  .what-desc {
    font-size: 0.9rem;
    color: rgba(255,248,238,0.65);
    line-height: 1.6;
  }

  /* FOOTER */
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
    .site-nav { padding: 0 20px; }
    .nav-links { display: none; }
    .breadcrumb { padding: 10px 20px; }
    .hero { padding: 48px 24px 40px; }
    .hero h1 { font-size: 1.75rem; }
    .what-section { padding: 48px 20px; }
    .what-grid { flex-direction: column; }
    .what-item { border-right: none; border-bottom: 1px solid rgba(255,248,238,0.1); }
    .what-item:last-child { border-bottom: none; }
    .site-footer { padding: 32px 20px; }
  }
</style>
</head>
<body>

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

<div class="breadcrumb">
  <a href="/">Home</a>
  <span class="sep">→</span>
  <a href="/freebies">Freebies</a>
  <span class="sep">→</span>
  <span class="current">Pick Your Mood</span>
</div>

<section class="hero">
  <div class="hero-eyebrow">Free · No catch</div>
  <h1>Some nights you don't need advice.</h1>
  <p class="hero-sub">Pick where you are right now and I'll send you a free coloring page that fits. Three pages, cover included — yours to keep.</p>
  <p class="hero-note">Takes about 30 seconds. No spam. Unsubscribe anytime.</p>
</section>

<section class="widget-section">
  <div class="widget-wrap">
    <iframe
      src="/widgets/coloring-widget/"
      title="Pick Your Mood — free coloring pages"
      scrolling="no"
    ></iframe>
  </div>
</section>

<section class="what-section">
  <div class="what-eyebrow">What you're getting</div>
  <h2>Three coloring pages. One for wherever you are.</h2>
  <div class="what-grid">
    <div class="what-item">
      <div class="what-label">I need a distraction</div>
      <div class="what-desc">When the quiet is too loud and you just need somewhere to put your hands and eyes.</div>
    </div>
    <div class="what-item">
      <div class="what-label">I want to unwind</div>
      <div class="what-desc">When the day was a lot and you need something slow and low-stakes before bed.</div>
    </div>
    <div class="what-item">
      <div class="what-label">I just feel like coloring</div>
      <div class="what-desc">No reason needed. Sometimes you just want to color. That's enough.</div>
    </div>
  </div>
</section>

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
