# My Nest Chapter — Design System
**Version 5 — August 1, 2026 — Full rewrite** *(§12.2/§12.4 refreshed 2026-08-30 against live `style.css` — no structural changes, no new colors; see those sections for what was verified. §2 COLOR SYSTEM and Appendix A replaced 2026-08-30 — the entire July 27/August 1 palette retired in favor of a new Cece-authored system; role mapping and WCAG contrast confirmed in that pass, but the lock is documentation-only — `style.css` has not been updated yet. See §2's own header note for what's settled versus still open.)*
*Consolidated from the three prior DESIGN.md versions (June 2026 v4, the July 27 correction pass, and the July 26 "Design Basics" draft) plus the live color/type state as of 2026-08-01. The July 26 "Design Basics" draft is not used as a source here — it referenced Deep Rose/Periwinkle/Lavender/Soft Peach, all retired July 27, and its own footer claim that Lavender/Soft Peach were "reinstated" contradicts the July 27 lock. Treat that version as an abandoned branch, not a prior state of truth. Voice, tone, and copy rules are intentionally NOT duplicated here — see `Skill_File_07-05-2026_v4.md` (the Brand & Voice Bible). This file is visual/structural only, per the split already defined in `CLAUDE.md`.*

---

## 1. BRAND FOUNDATION

| Field | Value |
|---|---|
| Brand Name | **My Nest Chapter** — always three words, each capitalized. Never MNC or any abbreviation. |
| Author / Voice | Cecilia Ann (Cece) |
| Website | mynestchapter.com |
| Official Tagline | **Solo mom. Empty nest. Now what?** |
| Audience | Single and solo moms navigating the empty nest transition. NOT empty nesters generally. |
| Platform | Custom PHP/HTML on Hostinger · Stripe Live · Amazon KDP for Workbook 1 paperback |
| Design Tools | Canva (Brand Kit ID: `kAHE-_Dmcm0`) · custom PHP/HTML for web |
| Canva Design IDs | Workbook Main: `DAHG2S8lipI` · Someday List Companion: `DAHG147VgF8` · Mandalas: `DAHLjfIqQVA` · Facebook cover: `DAHLdr6XKhE` |

---

## 2. COLOR SYSTEM

> **Locked 2026-08-30.** Supersedes the entire July 27/August 1 system (Wine, Copper, Charcoal, Page background, and everything added on top of it through August 27) entirely — all retired, not amended. This palette was authored by Cece as a complete, named set (5 Core System colors + 9 Card & Box colors) and handed over ready-made, not built live in this doc the way prior versions were; role assignment and WCAG contrast verification happened in this pass. **Print/workbook colors (§2.7–2.8) are untouched by this revision** — that exception continues exactly as before.
>
> **Scope: `index.php` fully done, everywhere else still retired.** As of 2026-08-30 the entire homepage (`site/index.php`) runs this palette — hero, Meet Cece, Start Here/Pillars, Stay Close/Newsletter, and the product cards, all done the same day across two passes (a scoped restyle, then a second pass finishing the sections deliberately deferred from the first). All overrides live under `.home-*`/`.cece-*`/`.an-*`/`.pillar`/`.start-here` selectors — the pattern already established for this page — plus new `:root` tokens (see the CSS comments at the top of `:root` in `style.css`). Every other page still renders the retired Wine/Copper/Charcoal system. Treat this the way the July 27 palette was treated before its full rollout (CLAUDE.md Thread 2): one page shipped complete, the rest tracked follow-up work.
>
> **What changed in the second pass:** the Meet Cece section's background moved from Forest (`#2D3B32`, homepage-only, §2.homepage-legacy) to Deep Current — both "dark moment" sections on the page (Meet Cece and the product showcase) now share one dark color instead of two different ones. The hero's fluid divider was recolored to match. `--forest` itself is untouched (still used by `connect.php`, a different page). A new small-text finding: **Burnished Copper fails contrast as small text on light backgrounds** (3.64:1 and similar — a real fail, not borderline, and too small to qualify for the AA-large exception). The already-proposed hover shade `#7F4928` (`--burnished-copper-hover`) is reused as a small-text color where this comes up (eyebrows, the Support pillar's accent) — passes comfortably. Worth folding this shade into §2.3 proper next time that section gets revisited, since it's now doing two jobs (hover fill and small-text color), not one.
>
> **Correction, same day:** the second pass initially used Soft Sand (a Card & Box color) as this page's actual background and as light-on-dark text in the Meet Cece/newsletter sections. Cece corrected this — **Vanilla Cream is the background**, exactly as §2.2 above already specified; Soft Sand was the wrong token for that job from the start (a Card & Box color standing in for the Core System's actual background role). Every background and light-on-dark text use on the homepage now uses Vanilla Cream; `--soft-sand` is still defined in `style.css` but nothing on this page currently calls it.
>
> **Two things resolved during that homepage pass, worth folding back into this record:**
> - **Role conflict, resolved in favor of the homepage's visible use:** Burnished Copper is used as the visible/primary-looking CTA color on the homepage (steer explicitly called it out that way), even though §2.3 above still lists it as *secondary* with Deep Current as primary. Deep Current is used for headings on the homepage instead of buttons. This is a live discrepancy between this table and the shipped page, not yet reconciled — whoever continues the rollout should either update §2.3's role table to match what shipped, or restyle the homepage buttons to match the table. Not resolved here.
> - **Hover-contrast pattern, now established:** Golden Drift as a button hover fill fails badly with white text (2.47:1). The homepage CTA buttons swap text to Deep Coffee on hover instead of keeping it white. Reuse this pattern anywhere else Golden Drift becomes a hover state.
>
> **"Soft Beige" `#EBDCC3`, used for card backgrounds on the homepage, is not in the Card & Box list above** — the closest documented color is Warm Beige `#E6D6C2` (§2.new-cards). Contrast-verified independently (11.86:1 with Deep Coffee text) and used as given, but this is either a slightly different color than Warm Beige or a re-typo of it — worth confirming with Cece which one is canonical before it spreads further.

### 2.1 Text / Dark Neutral

| Name | Hex | Role |
|---|---|---|
| Deep Coffee | `#2B1F18` | All body text, headings, nav, footer — replaces Charcoal. 14.21:1 against Vanilla Cream — AAA everywhere. |

### 2.2 Background

| Name | Hex | Role |
|---|---|---|
| Vanilla Cream | `#F6F1E6` | Main page background — replaces Page background. 70–80% of every page, same convention as before. |

**Open gap, not yet decided:** the new palette gives one flat background, not the old four-shade ramp (Page bg / Clean card / Cozy card / Soft White). Until Cece confirms a replacement, treat plain/neutral card surfaces as an open question — **do not** silently reuse Soft Sand or Warm Beige from §2.new-cards for this without asking; they're confirmed as Card & Box colors, not as a Clean-card substitute.

### 2.3 Buttons — Two Signature Action Colors

| Name | Hex | Role |
|---|---|---|
| Deep Current | `#0A2F3A` | **Primary** — replaces Wine. White text: 14.18:1 — AAA. |
| Burnished Copper | `#A35E33` | **Secondary** — replaces Copper. **White text required, not cream** — see note below. |

Role mapping confirmed 2026-08-30: Deep Current (the palette's "Anchor") → primary button; Burnished Copper (the palette's "Warm") → secondary button — same two-button structure as the retired system, no other color is a button fill.

**Contrast finding — secondary button text color must change.** The retired system's secondary button used cream text (`#F6F3EC` on Copper, 4.60:1 AA). The direct equivalent here — Vanilla Cream on Burnished Copper — measures **4.43:1, just under the 4.5 AA line** for the button's 0.85rem/700 label size. **Use white `#FFFFFF` instead (4.99:1, passes AA)** — a deliberate, measured deviation from the old cream-on-secondary convention, not an oversight.

**Hover states — computed, not yet eyeballed.** Derived at the same ~78% darkening ratio the retired Wine-hover/Copper-hover pair used; these have not been checked against a live mockup the way every prior hover value in this doc was:
- Deep Current hover: `#08252D` (proposed)
- Burnished Copper hover: `#7F4928` (proposed)

### 2.new-accent Accent — Golden Honey

| Name | Hex | Role |
|---|---|---|
| Golden Honey | `#C8A878` | Decorative accent fill — badges, highlight blocks, small accent details. **Fill only, with Deep Coffee text on top (7.11:1, AAA) — never as small text or a link color on Vanilla Cream** (2.00:1, a hard fail, not a borderline one). This is the opposite job of the retired Golden Earth, which *was* a text/link color — don't carry that usage forward onto this color. |

### 2.4 Labels, Icons, and Structure — carried over, unresolved

The new palette does not include replacements for Taupe, Warm gray, Warm Sand, or Bark (decorative labels, icon color, dividers, button-hover neutral). These four **stay on their retired-system values for now** — they are not part of the 2026-08-30 lock and not yet decided:

| Name | Hex | Role (unchanged from retired system) |
|---|---|---|
| Taupe | `#8C8272` | Decorative labels, eyebrow text, category labels only. Never on buttons, never as a background. |
| Warm gray | `#6B655C` | Icons, small UI elements. |
| Warm Sand | `#D9C7AC` | Dividers, borders, muted/disabled UI. |
| Bark | `#5B3A28` | Secondary text darker than Warm gray. |

### 2.5 Error and Success — carried over, unresolved

The new palette does not include error or success colors. Dark orange and Moss **stay on their retired-system values for now**, pending a decision:

| Name | Hex | Role (unchanged from retired system) |
|---|---|---|
| Dark orange | `#9E3D0F` | Error states, form validation failures. Never rely on color alone — pair with an icon or the word "Error." |
| Moss | `#46703F` | Success states, confirmations. |

### 2.6 Tags

Colored text only — no fill, no background tint, no border, per the retired system's own tested-and-confirmed rule (§2.6 history: filled tint and outlined-border were tried and rejected before landing here). That rule carries forward unchanged; only the color options change:

| Name | Hex | Use |
|---|---|---|
| Deep Current | `#0A2F3A` | Primary tag color, e.g. "solo mom favorite." 12.59:1 against Vanilla Cream. |
| Burnished Copper | `#A35E33` | e.g. "most popular" — **AA-large only, not full AA** (4.43:1 against Vanilla Cream) — same caveat the retired Copper tag carried, keep to large/bold text. |
| Moss | `#46703F` | e.g. "new this week" — carried over from §2.5, unresolved along with the rest of that section. |

Golden Honey is **not** a tag-text option (see §2.new-accent) — it fails contrast as text. The retired system's fourth tag color, Rosewood, has no confirmed replacement.

### 2.new-cards Card & Box Colors (added 2026-08-30)

Nine colors for product/content card backgrounds, per Cece. Each row shows the text color that actually passes contrast on it — computed 2026-08-30, not yet checked against a live mockup:

| Name | Hex | Text pairing | Contrast | Note |
|---|---|---|---|---|
| Soft Sand | `#F1D9B3` | Deep Coffee text | 11.67:1 — AAA | Light, reads closest to the retired system's Clean/Cozy card role |
| Warm Beige | `#E6D6C2` | Deep Coffee text | 11.25:1 — AAA | Light, same near-neutral role as Soft Sand |
| Golden Drift | `#D8975A` | Deep Coffee text | 6.47:1 — AAA | |
| Caramel | `#B88A5A` | Deep Coffee text | 5.20:1 — AA | |
| Caramel Brown | `#8B5E3C` | Vanilla Cream text | 4.95:1 — AA | |
| Spiced Caramel | `#A67C52` | Deep Coffee text | 4.29:1 — **AA-large only** | Below 4.5, do not use for small body-size card copy — headings/large text only, same caveat class as Taupe and the Copper tag |
| Oceanic Teal | `#1D6B78` | Vanilla Cream text | 5.44:1 — AA | |
| Smoky Sienna | `#5A4839` | Vanilla Cream text | 7.70:1 — AAA | |
| Mocha Brown | `#5E3E2B` | Vanilla Cream text | 8.47:1 — AAA | |

### 2.homepage-legacy Homepage Section Colors — Golden Earth and Forest

Not addressed by the 2026-08-30 palette. Both are still live in `style.css` (Golden Earth on the Start Here/Three Pillars "Thrive" eyebrow, Forest as the Meet Cece section background) and neither is retired by this revision — but neither is confirmed to survive it either. Open decision for Cece: keep these two as scoped exceptions alongside the new system, or fold their roles into it (Forest's "one dark section" job is a natural candidate for Deep Current, for instance, but that's a suggestion, not a decision made here).

### 2.7 Workbook / Document Element Colors

**Unchanged by any web color revision.** Workbook *content pages* (non-cover) are deliberately brand-color-free — neutral grays, off-whites, black text only, for print legibility. These technical grays are a separate, intentional exception, not a "cool gray" violation.

| Name | Hex | Role |
|---|---|---|
| Icon Gray | `#4B4B4B` | Icons in workbook/PDF context |
| Text Lines | `#D3D3D3` | Ruled lines in workbook pages |
| Text Box Outline | `#ABABAB` | Box borders in workbooks and web |
| Alt Text Lines | `#E0E0E0` | Alternate ruled lines |

### 2.8 Print/PDF Title Text Colors

| Name | Hex | Role |
|---|---|---|
| Near-Black | `#0D0D0D` | Main titles in print/PDF |
| Dark Gray | `#333333` | Headings, print/PDF only |
| Body Near-Black | `#101010` | Body/paragraph text, print/PDF only |
| Disabled | `#ABABAB` | Borders, disabled button/input affordance — a UI-state convention, not a brand text color |

**Rule: no cool gray anywhere on the web.** `#666666`, `#999999`, `#6e6e6e`, `#333333`, `#444444` and similar as web text/border/fill are all violations — use Charcoal for primary text, Warm gray for muted/utility text, Taupe for decorative labels only.

### 2.9 Tertiary Accent — Rosewood — carried over, unresolved

Like §2.4/§2.5, the new palette gives no replacement for this role. Rosewood stays usable on its retired-system value until Cece decides whether it survives:

| Name | Hex | Role |
|---|---|---|
| Rosewood | `#80475E` | Flexible sitewide accent — decorative highlights, a fourth tag-text option, small accent details. |

### 2.10 Pop Accent — Retired (was Deep Teal, added 2026-08-01, retired 2026-08-11)

Deep Teal `#114B5F` was the single "pop of color" against the earthy palette for about a week and a half — Cece retired it 2026-08-11. No replacement pop-accent has been chosen from the retired system; Golden Honey (§2.new-accent) is a candidate for this job going forward, as a fill, but that's not a decision made here.

### 2.11 Retired Colors — Never Use

**Retired 2026-08-30 (the entire July 27/August 1 system, in full):** Wine `#7A2E42`, Wine-hover `#5E2233`, Copper `#A15C3E`, Copper-hover `#83492F`, Charcoal `#262624`, Page background `#F6F3EC`, Clean card `#FEFCF8`, Cozy card `#EFE8DC`, Soft White `#FFFEFB`. The July 27/August 1 lock's stale, never-role-assigned candidate list (Almond Cream `#EAE0D5`, Khaki Beige `#C6AC8F`, Warm Amber `#CE8147`, Deep Umber `#504136`, Warm Ivory `#F7F4EA`, Marigold `#FFA500`, plus the two unnamed browns `#685044`/`#582419` that were never confirmed) retires with it — the new Card & Box set (§2.new-cards) is the fresh candidate pool now, not an addition to the old one. Golden Earth `#99621E` is not retired — see §2.homepage-legacy, still open. **Name collision to note:** this retired list already used the name "Vanilla Cream" for a *different* color (`#FFF8EE`, retired July 5, below) — the 2026-08-30 palette's Vanilla Cream (`#F6F1E6`, §2.2) is unrelated to that retired one; don't confuse them by name alone.

**Retired July 27, 2026 (the entire July 5–16 system):** Velvety Charcoal `#252535`, Warm Antique White `#FAF7ED`, Deep Rose `#C44570`, Periwinkle `#8BA7D4`, Lavender `#C4B0E8`, Soft Peach `#F5C4A8`, Rose Tint `#F9ECF0`, Peach Tint `#FCF0E8`, Peach Mid `#EFA276`, Warm Brown `#6D4C3E`, Tool Background `#FDFBF7`, the entire Wine/Deep Rose Ramp (stops 50–950, including `#F3D8E1`, `#E7B1C3`, `#DA8BA5`, `#CE6487`, `#74253F`, `#4E182A`, `#270C15`, `#1B090F`), Error Red `#C0392B`, Error BG `#FDEDEC`, Success Green `#1E7E34`, Success BG `#E8F5E9`, Page Gray `#FAFAFA`, Input BG `#FCFCFC`.

**Retired July 5, 2026 (still retired):** Vibrant Pink `#E87AAA`, Vanilla Cream `#FFF8EE` *(different color than the 2026-08-30 Vanilla Cream — see note above)*, Powder Blue `#A8C5DA`, Peach `#F2A57A`, Lemon `#EDD96A`, Lime `#B5CC6A`.

**Retired August 11, 2026:** Deep Teal `#114B5F` — the pop-accent color added 2026-08-01 (former §2.10). Not a fill, badge, or accent anywhere anymore.

**Retired earlier still:** Deep Berry `#811453`, all Berry shades, Soft Pink `#F8BBD0`, Warm Cream `#F4E8C1`, Warm Tan `#C8A982`, Warm Mauve `#BCAAA4`, Coral Orange `#FF6F61`, Teal `#00CACA` *(unrelated to the also-now-retired Deep Teal `#114B5F` — a much brighter cyan)*, Bright Yellow `#FFDD00`, Deep Plum `#6B3B50`, Light Peach `#F5D4B1`, Warm Gray `#B19D8D` *(unrelated to the current Warm gray `#6B655C`, §2.4)*, Soft Linen `#EAD3B7`, Dusty Rose `#D7A8A4`, old widget palette (Sage Gold, Peach Tan, Sage Gray, Blush Pink, Linen White, Muted Mauve), Gold `#FFD700`, Navy `#000080`, and all prior pink/blue/lavender/peach shades.

**Never revisit:** the July 26, 2026 "Design Basics" draft's attempted reinstatement of Lavender/Soft Peach. That draft was superseded before it was ever adopted.

---

## 3. TYPOGRAPHY

### 3.1 Print / PDF / Workbook Context

| Element | Font | Weight | Size | Color |
|---|---|---|---|---|
| Main Title | Montserrat | Extra Bold (800) | 16pt | `#0D0D0D` |
| Heading | Montserrat | Extra Bold (800) | 14pt | `#333333` |
| Subheading | Montserrat | Extra Bold (800) | 13pt | `#333333` |
| Body / Paragraph | Arial | Regular (400) | 12pt | `#101010` |

**Font rule:** Montserrat Extra Bold handles ALL print/PDF display text. Arial Regular handles all print/PDF body text. This pairing is print/PDF/workbook only — it is never loaded as a web font.

### 3.2 Web Context (site CSS)

| Element | Font | Weight | Size | Notes |
|---|---|---|---|---|
| h1, h2, h3, h4 | Lora | 700 (Lora has no 800) | 1.75 / 1.25 / 1rem / — | Uppercase, letter-spacing 0.02em on h1 |
| Body | DM Sans | 400 | 16px | line-height 1.6 |
| Nav links | DM Sans | 700 | 0.8rem | Uppercase, letter-spacing 1px |
| Buttons | DM Sans | 700 | 0.85rem | Uppercase, letter-spacing 1px |
| Labels / Categories | DM Sans | 700 | 0.65–0.75rem | Uppercase, letter-spacing 0.05–0.1em |

**Web font stack:** `'Lora', serif` (display) and `'DM Sans', sans-serif` (body/UI). Montserrat and Arial are never loaded as web fonts (see Appendix B).

### 3.3 Interactive HTML Tools Context

| Element | Font | Weight | Notes |
|---|---|---|---|
| Display / Story text | Lora | 400 / 600 / 700 / italic | Serif — emotional, narrative moments, headings |
| Body / UI | DM Sans | 400–800 | Clean, readable for interactive UI |
| Brand tag / labels | DM Sans | 800 | Uppercase, letter-spacing 3px |

**Rule:** Lora + DM Sans is one system across both site pages and interactive HTML tools, not two separate ones. Print/workbook typography (§3.1) is its own, separate system.

### 3.4 Type Treatment Rules

- All headings and nav elements: `text-transform: uppercase`
- Hero tagline: Lora 700, 2.2rem, `#F6F3EC`, uppercase, `letter-spacing: 0.02em`, `line-height: 1.15`
- No italics in print context
- No decorative fonts
- Fragments allowed and encouraged when they "land harder"

---

## 4. LOGO SYSTEM

### 4.1 Wordmark

- **Stacked wordmark:** "MY NEST" in Taupe `#8C8272` | "Chapter" large in Wine `#7A2E42` | Copper `#A15C3E` accent bar
- **Tagline version adds:** "FOR SINGLE & SOLO MOMS." in Taupe `#8C8272`

### 4.2 Favicon / Brand Mark — Option B (Locked)

- **Doorway icon** — slightly ajar door
- **Standalone:** Charcoal `#262624` door frame | Wine `#7A2E42` doorknob | Copper `#A15C3E` light spill
- **Favicon:** Page background `#F6F3EC` icon on Charcoal `#262624` background | Wine doorknob
- Files: `mnc-logo-black.svg`, `MNC_Brand_Mark_Doorway.svg`, `MNC_Logo_Stacked_Wordmark.svg`, `MNC_Logo_Tagline.svg`, `MNC_Favicon.svg`

**Still not done:** these are Canva-exported SVG assets living outside this repo — this doc update is text-only. The asset files still need to be re-exported from Canva with the current colors before the favicon/logo files themselves match this spec.

### 4.3 Usage Rules

- Web brand mark in header: DM Sans 800, `#8C8272`, uppercase, `letter-spacing: 2px`, 1.1rem
- Footer brand: same treatment, 0.9rem
- Logo is NOT a clickable image in header — rendered as styled text in CSS
- Cece's photo: appropriate for About page and blog bio only. Present but not dominant.

---

## 5. GRAPHICAL STYLE & VISUAL DIRECTION

### 5.1 Photography / Imagery Guidelines

- **Do use:** Hands writing in a workbook, quiet interior scenes, soft natural light, doorways and thresholds, lived-in spaces
- **Do not use:** Spa aesthetics, polished stock photography, specific women's faces (objects and spaces only)
- **Styling:** Warm, lived-in visual over clean minimalism
- **Cover concept:** Open doorway — no woman figure

### 5.2 Hero Image Treatment

- Charcoal `#262624` background with photo overlay
- `linear-gradient(to bottom, rgba(37,37,53,0.55) 0%, rgba(37,37,53,0.75) 100%)` overlay on hero images
- Photo opacity ~0.55 where text sits above it

### 5.2b Homepage Hero — Editorial Accent Experiments (2026-08-30, reverted 2026-08-31)

**All of it undone.** On 2026-08-30 the hero went through four rounds of experimentation — a linen texture background, a fluid organic divider into the Meet Cece section, a Playfair Display display-face accent with mixed italic/roman styling, an asymmetrical two-column editorial grid, and a floating Soft Beige card whose bottom edge overlapped into the next section. Cece asked 2026-08-31 to revert the hero to its state from before that first steer. It's back to the original: a plain centered single column, Lora-only heading (no Playfair, no separate `--font-display` font link), no divider, no card, no texture, flat boundary into Meet Cece.

**What was NOT reverted:** the hero's colors. Vanilla Cream background, Deep Current heading, and Burnished Copper button/hover stay — those came from the separate, sitewide 2026-08-30 color-system work (§2), not from the hero-specific steers this revert undoes, and reverting them would have put the hero out of sync with every other section on the page (which still runs the new palette). If Cece wants the hero back on the fully retired system too (old Wine/Charcoal/Cozy card), that's a separate, explicit ask — not assumed here.

The linen texture is gone for a second, independent reason too: Cece said 2026-08-30 she didn't like it, before ever asking for the full revert — so even a literal "restore exactly what was there before" would not have brought it back.

None of the specific techniques tried (organic divider curves, mixed-weight display accents, editorial grids, overlapping cards) are banned — any could resurface in a future request. This entry stays as the record of what was tried on this hero and undone, not as a rule against trying it again.

### 5.3 Widget / Interactive Tool Aesthetic

- Full-screen or large viewport experiences
- Charcoal `#262624` base with Lora serif text in Page background `#F6F3EC`
- Scene backgrounds with 55% opacity overlay
- `linear-gradient(to bottom, rgba(0,0,0,0.25) 0%, rgba(0,0,0,0.55) 100%)` text legibility overlay
- Story text in Lora 22pt; italic intro text at 16pt
- Brand tag: DM Sans 800, 9pt, Wine `#7A2E42`, letter-spacing 3px

### 5.4 Design Rules — Hard Constraints

**Moderate radius, soft elevation — sitewide, no exceptions.** A prior "zero border-radius/zero shadow" rule was tried and dropped in July 2026 for reading cold and stark rather than premium.

- Cards, containers, panels: `border-radius: 8–10px`
- Buttons, inputs: `border-radius: 6px`
- Tags/pills/badges only: `border-radius: 9999px` (fully round — reserved for small label-shaped elements, not general containers)
- Standard card shadow: `box-shadow: 0 10px 40px rgba(37,37,53,0.07)` — one soft, low-opacity shadow for elevation. No heavy/glossy shadows, no multiple stacked shadows.
- Reasoning: zero radius reads harsh/stark; heavy rounding (16px+) reads playful/juvenile. This middle range reads clean and mature — think Stripe, Linear, Notion, not a newspaper page and not a kids' app.
- No emoji in any brand material.
- Applies to every widget, the main site, and all future builds.

### 5.5 Workbook / PDF Page Design

- Cover pages: brand colors, Montserrat titles, doorway motif
- **Content pages (non-cover):** neutral grays, off-whites, and black text ONLY — no brand colors on content pages
- Workbook interior: rule lines `#D3D3D3`, box borders `#ABABAB`, alt lines `#E0E0E0`, icon gray `#4B4B4B`
- Montserrat 800 for all headings; Arial Regular for all body text

### 5.6 Feel & Interaction Standards

**Who this is for — read this before applying anything below.** The buyer is not stressed, not low-tech, not someone who needs to be handled carefully. She's capable, tech-comfortable, and willing to learn. What she has, at this stage of life, is clarity about what her time is worth — she doesn't want to spend it on something clunky, and she doesn't want to feel talked down to. Every rule below exists to make the tool feel sharp and competent, not to compensate for fragility. If a design choice is justified by "she might get confused," that's the wrong justification — reframe around respect and competence instead.

**Interaction order — friction, then clarity, then delight, in that sequence:**
1. Remove friction first (can she do the thing without fighting the interface?)
2. Reduce confusion second (does she know what's happening and why?)
3. Layer delight on top, last (animation/encouragement never substitutes for a flow that doesn't already work)

**Progressive disclosure:** Show only what's needed for the current step. Advanced or secondary features (e.g. the Garage Sale Planner's eBay price lookup) stay tucked away until she's ready for them. Don't front-load every field/option on one screen.

**Momentum framing, not static data:** Progress should read as "3 more items and you're halfway sorted," not just "47 items." Every screen should read like it already understands what she's doing — "Let's set your sale goal," not "Welcome" or "Dashboard" as a blank label.

**Milestone-based encouragement, not constant:** Reserve any personal-voice touch (a short note in Cece's voice, a small celebratory moment) for real milestones — finished sorting, hit the money goal, sale day arrives. Not every tap.

**Mobile-first micro-interactions** (most use happens on a phone):
- Visible tap feedback on every interactive element
- State changes animate (a card moving to "sold" slides or fades, never just snaps)
- Swipe gestures where they fit naturally (e.g. swipe an item left for Donate, right for Sell)
- Numbers that change (totals, counts) animate/count up rather than snapping instantly
- Bottom sheets sliding up from the bottom for mobile actions, instead of small centered popup modals
- Touch targets sized for a thumb (44×44px minimum, per §6.1)

**Respect-her-time patterns (apply to Garage Sale Planner first, then all future tools):**
- **Smart defaults over blank forms** — pre-fill what can reasonably be assumed; let her override
- **Undo instead of confirm, where reversible** — genuinely irreversible/high-stakes actions still confirm; anything reversible prefers undo
- **Quick-add / command-bar pattern** — a single fast-entry field (e.g. "shirts 3 for $5") the tool parses, instead of a multi-field form per item
- **Shortcuts that reward repeat use** — e.g. "duplicate last item, just change the price"
- **Shareable proof of her own work** — a clean summary she could screenshot ("I made $340 today")
- **No talking-at-her tutorial overlay** — one subtle inline hint on her first real action, then never repeat it
- **Cross-tool consistency** — whichever pattern wins here becomes the standard for every future tool, so a second purchase feels immediately familiar

### 5.6b Confident + Warm Blend

Brief: "sexy and confident" blended with "warm, nurturing and encouraging." The two qualities aren't blended evenly across a screen — they're separated by zone:
- **Confidence/boldness** lives in one committed dark moment per screen — a dark section (Deep Current per the 2026-08-30 palette, §2.3) with a single decisive accent, not scattered small accents. Restraint is what makes it read confident rather than loud.
- **Warmth/nurturing** lives in everything surrounding that moment — background space, soft-shadow cards (§5.4), rounded icon circles, encouraging first-person-adjacent copy ("Pick up where you left off," not "Dashboard").
- Apply this zone split to every new screen: pick one moment to be bold and dark, let the rest be soft and warm. Don't spread boldness evenly (reads busy) or softness evenly (reads flat/timid).

**Homepage note, 2026-08-31 (superseded same day, see next note):** the Meet Cece section was briefly converted from a dark moment (first Forest, then Deep Current) to Vanilla Cream with text in inset Soft Beige containers.

**Homepage note, 2026-08-31 (current):** same day, Cece asked for a different pattern — the whole hero-through-Meet-Cece area is now Vanilla Cream page background with two separate dark-teal (Deep Current) *card* containers standing on it: one holding the hero text, one holding the Cece photo and bio text together (`.home-hero-copy`, `.cece-card`). This is a different visual language than the "one full-bleed dark section" rule above was written for — dark now reads as a contained accent card on a light page, not an alternating full-bleed section. The rule's spirit (one deliberate zone of confidence/boldness, not scattered darkness) still roughly holds since both dark cards sit in the same opening area of the page and read as one connected "chapter," but this is a genuine pattern shift worth a deliberate decision next time §5.6b itself gets revisited, not something this entry resolves on its own. `.home-products` further down the page is still a third, separate full-bleed dark section, unrelated to this pair.

---

## 6. COMPONENT PATTERNS

### 6.1 Buttons

Each button variant has its own distinct hover color — never one shared hover color across all variants.

| Variant | Background | Text | Border | Hover | Active |
|---|---|---|---|---|---|
| `.btn-primary` | `#7A2E42` (Wine) | `#FFFFFF` | none | `#5E2233` | `#5E2233` + `translateY(1px)` |
| `.btn-secondary` | `#A15C3E` (Copper) | `#F6F3EC` | none | `#83492F` | `#83492F` + `translateY(1px)` |
| `.btn-outline` | `#FFFFFF` | `#7A2E42` | 1px `#7A2E42` | `#FEFCF8` bg | `#EFE8DC` bg |
| `.btn-dark` | `#262624` (Charcoal) | `#FFFFFF` | none | `#7A2E42` bg | `#5E2233` bg |
| `.btn-hero` | transparent | `#FFFFFF` | 2px rgba(255,255,255,0.7) | Glow pulse animation (§6.10) | — |
| Disabled | `#DDDDDD` | `#ABABAB` | none | — | `cursor: not-allowed` |

- All buttons: DM Sans 700, 0.85rem, uppercase, letter-spacing 1px
- Padding: `14px 32px` (standard), `14px 36px` (hero)
- Border-radius: `6px` (per §5.4)
- Active: `transform: translateY(1px)` on tap/click, combined with the active-state color — should feel like a visible press
- Minimum touch target: 44×44px on mobile (`min-height: 44px`)

### 6.2 Cards

**Product Cards:**
- Background: Clean card `#FEFCF8`, border-radius `8–10px` (§5.4), soft shadow (`0 10px 40px rgba(37,37,53,0.07)`)
- Border: a hairline in Warm Sand `#D9C7AC` where a card needs a visible edge for contrast against a similar-colored background — a genuine border color now, not a placeholder gray
- Hover: `transform: translateY(-4px)`, `transition: 0.3s ease`
- Image height: 220px, `object-fit: cover`, top corners inherit the card's radius
- Category label: DM Sans 700, 0.7rem, uppercase, letter-spacing 0.1em, `#6B655C` (Warm gray)
- Title: Lora 700, 1.15rem, uppercase, `#262624`
- Description: DM Sans, 0.95rem, `#262624`
- CTA: full-width button, always at bottom
- Standard badges: colored text only, no fill, no border (§2.6) — `top: 1rem; right: 1rem`
- Featured/exclusive badges: Deep Teal is retired (§2.10/§2.11) — fall back to plain Rosewood or Wine tag-text (§2.6) until a new pop-accent fill is chosen

**Locked card (dashboard):** border with 40% opacity, grayscale + opacity on image, gradient background.

**Blog Cards:**
- Same border/shadow system as product cards
- Image height: 180px
- Title: Lora 700, 1rem (smaller than product cards)
- Date: DM Sans 400, 0.75rem, `#6B655C` (Warm gray)

### 6.3 Navigation

**Desktop header:**
- Sticky, white background, `border-bottom: 1px solid #D9C7AC` (Warm Sand)
- Nav links: DM Sans 700, 0.8rem, uppercase, letter-spacing 1px, `#262624`
- Active/hover: `color: #7A2E42` + `border-bottom: 2px solid #7A2E42`
- Auth link: `#7A2E42` text

**Mobile nav:**
- Slide-in panel from right, 280px wide, `border-left: 1px solid #D9C7AC`
- Hamburger: 24px width, 2px height bars, `#262624`
- Each link: `border-bottom: 1px solid #D3D3D3` (print/document rule line, used here as a UI hairline)
- Overlay: `rgba(0,0,0,0.3)` backdrop

### 6.4 Forms & Inputs

- Input border: `1px solid #D9C7AC` (Warm Sand), `border-radius: 6px` (§5.4)
- Input background: `#FEFCF8` (Clean card)
- Focus: `border-color: #7A2E42`
- Placeholder: `#BCBCBC`
- Labels: DM Sans 700, 0.75rem, uppercase, letter-spacing 0.05em, `#262624`
- Error state: `1px solid #9E3D0F`, Dark orange `#9E3D0F` text, pair with an icon or the word "Error" — never color alone (§2.5)
- Success state: `1px solid #46703F`, Moss `#46703F` text
- Form max-width: 420px centered

### 6.5 Email Capture

- Background `#FEFCF8` (Clean card), border `1px solid #D9C7AC` (Warm Sand), `border-radius: 8px` (§5.4)
- Padding 2.5rem, centered text
- Inline form: input + button, no gap (flush joined)
- Input border-right removed to join with button
- Mobile: stacks to full-width column

### 6.6 Filter Tabs

- DM Sans 700, 0.8rem, uppercase
- Active/hover: `color: #7A2E42` + `border-bottom: 2px solid #7A2E42`
- No background change on active
- Mobile: horizontal scroll, `flex-wrap: nowrap`

### 6.7 Toast Notifications

- Fixed top-center, Charcoal `#262624` background, white text
- DM Sans 800, 0.7rem, uppercase, letter-spacing 2px
- `border-bottom: 2px solid #7A2E42`
- Fade in/out via opacity

### 6.8 Dashboard

- Section titles: DM Sans 700, 0.85rem, uppercase, letter-spacing 0.1em, `#8C8272` (Taupe), `border-bottom: 1px solid #4B4B4B`
- Welcome: Lora 700, 1.5rem, uppercase, `#262624`
- Exclusive-content badge: Deep Teal fill per §6.2

### 6.9 Footer

- Soft White `#FFFEFB` background, `border-top: 1px solid #D9C7AC` (Warm Sand)
- Centered text layout
- Brand name: DM Sans 800, 0.9rem, uppercase, `#8C8272`, letter-spacing 2px
- Tagline below: DM Sans 400, 0.7rem, uppercase, letter-spacing 0.1em, `#8C8272` (Taupe)
- Nav links: 0.7rem, uppercase
- Copyright: DM Sans, 0.75rem, `#8C8272` (Taupe)

### 6.10 Animations

```css
@keyframes heroGlow {
  0%, 100% { box-shadow: 0 0 0 0 rgba(122,46,66,0); }
  50%       { box-shadow: 0 0 22px 6px rgba(122,46,66,0.55); }
}

@keyframes contentFadeIn {
  from { opacity: 0; transform: translateY(6px); }
  to   { opacity: 1; transform: translateY(0); }
}

@keyframes pulse {
  0%, 100% { opacity: 0.5; }
  50%       { opacity: 1; }
}
```

- Fade-in stagger classes: `.fade-in`, `.fade-in-delay-1` (0.1s), `.fade-in-delay-2` (0.2s), `.fade-in-delay-3` (0.3s)
- Hero button glow: 2.5s infinite, cancelled on hover
- Tap hint pulse: 2.5s infinite
- Hover transitions: 0.2s ease across the board
- Card lift: 0.3s ease
- **Tap feedback:** buttons/interactive elements get a visible press state on `:active` — e.g. `transform: scale(0.97)` or `translateY(1px)` plus a brief background shift
- **Count-up numbers:** totals/counters that change value animate from old to new (~400–600ms tween) rather than snapping instantly

---

## 7. LAYOUT CONVENTIONS

### 7.1 Grid & Containers

```
.container        max-width: 1200px  padding: 0 24px
.container-narrow max-width: 700px   padding: 0 24px
.blog-post        max-width: 700px   padding: 3rem 24px
.form-page        max-width: 420px
```

### 7.2 Section System

| Class | Background | Padding |
|---|---|---|
| `.section` | `#F6F3EC` (Page background) | `4rem 0` |
| `.section-bright` *(added 2026-08-01)* | `#FFFEFB` (Soft White) | `4rem 0` — for sections that want more light/contrast: photo-heavy sections, forms, checkout |
| `.section-alt` | `#FEFCF8` (Clean card) | `4rem 0` |
| `.section-cozy` | `#EFE8DC` (Cozy card) | `4rem 0` |
| `.section-charcoal` | `#262624` | `4rem 0` |

Sections alternate to create visual rhythm — never two Charcoal sections adjacent.

### 7.3 Grid System

- Product grid: `repeat(3, 1fr)`, gap 2rem → 2 col at 1024px → 1 col at 768px
- Blog grid: `repeat(3, 1fr)`, gap 2rem — same breakpoints
- Color swatch grid: `repeat(auto-fill, minmax(160px, 1fr))`, gap 12px

### 7.4 Breakpoints

| Breakpoint | Change |
|---|---|
| `max-width: 1024px` | Grids collapse to 2 columns |
| `max-width: 768px` | Desktop nav hidden, mobile hamburger shown; grids go 1 column; sections pad 2.5rem |
| `max-width: 480px` | Font sizes reduced; container padding 16px |
| `hover: none, pointer: coarse` | Min touch targets 44×44px enforced |

### 7.5 Spacing Conventions

- Section padding: `4rem 0` (desktop), `2.5rem 0` (mobile)
- Card content padding: `1.5rem`
- Form page margin: `4rem auto`
- Blog post padding: `3rem 24px`
- Hero: `7rem 0` (desktop), `3rem 0` (mobile)
- Margin after headings: h1 `1rem`, h2 `0.75rem`, h3 `0.5rem`
- Paragraph margin-bottom: `1rem` (body), `1.5rem` (blog post body)

### 7.6 Homepage Structure — Current (Live, rewritten 2026-08-27)

The redesign referenced in the prior version of this section shipped. Current structure, top to bottom:

1. Sticky header — centered nav, Log In link, mobile toggle
2. Hero — headline "Solo mom. Empty nest. What's next.", single CTA "Start Here →" linking to `/start-here`
3. "Meet Cece" section (Chapter Four) — Forest background (§2.13), portrait photo side-by-side with founder story copy, "Say hello →" button to `/connect`, "Read my full story →" link to `/about`
4. Three Pillars ("How I can help.") — Thrive (full catalog → `/shop`), Support (1:1 connect → `/connect`), Encourage (blog/community → `/blog`); scroll-reveal on each card via IntersectionObserver; quiz CTA below the cards
5. Newsletter signup section
6. Product cards with action-specific CTAs
7. Footer

The 6pm Experience widget that used to sit inline on the homepage was removed 2026-08-26 as dead code (it had zero remaining callers). This left **The 6pm Cheat Sheet** — a real, live free product — without a homepage entry point; Cece has this open as a decision to make on where (if anywhere) to re-link it.

`/start-here` is a separate standalone page (not just an anchor) with the same three-pillar content, used as the hero CTA's actual destination. The homepage's own Three Pillars section is not a duplicate to prune — Cece confirmed she wants both: the inline homepage section AND the dedicated page.

---

## 8. VOICE & TONE — POINTER ONLY

Full voice, tone, banned-phrase, and content-formula rules live in **`Skill_File_07-05-2026_v4.md`** (the Brand & Voice Bible) — not duplicated here by design, so there's one place to update instead of two. If that file and `CLAUDE.md`'s own banned-phrase list (Gate 3, Brand & Visual QA) ever disagree, the skill file wins and `CLAUDE.md`'s copy gets corrected to match.

The one rule worth repeating here because it's a design decision, not a copy one: **CTAs must sound like Cece talking, not a landing page template** — format is action verb + product name + arrow, e.g. "Get the Free 6pm Cheat Sheet →".

---

## 9. PRODUCT ECOSYSTEM

### 9.1 Live Products

| Product | Price | Location |
|---|---|---|
| Now What? Workbook (Book 1) | $14.99 PDF / $24.99 paperback | workbook.php + Amazon KDP |
| The Someday List Companion | $7.99 | Shop page |
| The 6pm Cheat Sheet | Free — email capture | Homepage hero + dashboard |
| The 6pm Survival Plan | Free — dashboard only | Dashboard |
| Who Am I Now | Free — dashboard only | Dashboard |
| Pick Your Mood Coloring Widget | Free — email gate needed on public version | Freebies + dashboard |
| Quiz: What Kind of Nester Are You? | Free | About page + `/nester-quiz` |
| Cooking for One Planner | $27 | Live |
| 30-Day Goal & Habit Tracker | $27 | Live — visual rebuild pending, back burner |
| Garage Sale Planner | $27 | Live |
| Know Before You Sell | Built | Pending Cece's review before redeploy |
| The Quiet House Meter | — | Back burner — widget never built |

### 9.2 Priority Pipeline

- **New Grandma Planner** — high priority, needs a blueprint doc first (per `MNC-BUILD-PLAYBOOK.md` Phase 1)
- Group 3 brand assets: Instagram post, carousel, story templates; Facebook cover; profile picture
- Stripe Product Catalogue + payment links
- Pinterest setup

For live-page inventory, dashboard gating logic, and the exclusive-content drop queue, see `CLAUDE.md` — that's the actively-maintained current-status file; this doc stays visual/structural.

---

## 10. SOCIAL MEDIA SYSTEM

| Platform | Status |
|---|---|
| Facebook | Fully configured. Active. |
| Instagram | Account created. 3 posts built. |
| Pinterest | Next priority for search-driven traffic. |

- Content strategy: 50/50 community-to-sell split
- Pinterest is the priority platform for organic search in this niche

---

## 11. ACCESSIBILITY BASELINE

- Skip link: `#7A2E42` bg, DM Sans 800, uppercase, appears on `:focus`
- `.sr-only` utility class present
- All interactive elements minimum 44×44px on touch devices
- ARIA labels and roles used on interactive widget elements

---

## 12. GAPS & MISSING ELEMENTS

*Carried forward from the prior version. These need re-verification against the actual current code by whoever's coding next — this doc can describe intent, not confirm what's actually shipped.*

### 12.1 Visual Assets

- Social media templates (Instagram post/carousel/story, Facebook cover, profile picture) — not yet built
- Dashboard thumbnails — placeholders still live
- Shop product mockups — no lifestyle hero, device mockup, or preview images for several products
- Product mockup format spec exists (4-image set per listing) but images not created

### 12.2 Design Tokens / Code

- `style.css` has a `:root` custom-property block (verified live, 2026-08-30) covering every locked color through Rosewood/Warm Sand/Bark/Golden Earth/Forest — no longer hardcoded for those. Two dead tokens sit in the same block: `--font-display` (Playfair Display, never loaded as a web font and never referenced — every rule uses `--font-display-locked` (Lora) instead) and `--section-padding` (defined, zero usages — sections hardcode `4rem 0` directly). Both are harmless as long as nobody starts using them; worth deleting next time someone's in that file.
- Spacing has no scale beyond the one unused `--section-padding` token above — still an open gap.
- No dark mode system — no `prefers-color-scheme` spec exists or is planned

### 12.3 Typography

- No line-height/letter-spacing values defined for print context
- No fallback font stack for Lora/DM Sans for offline/slow-load states

### 12.4 Components

- **Forms & Inputs (§6.4) don't match live code (verified 2026-08-30).** `style.css` `.form-group input` and `.email-capture-form input` still use pre-July-27 values — border `#ABABAB` instead of Warm Sand `#D9C7AC`, background `#FCFCFC` instead of Clean card `#FEFCF8`, text `#101010` instead of Charcoal. `#FCFCFC` is explicitly on the retired list (§2.11, "Input BG"). Rollout gap, not a documentation error — §6.4 states the intended spec correctly.
- **`.form-error` / `.form-success` still use retired colors (verified 2026-08-30).** Both classes use the pre-July-27 Error Red `#C0392B`/`#FDEDEC` and Success Green `#1E7E34`/`#E8F5E9` (§2.11) instead of the locked Dark orange `#9E3D0F` / Moss `#46703F` (§2.5). Same rollout gap as above — the only two live style-sheet rules still on the retired system as of this check.
- **Footer (§6.9) doesn't match live code (verified 2026-08-30).** `.site-footer` uses `#FFFFFF`/`#ABABAB` instead of the documented Soft White `#FFFEFB` background and Warm Sand `#D9C7AC` border-top.
- Quiet House Meter — redesign flagged as priority, current version not approved final
- Email gate on Pick Your Mood Coloring Widget — built into dashboard, not yet on public Freebies version
- No dedicated downloads section on dashboard separating PDFs from interactive tools
- Blog — card/post CSS defined, zero posts written
- Stripe payment wiring — not yet generated for pipeline products

### 12.5 Brand Documentation

- Product Copywriting Skill and Email/Blog Voice Skill — not built
- Pinterest strategy and templates — not developed
- Animation/motion spec — animations exist in CSS but aren't documented as named patterns outside code comments
- Icon library — icon color defined, no icon set/source specified

---

## APPENDIX A — Quick Reference Hex Codes

**As of 2026-08-30, these two blocks describe different things.** `style.css` has not been touched by the 2026-08-30 color lock — its `:root` still holds the retired July 27/August 1 tokens exactly as shipped. The second block is the rollout target: the token names code should move to once that work is scheduled, not what's live today.

### Currently live in `style.css` (retired per §2.11, unchanged by this pass)

```css
--charcoal:      #262624;   /* retired — text/dark neutral */
--page-bg:       #F6F3EC;   /* retired — background */
--clean-card:    #FEFCF8;   /* retired */
--cozy-card:     #EFE8DC;   /* retired */
--soft-white:    #FFFEFB;   /* retired */
--wine:          #7A2E42;   /* retired — was primary button */
--wine-hover:    #5E2233;   /* retired */
--copper:        #A15C3E;   /* retired — was secondary button */
--copper-hover:  #83492F;   /* retired */
--golden-earth:  #99621E;   /* NOT retired — see §2.homepage-legacy, still open */
--forest:        #2D3B32;   /* NOT retired — see §2.homepage-legacy, still open */
--font-display:  'Playfair Display', serif;   /* dead token — briefly activated as a hero accent 2026-08-30, reverted 2026-08-31 (see §5.2b). Unrelated to the color rollout either way. */
```

Still live and **not** part of the color lock either way (§2.4/§2.5/§2.9 — carried over, unresolved): `--taupe #8C8272`, `--warm-gray #6B655C`, `--warm-sand #D9C7AC`, `--bark #5B3A28`, `--dark-orange #9E3D0F`, `--moss #46703F`, `--rosewood #80475E`.

### Target — 2026-08-30 palette, not yet in code

```css
/* Text / dark neutral */
--deep-coffee:       #2B1F18;   /* replaces --charcoal */

/* Background */
--vanilla-cream:     #F6F1E6;   /* replaces --page-bg. No confirmed replacement yet for
                                    --clean-card/--cozy-card/--soft-white — see §2.2 */

/* Buttons — two signature action colors */
--deep-current:        #0A2F3A;   /* primary, replaces --wine. Use white text. */
--deep-current-hover:  #08252D;   /* proposed, not yet eyeballed — see §2.3 */
--burnished-copper:        #A35E33;   /* secondary, replaces --copper. Use white text, NOT cream — see §2.3 */
--burnished-copper-hover:  #7F4928;   /* proposed, not yet eyeballed — see §2.3 */

/* Accent */
--golden-honey:      #C8A878;   /* fill only, Deep Coffee text on top — never as text/link on Vanilla Cream, see §2.new-accent */

/* Card & Box colors (§2.new-cards) — each paired with its passing text color */
--soft-sand:          #F1D9B3;   /* + Deep Coffee text */
--warm-beige-card:     #E6D6C2;   /* + Deep Coffee text — distinct from any retired token of a similar name */
--golden-drift:       #D8975A;   /* + Deep Coffee text */
--caramel:            #B88A5A;   /* + Deep Coffee text */
--caramel-brown:      #8B5E3C;   /* + Vanilla Cream text */
--spiced-caramel:     #A67C52;   /* + Deep Coffee text — AA-large only, headings/large text, not body copy */
--oceanic-teal:       #1D6B78;   /* + Vanilla Cream text */
--smoky-sienna:       #5A4839;   /* + Vanilla Cream text */
--mocha-brown:        #5E3E2B;   /* + Vanilla Cream text */
```

Not carried into this block because they're unresolved, not because they're settled (see §2.4/§2.5/§2.9): Taupe, Warm gray, Warm Sand, Bark, Dark orange, Moss, Rosewood keep their current retired-system hex values until Cece decides whether the new palette replaces them too.

```css
/* Document elements (print/workbook only, untouched by this revision) */
--icon-gray:     #4B4B4B;
--rule-line:     #D3D3D3;
--box-border:    #ABABAB;
--alt-rule:      #E0E0E0;

/* Text (print/PDF only, untouched by this revision) */
--text-title:    #0D0D0D;
--text-heading:  #333333;
--text-body:     #101010;
```

Full retired-color ledger, including the entire July 27/August 1 system now retired by this pass: §2.11.

---

## APPENDIX B — Font Loading

**Web (site):**
```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
```

**Interactive HTML tools:**
```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
```

**Print / Workbook / PDF:**
Fonts loaded at build time from local files. Montserrat ExtraBold + Arial Regular only. Never loaded as a web font.

---

*My Nest Chapter — Design System*
*Created by Cecilia Ann (Cece)*
*For Single & Solo Moms*
*DESIGN.md — full rewrite 2026-08-01, consolidating all prior versions against current live state*
