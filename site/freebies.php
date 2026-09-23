<?php
$pageTitle = 'Freebies';
$pageDescription = 'Freebies from My Nest Chapter. Join the Hub, free, and get every one of them.';
require_once __DIR__ . '/includes/header.php';

// Every freebie unlocks the same way — join the Hub, free — instead of each
// running its own separate capture (previously: a one-off email form here for
// the 6pm Cheat Sheet, and no gate at all for the other two, a known gap
// CLAUDE.md had flagged but never fixed). One consistent path in, and every
// signup lands in the same place instead of splitting across two lists.
// Routed through /start-here (not straight to the Hub) — same "join" gateway
// every Log In/Create Account link on the site now uses.
$HUB_URL = '/start-here';
?>

<section class="section">
  <div class="container">

    <h1 class="text-center fade-in" style="margin-bottom:0.25rem;">Freebies</h1>
    <p class="text-center fade-in-delay-1" style="color:var(--warm-gray);font-size:0.95rem;margin-bottom:3rem;">No catch. No upsell on the other side. Join the Hub, free, and every one of these is yours.</p>

    <!-- 6pm Cheat Sheet -->
    <div class="freebie-feature fade-in">
      <p class="freebie-eyebrow">FREE PDF</p>
      <h2 class="freebie-title">THE 6PM CHEAT SHEET</h2>
      <p class="freebie-body">The 6pm hour is the hardest part of the day. Nobody tells you that until you're already in it.<br><br>I put together 7 things that actually helped me get through it. Short. Honest. Free.</p>
      <a href="<?= $HUB_URL ?>" class="btn btn-primary">Join the Hub — It's Free</a>
    </div>

    <!-- Someday List Builder -->
    <div class="freebie-feature fade-in">
      <p class="freebie-eyebrow">FREE TOOL</p>
      <h2 class="freebie-title">THE SOMEDAY LIST BUILDER</h2>
      <p class="freebie-body">You know that list in your head — the things you've been saying you'll do someday? This is where you actually write them down.<br><br>Takes five minutes. Your list can be emailed straight to you so it's there when you're ready.</p>
      <a href="<?= $HUB_URL ?>" class="btn btn-primary">Join the Hub — It's Free</a>
    </div>

    <!-- Pick Your Mood Coloring Pages -->
    <div class="freebie-feature fade-in">
      <p class="freebie-eyebrow">FREE DOWNLOAD</p>
      <h2 class="freebie-title">PICK YOUR MOOD COLORING PAGES</h2>
      <p class="freebie-body">Sometimes you don't need to talk about it. You just need something to do with your hands.<br><br>Pick your mood and get a coloring page made for exactly where you are right now. Download it, print it, and give yourself 20 minutes.</p>
      <a href="<?= $HUB_URL ?>" class="btn btn-primary">Join the Hub — It's Free</a>
    </div>

  </div>
</section>

<style>
.freebie-feature {
  max-width: 600px;
  margin: 0 auto 4rem;
  background: var(--deep-current);
  padding: 48px 52px;
}
.freebie-eyebrow {
  font-weight: 800;
  font-size: 0.7rem;
  text-transform: uppercase;
  letter-spacing: 0.15em;
  color: var(--golden-drift);
  margin-bottom: 0.75rem;
}
.freebie-title {
  font-weight: 800;
  font-size: 1.75rem;
  color: var(--vanilla-cream);
  text-transform: uppercase;
  letter-spacing: 0.03em;
  line-height: 1.15;
  margin-bottom: 1.25rem;
}
.freebie-body {
  font-family: Arial, sans-serif;
  font-size: 0.95rem;
  color: rgba(246,241,230,0.75);
  line-height: 1.75;
  margin-bottom: 2rem;
}
@media (max-width: 600px) {
  .freebie-feature { padding: 36px 28px; }
}
</style>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
