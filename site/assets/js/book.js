/*
 * book.js: the page turn between real pages (2026-09-26 book redesign).
 *
 * Progressive enhancement. Every link is a normal link that opens a normal page.
 * This script only steps in for links between the book pages: it fetches the
 * next page, flips the open book, updates the address bar and title, and swaps
 * the content. If ANYTHING goes wrong (network, unexpected page, old browser)
 * it does what the link would have done anyway: open the page normally.
 *
 * Phones, tablets narrower than 901px and "reduce motion" get a plain swap
 * with no flip. Modifier-clicks (new tab), downloads and other sites are left alone.
 */
(function () {
    'use strict';
    if (!window.fetch || !window.DOMParser || !window.history || !history.pushState) return;

    var book = document.getElementById('book');
    if (!book) return;

    var ORDER = { '/': 0, '/about': 1, '/blog': 2, '/tools': 3, '/start-here': 4 };
    var BOOK_PATH = /^\/(?:about|blog(?:\/[a-z0-9-]+)?|tools|start-here)?\/?$/;
    var TURN_MS = 1300;
    var EASE = 'cubic-bezier(.45,.05,.25,1)'; // one speed, every turn
    var wideMQ = window.matchMedia('(min-width:901px)');
    var reduceMQ = window.matchMedia('(prefers-reduced-motion: reduce)');

    var current = location.pathname + location.search;
    var finishNow = null;   // finishes a turn in progress at once
    var ticket = 0;         // ignores results from clicks that were superseded
    var cache = {};         // short-lived prefetch results

    function normPath(p) { return p.length > 1 ? p.replace(/\/+$/, '') : p; }
    function rank(path) {
        var p = normPath(path);
        if (ORDER.hasOwnProperty(p)) return ORDER[p];
        if (/^\/blog\//.test(p)) return 2.5;
        return 0;
    }
    function bookUrl(a) {
        if (!a || a.target && a.target !== '_self' || a.hasAttribute('download')) return null;
        var u;
        try { u = new URL(a.href, location.href); } catch (e) { return null; }
        if (u.origin !== location.origin) return null;
        if (!BOOK_PATH.test(u.pathname)) return null;
        return u;
    }

    /* ---------- fetching ---------- */
    function load(url) {
        var key = url.pathname + url.search;
        var hit = cache[key];
        if (hit && Date.now() - hit.t < 30000) { delete cache[key]; return hit.p; }
        return request(url);
    }
    function request(url) {
        return fetch(url.pathname + url.search, { credentials: 'same-origin', headers: { 'X-Requested-With': 'book' } })
            .then(function (res) {
                var type = res.headers.get('content-type') || '';
                if (!res.ok || type.indexOf('text/html') === -1) throw new Error('not a book page');
                return res.text().then(function (text) { return { text: text, finalUrl: res.url }; });
            })
            .then(function (r) {
                var doc = new DOMParser().parseFromString(r.text, 'text/html');
                var nb = doc.getElementById('book');
                if (!nb || !nb.querySelector('.spread')) throw new Error('no book in page');
                return { doc: doc, book: nb, finalUrl: r.finalUrl };
            });
    }
    function prefetch(e) {
        var a = e.target.closest && e.target.closest('a');
        var u = bookUrl(a);
        if (!u) return;
        var key = u.pathname + u.search;
        if (key === current || cache[key]) return;
        var p = request(u);
        p.catch(function () { delete cache[key]; });
        cache[key] = { t: Date.now(), p: p };
    }

    /* ---------- the flip ---------- */
    function el(cls) { var d = document.createElement('div'); d.className = cls; return d; }
    function ghost(page) {
        var c = page.cloneNode(true);
        c.removeAttribute('id');
        [].forEach.call(c.querySelectorAll('[id]'), function (n) { n.removeAttribute('id'); });
        [].forEach.call(c.querySelectorAll('a,button,input,textarea,select,[tabindex]'), function (n) { n.setAttribute('tabindex', '-1'); });
        return c;
    }
    function canFlip(A, B) {
        return wideMQ.matches && !reduceMQ.matches && A && B && A.animate &&
            A.querySelector('.page.l') && A.querySelector('.page.r') &&
            B.querySelector('.page.l') && B.querySelector('.page.r');
    }
    function flip(A, B, height, rev, done) {
        var st = el('stage noanim');
        st.style.height = height + 'px';
        st.setAttribute('aria-hidden', 'true');
        if ('inert' in st) st.inert = true;
        var leaf = el('leaf' + (rev ? ' rev' : '')), front = el('face'), back = el('face back');
        var f1 = el('fshade'), f2 = el('fshade'), shR = el('sh r'), shL = el('sh l');
        front.appendChild(ghost(A.querySelector(rev ? '.page.l' : '.page.r'))); front.appendChild(f1);
        back.appendChild(ghost(B.querySelector(rev ? '.page.r' : '.page.l')));  back.appendChild(f2);
        leaf.appendChild(front); leaf.appendChild(back);
        st.appendChild(ghost((rev ? B : A).querySelector('.page.l')));
        st.appendChild(ghost((rev ? A : B).querySelector('.page.r')));
        st.appendChild(shR); st.appendChild(shL); st.appendChild(leaf);
        book.classList.add('turning');
        book.insertBefore(st, book.firstChild);

        var opt = { duration: TURN_MS, easing: EASE, fill: 'forwards' };
        var anims = [
            leaf.animate([{ transform: 'rotateY(0deg)' }, { transform: rev ? 'rotateY(180deg)' : 'rotateY(-180deg)' }], opt),
            f1.animate([{ opacity: 0 }, { opacity: .55 }], opt),
            f2.animate([{ opacity: .55 }, { opacity: 0 }], opt),
            shR.animate(rev ? [{ opacity: 0 }, { opacity: 1 }] : [{ opacity: 1 }, { opacity: 0 }], opt),
            shL.animate(rev ? [{ opacity: 1 }, { opacity: 0 }] : [{ opacity: 0 }, { opacity: 1 }], opt)
        ];
        var over = false;
        function finish() {
            if (over) return; over = true; finishNow = null;
            anims.forEach(function (a) { a.cancel(); });
            st.remove();
            book.classList.remove('turning');
            done();
        }
        finishNow = finish;
        anims[0].finished.then(finish, finish);
    }

    /* ---------- swapping the content ---------- */
    function applyPage(result, url, push, silentFocus) {
        var nodes = [].slice.call(document.importNode(result.book, true).children);
        nodes.forEach(function (n) {
            if (n.classList && n.classList.contains('spread')) { n.classList.remove('first'); n.classList.add('noanim'); }
        });
        book.replaceChildren.apply(book, nodes);

        var finalUrl = new URL(result.finalUrl || url.href, location.href);
        var target = finalUrl.pathname + finalUrl.search + (url.hash || finalUrl.hash || '');
        if (push) history.pushState({ book: 1 }, '', target);
        current = finalUrl.pathname + finalUrl.search;

        document.title = result.doc.title || document.title;
        var canon = result.doc.querySelector('link[rel=canonical]'), mine = document.querySelector('link[rel=canonical]');
        if (canon && mine) mine.href = canon.href;
        var desc = result.doc.querySelector('meta[name=description]'), myDesc = document.querySelector('meta[name=description]');
        if (desc && myDesc) myDesc.content = desc.content;

        var path = normPath(finalUrl.pathname);
        [].forEach.call(document.querySelectorAll('#tabs a'), function (a) {
            var p = normPath(new URL(a.href, location.href).pathname);
            var on = p === path || (p === '/blog' && /^\/blog\//.test(path));
            if (on) a.setAttribute('aria-current', 'page'); else a.removeAttribute('aria-current');
        });
        var ret = document.querySelector('#nl-form input[name=return_to]');
        if (ret) ret.value = finalUrl.pathname;

        var hash = url.hash || finalUrl.hash;
        var anchor = hash && document.getElementById(hash.slice(1));
        if (anchor) {
            anchor.scrollIntoView();
            if (!anchor.hasAttribute('tabindex')) anchor.setAttribute('tabindex', '-1');
            anchor.focus({ preventScroll: true });
        } else if (!silentFocus) {
            window.scrollTo(0, 0);
            var h = book.querySelector('h1,h2');
            if (h) { h.setAttribute('tabindex', '-1'); h.focus({ preventScroll: true }); }
        }
    }

    /* ---------- going to a page ---------- */
    function go(url, push) {
        var mine = ++ticket;
        if (finishNow) finishNow();
        var fromRank = rank(current.split('?')[0]), toRank = rank(url.pathname);
        var oldFirst = book.querySelector('.spread');

        load(url).then(function (result) {
            if (mine !== ticket) return;
            var newFirst = result.book.querySelector('.spread');
            var rev = toRank < fromRank;
            window.scrollTo(0, 0);
            if (canFlip(oldFirst, newFirst)) {
                // measure the new spread while it is still hidden, then turn
                var probe = document.importNode(newFirst, true);
                probe.style.cssText = 'position:absolute;visibility:hidden;left:0;right:0;pointer-events:none';
                book.style.position = 'relative';
                book.appendChild(probe);
                var hNew = probe.offsetHeight;
                probe.remove();
                book.style.position = '';
                if (hNew > 0) {
                    flip(oldFirst, newFirst, Math.max(oldFirst.offsetHeight, hNew), rev, function () {
                        if (mine === ticket) applyPage(result, url, push, false);
                    });
                    return;
                }
            }
            applyPage(result, url, push, false);
        }).catch(function () {
            if (mine !== ticket) return;
            location.href = url.href; // do what the link would have done anyway
        });
    }

    /* ---------- wiring ---------- */
    document.addEventListener('click', function (e) {
        if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
        var a = e.target.closest && e.target.closest('a');
        var u = bookUrl(a);
        if (!u) return;
        // same page: let the browser handle it (hash jumps, or a reload)
        if (u.pathname + u.search === current) {
            if (u.hash) return;
            e.preventDefault();
            return;
        }
        e.preventDefault();
        go(u, true);
    });
    document.addEventListener('pointerenter', prefetch, true);
    document.addEventListener('focusin', prefetch);
    document.addEventListener('touchstart', prefetch, { passive: true });

    window.addEventListener('popstate', function () {
        var now = location.pathname + location.search;
        if (now === current) return; // only the #hash changed
        var u = new URL(location.href);
        if (!BOOK_PATH.test(u.pathname)) { location.reload(); return; }
        go(u, false);
    });

    history.replaceState({ book: 1 }, '', location.href);
})();
