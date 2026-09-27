<?php
/**
 * Now What? Workbook product page (2026-09-26 book redesign).
 * Same content and both buy options as before, restyled. The Amazon link is
 * still the placeholder found in the 2026-09-22 site audit — not fixed here,
 * flagged again below and in CLAUDE.md; do not invent a real URL.
 */
$AMAZON_LINK = "https://www.amazon.com/YOUR_BOOK_LINK"; // TODO(Cece): replace with the real KDP paperback listing URL
$pageTitle = 'Now What? A Workbook for Solo Moms in the Empty Nest';
$pageDescription = "14 activities across 4 weeks. Written by a solo mom who raised five kids alone and fell apart when they left. This is the workbook I wish I'd had.";
$pageImage = '/assets/images/workbook-cover.jpg';
require_once __DIR__ . '/includes/header-book.php';
?>
<section class="spread" aria-label="Now What? Workbook">
  <div class="page l">
    <figure class="album wb-cover">
      <div class="corners"><img src="/assets/images/workbook-cover.jpg" alt="Now What? A Workbook for Solo Moms in the Empty Nest, by Cecilia Ann" width="340" height="425"><i></i><i></i><i></i><i></i></div>
      <figcaption class="wb-badge">Workbook · Reclaiming You series</figcaption>
    </figure>
    <div class="pager desk"><a class="bk" href="/tools"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 12H5M11 6l-6 6 6 6"/></svg> Back to Tools</a></div>
  </div>

  <div class="page r">
    <h1 class="as-h2">Now What? A Workbook for Solo Moms in the Empty Nest</h1>
    <p class="wb-hook">"I made this because nothing out there was written for someone like me — a mom who raised her kids mostly alone, who gave everything she had, and then had no idea what to do when they left."</p>
    <ul class="wb-pills" aria-label="At a glance">
      <li>14 activities</li><li>4 sections · 4 weeks</li><li>140+ pages</li><li>Not therapy. Real work.</li>
    </ul>

    <p class="menu-sub" style="margin-top:1.5rem">Choose your format</p>
    <div class="buy-row">
      <div class="buy-opt">
        <div><p class="buy-type">PDF download</p><p class="buy-desc">Instant access, print at home or use digitally.</p></div>
        <div class="buy-right"><span class="buy-price">$14.99</span><a class="btn sm" href="https://hub.mynestchapter.com/#/shop">Buy PDF</a></div>
      </div>
      <div class="buy-opt">
        <div><p class="buy-type">Paperback · Amazon</p><p class="buy-desc">A physical copy, to write directly in.</p></div>
        <div class="buy-right"><span class="buy-price">$24.99</span><a class="btn sm" href="<?= esc($AMAZON_LINK) ?>" target="_blank" rel="noopener">Buy on Amazon</a></div>
      </div>
    </div>
  </div>
</section>

<section class="spread" aria-labelledby="why-h">
  <div class="page l">
    <p class="menu-sub">Why I made this</p>
    <h2 id="why-h">The workbook I wish I'd had.</h2>
    <p>When my youngest left, I fell apart. The house went quiet in a way I wasn't ready for. I went looking for something, a book, a workbook, a resource, written for someone like me. A mom who had done it alone. Who had no co-parent to turn to and say "now what do we do."</p>
    <p>I couldn't find anything. Everything I found was written for empty nesters in general, or for women with partners. Nothing for the mom who had stretched every dollar, made every decision by herself, stayed up every night alone, and then suddenly had no one to take care of.</p>
    <p>So I made this. 14 activities across 4 weeks. Not therapy. Not a self-help program. Just the work that actually helped me start to figure out who I was when I wasn't just their mom anymore.</p>
    <p>It might help you too. I can't promise that. But it helped me.</p>
  </div>
  <div class="page r">
    <blockquote class="wb-quote">"I raised five kids mostly on my own. When they left, I fell apart. Then I rebuilt my life. This is the workbook I wish I'd had."<cite>— Cecilia Ann, founder of My Nest Chapter</cite></blockquote>
    <div class="pager"><a class="bk mob" href="/tools"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 12H5M11 6l-6 6 6 6"/></svg> Back to Tools</a><a class="nx" href="#wb-inside">Turn the page <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12h15M13 6l6 6-6 6"/></svg></a></div>
  </div>
</section>

<section class="spread" id="wb-inside" aria-labelledby="inside-h">
  <div class="page one plain">
    <p class="menu-sub">What's inside</p>
    <h2 id="inside-h">14 activities. 4 weeks. All of it real.</h2>
    <p>Each section builds on the last. Move through them in order, or go at your own pace. There's no wrong way to do this.</p>
    <div class="wb-weeks">
      <div><p class="wb-wk-no">Week 1 · Activities 1–4</p><h3>The Weight You Lived</h3><p>You kept the lights on, the kids fed, everything running, alone. This section helps you finally see everything you were actually doing. The roles, the decisions, the losses. Written down, it's a lot.</p></div>
      <div><p class="wb-wk-no">Week 2 · Activities 5–7</p><h3>Why You Feel Lost</h3><p>The quiet hits different when there's no co-parent in the next room. When the structure they needed, and you built, disappears overnight. This section looks at what changed and why it feels the way it feels.</p></div>
      <div><p class="wb-wk-no">Week 3 · Activities 8–10</p><h3>Who You Were Before</h3><p>Before you were Mom, you were someone. Before the school schedules and the solo bedtimes and the decisions that fell only on you, there was a version of you with interests, wants, and things she loved. This section goes back to find her.</p></div>
      <div><p class="wb-wk-no">Week 4 · Activities 11–14</p><h3>Building Your Foundation</h3><p>Your values. Your strengths. What gives you energy and what takes it. All of it on one page, for the first time, about you. This is where you start seeing what you actually have to work with.</p></div>
    </div>
    <div class="wb-format">
      <p class="format-title">How each activity works</p>
      <ol class="wb-steps">
        <li><b>Why do this</b><span>The purpose, and what it might show you</span></li>
        <li><b>How to do it</b><span>Clear instructions, no guessing what comes next</span></li>
        <li><b>The activity</b><span>Where you do the actual work</span></li>
        <li><b>What you gained</b><span>What it showed you, a moment to reflect before moving on</span></li>
      </ol>
    </div>
  </div>
</section>

<section class="spread" aria-labelledby="for-h">
  <div class="page one plain">
    <p class="menu-sub">Who this is for</p>
    <h2 id="for-h">This might be for you if —</h2>
    <ul class="opens wb-for">
      <li><span class="tick"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8.5l3.2 3L13 4.5"/></svg></span><span>You raised your kids mostly alone, and now the house is quiet in a way that doesn't feel peaceful.</span></li>
      <li><span class="tick"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8.5l3.2 3L13 4.5"/></svg></span><span>You've tried to "move on" or "stay busy" and it hasn't worked, because you skipped something.</span></li>
      <li><span class="tick"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8.5l3.2 3L13 4.5"/></svg></span><span>You don't know who you are when you're not someone's mom anymore.</span></li>
      <li><span class="tick"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8.5l3.2 3L13 4.5"/></svg></span><span>You want something concrete to do, not advice, not inspiration, actual work you can sit down and do.</span></li>
      <li><span class="tick"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8.5l3.2 3L13 4.5"/></svg></span><span>You don't want therapy-speak or coaching language, you want something that sounds like a real person who has actually been through it.</span></li>
      <li><span class="tick"><svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8.5l3.2 3L13 4.5"/></svg></span><span>You're not looking for promises, you're looking for a place to start.</span></li>
    </ul>
    <p class="menu-sub" style="margin-top:2rem">Pick your format and get started today.</p>
    <div class="cta-row">
      <a class="btn" href="https://hub.mynestchapter.com/#/shop">Get the PDF, $14.99 <span class="arr" aria-hidden="true">→</span></a>
      <a class="link" href="<?= esc($AMAZON_LINK) ?>" target="_blank" rel="noopener">Buy the paperback on Amazon →</a>
    </div>
    <div class="pager"><a class="bk mob" href="#wb-inside"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 12H5M11 6l-6 6 6 6"/></svg> Back</a><a class="nx" href="/tools">Back to Tools <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12h15M13 6l6 6-6 6"/></svg></a></div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer-book.php'; ?>
