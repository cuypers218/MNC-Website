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
5. For any visual or design decision, read `DESIGN.md` in the repo root — it is the canonical design system and overrides any color, font, or spacing choice not explicitly locked here.
6. Before starting any new widget or product build, read `MNC-BUILD-PLAYBOOK.md` in the repo root — it contains the mandatory 5-phase build process and prompts. (`MNC_Interactive_Product_Build_Process.md` is retired as of 2026-07-01 — its rules were merged into the Playbook. Delete that file from the repo if it's still there.)
7. At the start of every session, read `MNC-PRODUCT-ROADMAP.md` in the repo root — it is the live product status tracker and tells you what's done, what's pending, and what to work on next.

---

## BUILD PROCESS — ANY NEW INTERACTIVE TOOL

Follow `MNC-BUILD-PLAYBOOK.md` in full. Mandatory, no skipping phases — the two phases most likely to get skipped are the ones that matter most:

- **Design Plan before code** (Phase 2) — token system, type scale, signature element, self-critique against generic template defaults. Skipping this is what shipped Garage Sale Planner looking templated.
- **Brand & Visual QA as its own pass** (Phase 5) — not folded into general QA. Checks border-radius, box-shadow, fonts, banned words, and whether the tool has one element that couldn't be mistaken for a generic competitor's.

Zero border-radius has no exceptions — not even pill-shaped buttons.

**Exception (2026-07-03/04, Cece's explicit call):** `widgets/garage-sale-planner/widget.html` now uses rounded corners (`--radius-sm/md/lg/xl/full: 6/10/14/20/9999px`) and soft box-shadows on cards (`0 10px 40px rgba(37,37,53,.07)`, borders removed), matching a wireframe Cece provided. Card titles and the hero headline use Lora weight 300 instead of 700. This is a deliberate, one-file-only deviation — every other widget and the main site remain zero-border-radius/zero-box-shadow. Do not silently "fix" this back to square/flat/bold, and do not extend any of this to another widget without a new, explicit instruction from Cece.

---

## ACTION ITEMS — FIX NOW

*(None — all clear as of 2026-07-05. The Digital Payments help guide action item below was resolved this session.)*

## BACK BURNER (not urgent — do not touch without a new brief)

- **Quiet House Meter** — widget was never built (no folder in /widgets/). Removed from homepage and resources page 2026-06-21. DB record set to `draft` 2026-06-21. Do not rebuild without Cece's go-ahead.
- **30-Day Goal & Habit Tracker** — live widget, $27, but needs full visual rebuild to match Cooking for One style. Current code is narrow/popup layout. No brief written yet. Widget folder currently has no index.html (deleted as security fix). Back burner until Cece is ready with a brief.
- **Weekly Reset Planner** — local file only, pre-rebrand colors/fonts, not live. Needs brand audit before going up.
- **New Grandma Planner** — high priority when ready to build, but not started.

## COMPLETED — 2026-06-22

- ✅ Exclusive unlock cron registered in Hostinger hPanel — daily at 9 AM (`0 9 * * *`)
- ✅ Blog Post #1 built — `site/add-blog-post-1.php` (one-time insert script; delete after running). Slug: `what-i-do-at-6pm`. Renders at `/blog/what-i-do-at-6pm`. Appears on `/blog` index automatically (newest first).
- ✅ Smart redirect `site/6pm-cheat-sheet.php` — logged-in → `/dashboard`, logged-out → `/6pm-experience/`. Route added to `.htaccess`. This URL is safe to use in all CTAs and social posts permanently.

## COMPLETED — 2026-06-21

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

Drop order:

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
- Know Before You Sell — a full brand-compliant build (correct tokens, Lora/DM Sans, no border-radius/box-shadow found) was discovered live on Hostinger 2026-07-01 at `widgets/know-before-you-sell/widget.html`, undocumented here and with no GitHub backup. Archived to the repo and pulled off the live site pending Cece's review — do not redeploy until she confirms it's the intended version and it goes through Phase 5 (Brand & Visual QA) properly. The old off-brand `WhatsThisWorth.html` build under the retired name is separate and should still not be used as a starting point.
- The Quiet House Meter — back-burner; widget never built; removed from homepage + resources page; DB record needs → draft via phpMyAdmin

---

## DESIGN SYSTEM QUICK REFERENCE

Full palette and typography rules live in the brand skill file — below is just enough to catch an obviously wrong color or font in code review.

**Core colors:** Velvety Charcoal `#252535`, Vanilla Cream `#FFF8EE`, Vibrant Pink `#E87AAA` (primary signature), Lavender `#C4B0E8`, Powder Blue `#A8C5DA`, Periwinkle `#8BA7D4`, Peach `#F2A57A`, Soft Peach `#F5C4A8`, Lemon `#EDD96A`, Lime `#B5CC6A`, Light blush `#facfd4`.

**Retired — should never appear in new code:** Deep Berry `#811453`, Dark Berry `#5E1337`, any Berry shade, Muted Mauve `#A3918A`, Warm Blush `#D6C2B7`, Sage Gold, Peach Tan, Sage Gray, Blush Pink `#F8D4D4`, Linen White, Soft Rose, Warm Cream `#F4E8C1`, Warm Tan, Coral Orange, Teal, Gold, Navy.

✅ `site/about.php` confirmed clean — no retired colors (checked 2026-06-22).

**Fonts:** Montserrat ExtraBold (headlines, display), Arial Regular (body/print). HTML tools only: Lora (display) + DM Sans (body).

---

## REVIEW PROTOCOLS

For widget UX reviews, see REVIEW_PROMPTS.md in the repo root.

---

## BUILD GATES — MANDATORY, NO EXCEPTIONS

These are not reminders. They are enforced steps. Claude Code runs them automatically.
Cece should not have to remember to ask for any of this.

The GitHub Action (`.github/workflows/mnc-qa.yml`) runs automated rule checks on every push — retired colors, border-radius, box-shadow, wrong fonts, banned phrases. Gates 1–3 below are the session-level layer that the GitHub Action can't replace.

---

### GATE 1 — Before Any Code Starts (New Widget)

**Trigger:** Cece mentions building a new tool, names a product not yet started, or a new folder is detected under /widgets/ with no index.html.

**Behavior:** STOP. Do not write a single line of HTML, CSS, or JavaScript. Ask these five questions first — all five, in order:

1. What is this tool? (One sentence — not a list of features.)
2. Who specifically is using it and when? Not "solo moms" — one specific person, one specific moment. Example: "A solo mom who just filled two boxes of her kid's stuff and doesn't know what to price any of it."
3. What is the exact pain point it solves? One sentence. She should feel seen.
4. What are the 5–8 features that directly serve that pain point? Flag anything that is nice-to-have but doesn't serve it.
5. What is the price point, and does the scope match that tier?

Do not proceed to Gate 2 until all five questions are answered. Do not start any design work while waiting for answers.

---

### GATE 2 — Design Plan Before Build

**Trigger:** Immediately after Gate 1 answers are in.

**Behavior:** Produce a design plan. Do not write a single line of HTML, CSS, or JavaScript until this plan is approved by Cece.

The plan must cover:

**Token system** — Which of the locked colors serves which role in this tool. Name the roles specifically: background, primary action, secondary, accent, text. Do not just list the palette. Assign colors to purposes.

**Type scale** — Sizes and weights for display headers vs. body copy. Lora for display. DM Sans for body. No other fonts, ever, in widget files.

**Layout structure** — Describe each section or tab in 1–2 sentences. What does the user see first? What comes next? How does it flow?

**Signature element** — ONE thing in this tool that could only be My Nest Chapter. Not a generic icon. Not a gradient. Something tied to the actual pain point or the content of this specific tool. If you can't name it, the design isn't ready.

**Self-critique** — After producing the plan, ask: does any part of this look like a generic template default? (Rounded cards, soft shadows, a big centered stat, stock illustration.) If yes — fix it, and say what changed and why before showing Cece the plan.

Then stop. Show Cece the plan. Wait for "approved." Silence is not approval. A question is not approval. Only the word "approved" or an explicit "looks good, build it" unlocks Gate 3.

---

### GATE 3 — Session End QA (Every Session Where Code Was Touched)

**Trigger:** Cece indicates she is done for the session, or a natural stopping point is reached after any code was written or modified.

**Behavior:** Run both steps below automatically, without being asked. Do not wait for Cece to remember to ask. Do not skip either step. Do not end the session without completing both.

**Step 1 — Technical QA** (run silently, fix everything found, then report)

Input validation:
- Every number field: test negative numbers, letters, empty input, and an unreasonably large number. Does the field handle all four without crashing?
- Every text field: test empty input and extremely long text (200+ characters). Does it handle gracefully?
- Every required field: what happens if the user clicks submit or proceed without filling it in? Is the behavior clear?

Mobile at 375px (iPhone SE — the smallest common screen):
- Does anything overflow horizontally?
- Does any text clip, stack awkwardly, or become unreadable?
- Are all buttons large enough to tap (minimum 44px touch target)?
- Does the tab/nav system work at this width?

localStorage resilience:
- What happens on first load with zero saved data? No crash, no blank error.
- What happens if localStorage is cleared or corrupted mid-session? The tool should recover gracefully, not throw a JS error.

Every button and interaction:
- Click every button. Does each one do exactly what its label says?
- Does every input that should save to localStorage actually save?
- Does clearing/resetting actually clear the right data?

Fix every issue found. Do not ask permission to fix obvious bugs — fix them.

**Step 2 — Brand & Visual QA** (run silently, fix everything found, then report)

CSS rule checks (grep the file):
- border-radius: any value other than 0 is a violation in widget files. Find it, fix it.
- box-shadow: any value other than none is a violation. Find it, fix it.
- Hex colors: only `#252535 #FFF8EE #E87AAA #C4B0E8 #A8C5DA #8BA7D4 #F2A57A #F5C4A8 #EDD96A #B5CC6A #facfd4` allowed. Everything else: flag and fix.

Font check (widget files only):
- Grep for Montserrat or Arial anywhere in a /widgets/ file. Replace with Lora (display/headers) or DM Sans (body). No other fonts allowed in widgets.

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
- "it's enough" and all variations ("that's enough," "you are enough," "that is enough") — delete on sight
- "that's not nothing" and all variations ("that's something," "that matters," "that counts") — delete on sight

Signature element check:
- Does this tool have ONE element that could only be My Nest Chapter — not something a generic productivity or planner app would have?
- If the answer is no or unclear: flag it and propose one specific addition tied to the actual content or pain point of this tool.

Fix every violation found. Do not ask permission — fix and report.

**Step 3 — Close-out report**

End every session with exactly one of these two lines:

"QA complete. All checks passed. Safe to deploy."

"QA complete. Found [N] issues — all fixed. Safe to deploy."

If there is anything that cannot be fixed in session (e.g. a design judgment call that needs Cece's input), flag it explicitly before closing:
"One item needs your call before this is safe to deploy: [describe it]."

**If Cece tries to close out before QA has run:**

Ask: "QA hasn't run on the code we changed. Run it now before we close out?"

Do not let a session end with unreviewed code. One prompt is enough — do not nag, but do ask once.

---

### GATE SUMMARY

| Gate | Trigger | What it prevents |
|---|---|---|
| 1 — PM Define | New widget, no index.html | Building the wrong thing before the pain point is confirmed |
| 2 — Design Plan | After Gate 1 answers | Code written before anyone thought about what it should look like |
| 3 — Session QA | Any session with code changes | Bugs, retired colors, wrong fonts, and banned language reaching Hostinger |

GitHub Action is a second layer — it catches the same CSS and color violations automatically on every push. Gates 1–3 are the session-level layer. Both are required. Neither replaces the other.

---

## CHANGE LOG

**2026-07-06 (July 2026 rebrand palette applied to Garage Sale Planner)** — Cece shared `MNC_Color_Reference_July2026.html` (source of truth: brand skill v4, updated July 5 2026) confirming a second color rebrand on top of the 2026-07-02 contrast fix below: Deep Rose `#C44570` replaces Vibrant Pink `#E87AAA`/the widget's own darkened `#D92674`; Warm Antique White `#FAF7ED` replaces Vanilla Cream `#FFF8EE`; Powder Blue `#A8C5DA`, Peach `#F2A57A`, Lemon `#EDD96A`, and Lime `#B5CC6A` are retired outright. Applied to `widgets/garage-sale-planner/widget.html` only (Cece's ask was "just the garage sale updated" — rest of the site/other widgets still pending, flagged for a future session). Confirmed `#C44570` alone passes WCAG AA against white (4.74:1) so the old widget-specific contrast override is no longer needed; recomputed the button hover/active shades proportionally off the new base (hover `#A33359`, active `#7C2743`, replacing `#AE1E5C`/`#831645`/`#DA2573`) rather than hand-picking new ones, preserving the existing "Sweet Peony" darken-one-step/darken-two-step convention from the 2026-07-05 pass. Two retired colors had no direct replacement given in the doc (Lemon/Lime — flagged there as "wrong emotional register," no redundant-with pairing) and needed a judgment call since this file uses them across a 7-color category-chip system (sale/online/donate/keep/kids/trash/notsure) plus weather-icon accents: reassigned within the now-16-hex approved set so every chip stayed visually distinct — donate → Periwinkle `#8BA7D4`, keep → Peach Tint `#FCF0E8`, kids → Soft Peach `#F5C4A8` (this one *is* the doc's direct Peach→Soft-Peach mapping), trash → Warm Brown `#6D4C3E` w/ Warm-Antique-White text (previously a plain gray-tan; brown reads better semantically for "discard" and solves the neutral-gray retirement at the same time), notsure moved off Soft Peach to Peach Mid `#EFA276` since kids took that slot. "Good/success" indicators (sale-weather dot, goal-reached text) → Lavender `#C4B0E8`, kept separate from the donate-chip's Periwinkle so the two roles don't collide. Also brought two off-palette grays (`#4B4B4B` tour-step text, `#9a9a9a` date-picker placeholder) in line with the file's existing approved `#6e6e6e` microcopy color — not part of the July rebrand list but violated the "only locked hex values" rule regardless. Left untouched: Google/Outlook "Add to Calendar" icon colors (`#4285F4`/`#EA4335`/`#0078D4`) — third-party service branding, not MNC palette; plain white `#FFFFFF` card fills — not a retired color, no rule against it; the 2026-07-03/04 rounded-corner/box-shadow exception above — colors only, radius/shadow untouched. Verified: full hex audit post-change shows only approved palette + `#6e6e6e` + recomputed button states + third-party icon colors remain; line count unchanged (4247) confirming no structural edits; border-radius/box-shadow/font grep confirms the existing exception and Lora/DM Sans-only rule are both intact.

**2026-07-06 (Sell + Promote rebuild)** — Implemented `SellPromote_ClaudeCode_Brief.md` in `widgets/garage-sale-planner/widget.html`. The Sell + Promote tab was NOT empty going in — it already had two live sub-tabs (Online Selling: a 7-platform guide table; Ads + Signs: a per-platform ad-template accordion, a "where posted" checklist, sign builder, sign templates) that the brief didn't know about and directly overlapped with all three sections it asked for. Did a targeted swap rather than a blind replace or a 5-tab pile-up: kept the online-sale items table and the entire Signs system (sign builder, sign templates, featured-items field) since the brief never touched them; replaced the old platform table with the brief's locked 8-card Platform Guide (Facebook Marketplace, Nextdoor, Craigslist, eBay, Poshmark, Mercari, ThredUp, Kidizen) plus a "marked as posted" tracker; replaced the old per-platform ad accordion with the brief's single live-updating Ad Builder (auto-pulls date/address from the Start tab, Copy Ad button); added the brief's brand-new 3-tier "Promote Your Sale" timeline checklist, which had no predecessor. Net result: 3 sub-tabs instead of 5 (Promote → Write Your Ad → Sell Online), no duplicate ad-builders or duplicate platform guides sitting next to each other. Data model: added `sellPromote` (promoteChecklist/adBuilder/platformTracker) to `blankPlanner` + `normalizePlanner`; trimmed `advertising` down to just the fields Signs still uses (featuredItems, signHeadline, signDetails, signsPrinted) — old fields (adCopy, facebookPosted, nextdoorPosted, localGroupsPosted) drop out of new saves but are left harmless in old users' existing localStorage rather than force-migrated. Added the required Wrap Up tab callout card pointing back to the platform guide. Used the existing `mncConfirm()` inline-confirm helper (already in the file, not `window.confirm()`) for both new "clear" actions. New CSS/copy follows this file's *current* approved conventions, not the brief's literal spec, where the two conflicted: the brief's spec called for grey (`#ABABAB`) "Clear"/"Start over" link buttons, but the 2026-07-05 pass below had explicitly fixed grey ghost-buttons to brand pink ("they're buttons") — caught this on review and switched the new Clear/Start Over buttons and the "Pulled from your Start tab" caption to the current approved pink-button/`#6e6e6e`-caption convention instead of the brief's literal (now-outdated) colors. New cards/checkboxes inherit the widget's existing 8px-radius/soft-shadow style from the 2026-07-03 exception below (not a violation — that decision already stands). Verified with Playwright (headless Chromium already cached locally from a prior unrelated project, no browser install added to this repo): 3 localStorage migration scenarios (fresh/old-shape/partial-new-shape) all merge with no data loss; desktop + 375px mobile screenshots show no horizontal overflow; Ad Builder output updates live on every keystroke without losing input focus; Copy Ad button fires the exact toast copy from the brief. No new border-radius/box-shadow/off-palette hex, no banned words, no emojis.

**2026-07-05 (Garage Sale Planner — full hierarchy/contrast/layout sweep)** — Cece asked for a full pass on font weights plus a contrast/layout check. Found and fixed: 17 inline "eyebrow caption" elements (Preview, Earned so far, Give back, Counter-offer, Bundle price, Print Center form labels) were gray+bold-700 instead of medium-weight charcoal per her Form Label/Table-Header buckets — fixed via a targeted script matching only that specific uppercase+gray+bold combination so unrelated bold text (prices, names) wasn't touched. 12 Help-panel h4 sub-headings were weight 800 like a full header — her spec puts sub-headings in the medium bucket, changed to 500. "Set a date to see the countdown" was inheriting the 28px/bold/Lora `.metric-value` style meant for short results like "5 days to go" — now renders 16px/regular/DM Sans when no date is set. Contrast/layout audit: no new contrast issues, mobile tab bar looks clipped but has `overflow-x:auto` (not a bug), no horizontal page overflow, zero console errors across Start/Prep/Sale Day/Print Center/Help on desktop and mobile. Committed, pushed, deployed.

**2026-07-05 (Garage Sale Planner — hero-title still not bold)** — Cece asked if "Your New Spaces" should be bolder; checked `.hero-title` and it was weight 300 (light), missed by both prior type-hierarchy passes. Fixed to 700. Left `.hero-stat-value` (the big "0"/"0%" numbers) at its existing light weight — different role (numeric display, not a heading) and a common deliberate dashboard convention; flagged rather than changed without her call.

**2026-07-05 (Garage Sale Planner — hero/nav text missed by type pass)** — Cece screenshotted the live site and caught two spots the type hierarchy pass didn't reach: `.tab-btn` (top-level Start/Sort+Price/etc. nav) was still gray when inactive, and `.hero-label`/`.hero-sub`/`.hero-stat-label` (the "MY NEST CHAPTER" eyebrow, tagline, and "ITEMS CATALOGED"/"ITEMS PRICED" stat labels) were still gray instead of charcoal — separate CSS classes from `.sec-btn`/`thead th` fixed earlier, so they'd been missed. Fixed to match: nav tabs pink/semibold, labels/tagline charcoal. Verified via screenshot, zero console errors. Committed, pushed, deployed.

**2026-07-05 (Garage Sale Planner — full type hierarchy pass)** — Cece asked for a factual audit of the current text setup, which turned up: `.card-title` was weight 400 (not bold), `.page-title` was 600, form labels were Lora+bold+13px instead of body-bucket styling, buttons/nav used Lora instead of DM Sans, and body-copy text (`.card-sub`/`.page-sub`) was colored the same gray as genuine microcopy instead of charcoal per her spec (headers: bold `#252535` 18-22px; body/labels/table-headers: medium/regular `#252535` 12-16px; microcopy/captions: `#6e6e6e` 12px; buttons/links/nav: semibold brand pink 14px, all DM Sans except headers). Fixed all of it: headers now bold, form labels moved to the body bucket (DM Sans/500/14px), body copy separated from microcopy (charcoal vs gray), table headers and topbar stat labels (previously gray) now charcoal, every button (including ~10 inline-styled ones still on Lora — confirm dialog, tour overlay, help back-link, weather retry, buyer-payment close) switched to DM Sans/600/14px, nav tabs (`.sec-btn`) now stay brand pink even when inactive instead of turning gray, base `<a>` tag got font-weight 600. Verified via Playwright screenshots (Start tab + Sort/Price tab), zero console errors. Committed, pushed, deployed.

**2026-07-05 (Garage Sale Planner — pink standardized to Cece's Sweet Peony palette)** — Cece pointed out the whole point of giving the shade-range palette was for button/state colors to come from it consistently. Found the root cause: `--color-primary-hl`/`--color-surface-2` (the token driving ~13 hover/tint surfaces) was still the old `#facfd4`, not shade 50 (`#FBE9F1`) — fixed the token plus 16 hardcoded copies of the old hex. Also caught a contrast bug in my own earlier active-state fix: `.btn-secondary`/`.btn-ghost`/`.sec-btn` active state used shade 200 (`#F0A8C7`) as background with white text, which fails contrast at that lightness — switched to shade 500 (`#DA2573`). `.btn-danger` intentionally still uses Peach, not the pink scale (distinct hue for destructive actions) — flagged to Cece, not changed without her call. Committed (`3ce23ff`), pushed, deployed.

**2026-07-05 (Garage Sale Planner — remaining blue/grey purged)** — Cece caught more instances the previous pass missed: `#A8C5DA` (Powder Blue) as chip-trash background, weather chart/icon accents, Sale Complete dark-card labels, and a disabled arrow — all replaced with on-palette neutrals. `#ABABAB`/`#D3D3D3` grey borders on the Quick Notes FAB and memory-status chips → brand pink (they're buttons); structural hairlines → existing `var(--color-border)`. Also caught: my own fix had introduced Lavender (`#C4B0E8`) as replacement text color in two spots — Cece said no lavender either, swapped to the translucent-cream convention already used elsewhere in the same dark card. Left Lavender as a pre-existing background fill on chip-online/tour-banner/confetti alone (established status-chip color-coding, predates this session) — flagged to Cece, not touched without her call. Committed (`f0d3dcc`), pushed, deployed.

**2026-07-05 (Garage Sale Planner — text color, button states, radius rebalance, custom calendar)** — Follow-up in a new chat after Cece reviewed the Start-tab layout pass above and flagged three things that pass hadn't touched (it was a separate conversation from this one, so it couldn't know about these): blue text still visible, buttons with no hover/click feedback, and the calendar/dropdown not matching brand pink. Fixed all three plus one she caught mid-fix: (1) `--color-text-muted`/`--color-text-faint` were `#426DB3` (blue, the 2026-07-02 contrast-fix color) — changed to `#6e6e6e` per Cece's new type-hierarchy spec (18-22 bold `#252535` headers, 14 medium/regular `#252535` body/labels, 12 `#6e6e6e` microcopy/captions, 14 semibold brand-pink buttons/nav/links), including ~40 hardcoded (non-variable) instances in print/sign-preview templates; also fixed the `.select` dropdown arrow SVG, which was hardcoded to retired Periwinkle `#8BA7D4`, to brand pink. (2) Added a 3-step interactive-state system using Cece's Coolors "Sweet Peony" palette (base ~`#E97CAB`/300, `#DA2573`/500 ≈ existing `#D92674`): hover = one shade darker, active/press = two shades darker, with `.sec-btn.active` (selected tabs) staying a flat solid fill so persistent-selected reads differently from a momentary hover/press — `.btn-primary` previously had hover/active hardcoded to the identical base color, which is why nothing looked like it was responding to clicks. (3) Cece asked for industry-standard corner radius research: buttons/inputs/cards 6-8px, pills/chips/badges fully round (9999px) is the actual convention — the prior uniform-12px pass (which technically also applied to `--radius-full`) was flattening chips into rounded rectangles instead of true pills. Rebalanced to 8px for buttons/cards/inputs, restored `--radius-full` to `9999px`. (4) Replaced native `<input type="date">` for Sale date / Backup date with a custom popup calendar (month grid, prev/next nav, today indicator, pink selected-day fill, "Today" shortcut) — native OS date pickers can't be restyled via CSS at all, which is why the earlier "light hover/focus tint on the picker icon" compromise (logged below) still didn't look brand-colored. New picker reuses the existing `sf()`/`deepSet` state-update path (so countdown/weather/save side effects still fire) via a small `deepGet()` helper that didn't exist yet. Time fields were left as native inputs with the existing pink tint — only date fields were in scope. Verified via local Playwright screenshots (desktop + mobile) and a live click-through of the picker (open → pick a date → confirmed Sale Countdown card updates correctly); zero console errors. Committed (`e9a1d3c`), pushed to GitHub, deployed to `widget.html` on Hostinger.

**2026-07-05 (Garage Sale Planner Start-tab layout pass + Help panel resurrection)** — Cece asked for the tool to feel more professional and gave a punch list of 18 concrete Start-tab/layout items. Implemented all of them in `widget.html`: topbar right-aligned (goal/bell/save) via `justify-content:space-between` with the old topbar "How it works" button removed; footer gained a "Help" link that opens the pre-existing `openHelp()`/`helpTopics` topic-list system instead of the retired single-panel `openHowTo()` explainer — this resolves the Action Item above about the orphaned Digital Payments guide, which is reachable again. That old explainer's content (saving, the 5 sections, Memories, Print Center, Reset Everything, Email Cece, retake-tour) was folded in as a new first topic, "How This Tool Works," rather than deleted, so nothing was lost; `openHowTo`/`closeHowTo`/`retakeTour`/`renderHowToOverlay` and the `howto-overlay` div were removed as dead code once nothing referenced them. Reset Everything moved from the Start-tab sidebar into the footer next to Help. Background `#FDFBF7` → `#fffafa` (page body + `--color-surface-3`); container max-width `1400px` → `1140px` across topbar/hero/section-nav/content to tighten the layout, per Cece's request. Money goal card's pink "not just a number" tip banner removed. Hero stat "Set For Yard Sale" renamed "Items Priced" — backed by a new `itemsPriced` stat (count of items with a price entered) rather than repurposing the existing `garageSale` (Garage-Sale-decision count) stat, since that one is still read by the sale-summary email payload (`garage_sale_items`) and repurposing it would have silently changed that email's data. Sale Setup form: added "Your first name" and a real "Sale start time" field (previously only end time existed), added a "Tap to Pin Sale Location" button using `navigator.geolocation` + a free Nominatim reverse-geocode call (no API key, no backend) to auto-fill the address, and reordered fields into date/backup-date and start-time/end-time two-column rows. Native date/time inputs got a light brand-pink hover/focus treatment on the picker icon (chose a quick native-picker restyle over a fully custom calendar build — Cece's call after I flagged the tradeoff). Save button's oversized inline padding override removed, now matches standard `.btn-primary` sizing. Added "Welcome back, {name}." replacing "Your New Spaces" once `setup.yourName` is saved, updating live via `sf()`. Sort+Price tip typo "50 cents" → ".50¢" per Cece's exact spec. Quick Notes floating button — flagged earlier in the session as overlapping mobile content — shrunk from a wide text pill to a small 44px icon-only circle, moved to sit at the true bottom-right corner (`bottom:16px`) instead of a fixed `bottom:70px` that pushed it into mid-screen content, and now only lifts to clear the earnings sticky-bar (`.lift-above-bar` class, toggled in `refreshStickyBar()`) when that bar is actually visible. Verified with a local Playwright script (no login available for the live gated URL, but `index.php` just does `readfile('widget.html')` with no templating, so the local file is byte-identical to what a logged-in customer sees) — screenshotted desktop + mobile, clicked through Help → topic → back, typed the name field and confirmed the live greeting update, and triggered Reset Everything's confirmation dialog from its new footer location. Zero console errors. Committed (`498a2c6`), pushed to GitHub, deployed to `widget.html` on Hostinger.

**2026-07-04 (Garage Sale Planner — full revert to pre-session commit, radius reapplied)** — Cece said "everything looks worse" and asked to undo her own prior edit while keeping today's radius/color asks. Diffing against the last commit (`61c855d`) showed her edit was much bigger than the two entries below implied — it reformatted/restructured most of the file's CSS (8,000+ changed lines: base rules, topbar class names, spacing scale inflated, fluid `clamp()` type scale flattened to fixed rem, box-shadow tokens changed from `none` to real values), not just the handful of header variables those entries described. Rather than hand-merge an 8k-line diff, restored `widget.html` fully to commit `61c855d` (last known-good state) via `git checkout 61c855d -- widgets/garage-sale-planner/widget.html`, then reapplied only the approved 12px uniform radius (`--radius-sm/md/lg/xl/2xl/full` all set to `12px`, plus the one hardcoded `border-radius:8px` on `.input,.select,.textarea` switched to `var(--radius-md)`) on top of the restored original. Net effect: `--color-primary`/`--color-primary-hover`/`--color-primary-active` are back to `#D92674`, `--color-text-muted`/`--color-text-faint` are back to `#426DB3` (the original 2026-07-02 WCAG-AA fix values — better than the `#707082` patch logged below, which is now moot), spacing/type-scale/shadows/topbar structure are back to the pre-edit original, and radius is uniform 12px. The two entries directly below (radius-superseded and contrast-regression) describe work that has since been superseded by this full revert — kept for history, but the color values and diff sizes they cite no longer reflect the live file.

**2026-07-04 (Garage Sale Planner radius superseded to uniform 12px)** — Cece asked for a "mathematically identical" rounded-square radius across all cards/forms/inputs/buttons in this widget, then asked for the professional-standard value; recommended 12px (common SaaS default, close to the prior --radius-md/lg values) and she approved. All radius tokens (`--radius-sm/md/lg/xl/2xl/full`) changed from the 6/10/14/20/9999px scale to a flat `12px` each — this supersedes, not deletes, the 2026-07-03 exception entry below (the "rounded corners in this one widget" override still stands; only the specific pixel values changed). One stray hardcoded `border-radius:8px` on `.input,.select,.textarea` (line 399) was also switched to `var(--radius-md)` so it stays in sync. Left untouched: `.night-before-cb` checkbox (`border-radius:0`, intentionally square, not a card/form/button); `#D92674` (Cece explicitly declined to revert this to base `#E87AAA` — the 2026-07-02 WCAG-AA contrast fix stays); box-shadow on `.card` (unchanged, not part of this ask). No Tailwind added — this file has none, all changes made via existing CSS custom properties. No JS/backend logic touched.

**2026-07-04 (Garage Sale Planner — header variable contrast regression caught and fixed)** — Cece's own prior edit to the `:root` token block (made before this session, ahead of the radius request above) had quietly changed `--color-primary` from `#D92674` to `#e87aaa` and `--color-text-faint` from `#426DB3` to `#8c8ca3`. Because most buttons hardcode `#D92674` directly, this wasn't visible on buttons — but ~90 other elements that reference `var(--color-primary)` (links, active tab underlines, progress-bar fills, pricing numbers, sign/tag previews, help-panel arrows) were silently rendering at the pre-fix `#e87aaa` (~2.69:1, fails WCAG AA), directly contradicting Cece's explicit "keep #D92674" answer earlier in the same session. Caught via `git diff` against the last commit before pushing. Fixed: `--color-primary` restored to `#D92674`; `--color-text-faint` measured at ~3.28:1 (also failing AA) and darened to `#707082` (~4.8:1), same hue family. `--color-text-muted` was also changed by her edit (`#426DB3` → `#5c5c70`) but measured ~6.5:1 — passes AA comfortably, left as-is. `--color-primary-hover`/`--color-primary-active` (now `#d66596`/`#c45384`) are only used for an unused CSS alias and a checkbox `accent-color` (UI-component contrast rules, not text contrast) — not a regression, left as-is. Lesson: when a user says they've hand-edited a file's CSS variables, diff against the last commit before building on top of it — variable-level edits can silently cascade into contrast regressions that don't show up by reading the file top-to-bottom.

**2026-07-03 (Garage Sale Planner rounded-corner exception)** — Cece explicitly asked to override the site-wide zero-border-radius rule for this one widget, to match a wireframe reference. Implemented via the widget's own `--radius-*` CSS custom property scale (6/10/14/20/9999px), which cascaded through 37 `.card` instances plus chips, pills, tables, and progress bars automatically. Also manually added radius to ~15 inline-styled elements that had no radius property at all (Start tab cards, form inputs, confirm dialog, tour cards, help/how-it-works modals, bell panel, quick-notes pad). Box-shadow was left at `none` — not part of the ask. Scoped to this file only; noted as an explicit exception above so it isn't reverted by mistake in a future session.

**2026-07-03 (Garage Sale Planner nav + copy pass)** — Fixed nav redundancy: topbar had four help touchpoints (`?` icon, "How it works," "Help," plus an in-form "How it works →"). Removed the `?` icon and "Help" buttons; the one surviving topbar "How it works" link now opens the fuller reference panel (`openHowTo()` — saving behavior, the 5 sections, Memory Box, Print Center, Reset, "Take the tour again," Email Cece) instead of jumping straight into the interactive tour. The in-form "How it works →" button is unchanged and still launches the tour directly. This orphaned the Digital Payments help guide that lived behind "Help" — logged above under Action Items, needs Cece's call on where it goes. Also moved the three donation-center fields (name/phone/address) from the Start tab to Sale Day + Wrap Up, next to the Leftovers plan card where the info is actually used — data binding is global so nothing else broke. Copy fixes: "we'll pull the forecast" → "I'll pull the forecast" (voice consistency, only instance in the file), and rewrote the garbled Money Goal tip ("designer purse that I'd been saying someday to for so long" → "designer purse I'd been telling myself 'someday' about for years") in both `widget.html` and `GarageSalePlanner_Tips.md`. Deployed to live server via FTP to `widget.html` (not `index.html`), committed and pushed to GitHub (`19e0e04`). Admin panel Action Items checklist (`site/admin/sections/stats.php`) updated to match.

**2026-06-19** — Created this file. Logged the two banned-language fixes found in `seed-products.php`, `index.php`, and `workbook.php`. Documented full dashboard gating logic and per-product placement table from the June 13 planning session, which had been locked in chat but never made it into code.

**2026-06-19 (correction)** — The 6pm Survival Plan and Who Am I Now are NOT live. Confirmed against `dashboard.php`: no exclusive content section exists in the code at all. Past session notes marking these "Built ✅" meant content was finished, not that they shipped. Added "build the exclusive content section" as the first action item — both PDFs are ready to upload the moment it exists. Full 7-item drop queue documented above.

**2026-06-21** — Garage Sale Planner design pass complete. Fonts → Lora + DM Sans, all border-radius removed, all box-shadows removed, emoji weather icons replaced with text labels. Backup date field + HOA permit checklist item + rain warning added. Security: deleted unprotected `index.html` duplicate. Product Catalog corrected: Garage Sale Planner is live at $27 (was "built, not yet listed for sale" — stale).

**2026-06-21 (session 2)** — Quiet House Meter removed from site: card deleted from `site/index.php`, link deleted from `site/resources.php`. Widget was never built — nothing in /widgets/ to remove. DB record still active; needs phpMyAdmin → `draft`. `seed-products.php` deleted from repo (was stale after DB was hand-updated via `add-widgets.php`; `INSERT IGNORE` made it useless). Security: deleted unprotected `index.html` files from cooking-for-one and goal-habit-tracker widget folders. Product Catalog updated: added Cooking for One ($27) and Goal & Habit Tracker ($27, visual rebuild pending). Goal & Habit Tracker moved to back burner — needs a brief before any visual work.

**2026-06-25** — Build Gates added to this file. Drip system confirmed fully built: dashboard.php has exclusive content section, `getUnlockedExclusiveContent()` and `getNextExclusiveUnlock()` both exist in functions.php, countdown + fallback state both live. GarageSalePlanner_Tips.md (59 tips, brand-checked) added to repo.

**2026-06-25 (session 2)** — Two new banned phrases added: "it's enough" (all variations) and "that's not nothing" (all variations) — confirmed banned by Cece June 24. GarageSalePlanner_Tips.md updated to 57 tips: Memory Box tip 3 → t-shirt story, Money Goal tip 5 deleted (banned phrase), Wrap Up tip 5 deleted (banned phrase).

**2026-07-01** — Merged `MNC_Interactive_Product_Build_Process.md` into `MNC-BUILD-PLAYBOOK.md`. The two files had drifted and directly disagreed on one rule: the old Playbook allowed a border-radius exception for pill-shaped buttons; the newer Interactive Process doc (written after diagnosing why Garage Sale Planner looked templated) said zero border-radius, no exceptions. Resolved in favor of zero, no exceptions — pill buttons are the same pattern already flagged as a compliance issue on the homepage. `MNC_Interactive_Product_Build_Process.md` is now retired; delete it. Added the Build Process pointer section above so this file stays lean but the playbook never gets skipped.

**2026-07-01 (resolved)** — "What's This Worth" renamed to **Know Before You Sell** in the catalog above and marked not-built-to-current-standard. The existing `WhatsThisWorth.html` file is off-brand (retired colors, Montserrat, border-radius, emojis) and should not be used as a starting point — treat as a fresh build via the Build Playbook, Phase 2 onward.

**2026-07-01 (server audit)** — Cece asked for a sweep of outdated/stale files across GitHub and Hostinger. GitHub tracked files were clean. Live server had two real issues: (1) `widgets/garage-sale-planner/index.html` was a stale, unprotected duplicate from June 16 sitting next to the current `widget.html` — predates all the June 21+ fixes (fonts, border-radius, box-shadow, HOA permit, rain warning) and was directly reachable. Deleted from the server. (2) `widgets/know-before-you-sell/widget.html` was live and already brand-compliant, but undocumented here and with no GitHub backup — archived to the repo (commit f6183d9) and removed from the live site pending Cece's review, since the catalog said this product wasn't built yet. Also flagged but not yet resolved: `setup-database.php` (installer script, explicitly meant to be deleted after first run) and `gen-hash.php` (contains the live account password in plain text) are both still sitting in the public web root — needs a decision from Cece.

**2026-07-01 (file consolidation)** — Reconciled four drifted copies of this file (`CLAUDE.md`, `Claude_md.md`, `CLAUDE_md_additions.md`, `CLAUDE_md_June24_additions.md`) that had accumulated in Project Knowledge. Confirmed against the live GitHub copy that the Build Gates section and the June 24 banned-phrase additions were already merged in; the only content that hadn't made it live was the two 2026-07-01 entries above (Build Playbook merge, Know Before You Sell rename). This file now reflects all of it in one place. The three superseded files should be deleted from Project Knowledge; this file replaces them.

**2026-07-02 (Garage Sale Planner contrast fix)** — Contrast audit found `#8BA7D4` (Periwinkle, used as muted/faint body text) and `#E87AAA` (Vibrant Pink, used as primary accent/link/button text) both fail WCAG AA against white/cream backgrounds (2.45:1 and 2.69:1 measured; AA requires 4.5:1) — meaning labels, table headers, stat values, and links would wash out badly in direct sunlight. Cece approved darkening both, scoped to this widget only: `#8BA7D4` → `#426DB3` (~5.16:1) and `#E87AAA` → `#D92674` (~4.69:1), same hue family, checked against the retired Deep Berry/Dark Berry range to avoid drifting into banned-color territory. All 99 occurrences (42 + 57) swapped in `widgets/garage-sale-planner/widget.html`. This is a deliberate, explicit deviation from the otherwise-locked palette for this one file — the rest of the site/other widgets still use the original `#8BA7D4`/`#E87AAA`. Not yet applied site-wide; flag to Cece if she wants the same fix elsewhere.

**2026-07-04 (Garage Sale Planner static tip strips)** — Implemented the `GarageSalePlanner_Tips_Implementation_ClaudeCode_Brief.md` spec in `widget.html`. Discovered mid-implementation that the file already had a *different*, previously-undocumented rotating tip strip (8-second auto-advance timer + prev/next nav arrows, `TIPS` object with 5–9 tips per section) — exactly the mechanism the brief says is cancelled. Removed it entirely (CSS `.tip-strip`/`.tip-nav` classes, the `_tipInterval`/`startTipRotation`/`tipNext`/`tipPrev` timer functions, and the old `TIPS`/`getSectionTips` lookup) and replaced with 11 static, locked `.section-tip` strips ("Cece —" label) at the bottom of their sections, verified by count with Playwright. Added a Night Before checklist (5 items) to the top of Prep with its own `P.nightBefore` state field, persisted through save/reload — the brief's own JS sample (a one-time `addEventListener` pass) would not have worked in this codebase since every tab switch replaces `#content` via `innerHTML`, orphaning listeners; used the same inline-`onclick` + full-rerender pattern as the rest of the app instead. Renamed Memory Box → Memories everywhere (nav label, headings, tour text, toasts, print pages, help panel) including the `P.memoryBox` → `P.memories` state field, with a migration in `normalizePlanner()` so planners saved under the old key still load their memories. Deliberately did NOT rename the `memory_box` key in the `/garage-submit.php` POST payload (site/garage-submit.php lives only on the server, not in this repo, and renaming a field a live PHP endpoint may read by name risked silently breaking the sale-summary email without being able to verify the other side). Flagged, not fixed: the brief's exact CSS uses `#D3D3D3` for the new tip-strip and Night Before hairlines, which isn't on the locked 11-color palette — left as specified since it's a subtle neutral divider matching the pre-existing (also off-palette) `#ABABAB` already used throughout this same file for hairlines/borders; needs Cece's call if she wants it swapped to an on-palette gray. Deployed: committed (`61e24ef`), pushed to GitHub, uploaded to `widget.html` on Hostinger (not `index.html` — see Deployment Setup memory).
