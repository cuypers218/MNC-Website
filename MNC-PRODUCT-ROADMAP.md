# MNC Product Roadmap
**My Nest Chapter — mynestchapter.com**
Last updated: June 2026

---

## HOW TO USE THIS FILE
- Review this at the start of every work session
- Update STATUS and PENDING whenever something changes
- "What to work on next" at the bottom tells you where to focus

---

## LIVE PRODUCTS

### Garage Sale Planner — $27
**Status:** Live and purchasable
**Where:** mynestchapter.com/shop/garage-sale-planner
**Widget:** /widgets/garage-sale-planner/index.html
**Payments:** Stripe live ✅ | Post-purchase email ✅ | Day-before reminder email ✅

**What's built:**
- 5 tabs: Start, Sort + Price, Sell + Promote, Prep + Safety, Sale Day + Wrap Up
- Inventory with decisions (Keep/Sell/Donate/Toss), batch boxes, memory box
- Live sale calculator, transaction log, goal tracker with confetti
- Weather on sale day, sale countdown, Add to Calendar
- Print Center: price tags, price point tags, sale signs, box signs
- Sticky earned bar, save button (top-right + Start tab)

**Corrected against actual code 2026-07-12** — this list was stale; several items marked missing were already built. See `GarageSalePlanner_SortPriceInteractive_Brief.md` for the full screen-by-screen reference.

**Confirmed built (previously mislabeled missing):** Pricing guide table, online platform cards (Poshmark/Facebook/Craigslist/etc. with best-for guidance), change calculator (Sale Day calculator), PDF sale summary export (Wrap Up → "Download sale summary (PDF)"), AI photo-ID via Anthropic API (`garage-identify-item.php`, not Google Vision as originally planned).

**Still actually missing (priority order):**
1. [ ] Rotating tips strip (10–15 tips, Cece's voice, swap every 8 seconds)
2. [ ] eBay price lookup — type item name, see sold prices
3. [ ] Dedicated "What's Next" section on Wrap Up (MNC links, Cece voice close)
4. [ ] Instructions PDF to deliver with the file
5. [ ] Cross-device sync (separate sprint — needs full account system)

**Blocked on Cece (see brief for detail):**
- [ ] Screenshot-compare guided-flow screens 2–7 against mockup
- [ ] Live-test the AI photo-ID backend with a real Anthropic key and a real photo

**For making sales (more urgent than features):**
- [ ] Are you emailing your list about it?
- [ ] Are you posting about it on social?
- [ ] Is the shop product page converting? (cover image, demo link, clear CTA)

---

### Now What? Workbook (Book 1) — $14.99 PDF / $24.99 paperback
**Status:** Live
**Where:** mynestchapter.com/workbook + Amazon KDP
**Pending:**
- [ ] Fix Life Coach certification reference in intro (pages 4–7)
- [ ] Fix brand name error in intro
- [ ] Fix "As solo moms, we…" language throughout
- [ ] Remove outcome promises and assumptive statements
- [ ] Revise all "What You Gained" sections
- [ ] Fix typos: "your ready," "INVISIBBLE," punctuation error, duplicate activity list entry
- [ ] Update amazon link in workbook.php when Amazon listing is confirmed

---

### The 6pm Cheat Sheet — Free (email capture)
**Status:** Live
**Where:** Homepage hero + /6pm-experience/
**Pending:** Nothing blocking — good as-is

---

### Pick Your Mood Coloring Widget — Free (email gate)
**Status:** Live (dashboard) | Missing email capture on public freebies page
**Pending:**
- [ ] Add email capture to public version at /widgets/coloring-widget/

---

### Empty Nester Quiz — Free
**Status:** Live at /widgets/empty-nester-quiz/
**Pending:** Nothing blocking

---

### Someday List Companion — $7.99 (placeholder price — confirm)
**Status:** Product page exists, needs price confirmed and product page reviewed
**Pending:**
- [ ] Confirm final price
- [ ] Review product page conversion (CTA, cover image, demo)

---

### Cooking for One Planner — $27
**Status:** Live and purchasable
**Where:** mynestchapter.com/shop/cooking-for-one
**Widget:** /widgets/cooking-for-one/widget.html
**Payments:** Stripe live ✅ | Reach segment wired ✅

**Pending:**
- [ ] Visual rebuild to match Garage Sale Planner style (back burner — no brief yet)

---

## PLANNED PRODUCTS (not built yet)

### New Grandma Planner — HIGH PRIORITY
**What it is:** Interactive HTML tool — same format as Garage Sale Planner
**Why first:** Empty nester whose kids are starting families — next natural chapter
**Price target:** $27–$37
**What's needed:** Blueprint doc → Build → Launch (follow Build Playbook)

### Goal + Habit Tracker — needs full visual rebuild
**Status:** Logic works, visual layout is wrong (narrow popup, needs dashboard rebuild)
**What's needed:** CSS/layout full redo to match Cooking for One card style

### Pinterest Strategy + Templates
**Status:** Not started — next marketing priority after social posting

---

## WHAT TO WORK ON THIS WEEK

**Short session (under 1 hour):**
Pick ONE item from the Garage Sale Planner missing list above. Build it. Deploy. Done.

**Medium session (1–2 hours):**
Rotating tips + pricing guide table on Garage Sale Planner — two things that make the tool feel complete and premium without requiring APIs.

**Marketing (no code needed):**
Write one post about the Garage Sale Planner. Email your list. That is the fastest path to a sale.

---

*Updated by Claude / Cece — keep this file current*
