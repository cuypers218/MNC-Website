</main>

<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-brand">My Nest Chapter</div>
        <div class="footer-tagline">For Single &amp; Solo Moms</div>
        <nav class="footer-nav" aria-label="Footer navigation">
            <a href="/">Home</a>
            <a href="/about">About</a>
            <a href="/blog">Blog</a>
            <a href="/shop">Shop</a>
            <a href="/resources">Resources</a>
            <a href="/freebies">Freebies</a>
        </nav>
        <p class="footer-copy">&copy; <?= date('Y') ?> My Nest Chapter. All rights reserved.</p>
    </div>
</footer>

<!-- Toast container -->
<div class="toast" id="toast" aria-live="polite" aria-atomic="true"></div>

<script>
// --- Mobile Nav ---
function openMobileNav() {
    document.getElementById('mobileNav').classList.add('open');
    document.getElementById('mobileOverlay').style.display = 'block';
    document.body.style.overflow = 'hidden';
}
function closeMobileNav() {
    document.getElementById('mobileNav').classList.remove('open');
    document.getElementById('mobileOverlay').style.display = 'none';
    document.body.style.overflow = '';
}

// --- Toast ---
function showToast(message, duration) {
    duration = duration || 2000;
    var toast = document.getElementById('toast');
    toast.textContent = message;
    toast.classList.add('show');
    setTimeout(function() { toast.classList.remove('show'); }, duration);
}

// --- Email Capture (reusable) ---
function submitEmailCapture(form, source) {
    var email = form.querySelector('input[type="email"]').value.trim();
    if (!email) return;
    
    var btn = form.querySelector('button');
    var originalText = btn.textContent;
    btn.textContent = 'SENDING...';
    btn.disabled = true;
    
    fetch('/api/email', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email: email, source: source })
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.success) {
            showToast('CHECK YOUR INBOX');
            form.querySelector('input[type="email"]').value = '';
        } else {
            showToast('SOMETHING WENT WRONG');
        }
    })
    .catch(function() { showToast('SOMETHING WENT WRONG'); })
    .finally(function() {
        btn.textContent = originalText;
        btn.disabled = false;
    });
}
</script>

</body>
</html>
