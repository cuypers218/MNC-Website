# Garage Sale Planner — Final Brief Before It Goes Up For Sale

One document, ready to hand to Claude Code. Pulled from a live audit of `widgets/garage-sale-planner/widget.html` on June 20, 2026 — feature-completeness check against what this tool *should* contain, merged with the design and security fixes already diagnosed in `MNC_Interactive_Product_Build_Process.md`.

---

## Part 1 — What a Garage Sale Planner Should Contain (the checklist)

Built for the actual person using it: a solo mom, often doing this alone, often clearing a kid's old room or downsizing — not a generic decluttering app user.

| # | What it needs | Status |
|---|---|---|
| 1 | Set a sale date | ✅ Built |
| 2 | **Backup/rain date plan** | ❌ Missing |
| 3 | **Check city/HOA permit rules before sale day** | ❌ Missing |
| 4 | Set a money goal + reason for the money | ✅ Built (`moneyPurpose` field) |
| 5 | Sort room-by-room | ✅ Built (prep checklist) |
| 6 | Item inventory with category + condition | ✅ Built |
| 7 | Group items into batch boxes | ✅ Built |
| 8 | Emotional/sentimental item sorting (keep vs. let go) | ✅ Built — Memory Box, signature copy already locked |
| 9 | Pricing guide / sticker price grid | ✅ Built |
| 10 | Cash box / change calculator | ✅ Built ($1s, $5s, quarters with suggested counts) |
| 11 | Printable signs + price tags | ✅ Built (Print Center, Ads + Signs) |
| 12 | Cross-list to Facebook Marketplace / Nextdoor | ✅ Built |
| 13 | Sale-day weather check | ✅ Built (live forecast via Open-Meteo, tied to sale date + location) |
| 14 | Solo-specific safety checklist | ✅ Built — and genuinely strong (crossbody bag for cash, text check-ins, keep buyers out of the house) |
| 15 | Live sales log / running tally | ✅ Built |
| 16 | Leftovers plan: donate / sell online / keep / trash | ✅ Built |
| 17 | Lessons-learned notes | ✅ Built |
| 18 | Completion moment / emotional close | ✅ Built — "Sale Complete" screen signed "— Cece," ties back to the money's purpose |
| 19 | Export / email-to-self summary | ✅ Built (PDF export, JSON export, email summary) |

**Bottom line: this is a feature-complete, well-built tool.** 17 of 19 boxes already checked — most planners in this category don't have half of this. The two real gaps are small, specific additions, not a rebuild. Everything else gets locked as-is; do not touch working logic.

The "Sale Complete" screen (signed "— Cece," tied to `moneyPurpose`) is your signature element — the thing the build-process doc said was missing outside the Memory Box copy. It isn't missing. It needs the visual treatment (Part 3 below) to actually read that way instead of getting lost in template-default styling.

---

## Part 2 — The Two Content Additions

**Backup date.** Add a "Backup date (optional)" field next to the existing sale-date field on the Start tab. When the weather card shows rain, snow, or thunderstorms for the sale date, surface a line under the forecast: *"Rain's looking likely. Worth having a backup date in your pocket."* No new API calls needed — same Open-Meteo data already being pulled.

**Permit/HOA check.** Add one line to the existing `prepTasks` checklist array, positioned right after "Choose sale date and time":
`"Check your city or HOA's garage sale rules — some require a permit or limit how many sales per year"`

Both additions match existing voice: practical, peer-to-peer, no lecture tone.

---

## Part 3 — Design Fixes (confirmed against live code)

- **52 `border-radius` instances** — zero allowed. Strip entirely, including the 10px radius on the calendar dropdown menu (line ~886) and the price-tag and card components.
- **Hardcoded `box-shadow` in 5 places**, not just the topbar as previously noted — also the metric cards (2 instances, including a `:hover` shadow), the sign-template card, and the calendar dropdown. All `--shadow` token references must resolve to `none`; no inline shadow values anywhere.
- **Fonts hardcoded to Montserrat + Arial** via `--font-display` / `--font-body` CSS variables. Swap to Lora (display) + DM Sans (body) — the locked pairing for interactive HTML tools.
- **15 emoji characters found** (weather icons, a star, a checkmark, a snowflake) — brand rule is zero emojis anywhere. Replace weather icons with text labels or simple SVG/CSS shapes; replace the star/checkmark with the existing non-emoji check-box pattern already used elsewhere in the tool.

Colors are already correct — confirmed zero retired colors in the file. Do not touch the color values, only radius/shadow/font/emoji.

---

## Part 4 — Security Fix (new finding, unrelated to design)

✅ COMPLETED June 21, 2026 — `widgets/garage-sale-planner/index.html` deleted from repo and server.

`index.php` always serves `widget.html` directly via `readfile()`. Nothing depends on `index.html`.

---

## Part 5 — Fix Stale Catalog Reference

✅ COMPLETED — `CLAUDE.md` already shows "Garage Sale Planner — live, $27".

---

## One Prompt — Paste This Into Claude Code

```
Act as Senior Frontend Engineer for My Nest Chapter. Read CLAUDE.md, DESIGN.md,
and YNC_Brand_SKILL_v4_June2026.md in the repo before touching anything.

Work on widgets/garage-sale-planner/widget.html only. The feature set and JS logic
are approved and complete — do not rebuild, restructure, or remove any existing
feature. This is a styling, content-addition, and cleanup pass, not a redesign.

1. CONTENT ADDITIONS:
   - Add a "Backup date (optional)" field next to the existing sale-date field on
     the Start tab.
   - When the weather card shows rain, snow, or thunderstorms for the sale date,
     add this line under the forecast: "Rain's looking likely. Worth having a
     backup date in your pocket."
   - Add this item to the prepTasks array, right after "Choose sale date and time":
     "Check your city or HOA's garage sale rules — some require a permit or limit
     how many sales per year"

2. DESIGN FIXES — hard rules, no exceptions:
   - Remove every border-radius declaration. Zero anywhere in the CSS.
   - Remove every box-shadow declaration, including the metric card hover shadow,
     the sign-template card shadow, and the calendar dropdown shadow. All --shadow
     tokens resolve to none.
   - Replace --font-display and --font-body so the tool uses ONLY Lora (display)
     and DM Sans (body). No Montserrat, no Arial anywhere in this file.
   - Remove all emoji characters (weather icons, star, checkmark, snowflake symbols).
     Replace weather icons with text labels or simple SVG shapes. Replace the star
     and checkmark with the existing non-emoji check-box pattern already used
     elsewhere in this file.
   - Do not change any color values — the locked May 2026 palette is already
     correctly applied throughout this file.

When done, list every CSS variable used for color, radius, shadow, and font so I
can verify compliance at a glance, and confirm the two content additions render
correctly on both the Start tab and the weather card.
```

---

## After This Round-Trips Clean

Once Claude Code confirms the pass above, the tool is fully caught up — design, content gaps, and the catalog record all matching reality. Same audit-first process (feature checklist → design fixes → security check) applies to What's This Worth next.
