// Little moments of fun on the one-page site.
// 1. The chapters section "writes itself" when it scrolls into view.
// 2. A trail of tiny stars follows the mouse anywhere on the page.
//    On phones, a tap makes a small burst instead.
// Everything is skipped for people who ask their device for less motion.
(function () {
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // 1. Reveal the highlighter and the handwritten note.
  var chapters = document.querySelector('.chapters');
  if (chapters) {
    if (reduce || !('IntersectionObserver' in window)) {
      chapters.classList.add('in');
    } else {
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
          if (e.isIntersecting) { chapters.classList.add('in'); io.disconnect(); }
        });
      }, { threshold: 0, rootMargin: '0px 0px -20% 0px' }); // fires on short screens and when zoomed in too
      io.observe(chapters);
    }
  }

  // 1b. The Hub peek: the phone rises, three ideas write themselves, then a little burst of glitter.
  var peek = document.querySelector('.peek');
  var burstAt = null, writeIdeas = null;
  if (peek) {
    if (reduce || !('IntersectionObserver' in window)) {
      peek.classList.add('in');
    } else {
      var po = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
          if (e.isIntersecting) {
            peek.classList.add('in'); po.disconnect();
            setTimeout(function () { if (writeIdeas) writeIdeas(); }, 1100);
          }
        });
      }, { threshold: 0, rootMargin: '0px 0px -30% 0px' });
      po.observe(peek);
    }
  }

  if (reduce) return;

  // 2. Sparkles.
  // 'gold' draws metallic, glinting gold (see .spark.gold in fresh.css)
  var colors = ['#63D1D2', '#F49B8F', '#FFB0A5', '#8DDEDF', '#B00C60', '#F49B8F', '#63D1D2', 'gold', 'gold'];
  var live = 0, last = 0, lx = 0, ly = 0;

  function spark(x, y, spread, palette, big, fleck, life) {
    if (live > 90) return;
    var s = document.createElement('span');
    var size = fleck ? 3 + Math.random() * 5 : big ? 9 + Math.random() * 14 : 6 + Math.random() * 9;
    var angle = Math.random() * Math.PI * 2;
    var dist = spread ? 20 + Math.random() * spread : 6 + Math.random() * 14;
    s.className = fleck ? 'spark fleck' : 'spark';
    s.style.left = x + 'px';
    s.style.top = y + 'px';
    var pal = palette || colors;
    var c = pal[(Math.random() * pal.length) | 0];
    if (c === 'gold') s.className += ' gold'; else s.style.background = c;
    if (life) { s.style.setProperty('--life', life + 's'); s.style.animationDuration = s.className.indexOf('gold') > -1 ? '' : life + 's'; }
    s.style.setProperty('--sz', size.toFixed(1) + 'px');
    s.style.setProperty('--dx', (Math.cos(angle) * dist).toFixed(1) + 'px');
    s.style.setProperty('--dy', (Math.sin(angle) * dist + (spread ? 0 : 16)).toFixed(1) + 'px');
    document.body.appendChild(s);
    live++;
    var gone = false;
    function done() { if (gone) return; gone = true; s.remove(); live--; }
    s.addEventListener('animationend', done);
    setTimeout(done, (life || 0.9) * 1000 + 400);
  }

  // The glitter burst rises from the last idea written on the phone.
  burstAt = function (x, y) {
    var gold = ['gold'];
    var mix = ['gold', 'gold', 'gold', '#F49B8F', '#63D1D2', '#B00C60'];
    for (var i = 0; i < 50; i++) {
      (function (d, k) {
        setTimeout(function () {
          if (k < 34) spark(x, y, 240, gold, false, true, 1.4 + Math.random() * 0.6);   // tiny gold flecks
          else spark(x, y, 260, mix, true, false, 1.3 + Math.random() * 0.4);        // a few bigger stars
        }, d);
      })(i * 12, i);
    }
  };

  // Her teal pen glides along each line as the words appear, then lifts away and the glitter bursts.
  writeIdeas = function () {
    var pen = document.querySelector('.pw-pen');
    var lines = document.querySelectorAll('.pw');
    if (!lines.length || !lines[0].animate) { Array.prototype.forEach.call(lines, function (l) { l.style.clipPath = 'none'; }); return; }
    var i = 0, move = null;
    function place(x, y) { if (!pen) return; if (move) move.cancel(); pen.style.left = x + 'px'; pen.style.top = y + 'px'; }
    function next() {
      if (i >= lines.length) {
        var r = lines[lines.length - 1].getBoundingClientRect();
        var tipX = r.right + window.scrollX - 4, tipY = r.top + r.height * 0.6 + window.scrollY;
        if (pen) pen.animate([{ opacity: 1, translate: '0 0' }, { opacity: 0, translate: '18px -26px' }], { duration: 650, easing: 'ease-in', fill: 'forwards' });
        burstAt(tipX, tipY);
        return;
      }
      var line = lines[i];
      var x0 = line.offsetLeft, y = line.offsetTop - line.offsetHeight * 0.18, w = line.offsetWidth;
      place(x0, y);
      if (i === 0 && pen) { pen.style.opacity = '1'; pen.animate([{ opacity: 0 }, { opacity: 1 }], { duration: 300 }); }
      var dur = 380 + w * 4.2;
      if (pen) move = pen.animate([{ left: x0 + 'px', top: y + 'px' }, { left: (x0 + w) + 'px', top: y + 'px' }], { duration: dur, easing: 'linear', fill: 'forwards' });
      line.animate([{ clipPath: 'inset(-40% 100% -40% 0)' }, { clipPath: 'inset(-40% -6% -40% 0)' }], { duration: dur, easing: 'linear', fill: 'forwards' });
      i++;
      setTimeout(next, dur + 260);
    }
    next();
  };

  // Gold sparkles pop off the Join buttons when she hovers (or taps on a phone).
  Array.prototype.forEach.call(document.querySelectorAll('a.btn'), function (btn) {
    var lastPop = 0;
    function pop() {
      var now = Date.now();
      if (now - lastPop < 700) return;
      lastPop = now;
      var r = btn.getBoundingClientRect();
      for (var i = 0; i < 12; i++) {
        var x = r.left + window.scrollX + Math.random() * r.width;
        var y = r.top + window.scrollY + (i % 2 ? r.height - 2 : 2);
        spark(x, y, 38, ['gold', 'gold', 'gold', '#F49B8F'], false, i % 3 !== 0, 0.9);
      }
    }
    btn.addEventListener('pointerenter', function (e) { if (e.pointerType === 'mouse') pop(); });
    btn.addEventListener('pointerdown', pop);
  });

  document.addEventListener('pointermove', function (e) {
    if (e.pointerType !== 'mouse') return;
    var now = performance.now();
    var moved = Math.abs(e.pageX - lx) + Math.abs(e.pageY - ly);
    if (now - last < 38 || moved < 10) return;
    last = now; lx = e.pageX; ly = e.pageY;
    spark(e.pageX, e.pageY, 0);
  });
  document.addEventListener('pointerdown', function (e) {
    if (e.pointerType === 'mouse') return;
    for (var i = 0; i < 8; i++) spark(e.pageX, e.pageY, 34);
  });
})();
