# MY NEST CHAPTER — DECISION LOG
**Shared source of truth between planning sessions and code implementation.**

---

## HOW TO USE THIS FILE

This file lives in the repo so both AI assistants working on this site — the one Cece plans with in chat, and the one implementing code in VS Code — read from the same record.

**Rules:**
1. Check this file at the start of every coding session.
2. If live code conflicts with anything marked LOCKED below, the code is wrong — update it to match this file.
3. New decisions get added to the Change Log at the bottom with a date. Most recent entry wins if anything looks contradictory.
4. This file does NOT replace the full brand voice/copy rules — those live in `YNC_Brand_SKILL_v4_June2026.md` (ask Cece for it if a banned-word check is needed on new copy). This file is for structure, logic, and placement decisions.

---

## ACTION ITEMS — FIX NOW

- [ ] Replace placeholder thumbnail images on dashboard product cards with real images.
- [ ] Register the exclusive unlock cron in Hostinger hPanel → Hosting → Cron Jobs: `php /home/u540670132/domains/mynestchapter.com/public_html/cron/send-exclusive-unlocks.php` — daily at 9 AM (`0 9 * * *`). This must be done manually in hPanel.

## BACK BURNER (not urgent — do not touch without a new brief)

- **Quiet House Meter** — widget was never built (no folder in /widgets/). Removed from homepage and resources page 2026-06-21. DB record set to `draft` 2026-06-21. Do not rebuild without Cece's go-ahead.
- **30-Day Goal & Habit Tracker** — live widget, $27, but needs full visual rebuild to match Cooking for One style. Current code is narrow/popup layout. No brief written yet. Widget folder currently has no index.html (deleted as security fix). Back burner until Cece is ready with a brief.
- **Weekly Reset Planner** — local file only, pre-rebrand colors/fonts, not live. Needs brand audit before going up.
- **New Grandma Planner** — high priority when ready to build, but not started.

## COMPLETED — 2026-06-22

- ✅ Garage Sale Planner Round 3 (`widgets/garage-sale-planner/widget.html`) — commit 703faad
  - Safety: 4 new checklist tasks (address DM timing, don't mention solo, sightline to all buyers, trust instinct). Page-sub + info-box copy replaced. 3 scripted responses added (uncomfortable buyer, pricing pushback, code word).
  - Online Selling: Craigslist + ThredUp/Swap.com added to platform cards
  - Pricing Guide: 5-line callout box above category grid (10–25% of retail, round numbers, bundle, last-hour drop, price before day)
  - Start tab: rotating tips strip — charcoal bar, 4 tips, swaps every 8 seconds
  - Sale Day: change calculator inside Calculator card (customer gave / give back, large output)
  - Write Your Ad: already built in prior session — confirmed present

## COMPLETED — 2026-06-21 (session 3)

- ✅ Exclusive Content section built on dashboard (`site/dashboard.php`) — unlocked items with lavender EXCLUSIVE badge + Download button, live countdown timer to next unlock, all-caught-up fallback
- ✅ `exclusive-download.php` — auth + unlock check, serves PDF via readfile(), graceful redirect if file missing
- ✅ `cron/send-exclusive-unlocks.php` — daily 9 AM cron, two-pass (preview 24hr before + unlock day-of), logs per member+item+type to prevent duplicates
- ✅ `exclusive_content_queue` + `member_freebie_notifications` tables created, queue seeded (6pm Survival Plan + Who Am I Now)
- ✅ `exclusive-6pm-survival-plan.pdf` + `exclusive-who-am-i-now.pdf` uploaded to `downloads/` on server
- ✅ Garage Sale Planner Round 2: sticky total bar (fixed bottom, charcoal, pink earned amount, Lime "Goal reached!"), goal confetti via canvas-confetti, weather already live
- ✅ **One manual step remaining:** Register cron in Hostinger hPanel → see ACTION ITEMS above

## COMPLETED — 2026-06-21 (session 2)

- ✅ Quiet House Meter removed from homepage (`site/index.php`) and resources page (`site/resources.php`)
- ✅ Quiet House Meter DB status set to `draft` via one-time PHP script (no longer appears in queries)
- ✅ `seed-products.php` deleted from repo and server (was stale; DB was hand-updated via `add-widgets.php`)
- ✅ `widgets/goal-habit-tracker/index.html` deleted from server (unprotected duplicate)
- ✅ `widgets/cooking-for-one/index.html` was already gone from server
- ✅ Garage Sale Planner: fonts → Lora/DM Sans, all border-radius removed, all box-shadows removed, emoji icons replaced with text labels, backup date field + HOA permit task + rain warning added
- ✅ `widgets/garage-sale-planner/index.html` deleted from repo (unprotected duplicate)
- ✅ `site/index.php`, `site/resources.php`, `site/dashboard.php` deployed to live server
- ✅ Retired color `#811453` replaced with `#E87AAA` on Someday List Builder + 6pm Cheat Sheet links in `resources.php`

## COMPLETED — 2026-06-20

- ✅ Dashboard rebuilt: Your Products + Freebies + For Members (tiered discount) sections
- ✅ Door-reveal animation on tier unlock (tracks via `highest_tier_seen` on users table)
- ✅ Stripe coupons created: MNCTIER10 (10%), MNCTIER15 (15%), MNCTIER20 (20%)
- ✅ Stripe secret key rotated and updated in config.php
- ✅ Banned phrase "No judgment." removed from seed-products.php + index.php
- ✅ Banned word "Carried" fixed → "The Weight You Lived" in workbook.php
- ✅ Retired color #811453 replaced with #E87AAA in blog-post.php + setup-database.php
- ✅ Dashboard placeholder gradients updated to Soft Peach → Lavender (brand-compliant)

---

## LIVE PAGES

Homepage, About (includes quiz), Shop, workbook.php, Blog, Resources, Freebies, Member Dashboard, Login/Register, Checkout, `/nester-quiz` (dedicated shareable quiz page, also linked from dashboard).

---

## MEMBER DASHBOARD — GATING LOGIC (LOCKED)

**Core rule:** Every public freebie on the Freebies page requires email capture — no exceptions. Once a person is a logged-in member on the dashboard, everything is gate-free — they're already in the system.

**Signup behavior:** New members get instant access to ALL currently available freebies — no drip, no waiting period.

**Monthly drop cadence:** One new exclusive freebie added per month. Six-month queue tracked in Notion. Dashboard shows a countdown timer card for the next drop, and an email reminder goes out via Hostinger Reach ahead of each one.

### Per-product placement:

| Product | Freebies Page (public) | Dashboard (member) |
|---|---|---|
| The 6pm Cheat Sheet | Gated (email capture) | Direct download, no gate |
| Someday List Builder | Gated (capture built in) | No gate + callout card to paid Someday List Companion |
| Pick Your Mood Coloring Widget | Needs email gate added before public launch | No gate |
| What Kind of Nester Are You? quiz | About page + `/nester-quiz` | Result card: shows matched type + PDF if taken, "Discover your type →" nudge card if not |

### Exclusive Content Queue (dashboard-only, NOT on Freebies page)

None of these are live yet — the dashboard has no exclusive content section built. Drop order once it exists:

| # | Freebie | Status |
|---|---|---|
| 1 | The 6pm Survival Plan | Built, ready to deploy |
| 2 | Who Am I Now | Built, ready to deploy |
| 3 | Weekend Structure Sheet | Not yet built |
| 4 | Cooking for One Starter Sheet | Not yet built |
| 5 | The Closed Door Checklist (kid's old room) | Not yet built |
| 6 | Weekly reset — Sunday check-in, one page | Not yet built |
| 7 | Budget Reset for One worksheet | Not yet built |

**Naming lock:** The 6pm Experience is never called a "lightbox" anywhere in code, copy, or comments. Always "6pm Experience" or "6pm Experience widget."

**Page naming lock:** The page is "Freebies" — never "Free Tools," "Free Resources," or "Free Stuff" as a nav label. "Free Stuff" is conversational copy only. Shop page carries paid products only, with a small callout linking to Freebies.

---

## PRODUCT CATALOG REFERENCE

- Now What? Workbook — $14.99 PDF (site) / $24.99 paperback (Amazon KDP)
- The Someday List Companion — $7.99 (shop)
- The 6pm Cheat Sheet — Free
- The 6pm Survival Plan — Free, dashboard only
- Who Am I Now — Free, dashboard only
- Pick Your Mood Coloring Widget — Free
- What Kind of Nester Are You? quiz — Free (3 result types: Nester, Busy-er, Wonderer)
- Cooking for One Planner — live, $27
- 30-Day Goal & Habit Tracker — live, $27 (visual rebuild pending — back burner)
- Garage Sale Planner — live, $27
- What's This Worth — built, not yet listed for sale
- The Quiet House Meter — back-burner; widget never built; removed from homepage + resources page; DB record needs → draft via phpMyAdmin

---

## DESIGN SYSTEM QUICK REFERENCE

Full palette and typography rules live in the brand skill file — below is just enough to catch an obviously wrong color or font in code review.

**Core colors:** Velvety Charcoal `#252535`, Vanilla Cream `#FFF8EE`, Vibrant Pink `#E87AAA` (primary signature), Lavender `#C4B0E8`, Powder Blue `#A8C5DA`, Periwinkle `#8BA7D4`, Peach `#F2A57A`, Soft Peach `#F5C4A8`, Lemon `#EDD96A`, Lime `#B5CC6A`, Light blush `#facfd4`.

**Retired — should never appear in new code:** Deep Berry `#811453`, Dark Berry `#5E1337`, any Berry shade, Muted Mauve `#A3918A`, Warm Blush `#D6C2B7`, Sage Gold, Peach Tan, Sage Gray, Blush Pink `#F8D4D4`, Linen White, Soft Rose, Warm Cream `#F4E8C1`, Warm Tan, Coral Orange, Teal, Gold, Navy.

⚠️ Note: `site/about.php` may still reference retired colors — worth a check.

**Fonts:** Montserrat ExtraBold (headlines, display), Arial Regular (body/print). HTML tools only: Lora (display) + DM Sans (body).

---

## CHANGE LOG

**2026-06-19** — Created this file. Logged the two banned-language fixes found in `seed-products.php`, `index.php`, and `workbook.php`. Documented full dashboard gating logic and per-product placement table from the June 13 planning session, which had been locked in chat but never made it into code.

**2026-06-19 (correction)** — The 6pm Survival Plan and Who Am I Now are NOT live. Confirmed against `dashboard.php`: no exclusive content section exists in the code at all. Past session notes marking these "Built ✅" meant content was finished, not that they shipped. Added "build the exclusive content section" as the first action item — both PDFs are ready to upload the moment it exists. Full 7-item drop queue documented above.

**2026-06-21** — Garage Sale Planner design pass complete. Fonts → Lora + DM Sans, all border-radius removed, all box-shadows removed, emoji weather icons replaced with text labels. Backup date field + HOA permit checklist item + rain warning added. Security: deleted unprotected `index.html` duplicate. Product Catalog corrected: Garage Sale Planner is live at $27 (was "built, not yet listed for sale" — stale).

**2026-06-21 (session 2)** — Quiet House Meter removed from site: card deleted from `site/index.php`, link deleted from `site/resources.php`. Widget was never built — nothing in /widgets/ to remove. DB record still active; needs phpMyAdmin → `draft`. `seed-products.php` deleted from repo (was stale after DB was hand-updated via `add-widgets.php`; `INSERT IGNORE` made it useless). Security: deleted unprotected `index.html` files from cooking-for-one and goal-habit-tracker widget folders. Product Catalog updated: added Cooking for One ($27) and Goal & Habit Tracker ($27, visual rebuild pending). Goal & Habit Tracker moved to back burner — needs a brief before any visual work.

---

## BUILD GATES — MANDATORY, NO EXCEPTIONS

These are not reminders. They are enforced steps. Claude Code runs them automatically.
Cece should not have to remember to ask for any of this.

The GitHub Action (`.github/workflows/mnc-qa.yml`) runs automated rule checks on every
push — retired colors, border-radius, box-shadow, wrong fonts, banned phrases.
Gates 1–3 below are the session-level layer that the GitHub Action can't replace.

---

### GATE 1 — Before Any Code Starts (New Widget)

**Trigger:** Cece mentions building a new tool, names a product not yet started, or a
new folder is detected under /widgets/ with no index.html.

**Behavior:** STOP. Do not write a single line of HTML, CSS, or JavaScript.
Ask these five questions first — all five, in order:

1. What is this tool? (One sentence — not a list of features.)
2. Who specifically is using it and when? Not "solo moms" — one specific person,
   one specific moment. Example: "A solo mom who just filled two boxes of her kid's
   stuff and doesn't know what to price any of it."
3. What is the exact pain point it solves? One sentence. She should feel seen.
4. What are the 5–8 features that directly serve that pain point?
   Flag anything that is nice-to-have but doesn't serve it.
5. What is the price point, and does the scope match that tier?

Do not proceed to Gate 2 until all five questions are answered.
Do not start any design work while waiting for answers.

---

### GATE 2 — Design Plan Before Build

**Trigger:** Immediately after Gate 1 answers are in.

**Behavior:** Produce a design plan. Do not write a single line of HTML, CSS, or
JavaScript until this plan is approved by Cece.

The plan must cover:

**Token system** — Which of the locked May 2026 colors serves which role in this tool.
Name the roles specifically: background, primary action, secondary, accent, text.
Do not just list the palette. Assign colors to purposes.

**Type scale** — Sizes and weights for display headers vs. body copy.
Lora for display. DM Sans for body. No other fonts, ever, in widget files.

**Layout structure** — Describe each section or tab in 1–2 sentences.
What does the user see first? What comes next? How does it flow?

**Signature element** — ONE thing in this tool that could only be My Nest Chapter.
Not a generic icon. Not a gradient. Something tied to the actual pain point or
the content of this specific tool. If you can't name it, the design isn't ready.

**Self-critique** — After producing the plan, ask: does any part of this look like
a generic template default? (Rounded cards, soft shadows, a big centered stat,
stock illustration.) If yes — fix it, and say what changed and why before showing
Cece the plan.

Then stop. Show Cece the plan. Wait for "approved."
Silence is not approval. A question is not approval.
Only the word "approved" or an explicit "looks good, build it" unlocks Gate 3.

---

### GATE 3 — Session End QA (Every Session Where Code Was Touched)

**Trigger:** Cece indicates she is done for the session, or a natural stopping point
is reached after any code was written or modified.

**Behavior:** Run both steps below automatically, without being asked.
Do not wait for Cece to remember to ask. Do not skip either step.
Do not end the session without completing both.

---

**Step 1 — Technical QA** (run silently, fix everything found, then report)

Input validation:
- Every number field: test negative numbers, letters, empty input, and an
  unreasonably large number. Does the field handle all four without crashing?
- Every text field: test empty input and extremely long text (200+ characters).
  Does it handle gracefully?
- Every required field: what happens if the user clicks submit or proceed
  without filling it in? Is the behavior clear?

Mobile at 375px (iPhone SE — the smallest common screen):
- Does anything overflow horizontally?
- Does any text clip, stack awkwardly, or become unreadable?
- Are all buttons large enough to tap (minimum 44px touch target)?
- Does the tab/nav system work at this width?

localStorage resilience:
- What happens on first load with zero saved data? No crash, no blank error.
- What happens if localStorage is cleared or corrupted mid-session?
  The tool should recover gracefully, not throw a JS error.

Every button and interaction:
- Click every button. Does each one do exactly what its label says?
- Does every input that should save to localStorage actually save?
- Does clearing/resetting actually clear the right data?

Fix every issue found. Do not ask permission to fix obvious bugs — fix them.

---

**Step 2 — Brand & Visual QA** (run silently, fix everything found, then report)

CSS rule checks (grep the file):
- border-radius: any value other than 0, 0px, or 9999px is a violation. Find it, fix it.
- box-shadow: any value other than none is a violation. Find it, fix it.
- Hex colors: any color not in the locked May 2026 palette is a violation. Find it, fix it.
  Allowed: #252535, #FFF8EE, #E87AAA, #C4B0E8, #A8C5DA, #8BA7D4,
           #F2A57A, #F5C4A8, #EDD96A, #B5CC6A, #facfd4
  Everything else: flag and fix.

Font check (widget files only):
- Grep for Montserrat or Arial anywhere in a /widgets/ file. Replace with
  Lora (display/headers) or DM Sans (body). No other fonts allowed in widgets.

Banned phrase check (grep the full file):
- "no judgment" or "zero judgment" — remove it
- "what you carried" — replace with "what you lived"
- "as solo moms, we" — Cece speaks for herself only, never for the reader
- "lightbox" — replace with "6pm Experience" or "6pm Experience widget"
- "no wrong answers" — remove it
- "hold space" — rephrase in plain language
- "healing journey" — remove or rephrase
- "you've got this" — remove
- "this will help you" — replace with "this helped me" or "this is one way to"
- "you'll feel" — replace with "I felt" or "you might notice"
- "you need to" — replace with "you might want to"

Signature element check:
- Does this tool have ONE element that could only be My Nest Chapter — not
  something a generic productivity or planner app would have?
- If the answer is no or unclear: flag it and propose one specific addition
  tied to the actual content or pain point of this tool.

Fix every violation found. Do not ask permission — fix and report.

---

**Step 3 — Close-out report**

End every session with exactly one of these two lines:

  "QA complete. All checks passed. Safe to deploy."

  "QA complete. Found [N] issues — all fixed. Safe to deploy."

If there is anything that cannot be fixed in session (e.g. a design judgment call
that needs Cece's input), flag it explicitly before closing:
  "One item needs your call before this is safe to deploy: [describe it]."

---

**If Cece tries to close out before QA has run:**

Ask: "QA hasn't run on the code we changed. Run it now before we close out?"

Do not let a session end with unreviewed code. One prompt is enough —
do not nag, but do ask once.

---

### GATE SUMMARY

| Gate | Trigger | What it prevents |
|---|---|---|
| 1 — PM Define | New widget, no index.html | Building the wrong thing before the pain point is confirmed |
| 2 — Design Plan | After Gate 1 answers | Code written before anyone thought about what it should look like |
| 3 — Session QA | Any session with code changes | Bugs, retired colors, wrong fonts, and banned language reaching Hostinger |

GitHub Action is a second layer — it catches the same CSS and color violations
automatically on every push. Gates 1–3 are the session-level layer.
Both are required. Neither replaces the other.
