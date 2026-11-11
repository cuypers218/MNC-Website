// Little moments of fun on the one-page site.
// 1. The chapters section "writes itself" when it scrolls into view.
// 2. A trail of tiny stars follows the mouse in the hero, chapters and closing band.
//    On phones, a tap there makes a small burst instead.
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
      }, { threshold: 0.35 });
      io.observe(chapters);
    }
  }

  if (reduce) return;

  // 2. Sparkles.
  var colors = ['#FFE6A0', '#F49B8F', '#63D1D2', '#FF9C63', '#BFE8F3', '#B00C60'];
  var zones = document.querySelectorAll('.hero, .chapters, .closing');
  var live = 0, last = 0, lx = 0, ly = 0;

  function spark(x, y, spread) {
    if (live > 40) return;
    var s = document.createElement('span');
    var size = 6 + Math.random() * 9;
    var angle = Math.random() * Math.PI * 2;
    var dist = spread ? 20 + Math.random() * spread : 6 + Math.random() * 14;
    s.className = 'spark';
    s.style.left = x + 'px';
    s.style.top = y + 'px';
    s.style.background = colors[(Math.random() * colors.length) | 0];
    s.style.setProperty('--sz', size.toFixed(1) + 'px');
    s.style.setProperty('--dx', (Math.cos(angle) * dist).toFixed(1) + 'px');
    s.style.setProperty('--dy', (Math.sin(angle) * dist + (spread ? 0 : 16)).toFixed(1) + 'px');
    document.body.appendChild(s);
    live++;
    var gone = false;
    function done() { if (gone) return; gone = true; s.remove(); live--; }
    s.addEventListener('animationend', done);
    setTimeout(done, 1200);
  }

  Array.prototype.forEach.call(zones, function (zone) {
    zone.addEventListener('pointermove', function (e) {
      if (e.pointerType !== 'mouse') return;
      var now = performance.now();
      var moved = Math.abs(e.pageX - lx) + Math.abs(e.pageY - ly);
      if (now - last < 38 || moved < 10) return;
      last = now; lx = e.pageX; ly = e.pageY;
      spark(e.pageX, e.pageY, 0);
    });
    zone.addEventListener('pointerdown', function (e) {
      if (e.pointerType === 'mouse') return;
      for (var i = 0; i < 8; i++) spark(e.pageX, e.pageY, 34);
    });
  });
})();
