# Garage Sale Planner — Sort + Price Interactive Rebuild — Full Build Brief

Confirmed spec from Cece, July 10 2026, approved after a full mockup review.
Mockup lived at a local scratchpad file during design (not in this repo) —
this brief is the complete, standalone spec. Nothing described here has been
written into `widget.html` yet.

Work on `widgets/garage-sale-planner/widget.html` only. Do not touch fonts,
colors, border-radius, or box-shadow — follow whatever this file's existing
locked design system already is (read CLAUDE.md and DESIGN.md first, as
always). This brief is layout and data flow only, no visual decisions.

This is large. Recommend phasing it (data model → guided flow UI → pricing
data → Batch Items rebuild → Memories rebuild → Print Command Center →
AI backend last, since it's the one piece with an external dependency) rather
than one giant diff — matches how the 7-phase visual reset rollout was done
in this same file.

**Do not remove or break:** the existing Add Item form (name/category/
condition/quantity/decision/price/notes) stays exactly as-is — everything
below is a new, faster path that sits alongside it, not a replacement. Same
for Quick Notes, the existing Pricing Guide category-range display concept
(though its data and access point both change — see Section 4), and every
other existing feature not named in this brief.

---

## Section 0 — What this is

Today, Sort + Price is one form: type in an item's name, category, condition,
price, decision, done. It works, but it's slow when she's holding a physical
object in her hand and just wants to log it and move to the next one. This
brief adds a guided, camera-first path: photograph the item, tell the tool
what to do with it, and for anything she's selling, get a price without
having to know what a "fair condition kitchen item" is worth in her market.

The six things she can do with an item: **Sell**, **Donate**, **Give to
Kids**, **Trash**, **Memory Box**, **Batch**. Each of the last five is
one tap and done — no pricing step. Only Sell branches further.

---

## Section 1 — Data model changes

### `items[]` — new/changed fields on each item
- `room` — string or null (which room she was sorting when logged, optional)
- `photo` — the captured photo (storage mechanism is an implementation
  decision — could be a data URL kept client-side like other photo fields
  already in this file, e.g. `handleBoxPhoto`/`handleMemoryPhoto`)
- `label` — item name (AI-guessed, or manually corrected/typed)
- `category` — one of the 9 categories in Section 4 (not the old 8 — see below)
- `brand` — boolean, whether a recognized brand/logo was detected in the photo
- `decision` — existing field, now one of: `Garage Sale`, `Sell Online`,
  `Donate`, `Give to Kids`, `Trash`, `Memory Box`, `Batch`
- `condition` — Excellent/Good/Fair, only set when decision leads through
  pricing (Garage Sale, Sell Online, Batch items inherit their batch's price
  instead)
- `price` — existing field, 0 for Donate/Give to Kids/Trash, computed from
  the pricing table otherwise
- `batchId` — only when decision is `Batch`, references `batches[].id`
- `note` — free text, used by Memory Box ("why does this matter") — reuse the
  existing note field if items already have one
- `storage` — only when decision is `Memory Box` — where she's storing it
- `alsoGiveToKids` — boolean, only relevant on Memory Box items, see Section 6
- `given` — boolean, only when decision is `Give to Kids` — whether it's
  actually been handed off yet

### `batches[]` — new top-level array (or rename/extend the existing
`batchItems` array from the 2026-07-06 Sort + Price rebuild if that's a
better fit — check what's live first)
- `id` — unique id
- `type` — one of: Table, Basket, Shelf, Box, Bag, Rack, Bin, Counter, Other
  (this already exists as the batch Type field per the 2026-07-06 changelog
  entry — reuse it)
- `price` — shared price for every item in this batch
- `description` — optional free text (e.g. "Utensils, extra mugs, small
  kitchen odds and ends")

Batches are identified everywhere in the UI (card titles, move-between-
batches menu) by **Type + Description**, not a separate name/label field.
If Description is empty, just show Type. This deliberately replaces the
Label and Category fields that exist on the current live Create-a-Batch
form — see Section 5 for why.

---

## Section 2 — Guided photo-sort flow (new — lives in Sort + Price → Items,
alongside the existing Add Item form)

A persistent stat strip sits above whichever screen below is active,
showing live totals: total sale value so far, total items sorted, and a
segmented bar breaking down what's been tagged as what (Garage Sale / Sell
Online / Donate / Give to Kids / Trash / Memory Box / Batch), each segment
only appearing once it has ≥1 item.

**Screen 1 — Room picker.** Room chip buttons (reuse existing room concept
if one exists, otherwise: Garage, Kitchen, Bedroom, Kids' Room, Living Room,
Attic, Basement, +Add Room). Each chip that already has sorted items shows a
checkmark + its count + its dollar value. A "just start snapping" option
skips room selection entirely. Once she has any items sorted, an "all done
for now — see my summary" option also appears here.

**Screen 2 — Capture.** A camera-trigger button (`<input type="file"
accept="image/*" capture="environment">` opens the phone camera directly).
A persistent tip line: "if it's a designer or name-brand item, try to get
the label or logo in the photo too — it helps catch the brand and get you a
better price." Once she's tagged ≥1 item in the current room, a "Done with
[Room] →" button appears here, leading to Screen 7. The "all done for now"
option is also available here.

**Screen 3 — Analyzing.** Brief automatic pause while the photo is sent for
identification (see Section 3). No input.

**Screen 4 — Review.** Shows the photo, the AI's guessed item label (with a
"not quite right? fix it" link that opens a manual category picker — same
underlying price lookup either way, see Section 3's fallback note), then six
decision buttons: **Sell**, **Donate**, **Give to Kids**, **Trash**,
**Memory Box**, **Batch**.

- Donate / Give to Kids / Trash → save instantly (price 0), back to Screen 2.
- Memory Box → Screen 5a.
- Batch → Screen 5b.
- Sell → Screen 6.

**Screen 5a — Memory Box note.** One optional field: "why does this matter?"
(textarea, skippable). Also one field: "where are you storing it?" (text
input, optional). Also a checkbox: "Also give this to my kids" — if checked,
saving this item ALSO creates a second item with the same label, decision
`Give to Kids`, note "from the Memory Box", `given: false`. Save button.

**Screen 5b — Batch pick.** List of existing batches as tappable chips
(each showing Type + Description + price), or a small inline form to start
a new one: Type (dropdown, the 9 options from Section 1), Price, Description
(optional). Selecting or creating saves the item with that `batchId` and the
batch's price, back to Screen 2.

**Screen 6 — Condition + price (Sell only).** Three condition buttons:
Excellent / Good / Fair. Once tapped, look up the price from the table in
Section 4 (category + item type + condition, or the category's brand tier if
a brand was detected and no specific item-type row matches). Show it as an
editable price field she can accept or change. Show a nudge banner ("worth a
look online first?") when: a brand was detected, OR the category is
Collectibles and Extras (always), OR the price is ≥ $20. Two buttons: "Use
this price" (tags `Garage Sale`) or, only when the nudge is showing, "Sell
Online" (tags `Sell Online`). Either way, saves and returns to Screen 2.

**Screen 7 — Room complete** (reached from the "Done with [Room]" button).
Recap: item count and dollar value for that room. "Next room →" (back to
Screen 1) or "all done for now" (Screen 8).

**Screen 8 — Summary.** Total items + total value. A grid of tappable tiles,
one per decision type, each showing its count and, on tap, navigating to its
real destination per the routing table in Section 8 — not a popup, an
actual tab switch. Below that: "Keep sorting" (back to Screen 1) and "Back
to Start" (returns to the Start tab) with a plain recap line above it: "You
sorted [X] items worth $[Y] today. Come back anytime — nothing's lost."

---

## Section 3 — AI photo identification (new backend dependency, not built
anywhere yet)

**Scope is deliberately narrow, this was a specific cost/reliability call:**
the AI's only job is (a) identify what kind of item is in the photo, mapped
to the closest matching row in the pricing table below, and (b) detect
whether a recognized brand/logo/label is visibly readable in the photo. **The
AI never generates a price.** Price always comes from the locked table in
Section 4. This keeps the per-photo AI call cheap (a classification task, not
a generation task) and keeps pricing trustworthy and fully controlled by
Cece, not an AI guess.

**Provider: Claude API (Anthropic), model `claude-haiku-4-5`.** Chosen for
cost — Haiku 4.5 is $1/MTok input, $5/MTok output (verified against
Anthropic's current pricing page). A single photo classification call (one
image + a short prompt, small JSON response) runs roughly 1,000–2,500 input
tokens and 100–150 output tokens — **about $0.002–$0.004 per photo.** Even a
customer photographing 200 items for a large sale costs under $1 in AI spend
total. No cost cap or throttling is needed at this price point.

Needs: a new PHP endpoint (e.g. `garage-identify-item.php`) that accepts an
uploaded photo, calls `claude-haiku-4-5` via the Anthropic PHP SDK with a
prompt asking for item category + specific type + any visible brand name
(structured JSON output via `output_config.format`), and returns that to the
frontend. Anthropic API key lives server-side only in `config.php`
(gitignored), same pattern as the Stripe keys already in this codebase —
never in client JS. Cece needs to generate this key from the Anthropic
Console before this phase can be built.

**Fallback (required, not optional):** if the API call fails, times out, or
she's offline, Screen 4 (Review) should fall back to the same manual
category-and-item-type picker used by the "fix it" link — same price table,
same result, just typed instead of guessed. Design the review screen so this
fallback path and the AI-guess path converge on the same UI, not two
different experiences.

---

## Section 4 — Pricing data (locked, do not invent different numbers)

**9 categories** (this replaces the current 8-category `pricingGuide`
structure — Clothing/Furniture/Kitchen/Electronics/Toys/Garage-Sports/Home
Goods/Other — with a real taxonomy change, not just added detail): Clothing
and Shoes, Furniture, Kitchen Items, Home Decor, Baby and Kids, Tools and
Garage, Electronics and Media, Sports and Outdoor, Collectibles and Extras.

Each category has a **brand tier** — Excellent/Good/Fair pricing used when a
recognized brand is detected but there's no specific matching item-type row
(or the item-type row itself is already brand-specific, like the two ★ rows
below). Each category also has a **recognized brands list** used by the AI
prompt to decide whether to flag brand detection.

Format below: `Item — Excellent/Good/Fair`. ★ = this row is itself a
brand-specific price, don't also apply the category's general brand tier to
it.

**Clothing and Shoes** — brand tier 15/10/5
Denim jeans 4/2.50/1, Designer jeans/denim★ 15/10/5, Winter coat 6/4/2,
Hoodie/sweatshirt 4/2.50/1, Sweatpants 3/2/1, Leggings 3/2/1, Dress shirt
3/2/1, Women's blouse 3/2/1, Kids' jacket 4/2.50/1, Sneakers 5/3/1.50, Boots
6/4/1.50, Winter hats/gloves 2/1/0.50, Baseball hats 2/1/0.50, Designer
handbag/purse★ 40/22/10, Purse (not designer) 3/2/1.
Brands: Coach, Kate Spade, Michael Kors, Louis Vuitton, Gucci, Prada, Dooney
& Bourke, Ralph Lauren, Tommy Hilfiger, Nike, Lululemon, The North Face,
Patagonia, Ugg.

**Furniture** — brand tier 150/85/40
Dining chair 25/15/8, Folding card table 20/12/6, End table 25/15/8, Coffee
table 35/20/10, Dresser 60/35/18, Nightstand 25/15/8, Bookshelf 30/18/10,
Desk 45/25/12, Floor lamp 20/12/6.
Brands: Pottery Barn, West Elm, Crate & Barrel, Ethan Allen, Restoration
Hardware, Herman Miller, Room & Board, Design Within Reach, Ballard Designs,
Arhaus.

**Kitchen Items** — brand tier 35/20/8
Pyrex baking dish 4/2/1, Cast iron skillet 8/5/2.50, Set of plates 5/3/1,
Mixing bowls 4/2/1, Coffee maker 10/5/2, Toaster 8/4/1.50, Blender 10/5/2,
Measuring cups 2/1/0.50, Silverware set 6/3/1.50.
Brands: Le Creuset, All-Clad, KitchenAid, Vitamix, Lodge, Instant Pot,
Cuisinart, Wüsthof, Staub, Breville, Ninja, Pyrex (vintage pattern).

**Home Decor** — brand tier 25/14/6
Picture frame 2/1/0.50, Wall mirror 8/4/1.50, Table lamp 8/4/1.50,
Candlesticks 3/1.50/0.50, Throw pillows 3/1.50/0.50, Decorative vase
4/2/0.75, Wall art 5/2.50/1, Clock 5/2.50/1.
Brands: Pottery Barn, West Elm, Restoration Hardware, Anthropologie,
Waterford, Lenox, Tiffany & Co, Baccarat.

**Baby and Kids** — brand tier 70/40/18
Stroller 30/18/8, High chair 20/12/5, Pack-and-play 25/15/6, Car seat
25/12/5, Toy bin (full) 8/4/1.50, Stuffed animals 2/1/0.50, LEGO set
(complete) 10/6/2.50, Board game 5/3/1, Children's books 1/0.50/0.50.
Brands: UPPAbaby, Nuna, Bugaboo, Chicco, Britax, Stokke, BabyBjörn,
Ergobaby, Graco (premium line).
**Car seat gets a caution note wherever it's shown:** "Check the expiration
date before selling — most expire 6–10 years from manufacture."

**Tools and Garage** — brand tier 55/32/14
Hammer 4/2/1, Screwdriver set 6/3/1.50, Wrench set 8/4/2, Power drill
20/12/5, Circular saw 25/15/6, Extension cord 4/2/1, Tool box 10/5/2, Lawn
rake 5/2.50/1, Shovel 6/3/1.50.
Brands: DeWalt, Milwaukee, Makita, Bosch, Snap-on, Klein Tools, Stihl,
Husqvarna, Craftsman (vintage).

**Electronics and Media** — brand tier 110/60/25
Flat-screen TV 50/25/10, DVD player 10/5/1, Game console 40/20/8, Wireless
speaker 12/6/2, Headphones 10/5/2, Laptop (older model) 50/25/10, Tablet
50/25/10, VHS tapes (lot) 1/0.50/0.25, Vinyl records (each) 3/1.50/0.50.
Brands: Apple, Bose, Sony, Samsung, Nintendo, Dyson, Beats, Sonos, Canon,
Nikon, JBL, GoPro, Bang & Olufsen.

**Sports and Outdoor** — brand tier 50/28/12
Bicycle 22/12/5, Tennis racket 6/3/1, Golf clubs (set) 22/12/5, Camping tent
18/10/4, Sleeping bag 10/5/2, Fishing rod 8/4/1.50, Ice skates 10/5/2,
Dumbbells (pair) 12/6/2.
Brands: Trek, Specialized, Callaway, Titleist, Patagonia, The North Face,
Yeti, Cannondale, Under Armour, Nike.

**Collectibles and Extras** — no brand tier, no brand list. This category
**always** shows the "might be worth more — check online first" nudge on
every item, regardless of price or brand, since value here is about rarity
and age, not a printed label a photo can catch.
Costume jewelry 3/1.50/0.50, Comic books 2/1/0.50, Baseball cards 2/1/0.50,
Vintage toy car 5/2.50/1, Antique doll 8/4/1.50, Postcards 1/0.50/0.25,
Sewing machine 20/10/4.

**Nudge trigger logic (applies across every category):** show the "worth
more online?" banner when brand is detected, OR category is Collectibles and
Extras, OR the looked-up price is ≥ $20. (The $20 threshold was deliberately
chosen over a lower one — $10 fires on too many ordinary items like a
coffee maker or floor lamp and trains her to ignore it.)

---

## Section 5 — Batch Items tab (simplify the existing 2026-07-06 rebuild)

Keep the existing card-per-batch layout and the Type dropdown. Change:

- **Create form fields: Type, Price ("everything here, $"), Description
  (optional).** Remove the Label, Category, and Photo fields from the
  current live form.
- Batch cards and the "move item to a different batch" picker identify each
  batch by **Type + Description** (e.g. "Table — $1 items"), not a separate
  name — see Section 1.
- Each batch card shows a live total: price × item count, recalculating
  immediately if the price is edited.
- Items can be moved from one batch to another via a tap-to-move menu (a
  short list of the other batches) — not drag-and-drop, chosen deliberately
  for mobile reliability.
- Replace the current per-batch "Preview & Print Signs" button with **one**
  "Print saved tags →" button for the whole tab, which takes her to Print
  Command Center (Section 7) → its Batch sub-tab, showing every batch's tag
  ready to print. No inline print preview on this tab — keep it lean, the
  preview lives in Print Command Center.

---

## Section 6 — Memories tab (full rebuild — current live version is a flat
form with no real interaction)

One tab, two clearly separate sub-sections — these are emotionally different
tasks and should not be visually blended into one shared list or form.

**Memory Box.** This is NOT a status-tracker — an earlier draft had
Photographed/Keeping it/Passed on/Donated/Sold status chips and that's
explicitly cut. It's just "I have this, here's where it lives." Each item
shows as a card: name + storage location visible immediately, tap the card
to reveal the note underneath (a settle-open reveal, not a flip animation —
this echoes the "you don't have to hold onto something to hold onto the
memory" line already on the live page). Add form: item name, "where are you
storing it?" (optional), "why does it matter?" (optional textarea), and a
checkbox "Also give this to my kids" (see Section 1 — creates a linked Give
to Kids entry).

**Give to Kids.** A plain checklist: item name, optional note, and a tap
target that toggles `given` — checked items show struck through with a
"✓ Given" label, unchecked show "Mark given". Its own simple add form: item
name, optional note.

**Both sections end in one shared action row: "Print Memory Box list" and
"Print Give to Kids list."** The Memory Box print output is a plain list
(name — stored: location). The Give to Kids print output has a checkbox in
front of each line (`[ ] item — note`) since the whole point is she checks
items off on paper as she physically hands them over.

---

## Section 7 — Print Command Center (new section, not built anywhere yet)

This brief does not fully spec Print Command Center's build — that's its own
brief. What's required from THIS brief's scope: Garage Sale items and
completed Batch tags both need somewhere real to land. Flag to Cece before
building this section standalone — there's an open question whether this is
a rename/expansion of the existing "Print Center" tab or a genuinely new
section, unresolved as of this brief.

---

## Section 7.5 — Accessibility requirements (found via a WCAG audit of the
design mockup, must carry into the real build)

- **Every interactive element that isn't already a `<button>` or `<a>`
  needs real keyboard support** — the mockup used `<div onclick=...>` in
  several places (summary tiles, the Give to Kids "mark given" row, Memory
  Box card expand/collapse, batch chips, the Price Guide category rows).
  In the real build these need to be actual `<button>` elements (preferred)
  or have `role="button" tabindex="0"` plus a keydown handler for
  Enter/Space. Don't ship click-only divs for anything a customer needs to
  operate.
- **Every `<label>` needs a `for` attribute matching its input's `id`** —
  screen readers can't associate a visually-adjacent label with its field
  without this. Applies to every form field across the guided flow, Batch
  Items, and Memories add-forms.
- **Any text link doubling as a tap target** (e.g. "fix it", "move to a
  different batch", "mark given") needs at least a 44×44px effective tap
  area, even if the visible text is small — pad the hit area, don't just
  rely on the text's own bounding box.
- **Color pairing note:** if implementation reuses this file's Deep Rose
  `#C44570` as a background with light/cream text on top, that combination
  measures 4.42:1 — under the 4.5:1 AA floor for normal-weight text. This
  widget's own live code already solved this exact problem before (see the
  2026-07-07 "sunlight contrast fix" CLAUDE.md entries) — reuse that same
  darker shade for any cream-on-rose text pairing rather than the base rose.

## Section 7.6 — Interaction refinements (found via a design critique pass
on the approved mockup, apply during Phase 2)

The core loop is right — photograph, decide, next item, fast. Five findings
that make it match the "never overwhelming, always one clear next step"
goal more precisely:

- **Save confirmation on every decision, not just Sell.** Right now
  accepting a Garage Sale price gets a visible moment (the price-tag
  stamp), but Donate/Give to Kids/Trash/Batch save silently and the camera
  just reappears. Add a brief toast on every save ("✓ Saved to Donate") so
  she never has to wonder if a tap registered.
- **Give that toast a 3–4 second Undo.** A mis-tap (Trash instead of
  Donate) currently has no immediate recovery inside the guided flow — she'd
  have to go find and fix it later in the Items list. A short-lived Undo on
  the save toast closes that gap without adding a confirmation step to the
  normal path.
- **Make the "fix it" correction link more visible.** It's the only place
  in the whole flow where she corrects a wrong AI guess, and getting the
  category right directly affects her price — currently it's a small
  underlined text link, easy to miss on a screen where everything else is
  a big obvious button.
- **Simplify the very first screen.** As designed it shows 9 tappable
  things at once (7 room chips + skip + a conditional summary link) before
  she's done anything. Since room selection is optional, lead with "Just
  start snapping" as the one obvious default action, with room selection
  available as a secondary/collapsed option rather than the dominant visual
  element on her very first screen.
- **Rebalance the Summary screen's visual weight.** It currently shows 9
  tappable things too (7 destination tiles + Keep Sorting + Back to Start) —
  the most choices anywhere in the flow, right at the moment meant to feel
  like closure. The 7 tiles should read as quieter/informational relative to
  the two real decisions (Keep Sorting / Back to Start), which should be
  the visually dominant elements on this screen.

## Section 8 — Destination routing (final, confirmed after several
corrections during design — follow this table exactly, it is not
symmetrical)

| Decision | Destination |
|---|---|
| Garage Sale | Print Command Center |
| Sell Online | Sell + Promote tab → existing Sell Online sub-tab |
| Donate | Sale Day + Wrap Up **only** — do NOT also surface in Memories |
| Trash | Sale Day + Wrap Up |
| Give to Kids | Sort + Price → Memories sub-tab |
| Memory Box | Sort + Price → Memories sub-tab |
| Batch | Sort + Price → Batch Items sub-tab (the real tab, not a summary) |

Tapping a Summary tile (Section 2, Screen 8) should perform a real tab
switch to the destination, not open a generic popup or stub screen.

---

## One Prompt — Paste This Into Claude Code

```
Act as Senior Frontend Engineer for My Nest Chapter. Read CLAUDE.md and
DESIGN.md in this repo before touching anything. This is a large build —
break it into phases and confirm each phase works before moving to the
next, rather than one giant diff. Do not touch fonts, colors, border-radius,
or box-shadow anywhere — follow the file's existing locked design system
exactly. Do not remove the existing Add Item form, Quick Notes, or any
feature not named below — this is additive.

Work only in widgets/garage-sale-planner/widget.html (plus one new PHP
endpoint for Section 3).

GOAL: add a guided, camera-first sorting flow to Sort + Price, alongside the
existing Add Item form, plus rebuild Batch Items and Memories to match.

PHASE 1 — Data model. Add to items[]: room, photo, label, category, brand,
condition (already exists), batchId, note, storage, alsoGiveToKids, given.
Add a new batches[] array (or extend the existing batchItems array from the
2026-07-06 rebuild): id, type, price, description. Migrate the existing
8-category pricingGuide to the 9-category structure and full item-level
price table in Section 4 of GarageSalePlanner_SortPriceInteractive_Brief.md
(read that file for the complete locked numbers — do not invent different
ones). Each category needs a brandTier [Excellent,Good,Fair] array and a
brands[] string array, both in that same brief file.

PHASE 2 — Guided flow UI. Build the 8-screen flow described in Section 2 of
the brief: room picker → camera capture → analyzing → review (6 decision
buttons: Sell/Donate/Give to Kids/Trash/Memory Box/Batch) → branches for
each decision → room-complete recap → summary. A persistent stat strip
(total value, total items, segmented breakdown bar) sits above the active
screen. Live inside the existing Sort + Price → Items sub-tab, as an
alternate entry point to the same items[] data the current Add Item form
already writes to. Apply the 5 interaction refinements in Section 7.6 as
part of this phase, not as later polish: a save-confirmation toast with a
short Undo window on every decision (not just Sell), a more visible "fix
it" correction affordance, a simplified first screen that leads with "just
start snapping" over the 7-room grid, and a Summary screen where the 7
destination tiles read as quieter/secondary next to the two real actions
(Keep Sorting / Back to Start).

PHASE 3 — Pricing lookup + nudge logic. Condition tap → look up price from
the Phase 1 table (category + item type + condition, falling back to the
category's brand tier when brand is detected and no item-type match exists).
Show the nudge banner per the exact trigger logic in Section 4 (brand
detected, OR Collectibles and Extras category, OR price ≥ $20). Accepting
tags Garage Sale; the Sell Online button (shown only when nudge is showing)
tags Sell Online instead.

PHASE 4 — Price Guide reference panel. An icon-triggered panel (same pattern
as the existing Help/Bell/Quick Notes icons) showing all 9 categories,
tap to expand each and see its full item-by-item price table, condition
columns, and its brand list. Include a legend explaining any visual marker
used for brand-specific rows.

PHASE 5 — Batch Items tab rebuild. Per Section 5: trim the create form to
Type/Price/Description only (remove Label/Category/Photo), identify batches
by Type + Description everywhere, add live per-batch totals, add tap-to-move
between batches, replace the per-batch print button with one "Print saved
tags" button routing toward Print Command Center.

PHASE 6 — Memories tab rebuild. Per Section 6: two sub-sections (Memory Box,
Give to Kids), Memory Box has NO status-tracking (name + storage location +
optional note, settle-open card reveal), Give to Kids is a given/not-given
checklist, both have simple add forms, both get their own print button at
the end of the tab (Give to Kids prints with checkboxes for physical
checking-off). Wire the "also give this to my kids" checkbox on the Memory
Box add form to create a linked Give to Kids item.

PHASE 7 — Destination routing. Wire the Summary screen's tappable tiles
(and the existing Sort + Price nav) to the exact routing table in Section 8
of the brief — Donate goes ONLY to Sale Day + Wrap Up, not also to Memories;
Batch routes to the real Batch Items tab, not a stub.

PHASE 8 (do last, has an external dependency) — AI photo identification
backend. New PHP endpoint accepting a photo upload, calling a vision-capable
model scoped ONLY to: identify item category/type, detect a visible
recognized brand. It must never generate a price — price always comes from
the Phase 1 table. Build the manual fallback path (category/type picker,
same price table) FIRST and make sure Phase 2's Review screen can use either
path interchangeably, so the guided flow works completely even before this
phase exists.

Accessibility, required in every phase, not a separate cleanup pass: every
interactive element is a real <button>/<a> or has role="button"
tabindex="0" + a keydown handler — no click-only divs. Every <label> has a
for= matching its input's id. Small text links that double as tap targets
(fix it / move / mark given) get a padded 44x44px hit area. If cream/light
text sits on this widget's Deep Rose background, use the darker rose shade
already established in this file's own sunlight-contrast-fix history, not
the base rose — full detail in Section 7.5 of the brief.

After each phase: confirm with Playwright that nothing existing broke
(Add Item form, Quick Notes, Pricing Guide access, existing Batch/Memories
data), zero console errors, no 375px mobile overflow, real WCAG AA contrast
on every new text/background pairing, and report what's done vs. still
pending before moving to the next phase.
```
