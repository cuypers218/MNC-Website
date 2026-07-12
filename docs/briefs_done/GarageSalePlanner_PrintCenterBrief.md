# Garage Sale Planner — Print Center Full Build Brief

Confirmed spec from Cece, June 21 2026.
This is a separate brief from ContentAdditions_Round2 — do this build after
Round 2 is confirmed live, or in a parallel branch.

Work on widgets/garage-sale-planner/widget.html only.
Do not touch fonts, colors, border-radius, box-shadow, or any existing feature.
This is an addition to the existing Print Center tab — do not remove what is
already there (inventory-based price tags + box signs).

---

## The core rule for everything in this build

She types it in the tool. The tool fills it into the design. She clicks print.
The browser print dialog opens (window.print()). She sees a clean white preview
like a normal document. She prints. She cuts where needed.

No blank items. No "write in by hand after printing." If she hasn't decided on a
price yet, she doesn't print that one yet.

---

## Section 1 — Price Tag Sheets

Add a new "Quick Price Tags" section inside the existing Price Tags sub-tab,
above the existing inventory-based tags (keep those — just add this section above).

### 4 sheet options

**Option A — Combo: $.25 + $.50**
- One sheet, split in half
- Top half: 3 rows × 6 tags = 18 tags all reading "$.25"
- Bottom half: 3 rows × 6 tags = 18 tags all reading "$.50"
- Dashed cut line across the middle of the page
- Each tag: dashed border, price large and centered, tiny "My Nest Chapter"
  wordmark at the bottom of each tag
- Print button: "Print $.25 / $.50 sheet"

**Option B — Combo: $.75 + $1**
- Same layout as Option A
- Top half: 18 tags reading "$.75"
- Bottom half: 18 tags reading "$1"
- Print button: "Print $.75 / $1 sheet"

**Option C — Mixed full sheet**
- One sheet, fills the full page
- Row 1–2: $.25 (12 tags)
- Row 3–4: $.50 (12 tags)
- Row 5–6: $.75 (12 tags)
- Row 7–8: $1 (12 tags)
- Row 9: $2 (6 tags)
- Row 10: $3 (6 tags)
- Row 11: $5 (6 tags)
- Row 12: $10 (6 tags)
- Row 13: $15 (6 tags)
- Row 14: $20 (6 tags)
- Total: 96 tags across 14 rows
- Print button: "Print mixed sheet"

**Option D — Single price sheet**
- Input field: she types any price (e.g. "$.75" or "$7" or "$12.50")
- Preview updates live showing 48 identical tags with that price
- Print button: "Print 48 × [her price] tags"

### Tag design (all 4 options)
- Square, dashed border, no rounded corners (matches existing brand rules)
- Price: Lora Bold, large, centered
- "My Nest Chapter" wordmark: DM Sans, tiny, bottom of tag, muted color
- Dashed grid lines between all tags = natural cut lines
- @media print: white background, no navigation, no tool UI
- Page size: 8.5×11, portrait, 0.5 inch margins

---

## Section 2 — Area + Table Signs

Add as a new sub-tab inside Print Center: "Area Signs"

### How it works
She picks a template from a dropdown, types her price into a field, sees a
live preview of 2 signs (the same sign twice, filling the page), hits print.

If she wants a different message, she selects "Custom" and types the full text
herself.

### Templates (dropdown)
- "Everything on this table — $[price]"
- "Everything on this rack — $[price]"
- "Everything on this shelf — $[price]"
- "Everything in this basket — $[price]"
- "Everything in this box — $[price]"
- "Everything here — $[price]"
- Custom — she types the full sign text herself

### Controls
- Template dropdown (options above)
- Price field: she types "$1" or "50¢" or whatever she wants
  (not needed if she picks Custom and types it into the text field)
- Custom text field: appears when "Custom" is selected, replaces the template
- Live preview: shows what the 2 signs will look like before printing
- Print button: "Print 2 signs"

### Sign design
- 2 per page, stacked vertically, each sign is half-page (8.5 × 5.5 inches)
- Dashed cut line across the middle
- Text: large, centered, Lora Bold for the main line, DM Sans for any sub-text
- Price: same size as or larger than the main text
- Clean white background, simple border on each sign
- @media print: no navigation, no tool UI, just the 2 signs on white

---

## Section 3 — Sale Flyers

Add as a new sub-tab inside Print Center: "Flyers"

### Auto-fill behavior
All fields pull from the Start tab (P.setup) — sale name, date, time, address,
money purpose. She can edit any field directly in the flyer preview before
printing without changing her Start tab data.

### Flyer A — Standard flyer (1 per page)
Fields that auto-fill:
- Sale name (from P.setup.saleTitle, default "Garage Sale")
- Date (from P.setup.saleDate, formatted as "Saturday, July 12")
- Start + end time (from P.setup.startTime / endTime if those fields exist,
  otherwise leave editable blanks)
- Address (from P.setup.address if that field exists, otherwise editable blank)
- Top 3 items from inventory marked "Garage Sale" decision (auto-pulled, or
  she types in "Furniture, clothing, kitchen items" as a freetext field)
- Optional: she can add a tagline or note (freetext, e.g. "Cash + Venmo welcome")

Layout:
- GARAGE SALE as the headline — Lora Bold, very large
- Date + time: large, below headline
- Address: large, clearly readable
- Featured items: bullet list or simple list, mid-size
- Tagline/note: smaller, at the bottom
- MNC wordmark: tiny, bottom right corner
- Print button: "Print standard flyer"

### Flyer B — Tear-off flyer (1 per page)
Same as Flyer A but with 8 tear-off strips at the bottom, each strip containing:
- Address
- Date
- Short URL or "mynestchapter.com" removed — just the sale info

Dashed cut lines between each strip.
Print button: "Print tear-off flyer"

### Print tip (show as small note below the buttons)
"Print 20–30 copies. Post at grocery stores, laundromats, libraries, and coffee
shops 3–5 days before your sale."

---

## Section 4 — Print Setup (Technical — applies to everything above)

This is the most important section. Everything else is content — this is what
makes it actually work when she hits print.

### window.print() behavior
Every print button in Print Center calls window.print() directly.
The browser print dialog opens — Chrome shows the sidebar dialog, Windows print
dialog also works.
She sees a clean white preview of only the tags/signs/flyers — no tool UI.
She clicks Print. Done.

### @media print CSS rules (add to existing print styles)
```css
@media print {
  /* Hide everything except the active print content */
  body > *,
  .tab-bar,
  .header,
  .footer,
  .nav,
  [class*="tab"],
  [class*="btn"],
  [class*="card"]:not(.print-content),
  [class*="sidebar"],
  #content > *:not(.print-output) {
    display: none !important;
  }

  /* Show only the designated print area */
  .print-output {
    display: block !important;
  }

  /* Page setup */
  @page {
    size: 8.5in 11in portrait;
    margin: 0.5in;
  }

  /* Tag sheets */
  .print-tag-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 4px;
    width: 100%;
  }

  .print-tag {
    aspect-ratio: 1;
    border: 1px dashed #999;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    page-break-inside: avoid;
  }

  /* Cut lines */
  .print-cut-line {
    border-top: 1px dashed #999;
    width: 100%;
    margin: 0;
  }

  /* Signs */
  .print-sign {
    width: 100%;
    height: 48vh;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    text-align: center;
    page-break-inside: avoid;
  }

  /* Flyers */
  .print-flyer {
    width: 100%;
    min-height: 90vh;
    page-break-after: always;
  }

  .print-tearoff-strip {
    border-top: 1px dashed #999;
    padding: 6px 0;
    font-size: 11pt;
  }
}
```

### Structure for each print section
Each print section should have:
1. A preview area (visible in the tool, hidden on print) — she sees what will
   print before hitting the button
2. A `.print-output` div (hidden in the tool, visible only on print) — this is
   what actually prints
3. A print button that calls window.print()

When print is triggered:
- @media print shows only `.print-output`
- Everything else in the document is hidden
- Browser opens its native print dialog
- Print preview shows clean white pages

---

## One Prompt — Paste This Into Claude Code

```
Act as Senior Frontend Engineer for My Nest Chapter. Read CLAUDE.md and the brand
skill file in this repo before touching anything.

Work on widgets/garage-sale-planner/widget.html only. This is the Print Center
expansion — do not touch fonts, colors, border-radius, box-shadow, or any
existing feature outside the Print Center tab.

The existing Print Center has inventory-based price tags and box signs. Keep
those. Add the following sections alongside them.

CORE RULE: She types text or a price into the tool. The tool fills it into the
design. She clicks a print button. window.print() fires. The browser print
dialog opens showing a clean white preview of only the print content — no tool
navigation, no cards, no buttons. She prints. Done.

---

1. QUICK PRICE TAGS — add above the existing inventory tags in the Price Tags section.

   Four options, each with its own print button:

   A. Combo $.25 + $.50 sheet: half page of 18 tags at $.25, dashed cut line,
      half page of 18 tags at $.50. Tags are square with dashed borders.

   B. Combo $.75 + $1 sheet: same layout, $.75 on top, $1 on bottom.

   C. Mixed full sheet: 14 rows of 6 tags filling an 8.5×11 page:
      2 rows $.25 / 2 rows $.50 / 2 rows $.75 / 2 rows $1 / 1 row each of
      $2, $3, $5, $10, $15, $20.

   D. Single price sheet: text input where she types any price → live preview
      updates to show 48 tags filled with that price → print button prints them.

   All tags: Lora Bold price centered, tiny DM Sans "My Nest Chapter" wordmark
   at the bottom of each tag, square shape, dashed border = cut lines.

2. AREA SIGNS — new sub-tab "Area Signs" in Print Center.

   Controls:
   - Dropdown with these templates:
     "Everything on this table — $[price]"
     "Everything on this rack — $[price]"
     "Everything on this shelf — $[price]"
     "Everything in this basket — $[price]"
     "Everything in this box — $[price]"
     "Everything here — $[price]"
     "Custom — type your own"
   - Price input field (used by all templates; hidden when Custom is selected)
   - Custom text field (shown only when Custom is selected — she types the
     entire sign text herself, including the price if she wants one)
   - Live preview showing 2 signs as they will print
   - Print button: "Print 2 signs"

   Sign layout: 2 per page, stacked vertically, each half-page (8.5 × 5.5in),
   dashed cut line between them. Text: Lora Bold, very large, centered.
   Price: same or larger size. Clean white background with simple border.

3. SALE FLYERS — new sub-tab "Flyers" in Print Center.

   Both flyers auto-pull from P.setup: saleTitle, saleDate, startTime (if it
   exists), endTime (if it exists), address (if it exists). All fields are
   editable in the flyer preview — changes do not write back to P.setup.

   Also pulls top 3 items from P.items where decision === "Garage Sale" to
   show as featured items. Falls back to an editable freetext field if
   inventory is empty.

   Flyer A — Standard (1 full page):
   Headline "GARAGE SALE" (Lora Bold, very large), date + time large, address
   large, featured items list, optional tagline field, MNC wordmark tiny bottom
   right. Print button: "Print standard flyer".

   Flyer B — Tear-off (1 full page):
   Same as Flyer A but with 8 tear-off strips at the bottom. Each strip:
   address + date, separated by dashed cut lines. Print button:
   "Print tear-off flyer".

   Show below both buttons (as a small note, not a checklist item):
   "Print 20–30 copies. Post at grocery stores, laundromats, libraries, and
   coffee shops 3–5 days before your sale."

4. PRINT CSS — make sure @media print is correctly set up so that:
   - window.print() on any print button shows ONLY the designated print
     content — no tabs, no header, no navigation, no buttons, no cards
   - Page size is 8.5×11, portrait, 0.5in margins
   - Tag sheets: 6-column grid, square tags with dashed borders, gap 4px
   - Dashed cut lines render visibly (use 1px dashed #999 or similar)
   - Signs: each sign is half the page height, centered, page-break-inside avoid
   - Flyers: full page height, page-break-after always on each flyer
   - Tear-off strips: dashed border-top between each strip

   Each print section needs:
   - A visible preview div (shown in tool, hidden @media print)
   - A .print-output div (hidden in tool with display:none, shown @media print)
   - The print button calls window.print()

When done, confirm: print preview for each button shows only the correct
content on a white page. Confirm no existing features broke.
```
