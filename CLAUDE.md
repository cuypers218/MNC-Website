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

---

## ACTION ITEMS — FIX NOW

- [ ] **Build the Exclusive Content section on the dashboard.** It doesn't exist yet — `dashboard.php` only loops through `$allProducts`/`$freeProducts`. Needs a new section above the tools grid, gate-free (member already signed up), direct-download cards. Once built, the first two queue items below are ready to upload immediately.
- [ ] **Remove banned phrase "No judgment."** from the Quiet House Meter short description. Currently lives in `site/seed-products.php` (line ~32) and hardcoded again in `site/index.php` (line ~429). Both must be updated, since the dashboard and shop cards pull from the seeded database value.
  - Current: `"Five questions about where you are with the quiet right now. No judgment. Takes 60 seconds."`
  - Fixed: `"Five questions about where you are with the quiet right now. Takes 60 seconds."`
- [ ] **Fix banned word "Carried"** in `site/workbook.php` (line ~722), week title.
  - Current: `The Weight You Carried`
  - Fixed: `The Weight You Lived`
- [ ] Replace placeholder thumbnail images on dashboard product cards with real images.
- [ ] Add a dedicated downloads section to the dashboard, separate from interactive tools.

---

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

None of these are live yet — the dashboard has no exclusive content section built. Drop order once it exists:

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
- Garage Sale Planner — built, not yet listed for sale
- What's This Worth — built, not yet listed for sale

---

## DESIGN SYSTEM QUICK REFERENCE

Full palette and typography rules live in the brand skill file — below is just enough to catch an obviously wrong color or font in code review.

**Core colors:** Velvety Charcoal `#252535`, Vanilla Cream `#FFF8EE`, Vibrant Pink `#E87AAA` (primary signature), Lavender `#C4B0E8`, Powder Blue `#A8C5DA`, Periwinkle `#8BA7D4`, Peach `#F2A57A`, Soft Peach `#F5C4A8`, Lemon `#EDD96A`, Lime `#B5CC6A`, Light blush `#facfd4`.

**Retired — should never appear in new code:** Deep Berry `#811453`, Dark Berry `#5E1337`, any Berry shade, Muted Mauve `#A3918A`, Warm Blush `#D6C2B7`, Sage Gold, Peach Tan, Sage Gray, Blush Pink `#F8D4D4`, Linen White, Soft Rose, Warm Cream `#F4E8C1`, Warm Tan, Coral Orange, Teal, Gold, Navy.

⚠️ Note: as of this entry, `site/about.php`, `site/blog-post.php`, and `site/setup-database.php` still reference retired colors like `#811453`. Worth a cleanup pass.

**Fonts:** Montserrat ExtraBold (headlines, display), Arial Regular (body/print). HTML tools only: Lora (display) + DM Sans (body).

---

## CHANGE LOG

**2026-06-19** — Created this file. Logged the two banned-language fixes found in `seed-products.php`, `index.php`, and `workbook.php`. Documented full dashboard gating logic and per-product placement table from the June 13 planning session, which had been locked in chat but never made it into code.

**2026-06-19 (correction)** — The 6pm Survival Plan and Who Am I Now are NOT live. Confirmed against `dashboard.php`: no exclusive content section exists in the code at all. Past session notes marking these "Built ✅" meant content was finished, not that they shipped. Added "build the exclusive content section" as the first action item — both PDFs are ready to upload the moment it exists. Full 7-item drop queue documented above.
