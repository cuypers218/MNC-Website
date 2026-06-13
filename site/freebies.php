<?php
$pageTitle = 'Free Tools';
$pageDescription = 'Free tools from My Nest Chapter. No account needed, no catch.';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/auth.php';

$loggedIn = isLoggedIn();
$PDF_URL  = 'https://drive.google.com/uc?export=download&id=1dVTgwgBjwsg0jz9HCcGkPgif6edNhyQR';
?>

<section class="section">
  <div class="container">

    <h1 class="text-center fade-in" style="margin-bottom:0.25rem;">Free Tools</h1>
    <p class="text-center fade-in-delay-1" style="color:#666666;font-size:0.95rem;margin-bottom:3rem;">No catch. No upsell on the other side. Just things that helped me.</p>

    <!-- 6pm Cheat Sheet -->
    <div class="freebie-feature fade-in">
      <p class="freebie-eyebrow">FREE PDF</p>
      <h2 class="freebie-title">THE 6PM CHEAT SHEET</h2>
      <p class="freebie-body">The 6pm hour is the hardest part of the day. Nobody tells you that until you're already in it.<br><br>I put together 7 things that actually helped me get through it. Short. Honest. Free.</p>

      <?php if ($loggedIn): ?>
        <a href="<?= $PDF_URL ?>" target="_blank" rel="noopener" class="btn btn-primary">Download The 6pm Cheat Sheet</a>
      <?php else: ?>
        <div id="cs-cta">
          <button class="btn btn-primary" onclick="openCSForm()">Get the 6pm Cheat Sheet &rarr;</button>
        </div>
        <div id="cs-form" style="display:none;">
          <div class="cs-fields">
            <input type="text"  id="cs-name"  placeholder="First name"    autocomplete="given-name" aria-label="First name">
            <input type="email" id="cs-email" placeholder="Email address" autocomplete="email"      aria-label="Email address">
            <button class="btn btn-primary" id="cs-btn" onclick="submitCSForm()">Send it to me</button>
          </div>
          <p id="cs-error" style="display:none;color:#C45C88;font-size:0.85rem;margin-top:0.75rem;">Something went wrong — please try again.</p>
        </div>
        <div id="cs-success" style="display:none;">
          <p style="font-family:'Montserrat',sans-serif;font-weight:700;font-size:0.85rem;color:#FFF8EE;margin-bottom:1rem;">Check your inbox — it's on its way.</p>
          <a href="<?= $PDF_URL ?>" target="_blank" rel="noopener" class="btn btn-primary">Download it now instead</a>
        </div>
      <?php endif; ?>
    </div>

    <?php if (!$loggedIn): ?>
    <!-- Member teaser — only shown to non-members -->
    <div class="member-teaser fade-in">
      <p class="teaser-eyebrow">MY NEST CHAPTER</p>
      <h3 class="teaser-title">There's more inside.</h3>
      <p class="teaser-body">Create a free account to access the full freebie library — monthly drops, downloadable PDFs, and interactive tools.</p>
      <div style="display:flex;gap:1rem;flex-wrap:wrap;justify-content:center;margin-top:1.5rem;">
        <a href="/register" class="btn btn-primary">Create Your Free Account</a>
        <a href="/login" class="btn btn-outline">Log In</a>
      </div>
    </div>
    <?php endif; ?>

  </div>
</section>

<style>
.freebie-feature {
  max-width: 600px;
  margin: 0 auto 4rem;
  background: #252535;
  padding: 48px 52px;
}
.freebie-eyebrow {
  font-family: 'Montserrat', sans-serif;
  font-weight: 800;
  font-size: 0.7rem;
  text-transform: uppercase;
  letter-spacing: 0.15em;
  color: #E87AAA;
  margin-bottom: 0.75rem;
}
.freebie-title {
  font-family: 'Montserrat', sans-serif;
  font-weight: 800;
  font-size: 1.75rem;
  color: #FFF8EE;
  text-transform: uppercase;
  letter-spacing: 0.03em;
  line-height: 1.15;
  margin-bottom: 1.25rem;
}
.freebie-body {
  font-family: Arial, sans-serif;
  font-size: 0.95rem;
  color: rgba(255,248,238,0.75);
  line-height: 1.75;
  margin-bottom: 2rem;
}
.cs-fields {
  display: flex;
  flex-direction: column;
  gap: 10px;
  max-width: 340px;
}
.cs-fields input {
  font-family: Arial, sans-serif;
  font-size: 0.9rem;
  color: #FFF8EE;
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,248,238,0.2);
  padding: 13px 14px;
  outline: none;
  touch-action: manipulation;
}
.cs-fields input:focus { border-color: #E87AAA; }
.cs-fields input::placeholder { color: rgba(255,248,238,0.35); }
.member-teaser {
  max-width: 520px;
  margin: 0 auto;
  text-align: center;
  padding: 3rem 1.5rem;
  border-top: 1px solid #D3D3D3;
}
.teaser-eyebrow {
  font-family: 'Montserrat', sans-serif;
  font-weight: 800;
  font-size: 0.7rem;
  text-transform: uppercase;
  letter-spacing: 0.15em;
  color: #ABABAB;
  margin-bottom: 0.75rem;
}
.teaser-title {
  font-family: 'Montserrat', sans-serif;
  font-weight: 800;
  font-size: 1.4rem;
  color: #252535;
  margin-bottom: 0.75rem;
}
.teaser-body {
  font-family: Arial, sans-serif;
  font-size: 0.9rem;
  color: #666666;
  line-height: 1.7;
}
@media (max-width: 600px) {
  .freebie-feature { padding: 36px 28px; }
}
</style>

<script>
function openCSForm() {
  document.getElementById('cs-cta').style.display = 'none';
  document.getElementById('cs-form').style.display = 'block';
  document.getElementById('cs-name').focus();
}

async function submitCSForm() {
  var name  = document.getElementById('cs-name').value.trim();
  var email = document.getElementById('cs-email').value.trim();
  var btn   = document.getElementById('cs-btn');
  var error = document.getElementById('cs-error');

  if (!email || !email.includes('@')) {
    document.getElementById('cs-email').style.borderColor = 'rgba(242,165,122,0.8)';
    document.getElementById('cs-email').focus();
    return;
  }

  btn.textContent = 'Sending…';
  btn.disabled = true;
  error.style.display = 'none';

  try {
    var res = await fetch('/reach-subscribe.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email: email, first_name: name })
    });
    if (res.ok) {
      document.getElementById('cs-form').style.display = 'none';
      document.getElementById('cs-success').style.display = 'block';
    } else { throw new Error(); }
  } catch(e) {
    btn.textContent = 'Send it to me';
    btn.disabled = false;
    error.style.display = 'block';
  }
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
