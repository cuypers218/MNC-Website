# Garage Sale Planner — Content Additions (Round 2)

Pulled from old drafts on file (Final_Approved_Widget, the Blueprint v2, and the
in-progress build) — June 21, 2026. These are content gaps only. Design system
(fonts, radius, shadow) is already locked and correct — do not touch it.

Ordered by effort: quick array edits first, bigger builds last.

---

## 1 — Safety checklist: add 4 missing lines

Add these to the existing `safetyTasks` array. Insert wherever they fit best
in the existing order — these were in an earlier draft and never made it into
the current version.

- "Don't post your address in the ad until 24 hours before — share it via DM instead"
- "Don't mention in the ad that you're running this solo"
- "Set up your table so you have a clear sightline to all buyers"
- "If something feels off, the sale is over. Trust that."

## 2 — Safety section copy: restore the warmer version

Replace the current Safety + Logistics page intro line with this earlier,
sharper version:

Current (flat): "A quick checklist so sale day feels calm and controlled."
Replace with: "You're running this by yourself. This checklist is built for that."

Replace the current safety info box with this earlier version:

Current (listy): "Keep a friend's number in your pocket. Tell someone your hours. Keep your phone charged and your cash in a crossbody bag."
Replace with: "The biggest thing: someone knows you're out there. A text check-in, a neighbor who can see the driveway, a friend on standby for large pickups. You don't need a whole system. You just need one person who knows."

## 3 — Safety section: 3 new scripted lines (never built, from the original blueprint)

Add as additional safety notes or checklist items — these are specific, scripted
responses, not generic tips:

- "If someone makes you uncomfortable, it's fine to say: 'I'm closing up for a bit, please come back in 20 minutes.' You do not owe anyone access."
- "If someone gets aggressive about pricing, the answer is always: 'That's the price — no problem if it doesn't work for you today.'"
- "Have a code word texted to a trusted person if you need backup."

## 4 — Platform cards: add 2 missing platforms

The `onlineSellingGuides` array currently has 5 cards. Add these 2 in the same
format (platform / bestFor / avoid / tip):

- **Craigslist** — bestFor: "Furniture, appliances, tools, local buyers only" | avoid: "Small items under $20" | tip: "List multiple items in one post."
- **ThredUp/Swap.com** — bestFor: "Clothing you don't want to list individually" | avoid: "Designer or high-value pieces — sell those yourself" | tip: "Payout is low but the effort is zero."

## 5 — Pricing Guide: add the rules-of-thumb callout

The category/condition grid is already built and is good. Add a simple callout
box above or below it — these 5 lines, nothing more:

- Price at 10–25% of original retail
- Round numbers sell faster: $1, $2, $5, $10
- Bundle small items — more money, less haggling
- Drop prices 50% in the last hour
- Price everything before the day — no sticker means no sale

## 6 — Rotating tips strip (new feature, small build)

Add a single-line rotating tip strip to the Start tab. Swap every 8 seconds.
Starter set (4 lines — add more later if it earns a spot):

- "Price to sell, not to keep. You'll make more by letting go."
- "Set your goal before you start. It helps you know when to stop negotiating."
- "The best garage sale sign has one word on it: BIG ARROWS."
- "Put your best stuff at the front. People decide in the first 30 seconds."

## 7 — Print Center: expand the sign library (bigger build)

Currently only prints price tags + box signs. Add these sign types using the
same print-CSS pattern already in place (clean white background, no nav):

- Directional arrow sign — half-page, large arrow, write-in address line
- Main sale sign — full page: GARAGE SALE + date/address/time, fields she fills in
- Category table signs — CLOTHING / BOOKS / KITCHEN / FURNITURE / ELECTRONICS / TOYS / MAKE AN OFFER
- Price station signs — $1 Table / $2 Table / $5 Table / Fill a Bag $3 / FREE
- Sale-day price-drop signs — "ALL PRICES HALF OFF" / "LAST HOUR — MAKE AN OFFER" / "BUNDLE DEAL: 3 items for $5"
- Printable full inventory list — clean table view of her Sort + Price items, for her records

## 8 — Sale Day: change calculator (new feature, small build)

Add to the existing Sale Day calculator card:
- Input: "Customer gave me: $[X]"
- Output: "Give back: $[Y]"
- Large, high-contrast, same tap-friendly style as the rest of Sale Day.

## 9 — Quick technical check (not content — flag to Claude Code)

An earlier draft had `for=` attributes on form labels (accessibility) and
animated single-item toggles on the safety checklist instead of re-rendering
the whole list on every click. Worth confirming the live version didn't lose
either of these along the way.

## 10 — Confirm this still exists (possible selling point)

Both code drafts had a built-in 5-step guided walkthrough (Start → Sort+Price
→ Sell+Promote → Prep+Safety → Sale Day, plain language). If it's live, it's
worth mentioning on the shop product page — most $27 planners don't have one.

---

## One Prompt — Paste This Into Claude Code

```
Act as Senior Frontend Engineer for My Nest Chapter. Read CLAUDE.md and the brand
skill file in this repo before touching anything.

Work on widgets/garage-sale-planner/widget.html only. This is a content-addition
pass on top of the already-completed design fixes — do not touch fonts, colors,
border-radius, or box-shadow, and do not restructure existing tabs or remove any
working feature.

1. SAFETY SECTION:
   - Add these 4 lines to the safetyTasks array:
     "Don't post your address in the ad until 24 hours before — share it via DM instead"
     "Don't mention in the ad that you're running this solo"
     "Set up your table so you have a clear sightline to all buyers"
     "If something feels off, the sale is over. Trust that."
   - Replace the Safety + Logistics page intro line with:
     "You're running this by yourself. This checklist is built for that."
   - Replace the safety info box copy with:
     "The biggest thing: someone knows you're out there. A text check-in, a
     neighbor who can see the driveway, a friend on standby for large pickups.
     You don't need a whole system. You just need one person who knows."
   - Add these as additional safety notes (scripted responses):
     "If someone makes you uncomfortable, it's fine to say: 'I'm closing up for
     a bit, please come back in 20 minutes.' You do not owe anyone access."
     "If someone gets aggressive about pricing, the answer is always: 'That's
     the price — no problem if it doesn't work for you today.'"
     "Have a code word texted to a trusted person if you need backup."

2. PLATFORM CARDS — add 2 entries to onlineSellingGuides, matching the existing
   format (platform / bestFor / avoid / tip):
     Craigslist — bestFor: "Furniture, appliances, tools, local buyers only" |
       avoid: "Small items under $20" | tip: "List multiple items in one post."
     ThredUp/Swap.com — bestFor: "Clothing you don't want to list individually" |
       avoid: "Designer or high-value pieces — sell those yourself" |
       tip: "Payout is low but the effort is zero."

3. PRICING GUIDE — add a simple rules-of-thumb callout box (5 lines, no
   styling changes beyond what already exists on the page):
     "Price at 10–25% of original retail"
     "Round numbers sell faster: $1, $2, $5, $10"
     "Bundle small items — more money, less haggling"
     "Drop prices 50% in the last hour"
     "Price everything before the day — no sticker means no sale"

4. ROTATING TIPS STRIP — add a new single-line rotating tip strip to the Start
   tab, swapping every 8 seconds. Use these 4 to start:
     "Price to sell, not to keep. You'll make more by letting go."
     "Set your goal before you start. It helps you know when to stop negotiating."
     "The best garage sale sign has one word on it: BIG ARROWS."
     "Put your best stuff at the front. People decide in the first 30 seconds."

5. SALE DAY CHANGE CALCULATOR — add to the existing Sale Day calculator card:
   an input "Customer gave me: $[X]" and an output "Give back: $[Y]", same
   tap-friendly, high-contrast style as the rest of Sale Day.

6. PRINT CENTER — expand the sign library using the existing print-CSS pattern
   (clean white background, no nav). Add: a directional arrow sign (half-page,
   write-in address), a main sale sign (full page, fields she fills in), category
   table signs (CLOTHING / BOOKS / KITCHEN / FURNITURE / ELECTRONICS / TOYS /
   MAKE AN OFFER), price station signs ($1 / $2 / $5 Table, Fill a Bag $3, FREE),
   sale-day price-drop signs ("ALL PRICES HALF OFF", "LAST HOUR — MAKE AN OFFER",
   "BUNDLE DEAL: 3 items for $5"), and a printable full inventory list view.

7. CHECK AND REPORT BACK (no changes needed unless missing):
   - Confirm form labels still use `for=` attributes tied to input ids.
   - Confirm the safety checklist toggles a single item with an animation
     class rather than re-rendering the whole list on every click.
   - Confirm the 5-step guided walkthrough (Start → Sort+Price → Sell+Promote
     → Prep+Safety → Sale Day) is still present and functional.

When done, confirm each item renders correctly and nothing existing broke.
```
