<?php
/**
 * Connect: email/text Cece directly (2026-09-26 book redesign).
 * Not in main nav or the book spreads, same as before; reachable by direct
 * link. Copy and destinations unchanged from the old page.
 */
$pageTitle = 'Talk to Cece';
$pageDescription = 'Email or text Cece directly, free. One mom talking to another.';
require_once __DIR__ . '/includes/header-book.php';
?>
<section class="spread" aria-label="Talk to Cece">
  <div class="page one plain narrow connect-page">
    <h1 class="as-h2">You can reach me. Here's how.</h1>
    <p>I built My Nest Chapter because I needed something like this and it didn't exist. If you found this page, maybe you're close to that same spot. There's more than one way to talk to me about it.</p>

    <div class="connect-card">
      <h2>Send me a message</h2>
      <p>Email or text me directly. I read every message myself. Some weeks I get right back to you. Some weeks it takes a few days. I'm one person doing this alone, and I read every one anyway.</p>
      <div class="cta-row">
        <a class="btn" href="mailto:connect@chat.mynestchapter.com">Email me <span class="arr" aria-hidden="true">→</span></a>
        <a class="link" href="sms:+12184810657">Text me →</a>
      </div>
    </div>
    <p class="note-line" style="margin-top:1.2rem;max-width:none">I'm not a therapist. I'm not your coach. I'm a mom who's been exactly where you are, answering when I can.</p>

    <h2 class="connect-h2">What happens with what you tell me</h2>
    <p>What you share with me, by email or text, stays between us. I don't share it, post about it, or bring it up anywhere else. The one exception is if something you tell me makes me think you or someone else might be in danger — then I'll say something, because your safety matters more than privacy.</p>
    <p>This isn't the same as legal confidentiality you'd get from a licensed therapist. It's my word, and I take it seriously.</p>

    <h2 class="connect-h2">A few things people ask</h2>
    <div class="faq">
      <p class="q">What do we talk about?</p>
      <p>Whatever's on your mind. The quiet house, the kids not calling back, figuring out who you are now that dinner isn't at six. I don't come in with an agenda.</p>
    </div>
    <div class="faq">
      <p class="q">Do I need to know what I need first?</p>
      <p>No. Most people don't. That's usually the reason to talk it through in the first place.</p>
    </div>
    <div class="faq">
      <p class="q">Is this coaching or therapy?</p>
      <p>No. I'm not licensed for either one. I'm a mom who lived this, talking to another mom living it.</p>
    </div>

    <figure class="album mini connect-photo">
      <div class="corners"><img src="/assets/images/cece-portrait-sm.jpg" alt="Cece, founder of My Nest Chapter" width="176" height="220" loading="lazy"><i></i><i></i><i></i><i></i></div>
    </figure>

    <div class="cta-row" style="margin-top:1.6rem">
      <a class="link" href="/about">Read my full story →</a>
      <a class="link" href="/">Back to home →</a>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer-book.php'; ?>
