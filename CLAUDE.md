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

- [ ] Replace placeholder thumbnail images on dashboard product cards with real images.
- [ ] Register the exclusive unlock cron in Hostinger hPanel → Hosting → Cron Jobs: `php /home/u540670132/domains/mynestchapter.com/public_html/cron/send-exclusive-unlocks.php` — daily at 9 AM (`0 9 * * *`). This must be done manually in hPanel.

## BACK BURNER (not urgent — do not touch without a new brief)

- **Quiet House Meter** — widget was never built (no folder in /widgets/). Removed from homepage and resources page 2026-06-21. DB record set to `draft` 2026-06-21. Do not rebuild without Cece's go-ahead.
- **30-Day Goal & Habit Tracker** — live widget, $27, but needs full visual rebuild to match Cooking for One style. Current code is narrow/popup layout. No brief written yet. Widget folder currently has no index.html (deleted as security fix). Back burner until Cece is ready with a brief.
- **Weekly Reset Planner** — local file only, pre-rebrand colors/fonts, not live. Needs brand audit before going up.
- **New Grandma Planner** — high priority when ready to build, but not started.

## COMPLETED — 2026-06-21 (session 3)

- ✅ Exclusive Content section built on dashboard (`site/dashboard.php`) — unlocked items with lavender EXCLUSIVE badge + Download button, live countdown timer to next unlock, all-caught-up fallback
- ✅ `exclusive-download.php` — auth + unlock check, serves PDF via readfile(), graceful redirect if file missing
- ✅ `cron/send-exclusive-unlocks.php` — daily 9 AM cron, two-pass (preview 24hr before + unlock day-of), logs per member+item+type to prevent duplicates
- ✅ `exclusive_content_queue` + `member_freebie_notifications` tables created, queue seeded (6pm Survival Plan + Who Am I Now)
- ✅ `exclusive-6pm-survival-plan.pdf` + `exclusive-who-am-i-now.pdf` uploaded to `downloads/` on server
- ✅ Garage Sale Planner Round 2: sticky total bar (fixed bottom, charcoal, pink earned amount, Lime "Goal reached!"), goal confetti via canvas-confetti, weather already live
- ✅ **One manual step remaining:** Register cron in Hostinger hPanel → see ACTION ITEMS above

## COMPLETED — 2026-06-21 (session 2)

- ✅ Quiet House Meter removed from homepage (`site/index.php`) and resources page (`site/resources.php`)
- ✅ Quiet House Meter DB status set to `draft` via one-time PHP script (no longer appears in queries)
- ✅ `seed-products.php` deleted from repo and server (was stale; DB was hand-updated via `add-widgets.php`)
- ✅ `widgets/goal-habit-tracker/index.html` deleted from server (unprotected duplicate)
- ✅ `widgets/cooking-for-one/index.html` was already gone from server
- ✅ Garage Sale Planner: fonts → Lora/DM Sans, all border-radius removed, all box-shadows removed, emoji icons replaced with text labels, backup date field + HOA permit task + rain warning added
- ✅ `widgets/garage-sale-planner/index.html` deleted from repo (unprotected duplicate)
- ✅ `site/index.php`, `site/resources.php`, `site/dashboard.php` deployed to live server
- ✅ Retired color `#811453` replaced with `#E87AAA` on Someday List Builder + 6pm Cheat Sheet links in `resources.php`

## COMPLETED — 2026-06-20

- ✅ Dashboard rebuilt: Your Products + Freebies + For Members (tiered discount) sections
- ✅ Door-reveal animation on tier unlock (tracks via `highest_tier_seen` on users table)
- ✅ Stripe coupons created: MNCTIER10 (10%), MNCTIER15 (15%), MNCTIER20 (20%)
- ✅ Stripe secret key rotated and updated in config.php
- ✅ Banned phrase "No judgment." removed from seed-products.php + index.php
- ✅ Banned word "Carried" fixed → "The Weight You Lived" in workbook.php
- ✅ Retired color #811453 replaced with #E87AAA in blog-post.php + setup-database.php
- ✅ Dashboard placeholder gradients updated to Soft Peach → Lavender (brand-compliant)

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
- Cooking for One Planner — live, $27
- 30-Day Goal & Habit Tracker — live, $27 (visual rebuild pending — back burner)
- Garage Sale Planner — live, $27
- What's This Worth — built, not yet listed for sale
- The Quiet House Meter — back-burner; widget never built; removed from homepage + resources page; DB record needs → draft via phpMyAdmin

---

## DESIGN SYSTEM QUICK REFERENCE

Full palette and typography rules live in the brand skill file — below is just enough to catch an obviously wrong color or font in code review.

**Core colors:** Velvety Charcoal `#252535`, Vanilla Cream `#FFF8EE`, Vibrant Pink `#E87AAA` (primary signature), Lavender `#C4B0E8`, Powder Blue `#A8C5DA`, Periwinkle `#8BA7D4`, Peach `#F2A57A`, Soft Peach `#F5C4A8`, Lemon `#EDD96A`, Lime `#B5CC6A`, Light blush `#facfd4`.

**Retired — should never appear in new code:** Deep Berry `#811453`, Dark Berry `#5E1337`, any Berry shade, Muted Mauve `#A3918A`, Warm Blush `#D6C2B7`, Sage Gold, Peach Tan, Sage Gray, Blush Pink `#F8D4D4`, Linen White, Soft Rose, Warm Cream `#F4E8C1`, Warm Tan, Coral Orange, Teal, Gold, Navy.

⚠️ Note: `site/about.php` may still reference retired colors — worth a check.

**Fonts:** Montserrat ExtraBold (headlines, display), Arial Regular (body/print). HTML tools only: Lora (display) + DM Sans (body).

---

## CHANGE LOG

**2026-06-19** — Created this file. Logged the two banned-language fixes found in `seed-products.php`, `index.php`, and `workbook.php`. Documented full dashboard gating logic and per-product placement table from the June 13 planning session, which had been locked in chat but never made it into code.

**2026-06-19 (correction)** — The 6pm Survival Plan and Who Am I Now are NOT live. Confirmed against `dashboard.php`: no exclusive content section exists in the code at all. Past session notes marking these "Built ✅" meant content was finished, not that they shipped. Added "build the exclusive content section" as the first action item — both PDFs are ready to upload the moment it exists. Full 7-item drop queue documented above.

**2026-06-21** — Garage Sale Planner design pass complete. Fonts → Lora + DM Sans, all border-radius removed, all box-shadows removed, emoji weather icons replaced with text labels. Backup date field + HOA permit checklist item + rain warning added. Security: deleted unprotected `index.html` duplicate. Product Catalog corrected: Garage Sale Planner is live at $27 (was "built, not yet listed for sale" — stale).

**2026-06-21 (session 2)** — Quiet House Meter removed from site: card deleted from `site/index.php`, link deleted from `site/resources.php`. Widget was never built — nothing in /widgets/ to remove. DB record still active; needs phpMyAdmin → `draft`. `seed-products.php` deleted from repo (was stale after DB was hand-updated via `add-widgets.php`; `INSERT IGNORE` made it useless). Security: deleted unprotected `index.html` files from cooking-for-one and goal-habit-tracker widget folders. Product Catalog updated: added Cooking for One ($27) and Goal & Habit Tracker ($27, visual rebuild pending). Goal & Habit Tracker moved to back burner — needs a brief before any visual work.
