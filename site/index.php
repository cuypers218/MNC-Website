<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solo Mom. Empty Nest. Now What? | My Nest Chapter</title>
    <meta name="description" content="Tools and resources built from lived experience, for single and solo moms navigating the empty nest transition.">
    
    <link rel="canonical" href="https://mynestchapter.com/">
    <!-- Open Graph -->
    <meta property="og:site_name" content="My Nest Chapter">
    <meta property="og:title" content="Solo Mom. Empty Nest. Now What? | My Nest Chapter">
    <meta property="og:description" content="Tools and resources built from lived experience, for single and solo moms navigating the empty nest transition.">
    <meta property="og:url" content="https://mynestchapter.com/">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://mynestchapter.com/assets/images/logo.png">
    <meta property="og:see_also" content="https://www.facebook.com/profile.php?id=61590806030391">
    <meta property="og:see_also" content="https://www.instagram.com/my.nest.chapter/">
    <meta property="og:see_also" content="https://www.pinterest.com/mynestchapter">
    <!-- Twitter / X Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Solo Mom. Empty Nest. Now What? | My Nest Chapter">
    <meta name="twitter:description" content="Tools and resources built from lived experience, for single and solo moms navigating the empty nest transition.">
    <meta name="twitter:image" content="https://mynestchapter.com/assets/images/logo.png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;800&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<a href="#main-content" class="skip-link">Skip to main content</a>

<header class="site-header">
    <div class="header-inner">
        <a href="/" class="brand-mark">My Nest Chapter</a>
        
        <!-- Desktop Nav -->
        <nav class="main-nav" aria-label="Main navigation">
            <a href="/" class="active">Home</a>
            <a href="/about" class="">About</a>
            <a href="/blog" class="">Blog</a>
            <a href="/shop" class="">Shop</a>
            <a href="/resources" class="">Resources</a>
            <a href="/freebies" class="">Freebies</a>
        </nav>
        
        <!-- Auth Link -->
        <div class="nav-auth">
                            <a href="/login">Log In</a>
                    </div>
        
        <!-- Mobile Toggle -->
        <button class="mobile-toggle" aria-label="Open menu" onclick="openMobileNav()">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

<!-- Mobile Nav Overlay -->
<div class="mobile-overlay" id="mobileOverlay" onclick="closeMobileNav()"></div>

<!-- Mobile Nav Panel -->
<nav class="mobile-nav" id="mobileNav" aria-label="Mobile navigation">
    <button class="mobile-close" aria-label="Close menu" onclick="closeMobileNav()">&#x2715;</button>
    <a href="/" class="active">Home</a>
    <a href="/about" class="">About</a>
    <a href="/blog" class="">Blog</a>
    <a href="/shop" class="">Shop</a>
    <a href="/resources" class="">Resources</a>
    <a href="/freebies" class="">Freebies</a>
            <a href="/login">Log In</a>
        <a href="/register">Create Account</a>
    </nav>

<main id="main-content" tabindex="-1">

<!-- HERO -->
<section class="hero">
    <div class="container">
        <h1 class="hero-tagline">Solo mom. Empty nest.<br>Now what?</h1>
        <p class="hero-subtitle">Start with 6pm. That hour when the house feels wrong and you're just standing in the kitchen not knowing what to do with yourself.</p>
        <a href="/6pm-experience/" onclick="event.preventDefault();open6pmExperience();" class="btn btn-primary btn-hero">GET THE FREE 6PM CHEAT SHEET →</a>
        <p class="hero-cta-hint">No sign-up needed</p>
    </div>
</section>

<!-- QUIZ MODAL -->
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
        .mnc-wrap{width:100%;max-width:620px;margin:0 auto;}
        .mnc-card{background:#FFF8EE;border-radius:0;border:1px solid #DDD6F0;box-shadow:none;overflow:hidden;width:100%;box-sizing:border-box;}
        .mnc-card-bar{height:4px;background:#E87AAA;}
        .mnc-card-inner{padding:36px 32px 40px;box-sizing:border-box;}
        .mnc-cover{text-align:center;}
        .mnc-cover-tag{display:inline-block;background:#EEE8F8;border:1px solid rgba(232,122,170,0.2);border-radius:9999px;padding:4px 16px;font-family:'DM Sans',sans-serif;font-weight:600;font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:#E87AAA;margin-bottom:20px;}
        .mnc-cover-title{font-family:'Lora',Georgia,serif;font-weight:600;font-size:clamp(1.5rem,1.2rem + 1.25vw,2rem);color:#252535;line-height:1.2;margin-bottom:16px;}
        .mnc-cover-desc{font-family:'DM Sans',sans-serif;font-size:clamp(0.9rem,0.8rem + 0.3vw,1rem);color:#5A5A72;line-height:1.7;margin-bottom:8px;max-width:460px;margin-left:auto;margin-right:auto;}
        .mnc-cover-note{font-family:'DM Sans',sans-serif;font-size:13px;color:#8B8BA8;font-style:italic;margin-bottom:28px;}
        .mnc-cover-divider{height:1px;background:#DDD6F0;margin:0 auto 28px;width:80%;}
        .mnc-btn-start{font-family:'DM Sans',sans-serif;font-weight:500;font-size:15px;background:#E87AAA;color:#fff;border:none;border-radius:9999px;padding:14px 44px;cursor:pointer;transition:background 180ms cubic-bezier(0.16,1,0.3,1);box-shadow:none;}
        .mnc-btn-start:hover{background:#C45588;box-shadow:none;}
        .mnc-cover-footer{margin-top:22px;font-family:'DM Sans',sans-serif;font-weight:500;font-size:11px;letter-spacing:.08em;text-transform:uppercase;color:#8B8BA8;}
        .mnc-progress-label{font-family:'DM Sans',sans-serif;font-weight:600;font-size:11px;letter-spacing:.08em;text-transform:uppercase;color:#8B8BA8;margin-bottom:8px;}
        .mnc-progress-bg{background:#DDD6F0;border-radius:9999px;height:4px;overflow:hidden;margin-bottom:28px;}
        .mnc-progress-fill{background:#E87AAA;height:100%;border-radius:9999px;transition:width 0.4s cubic-bezier(0.16,1,0.3,1);}
        .mnc-question{font-family:'Lora',Georgia,serif;font-weight:600;font-size:clamp(1rem,0.9rem + 0.5vw,1.2rem);color:#252535;line-height:1.4;margin-bottom:20px;}
        .mnc-options{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:8px;}
        .mnc-option{width:100%;text-align:left;background:#FFF8EE;border:1.5px solid #DDD6F0;border-radius:0;padding:13px 16px;font-family:'DM Sans',sans-serif;font-size:15px;color:#5A5A72;cursor:pointer;transition:background 180ms cubic-bezier(0.16,1,0.3,1),border-color 180ms cubic-bezier(0.16,1,0.3,1),color 180ms cubic-bezier(0.16,1,0.3,1);line-height:1.5;box-sizing:border-box;}
        .mnc-option:hover{background:#EEE8F8;border-color:#E87AAA;color:#252535;}
        .mnc-option.selected{background:#EEE8F8;border-color:#E87AAA;color:#252535;font-weight:500;}
        .mnc-nav{display:flex;justify-content:space-between;align-items:center;margin-top:24px;}
        .mnc-btn-back{font-family:'DM Sans',sans-serif;font-weight:500;font-size:13px;color:#8B8BA8;background:none;border:none;cursor:pointer;transition:color 180ms;padding:8px 0;}
        .mnc-btn-back:hover{color:#252535;}
        .mnc-btn-next{font-family:'DM Sans',sans-serif;font-weight:500;font-size:14px;background:#E87AAA;color:#fff;border:none;border-radius:9999px;padding:12px 28px;cursor:pointer;transition:background 180ms cubic-bezier(0.16,1,0.3,1);margin-left:auto;}
        .mnc-btn-next:hover{background:#C45588;box-shadow:none;}
        .mnc-btn-next:disabled{opacity:0.35;cursor:not-allowed;box-shadow:none;}
        .mnc-email h2{font-family:'Lora',Georgia,serif;font-weight:600;font-size:clamp(1.1rem,0.9rem + 0.5vw,1.35rem);color:#252535;margin-bottom:10px;line-height:1.3;}
        .mnc-email p{font-family:'DM Sans',sans-serif;font-size:15px;color:#5A5A72;line-height:1.7;margin-bottom:22px;}
        .mnc-form-group{margin-bottom:14px;}
        .mnc-form-group label{font-family:'DM Sans',sans-serif;font-weight:600;font-size:11px;letter-spacing:.08em;text-transform:uppercase;color:#8B8BA8;display:block;margin-bottom:6px;}
        .mnc-form-group input{width:100%;padding:12px 14px;border:1.5px solid #C4B0E8;border-radius:0;font-family:'DM Sans',sans-serif;font-size:15px;color:#252535;background:#FFF8EE;outline:none;transition:border-color 180ms;box-sizing:border-box;}
        .mnc-form-group input:focus{border-color:#E87AAA;background:#fff;}
        .mnc-btn-submit{width:100%;font-family:'DM Sans',sans-serif;font-weight:500;font-size:15px;background:#E87AAA;color:#fff;border:none;border-radius:9999px;padding:14px;cursor:pointer;margin-top:4px;transition:background 180ms cubic-bezier(0.16,1,0.3,1);}
        .mnc-btn-submit:hover{background:#C45588;box-shadow:none;}
        .mnc-privacy{font-family:'DM Sans',sans-serif;font-size:12px;color:#8B8BA8;text-align:center;margin-top:10px;font-style:italic;}
        .mnc-result-badge{display:inline-block;background:#EEE8F8;border:1px solid rgba(232,122,170,0.2);border-radius:9999px;padding:4px 16px;font-family:'DM Sans',sans-serif;font-weight:600;font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:#E87AAA;margin-bottom:14px;}
        .mnc-result-title{font-family:'Lora',Georgia,serif;font-weight:600;font-size:clamp(1.1rem,0.9rem + 0.5vw,1.5rem);color:#252535;line-height:1.25;margin-bottom:14px;}
        .mnc-result-msg{font-family:'DM Sans',sans-serif;font-size:15px;line-height:1.7;color:#5A5A72;margin-bottom:22px;}
        .mnc-result-divider{height:1px;background:#DDD6F0;border-radius:9999px;margin-bottom:20px;}
        .mnc-freebie-box{background:#EEE8F8;border:1px solid rgba(232,122,170,0.2);border-radius:0;padding:16px 20px;margin-bottom:18px;}
        .mnc-freebie-box h3{font-family:'DM Sans',sans-serif;font-weight:600;font-size:11px;color:#E87AAA;letter-spacing:.08em;text-transform:uppercase;margin-bottom:6px;}
        .mnc-freebie-box p{font-family:'DM Sans',sans-serif;font-size:14px;color:#5A5A72;line-height:1.6;margin:0;}
        .mnc-cta-note{font-family:'DM Sans',sans-serif;font-size:14px;color:#8B8BA8;text-align:center;margin-bottom:14px;font-style:italic;}
        .mnc-result-btns{display:flex;flex-direction:column;gap:10px;width:100%;}
        .mnc-btn-workbook{display:block;width:100%;box-sizing:border-box;font-family:'DM Sans',sans-serif;font-weight:500;font-size:15px;background:#E87AAA;color:#fff;border:none;border-radius:9999px;padding:15px;cursor:pointer;text-align:center;text-decoration:none;transition:background 180ms cubic-bezier(0.16,1,0.3,1);}
        .mnc-btn-workbook:hover{background:#C45588;box-shadow:none;}
        .mnc-btn-browse{display:block;width:100%;box-sizing:border-box;font-family:'DM Sans',sans-serif;font-weight:500;font-size:14px;background:#FFF8EE;color:#5A5A72;border:1.5px solid #DDD6F0;border-radius:9999px;padding:14px;cursor:pointer;text-align:center;text-decoration:none;transition:background 180ms,border-color 180ms;}
        .mnc-btn-browse:hover{background:#EEE8F8;border-color:#E87AAA;}
        .mnc-fade{animation:mncFadeIn 0.35s cubic-bezier(0.16,1,0.3,1);}
        @keyframes mncFadeIn{from{opacity:0;transform:translateY(10px);}to{opacity:1;transform:translateY(0);}}
        @media(max-width:480px){.mnc-card-inner{padding:24px 18px 28px;}.mnc-cover-title{font-size:1.4rem;}.mnc-question{font-size:1rem;}.mnc-btn-next{padding:12px 20px;}}
        .mnc-modal-overlay{position:fixed;inset:0;background:rgba(37,37,53,0.5);z-index:9998;animation:mncFadeIn 0.25s ease;}
        .mnc-modal-wrap{position:fixed;inset:0;z-index:9999;display:flex;align-items:center;justify-content:center;padding:20px;box-sizing:border-box;pointer-events:none;}
        .mnc-modal-card{pointer-events:all;width:100%;max-width:620px;max-height:90vh;overflow-y:auto;position:relative;animation:mncSlideUp 0.35s cubic-bezier(0.16,1,0.3,1);}
        @keyframes mncSlideUp{from{opacity:0;transform:translateY(24px);}to{opacity:1;transform:translateY(0);}}
        .mnc-modal-close{position:absolute;top:14px;right:16px;font-size:18px;line-height:1;background:none;border:none;color:#8B8BA8;cursor:pointer;z-index:10;padding:4px 8px;transition:color 180ms;font-family:'DM Sans',sans-serif;}
        .mnc-modal-close:hover{color:#252535;}
        </style>

<div id="mnc-modal" style="display:none;">
  <div class="mnc-modal-overlay" onclick="mncCloseModal()"></div>
  <div class="mnc-modal-wrap">
    <div class="mnc-modal-card">
      <button class="mnc-modal-close" onclick="mncCloseModal()" aria-label="Close">&#x2715;</button>
      <div class="mnc-wrap">
          <div class="mnc-card">
            <div class="mnc-card-bar"></div>
            <div class="mnc-card-inner">

              <div id="mnc-cover" class="mnc-cover">
                <div class="mnc-cover-tag">Free Quiz</div>
                <h2 class="mnc-cover-title">How Quiet Is Your House?</h2>
                <p class="mnc-cover-desc">Five questions. Two minutes.</p>
                <p class="mnc-cover-note">I'll send you what got me through 6pm.</p>
                <div class="mnc-cover-divider"></div>
                <button class="mnc-btn-start" onclick="mncStart()">Take The Quiz</button>
                <p class="mnc-cover-footer">My Nest Chapter · For Solo Moms</p>
              </div>

              <div id="mnc-questions" style="display:none;">
                <div class="mnc-progress-label" id="mnc-prog-label">Question 1 of 5</div>
                <div class="mnc-progress-bg">
                  <div class="mnc-progress-fill" id="mnc-prog-fill" style="width:20%"></div>
                </div>
                <div id="mnc-q-container" class="mnc-fade"></div>
                <div class="mnc-nav">
                  <button class="mnc-btn-back" id="mnc-btn-back" onclick="mncBack()" style="visibility:hidden">← Back</button>
                  <button class="mnc-btn-next" id="mnc-btn-next" onclick="mncNext()" disabled>Next →</button>
                </div>
              </div>

              <div id="mnc-email" style="display:none;" class="mnc-email">
                <h2>You're almost there.</h2>
                <p>Enter your first name and email and I'll send you your results.</p>
                <div class="mnc-form-group">
                  <label>First Name</label>
                  <input type="text" id="mnc-name" placeholder="Your first name" />
                </div>
                <div class="mnc-form-group">
                  <label>Email Address</label>
                  <input type="email" id="mnc-email-input" placeholder="your@email.com" />
                </div>
                <button class="mnc-btn-submit" onclick="mncSubmit()">Send My Results →</button>
                <p class="mnc-privacy">No spam. Ever. Just real support for where you are right now.</p>
              </div>

              <div id="mnc-result" style="display:none;">
                <div class="mnc-result-badge">Your Result</div>
                <h2 class="mnc-result-title" id="mnc-result-title"></h2>
                <p class="mnc-result-msg" id="mnc-result-msg"></p>
                <div class="mnc-result-divider"></div>
                <div class="mnc-freebie-box">
                  <h3>Check Your Inbox</h3>
                  <p>Your free guide — <strong>Where Do I Start? Your Next 3 Steps</strong> — is on its way to you right now.</p>
                </div>
                <p class="mnc-cta-note">Ready to go deeper? This is where most women start.</p>
                <div class="mnc-result-btns">
                  <a href="https://mynestchapter.com" class="mnc-btn-workbook">Get Workbook 1 →</a>
                  <a href="https://mynestchapter.com" class="mnc-btn-browse">Browse Everything at My Nest Chapter</a>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
window.mncOpenModal = function() {
  document.getElementById('mnc-modal').style.display = 'block';
  document.body.style.overflow = 'hidden';
};
window.mncCloseModal = function() {
  document.getElementById('mnc-modal').style.display = 'none';
  document.body.style.overflow = '';
};
(function() {
          var questions = [
            {
              text: "How long ago did your last kid leave home?",
              options: [
                "Just happened — I'm still in shock",
                "A few months ago — still figuring it out",
                "6 months to a year — thought it would get easier by now",
                "More than a year ago — still not where I want to be"
              ]
            },
            {
              text: "How would you describe most of your days right now?",
              options: [
                "Lost — I don't really know who I am without them",
                "Numb — going through the motions but feeling empty",
                "Angry — I gave everything and now what",
                "Scared — I don't know what comes next",
                "Ready — I want to move forward but don't know how"
              ]
            },
            {
              text: "What's the hardest part right now?",
              options: [
                "The silence — the house feels wrong without them",
                "I don't recognize myself anymore",
                "I have no idea what I actually want",
                "I'm still carrying guilt about things I can't change",
                "Every day feels pointless without a reason to get up"
              ]
            },
            {
              text: "What have you tried so far?",
              options: [
                "Nothing yet — I just found this",
                "Staying busy but it's not helping",
                "Talking to people but still feel stuck",
                "I've been researching but haven't done anything yet",
                "I've started working on myself but need more"
              ]
            },
            {
              text: "What do you need most right now?",
              options: [
                "To just feel less alone",
                "To understand why this hurts as much as it does",
                "To figure out who I am now that they're gone",
                "Something concrete to do — a real place to start",
                "To figure out what I actually want my life to look like now"
              ]
            }
          ];

          var results = [
            {
              title: "You Just Need to Breathe",
              trigger: function(a) { return a[0] === 0 && (a[1] === 0 || a[1] === 1) && a[3] === 0; },
              message: "You're in the thick of this right now and that's okay. You don't need to have everything figured out yet. You don't need to be okay. The first step is just understanding what you're actually feeling — and that's exactly what Workbook 1 is for. Start right where you are."
            },
            {
              title: "You're Carrying More Than You Realize",
              trigger: function(a) { return a[1] === 2 || a[2] === 3; },
              message: "You gave everything for years — mostly alone. The anger makes sense. The exhaustion makes sense. Before you can figure out what's next, it helps to see everything you've actually been carrying. That's where this starts. Not with goals. With the truth of what you've handled."
            },
            {
              title: "You've Lost Yourself and You Know It",
              trigger: function(a) { return a[2] === 1 || a[2] === 2 || a[4] === 2; },
              message: "You're not broken. You spent years being everything to everyone else — and there was no time left to figure out who you were outside of Mom. Now the kids are gone and the question is right there. There's a place to start."
            },
            {
              title: "You're Ready to Move But Need Direction",
              trigger: function(a) { return a[1] === 4 || a[4] === 3; },
              message: "You're past the worst of this and you're ready to actually do something. You don't need more thinking — you need a structured place to work it out. Workbook 1 gives you exactly that. Start at Section 3 if the early stuff feels like old ground."
            },
            {
              title: "The Loneliness Is the Hardest Part",
              trigger: function(a) { return a[2] === 0 || a[4] === 0; },
              message: "The quiet hits different when you did this solo. There was no one to share the hard parts with when the kids were home — and there's no one to share this part with either. You're not alone in feeling alone. That's what My Nest Chapter is here for."
            },
            {
              title: "You Know What You Want — Now Build It",
              trigger: function(a) { return a[0] === 3 && a[1] === 4 && a[4] === 4; },
              message: "You've done some of the work already. You've sat with this, you've thought about this, and now you're ready to actually build the life you want — not just survive the transition. Start with Workbook 1 Section 4 and go from there."
            }
          ];

          var answers = [null, null, null, null, null];
          var currentQ = 0;

          window.mncStart = function() {
            document.getElementById('mnc-cover').style.display = 'none';
            document.getElementById('mnc-questions').style.display = 'block';
            mncRender();
          };

          function mncRender() {
            var q = questions[currentQ];
            var saved = answers[currentQ];
            document.getElementById('mnc-prog-label').textContent = 'Question ' + (currentQ + 1) + ' of ' + questions.length;
            document.getElementById('mnc-prog-fill').style.width = (((currentQ + 1) / questions.length) * 100) + '%';
            document.getElementById('mnc-btn-back').style.visibility = currentQ === 0 ? 'hidden' : 'visible';
            document.getElementById('mnc-btn-next').disabled = saved === null;
            document.getElementById('mnc-btn-next').textContent = currentQ === questions.length - 1 ? 'See My Results →' : 'Next →';

            var html = '<p class="mnc-question">' + q.text + '</p><ul class="mnc-options">';
            q.options.forEach(function(opt, i) {
              var sel = saved === i ? 'selected' : '';
              html += '<li><button class="mnc-option ' + sel + '" onclick="mncPick(' + i + ')">' + opt + '</button></li>';
            });
            html += '</ul>';

            var container = document.getElementById('mnc-q-container');
            container.innerHTML = html;
            container.className = 'mnc-fade';
            void container.offsetWidth;
            container.className = 'mnc-fade';
          }

          window.mncPick = function(idx) {
            answers[currentQ] = idx;
            document.querySelectorAll('.mnc-option').forEach(function(btn, i) {
              btn.classList.toggle('selected', i === idx);
            });
            document.getElementById('mnc-btn-next').disabled = false;
          };

          window.mncNext = function() {
            if (answers[currentQ] === null) return;
            if (currentQ < questions.length - 1) {
              currentQ++;
              mncRender();
            } else {
              document.getElementById('mnc-questions').style.display = 'none';
              var el = document.getElementById('mnc-email');
              el.style.display = 'block';
              el.className = 'mnc-email mnc-fade';
            }
          };

          window.mncBack = function() {
            if (currentQ > 0) { currentQ--; mncRender(); }
          };

          window.mncSubmit = function() {
            var name = document.getElementById('mnc-name').value.trim();
            var email = document.getElementById('mnc-email-input').value.trim();
            if (!name) { alert('Please enter your first name.'); return; }
            if (!email || email.indexOf('@') < 0) { alert('Please enter a valid email address.'); return; }

            var result = null;
            for (var i = 0; i < results.length; i++) {
              if (results[i].trigger(answers)) { result = results[i]; break; }
            }
            if (!result) result = results[2];

            var btn = document.querySelector('.mnc-btn-submit');
            btn.textContent = 'Sending...';
            btn.disabled = true;

            fetch('/api/quiz.php', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({ name: name, email: email, result: result.title })
            })
            .then(function() { showResult(result); })
            .catch(function() { showResult(result); });
          };

          function showResult(r) {
            document.getElementById('mnc-email').style.display = 'none';
            var rs = document.getElementById('mnc-result');
            rs.style.display = 'block';
            rs.className = 'mnc-fade';
            document.getElementById('mnc-result-title').textContent = r.title;
            document.getElementById('mnc-result-msg').textContent = r.message;
          }
        })();
</script>

<!-- I'M CECE SECTION -->
<section class="cece-section">
  <div class="cece-inner">

    <div class="cece-photo-col">
      <img
        src="/images/cece-photo.jpg"
        alt="Cece, founder of My Nest Chapter"
        class="cece-photo"
      >
    </div>

    <div class="cece-text-col">
      <p class="cece-hook">Hey. I see you. I get you. I am you. Stay a minute.</p>
      <p class="cece-eyebrow">I'M CECE</p>
      <h2 class="cece-heading">I raised my kids mostly on my own. When my last one left, I wasn't ready for what hit me.</h2>
      <p class="cece-body">I went looking for something — anything — that sounded like my life, and it didn't exist. So I created My Nest Chapter.</p>
      <p class="cece-body">I built every product here myself, because I needed it and it wasn't out there. Your people are here. I'm here. I'm only an email, a Zoom call, or a message away.</p>
      <p class="cece-body">And since I built all of this by hand, alone — there will be glitches. There will be mistakes. Tell me when you find one. I want to do better.</p>
      <a href="/contact" class="cece-btn">Get in touch &rarr;</a>
      <a href="/booking" class="cece-btn" style="background:#C4B0E8; color:#252535;">Book a time &rarr;</a>
      <p class="cece-connect-note">Video call &nbsp;&middot;&nbsp; Voice call &nbsp;&middot;&nbsp; Text chat &nbsp;&middot;&nbsp; Email &mdash; whatever feels right.</p>
      <a href="/about" class="cece-link">Read my full story &rarr;</a>
    </div>

  </div>
</section>

<style>
  .cece-section {
    background-color: #252535;
    padding: 0;
  }

  .cece-inner {
    max-width: 960px;
    margin: 0 auto;
    display: flex;
    align-items: stretch;
  }

  .cece-photo-col {
    flex: 0 0 340px;
    overflow: hidden;
  }

  .cece-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center 15%;
    display: block;
    min-height: 280px;
  }

  .cece-text-col {
    flex: 1;
    padding: 52px 48px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .cece-hook {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 13px;
    letter-spacing: 0.3px;
    color: #E87AAA;
    line-height: 1.5;
    margin: 0 0 18px;
  }

  .cece-eyebrow {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 11px;
    letter-spacing: 2px;
    color: #E87AAA;
    text-transform: uppercase;
    margin: 0 0 14px;
  }

  .cece-heading {
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 22px;
    color: #FFF8EE;
    line-height: 1.35;
    margin: 0 0 16px;
    max-width: 520px;
  }

  .cece-body {
    font-family: 'DM Sans', 'Helvetica Neue', Arial, sans-serif;
    font-size: 15px;
    color: rgba(255, 248, 238, 0.78);
    line-height: 1.7;
    margin: 0 0 22px;
    max-width: 480px;
  }

  .cece-btn {
    display: inline-block;
    background: #E87AAA;
    color: #fff;
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 12px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    padding: 13px 26px;
    border-radius: 9999px;
    text-decoration: none;
    margin: 4px 14px 0 0;
    transition: background 0.2s ease;
  }

  .cece-btn:hover {
    background: #d9608f;
  }

  .cece-connect-note {
    font-family: Arial, sans-serif;
    font-size: 12px;
    color: rgba(255, 248, 238, 0.55);
    margin: 10px 0 4px;
    letter-spacing: 0.2px;
  }

  .cece-link {
    display: inline-block;
    color: #FFF8EE;
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 800;
    font-size: 12px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    text-decoration: underline;
    margin-top: 4px;
  }

  @media (max-width: 600px) {
    .cece-inner {
      flex-direction: column;
    }

    .cece-photo-col {
      flex: none;
      width: 100%;
      height: 220px;
    }

    .cece-photo {
      min-height: 220px;
      object-position: center 20%;
    }

    .cece-text-col {
      padding: 36px 24px;
    }

    .cece-heading {
      font-size: 19px;
    }

    .cece-btn, .cece-link {
      display: block;
      margin: 8px 0 0;
    }
  }
</style>

<!-- LATEST FROM THE BLOG -->

<!-- FEATURED PRODUCTS -->
<section class="section">
    <div class="container">
        <h2 class="text-center" style="margin-bottom: 0.5rem;">Each one helped me. Still does.<br>Maybe they can help you too.</h2>
        <p class="text-center" style="color: #666666; font-size: 0.9rem; margin-bottom: 2rem;">Some are free. Some aren't. All of them came from something real.</p>

        <div class="product-grid">

            <!-- Now What? Workbook -->
            <div class="product-card fade-in">
                <span class="badge">$14.99</span>
                <div class="product-card-content">
                    <span class="product-card-category">Workbook</span>
                    <h3 class="product-card-title">Now What? A Workbook for Solo Moms in the Empty Nest</h3>
                    <p class="product-card-description">The workbook I made because nothing out there sounded like me. Activities, reflections, and honest space for solo moms figuring out what comes next.</p>
                    <a href="/shop/now-what-workbook" class="btn btn-primary">Get the Now What?</a>
                </div>
            </div>

            <!-- Garage Sale Planner — highlighted as interactive app -->
            <div class="product-card fade-in" style="border: 2px solid #E87AAA;">
                <span class="badge">$27</span>
                <div class="product-card-content">
                    <span class="product-card-category" style="color: #E87AAA;">Interactive App</span>
                    <h3 class="product-card-title">The Garage Sale Planner</h3>
                    <p class="product-card-description">Not a PDF — a live app that runs in your browser. Price your items, track every sale, and hit your money goal. Try it free before you buy.</p>
                    <a href="/shop/garage-sale-planner" class="btn btn-primary">Open the Planner</a>
                </div>
            </div>

            <!-- Someday List Builder -->
            <div class="product-card fade-in">
                <span class="badge badge-free">FREE</span>
                <div class="product-card-content">
                    <span class="product-card-category">Free Tool</span>
                    <h3 class="product-card-title">The Someday List Builder</h3>
                    <p class="product-card-description">All those things you said you'd do someday? This is where you finally write them down.</p>
                    <a href="/freebies" class="btn btn-outline">Get This Free</a>
                </div>
            </div>

        </div>

        <div class="text-center" style="margin-top: 2rem;">
            <a href="/shop" class="btn btn-outline">See Everything</a>
        </div>
    </div>
</section>

<!-- ACCOUNT + NEWSLETTER -->
<style>
  .account-newsletter-section {
    background-color: #f0eee8;
    padding: 72px 24px;
  }
  .an-inner {
    max-width: 680px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0;
  }
  .an-account-block {
    background: #252535;
    border-radius: 0;
    padding: 48px 40px;
    text-align: center;
    width: 100%;
    box-sizing: border-box;
  }
  .an-eyebrow {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 11px;
    letter-spacing: 2px;
    color: #C4B0E8;
    margin: 0 0 16px;
    text-transform: uppercase;
  }
  .an-heading {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 22px;
    color: #FFF8EE;
    line-height: 1.35;
    margin: 0 0 16px;
  }
  .an-body {
    font-family: 'DM Sans', 'Helvetica Neue', sans-serif;
    font-size: 15px;
    color: rgba(255, 248, 238, 0.78);
    line-height: 1.65;
    margin: 0 0 28px;
  }
  .an-btn-primary {
    display: inline-block;
    background: #E87AAA;
    color: #fff;
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 13px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    padding: 15px 32px;
    border-radius: 9999px;
    text-decoration: none;
    transition: background 0.2s ease, transform 0.15s ease;
  }
  .an-btn-primary:hover {
    background: #d9608f;
    transform: translateY(-1px);
  }
  .an-divider {
    display: flex;
    align-items: center;
    width: 100%;
    gap: 12px;
    padding: 28px 0 20px;
    color: #a09a92;
    font-family: 'DM Sans', 'Helvetica Neue', sans-serif;
    font-size: 13px;
  }
  .an-divider::before,
  .an-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #d5cfc8;
  }
  .an-newsletter-block {
    background: #fff;
    border: 1px solid #e5e0d9;
    border-radius: 0;
    padding: 40px 40px 36px;
    text-align: center;
    width: 100%;
    box-sizing: border-box;
  }
  .an-newsletter-label {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 11px;
    letter-spacing: 2px;
    color: #8BA7D4;
    margin: 0 0 14px;
    text-transform: uppercase;
  }
  .an-newsletter-body {
    font-family: 'DM Sans', 'Helvetica Neue', sans-serif;
    font-size: 15px;
    color: #3a3530;
    line-height: 1.65;
    margin: 0 0 10px;
  }
  .an-newsletter-sub {
    font-family: 'DM Sans', 'Helvetica Neue', sans-serif;
    font-size: 14px;
    font-weight: 500;
    color: #252535;
    margin: 0 0 22px;
  }
  .an-email-form {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
  }
  .an-form-row {
    display: flex;
    gap: 8px;
    width: 100%;
    max-width: 420px;
  }
  .an-email-input {
    flex: 1;
    padding: 13px 18px;
    border: 1.5px solid #d5cfc8;
    border-radius: 9999px;
    font-family: 'DM Sans', 'Helvetica Neue', sans-serif;
    font-size: 14px;
    color: #252535;
    background: #FFF8EE;
    outline: none;
    transition: border-color 0.2s ease;
  }
  .an-email-input:focus {
    border-color: #E87AAA;
  }
  .an-email-input::placeholder {
    color: #b0a89e;
  }
  .an-btn-secondary {
    background: #E87AAA;
    color: #fff;
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 12px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    padding: 13px 22px;
    border: none;
    border-radius: 9999px;
    cursor: pointer;
    white-space: nowrap;
    transition: background 0.2s ease;
  }
  .an-btn-secondary:hover {
    background: #d9608f;
  }
  .an-form-note {
    font-family: 'DM Sans', 'Helvetica Neue', sans-serif;
    font-size: 12px;
    color: #a09a92;
    margin: 0;
  }
  @media (max-width: 560px) {
    .an-account-block,
    .an-newsletter-block {
      padding: 36px 24px;
    }
    .an-heading {
      font-size: 19px;
    }
    .an-form-row {
      flex-direction: column;
    }
    .an-btn-secondary {
      width: 100%;
      padding: 14px;
    }
  }
</style>

<section class="account-newsletter-section">
  <div class="an-inner">

    <!-- PRIMARY: FREE ACCOUNT -->
    <div class="an-account-block">
      <p class="an-eyebrow">YOUR SPOT. FREE. ALWAYS.</p>
      <h2 class="an-heading">Create a free account and everything lives in one place — your tools, your downloads, your resources.</h2>
      <p class="an-body">Plus freebies that aren't anywhere else on the site. The ones on the public pages are for anyone who finds them. The ones inside your account are just for you.</p>
      <a href="/register" class="an-btn-primary">UNLOCK MY FREE RESOURCES →</a>
      <div style="margin-top:20px;display:flex;flex-direction:column;gap:6px;align-items:center;">
        <p style="font-family:'DM Sans','Helvetica Neue',sans-serif;font-size:13px;color:rgba(255,248,238,0.65);margin:0;">Instant access to all freebies — no waiting</p>
        <p style="font-family:'DM Sans','Helvetica Neue',sans-serif;font-size:13px;color:rgba(255,248,238,0.65);margin:0;">Member-only exclusives added every month</p>
        <p style="font-family:'DM Sans','Helvetica Neue',sans-serif;font-size:13px;color:rgba(255,248,238,0.65);margin:0;">Free. Always.</p>
      </div>
    </div>

    <!-- DIVIDER -->
    <div class="an-divider">
      <span>or</span>
    </div>

    <!-- SECONDARY: NEWSLETTER -->
    <div class="an-newsletter-block">
      <p class="an-newsletter-label">NOT READY FOR THAT?</p>
      <p class="an-newsletter-body">I write every week. What I'm still figuring out, what helped me this week, what's hard right now. Not advice. Not a program. Just where I am — the honest parts and the better parts both.</p>
      <p class="an-newsletter-sub">Drop your email and I'll send it to you.</p>
      <form class="an-email-form" onsubmit="event.preventDefault(); submitToReach(this);">
        <div class="an-form-row">
          <input type="email" id="homepage-email" name="email" placeholder="Your email" required class="an-email-input" aria-label="Email address">
          <button type="submit" id="homepage-submit" class="an-btn-secondary">SEND IT</button>
        </div>
        <p class="an-form-note">Nothing else. Just the weekly note.</p>
      </form>
      <p id="homepage-msg" style="display:none; margin-top:12px; font-family:'Montserrat',sans-serif; font-weight:800; font-size:0.8rem; text-transform:uppercase; letter-spacing:1px; color:#E87AAA;"></p>
    </div>

  </div>
</section>

<!-- 6PM EXPERIENCE WIDGET -->
<div id="exp-overlay" style="display:none;position:fixed;inset:0;z-index:99999;background:rgba(37,37,53,0.85);">
  <iframe id="exp-frame" src="" title="The 6pm Experience" style="width:100%;height:100%;border:none;"></iframe>
</div>
<script>
window.open6pmExperience = function() {
  var f = document.getElementById('exp-frame');
  if (!f.getAttribute('src')) f.setAttribute('src', '/6pm-experience/');
  document.getElementById('exp-overlay').style.display = 'block';
  document.body.style.overflow = 'hidden';
};
window.close6pmExperience = function() {
  document.getElementById('exp-overlay').style.display = 'none';
  document.body.style.overflow = '';
};
window.addEventListener('message', function(e) {
  if (e.data === 'mnc-6pm-close') window.close6pmExperience();
});
</script>

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
        <div class="footer-social">
            <a href="https://www.facebook.com/profile.php?id=61590806030391" target="_blank" rel="noopener" aria-label="Facebook">
                <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
            <a href="https://www.instagram.com/my.nest.chapter/" target="_blank" rel="noopener" aria-label="Instagram">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1.5" fill="currentColor" stroke="none"/></svg>
            </a>
            <a href="https://www.pinterest.com/mynestchapter" target="_blank" rel="noopener" aria-label="Pinterest">
                <svg viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path d="M12 0C5.373 0 0 5.373 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 0 1 .083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.632-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0z"/></svg>
            </a>
        </div>
        <p class="footer-copy">&copy; 2026 My Nest Chapter. All rights reserved.</p>
    </div>
</footer>

<!-- Toast container -->
<div class="toast" id="toast" aria-live="polite" aria-atomic="true"></div>

<script>
// --- Reach Email Capture ---
async function submitToReach(form) {
    const email = document.getElementById('homepage-email').value.trim();
    const btn = document.getElementById('homepage-submit');
    const msg = document.getElementById('homepage-msg');
    if (!email) return;
    btn.textContent = 'Sending…';
    btn.disabled = true;
    try {
        const res = await fetch('/reach-subscribe.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, first_name: '', segment: 'b236abad-55a2-45a7-a0f1-9c4bfa003c77' })
        });
        const data = await res.json();
        if (res.ok && data.success) {
            form.style.display = 'none';
            msg.textContent = 'Check your inbox.';
            msg.style.display = 'block';
        } else {
            throw new Error(data.detail || data.error || 'Unknown error');
        }
    } catch(e) {
        btn.textContent = 'Send It';
        btn.disabled = false;
        msg.textContent = 'Error: ' + e.message;
        msg.style.display = 'block';
    }
}

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
