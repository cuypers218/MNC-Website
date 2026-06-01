<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solo Mom. Empty Nest. Now What? | My Nest Chapter</title>
    <meta name="description" content="Tools and resources built from lived experience, for single and solo moms navigating the empty nest transition.">
    
    <!-- Open Graph -->
    <meta property="og:title" content="Solo Mom. Empty Nest. Now What?">
    <meta property="og:description" content="Tools and resources built from lived experience, for single and solo moms navigating the empty nest transition.">
    <meta property="og:url" content="https://mynestchapter.com/">
    <meta property="og:type" content="website">
    
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
        <h1 class="hero-tagline fade-in">Solo mom. Empty nest.<br>Now what?</h1>
        <p class="hero-subtitle fade-in-delay-1">This is where you start.</p>
        <a href="/6pm-experience/" onclick="event.preventDefault();open6pmExperience();" class="btn btn-primary fade-in-delay-2">Start Here</a>
    </div>
</section>

<!-- QUIZ MODAL -->
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
        .mnc-wrap{width:100%;max-width:620px;margin:0 auto;}
        .mnc-card{background:#FFF8EE;border-radius:1rem;border:1px solid #DDD6F0;box-shadow:0 4px 16px rgba(37,37,53,0.10);overflow:hidden;width:100%;box-sizing:border-box;}
        .mnc-card-bar{height:4px;background:#E87AAA;}
        .mnc-card-inner{padding:36px 32px 40px;box-sizing:border-box;}
        .mnc-cover{text-align:center;}
        .mnc-cover-tag{display:inline-block;background:#EEE8F8;border:1px solid rgba(232,122,170,0.2);border-radius:9999px;padding:4px 16px;font-family:'DM Sans',sans-serif;font-weight:600;font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:#E87AAA;margin-bottom:20px;}
        .mnc-cover-title{font-family:'Lora',Georgia,serif;font-weight:600;font-size:clamp(1.5rem,1.2rem + 1.25vw,2rem);color:#252535;line-height:1.2;margin-bottom:16px;}
        .mnc-cover-desc{font-family:'DM Sans',sans-serif;font-size:clamp(0.9rem,0.8rem + 0.3vw,1rem);color:#5A5A72;line-height:1.7;margin-bottom:8px;max-width:460px;margin-left:auto;margin-right:auto;}
        .mnc-cover-note{font-family:'DM Sans',sans-serif;font-size:13px;color:#8B8BA8;font-style:italic;margin-bottom:28px;}
        .mnc-cover-divider{height:1px;background:#DDD6F0;margin:0 auto 28px;width:80%;}
        .mnc-btn-start{font-family:'DM Sans',sans-serif;font-weight:500;font-size:15px;background:#E87AAA;color:#fff;border:none;border-radius:9999px;padding:14px 44px;cursor:pointer;transition:background 180ms cubic-bezier(0.16,1,0.3,1),box-shadow 180ms cubic-bezier(0.16,1,0.3,1);box-shadow:0 4px 16px rgba(37,37,53,0.10);}
        .mnc-btn-start:hover{background:#C45588;box-shadow:0 4px 16px rgba(37,37,53,0.18);}
        .mnc-cover-footer{margin-top:22px;font-family:'DM Sans',sans-serif;font-weight:500;font-size:11px;letter-spacing:.08em;text-transform:uppercase;color:#8B8BA8;}
        .mnc-progress-label{font-family:'DM Sans',sans-serif;font-weight:600;font-size:11px;letter-spacing:.08em;text-transform:uppercase;color:#8B8BA8;margin-bottom:8px;}
        .mnc-progress-bg{background:#DDD6F0;border-radius:9999px;height:4px;overflow:hidden;margin-bottom:28px;}
        .mnc-progress-fill{background:#E87AAA;height:100%;border-radius:9999px;transition:width 0.4s cubic-bezier(0.16,1,0.3,1);}
        .mnc-question{font-family:'Lora',Georgia,serif;font-weight:600;font-size:clamp(1rem,0.9rem + 0.5vw,1.2rem);color:#252535;line-height:1.4;margin-bottom:20px;}
        .mnc-options{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:8px;}
        .mnc-option{width:100%;text-align:left;background:#FFF8EE;border:1.5px solid #DDD6F0;border-radius:0.75rem;padding:13px 16px;font-family:'DM Sans',sans-serif;font-size:15px;color:#5A5A72;cursor:pointer;transition:background 180ms cubic-bezier(0.16,1,0.3,1),border-color 180ms cubic-bezier(0.16,1,0.3,1),color 180ms cubic-bezier(0.16,1,0.3,1);line-height:1.5;box-sizing:border-box;}
        .mnc-option:hover{background:#EEE8F8;border-color:#E87AAA;color:#252535;}
        .mnc-option.selected{background:#EEE8F8;border-color:#E87AAA;color:#252535;font-weight:500;}
        .mnc-nav{display:flex;justify-content:space-between;align-items:center;margin-top:24px;}
        .mnc-btn-back{font-family:'DM Sans',sans-serif;font-weight:500;font-size:13px;color:#8B8BA8;background:none;border:none;cursor:pointer;transition:color 180ms;padding:8px 0;}
        .mnc-btn-back:hover{color:#252535;}
        .mnc-btn-next{font-family:'DM Sans',sans-serif;font-weight:500;font-size:14px;background:#E87AAA;color:#fff;border:none;border-radius:9999px;padding:12px 28px;cursor:pointer;transition:background 180ms cubic-bezier(0.16,1,0.3,1),box-shadow 180ms cubic-bezier(0.16,1,0.3,1);margin-left:auto;}
        .mnc-btn-next:hover{background:#C45588;box-shadow:0 4px 14px rgba(37,37,53,0.15);}
        .mnc-btn-next:disabled{opacity:0.35;cursor:not-allowed;box-shadow:none;}
        .mnc-email h2{font-family:'Lora',Georgia,serif;font-weight:600;font-size:clamp(1.1rem,0.9rem + 0.5vw,1.35rem);color:#252535;margin-bottom:10px;line-height:1.3;}
        .mnc-email p{font-family:'DM Sans',sans-serif;font-size:15px;color:#5A5A72;line-height:1.7;margin-bottom:22px;}
        .mnc-form-group{margin-bottom:14px;}
        .mnc-form-group label{font-family:'DM Sans',sans-serif;font-weight:600;font-size:11px;letter-spacing:.08em;text-transform:uppercase;color:#8B8BA8;display:block;margin-bottom:6px;}
        .mnc-form-group input{width:100%;padding:12px 14px;border:1.5px solid #C4B0E8;border-radius:0.5rem;font-family:'DM Sans',sans-serif;font-size:15px;color:#252535;background:#FFF8EE;outline:none;transition:border-color 180ms;box-sizing:border-box;}
        .mnc-form-group input:focus{border-color:#E87AAA;background:#fff;}
        .mnc-btn-submit{width:100%;font-family:'DM Sans',sans-serif;font-weight:500;font-size:15px;background:#E87AAA;color:#fff;border:none;border-radius:9999px;padding:14px;cursor:pointer;margin-top:4px;transition:background 180ms cubic-bezier(0.16,1,0.3,1),box-shadow 180ms cubic-bezier(0.16,1,0.3,1);}
        .mnc-btn-submit:hover{background:#C45588;box-shadow:0 4px 14px rgba(37,37,53,0.15);}
        .mnc-privacy{font-family:'DM Sans',sans-serif;font-size:12px;color:#8B8BA8;text-align:center;margin-top:10px;font-style:italic;}
        .mnc-result-badge{display:inline-block;background:#EEE8F8;border:1px solid rgba(232,122,170,0.2);border-radius:9999px;padding:4px 16px;font-family:'DM Sans',sans-serif;font-weight:600;font-size:11px;letter-spacing:.1em;text-transform:uppercase;color:#E87AAA;margin-bottom:14px;}
        .mnc-result-title{font-family:'Lora',Georgia,serif;font-weight:600;font-size:clamp(1.1rem,0.9rem + 0.5vw,1.5rem);color:#252535;line-height:1.25;margin-bottom:14px;}
        .mnc-result-msg{font-family:'DM Sans',sans-serif;font-size:15px;line-height:1.7;color:#5A5A72;margin-bottom:22px;}
        .mnc-result-divider{height:1px;background:#DDD6F0;border-radius:9999px;margin-bottom:20px;}
        .mnc-freebie-box{background:#EEE8F8;border:1px solid rgba(232,122,170,0.2);border-radius:0.75rem;padding:16px 20px;margin-bottom:18px;}
        .mnc-freebie-box h3{font-family:'DM Sans',sans-serif;font-weight:600;font-size:11px;color:#E87AAA;letter-spacing:.08em;text-transform:uppercase;margin-bottom:6px;}
        .mnc-freebie-box p{font-family:'DM Sans',sans-serif;font-size:14px;color:#5A5A72;line-height:1.6;margin:0;}
        .mnc-cta-note{font-family:'DM Sans',sans-serif;font-size:14px;color:#8B8BA8;text-align:center;margin-bottom:14px;font-style:italic;}
        .mnc-result-btns{display:flex;flex-direction:column;gap:10px;width:100%;}
        .mnc-btn-workbook{display:block;width:100%;box-sizing:border-box;font-family:'DM Sans',sans-serif;font-weight:500;font-size:15px;background:#E87AAA;color:#fff;border:none;border-radius:9999px;padding:15px;cursor:pointer;text-align:center;text-decoration:none;transition:background 180ms cubic-bezier(0.16,1,0.3,1),box-shadow 180ms cubic-bezier(0.16,1,0.3,1);}
        .mnc-btn-workbook:hover{background:#C45588;box-shadow:0 4px 14px rgba(37,37,53,0.15);}
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
              message: "You gave everything for years — mostly alone. The anger makes sense. The exhaustion makes sense. Before you can figure out what's next, you need to see everything you've actually been carrying. That's where this starts. Not with goals. With the truth of what you've handled."
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

<!-- LATEST FROM THE BLOG -->

<!-- FEATURED PRODUCTS -->
<section class="section">
    <div class="container">
        <h2 class="text-center" style="margin-bottom: 0.5rem;">Tools I Built Because I Needed Them</h2>
        <p class="text-center" style="color: #666666; font-size: 0.9rem; margin-bottom: 2rem;">Some are free. Some aren't. All of them came from something real.</p>
        
        <div class="product-grid">
                        <div class="product-card fade-in">
                <span class="badge ">
                    $14.99                </span>
                                <div class="product-card-content">
                    <span class="product-card-category">workbook</span>
                    <h3 class="product-card-title">Now What? A Workbook for Solo Moms in the Empty Nest</h3>
                    <p class="product-card-description">The workbook I made because nothing out there sounded like me. Activities, reflections, and honest space for solo moms figuring out what comes next.</p>
                    <a href="/shop/now-what-workbook" class="btn btn-primary">
                        Learn More                    </a>
                </div>
            </div>
                        <div class="product-card fade-in">
                <span class="badge badge-free">
                    FREE                </span>
                                <div class="product-card-content">
                    <span class="product-card-category">free</span>
                    <h3 class="product-card-title">The Quiet House Meter</h3>
                    <p class="product-card-description">Five questions about where you are with the quiet right now. No judgment. Takes 60 seconds.</p>
                    <a href="/shop/quiet-house-meter" class="btn btn-outline">
                        Get This Free                    </a>
                </div>
            </div>
                        <div class="product-card fade-in">
                <span class="badge badge-free">
                    FREE                </span>
                                <div class="product-card-content">
                    <span class="product-card-category">free</span>
                    <h3 class="product-card-title">The Someday List Builder</h3>
                    <p class="product-card-description">All those things you said you&#039;d do someday? This is where you finally write them down.</p>
                    <a href="/shop/someday-list-builder" class="btn btn-outline">
                        Get This Free                    </a>
                </div>
            </div>
                    </div>
        
        <div class="text-center" style="margin-top: 2rem;">
            <a href="/shop" class="btn btn-outline">See Everything</a>
        </div>
    </div>
</section>

<!-- ABOUT TEASER -->
<section class="section-cream">
    <div class="container-narrow text-center">
        <h2>I'm Cece</h2>
        <p style="font-size: 1.05rem; line-height: 1.7; color: #101010; margin-bottom: 2rem;">I raised my kids mostly on my own. When my last one left, I wasn't ready for what hit me. I went looking for something — anything — that sounded like my life, and it didn't exist. So I created My Nest Chapter.</p>
        <a href="/about" class="btn btn-dark">Read My Story</a>
    </div>
</section>

<!-- EMAIL CAPTURE -->
<section class="section">
    <div class="container">
        <div class="email-capture">
            <h3>I Write About This Every Week</h3>
            <p>Real updates from where I am right now. No advice. No coaching. Just one mom being honest about what this looks like.</p>
            <form class="email-capture-form" onsubmit="event.preventDefault(); submitEmailCapture(this, 'homepage');">
                <input type="email" placeholder="Your email" required aria-label="Email address">
                <button type="submit" class="btn btn-primary">Send It</button>
            </form>
        </div>
    </div>
</section>

<!-- 6PM EXPERIENCE LIGHTBOX -->
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
        <p class="footer-copy">&copy; 2026 My Nest Chapter. All rights reserved.</p>
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
