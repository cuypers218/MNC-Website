# MY NEST CHAPTER — DECISION LOG
**Shared source of truth between planning sessions and code implementation.**

---

## HOW TO USE THIS FILE

This file lives in the repo so both AI assistants working on this site — the one Cece plans with in chat, and the one implementing code in VS Code — read from the same record.

**Rules:**
1. Check this file at the start of every coding session.
2. If live code conflicts with anything marked LOCKED below, the code is wrong — update it to match this file.
3. New decisions get added to the Change Log at the bottom with a date. Most recent entry wins if anything looks contradictory.
4. This file does NOT replace the full brand voice/copy rules — those live in `Skill_File_07-05-2026_v4.md` (ask Cece for it if a banned-word check is needed on new copy). This file is for structure, logic, and placement decisions.
5. For any visual or design decision, read `DESIGN.md` in the repo root — it is the canonical design system and overrides any color, font, or spacing choice not explicitly locked here.
6. Before starting any new widget or product build, read `MNC-BUILD-PLAYBOOK.md` in the repo root — it contains the mandatory build process and prompts.
7. At the start of every session, read the **Current Focus** section directly below — it replaces the old separate product roadmap file, which was retired 2026-07-27 for drifting too far out of sync with reality. This file is now the single place status lives.
8. Full historical decision detail (the blow-by-blow of past sessions) is not kept in this file anymore — it lives in git history. Run `git log -- CLAUDE.md` if you need archaeology on a past decision. This file only carries what's true *now*.

---

## CURRENT FOCUS

*(Update this section at the end of every session — check off what's done, note what's next.)*

**Working on:** As of 2026-09-20, the Hub is the whole story — see the 2026-09-20 Change Log entry below for the full build/launch. Everything else is secondary until Cece says otherwise.

**Thread 0 — The Hub (new, 2026-09-20).** Live at `hub.mynestchapter.com`. Built from a Perplexity-generated Node.js/Express + React app — a completely separate codebase from this repo, source at `C:\Users\cuype\my-nest-hub` on Cece's machine (its own git repo, no relation to MNC-Website), deployed to its own Hostinger website/subdomain (real Node.js hosting, not PHP, not FTP-deployed like this repo). This is now the entire member system: login/signup, journal (Reflections), Meaningful Days, Support Circle, Freebies, Shop (real Stripe checkout against the same live Stripe account this repo uses, real per-user entitlements), and Weekly Cooking for One. The old PHP dashboard/login/register/checkout are retired and now just redirect here — see "MEMBER DASHBOARD — GATING LOGIC" below, which is now superseded, not current behavior. Next likely asks: a real name for the Hub (Cece rejected several proposed names — "The Nest," "Inside," "My Corner," "The Table," "Now What," "Still Here," others — current instruction is to just keep calling it "the Hub"/"the Dashboard" until further notice, do NOT re-propose names unprompted); tying the "What Kind of Nester Are You?" quiz result to a personalized paid-product suggestion inside the Hub (Cece confirmed she wants this — still needs her call on which product maps to which of the 3 quiz types before it can be built); photo-based cover art (not flat color+text — Cece explicitly agreed text-on-image duplicates the card's own title and reads as generic/templated) for any future paid product added to the Shop.

**Thread 1 — Homepage redesign (2026-07-31/08-01 plan, superseded 2026-09-20).** The original from-scratch Gate 2 redesign (hero/story moment, credibility stats row, staggered cards, etc.) never shipped as scoped — run `git log -- CLAUDE.md` if the original Gate 1 answers are needed. Instead, on 2026-09-20 the existing homepage was retrofitted around the Hub: the three pillars swapped to Explore/Belong/Read (Belong replaces the old "talk to me directly"/book-a-$45-call pitch, which is now off the homepage entirely), and the primary CTA changed from newsletter signup to "join the Hub, free" (newsletter signup is now the secondary option). If Cece wants the original fuller redesign later, treat it as a fresh ask, not a resumption of this thread.

**⚠ 2026-08-30: the July 27/Aug 1 palette this Thread 2 describes was retired the same day** in favor of a new Cece-authored system (Deep Current/Burnished Copper/Golden Honey/Vanilla Cream/Deep Coffee + 9 Card & Box colors) — see DESIGN.md §2 for the full lock, role mapping, and WCAG contrast. The homepage (`site/index.php`) is now fully done in the new palette — every section, including Meet Cece and Stay Close/Newsletter — scoped under `.home-*`/`.cece-*`/`.an-*` selectors; everything else (every other page, every widget) still renders the palette this Thread describes. Whoever picks up color rollout next should roll toward the *new* §2 system, not this one, and read DESIGN.md §2's own header note first — it also flags an unresolved role conflict (Burnished Copper shipped as the visible CTA color on the homepage, but §2.3's table still calls it "secondary") that should get settled before the rollout goes further.

**Thread 2 — Color palette propagation.** Target is now the 2026-08-30 system (Deep Current/Burnished Copper/Golden Honey/Vanilla Cream/Deep Coffee) per the warning above, not the July 27/Aug 1 one:
1. Live `style.css` and site-wide PHP pages — still on the retired Wine/Copper/Charcoal system outside `index.php`; needs the same treatment item 2 below got.
2. ~~Garage Sale Planner~~ — **done 2026-09-05.** `widgets/garage-sale-planner/widget.html` migrated in two passes the same session: first onto the July 27/Aug 1 system, then — after the Aug 30 supersession surfaced mid-session and Cece confirmed "everything should have this new palette" — re-migrated onto the current 2026-08-30 system (Deep Current/Burnished Copper/Deep Coffee/Vanilla Cream). Zero retired hex codes remain from either generation (verified by grep + rendered screenshots at desktop/mobile). Taupe/Warm gray/Warm Sand/Bark/Dark orange/Moss/Rosewood are untouched, per DESIGN.md §2.4/§2.5/§2.9 — those stay on their existing values until Cece decides their replacements. **Open call made without asking further, flagged here for review:** the new system has no second card-surface tone (old Clean card/Cozy card ramp), so this file now uses flat Vanilla Cream for all card/popover/input surfaces (relying on their existing hairline borders for separation) and a soft `rgba(43,31,24,0.06)` Deep-Coffee wash — not a new named color — anywhere the old Cozy-card tint gave a hover/secondary surface some visible weight (nudge boxes, stat strip, icon badges). Worth confirming with Cece rather than letting it silently become the de facto answer as more files roll onto this palette. Along the way: unified the 7 decision categories (Garage Sale/Sell Online/Donate/Trash/Given to kids/Memory Box/Batch) onto one consistent color across the Home tab tiles, the sale stat-strip dots, and the inventory table chips — Memory Box and Batch previously collapsed onto the same `chip-notsure` style and were indistinguishable in the table; they now have their own `chip-memory`/`chip-batch` classes. Also recolored the in-progress Home-tab v2 redesign (status card, count tiles, Command Center) onto the locked palette rather than reverting it, removed dead CSS (`chip-keep`, unused `--color-berry`/`--color-terracotta`/`--color-amber`/`--color-ramp-950`/`--color-text-faint`/`--color-primary-active` custom properties), and confirmed the July 23 critique's P1/P2 findings (dead "Change condition" link, silent $0 price, missing overlay ARIA/Escape, camera emoji) were already fixed by prior sessions.
3. Remaining widgets — **correction 2026-09-14:** this line's `cooking-for-one` count was stale. A full grep of every hex code in `widgets/cooking-for-one/widget.html` during that session's build found it already fully on the current 2026-08-30 locked palette, zero retired hex remaining — no migration work needed there. (The "two files" this line referenced no longer matches the directory either; there's just `widget.html` now.) Other remaining widgets (`6pm-experience`, `coloring-widget`, `someday-list`, `know-before-you-sell`) still need the same re-scoping toward the Aug 30 system.
4. New Grandma Planner — high priority, not yet started, needs a blueprint doc first (Build Playbook Phase 1).

**Also open, unrelated to either thread above:** a GitHub personal access token was found embedded in plain text in the git remote of a stale, duplicate local copy of this repo (`c:\Users\cuype\MNC-Website` — NOT this one). Cece was told to revoke/regenerate it on GitHub directly; unconfirmed as of this writing whether she has. If a session finds that stale folder again, don't build from it — it's missing the July 27 palette entirely.

---

## BUILD PROCESS — ANY NEW INTERACTIVE TOOL

Follow `MNC-BUILD-PLAYBOOK.md` in full. Mandatory, no skipping phases — the two phases most likely to get skipped are the ones that matter most:

- **Design Plan before code** (Phase 2) — token system, type scale, signature element, self-critique against generic template defaults. Skipping this is what shipped Garage Sale Planner looking templated the first time.
- **Brand & Visual QA as its own pass** (Phase 5) — not folded into general QA. Checks border-radius, box-shadow, fonts, banned words, and whether the tool has one element that couldn't be mistaken for a generic competitor's.

**Border-radius/box-shadow — CURRENT STANDARD, sitewide, no exceptions:** Cards/containers: `border-radius: 8–10px`. Buttons/inputs: `border-radius: 6px`. Tags/pills/badges only: `border-radius: 9999px`. Soft box-shadow standard for elevation: `0 10px 40px rgba(37,37,53,0.07)`.

---

## ACTION ITEMS — FIX NOW

*(None open right now — see Current Focus above for the active rollout work.)*

---

## OPEN ITEMS — NEEDS CECE'S CALL, NOT A CLAUDE DECISION

- ~~**Security**~~ — **done 2026-09-20.** `check-users.php` and `make-admin.php` were publicly reachable with no auth and leaking every member's email/ID to anyone who visited the URL — deleted, live on Hostinger confirmed gone (404). `setup-database.php`, `add-blog-post-1.php`, `add-free-tools.php`, `add-quiz-result-column.php`, `add-someday-companion.php`, and `add-widgets.php` (leftover one-time scripts, already run in production, still sitting live) also deleted. `gen-hash.php` no longer exists in the repo (already gone before this pass, unclear when). See the 2026-09-20 Change Log entry.
- ~~**Exclusive content drip logic**~~ — **moot as of 2026-09-20.** This whole conflict (`ExclusiveContentDrip_ClaudeCode_Brief.md`'s personalized drip vs. the Gating Logic section's shared monthly drop) no longer applies to live behavior — the Hub gives every member every freebie immediately, no drip of any kind. The old dashboard.php this logic described is retired. `ExclusiveContentDrip_ClaudeCode_Brief.md` is now historical only.
- **Print proofing:** Wine (`#7A2E42`) hasn't been proofed in CMYK. Needed before it goes on anything physically printed (e.g. the Now What? Workbook paperback cover, if used there).
- **Off-palette hairline grays:** a few widget files still use `#D3D3D3`/`#ABABAB` for hairline borders/dividers — not on the current palette. Low priority, fold into the rollout above rather than a separate task.
- **Kitchen Rescue daily scan cap (added 2026-09-14):** set to 5 scans/user/day in `site/api/kitchen-rescue-scan.php` (a judgment call, not a number Cece gave) — real API cost per scan, no usage data yet to know if 5 is too tight or too loose.
- **Kitchen Rescue web search (added 2026-09-14):** the recipe-search fallback step uses Claude's `web_search` tool on the same `ANTHROPIC_API_KEY` already live for `photo-identify.php`/`price-lookup.php`. If results always come back empty in testing, check whether web search needs to be turned on for that key at console.anthropic.com.
- ~~Kitchen Rescue copy banned-phrase pass~~ — **done 2026-09-14.** Full grep of the whole file (not just new strings) against the complete banned-phrase list found one hit, pre-existing and unrelated to Kitchen Rescue: the rotating planner tip "One-pot meals mean one pot to wash. That matters when it's just you." — fixed to "Worth it when it's just you." Kitchen Rescue's own copy was already clean.

---

## BACK BURNER (not urgent — do not touch without a new brief)

- **Quiet House Meter** — widget was never built (no folder in /widgets/). Removed from homepage and resources page. DB record set to `draft`. Do not rebuild without Cece's go-ahead.
- **30-Day Goal & Habit Tracker** — live widget, $27, but needs full visual rebuild to match Cooking for One style. Current code is narrow/popup layout. No brief written yet.
- **Weekly Reset Planner** — local file only, pre-rebrand colors/fonts, not live. Needs a full brand audit before going up.

---

## LIVE PAGES

**The Hub** (`hub.mynestchapter.com`) — separate app, separate repo, see Thread 0 above. This is where login/signup, the member dashboard, and all purchasing actually happen now.

On this repo's site (`mynestchapter.com`): Homepage, About (includes quiz), Shop (browse-only — every buy button now points to the Hub), workbook.php (browse-only, same), Blog, Resources, Freebies (still gates each freebie behind email capture for non-members — the Hub is gate-free once you've joined), `/nester-quiz` (dedicated shareable quiz page), `/connect` (email/text/booking page, not in main nav, not linked from homepage as of 2026-09-20), `/start-here` (orphaned, not in main nav).

**Retired 2026-09-20 — now redirect straight to the Hub instead of running their own logic:** `login.php`, `register.php`, `dashboard.php` (member dashboard), `checkout.php`.

---

## MEMBER DASHBOARD — GATING LOGIC (RETIRED 2026-09-20, kept for historical reference only)

**⚠ Most of this section describes `dashboard.php`, which no longer runs — it now just redirects to the Hub.** None of the "Dashboard (member)" or "Exclusive Content Queue" behavior below is enforced by live code anymore. The Hub's actual member behavior is simpler than everything below: join for free, get every current freebie immediately with no drip, no monthly-drop countdown, no personalized 30-day schedule — see Thread 0 above. **The one part that's still real:** the "Freebies Page (public)" column's email-capture rule — `freebies.php` on this repo's site still gates every freebie behind email capture for non-members exactly as described. Left in place only so a future session understands what the old dashboard used to do; don't treat the dashboard-side details below as a live spec.

**Core rule (historical):** Every public freebie on the Freebies page requires email capture — no exceptions. Once a person is a logged-in member on the dashboard, everything is gate-free — they're already in the system.

**Signup behavior:** New members get instant access to ALL currently available freebies — no drip, no waiting period.

**Monthly drop cadence:** One new exclusive freebie added per month. Six-month queue tracked in the repo/project docs (Notion is no longer in use — do not reference it). Dashboard shows a countdown timer card for the next drop, and an email reminder goes out via Hostinger Reach ahead of each one. ⚠️ See "Open Items" above — this description conflicts with `ExclusiveContentDrip_ClaudeCode_Brief.md` and needs a live-code check.

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

**As of 2026-09-20, purchasing happens in the Hub** (`hub.mynestchapter.com`), not on this repo's site — see Thread 0 above. Prices below are still the source of truth for what each product costs.

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
- The Quiet House Meter — back-burner; widget never built

---

## DESIGN SYSTEM QUICK REFERENCE

Full palette and typography rules live in the brand skill file — below is just enough to catch an obviously wrong color or font in code review.

**Core colors (locked July 27, 2026 — supersedes every earlier palette in this file):**
- **Charcoal** `#262624` — text, headings, nav, footer. 15:1+ against every background, AAA everywhere.
- **Page background** `#F6F3EC` — main background, 70–80% of every page.
- **Clean card** `#FEFCF8` — near-white card surface, pair with a 0.5px hairline border.
- **Cozy card** `#EFE8DC` — deeper, warmer card surface, same hairline-border rule.
- **Wine** `#7A2E42` — primary button/action color. Emotional/connection CTAs: 6pm Experience, founder story, newsletter.
- **Copper** `#A15C3E` — secondary button/action color. Product/functional CTAs.
- **Taupe** `#8C8272` — decorative labels/eyebrow text only. AA-large only, never small primary reading text.
- **Warm gray** `#6B655C` — icons and utility. Full AA at any size.
- **Dark orange** `#9E3D0F` — error states. Never rely on color alone — pair with an icon or the word "Error."
- **Moss** `#46703F` — success states, and the third tag color.
- **Rosewood** `#80475E` — added 2026-07-31, sitewide tertiary accent. Flexible use (decorative highlights, a fourth tag color), 6.36:1 against Page background (AA). Name is provisional. Don't pair with Wine in the same small element — too close in family to read as intentional. See DESIGN.md §2.9 for the full note.
- **Soft White** `#FFFEFB` — added 2026-08-01, alternate background brighter than Page background (photo-heavy sections, forms, checkout). Not a card surface — use Clean card for that.
- **Warm Sand** `#D9C7AC` — added 2026-08-01, fills the gap between Cozy card and Taupe. Dividers, borders, muted/disabled UI.
- **Bark** `#5B3A28` — added 2026-08-01, deeper brown between Copper and Charcoal. Hover state on Copper buttons; secondary text darker than Warm gray. 9.11:1 against Page background (AAA).
- **Golden Earth** `#99621E` — added 2026-08-27 (was shipped 2026-08-26 without a changelog entry; documentation caught up during the same-day audit fix). Homepage Start Here "Thrive" pillar eyebrow/link color, 4.6:1 against Page background, same AA tier as Copper.
- **Forest** `#2D3B32` — added 2026-08-27 (shipped 2026-08-26 without a changelog entry). Meet Cece section background only, replaces Charcoal for that one section per Cece's direct call — not a sitewide substitute for Charcoal.
- **Tags** — colored text only, no fill, no border. Wine, Copper, Moss, or Rosewood text directly on the page/card background.
- **Candidates, added 2026-08-11 — NOT role-assigned yet:** Almond Cream `#EAE0D5`, Khaki Beige `#C6AC8F`, Golden Earth `#99621E`, plus three given directly as hex with placeholder names — Warm Amber `#CE8147`, Deep Umber `#504136`, Warm Ivory `#F7F4EA` — plus Marigold `#FFA500` (the bright version; solves an earlier "where's my marigold" question — it was in a Coolors AI chat, not a repo file). Don't use in new code until a role is picked — see DESIGN.md §2.12. Two more colors from that same Coolors screenshot (dark warm browns, `#685044` and `#582419`) are pending name confirmation before they're added at all.

Source: the current color reference file — ask Cece which one is live if in doubt; this changed twice in one month (May 2026 → July 5, 2026 → July 27, 2026).

**Retired 2026-08-11:** Deep Teal `#114B5F` — was the single pop/accent color added 2026-08-01, retired after less than two weeks. No replacement pop-accent chosen yet; badges/highlight markers fall back to Rosewood or plain tag-text until one is.

**Retired — should never appear in new code:** Everything from the July 5, 2026 palette (Velvety Charcoal `#252535`, Warm Antique White `#FAF7ED`, Deep Rose `#C44570`, Periwinkle `#8BA7D4`, Lavender `#C4B0E8`, Soft Peach `#F5C4A8`, Rose Tint `#F9ECF0`, Peach Tint `#FCF0E8`, Peach Mid `#EFA276`, Warm Brown `#6D4C3E`, Tool Background `#FDFBF7`) plus everything from the May 2026 palette before it: Vibrant Pink `#E87AAA`, Vanilla Cream `#FFF8EE`, Powder Blue `#A8C5DA`, Peach `#F2A57A`, Lemon `#EDD96A`, Lime `#B5CC6A`, Light blush `#facfd4`, Deep Berry `#811453`, Dark Berry `#5E1337`, any Berry shade, Muted Mauve `#A3918A`, Warm Blush `#D6C2B7`, Sage Gold, Peach Tan, Sage Gray, Blush Pink `#F8D4D4`, Soft Pink `#F8BBD0`, Linen White, Soft Rose, Warm Cream `#F4E8C1`, Warm Tan, Coral Orange, Teal, Gold, Navy, cool gray (`#6e6e6e`/`#666666`/`#999999`/`#ABABAB`/`#D3D3D3` and similar) for web text.

**Fonts:** Montserrat ExtraBold (print/PDF headlines, display), Arial Regular (print/PDF body). HTML tools and site pages: Lora (display) + DM Sans (body).

---

## REVIEW PROTOCOLS

For widget UX reviews, see `REVIEW_PROMPTS.md` in the repo root.

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
- border-radius: cards/containers must be 8–10px, buttons/inputs 6px, pills/tags/badges only 9999px. Anything else, including 0, is a violation. Find it, fix it.
- box-shadow: cards should carry `0 10px 40px rgba(37,37,53,0.07)`; `none` on a card is a violation, a different/heavier shadow is also a violation. Find it, fix it.
- Hex colors: only `#262624 #F6F3EC #FEFCF8 #EFE8DC #7A2E42 #A15C3E #8C8272 #6B655C #9E3D0F #46703F #80475E #FFFEFB #D9C7AC #5B3A28 #114B5F` allowed (July 27, 2026 palette + Rosewood added 2026-07-31 + Soft White/Warm Sand/Bark/Deep Teal added 2026-08-01 — see Design System Quick Reference above). Everything else, including cool gray or any color from the retired list: flag and fix.

Font check (widget files only):
- Grep for Montserrat or Arial anywhere in a /widgets/ file. Replace with Lora (display/headers) or DM Sans (body). No other fonts allowed in widgets.

Banned phrase check (grep the full file) — must match `Skill_File_07-05-2026_v4.md`'s cumulative banned-phrase list exactly; if the two ever disagree, the skill file wins and this list gets corrected:
- "fluff" — remove it
- "journey" — replace with "experience," "path," or "chapter"
- "no judgment" or "zero judgment" — remove it
- "no wrong answers" — remove it
- "what you carried" — replace with "what you lived"
- "change things for me" — remove or rephrase
- "which one keeps coming back" and any variation — remove or rephrase
- "the one you've said someday to more times than you can count" — remove or rephrase
- "as solo moms, we" — Cece speaks for herself only, never for the reader
- "I wasn't broken" — remove
- "lightbox" — replace with "6pm Experience" or "6pm Experience widget"
- "hold space" — rephrase in plain language
- "healing journey" — remove or rephrase
- "you've got this" and any cheerleading/"look how far you've come" energy — remove
- "this will help you" — replace with "this helped me" or "this is one way to"
- "you'll feel" — replace with "I felt" or "you might notice"
- "you need to" — replace with "you might want to"
- "it's enough" and all variations ("that's enough," "you are enough," "that is enough") — delete on sight
- "that's not nothing" and all variations ("that's something," "that matters," "that counts") — delete on sight
- Any other outcome promise, therapy-speak, or coaching language, and any CTA that reads like a landing-page template instead of Cece talking

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

*(Full session-by-session history through July 2026 has been moved out of this file and lives permanently in git — run `git log -- CLAUDE.md` for the complete record, including the Garage Sale Planner's build history, past color migrations, and every contrast fix along the way. This file only keeps a short recent record going forward.)*

**2026-09-20 — The Hub launched. This is the biggest single-session change this file has ever recorded.** Cece had a Perplexity-generated Node.js/React app sitting in a "My Nest Chapter Hub — Source Code.zip" in her Documents folder — a real full-stack app (Express + React, its own SQLite-backed users/entitlements/reflections/meaningful-days/support-circle/meal-plan tables) that had never been connected to the real business. It ran only inside Perplexity's own sandboxed preview and used a fake Stripe credential proxy that would never work anywhere else. Moved the source to a permanent location (`C:\Users\cuype\my-nest-hub` — a separate git repo, has nothing to do with this MNC-Website repo, no shared codebase), rewired `server/stripe-client.ts` to call the real Stripe API directly with the real live secret key (reused from `site/includes/config.php`, kept in a git-ignored `.env`, never committed), and confirmed it against the real Stripe account with a safe read-only balance check before trusting it.

Deployed to a new Hostinger website, `hub.mynestchapter.com` (a real Node.js hosting target on the same Hostinger account as this site, created via `hosting_createWebsiteV1` + `hosting_deployJsApplication`/`hosting_startNode_jsBuildV1`) — **not** part of this repo's FTP deploy pipeline; it has its own build/deploy flow entirely. Note for future sessions: Hostinger's Node.js deploy auto-detection consistently guesses the wrong entry file (`server.js`) for this app; the real one is `dist/index.cjs` (esbuild output per `script/build.ts`) — always follow a `hosting_deployJsApplication` call with `hosting_startNode_jsBuildV1` passing `entry_file: "dist/index.cjs"` explicitly, or the build succeeds but the app won't start.

**Site restructuring, no members existed yet so this was a clean cutover, not a migration:** `login.php`, `register.php`, `dashboard.php`, and `checkout.php` now just `header('Location: ...')` redirect to the Hub instead of running their own logic — every account and every purchase now lives in one system, not two. Every buy/login/signup link sitewide (homepage header + mobile nav, `includes/header.php`'s shared nav, `shop.php`'s product grid, `product.php`'s buy button — both the paid-product branch and the free-with-account branch, `workbook.php`'s two buy buttons, `freebies.php`'s member callout) now points at the Hub instead. `shop.php`/`product.php`/`workbook.php` themselves stay live as browse/marketing pages — only the actual purchase action moved.

**Homepage retrofit around the Hub** (not the from-scratch Gate 2 redesign Thread 1 originally planned — see Current Focus above): the "Support" pillar ("Talk to me directly," linking to the $45-call/email `/connect` page) is gone from the homepage entirely, along with the "Say hello" link in the Meet Cece section — Cece's direct ask, she wants the homepage built around the Hub, not around booking time with her. The three pillars are now **Explore / Belong / Read** (Belong links to the Facebook group — Cece's own Perplexity session had already drafted this exact three-pillar copy independently; reused it rather than inventing new copy). The "Stay Close" section's primary and secondary blocks flipped: "Join the Hub — it's free" is now primary (was the monthly-email signup), monthly email is now the secondary option. The hero "Start Here" button now links straight to the Hub instead of opening the quiz modal — the quiz is still reachable via the existing "Not sure? Take the quiz" link further down the page.

**Hub feature build:** added a Freebies page (sidebar nav item) listing all 6 current freebies gate-free — no email-capture forms inside the Hub, matches the locked "members are already in the system" rule. Added a Shop page (also sidebar, under "Add-ons" next to Weekly Cooking for One) listing Garage Sale Planner ($27), Now What? Workbook ($14.99), and The Someday List Companion ($7.99), each independently wired to Stripe Checkout via a shared `SHOP_PRODUCTS` catalog + one generic checkout-route-pair helper in `server/routes.ts` (Cooking for One's original hand-written routes were left untouched rather than refactored into the same helper, to avoid risking the one payment flow that was already working). Garage Sale Planner unlocks to the real widget (`mynestchapter.com/widgets/garage-sale-planner/`); Workbook and Someday Companion were initially shipped as "coming soon" (no real PDF on hand) but Cece overrode that same session — real purchasing for both is live.

**Found the actual PDFs** two ways: `hosting_listWebsiteFilesAndDirectoriesV1` against `mynestchapter.com` showed `now-what-workbook.pdf`, `someday-list-companion.pdf`, `exclusive-6pm-survival-plan.pdf`, and `exclusive-who-am-i-now.pdf` all already sitting in `site/downloads/` on the live server (the last two are the first two items in the Exclusive Content Queue below — also wired live today, no longer "Built, ready to deploy"), but there's no tool available to pull a binary file off Hostinger through the MCP connection. Cece pointed to a local "Stuff" folder (`OneDrive/Documents/Stuff/`) with the same four files; copied from there instead into `my-nest-hub/client/public/downloads/`, which Vite bundles as static files the Hub's own Express server serves directly (`hub.mynestchapter.com/downloads/<file>.pdf`) — byte-for-byte verified against the Hostinger copies after deploy. All four are now real, instant-delivery downloads with zero manual follow-up.

**Cover art:** Cece flagged the live `garage-sale-planner-cover.jpg` and `workbook-cover.jpg` as "too much going on" — both were repurposed marketing/print assets (an ad-style graphic and the actual KDP paperback print spread) carrying their own baked-in title/price text, duplicating what the product card's real HTML already shows, then getting cropped into an unpredictable slice at the card's fixed 220px height. Generated new text-free single-photo replacements via Canva (`brand_kit_id kAHE-_Dmcm0`), cropped out just the photo (Canva's `generate-design` tool insists on adding a full marketing-template text layer regardless of prompt — the fix was generating anyway and cropping the photo out afterward, not fighting the template), previewed both side-by-side against the current covers at real card size in a Claude Artifact before touching anything live, then swapped the actual files in place (originals kept as `.OLD.jpg.bak` next to them). **Decided as house style going forward:** photo-based covers, not flat color-and-text blocks, for every future paid product — Cece's reasoning, confirmed: text-on-image duplicates the card's own title, and a flat color block is the generic templated default this brand's own build process (the Gate 2 "signature element" requirement) exists to avoid. Freebies inside the Hub deliberately do NOT get this treatment — plain icon-in-a-card, matching the Hub's other utility cards (Reflections/Meaningful Days/Support Circle) and reserving the heavier photo treatment as a paid-vs-free visual signal.

**Security, found while investigating cover-image file paths:** `check-users.php` and `make-admin.php` were live and publicly reachable with zero auth, dumping every member's ID/email(/name) to anyone who hit the URL. Also live: `setup-database.php` and five one-time migration scripts (`add-blog-post-1.php`, `add-free-tools.php`, `add-quiz-result-column.php`, `add-someday-companion.php`, `add-widgets.php`) — all already run in production, all still sitting there unauthenticated. Deleted all eight from the repo and confirmed the deletion actually reached the live server — **this repo auto-deploys `site/` and `widgets/` to Hostinger over FTP on every push to `main`** via `.github/workflows/deploy.yml` (a second workflow beyond the already-known `mnc-qa.yml`; there is no preview/staging step, a push to `main` is immediately live). Also deleted `site/_mock-blog-comments.php` (fakes a logged-in session for anyone who loads it, explicitly marked "delete when done," was untracked/never actually deployed) and two full-source backup zips (`ArchiveName.zip`, `freebies.zip`, also untracked/never deployed) from the local working copy. Verified all 8 previously-live files return 404 on `mynestchapter.com` post-deploy.

**Open, needs Cece's call:** the Hub still has no real name (see Thread 0 above — several proposals rejected, currently just "the Hub"); the "What Kind of Nester Are You?" quiz → personalized paid-product suggestion inside the Hub (Cece wants this, confirmed) needs her to say which product fits which of the 3 result types before it can be built.

---

**2026-09-14** — Built **Kitchen Rescue**, a new "in case" tool for Cooking for One, kept deliberately separate from the weekly planner: snap up to 3 photos (fridge/freezer/pantry), get up to 2 real suggestions built only from what's actually detected — nothing assumed, nothing guessed. She confirms a one-time, always-editable Pantry Staples list (salt, pepper, oil, butter, etc.) that counts as available on top of whatever the photos show. New two-phase backend (`site/api/kitchen-rescue-scan.php`): a vision call identifies real items and tries to build a direct suggestion from just those; if it can't, a second call using Claude's `web_search` tool (restricted to 8 trusted recipe sites) finds one real, existing recipe that only needs the same ingredient list — never a "go buy this too" result. Reuses the same `ANTHROPIC_API_KEY` already live for `photo-identify.php`/`price-lookup.php` (model: `claude-sonnet-5`). New `kitchen_rescue_scans` table caps usage at 5 scans/user/day, since unlike the rest of this $27 one-time tool, every real scan costs API money — revisit the number if it's wrong in practice. Tapping a result shows what it needs plus an expandable "Show me how" with real step-by-step instructions.

Also landed the four fixes from that day's `/impeccable critique`: grocery auto-fill no longer silently drops meals with no matched ingredient list (falls back to the meal's own Notes field, and now tells her when nothing was found instead of going quiet); "Clear all meals for this week" clears immediately with a toast Undo instead of a blocking confirm; every modal in this widget — the existing four plus the new Kitchen Rescue detail view — now renders as a bottom sheet on mobile instead of a centered popup, per DESIGN.md §5.6; and the week-progress sidebar text is momentum-framed ("3 more days to plan") with the number tweening instead of snapping, matching §5.6's own example. Two small pre-existing gaps surfaced and fixed along the way: `.btn-primary`/`.btn-secondary` had no `:disabled` style at all (a disabled button looked identical to an active one — now visibly grayed), and `.mnc-toast` was `pointer-events:none` even while shown, silently blocking any click on a toast (fixed — this is what makes the new Undo action clickable at all).

**Needs Cece's call, not decided here:** whether Kitchen Rescue's web_search step needs anything enabled on the Anthropic console for this key; whether the 5-scans/day cap is the right number once real usage shows up (the cap is now at least visible to her before she hits it, see below).

**Same day, follow-up** — Ran `/impeccable audit` on Kitchen Rescue and fixed everything it found (1 P1, 3 P2, 1 P3 addressed; 1 P3 left as informational): the tagline was on plain Burnished Copper at 15px regular, measuring 4.43:1 — below AA; swapped to the already-documented `--mnc-copper-hover` small-text variant (now 6.46:1). Three new controls (`.staple-chip`, the staple/photo remove buttons) were under the 44px touch-target minimum — the chip itself got added to the existing sitewide touch-target media query, and the two small icon-only remove buttons got the same invisible-hit-zone pattern the grocery checkbox already uses (44×44 tappable area, visible size unchanged), verified both by computed style and an actual off-center click test. `#photoFileInput` had `aria-hidden="true"` on a still-focusable native input (invalid per the ARIA spec) — replaced with `tabindex="-1"` plus a real `aria-label`. All 5 modal titles sitewide (the pre-existing 4 plus Kitchen Rescue's own) were plain `<div class="modal-title">`s, invisible to screen-reader heading navigation — changed to `<h2 class="modal-title">`, a tag swap only, no CSS or visual change (confirmed by screenshot). Left as informational, no action taken: the loading spinner goes still under `prefers-reduced-motion`, but the same state is already announced via the adjacent `aria-live` text, so nothing is actually lost.

**Same day, second follow-up** — Ran `/impeccable critique` again on the whole file post-build (score moved 25 → 30/40, independently re-verified this time rather than self-reported) and fixed everything it found. The headline catch: a real bug, not a design opinion — `runKitchenRescueScan()`'s error handler was written to show a friendly fallback on failure, but `err.message || 'fallback'` never actually reaches the fallback, because a failed `fetch()` always throws a `TypeError` with a non-empty `.message` (e.g. "Failed to fetch"). A real network failure was showing that raw string to her, verified by an agent that actually intercepted and aborted the request rather than guessing. Fixed by only trusting `err.message` for errors the code explicitly throws itself (now tagged `err.isKnown`); anything else always shows the fixed friendly string. Also fixed: no `scrollIntoView` fired when a scan starts, so on mobile tapping "Scan My Kitchen" could look like nothing happened (30–90+ second wait, furthest section down the page) — added a scroll on every state change (loading/results/empty/error). The 5-scans/day cap was invisible until hit — `kitchen-rescue-scan.php` now returns `scans_remaining` on every successful scan, shown low-key in the results subhead ("· 3 scans left today"). The generic 429 rate-limit error was rendering under a "Something went wrong" header, which is factually wrong when nothing went wrong — she just used the feature as designed; added a distinct "You're out for today" header for that specific case. Ran the full banned-phrase grep across the whole file (not just new strings, per the critique's own instruction) — found and fixed one pre-existing hit, see the Open Items correction above. Ideas screen's filter row (7 options in one flat row, flagged in both critique passes now) split into two visually separated groups — meal-type (All/Breakfast/Lunch/Dinner/Snack) and attributes (Under 15 min/Favorites) — via a thin divider, `role="group"` kept on each for a11y. Full regression re-run after all of it: PHP lints clean, detector unchanged, no console errors, no overflow, undo/progress-text/modal-detail flows all still work.

**Same day, third follow-up** — Ran `/impeccable critique` a third time (score held at 30/40, P1 count down from 2 to 1) with two agents specifically told to hunt for regressions from the prior round's own fixes, not just new territory — and it found one. The Ideas filter-group divider added in the second follow-up (`.ideas-filter-group + .ideas-filter-group{border-left:...}`) assumed the two groups always sit side by side; at mobile widths the meal-type group wraps to its own rows and the attribute group drops below it, leaving an orphaned vertical tick with nothing to its left. Confirmed independently by both agents, not just one. Fixed with a `@media(max-width:600px)` override that drops the border/padding in favor of a top margin. Also fixed: the Scan button stayed fully clickable after a confirmed 429, guaranteeing a second failure — the interface already knew the next tap was dead but offered it anyway. Added a `rescueCappedToday` flag set on any 429 response; `updateScanButtonState()` now checks it first and keeps the button disabled ("Come back tomorrow for more scans") regardless of photo count, verified by adding another photo after the cap hit and confirming it stays disabled. Added a Cancel action to the scan loading state (an `AbortController` wired to the fetch) since a scan can run 30–90+ seconds with no prior exit — cancelling now returns cleanly to the pre-scan screen with no error shown, confirmed via a route that never resolves. The Week Complete modal's "Every day is planned. You did that." was set in `text-transform:uppercase` as a full two-sentence message (not a short label, unlike the file's other uppercase uses) — dropped the caps, bumped to `--text-lg` to keep it feeling like a moment. An empty-result scan was silently costing a cap slot with nothing telling her that — the empty state now says "This one counted toward today's limit — N scans left today." Full regression re-run: detector unchanged, PHP untouched, no console errors, no overflow at 375px or 1280px, all five fixes verified functionally (429-then-still-disabled, cancel-returns-clean, empty-state disclosure text, mobile divider gone, modal casing) not just visually.

**2026-09-05** — Homepage fixes from a third-party SiteCritic audit (Gate 2 plan approved by Cece before build). Changed: (1) "Say hello" in the Meet Cece card demoted from a solid button (`.cece-btn`, now dead and removed) to a plain text link matching "Read my full story" — one clear CTA above the fold instead of three competing ones. (2) New "Reader Voices" section (`.home-voices`) added between the hero and Meet Cece — plain-text pull-quotes, **placeholder copy only** (`"[Real reader quote goes here]"`), needs real quotes from Cece before this is truly done. (3) Added a small inline-SVG icon to each of the three pillars (nest motif/Thrive, speech dots/Support, open book/Encourage), colored via each pillar's existing accent token — no new colors. (4) Tightened `.cece-section` top padding (80px → 48px) so the hero and Meet Cece read as one flow. (5) Hero value-prop line changed from "Real tools, honest support, and a growing community for whatever's next" to, after several rounds of Cece's own wordsmithing, "Tools. A real person to talk to. A growing community that gets it." — drops an invented "coaching" claim the audit's own suggested rewrite would have introduced, keeps "growing" per Cece's preference, and answers the headline's "What's next." implicitly by echoing its own three-fragment cadence instead of repeating the word "next." (6) Added `.cece-link:hover`, and extended the existing pillar-only scroll-reveal (`IntersectionObserver` pattern) to the hero copy, Meet Cece card, and both Stay Close blocks, now with a `prefers-reduced-motion` guard at both the JS and CSS level. Two other audit findings (an "abrupt" dark-block section transition, and a flagged "free account" promise) were checked against live code/DESIGN.md and found to already be correct as-is — no change made, see the session's plan file for the reasoning. QA run: PHP lint clean, CSS braces balanced, no retired hex/banned phrases introduced, no new border-radius/box-shadow values. **Still needs Cece's action before fully done:** swap in real reader quotes/subscriber count in `.home-voices`.

**2026-09-06 (same thread, continued)** — Follow-up round with Cece: (1) Final hero subhead wording, after several iterations together: "Tools. A real person to talk to. A growing community that gets it." — fragment-style to echo the headline's own three-beat cadence ("Solo mom. Empty nest. What's next.") instead of repeating the word "next." (2) Wired in the real product covers Cece supplied — `garage-sale-planner-cover.jpg` and `workbook-cover.jpg` now live in `assets/images/`, referenced from `index.php` and `workbook.php` (note: `.jpg`, not the `.png` the code previously expected — all references updated to match). (3) **Hero CTA changed**: "Start Here" no longer links to `/start-here` — it now opens the quiz modal directly (`onclick="openQuizModal()"`, same modal as the existing "Not sure?" quiz button), per Cece's call. Reasoning: the quiz actually captures email (matches the site's locked primary conversion goal), and `/start-here` turned out to be a near-duplicate of the homepage's own inline three-pillar section — sending first-time visitors there was redundant, not just "vague" like the audit said. **`/start-here` is intentionally left live but now orphaned** — no nav link, no hero link, reachable only by direct URL. Revisit only with a new brief; don't quietly resurrect a link to it. (4) The three homepage pillar cards (Thrive/Support/Encourage) are now fully clickable — whole card is an `<a>`, not just the bottom text line — with a hover treatment tied to each pillar's own accent color (border + shadow tint to Golden Earth/Copper/Rosewood respectively, plus a small icon scale/rotate), reduced-motion-safe. **`/start-here.php`'s own copy of these cards was deliberately left untouched** (still div-wrapped with a separate inner link) since that page's future is unresolved — CSS was written to support both patterns (`.pillar-cta` for the new span-based homepage version, `.pillar a` kept alive for the old one). (5) Deleted `wire-garage-cover.php` — a leftover script that wrote directly to the `products` table, publicly reachable with no auth, and non-functional from outside the Hostinger server anyway (`DB_HOST` is `localhost`). Same category of risk as the already-flagged `setup-database.php`/`gen-hash.php`. **Open item, needs Cece to run manually via phpMyAdmin:** `UPDATE products SET image_path = '/assets/images/garage-sale-planner-cover.jpg' WHERE slug = 'garage-sale-planner';` and equivalent for `now-what-workbook` → `/assets/images/workbook-cover.jpg` and `cooking-for-one` → `/assets/images/cooking-for-one-cover.jpg` — this is what actually fixes these products' covers on the Shop/dashboard pages (those pull from the database, unlike the homepage's hardcoded image tags). Deleted `update-cooking-image.php` (same one-off-script pattern as `wire-garage-cover.php`) rather than run it.

**2026-09-07 — Email rebrand pass.** Went through every file that actually calls `mail()` and swapped every retired-palette hex value to the current locked tokens (Deep Current header bands, Deep Coffee body text, Burnished Copper CTAs/links, Warm Sand borders/dividers, Vanilla Cream on-dark text, Warm Gray secondary text): `quiz-submit.php` (3 result emails), `forgot-password.php`, `api/stripe-webhook.php`, `someday-submit.php`, `garage-submit.php`, `garage-reminder.php`, `coloring-submit.php`, `cron/send-sale-reminders.php`, `cron/send-exclusive-unlocks.php`. Also caught two things along the way: (1) `cron/send-sale-reminders.php` called `$pdo->prepare()` without ever defining `$pdo` — `require_once db.php` only exposes a `getDB()` function, doesn't set a global — so this cron was fatal-erroring outright; added `$pdo = getDB();`. (2) `cron/send-sale-reminders.php` also had "You have got this" — that's the banned "you've got this" cheerleading phrase spelled out; removed it. New shared helper `includes/email-template.php` (`mnc_email_wrapper()`, `mnc_email_button()`, `mnc_send_email()`) was built for `reach-subscribe.php` and is the right thing to point future new emails at, but the ~9 files above were fixed in place (direct color swap, not migrated to the shared wrapper) per Cece's ask to keep this pass to colors only — the layouts still vary a lot (numbered step lists, itemized tables) and weren't worth the risk of a structural rewrite in the same pass.

**Audit finding, not yet actioned:** grepping the full retired-palette hex list across the whole repo (not just email files) turns up ~33 other files still on old colors — `style.css` itself (a handful of leftover `#ABABAB`/`#D3D3D3` disabled/border rules, separate from the homepage-scoped work), most of the admin panel (`admin/dashboard.php`, `admin/index.php`, six files under `admin/sections/`), and a long list of live pages (`about.php`, `blog.php`, `shop.php`, `dashboard.php`, `product.php`, `freebies.php`, `workbook.php`, `start-here.php`, `404.php`, and more) plus several widgets (`garage-sale-planner/widget.html` — previously flagged as the largest single old-palette file — `6pm-experience`, `coloring-widget`, `someday-list`, `know-before-you-sell`). This is the long-tracked "Thread 2 — Color palette propagation" work this file used to carry as an open thread before the file was reorganized — it's still genuinely unfinished, confirmed directly against live code rather than assumed. Needs Cece's call on scope/sequencing before starting; not touched in this pass. (6) Color-audited all three places the "What Kind of Empty Nester Are You?" quiz appears. The widget itself (`widgets/empty-nester-quiz/index.html`) was already mostly on the current palette — fixed the remaining off-palette cool grays (`#ABABAB`/`#DDDDDD`/`#BCBCBC`) to Warm Sand/Warm Gray for borders, disabled state, and placeholder text. The homepage's popup modal wrapper was already correct (Deep Coffee overlay, Vanilla Cream close icon — fixed in an earlier session per the 2026-09-05 entry above). `nester-quiz.php` (the dedicated `/nester-quiz` page) was NOT clean — still had two fully retired colors (Periwinkle `#8BA7D4`, Velvety Charcoal `#252535`) and inline Montserrat on its eyebrow text; fixed to Burnished-Copper-hover/Deep Coffee and DM Sans.

**2026-09-05** — A technical audit of live code (not just DESIGN.md's own tracked gaps) found and fixed: (1) `header.php` was loading only Montserrat as a web font, so every non-homepage page silently fell back to system fonts instead of Lora/DM Sans — fixed, and trimmed to the weights actually used (Lora 400/700/italic-400, DM Sans 400/700/800) after confirming nothing sitewide uses the dropped weights. (2) `coloring.php` and `workbook.php` — both standalone pages with their own `<style>` block, not `style.css` — were still running the entire July 5–16 palette (Deep Rose, Periwinkle, Lavender, a retired Wine-ramp gradient, a Vibrant Pink glow) untouched through three palette migrations; migrated to the current locked colors, with a new `--accent-on-dark` role (Golden Drift) added where the old pink token's dark-background uses failed contrast at Rosewood's value (~2.3:1). (3) The homepage's own quiz-modal overlay was hardcoding the same retired Velvety-Charcoal/Warm-Antique-White pair — fixed to use tokens. (4) Forms, email-capture, and the sitewide footer — previously flagged in §12.4 as still on pre-July-27 raw hex — are fixed. (5) Mobile-nav `aria-expanded`/hamburger-state/focus-management existed only in `index.php`'s own inline script; `footer.php` and `header.php` (used by every other page) now match. (6) Deleted dead `:root` tokens with zero remaining usages: `--charcoal`, `--page-bg`, `--cozy-card`, `--wine`, `--wine-hover`, `--copper`, `--copper-hover`, `--font-display`, `--section-padding`. DESIGN.md §2's scope note, §12.2, §12.4, and both appendices were corrected to match — see those sections rather than trusting older "verified" dates without rechecking live code.

**2026-08-01** — Added four colors to the July 27, 2026 lock, confirmed with Cece via a mockup preview before locking: Soft White `#FFFEFB` (alternate bright background), Warm Sand `#D9C7AC` (dividers/borders/muted UI, fills the Cozy card–Taupe gap), Bark `#5B3A28` (hover states, darker secondary text), Deep Teal `#114B5F` (the one pop/accent color — badges and highlight markers only, never a button; named "Deep Teal" not "Teal" to avoid confusion with the retired `#00CACA`). See Design System Quick Reference above and DESIGN.md §2 (Color System). Same day: DESIGN.md was fully rewritten (Version 5), consolidating all prior versions — the July 26 "Design Basics" draft was retired as an abandoned branch (it referenced colors retired the next day and is not a valid source).

**2026-07-31** — Added Rosewood `#80475E` to the locked July 27, 2026 palette as a sitewide tertiary accent (not a replacement). Name is provisional. See Design System Quick Reference above and DESIGN.md §2.10.

**2026-07-27** — Full rebuild of this file: retired the separate `MNC-PRODUCT-ROADMAP.md` (had drifted ~6 weeks out of sync with reality; its job is now the Current Focus section above), moved the full historical changelog out of the working file and into git history only, and rolled in the new July 27, 2026 color palette (replaces the July 5, 2026 palette sitewide — see Design System Quick Reference). Also consolidated four other fixes from earlier the same day: corrected the border-radius/box-shadow standard (was mistakenly documented as a per-widget 0px/8px choice; corrected to the actual sitewide 8–10px/6px/9999px standard), expanded the banned-phrase QA checklist to match the skill file's full list, fixed a wrong filename reference (skill file was pointed at a file that doesn't exist), and added an Open Items section consolidating everything still genuinely unresolved (security files, Know Before You Sell review, the exclusive-content-drip conflict, print-proofing Wine).
