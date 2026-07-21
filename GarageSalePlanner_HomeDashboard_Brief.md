# Garage Sale Planner — Home Dashboard Tab
**Build brief for Claude Code | Gate 1 + Gate 2 | 2026-07-16**

Paste this whole file into a new Claude Code session. Read `CLAUDE.md` and `DESIGN.md` at repo root first — this brief assumes both are already current (they were just updated 2026-07-16 with the corrected radius/shadow system, the Deep Rose Ramp, and the Feel & Interaction Standards).

---

## GATE 1 — DEFINE

1. **What is this?** A new "Home" tab for the existing Garage Sale Planner — a landing dashboard that sits before the current workflow tabs, giving Cece's buyer a visual entry point instead of dropping straight into "Start."
2. **Who specifically is it for?** A solo mom in the middle of planning her garage sale who's already added some items and wants to open the tool and instantly see where she left off — not re-orient herself from scratch every time.
3. **What problem does it solve?** Right now the tool has no landing view — she lands on "Start" every time regardless of progress. This makes the tool feel like a form to fill out rather than a living project she's building. A Home tab fixes that.
4. **Price point:** No change — this is an enhancement to the existing $27 Garage Sale Planner, not a new product.
5. **Not in scope for this brief:** the "sort/pricing needs to flow better" work (quick-add pattern, swipe-to-sort) — that's a separate brief for the `sortPrice` tab. This brief is Home dashboard only.

---

## GATE 2 — DESIGN PLAN

### Token system
- **Hero section:** near-black `#1B090F` (Deep Rose Ramp 950) — NOT Velvety Charcoal for this one section. Cece's explicit direction: "I love the black... black is one of my favorite colors." This is the one deliberately bold/confident zone per §5.6b.
- **Goal ring accent:** Deep Rose `#C44570` (Ramp 500) stroke on the circular progress ring — the single decisive color moment against the near-black.
- **Eyebrow/label text on the dark hero:** `#DA8BA5` (Ramp 300) — replaces Periwinkle in this one dark context per the ramp's own guidance (Periwinkle's locked role elsewhere is unaffected).
- **Body section background:** Warm Antique White `#FAF7ED` (unchanged, still 70–80% of the page).
- **"Pick up where you left off" cards:** white `#FFFFFF`, 10px radius, standard soft shadow `0 10px 40px rgba(37,37,53,0.07)` per §5.4.
- **Icon circles on each card:** pill radius (9999px), fill from Deep Rose Ramp light stops (50/100/200 — vary per card, don't repeat the same stop three times in a row), icon glyph from the matching darker stop (600–800) per §2.2b contrast rule.
- **Primary CTA ("Add an item"):** `.btn-primary` per DESIGN.md §6.1 — Deep Rose `#C44570` bg, hover `#A33359`, active `#74253F`.

### Type scale
- Hero headline: Lora 600, ~26px, line-height 1.15. A short italic Lora 500 accent line beneath it in Ramp 200 (`#E7B1C3`) — matches the mockup Cece approved.
- Section eyebrow ("Pick up where you left off"): DM Sans 700, 11px, uppercase, letter-spacing 1.5px, Warm Brown `#6D4C3E`.
- Card title: DM Sans 700, ~14.5px, Velvety Charcoal.
- Card subtitle (tab name): DM Sans 400, ~12.5px, Periwinkle `#8BA7D4`.

### Layout structure
1. **Dark hero band** (near-black `#1B090F`): "My Nest Chapter" eyebrow, two-line Lora headline, then an inline card containing the circular goal-progress ring + "$X of $Y" goal text.
2. **"Pick up where you left off" section** (on Warm Antique White): a stack of 2–4 dynamic cards, each linking into an existing tab/section — content drawn from actual saved state (see Data section below), not hardcoded.
3. **Primary CTA button** ("Add an item") pinned at the bottom of the Home tab, always visible without scrolling on a standard phone viewport if possible.

### Signature element
The circular goal-progress ring against the near-black hero. Nothing else in this market has this — competitors use static numbers or a flat progress bar (the tool's own "Start" tab already has one, this promotes it to the first thing she sees, framed with more visual weight). This is also the literal signature element referenced in Cece's "sexy and confident" mockup approval.

### Self-critique
Does anything here read as a generic template default? The rounded-card-plus-icon pattern is common — what keeps it from being generic is (a) the near-black hero is an unusual, deliberate choice most competitors wouldn't make, and (b) card content is dynamic and specific to her actual sale ("12 items still need pricing," not "Inventory"). Flat generic dashboards show static menu items; this one reflects her real progress back to her. That's the differentiator — don't let it get simplified into a static icon-grid menu during build.

### Mobile / interaction requirements (DESIGN.md §5.6)
- Cards are tappable targets, min 44px touch height, visible `:active` press state (scale 0.97 or translateY(1px) + background shift) — not just `:hover`.
- The goal number and ring animate/count up on first load rather than snapping to value instantly.
- No confirmation dialog needed anywhere in this tab — it's read-only navigation plus one CTA.

---

## DATA — WHAT EACH CARD SHOWS (dynamic, not hardcoded)

Pull from existing state (`P.items`, `P.setup`, whatever the current data model already tracks — inspect before assuming field names):

1. **Pricing card** — shown if any items lack a price: "{count} items still need pricing" → links to `sortPrice` / `inventory`
2. **Memory Box card** — shown if `P.items` has any items marked "keep"/memory: "{count} keepsake(s) waiting in Memory Box" → links to `sortPrice` / `memory`
3. **Sale Day card** — shown if `P.setup.saleDate` is set: "Sale day in {N} days" (or "Sale day is today" / "Not set yet" if unset) → links to `saleWrap` / `sale`
4. **Fallback card** (if nothing above applies — e.g. brand-new user with zero items): "Add your first item to get started" → links to `sortPrice` / `inventory`

Cap at 3 visible cards + always show the fallback only if the list would otherwise be empty. Order by urgency: unpriced items first, then sale day countdown, then memory box.

---

## WHERE TO MAKE THE CHANGE (widgets/garage-sale-planner/widget.html)

- `flowTabs` array (line 887): add `{id:"home",label:"Home"}` as the **first** entry, before `start`.
- `flowSections` object (line 895): add `home:[{id:"home",label:"Home"}]`.
- `defaultSection` object (line 903): add `home:"home"`.
- App should load to the `home` tab by default on open (check how `UI.tab` is initialized — likely near the top of the state/init code — and set it to `"home"` instead of `"start"`).
- Add a new render case for `UI.tab==="home"` in the main render/content function (search for where `UI.tab==="start"` is handled around line 1496 for the pattern to follow) — build the hero + goal ring + dynamic cards there.
- Existing `refreshGoalProgress()` (referenced line 4822) and the goal-ring math from the `start` tab's circular version — reuse that calculation, don't reimplement it.

---

## BUILD ORDER

1. Add tab config (3 small edits above)
2. Build the dark hero + goal ring (static markup first, wire to real data second)
3. Build the dynamic card stack
4. Wire the "Add an item" CTA to route into `sortPrice`/`inventory`
5. Mobile check at 375px width
6. Brand/QA pass against DESIGN.md §5.4, §5.6, §6.1 (radius, shadow, tap states, hex colors)
7. Screenshot desktop + mobile, deploy, check live

Do not touch `sortPrice`, `sellPromote`, `prepSafety`, or `saleWrap` tabs in this pass — Home dashboard only.
