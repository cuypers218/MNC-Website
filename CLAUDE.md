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
6. Before starting any new widget or product build, follow the Build Gates below (Gate 1 → Gate 2 → Gate 3) — this is the current, authoritative build process. It supersedes the old `MNC-BUILD-PLAYBOOK.md`.
7. At the start of every session, read `MNC-PRODUCT-ROADMAP.md` in the repo root — it is the live product status tracker and tells you what's done, what's pending, and what to work on next.

**Note (2026-07-11):** `MNC-BUILD-PLAYBOOK.md` is archived at `docs/archive/MNC-BUILD-PLAYBOOK.md` — historical reference only, not an active instruction file. It predates the 2026-07-01 resolution that killed the pill-button border-radius exception (this file still has the old "except pill buttons: 9999px" language) and still points to the retired `widgets/[product]/index.html` convention instead of the current `widget.html` + `index.php` pattern. Do not follow it directly. The Build Gates section below is the current process.

---

## WORKFLOW DISCIPLINE — NO SPRAWL, NO DEAD BRIEFS

*(Added 2026-07-11 after a laptop-wide file audit found duplicate/stale copies of this repo's docs scattered across OneDrive, Videos, and Music folders — this section exists to stop that from recurring.)*

1. **One home.** `C:\Users\cuype\MNC-Website` is the only place project files live. Never save a copy of any project doc (brief, roadmap, CLAUDE.md, brand file) to OneDrive, Desktop, Downloads, or any other folder "just in case." If Cece needs something accessible elsewhere, that's a shortcut back to this repo, not a duplicate file.
2. **Only two files are mandatory reading every session:** this file and `MNC-PRODUCT-ROADMAP.md`. Everything else (`DESIGN.md`, the brand skill file, changelog, archived briefs) is read on demand only, when the specific task actually needs it — not by default.
3. **A new brief file gets created only at Gate 1** (see Build Process below), when a product is actually about to be built. An idea being discussed is a conversation, not a file. Do not create a "notes" or "reference" doc for something still being decided.
4. **Before creating any new `.md` file — including Claude doing it unprompted — ask: does this belong in a file that already exists?** Most of the time it's a paragraph in the roadmap or this file, not a new document.
5. **"Done" is a checklist, not a vibe.** A brief is not closed until all four of: code is live → `MNC-PRODUCT-ROADMAP.md` line updated → brief file moved to `docs/briefs_done/` → one line added to `docs/changelog/CHANGELOG.md`. Skipping this is exactly what left half-finished-looking briefs sitting in three different folders.
6. **This section applies only within this repo.** It does not automatically extend to the separate claude.ai "My Nest Chapter" Project — that has its own knowledge panel and needs the equivalent rules pasted into its custom instructions separately.

---

## BUILD PROCESS — ANY NEW INTERACTIVE TOOL

Follow the Build Gates (below) in full. Mandatory, no skipping gates — the two most likely to get skipped are the ones that matter most:

- **Design Plan before code** (Phase 2) — token system, type scale, signature element, self-critique against generic template defaults. Skipping this is what shipped Garage Sale Planner looking templated.
- **Brand & Visual QA as its own pass** (Phase 5) — not folded into general QA. Checks border-radius, box-shadow, fonts, banned words, and whether the tool has one element that couldn't be mistaken for a generic competitor's.

Zero border-radius has no exceptions — not even pill-shaped buttons.

**Exception (2026-07-03/04, Cece's explicit call):** `widgets/garage-sale-planner/widget.html` now uses rounded corners (`--radius-sm/md/lg/xl/full: 6/10/14/20/9999px`) and soft box-shadows on cards (`0 10px 40px rgba(37,37,53,.07)`, borders removed), matching a wireframe Cece provided. Card titles and the hero headline use Lora weight 300 instead of 700. This is a deliberate, one-file-only deviation — every other widget and the main site remain zero-border-radius/zero-box-shadow. Do not silently "fix" this back to square/flat/bold, and do not extend any of this to another widget without a new, explicit instruction from Cece.

---


## ACTION ITEMS — FIX NOW

*(None — the missing-Playbook gap was resolved 2026-07-11 by archiving the old file and making the Build Gates section below the authoritative process instead.)*

## BACK BURNER (not urgent — do not touch without a new brief)

- **Quiet House Meter** — a "Final Approved" source file was found in two laptop folders during the 2026-07-11 cleanup (`OneDrive\Documents\Brand Products` and `Music`), contradicting the "never built" note previously here. Cece's call: delete it, not rebuild it. Both source copies moved to `_ToDelete` folders on 2026-07-11. This widget is not happening — do not resurrect without a new, explicit brief.
- **30-Day Goal & Habit Tracker** — live widget, $27, but needs full visual rebuild to match Cooking for One style. Current code is narrow/popup layout. No brief written yet. Widget folder currently has no index.html (deleted as security fix). Back burner until Cece is ready with a brief.
- **Weekly Reset Planner** — source file found in `OneDrive\Documents\Brand Products\weekly-reset.html` during 2026-07-11 cleanup and staged into the repo at `widgets/weekly-reset/weekly-reset-DRAFT-needs-brand-audit.html`. Cece confirmed 2026-07-11 she wants this one built out. **Next Gate: 2 (Design Plan)** — the file exists and needs a brand audit + rebuild, not a from-scratch Gate 1 define, since the product concept is already established. Read the draft file, run it through Brand & Visual QA (Gate 3 checklist), and produce a short design plan for anything that needs restructuring before it goes live.
- **New Grandma Planner** — high priority when ready to build, but not started.

## RECENT COMPLETIONS

Full history (including everything before 2026-07-11) lives in `docs/changelog/CHANGELOG.md` — read it only when you need context on a specific past decision. Nothing below is required reading for a normal session; check here first, and only open the changelog if this isn't enough.

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

**Core colors (locked July 5, 2026 — supersedes any earlier list in this file):** Velvety Charcoal `#252535`, Warm Antique White `#FAF7ED` (main background, 70–80% of every page), Deep Rose `#C44570` (primary signature — every CTA/hover, action only, never decorative), Periwinkle `#8BA7D4` (eyebrow labels, supporting text accents — never on buttons, never a background), Lavender `#C4B0E8` (badges/tags, 1–2 instances max), Soft Peach `#F5C4A8` (dividers, card borders, one warm accent section). Utility only (borders/fills/hover, no cool gray anywhere): Rose Tint `#F9ECF0` (hover/selected/focus tint), Peach Tint `#FCF0E8` (card/input fills), Peach Mid `#EFA276` (input outlines/borders), Warm Brown `#6D4C3E` (icons). Special use: Tool Background `#FDFBF7` — interactive HTML tools only (Garage Sale Planner, trackers, widgets), not a site/product-cover surface. Source: `MNC_Color_Reference_July2026.html`.

**Retired — should never appear in new code:** Vibrant Pink `#E87AAA`, Vanilla Cream `#FFF8EE`, Powder Blue `#A8C5DA`, Peach `#F2A57A`, Lemon `#EDD96A`, Lime `#B5CC6A`, Light blush `#facfd4`, Deep Berry `#811453`, Dark Berry `#5E1337`, any Berry shade, Muted Mauve `#A3918A`, Warm Blush `#D6C2B7`, Sage Gold, Peach Tan, Sage Gray, Blush Pink `#F8D4D4`, Soft Pink `#F8BBD0`, Linen White, Soft Rose, Warm Cream `#F4E8C1`, Warm Tan, Coral Orange, Teal, Gold, Navy, cool gray (`#6e6e6e` and similar) for text.

⚠️ **Known conflict, not yet resolved:** `DESIGN.md` and the live site pages still specify Vibrant Pink `#E87AAA` etc. as current — that predates the July 5 lock and has not been reconciled. Treat the July 5 doc as authoritative for anything new; flag to Cece before touching `DESIGN.md` or site-wide page CSS on the strength of this list alone.

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
- Hex colors: only `#252535 #FAF7ED #C44570 #8BA7D4 #C4B0E8 #F5C4A8 #F9ECF0 #FCF0E8 #EFA276 #6D4C3E #FDFBF7` allowed (July 5, 2026 lock — see Design System Quick Reference above). Everything else, including `#6e6e6e`/cool gray: flag and fix.

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

