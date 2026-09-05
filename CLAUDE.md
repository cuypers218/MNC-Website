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

**Working on:** Two threads active as of 2026-08-01.

**Thread 1 — Homepage redesign.** Gate 1 (the five questions) is answered — do NOT re-ask these, proceed straight to Gate 2:
1. *What is this homepage?* Introduces the brand by making an empty-nest mom feel seen, heard, and like she's in the right place.
2. *Who specifically, and when?* An empty-nest mom who has no idea what to do now that her last child has left home.
3. *Exact pain point?* She should land on the page and think "wow, this is me — someone gets it, someone gets me."
4. *What the page needs to do (draft, Cece hasn't given final sign-off on this list specifically):* hero with real "I see you" story moment; a "you're not alone" section mirroring her exact feeling; the existing "What Kind of Nester Are You?" quiz as the feel-seen/email-capture hook; a freebie callout (e.g. 6pm Cheat Sheet) for direct email signup; a brief founder story/"meet Cece"; light social proof. Deliberately NOT on the homepage: full product catalog, blog previews, anything sales-heavy — that's what Shop/Blog are for.
5. *Primary conversion goal:* email newsletter / freebie signup — NOT direct purchase.

Structural references Cece confirmed she likes (from 3 Pinterest mockups, session of 2026-07-31/08-01): centered top nav with login, soft/blurred hero imagery with white space tied together by small decorative touches + a real photo + short story text, a credibility stats row, cards staggered/offset rather than flat-aligned, a repeating section rhythm scrolling down, bold confident type on generous white space, a small deliberate color palette (not busy) — this already matches the current Wine/Copper/Deep Teal system, no real conflict.

**Next step: Gate 2 — produce the design plan** (token system, type scale, layout structure, signature element, self-critique) and get Cece's literal "approved" before writing any homepage code. §7.6 of DESIGN.md has a placeholder note on this — update it once the redesign actually ships.

**⚠ 2026-08-30: the July 27/Aug 1 palette this Thread 2 describes was retired the same day** in favor of a new Cece-authored system (Deep Current/Burnished Copper/Golden Honey/Vanilla Cream/Deep Coffee + 9 Card & Box colors) — see DESIGN.md §2 for the full lock, role mapping, and WCAG contrast. The homepage (`site/index.php`) is now fully done in the new palette — every section, including Meet Cece and Stay Close/Newsletter — scoped under `.home-*`/`.cece-*`/`.an-*` selectors; everything else (every other page, every widget) still renders the palette this Thread describes. Whoever picks up color rollout next should roll toward the *new* §2 system, not this one, and read DESIGN.md §2's own header note first — it also flags an unresolved role conflict (Burnished Copper shipped as the visible CTA color on the homepage, but §2.3's table still calls it "secondary") that should get settled before the rollout goes further.

**Thread 2 — Color palette propagation (July 27/Aug 1 palette — superseded, see warning above).** Was still needing rolling out as of Aug 1, now needs re-scoping against the new palette instead:
1. Live `style.css` and site-wide PHP pages — color values + border-radius/box-shadow rollout to the current standard, including the four 2026-08-01 additions (Soft White, Warm Sand, Bark, Deep Teal).
2. ~~Garage Sale Planner~~ — **done 2026-09-05.** Full migration of `widgets/garage-sale-planner/widget.html` to the July 27/Aug 1 palette (zero retired hex codes remain, verified by grep + rendered screenshots at desktop/mobile). Along the way: unified the 7 decision categories (Garage Sale/Sell Online/Donate/Trash/Given to kids/Memory Box/Batch) onto one consistent color across the Home tab tiles, the sale stat-strip dots, and the inventory table chips — Memory Box and Batch previously collapsed onto the same `chip-notsure` style and were indistinguishable in the table; they now have their own `chip-memory`/`chip-batch` classes. Also recolored the in-progress Home-tab v2 redesign (status card, count tiles, Command Center) onto the locked palette rather than reverting it, removed dead CSS (`chip-keep`, unused `--color-berry`/`--color-terracotta`/`--color-amber`/`--color-ramp-950`/`--color-text-faint`/`--color-primary-active` custom properties), and confirmed the July 23 critique's P1/P2 findings (dead "Change condition" link, silent $0 price, missing overlay ARIA/Escape, camera emoji) were already fixed by prior sessions.
3. Remaining widgets (`cooking-for-one` alone has 130+ old-palette occurrences across its two files).
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

- **Security:** `setup-database.php` (installer script, meant to be deleted after first run) and `gen-hash.php` (contains the live account password in plain text) are both still sitting in the public web root. Needs a decision on removal/rotation.
- **Know Before You Sell:** built and brand-compliant, but pulled off the live site pending Cece's review — do not redeploy `widgets/know-before-you-sell/widget.html` until she confirms it's the intended version and it's been through Phase 5 QA.
- **Exclusive content drip logic — real conflict, not just staleness:** `ExclusiveContentDrip_ClaudeCode_Brief.md` (locked by Cece June 21) specifies a personalized 30-day drip anchored to each member's own signup date. The Gating Logic section below describes a single shared monthly drop for all members instead. Both can't be true of the live code at once — check `getUnlockedExclusiveContent()`/`getNextExclusiveUnlock()` in `functions.php` to see which was actually built, then fix whichever description is wrong.
- **Print proofing:** Wine (`#7A2E42`) hasn't been proofed in CMYK. Needed before it goes on anything physically printed (e.g. the Now What? Workbook paperback cover, if used there).
- **Off-palette hairline grays:** a few widget files still use `#D3D3D3`/`#ABABAB` for hairline borders/dividers — not on the current palette. Low priority, fold into the rollout above rather than a separate task.

---

## BACK BURNER (not urgent — do not touch without a new brief)

- **Quiet House Meter** — widget was never built (no folder in /widgets/). Removed from homepage and resources page. DB record set to `draft`. Do not rebuild without Cece's go-ahead.
- **30-Day Goal & Habit Tracker** — live widget, $27, but needs full visual rebuild to match Cooking for One style. Current code is narrow/popup layout. No brief written yet.
- **Weekly Reset Planner** — local file only, pre-rebrand colors/fonts, not live. Needs a full brand audit before going up.

---

## LIVE PAGES

Homepage, About (includes quiz), Shop, workbook.php, Blog, Resources, Freebies, Member Dashboard, Login/Register, Checkout, `/nester-quiz` (dedicated shareable quiz page, also linked from dashboard), `/connect` (added 2026-08-26, email/text/booking page, not in main nav), `/start-here` (added 2026-08-26, hero CTA destination — full three-pillar catalog page, not in main nav).

---

## MEMBER DASHBOARD — GATING LOGIC (LOCKED)

**Core rule:** Every public freebie on the Freebies page requires email capture — no exceptions. Once a person is a logged-in member on the dashboard, everything is gate-free — they're already in the system.

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
- Know Before You Sell — built, pending Cece's review before redeploying (see Open Items)
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

**2026-08-01** — Added four colors to the July 27, 2026 lock, confirmed with Cece via a mockup preview before locking: Soft White `#FFFEFB` (alternate bright background), Warm Sand `#D9C7AC` (dividers/borders/muted UI, fills the Cozy card–Taupe gap), Bark `#5B3A28` (hover states, darker secondary text), Deep Teal `#114B5F` (the one pop/accent color — badges and highlight markers only, never a button; named "Deep Teal" not "Teal" to avoid confusion with the retired `#00CACA`). See Design System Quick Reference above and DESIGN.md §2 (Color System). Same day: DESIGN.md was fully rewritten (Version 5), consolidating all prior versions — the July 26 "Design Basics" draft was retired as an abandoned branch (it referenced colors retired the next day and is not a valid source).

**2026-07-31** — Added Rosewood `#80475E` to the locked July 27, 2026 palette as a sitewide tertiary accent (not a replacement). Name is provisional. See Design System Quick Reference above and DESIGN.md §2.10.

**2026-07-27** — Full rebuild of this file: retired the separate `MNC-PRODUCT-ROADMAP.md` (had drifted ~6 weeks out of sync with reality; its job is now the Current Focus section above), moved the full historical changelog out of the working file and into git history only, and rolled in the new July 27, 2026 color palette (replaces the July 5, 2026 palette sitewide — see Design System Quick Reference). Also consolidated four other fixes from earlier the same day: corrected the border-radius/box-shadow standard (was mistakenly documented as a per-widget 0px/8px choice; corrected to the actual sitewide 8–10px/6px/9999px standard), expanded the banned-phrase QA checklist to match the skill file's full list, fixed a wrong filename reference (skill file was pointed at a file that doesn't exist), and added an Open Items section consolidating everything still genuinely unresolved (security files, Know Before You Sell review, the exclusive-content-drip conflict, print-proofing Wine).
