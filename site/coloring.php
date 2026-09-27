<?php
/**
 * Pick Your Mood Coloring Pages: the gate page (2026-09-26 book redesign).
 * Not linked from nav or the book, direct-link only, same as before.
 */
$pageTitle = 'Free Coloring Pages, Pick Your Mood';
$pageDescription = "Some nights you don't need advice. Pick where you are right now and get a free coloring page that fits. From My Nest Chapter.";
require_once __DIR__ . '/includes/header-book.php';
?>
<section class="spread" aria-label="Pick Your Mood Coloring Pages">
  <div class="page one plain narrow">
    <p class="menu-sub" style="margin-top:0">Free · no catch</p>
    <h1 class="as-h2">Some nights you don't need advice.</h1>
    <p>Pick where you are right now and get a free coloring page that fits. Three pages, cover included, yours to keep.</p>
    <div class="cta-row">
      <a class="btn" href="/start-here">Join the Hub, it's free <span class="arr" aria-hidden="true">→</span></a>
      <span class="note-line">Every freebie unlocks the moment you join, this one included.</span>
    </div>

    <p class="menu-sub" style="margin-top:2.4rem">What you're getting</p>
    <h2>Three coloring pages. One for wherever you are.</h2>
    <ul class="opens">
      <li><span class="tick"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8.5l3.2 3L13 4.5"/></svg></span><span><b>I need a distraction.</b> When the quiet is too loud and you just need somewhere to put your hands and eyes.</span></li>
      <li><span class="tick"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8.5l3.2 3L13 4.5"/></svg></span><span><b>I want to unwind.</b> When the day was a lot and you need something slow and low-stakes before bed.</span></li>
      <li><span class="tick"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8.5l3.2 3L13 4.5"/></svg></span><span><b>I just feel like coloring.</b> No reason needed. Sometimes you just want to color.</span></li>
    </ul>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer-book.php'; ?>
