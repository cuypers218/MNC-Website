# Garage Sale Planner — Sort + Price Interactive — Current Status & Reference

Rewritten 2026-07-12 (updated same day after a deploy + QA pass) to reflect
what's actually built and live right now. This version exists so nobody has
to re-derive "what does this screen actually look like" or "what does this
button do" from the code again.

---

## STILL TO DO

Only two real items left open:

1. **Visually check the remaining guided-flow screens against the mockup.**
   Only the Room Picker (Screen 1), Summary (Screen 8), and the Memories tab
   have actually been screenshot-compared against the approved mockup and
   fixed to match. Capture (2), Analyzing (3), Review (4), Memory note (5a),
   Batch pick (5b), Sell/condition+price (6), and Room complete (7) have NOT
   been checked against a mockup screenshot yet — what's in the section below
   is what the code currently does, not a confirmed visual match. **Blocked
   on Cece providing mockup screenshots for these screens.**

2. **Confirm the AI photo-ID backend has actually been live-tested.**
   `garage-identify-item.php` exists and the fallback path (manual category
   picker on failure/timeout) is wired — but whether Cece has generated the
   real Anthropic API key and tried it against a live photo isn't confirmed.
   **Blocked on Cece testing this on a real device with a real photo.**

That's it — everything else that was previously open is closed out below.

---

## CLOSED OUT (2026-07-12)

- **Deployed to the live site.** Confirmed live at
  `mynestchapter.com/widgets/garage-sale-planner/`. Along the way, found and
  fixed an unrelated server issue — the live `widgets/` folder had been
  renamed to `widget-OLD-backup.html`, which is why every widget on the site
  (not just this one) was 404ing. Cece confirmed the Room Picker, Summary,
  and Memories screens render correctly live.
- **Accessibility pass (Section 7.5 of the original spec).** Went
  screen-by-screen through the full guided flow. All interactive elements
  already had proper `<label for=>` pairings and 44px tap targets. One gap
  found and fixed: the Analyzing screen had no `aria-live` region, so screen
  reader users got no signal anything was happening — added
  `role="status" aria-live="polite"`.
- **Copy inconsistency fixed.** Guided-flow Memory Box screen (Screen 5a)
  storage placeholder now matches the Memories tab: "e.g. cedar chest in the
  attic" in both places.
- **Brand & Visual QA sweep (Gate 3 per CLAUDE.md).** Checked for retired
  colors, wrong fonts, and banned phrases across the whole file — one
  violation found and fixed: the Sort + Price stat-strip legend text was
  using a cool gray (`#5a5a68`); changed to `var(--color-text-muted)`.
  Border-radius and box-shadow in this file are intentionally non-zero per
  the documented one-file exception (2026-07-03/04) — not a violation.

---

## SCREEN-BY-SCREEN: WHAT IT ACTUALLY LOOKS LIKE RIGHT NOW

### Screen 1 — Room Picker / Entry (`gsEntryScreen`) — ✅ matches mockup
- Small uppercase eyebrow: "Start here"
- Headline: "Pick a room, or / just start snapping" (two lines)
- Subtext: "Go room to room, or skip straight to the camera if that's easier.
  Nothing here is required in order."
- **2-column grid** of room tiles: Garage, Kitchen, Bedroom, Kids' Room,
  Living Room, Attic, Basement, +Add Room. Tiles for rooms with sorted items
  turn dark (navy) and show "✓ N sorted · $X"; empty rooms stay plain
  cream/outlined.
- Full-width primary button: **"Just start snapping →"**
- If any items exist at all: a secondary full-width link/button below it,
  **"All done for now — see my summary"**

### Screen 2 — Capture (`gsCaptureScreen`)
- Centered camera emoji icon, headline "Photograph the item — [Room]" (room
  name only shown if one was picked)
- "Take a photo" primary button — wraps a hidden `<input type=file
  accept=image/* capture=environment>`, so tapping it opens the phone camera
  directly
- Tip line below: "if it's a designer or name-brand item, try to get the
  label or logo in the photo too — it helps catch the brand and get you a
  better price."
- If a room is active AND has ≥1 item sorted: **"Done with [Room] →"** button
- Always present: **"All done for now"** (small underlined text link)

### Screen 3 — Analyzing (`gsAnalyzingScreen`)
- Just a centered "One moment..." card. No buttons. Auto-advances to Review
  once the AI call resolves (or times out after 12 seconds and falls back to
  the manual picker on Screen 4).

### Screen 4 — Review (`gsReviewScreen`)
- Shows the captured photo
- If the AI successfully guessed: a highlighted info box — "I think this is:
  [Category] — [Item]. **Not quite right? Fix it below.**" (bolded +
  underlined, not a small link — this already satisfies the Section 7.6
  visibility refinement)
- "What is it?" text field (pre-filled with the guess if there was one)
- Category dropdown + "Closest item type" dropdown (item list depends on
  category chosen)
- Checkbox: "This has a visible brand or designer logo"
- Text link: **"Full pricing guide →"** (opens the Pricing Guide tab)
- Six decision buttons in a 2-column grid: **Sell** (full width, top),
  **Donate** / **Give to Kids** (row 2), **Trash** / **Memory Box** (row 3),
  **Add to a Batch (low-value items)** (full width, bottom)

### Screen 5a — Memory Box note (`gsMemoryScreen`)
- Title: "Memory Box"
- "Why does this matter? (optional)" textarea
- "Where are you storing it? (optional)" text field
- Checkbox: "Also give this to my kids" — creates a second linked item,
  decision `Given to kids`, note "from the Memory Box"
- **"Save"** button → back to Screen 2 (Capture)

### Screen 5b — Batch pick (`gsBatchScreen`)
- Title: "Add to a batch"
- Existing batches shown as tappable tiles: batch label (Type + Description)
  + "$X each" — tapping saves the item into that batch instantly
- "Start a new batch" mini-form below: Type dropdown, Price field,
  Description field
- **"Create batch and save item"** button — creates the batch AND saves the
  current item into it in one step, back to Screen 2

### Screen 6 — Condition + Price / Sell (`gsSellScreen`)
- Title: "What condition?"
- Three buttons in a row: **Excellent / Good / Fair** (selected one is
  filled, others outlined)
- If the item type has a caution note (currently only car seats): shown in
  an info box
- If nudge conditions are met (brand detected, OR Collectibles and Extras,
  OR price ≥ $20): a highlighted banner — "Worth a look online first? This
  kind of item — or brand — often sells for more there. You can tag it
  Garage Sale below, or send it to Sell Online instead."
- Large price display/edit field, labeled "Garage sale price" (editable
  number input, pre-filled from the pricing table lookup)
- If brand was detected: a small "Brand detected" badge above the price
- Two action buttons: **"Use this price"** (tags `Garage Sale`) and, only
  when the nudge banner is showing, **"Sell Online"** (tags `Sell Online`)

### Screen 7 — Room Complete (`gsRoomCompleteScreen`)
- Title: "[Room] done"
- Recap line: "N items sorted, worth $X."
- **"Next room →"** button (back to Screen 1)
- **"All done for now"** (small text link, goes to Summary)

### Screen 8 — Summary (`gsSummaryScreen`) — ✅ matches mockup
- Title: "Here's where things stand"
- Dark navy stat block: "TOTAL SORTED" / "N items" / "$X estimated from sales"
- Instruction line: "Tap any group below to go straight to what's next for it."
- **2-column grid** of destination tiles — one per decision type (Garage
  Sale, Sell Online, Donate, Trash, Give to Kids, Memory Box, Batch), each
  showing its count and the exact place it routes to (see table below)
- Full-width outlined button: **"← Keep sorting"** (back to Screen 1)
- Recap message in a tinted box: "You sorted N items worth $X today. Come
  back anytime — nothing's lost."
- Full-width outlined button: **"Back to Start"** (closes the guided flow,
  returns to the Start tab)

### Batch Items tab (`renderBatch`) — code-verified correct, not yet
screenshot-compared
- Create-batch form: Type dropdown, Price field, Description field only (no
  Label/Category/Photo)
- **"Print saved tags →"** button (only shown once ≥1 batch exists)
- One card per batch: type + label (Type + Description), live total
  ("All items $X · N items · $Total"), a per-item "Move to..." dropdown to
  shift items between batches, Edit/Remove buttons

### Memories tab (`renderMemory`) — ✅ matches mockup
- Intro line + the "you don't have to hold on to something..." quote
- **Memory Box** section: small eyebrow header "Memory Box · N", cards you
  tap to reveal the note underneath, Edit/Remove per card, add-form (name,
  storage, note, "Also give this to my kids" checkbox — now correctly
  creates the linked Give to Kids entry), outlined "Save memory" button
- **Give to Kids** section: small eyebrow header "Give to Kids · N", each row
  shows name + note with an underlined "Mark given"/"✓ Given" text link
  (44px tap target), add-form (name, note), outlined "Save" button
- Bottom action row: two equal-width filled buttons, **"Print Memory Box
  list"** and **"Print Give to Kids list"**

### Print Center (`renderPrintCenter`, lives at Sale Day + Wrap Up → Print
Center) — this is the existing tab Garage Sale items route to. Not rebuilt
as part of this brief; this brief only needed it to be a real destination,
which it is.

---

## BUTTON → DESTINATION MAP (every navigating button in the guided flow)

| Screen | Button | Goes to |
|---|---|---|
| 1 Room Picker | Any room tile | Screen 2 (Capture), with that room set |
| 1 Room Picker | + Add Room | Prompt for a name → Screen 2, with that room set |
| 1 Room Picker | Just start snapping → | Screen 2 (Capture), no room set |
| 1 Room Picker | All done for now — see my summary | Screen 8 (Summary) |
| 2 Capture | Take a photo | Screen 3 (Analyzing) → Screen 4 (Review) |
| 2 Capture | Done with [Room] → | Screen 7 (Room Complete) |
| 2 Capture | All done for now | Screen 8 (Summary) |
| 4 Review | Full pricing guide → | Closes guided flow → Pricing Guide tab |
| 4 Review | Sell | Screen 6 (Condition + Price) |
| 4 Review | Donate / Trash / Give to Kids | Saves instantly (price $0) → back to Screen 2 |
| 4 Review | Memory Box | Screen 5a (Memory note) |
| 4 Review | Add to a Batch | Screen 5b (Batch pick) |
| 5a Memory note | Save | Saves item → back to Screen 2 |
| 5b Batch pick | Existing batch tile | Saves item into that batch → back to Screen 2 |
| 5b Batch pick | Create batch and save item | Creates batch + saves item → back to Screen 2 |
| 6 Sell | Use this price | Tags `Garage Sale` → back to Screen 2 |
| 6 Sell | Sell Online (only if nudge showing) | Tags `Sell Online` → back to Screen 2 |
| 7 Room Complete | Next room → | Screen 1 (Room Picker) |
| 7 Room Complete | All done for now | Screen 8 (Summary) |
| 8 Summary | Garage Sale tile | Sale Day + Wrap Up → Print Center |
| 8 Summary | Sell Online tile | Sell + Promote → Sell Online sub-tab |
| 8 Summary | Donate tile | Sale Day + Wrap Up (Wrap Up section) |
| 8 Summary | Trash tile | Sale Day + Wrap Up (Wrap Up section) |
| 8 Summary | Give to Kids tile | Sort + Price → Memories |
| 8 Summary | Memory Box tile | Sort + Price → Memories |
| 8 Summary | Batch tile | Sort + Price → Batch Items |
| 8 Summary | ← Keep sorting | Screen 1 (Room Picker) |
| 8 Summary | Back to Start | Closes guided flow → Start tab |

This table is the routing table from Section 8 of the original spec, confirmed
against the actual `GS_ROUTES` object in code (not just the design intent).
