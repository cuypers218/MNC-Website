# My Nest Chapter — Design System
**Version 5 — August 1, 2026 — Full rewrite**
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

> **Locked July 27, 2026, extended August 1, 2026.** Supersedes every earlier palette (May 2026, July 5, July 16 Wine Ramp) entirely — all retired, not amended. Built and confirmed with Cece through live mockups and WCAG contrast checks. One palette for everything — web, print, and interactive tools all draw from this same set, except where §2.7–2.8 note a deliberate print-only exception.

### 2.1 Text / Dark Neutral

| Name | Hex | Role |
|---|---|---|
| Charcoal | `#262624` | All body text, headings, nav, footer. 15:1+ against every background below — AAA everywhere. Never more than 20–30% of any page as a fill/background. |

### 2.2 Backgrounds and Cards

| Name | Hex | Role |
|---|---|---|
| Page background | `#F6F3EC` | Main page background — hero, most content sections. 70–80% of every page. |
| Clean card | `#FEFCF8` | Near-white card surface. Pair with a 0.5px hairline border — the difference from Page background alone is too subtle to read as "layered." |
| Cozy card | `#EFE8DC` | Deeper, warmer card surface. Same hairline-border rule. Also used for dividers and the old "Alt Section BG" role. |
| Soft White *(added 2026-08-01)* | `#FFFEFB` | Alternate background, brighter than Page background — for sections that want more light/contrast (photo-heavy sections, forms, checkout). Not a card surface — use Clean card for that. |

### 2.3 Buttons — Two Signature Action Colors

| Name | Hex | Role |
|---|---|---|
| Wine | `#7A2E42` | **Primary** — emotional/connection CTAs: 6pm Experience, founder story, newsletter. 8.44:1 against Page background — AAA. |
| Copper | `#A15C3E` | **Secondary** — product/functional CTAs. 4.60:1 against Page background — AA. |

Both confirmed liked independently — this is a genuine two-color system, not primary-with-a-fallback. If a screen needs just one, default to Wine. **No other color is ever a button fill** — Rosewood and Deep Teal are accents, not action colors (see §2.6, §2.10).

### 2.4 Labels, Icons, and Structure

| Name | Hex | Role |
|---|---|---|
| Taupe | `#8C8272` | Decorative labels, eyebrow text, category labels only. 3.41:1 against Page background — AA-large only, never small primary reading text. Never on buttons, never as a background. |
| Warm gray | `#6B655C` | Icons, small UI elements. 5.20:1 against Page background — full AA at any size. |
| Warm Sand *(added 2026-08-01)* | `#D9C7AC` | Fills the gap between Cozy card and Taupe in the neutral ramp. Dividers, borders, muted/disabled UI. 9.18:1 against Charcoal — safe even if text ever sits on it, though that's not its intended job. |
| Bark *(added 2026-08-01)* | `#5B3A28` | Deeper brown between Copper and Charcoal. Hover state on Copper buttons; secondary text darker than Warm gray where Charcoal reads too heavy. 9.11:1 against Page background — AAA. |

### 2.5 Error and Success

| Name | Hex | Role |
|---|---|---|
| Dark orange | `#9E3D0F` | Error states, form validation failures. 6.06:1 against Page background. Never rely on color alone — pair with an icon or the word "Error"; sits close in family to Copper. |
| Moss | `#46703F` | Success states, confirmations. 6.30:1 against Page background. |

### 2.6 Tags

Colored text only — no fill, no background tint, no border. Tested and rejected both alternatives directly with Cece (filled tint backgrounds, then outlined borders) before landing here; plain colored text tested as the most legible option.

| Name | Hex | Use |
|---|---|---|
| Wine | `#7A2E42` | e.g. "solo mom favorite" |
| Copper | `#A15C3E` | e.g. "most popular" — on Cozy card specifically, keep to large/bold text only (4.19:1, AA-large not full AA) |
| Moss | `#46703F` | e.g. "new this week" |
| Rosewood | `#80475E` | A fourth tag-text option (see §2.9) |

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

### 2.9 Tertiary Accent — Rosewood (added 2026-07-31)

Added to the July 27 lock, not a replacement for anything above. Name is provisional — rename here and in `CLAUDE.md` if "Rosewood" doesn't stick.

| Name | Hex | Role |
|---|---|---|
| Rosewood | `#80475E` | Flexible sitewide accent — decorative highlights, a fourth tag-text option, small accent details. 6.36:1 against Page background — AA, just under the AAA line Wine hits. Sits close in family to Wine; don't use both in the same small element (e.g. not adjacent tag + button) — they'll read as a mismatched pair rather than a deliberate duo. |

### 2.10 Pop Accent — Retired (was Deep Teal, added 2026-08-01, retired 2026-08-11)

Deep Teal `#114B5F` was the single "pop of color" against the earthy palette for about a week and a half — Cece retired it 2026-08-11. No replacement pop-accent has been chosen yet; badges/highlight markers fall back to Rosewood (§2.9) or plain Wine/Copper text (§2.6) until one is picked.

### 2.12 Candidates — Pulled from Coolors, Not Yet Role-Assigned (added 2026-08-11)

Sourced from a Coolors screenshot Cece was reviewing in a separate session ("Balancing empathy with optimism on homepage," 2026-08-08), where they were tracked as "not added yet." Added here as available colors — nothing below has an assigned role, a button/tag/background rule, or a contrast check yet. Don't use in new code until a role is picked; that's a deliberate design decision, not a documentation gap to fill in guessing.

| Name | Hex | Role |
|---|---|---|
| Almond Cream | `#EAE0D5` | Not yet assigned |
| Khaki Beige | `#C6AC8F` | Not yet assigned |
| Golden Earth | `#99621E` | Not yet assigned |
| Warm Amber *(name placeholder)* | `#CE8147` | Not yet assigned |
| Deep Umber *(name placeholder)* | `#504136` | Not yet assigned |
| Warm Ivory *(name placeholder)* | `#F7F4EA` | Not yet assigned |
| Marigold | `#FFA500` | Not yet assigned — the bright, saturated version. Confirmed 2026-08-11 as the color behind an earlier session's "where's my marigold" question; it lives in a Coolors AI chat, not any file in this repo. |

The three "name placeholder" rows are hex-only as given — I generated a descriptive name from the color itself so they're not just raw hex in prose; rename freely, nothing is riding on these names yet.

Two more colors were visible in that same Coolors screenshot (`#685044` and `#582419`, both dark warm browns) but their names were cut off — added once confirmed.

### 2.11 Retired Colors — Never Use

**Retired July 27, 2026 (the entire July 5–16 system):** Velvety Charcoal `#252535`, Warm Antique White `#FAF7ED`, Deep Rose `#C44570`, Periwinkle `#8BA7D4`, Lavender `#C4B0E8`, Soft Peach `#F5C4A8`, Rose Tint `#F9ECF0`, Peach Tint `#FCF0E8`, Peach Mid `#EFA276`, Warm Brown `#6D4C3E`, Tool Background `#FDFBF7`, the entire Wine/Deep Rose Ramp (stops 50–950, including `#F3D8E1`, `#E7B1C3`, `#DA8BA5`, `#CE6487`, `#74253F`, `#4E182A`, `#270C15`, `#1B090F`), Error Red `#C0392B`, Error BG `#FDEDEC`, Success Green `#1E7E34`, Success BG `#E8F5E9`, Page Gray `#FAFAFA`, Input BG `#FCFCFC`.

**Retired July 5, 2026 (still retired):** Vibrant Pink `#E87AAA`, Vanilla Cream `#FFF8EE`, Powder Blue `#A8C5DA`, Peach `#F2A57A`, Lemon `#EDD96A`, Lime `#B5CC6A`.

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
- **Confidence/boldness** lives in one committed dark moment per screen — a Charcoal `#262624` (or Bark `#5B3A28` for something a touch warmer than pure near-black) section with a single decisive Wine accent, not scattered small accents. Restraint is what makes it read confident rather than loud.
- **Warmth/nurturing** lives in everything surrounding that moment — Page background space, soft-shadow cards (§5.4), rounded icon circles, encouraging first-person-adjacent copy ("Pick up where you left off," not "Dashboard").
- Apply this zone split to every new screen: pick one moment to be bold and dark, let the rest be soft and warm. Don't spread boldness evenly (reads busy) or softness evenly (reads flat/timid).

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

### 7.6 Homepage Structure — Current (Live)

1. Sticky header
2. Hero — Charcoal bg + photo overlay, CTA "Get the Free 6pm Cheat Sheet →"
3. 6pm Experience widget (inline, NOT a lightbox — never call it a lightbox)
4. "I'm Cece" section — narrow portrait photo, side-by-side layout
5. Combined account/newsletter signup section
6. Product cards with action-specific CTAs
7. Footer

**Redesign in progress, not yet built:** a new homepage direction is in planning as of 2026-08-01 — centered nav with login, soft-photography hero with staggered stats/story cards, the "What Kind of Nester Are You?" quiz as a feel-seen/email-capture moment, a freebie callout, founder story, and light social proof. Gate 1 (five questions) is answered; Gate 2 (design plan, needs Cece's literal "approved") has not run yet. Do not build against this paragraph — it's a plan, not a lock. This section (§7.6) will be rewritten to describe the new structure once it actually ships.

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

- No CSS custom properties — color system is hardcoded throughout `style.css`. A token layer would be a real maintainability upgrade.
- No defined spacing scale as named tokens
- No dark mode system — no `prefers-color-scheme` spec exists or is planned

### 12.3 Typography

- No line-height/letter-spacing values defined for print context
- No fallback font stack for Lora/DM Sans for offline/slow-load states

### 12.4 Components

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

```css
/* Text / dark neutral */
--charcoal:      #262624;

/* Backgrounds and cards */
--page-bg:       #F6F3EC;
--clean-card:    #FEFCF8;
--cozy-card:     #EFE8DC;
--soft-white:    #FFFEFB;   /* added 2026-08-01 — alt bright background */

/* Buttons — two signature action colors */
--wine:          #7A2E42;   /* primary — emotional/connection CTAs */
--wine-hover:    #5E2233;
--copper:        #A15C3E;   /* secondary — product/functional CTAs */
--copper-hover:  #83492F;

/* Labels, icons, structure */
--taupe:         #8C8272;   /* decorative labels only, AA-large — never buttons/bg/small text */
--warm-gray:     #6B655C;   /* icons, utility — full AA at any size */
--warm-sand:     #D9C7AC;   /* added 2026-08-01 — dividers, borders, muted UI */
--bark:          #5B3A28;   /* added 2026-08-01 — hover states, darker secondary text */

/* Error and success */
--dark-orange:   #9E3D0F;   /* error — pair with icon/text, never color alone */
--moss:          #46703F;   /* success, and third tag color */

/* Accents */
--rosewood:      #80475E;   /* tertiary accent — decorative highlights, fourth tag color */

/* Tags — colored text only, no fill, no border (see §6.2) */

/* Candidates, added 2026-08-11 — NOT role-assigned, do not use in new code yet (see §2.12) */
--almond-cream:  #EAE0D5;
--khaki-beige:   #C6AC8F;
--golden-earth:  #99621E;
--warm-amber:    #CE8147;   /* name placeholder */
--deep-umber:    #504136;   /* name placeholder */
--warm-ivory:    #F7F4EA;   /* name placeholder */
--marigold:      #FFA500;

/* Document elements (print/workbook only) */
--icon-gray:     #4B4B4B;
--rule-line:     #D3D3D3;
--box-border:    #ABABAB;
--alt-rule:      #E0E0E0;

/* Text (print/PDF only) */
--text-title:    #0D0D0D;
--text-heading:  #333333;
--text-body:     #101010;

/* Retired, never use: --deep-rose #C44570, --periwinkle #8BA7D4, --lavender #C4B0E8,
   --soft-peach #F5C4A8, --rose-tint #F9ECF0, --peach-tint #FCF0E8, --peach-mid #EFA276,
   --warm-brown #6D4C3E, --tool-bg #FDFBF7, the entire Wine/Deep Rose Ramp, --powder-blue #A8C5DA,
   --peach #F2A57A, --lemon #EDD96A, --lime #B5CC6A, old --teal #00CACA (not --deep-teal above),
   old --error-red #C0392B, old --success-green #1E7E34. Full list: §2.11. */
```

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
