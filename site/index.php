<?php
// Homepage (launched Nov 16 2026): warm white page with flowing coral bands.
// Coral leads; lagoon and raspberry are small sparkle pops. ?lead=lagoon|raspberry previews the other colors.
// Story order, top to bottom: who I am -> what's possible -> where it lives (the Hub)
// -> things I made -> my story -> your next step.
$hub = 'https://hub.mynestchapter.com/';
$login = $hub . '?mode=login';
$shop = $hub . '#/shop/';
$lead = isset($_GET['lead']) && in_array($_GET['lead'], ['lagoon','coral','raspberry'], true) ? $_GET['lead'] : 'coral';
$star = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 0l2.6 9.4L24 12l-9.4 2.6L12 24l-2.6-9.4L0 12l9.4-2.6z"/></svg>';
?><!DOCTYPE html>
<html lang="en" data-lead="<?= $lead ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Solo mom. Empty nest. Now what? | My Nest Chapter</title>
<meta name="description" content="My Nest Chapter is a free Hub for single and solo moms in the empty nest chapter: a place to plan, explore, connect, and discover what's possible.">
<link rel="canonical" href="https://mynestchapter.com/">
<meta property="og:title" content="Solo mom. Empty nest. Now what?">
<meta property="og:description" content="A free Hub for single and solo moms in the empty nest chapter.">
<meta property="og:url" content="https://mynestchapter.com/">
<meta property="og:image" content="https://mynestchapter.com/assets/images/cece-writing.jpg">
<meta property="og:type" content="website">
<meta name="theme-color" content="#F49B8F">
<link rel="icon" type="image/svg+xml" href="/assets/images/favicon.svg">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;700&family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/home.css?v=18">
<link rel="stylesheet" href="/assets/css/fresh.css?v=90">
<script>document.documentElement.classList.add('js')</script>
<script src="/assets/js/home.js?v=20261119a" defer></script>
</head>
<body>
<a class="skip" href="#main">Skip to content</a>
<svg width="0" height="0" style="position:absolute" aria-hidden="true" focusable="false">
  <filter id="wash" x="-50%" y="-50%" width="200%" height="200%">
    <feTurbulence type="fractalNoise" baseFrequency="0.011" numOctaves="4" seed="11" result="noise"/>
    <feDisplacementMap in="SourceGraphic" in2="noise" scale="55" xChannelSelector="R" yChannelSelector="G" result="bled"/>
    <feGaussianBlur in="bled" stdDeviation="12"/>
  </filter>
</svg>

<header class="top">
  <div class="wrap top-in">
    <a class="brand" href="/" aria-label="My Nest Chapter, home">My Nest <span>Chapter</span></a>
    <nav class="top-nav" aria-label="Main">
      <a class="nav-link hide-sm" href="#possible">The Hub</a>
      <a class="nav-link hide-sm" href="#about">About me</a>
      <a class="nav-link" href="<?= $login ?>">Log in</a>
      <a class="btn btn-sm" href="<?= $hub ?>">Join the Hub</a>
    </nav>
  </div>
</header>

<main id="main">

  <!-- 1. Head: who I am, and the question -->
  <section class="hero">
    <div class="wrap hero-in">
      <div class="hero-copy">
        <span class="cf cf-a" style="top:-34px;left:56%"><?= $star ?></span>
        <span class="cf cf-b sm" style="top:-6px;left:64%"><?= $star ?></span>
        <h1><span class="l1">Solo mom. <span class="keep">Empty nest.</span></span> <span class="nw">Now what<span class="q">?</span> <em>Anything!</em></span></h1>
        <p class="lead">This chapter is wide open and full of possibilities.</p>
        <p class="lead hub-line">Start finding yours in the free My Nest Chapter Hub, a place to <b>explore</b>, <b>plan</b>, and <b>talk them over</b> with women who get it.</p>
        <div class="cta-row">
          <a class="btn" href="<?= $hub ?>">Join the free Hub <span aria-hidden="true">&rarr;</span></a>
          <a class="text-link" href="#possible">Take a peek inside</a>
        </div>
      </div>
      <figure class="hero-note">
        <span class="cf cf-c" style="top:-18px;right:6%"><?= $star ?></span>
        <aside class="note" aria-label="Possibilities">
          <span class="cf cf-b" style="top:-16px;left:-14px"><?= $star ?></span>
          <p class="note-title">Possibilities&hellip;</p>
          <ul class="note-list">
            <li><span class="star s-1" aria-hidden="true"></span>travel</li>
            <li><span class="star s-2" aria-hidden="true"></span>a new friendship</li>
            <li><span class="star s-3" aria-hidden="true"></span>back to school</li>
            <li><span class="star s-1" aria-hidden="true"></span>getting a pet</li>
            <li><span class="star s-2" aria-hidden="true"></span>a home refresh</li>
            <li><span class="star s-3" aria-hidden="true"></span>a new career</li>
            <li><span class="star s-1" aria-hidden="true"></span>a garage sale</li>
            <li><span class="star s-1" aria-hidden="true"></span>volunteering</li>
            <li><span class="star s-2" aria-hidden="true"></span>van life</li>
            <li><span class="star s-1" aria-hidden="true"></span>a tiny home</li>
            <li><span class="star s-3" aria-hidden="true"></span>a creative hobby</li>
            <li><span class="star s-1" aria-hidden="true"></span>a side business</li>
            <li><span class="star s-2" aria-hidden="true"></span>a road trip</li>
            <li><span class="star s-3" aria-hidden="true"></span>cooking for one</li>
            <li class="raspberry"><span class="star s-rasp" aria-hidden="true"></span>something completely unexpected</li>
          </ul>
        </aside>
      </figure>
    </div>
  </section>

  <!-- 2. A peek inside the Hub: the phone hangs over into the coral band -->
  <section class="band band-tint chapters peek" id="possible" aria-labelledby="hub-h">
    <div class="wrap peek-in">
      <figure class="hub-phone peek-phone">
        <div class="phone-frame"><div class="phone-screen">
          <img src="/assets/images/hub/my-possibilities-phone.webp?v=10" alt="My Possibilities in the Hub on a phone, with ideas written on the page: take a pottery class, a road trip out west, learn how to paint." width="600" height="1154" loading="lazy">
          <div class="phone-writing" aria-hidden="true"><span class="pw pw1"><span class="star s-1"></span><span class="pw-t">take a <span class="pw-glint">pottery</span> class</span></span><span class="pw pw2"><span class="star s-2"></span><span class="pw-t">a <span class="pw-glint g2">road</span> trip out west</span></span><span class="pw pw3"><span class="star s-3"></span><span class="pw-t">learn how to <span class="pw-glint g3">paint</span></span></span></div>
        </div></div>
      </figure>
      <div class="peek-side">
        <p class="script label">Inside the My Nest Chapter Hub</p>
        <h2 id="hub-h" class="sparkle-h"><span class="hl">Where your possibilities</span> <span class="hl">start to <span class="sparkle-word">sparkle<span class="sw-star sw1" aria-hidden="true"></span><span class="sw-star sw2" aria-hidden="true"></span><span class="sw-star sw3" aria-hidden="true"></span></span>.</span></h2>
      </div>
    </div>
  </section>

  <!-- 3. Arms: where it all lives, the Hub -->
  <section class="band band-bold wave-bottom hub" id="hub" aria-label="What's in the Hub">
    <div class="wrap">
      <ul class="tiles">
        <li><span class="ico" aria-hidden="true"><img src="/assets/images/hub/icons/possibilities.webp?v=3" alt="" width="96" height="96" loading="lazy"></span><div><h3>My Possibilities</h3><p>Jot down the possibilities you want to explore, plus notes and lists for everything else.</p></div></li>
        <li><span class="ico" aria-hidden="true"><img src="/assets/images/hub/icons/journal.webp" alt="" width="96" height="96" loading="lazy"></span><div><h3>My Journal</h3><p>Write about the possibilities you&rsquo;re curious about, with guided prompts when you&rsquo;d like a place to begin.</p></div></li>
        <li><span class="ico" aria-hidden="true"><img src="/assets/images/hub/icons/calendar.webp" alt="" width="96" height="96" loading="lazy"></span><div><h3>Calendar</h3><p>Put a possibility on the calendar: a class, a trip, a first try.</p></div></li>
        <li><span class="ico" aria-hidden="true"><img src="/assets/images/hub/icons/people.webp" alt="" width="96" height="96" loading="lazy"></span><div><h3>My People</h3><p>Your family and friends, their birthdays and the little details.</p></div></li>
        <li><span class="ico" aria-hidden="true"><img src="/assets/images/hub/icons/library-shelf.webp" alt="" width="96" height="96" loading="lazy"></span><div><h3>My Library</h3><p>Freebies and tools for the possibilities you want to explore, all in one place.</p></div></li>
        <li><span class="ico" aria-hidden="true"><img src="/assets/images/hub/icons/living-room-sofa.webp" alt="" width="96" height="96" loading="lazy"></span><div><h3>The Living Room</h3><p>Talk possibilities over with other women in this chapter.</p></div></li>
      </ul>
      <div class="center mt">
        <a class="btn btn-on-bold" href="<?= $hub ?>">Join the free Hub <span aria-hidden="true">&rarr;</span></a>
        <p class="join-note">It's free. You sign up with your name and email, and your journal stays private to you.</p>
      </div>
    </div>
  </section>

  <!-- 4. Middle: things I made -->
  <section class="made" aria-labelledby="made-h">
    <span class="splash sp-2" aria-hidden="true"></span>
    <div class="wrap">
      <div class="sec-head">
        <p class="script label">From Cece</p>
        <h2 id="made-h">Roadmaps for some of your possibilities.</h2>
        <p>Planners and guides I made, each one a way into a possibility on that list. They live in the Hub Shop, so anything you buy stays in your Library.</p>
      </div>
      <div class="products">
        <a class="product" href="<?= $shop ?>garage-sale">
          <img src="/assets/images/hub/garage-sale.webp" alt="" width="1456" height="1088" loading="lazy">
          <div class="p-txt"><h3>Garage Sale Planner</h3><p>Their old rooms could be anything now.</p><p class="p-go"><span class="p-price">$27</span> See it in the Hub Shop <span aria-hidden="true">&rarr;</span></p></div>
        </a>
        <a class="product" href="<?= $shop ?>cooking">
          <img src="/assets/images/hub/cooking.webp" alt="" width="1456" height="1088" loading="lazy">
          <div class="p-txt"><h3>Cooking for One</h3><p>It's 6pm, and dinner is all yours.</p><p class="p-go"><span class="p-price">$27</span> See it in the Hub Shop <span aria-hidden="true">&rarr;</span></p></div>
        </a>
        <a class="product" href="<?= $shop ?>someday-companion">
          <img src="/assets/images/hub/someday-companion.webp" alt="" width="1456" height="1088" loading="lazy">
          <div class="p-txt"><h3>Someday List</h3><p>That list of things you'll do someday. Someday could be now.</p><p class="p-go"><span class="p-price">$7.99</span> See it in the Hub Shop <span aria-hidden="true">&rarr;</span></p></div>
        </a>
        <a class="product" href="<?= $shop ?>workbook">
          <img src="/assets/images/hub/workbook.webp" alt="" width="1456" height="1088" loading="lazy">
          <div class="p-txt"><h3>Now What? Workbook</h3><p>For when you want to write out where you are, one page at a time.</p><p class="p-go"><span class="p-price">$14.99</span> See it in the Hub Shop <span aria-hidden="true">&rarr;</span></p></div>
        </a>
      </div>
    </div>
  </section>

  <!-- 5. Legs: my story -->
  <section class="band band-tint about" id="about" aria-labelledby="about-h">
    <span class="splash sp-3" aria-hidden="true"></span>
    <div class="wrap about-in">
      <div class="about-side">
        <p class="script label">About me</p>
        <h2 id="about-h">Hi, I'm Cece.</h2>
        <blockquote class="pull">I see her. I hear her. I am her.</blockquote>
        <figure class="about-photo"><img src="/assets/images/cece-portrait.jpg" alt="Portrait of Cece, with her red hair pinned up and her glasses on" width="640" height="800" loading="lazy"></figure>
      </div>
      <div class="about-copy">
        <p>I raised my kids mostly on my own. When they grew up and left, I felt sad and lonely, and for a long time I didn't do anything about it. I stayed stuck there longer than I wanted to.</p>
        <p>Life is short. I don't want another single mom to lose that time the way I did. I want her to know that life is still out there, that she can live it, and that she still has value. She is important.</p>
        <p>I think of life like a book. There's a beginning, a middle and an end. And mine isn't over. Not even close.</p>
        <p>So I built My Nest Chapter. I'm not a coach or a therapist. I'm a mom who lived it, sharing the ideas, tools and little nudges that opened things up for me. Some of them might do the same for you. You get to choose what fits.</p>
        <p>I'm a grandma now, too. That's a whole new chapter I didn't see coming, and I'm figuring it out as I go.</p>
        <p class="script sign">Cece</p>
      </div>
    </div>
  </section>

  <!-- 6. Feet: your next step -->
  <section class="band band-bold closing">
    <span class="cf cf-a" style="top:18%;left:9%"><?= $star ?></span>
    <span class="cf cf-c sm" style="top:30%;left:14%"><?= $star ?></span>
    <span class="cf cf-b" style="bottom:24%;right:10%"><?= $star ?></span>
    <span class="cf cf-c" style="top:22%;right:15%"><?= $star ?></span>
    <span class="cf cf-a sm" style="bottom:30%;left:18%"><?= $star ?></span>
    <span class="cf cf-b sm" style="bottom:16%;right:19%"><?= $star ?></span>
    <div class="wrap closing-in">
      <h2>Your life is yours. Your next chapter is yours. And you get to decide what happens next.</h2>
      <a class="btn btn-on-bold" href="<?= $hub ?>">Join the free Hub <span aria-hidden="true">&rarr;</span></a>
      <p class="small">Already a member? <a href="<?= $login ?>">Log in</a></p>
    </div>
  </section>

</main>

<footer class="foot">
  <div class="wrap foot-in">
    <p class="brand">My Nest <span>Chapter</span></p>
    <p>Solo mom. Empty nest. Now what?</p>
    <p class="fine"><a href="/privacy">Privacy</a> <span aria-hidden="true">&middot;</span> &copy; <?= date('Y') ?> My Nest Chapter</p>
  </div>
</footer>
</body>
</html>
