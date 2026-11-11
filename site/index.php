<?php
// One-page site (Nov 2026). Every button leads into the free Hub.
// Look: Fresh Horizon palette, Playfair Display + Montserrat, matching the Hub.
$hub = 'https://hub.mynestchapter.com/';
?><!DOCTYPE html>
<html lang="en">
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
<meta name="theme-color" content="#1F6F78">
<link rel="icon" type="image/svg+xml" href="/assets/images/favicon.svg">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;700&family=Montserrat:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/home.css?v=2">
<script>document.documentElement.classList.add('js')</script>
<script src="/assets/js/home.js?v=1" defer></script>
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
      <a class="nav-link hide-sm" href="#hub">The Hub</a>
      <a class="nav-link hide-sm" href="#about">About me</a>
      <a class="nav-link" href="<?= $hub ?>">Log in</a>
      <a class="btn btn-sm" href="<?= $hub ?>">Join the Hub</a>
    </nav>
  </div>
</header>

<main id="main">

  <!-- Hero -->
  <section class="hero">
    <div class="wrap hero-in">
      <div class="hero-copy">
        <p class="eyebrow"><span class="dot" aria-hidden="true"></span>For single and solo moms</p>
        <h1><span class="l1">Solo mom. <span class="keep">Empty nest.</span></span> <span class="nw"><em>Now what<span class="q">?</span></em></span></h1>
        <p class="lead">I'm Cece. I raised my kids on my own, and then they grew up and moved out. The house got quiet. After a while, I started looking at what was still out there for me. Turns out, a lot.</p>
        <p class="lead strong">I'm not here to tell you what your next chapter should be. I'm here to help you discover what's possible.</p>
        <div class="cta-row">
          <a class="btn" href="<?= $hub ?>">Join the free Hub <span aria-hidden="true">&rarr;</span></a>
          <a class="text-link" href="#hub">See what's inside</a>
        </div>
      </div>
      <figure class="hero-art">
        <span class="blob b1" aria-hidden="true"></span>
        <span class="blob b2" aria-hidden="true"></span>
        <span class="blob b3" aria-hidden="true"></span>
        <div class="photo">
          <img src="/assets/images/cece-writing.jpg" alt="Cece writing in a notebook at her kitchen table" width="1000" height="1250">
        </div>
        <figcaption class="script tag">Writing my next chapter</figcaption>
      </figure>
    </div>
  </section>

  <!-- Many chapters -->
  <section class="chapters" aria-labelledby="chapters-h">
    <div class="wrap chapters-in">
      <h2 id="chapters-h">Your next chapter is full of possibilities.</h2>
      <aside class="note" aria-label="A few of the possibilities">
        <p class="note-title">A few of them&hellip;</p>
        <ul class="note-list">
          <li><span class="star s-peach" aria-hidden="true"></span>travel</li>
          <li><span class="star s-lagoon" aria-hidden="true"></span>a new friendship</li>
          <li><span class="star s-coral" aria-hidden="true"></span>back to school</li>
          <li><span class="star s-yellow" aria-hidden="true"></span>getting a pet</li>
          <li><span class="star s-peach" aria-hidden="true"></span>a home refresh</li>
          <li><span class="star s-lagoon" aria-hidden="true"></span>a new career</li>
          <li><span class="star s-coral" aria-hidden="true"></span>volunteering</li>
          <li><span class="star s-yellow" aria-hidden="true"></span>van life or a tiny home</li>
          <li><span class="star s-peach" aria-hidden="true"></span>a creative hobby</li>
          <li><span class="star s-lagoon" aria-hidden="true"></span>a side business</li>
          <li class="raspberry"><span class="star s-rasp" aria-hidden="true"></span>something completely unexpected</li>
        </ul>
      </aside>
    </div>
  </section>

  <!-- The Hub -->
  <section class="hub" id="hub" aria-labelledby="hub-h">
    <div class="wrap">
      <div class="sec-head">
        <p class="script label">Free, with an account</p>
        <h2 id="hub-h">The Hub is your space.</h2>
        <p>Plan, explore, connect, and discover what's possible. Your ideas, your people, your plans and everything I make for you, kept in one place you can open on your phone.</p>
      </div>
      <div class="cards">
        <article class="card c-mint">
          <span class="ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M5 4h11a3 3 0 0 1 3 3v13H8a3 3 0 0 1-3-3z"/><path d="M5 17a3 3 0 0 1 3-3h11"/><path d="M9 8h6"/></svg></span>
          <h3>My Journal</h3>
          <p>Private pages on pretty paper. Write freely, or pick a guided prompt when you'd like a place to begin.</p>
        </article>
        <article class="card c-sky">
          <span class="ico" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="4" y="5" width="16" height="15" rx="2"/><path d="M4 10h16M9 3v4M15 3v4"/></svg></span>
          <h3>Calendar</h3>
          <p>Birthdays, appointments, and the things you want to try this month.</p>
        </article>
        <article class="card c-coral">
          <span class="ico" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.4"/><path d="M3.5 19a5.5 5.5 0 0 1 11 0M14.5 19a4 4 0 0 1 6-3.4"/></svg></span>
          <h3>My People</h3>
          <p>Family and friends, their birthdays and the little details, in one private place.</p>
        </article>
        <article class="card">
          <span class="ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M6 3h9l4 4v14H6z"/><path d="M14 3v5h5M9 12h6M9 16h6"/></svg></span>
          <h3>My Notes</h3>
          <p>Quick notes and lists for the ideas that show up at odd hours.</p>
        </article>
        <article class="card c-mint">
          <span class="ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M5 4h4v16H5zM10 4h4v16h-4z"/><path d="m15.5 5 3.8-1 3 15.4-3.8 1z"/></svg></span>
          <h3>My Library</h3>
          <p>Every freebie and everything you buy, together, so nothing gets lost in your email.</p>
        </article>
        <article class="card c-sky">
          <span class="ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 11.5 12 5l8 6.5"/><path d="M6 10v9h12v-9"/><path d="M10 19v-5h4v5"/></svg></span>
          <h3>The Living Room</h3>
          <p>Conversations with other women in this chapter, with a question to get things started.</p>
        </article>
      </div>
      <div class="center mt">
        <a class="btn" href="<?= $hub ?>">Join the free Hub <span aria-hidden="true">&rarr;</span></a>
      </div>
    </div>
  </section>

  <!-- Things I made -->
  <section class="made" aria-labelledby="made-h">
    <div class="wrap">
      <div class="sec-head">
        <p class="script label">From Cece</p>
        <h2 id="made-h">Things I made for my next chapter.</h2>
        <p>Maybe one of them sparks something in yours. They live in the Hub's Shop, so anything you buy stays in your Library.</p>
      </div>
      <div class="products">
        <a class="product" href="<?= $hub ?>">
          <img src="/assets/images/hub/garage-sale.webp" alt="" width="1456" height="1088" loading="lazy">
          <h3>Garage Sale Planner</h3>
          <p>Their old rooms could be anything now.</p>
        </a>
        <a class="product" href="<?= $hub ?>">
          <img src="/assets/images/hub/cooking.webp" alt="" width="1456" height="1088" loading="lazy">
          <h3>Cooking for One Planner</h3>
          <p>It's 6pm, and dinner is all yours.</p>
        </a>
        <a class="product" href="<?= $hub ?>">
          <img src="/assets/images/hub/someday-companion.webp" alt="" width="1456" height="1088" loading="lazy">
          <h3>Someday List Companion</h3>
          <p>That list of things you'll do someday. Someday could be now.</p>
        </a>
        <a class="product" href="<?= $hub ?>">
          <img src="/assets/images/hub/workbook.webp" alt="" width="1456" height="1088" loading="lazy">
          <h3>Now What? Workbook</h3>
          <p>For when you want to write out where you are, one page at a time.</p>
        </a>
      </div>
    </div>
  </section>

  <!-- About me -->
  <section class="about" id="about" aria-labelledby="about-h">
    <div class="wrap about-in">
      <div class="about-side">
        <p class="script label">About me</p>
        <h2 id="about-h">Hi, I'm Cece.</h2>
        <blockquote class="pull">I see her. I hear her. I am her.</blockquote>
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

  <!-- Closing band -->
  <section class="closing">
    <span class="blob cb1" aria-hidden="true"></span>
    <span class="blob cb2" aria-hidden="true"></span>
    <div class="wrap closing-in">
      <h2>Your life is yours. Your next chapter is yours. And you get to decide what happens next.</h2>
      <a class="btn btn-light" href="<?= $hub ?>">Join the free Hub <span aria-hidden="true">&rarr;</span></a>
      <p class="small">It's free. Already a member? <a href="<?= $hub ?>">Log in</a></p>
    </div>
  </section>

</main>

<footer class="foot">
  <div class="wrap foot-in">
    <p class="brand">My Nest <span>Chapter</span></p>
    <p>Solo mom. Empty nest. Now what?</p>
    <p class="fine"><a href="https://hub.mynestchapter.com/#/privacy">Privacy</a> <span aria-hidden="true">&middot;</span> &copy; <?= date('Y') ?> My Nest Chapter</p>
  </div>
</footer>
</body>
</html>
