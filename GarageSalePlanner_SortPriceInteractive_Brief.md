# Garage Sale Planner — Sort + Price Interactive — Current Status & Reference

Rewritten 2026-07-13 after a full mockup-comparison + fix session. This
version exists so nobody has to re-derive "what does this screen actually
look like" or "what does this button do" from the code again.

---

## STILL TO DO

One item needs Cece's call before this is fully closed out:

1. **Pre-existing site-wide color variable, not fixed this session.**
   `--color-text-muted` / `--color-text-faint` are set to `#426DB3`, which is
   not on the July 5, 2026 locked palette. This variable is used everywhere
   in this file (not something introduced this session — this session only
   fixed the one local `.gs-nudge` violation that used this same hex
   directly). Per CLAUDE.md's own noted "known conflict, not yet resolved"
   between `DESIGN.md` and the July 5 lock, this wasn't changed unilaterally
   — swapping the site-wide muted-text color is a bigger call than this
   session's scope, and should go through Cece first since it touches every
   screen, not just this widget.

Also still open from before, unchanged:

2. **Confirm the AI photo-ID backend has actually been live-tested with a
   real photo on a real device.** The fetch path bug found this session
   (`/garage-identify-item.php` → `/api/garage-identify-item.php`) is fixed,
   but Cece testing it live hasn't been confirmed back.

---

## CLOSED OUT (2026-07-13 session)

Worked screen-by-screen against the approved Claude.ai mockup artifact,
comparing each guided-flow screen live via screen share, and fixed every
real discrepancy found:

- **Print Command Center rename.** The "Print Center" sub-tab (under Sale
  Day + Wrap Up) is now "Print Command Center" everywhere — tab label, page
  title, help topic heading, and the `GS_ROUTES["Garage Sale"]` label,
  which now correctly reads "Print Command Center →" with no breadcrumb
  prefix, matching the approved mockup's Summary screen exactly.
- **Memory Box guided-flow screen stripped down to match mockup.** Removed
  the "Where are you storing it?" field and the "Also give this to my kids"
  checkbox from the lightweight guided-flow quick-capture screen (Screen
  5a). It's now just: photo, item name, an optional "why does this matter"
  note, Save, and a Skip link. The full Memories tab's own add-form is
  untouched — it still has storage + the linked give-to-kids checkbox,
  since that's a different, more deliberate entry point.
- **Price Guide rebuilt as a global overlay.** Added a Price Guide icon
  button in the topbar and a new `price-guide-overlay` (reusing the
  existing category-accordion content) that opens on top of anything,
  including mid-guided-flow. Both "Full pricing guide →" links (Review
  screen and the regular Add Item form) now open this overlay instead of
  navigating tabs. The "Pricing Guide" sub-tab under Sort + Price was kept
  as-is, not removed — so it's reachable both ways.
- **Capture screen rebuilt to match mockup.** Eyebrow label showing the
  active room (or "Any room"), headline "Photograph one item," updated
  subtext, and the whole capture area is now one big tappable card ("Tap to
  open your camera" / "Works with your phone's camera directly") instead of
  a small button under an icon.
- **Review screen: clean success state added.** When the AI successfully
  identifies an item, the screen now shows a clean summary (photo + bold
  item name + category + a "Not quite right? Fix it" link) instead of
  always dropping straight into the full manual form. Tapping "Fix it"
  reveals the full form (name field, category/item dropdowns, brand
  checkbox) exactly as before. If the AI didn't guess, the full form still
  shows immediately, unchanged.
- **Sell screen nudge box fixed.** Border changed from dashed to solid.
  Nudge text is now dynamic based on the actual reason for the nudge:
  brand detected, Collectibles & Extras category, or price threshold —
  each gets its own explanation instead of one generic sentence.
- **Batch screen tweaks.** "Start a new batch" now reads "Or start a new
  batch" once at least one batch already exists. Existing-batch tiles are
  now center-aligned to match the mockup.
- **Top nav reachable from inside the guided flow — new fix, not from the
  mockup.** Cece flagged that once inside the Sort + Price guided flow
  (camera/review/sell screens), there was no way to jump to another main
  section — only a close (×) button, which either backs all the way out or
  requires finishing the whole flow to reach Summary. Added a jump-to-tab
  strip at the top of the guided flow (Start / Sort + Price / Sell +
  Promote / Prep + Safety / Sale Day + Wrap Up) so Print Command Center and
  every other section is reachable mid-flow, not just after "All done."
- **Real bug fix: AI photo-ID backend path.** `gsIdentifyPhoto()` was
  fetching `/garage-identify-item.php`, but the file actually lives at
  `/api/garage-identify-item.php` — meaning the AI photo-ID feature could
  never have worked and was always silently falling back to manual entry.
  Fixed the path.
- **Local color fix.** The Sort + Price `.gs-nudge` box was using `#426DB3`
  (not on the locked palette) directly for its border and text color;
  changed to `#8BA7D4` (Periwinkle, a locked color, appropriate here since
  it's a text/border accent, not a button).
- **Syntax verified.** Ran a full parse check (via acorn) across the file's
  single script block after all edits — confirmed clean, including after
  catching and fixing one real bug introduced mid-session (an unescaped
  apostrophe in a nudge-text string that broke the template literal).
- **Routing table re-verified against code, not just design intent.** Every
  entry in `GS_ROUTES` was checked against `flowSections` to confirm it
  points to a tab/section that actually exists. All seven decision types
  (Garage Sale, Sell Online, Donate, Trash, Given to kids, Memory Box,
  Batch) resolve correctly — see table below.

---

## CLOSED OUT (2026-07-12, from the previous session)

- **Deployed to the live site.** Confirmed live at
  `mynestchapter.com/widgets/garage-sale-planner/`. Along the way, found and
  fixed an unrelated server issue — the live `widgets/` folder had been
  renamed to `widget-OLD-backup.html`, which is why every widget on the site
  (not just this one) was 404ing.
- **Accessibility pass.** Added `role="status" aria-live="polite"` to the
  Analyzing screen so screen reader users get a signal something is
  happening. Everything else already had proper labels and 44px targets.
- **Copy inconsistency fixed.** Guided-flow Memory Box storage placeholder
  matched to the Memories tab wording (this field was later removed
  entirely in the 2026-07-13 session — see above).
- **Brand & Visual QA sweep (Gate 3 per CLAUDE.md).** Fixed one violation:
  the stat-strip legend text was using cool gray (`#5a5a68`); changed to
  `var(--color-text-muted)`. Border-radius/box-shadow non-zero in this file
  is the documented one-file exception (2026-07-03/04) — not a violation.
- **Committed and pushed to git.**

---

## SCREEN-BY-SCREEN: WHAT IT ACTUALLY LOOKS LIKE RIGHT NOW

### Screen 1 — Room Picker / Entry (`gsEntryScreen`) — ✅ matches mockup
Unchanged from before — eyebrow "Start here," 2-column room grid, "Just
start snapping →," "All done for now — see my summary" if any items exist.

### Screen 2 — Capture (`gsCaptureScreen`) — ✅ now matches mockup
- Eyebrow: active room name, or "Any room" if none picked
- Headline: "Photograph one item"
- Subtext: "Snap what you're holding. You'll decide what to do with it
  next."
- Whole capture area is one big tappable card: camera icon, "Tap to open
  your camera," "Works with your phone's camera directly" — tapping
  anywhere on the card opens the phone camera
- Tip line below about designer/name-brand labels, unchanged
- "Done with [Room] →" if a room is active with ≥1 item sorted
- "All done for now" link, always present

### Screen 3 — Analyzing (`gsAnalyzingScreen`)
Unchanged — centered "One moment..." card with `aria-live="polite"`.

### Screen 4 — Review (`gsReviewScreen`) — ✅ now has a clean success state
- If the AI successfully guessed (`aiGuessed` true, a category matched, and
  an item name is set) and the user hasn't tapped "Fix it": shows a clean
  card — photo, bold item name, category as an eyebrow label, "Not quite
  right? Fix it" link — followed directly by the pricing-guide link and the
  six decision buttons. No form fields shown at all in this state.
- Tapping "Fix it" (or if the AI didn't guess anything at all) shows the
  full form: "What is it?" field, Category + Item Type dropdowns, brand
  checkbox, pricing guide link, then the same six decision buttons.

### Screen 5a — Memory Box note (`gsMemoryScreen`) — ✅ matches mockup
- Photo, item name, "Memory Box" label
- "Why does this one matter? (optional)" textarea only — no storage field,
  no "give to kids" checkbox (both removed this session)
- "Save to Memory Box" button, "Skip for now" link

### Screen 5b — Batch pick (`gsBatchScreen`) — ✅ now matches mockup
- Existing batches as tappable, center-aligned tiles: label + "$X each"
- "Start a new batch" heading, or "Or start a new batch" once ≥1 batch
  exists
- Type dropdown, Price field, Description field, "Create batch and save
  item" button

### Screen 6 — Condition + Price / Sell (`gsSellScreen`) — ✅ now matches mockup
- Excellent / Good / Fair condition buttons, unchanged
- Caution note for car seats, unchanged
- Nudge banner: solid border (was dashed), and the explanation text is now
  specific to the actual reason — brand detected, Collectibles & Extras
  category, or price threshold — each with its own sentence
- Price display/edit field, brand badge if detected, unchanged
- "Use this price" / "Sell Online" (when nudge shows), unchanged

### Screen 7 — Room Complete (`gsRoomCompleteScreen`)
Unchanged.

### Screen 8 — Summary (`gsSummaryScreen`) — ✅ matches mockup
Unchanged — destination tiles now correctly show "Print Command Center →"
for the Garage Sale tile (was already fixed to this in code, confirmed
against the mockup this session).

### Guided flow — jump nav (new this session)
Every guided-flow screen now has a horizontal row of buttons at the top —
Start / Sort + Price / Sell + Promote / Prep + Safety / Sale Day + Wrap
Up — next to the close (×) button. Tapping one closes the guided flow and
jumps straight to that section's default sub-tab, so Print Command Center
and every other part of the widget is reachable at any point mid-sort, not
just after finishing the flow or backing all the way out.

### Price Guide — global overlay (new this session)
A Price Guide icon button now lives in the main topbar, next to Help.
Tapping it opens the same category-by-category price accordion as the
Pricing Guide tab, in an overlay that renders on top of anything — including
mid-guided-flow. Both "Full pricing guide →" links (Review screen, regular
Add Item form) now open this overlay directly instead of navigating tabs.
The Pricing Guide sub-tab under Sort + Price is untouched and still there.

### Batch Items tab, Memories tab, Print Command Center tab
Unchanged from the 2026-07-12 pass — all still correct.

---

## BUTTON → DESTINATION MAP (every navigating button in the guided flow)

| Screen | Button | Goes to |
|---|---|---|
| Any guided screen | Jump nav (Start/Sort+Price/Sell+Promote/Prep+Safety/Sale Day+Wrap Up) | Closes guided flow → that tab's default section |
| 1 Room Picker | Any room tile | Screen 2 (Capture), with that room set |
| 1 Room Picker | + Add Room | Prompt for a name → Screen 2, with that room set |
| 1 Room Picker | Just start snapping → | Screen 2 (Capture), no room set |
| 1 Room Picker | All done for now — see my summary | Screen 8 (Summary) |
| 2 Capture | Tap to open your camera (whole card) | Screen 3 (Analyzing) → Screen 4 (Review) |
| 2 Capture | Done with [Room] → | Screen 7 (Room Complete) |
| 2 Capture | All done for now | Screen 8 (Summary) |
| 4 Review | Full pricing guide → | Opens Price Guide overlay (stays on Review underneath) |
| 4 Review | Not quite right? Fix it | Reveals full manual form, same screen |
| 4 Review | Sell | Screen 6 (Condition + Price) |
| 4 Review | Donate / Trash / Give to Kids | Saves instantly (price $0) → back to Screen 2 |
| 4 Review | Memory Box | Screen 5a (Memory note) |
| 4 Review | Add to a Batch | Screen 5b (Batch pick) |
| 5a Memory note | Save to Memory Box / Skip for now | Saves item → back to Screen 2 |
| 5b Batch pick | Existing batch tile | Saves item into that batch → back to Screen 2 |
| 5b Batch pick | Create batch and save item | Creates batch + saves item → back to Screen 2 |
| 6 Sell | Use this price | Tags `Garage Sale` → back to Screen 2 |
| 6 Sell | Sell Online (only if nudge showing) | Tags `Sell Online` → back to Screen 2 |
| 7 Room Complete | Next room → | Screen 1 (Room Picker) |
| 7 Room Complete | All done for now | Screen 8 (Summary) |
| 8 Summary | Garage Sale tile | Sale Day + Wrap Up → Print Command Center |
| 8 Summary | Sell Online tile | Sell + Promote → Sell Online sub-tab |
| 8 Summary | Donate tile | Sale Day + Wrap Up (Wrap Up section) |
| 8 Summary | Trash tile | Sale Day + Wrap Up (Wrap Up section) |
| 8 Summary | Give to Kids tile | Sort + Price → Memories |
| 8 Summary | Memory Box tile | Sort + Price → Memories |
| 8 Summary | Batch tile | Sort + Price → Batch Items |
| 8 Summary | ← Keep sorting | Screen 1 (Room Picker) |
| 8 Summary | Back to Start | Closes guided flow → Start tab |

This table is re-verified against the actual `GS_ROUTES` and `flowSections`
objects in code as of 2026-07-13 — every destination tab/section confirmed
to exist.
