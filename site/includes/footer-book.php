<?php
/**
 * footer-book.php: closes the book, then the newsletter strip and site footer.
 * Pairs with header-book.php. Nothing here needs the database.
 *
 * Newsletter: works without JavaScript (posts to /api/email.php, which sends
 * her back with ?subscribed=1) and is upgraded with fetch() to Hostinger Reach
 * (/reach-subscribe.php), the same endpoint and segment the old homepage used.
 */
$__nlDone  = ($_GET['subscribed'] ?? '') === '1';
$__nlError = ($_GET['subscribe_error'] ?? '') === '1';
$__nlBack  = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
?>
</div><!-- /.book -->
</main>

<div class="note-strip">
    <div class="in">
        <div>
            <h2>Not ready for a card? I'll show up in your inbox once a month.</h2>
            <p>What I'm working through right now. What helped. What still doesn't. Just where I really am.</p>
        </div>
        <div>
            <?php if ($__nlDone): ?>
                <p class="thanks" role="status">Check your inbox.</p>
            <?php else: ?>
                <form class="mailform" id="nl-form" action="/api/email.php" method="POST">
                    <input type="hidden" name="source" value="book-newsletter">
                    <input type="hidden" name="return_to" value="<?= esc($__nlBack) ?>">
                    <input type="email" id="nl-email" name="email" placeholder="Your email" required autocomplete="email" aria-label="Email address">
                    <button class="btn" type="submit" id="nl-submit">Count me in</button>
                </form>
                <p class="note-line<?= $__nlError ? ' err' : '' ?>" id="nl-msg" role="status" aria-live="polite" style="margin-top:.7rem"><?= $__nlError ? "That didn't go through. Please check your email and try again." : 'One email a month.' ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<footer>
    <div class="nav-in" style="flex-direction:column;gap:0;min-height:0;padding:0">
        <a class="mark" href="/" style="margin:0">My Nest Chapter</a>
        <p class="tg">For Single &amp; Solo Moms</p>
        <nav aria-label="Footer">
            <a href="/">Home</a>
            <a href="/about">About</a>
            <a href="/blog">Blog</a>
            <a href="/tools">Tools</a>
            <a href="/start-here">The Hub</a>
        </nav>
        <p class="hard-link"><a href="/tools#when-its-hard">For when it's really hard</a></p>
        <div class="soc">
            <a href="https://www.facebook.com/profile.php?id=61590806030391" target="_blank" rel="noopener" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>
            <a href="https://www.instagram.com/my.nest.chapter/" target="_blank" rel="noopener" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1.4" fill="currentColor" stroke="none"/></svg></a>
            <a href="https://www.pinterest.com/mynestchapter" target="_blank" rel="noopener" aria-label="Pinterest"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.4 0 0 5.4 0 12c0 5.1 3.2 9.4 7.6 11.2-.1-.9-.2-2.4 0-3.4l1.4-6s-.4-.7-.4-1.8c0-1.7 1-2.9 2.2-2.9 1 0 1.5.8 1.5 1.7 0 1-.7 2.6-1 4-.3 1.2.6 2.2 1.8 2.2 2.1 0 3.8-2.2 3.8-5.5 0-2.9-2.1-4.9-5-4.9-3.4 0-5.4 2.6-5.4 5.2 0 1 .4 2.1.9 2.7.1.1.1.2.1.3l-.3 1.4c0 .2-.2.3-.4.2-1.5-.7-2.4-2.9-2.4-4.6 0-3.8 2.7-7.3 7.9-7.3 4.2 0 7.4 3 7.4 6.9 0 4.1-2.6 7.5-6.2 7.5-1.2 0-2.4-.6-2.8-1.4l-.7 2.9c-.3 1-1 2.4-1.5 3.1 1.1.4 2.3.5 3.5.5 6.6 0 12-5.4 12-12S18.6 0 12 0z"/></svg></a>
        </div>
        <small>&copy; <?= date('Y') ?> My Nest Chapter. All rights reserved.</small>
    </div>
</footer>

<script>
(function () {
    var form = document.getElementById('nl-form');
    if (!form) return;
    var msg = document.getElementById('nl-msg');
    var btn = document.getElementById('nl-submit');
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var email = document.getElementById('nl-email').value.trim();
        if (!email) return;
        btn.disabled = true;
        btn.textContent = 'Sending…';
        msg.classList.remove('err');
        fetch('/reach-subscribe.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email: email, first_name: '', segment: 'b236abad-55a2-45a7-a0f1-9c4bfa003c77' })
        }).then(function (res) {
            return res.json().then(function (data) { return { ok: res.ok, data: data }; });
        }).then(function (r) {
            if (!(r.ok && r.data && r.data.success)) throw new Error('subscribe failed');
            var p = document.createElement('p');
            p.className = 'thanks';
            p.setAttribute('role', 'status');
            p.textContent = 'Check your inbox.';
            form.replaceWith(p);
            msg.textContent = '';
        }).catch(function () {
            btn.disabled = false;
            btn.textContent = 'Count me in';
            msg.classList.add('err');
            msg.textContent = "That didn't go through. Please check your email and try again.";
        });
    });
})();
</script>
</body>
</html>
