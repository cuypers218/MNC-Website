# My Nest Chapter — Design System
**Version 4 — June 2026**
*Synthesized from: YNC_Brand_SKILL_v4_June2026.md · MNC_Brand_Reference_June2026.docx · site/assets/css/style.css · Brand Guides/mnc-new-palette.html · widget HTML source*

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

> **Locked July 27, 2026.** Supersedes the July 5, 2026 lock below and the July 16, 2026 Wine Ramp system entirely — both are retired, not just amended. Built and confirmed directly with Cece through a series of real mockups and WCAG contrast checks, in response to specific dissatisfaction with the July 5 palette (didn't like the blue on screen, black felt wrong as a dominant color, pink/peach looked inconsistent across contexts). One palette for everything — web, print, and interactive tools all draw from this same set.

### 2.1 Text / Dark Neutral

| Name | Hex | Role |
|---|---|---|
| Charcoal | `#262624` | All body text, headings, nav, footer. 15:1+ against every background below — AAA everywhere. Never more than 20–30% of any page as a fill/background. |

### 2.2 Backgrounds and Cards

| Name | Hex | Role |
|---|---|---|
| Page background | `#F6F3EC` | Main page background — hero, all content sections. 70–80% of every page. |
| Clean card | `#FEFCF8` | Near-white card surface. Pair with a 0.5px hairline border — the color difference from Page background alone is too subtle to read as "layered." |
| Cozy card | `#EFE8DC` | Deeper, warmer card surface. Same hairline-border rule. Also used for dividers and the old "Alt Section BG" role. |

### 2.3 Buttons — Two Signature Action Colors

| Name | Hex | Role |
|---|---|---|
| Wine | `#7A2E42` | **Primary** — emotional/connection CTAs: 6pm Experience, founder story, newsletter. 8.44:1 against Page background — AAA. |
| Copper | `#A15C3E` | **Secondary** — product/functional CTAs. 4.60:1 against Page background — AA. |

Both confirmed liked independently — this is a genuine two-color system, not primary-with-a-fallback. If a screen needs just one, default to Wine.

### 2.4 Labels and Icons

| Name | Hex | Role |
|---|---|---|
| Taupe | `#8C8272` | Decorative labels, eyebrow text, category labels only. 3.41:1 against Page background — AA-large only, never small primary reading text. Never on buttons, never as a background. |
| Warm gray | `#6B655C` | Icons, small UI elements. 5.20:1 against Page background — full AA at any size. |

### 2.5 Error and Success

| Name | Hex | Role |
|---|---|---|
| Dark orange | `#9E3D0F` | Error states, form validation failures. 6.06:1 against Page background. Never rely on color alone — pair with an icon or the word "Error"; it sits close in family to Copper. Replaces the old Error Red `#C0392B` / Error BG `#FDEDEC`. |
| Moss | `#46703F` | Success states, confirmations. 6.30:1 against Page background. Replaces the old Success Green `#1E7E34` / Success BG `#E8F5E9`. |

### 2.6 Tags

Colored text only — no fill, no background tint, no border. Tested and rejected both alternatives directly with Cece (filled tint backgrounds, then outlined borders) before landing here; plain colored text tested as the most legible option.

| Name | Hex | Use |
|---|---|---|
| Wine | `#7A2E42` | e.g. "solo mom favorite" |
| Copper | `#A15C3E` | e.g. "most popular" — on Cozy card specifically, keep to large/bold text only (4.19:1, AA-large not full AA) |
| Moss | `#46703F` | e.g. "new this week" |

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

### 2.9 Retired Colors — Never Use

**Retired July 27, 2026 (the entire July 5–16 system):** Velvety Charcoal `#252535`, Warm Antique White `#FAF7ED`, Deep Rose `#C44570`, Periwinkle `#8BA7D4`, Lavender `#C4B0E8`, Soft Peach `#F5C4A8`, Rose Tint `#F9ECF0`, Peach Tint `#FCF0E8`, Peach Mid `#EFA276`, Warm Brown `#6D4C3E`, Tool Background `#FDFBF7`, the entire Wine/Deep Rose Ramp (stops 50–950, including `#F3D8E1`, `#E7B1C3`, `#DA8BA5`, `#CE6487`, `#74253F`, `#4E182A`, `#270C15`, `#1B090F`), Error Red `#C0392B`, Error BG `#FDEDEC`, Success Green `#1E7E34`, Success BG `#E8F5E9`, Page Gray `#FAFAFA`, Input BG `#FCFCFC`.

**Retired July 5, 2026 (still retired):** Vibrant Pink `#E87AAA`, Vanilla Cream `#FFF8EE`, Powder Blue `#A8C5DA`, Peach `#F2A57A`, Lemon `#EDD96A`, Lime `#B5CC6A`.

**Retired earlier still:** Deep Berry `#811453`, all Berry shades, Soft Pink `#F8BBD0`, Warm Cream `#F4E8C1`, Warm Tan `#C8A982`, Warm Mauve `#BCAAA4`, Coral Orange `#FF6F61`, Teal `#00CACA`, Bright Yellow `#FFDD00`, Deep Plum `#6B3B50`, Light Peach `#F5D4B1`, Warm Gray `#B19D8D` (unrelated to the new, different Warm gray `#6B655C` above), Soft Linen `#EAD3B7`, Dusty Rose `#D7A8A4`, old widget palette (Sage Gold, Peach Tan, Sage Gray, Blush Pink, Linen White, Muted Mauve), Gold `#FFD700`, Navy `#000080`, and all prior pink/blue/lavender/peach shades.

---

## 3. TYPOGRAPHY

### 3.1 Print / PDF / Workbook Context

| Element | Font | Weight | Size | Color |
|---|---|---|---|---|
| Main Title | Montserrat | Extra Bold (800) | 16pt | `#0D0D0D` |
| Heading | Montserrat | Extra Bold (800) | 14pt | `#333333` |
| Subheading | Montserrat | Extra Bold (800) | 13pt | `#333333` |
| Body / Paragraph | Arial | Regular (400) | 12pt | `#101010` |

**Font rule:** Montserrat Extra Bold handles ALL display text. Arial Regular handles all body/paragraph text. No other fonts — ever. This is print/PDF/workbook only.

### 3.2 Web Context (site CSS) — corrected 2026-07-27

**This section previously documented Montserrat/Arial as the web font stack. That was wrong and had been wrong for a while — every other current source (CLAUDE.md, the skill file, the Widget Typography Hierarchy doc, and the live `style.css` as of today) already correctly uses Lora + DM Sans for web. Corrected below to match reality.**

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

**Rule:** Lora + DM Sans are for both web site pages and interactive HTML tools — the same pairing, one system, not two separate ones. Print/workbook typography (§3.1) remains its own separate system.

### 3.4 Type Treatment Rules

- All headings and nav elements: `text-transform: uppercase`
- Hero tagline: Lora 700, 2.2rem, `#F6F3EC`, uppercase, `letter-spacing: 0.02em`, `line-height: 1.15`
- No italics in print context
- No decorative fonts
- Fragments allowed and encouraged when they "land harder"

---

## 4. LOGO SYSTEM

### 4.1 Wordmark — Locked (May 2026), colors updated to July 27, 2026 palette

- **Stacked wordmark:** "MY NEST" in Taupe `#8C8272` | "Chapter" large in Wine `#7A2E42` | Copper `#A15C3E` accent bar
- **Tagline version adds:** "FOR SINGLE & SOLO MOMS." in Taupe `#8C8272`

### 4.2 Favicon / Brand Mark — Option B (Locked), colors updated to July 27, 2026 palette

- **Doorway icon** — slightly ajar door
- **Standalone:** Charcoal `#262624` door frame | Wine `#7A2E42` doorknob | Copper `#A15C3E` light spill
- **Favicon:** Page background `#F6F3EC` icon on Charcoal `#262624` background | Wine doorknob
- Files: `mnc-logo-black.svg`, `MNC_Brand_Mark_Doorway.svg`, `MNC_Logo_Stacked_Wordmark.svg`, `MNC_Logo_Tagline.svg`, `MNC_Favicon.svg`

**Not yet done:** these are Canva-exported SVG assets living outside this repo (not found under `MNC-Website/`) — this doc update is text-only. The actual asset files still need to be re-exported from Canva with the new colors before the favicon/logo files themselves match this spec.

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

**Corrected July 16, 2026 — supersedes all prior zero-radius/zero-shadow language, sitewide, no exceptions this time.** The original "no border-radius, no shadows" rule was adopted from a stark editorial/broadsheet look without a real design rationale behind it — Cece's own words: "I have no idea what I was doing... I just was going off of other things I read." On review, that rule reads cold and severe rather than premium, and doesn't match the modern, stylish-but-mature feel the brand actually wants. The Garage Sale Planner's 2026-07-03/04 rounded-corner/soft-shadow exception was the correct instinct — it's now promoted to the sitewide standard instead of a one-file deviation.

**New standard — moderate radius, soft elevation:**
- Cards, containers, panels: `border-radius: 8–10px`
- Buttons, inputs: `border-radius: 6px`
- Tags/pills/badges only: `border-radius: 9999px` (fully round — reserved for small label-shaped elements, not general containers)
- Standard card shadow: `box-shadow: 0 10px 40px rgba(37,37,53,0.07)` — one soft, low-opacity shadow for elevation. No heavy/glossy shadows, no multiple stacked shadows.
- Reasoning: zero radius reads harsh/stark; heavy rounding (16px+) reads playful/juvenile. This middle range reads clean and mature — think Stripe, Linear, Notion, not a newspaper page and not a kids' app.
- No emoji in any brand material — this rule is unchanged.
- Apply this to every widget, the main site, and all future builds. Nothing stays zero-radius going forward.

### 5.5 Workbook / PDF Page Design

- Cover pages: brand colors, Montserrat titles, doorway motif
- **Content pages (non-cover):** neutral grays, off-whites, and black text ONLY — no brand colors on content pages
- Workbook interior: rule lines `#D3D3D3`, box borders `#ABABAB`, alt lines `#E0E0E0`, icon gray `#4B4B4B`
- Montserrat 800 for all headings; Arial Regular for all body text

### 5.6 Feel & Interaction Standards (added July 16, 2026)

**Who this is for — read this before applying anything below.** The buyer is not stressed, not low-tech, not someone who needs to be handled carefully. She's capable, tech-comfortable, and willing to learn. What she has, at this stage of life, is clarity about what her time is worth — she doesn't want to spend it on something clunky, and she doesn't want to feel talked down to. Every rule below exists to make the tool feel sharp and competent, not to compensate for fragility. If a design choice is justified by "she might get confused," that's the wrong justification — reframe around respect and competence instead.

**Interaction order — friction, then clarity, then delight, in that sequence:**
1. Remove friction first (can she do the thing without fighting the interface?)
2. Reduce confusion second (does she know what's happening and why?)
3. Layer delight on top, last (animation/encouragement never substitutes for a flow that doesn't already work)

**Progressive disclosure:** Show only what's needed for the current step. Advanced or secondary features (e.g. the Garage Sale Planner's eBay price lookup) stay tucked away until she's ready for them. Don't front-load every field/option on one screen — that's what makes a tool feel like homework.

**Momentum framing, not static data:** Progress should read as "3 more items and you're halfway sorted," not just "47 items." Every screen should read like it already understands what she's doing — "Let's set your sale goal," not "Welcome" or "Dashboard" as a blank label.

**Milestone-based encouragement, not constant:** Reserve any personal-voice touch (a short note in Cece's voice, a small celebratory moment) for real milestones — finished sorting, hit the money goal, sale day arrives. Not every tap. Overusing encouragement cheapens it; used sparingly at real milestones, it lands.

**Mobile-first micro-interactions** (most use happens on a phone):
- Visible tap feedback on every interactive element — a button visibly presses/lightens on tap, not just a hover-color change that doesn't exist on touch anyway
- State changes animate (a card moving to "sold" slides or fades, never just snaps)
- Swipe gestures where they fit naturally (e.g. swipe an item left for Donate, right for Sell) as an alternative to small tap targets
- Numbers that change (totals, counts) animate/count up rather than snapping instantly — reads as responsive, not laggy
- Bottom sheets sliding up from the bottom for mobile actions, instead of small centered popup modals
- Touch targets sized for a thumb (44×44px minimum, per §6.1), not a mouse cursor

**Respect-her-time patterns (apply to Garage Sale Planner first, then all future tools):**
- **Smart defaults over blank forms** — pre-fill what can reasonably be assumed (today's date, typical sale window, standard categories); let her override rather than starting from zero every time
- **Undo instead of confirm, where reversible** — let the action happen instantly, then offer a brief "Undo," rather than a confirmation dialog that stops her before she's done anything. Confirmation dialogs read as "the tool doesn't trust you." (Note: this refines, not replaces, the existing Garage Sale Planner Confirmation & Silence Pattern rule — genuinely irreversible/high-stakes actions still confirm; anything reversible should prefer undo.)
- **Quick-add / command-bar pattern** — a single fast-entry field (e.g. typing "shirts 3 for $5" or "lamp $20") that the tool parses, instead of opening a multi-field form for every single item. This is the highest-leverage fix for making sorting/pricing feel fast instead of tedious.
- **Shortcuts that reward repeat use** — e.g. "duplicate last item, just change the price" once she's added a few items, so the tool visibly gets faster the more she uses it
- **Shareable proof of her own work** — a clean, well-designed summary she could screenshot or send ("I made $340 today") once a milestone is hit
- **No talking-at-her tutorial overlay** — skip walkthroughs that explain the whole tool up front. One subtle inline hint on her first real action (e.g. adding her first item), then never repeat it. She learns by doing.
- **Cross-tool consistency** — whichever interaction pattern wins here (quick-add, undo-not-confirm, live-updating totals) becomes the standard for every future tool (New Grandma Planner, Know Before You Sell, etc.), so a second MNC purchase feels immediately familiar rather than like learning a new interface.

### 5.6b Confident + warm blend (added 2026-07-16)

Cece's brief: "sexy and confident" blended with "warm, nurturing and encouraging" — confirmed against a live mockup. The two qualities aren't a compromise blended evenly across a screen; they're separated by zone:
- **Confidence/boldness** lives in one committed dark moment per screen — a near-black (`#1B090F`, Wine Ramp 950, or Charcoal `#262624`) section with a single decisive Wine accent (e.g. a circular progress ring), not scattered small accents. Restraint is what makes it read confident rather than loud.
- **Warmth/nurturing** lives in everything surrounding that moment — Page background space, soft-shadow white cards (§5.4), rounded icon circles pulling from the Wine Ramp's light stops, encouraging first-person-adjacent copy ("Pick up where you left off," not "Dashboard").
- Apply this zone split to every new screen: pick one moment to be bold and dark, let the rest be soft and warm. Don't spread boldness evenly (reads busy) or softness evenly (reads flat/timid).

---

## 6. COMPONENT PATTERNS

### 6.1 Buttons

Each button variant has its own distinct hover color — never one shared hover color across all variants. As of 2026-07-27, hover/active states are simple fixed shades, not ramp-derived (the Wine Ramp this used to reference is retired — see §2).

| Variant | Background | Text | Border | Hover | Active |
|---|---|---|---|---|---|
| `.btn-primary` | `#7A2E42` (Wine) | `#FFFFFF` | none | `#5E2233` | `#5E2233` + `translateY(1px)` |
| `.btn-secondary` | `#A15C3E` (Copper) | `#F6F3EC` | none | `#83492F` | `#83492F` + `translateY(1px)` |
| `.btn-outline` | `#FFFFFF` | `#7A2E42` | 1px `#7A2E42` | `#FEFCF8` bg | `#EFE8DC` bg |
| `.btn-dark` | `#262624` (Charcoal) | `#FFFFFF` | none | `#7A2E42` bg | `#5E2233` bg |
| `.btn-hero` | transparent | `#FFFFFF` | 2px rgba(255,255,255,0.7) | Glow pulse animation (see §6.10) | — |
| Disabled | `#DDDDDD` | `#ABABAB` | none | — | `cursor: not-allowed` |

- All buttons: DM Sans 700, 0.85rem, uppercase, letter-spacing 1px
- Padding: `14px 32px` (standard), `14px 36px` (hero)
- Border-radius: `6px` (per §5.4 — pill/`9999px` is reserved for tags/badges, not buttons)
- Active: `transform: translateY(1px)` on tap/click, combined with the active-state color above — should feel like a visible press, not just a color shift
- Minimum touch target: 44×44px on mobile (`min-height: 44px`)

### 6.2 Cards

**Product Cards:**
- Background: `#FFFFFF` or `#FEFCF8` (Clean card), border-radius `8–10px` (per §5.4), soft shadow (`0 10px 40px rgba(37,37,53,0.07)`) — border only if a card needs a hard edge for contrast against a similar-colored background
- Hover: `transform: translateY(-4px)`, `transition: 0.3s ease`
- Image height: 220px, `object-fit: cover`, top corners inherit the card's radius (clip to match)
- Category label: DM Sans 700, 0.7rem, uppercase, letter-spacing 0.1em, `#6B655C` (Warm gray)
- Title: Lora 700, 1.15rem, uppercase, `#262624`
- Description: DM Sans, 0.95rem, `#262624`
- CTA: full-width button, always at bottom
- Badges: colored text only, no fill, no border (see §2.6) — positioned `top: 1rem; right: 1rem`

**Locked card (dashboard):** border with 40% opacity, grayscale + opacity on image, gradient background.

**Blog Cards:**
- Same border/shadow system as product cards
- Image height: 180px
- Title: Lora 700, 1rem (smaller than product cards)
- Date: DM Sans 400, 0.75rem, `#6B655C` (Warm gray)

### 6.3 Navigation

**Desktop header:**
- Sticky, white background, `border-bottom: 1px solid #ABABAB`
- Nav links: DM Sans 700, 0.8rem, uppercase, letter-spacing 1px, `#262624`
- Active/hover: `color: #7A2E42` + `border-bottom: 2px solid #7A2E42`
- Auth link: `#7A2E42` text

**Mobile nav:**
- Slide-in panel from right, 280px wide, `border-left: 1px solid #ABABAB`
- Hamburger: 24px width, 2px height bars, `#262624`
- Each link: `border-bottom: 1px solid #D3D3D3`
- Overlay: `rgba(0,0,0,0.3)` backdrop

### 6.4 Forms & Inputs

- Input border: `1px solid #E5DED0`, `border-radius: 6px` (per §5.4)
- Input background: `#FEFCF8` (Clean card)
- Focus: `border-color: #7A2E42`
- Placeholder: `#BCBCBC`
- Labels: DM Sans 700, 0.75rem, uppercase, letter-spacing 0.05em, `#262624`
- Error state: `1px solid #9E3D0F`, Dark orange `#9E3D0F` text, pair with an icon or the word "Error" — never color alone (see §2.5)
- Success state: `1px solid #46703F`, Moss `#46703F` text
- Form max-width: 420px centered

### 6.5 Email Capture

- Background `#FFFFFF`, border `1px solid #ABABAB`, `border-radius: 8px` (per §5.4)
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

### 6.9 Footer

- White background, `border-top: 1px solid #ABABAB`
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
- **Tap feedback (added July 16, 2026, see §5.6):** buttons/interactive elements get a visible press state on `:active` — e.g. `transform: scale(0.97)` or `translateY(1px)` plus a brief background shift — not just a hover state, since touch has no hover
- **Count-up numbers (added July 16, 2026):** totals/counters that change value should animate from old value to new (e.g. a simple JS tween over ~400–600ms) rather than snapping instantly

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
| `.section` | `#FAFAFA` | `4rem 0` |
| `.section-alt` | `#FFFFFF` | `4rem 0` |
| `.section-cream` | `#F6F3EC` | `4rem 0` |
| `.section-warm` | `#F6F3EC` | `4rem 0` |
| `.section-charcoal` | `#262624` | `4rem 0` |
| `.section-dusty` | `#E8EEF4` | `4rem 0` |

Sections alternate to create visual rhythm — never two charcoal sections adjacent.

### 7.3 Grid System

- Product grid: `repeat(3, 1fr)`, gap 2rem → 2 col at 1024px → 1 col at 768px
- Blog grid: `repeat(3, 1fr)`, gap 2rem → same breakpoints
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

### 7.6 Homepage Structure (Built & Live)

1. Sticky header
2. Hero — Charcoal bg + photo overlay, CTA "Get the Free 6pm Cheat Sheet →"
3. 6pm Experience widget (inline, NOT a lightbox — never call it a lightbox)
4. "I'm Cece" section — narrow portrait photo, side-by-side layout
5. Combined account/newsletter signup section
6. Product cards with action-specific CTAs
7. Footer

---

## 8. VOICE & TONE SYSTEM

### 8.1 Core Voice Positioning

- **Mom-to-mom, not coach-to-client** — Cece is a peer who lived it, not an expert above the reader
- **Past tense for Cece's stories, present tense for instructions**
- **First person "I" always** — never "we," never third person, never "the brand"
- **Fragments allowed** when they land harder than full sentences
- Short, punchy sentences. Direct and honest. No sugarcoating.

**Audience framing (corrected July 16, 2026):** Never characterize the reader/buyer as "stressed," "overwhelmed," "low-tech," or "not a power user." She is capable, tech-comfortable, and willing to learn — this stage of life means she's clear-eyed about what her time is worth, not that she's fragile or needs to be handled carefully. She wants to be taken seriously and treated with respect. This applies to copy tone and to every product/UX design decision (see §5.6) — reasoning should start from competence and self-respect, never from an assumption of confusion or hand-holding need.

### 8.2 Possibility Language (Mandatory)

All outcome promises are banned. Replace with process language:

| Never | Always |
|---|---|
| This will help you | This helped me / This is one way to... |
| You'll feel | I felt / You might notice |
| You'll discover | I found / You may find |
| This gives you | This gave me |
| This can help | This might help / One way to start... |
| You need to | You might want to |
| Now you can move forward | This is where you start |

### 8.3 Brand Vocabulary

**Use:** quiet · shift · chapter · experience · change · alone · lived · lost · fear · figure out · maybe / might · still · helped me · what I lived

**Never use (replace silently):**
- journey → experience, path, chapter
- transformation → change, shift
- rediscovering → finding
- empowering → helpful, freeing
- clarity → understanding, direction
- navigate → move through, figure out
- starting over → never use

### 8.4 Prohibited Language Categories

- **Therapy speak:** hold space, sit with your feelings, honor your journey, healing journey, unpack, inner child, safe space, emotional labor, mindfulness, triggers, trauma response
- **Coaching / self-help:** level up, step into your power, manifest, abundance mindset, growth mindset, lean in, boss up, show up
- **Toxic positivity:** you are enough, warrior, fierce, girl boss, good vibes only, everything happens for a reason, bloom where you're planted
- **Outcome promises:** this will help you, you'll find, you'll feel, you'll walk away with, this changes everything
- **Demanding tone:** you need to, you must, you have to, don't skip this, make sure you
- **Softening filler (cut always):** just, actually, really, very, quite, simply, gently, basically

### 8.5 CTAs & Product Copy

- CTAs must sound like Cece talking, not a landing page template
- Format: action verb + product name + arrow — "Get the Free 6pm Cheat Sheet →"
- Product descriptions center reader pain, not product features
- No cheerleading in CTAs

---

## 9. CONTENT FORMULAS

### 9.1 "Why Do This Activity" — 4-Paragraph Formula

1. **My Experience as a Solo Mom** — How I felt. Past tense. First person. Specific, not general.
2. **My Personal Story** — Real and concrete. Names, moments, details.
3. **What Helped Me** — Concrete and specific. Not a promise.
4. **Possibility for Her** — Possibility language only. No outcome promises. No assumed feelings.

### 9.2 Product Format Rules

| Format | Use for | Sold where |
|---|---|---|
| Workbook | Long-form guided work | Amazon KDP + website |
| Companion | Shorter, focused topics | Website only |
| Interactive HTML tool | Repeat-use concepts | Website (HTML file + PDF instructions) |
| PDF | One-time-use concepts | Website |

Content pages (non-cover) in all products: neutral grays, off-whites, black text only — no brand colors.

### 9.3 Page Naming (Locked)

- "Freebies" — not Free Tools, not Free Resources, not Free Stuff (copy says "free stuff"; nav says "Freebies")
- Shop = paid products only
- Every public freebie requires email capture — members get everything gate-free

---

## 10. PRODUCT ECOSYSTEM

### 10.1 Live Products

| Product | Price | Location |
|---|---|---|
| Now What? Workbook (Book 1) | $14.99 PDF / $24.99 paperback | workbook.php + Amazon KDP |
| The Someday List Companion | $7.99 (placeholder) | shop page |
| The 6pm Cheat Sheet | Free — email capture | Homepage hero + dashboard |
| The 6pm Survival Plan | Free — member freebie | Dashboard (Month 1) |
| Who Am I Now | Free — member freebie | Dashboard (Month 2) |
| Pick Your Mood Coloring Widget | Free — email gate needed | Freebies + dashboard |
| Quiz: What Kind of Nester Are You? | Free | About page + /nester-quiz |
| Garage Sale Planner | HTML tool — built, not listed | Pipeline |
| What's This Worth | HTML tool — built, not listed | Pipeline |
| Weekly Cooking for One | HTML tool — built | Pipeline |

### 10.2 Priority Pipeline

- **New Grandma Planner** — HIGH PRIORITY, interactive HTML tool
- Group 3 brand assets: Instagram post, carousel, story templates; Facebook cover; profile picture
- Stripe Product Catalogue + payment links
- Pinterest setup

---

## 11. SOCIAL MEDIA SYSTEM

| Platform | Status |
|---|---|
| Facebook | Fully configured. Active. |
| Instagram | Account created. 3 posts built. |
| Pinterest | Next priority for search-driven traffic. |

- Content strategy: 50/50 community-to-sell split
- Pinterest is the priority platform for organic search in this niche

---

## 12. ACCESSIBILITY BASELINE

- Skip link implemented: `#7A2E42` bg, DM Sans 800, uppercase, appears on `:focus`
- `.sr-only` utility class present
- All interactive elements minimum 44×44px on touch devices
- ARIA labels and roles used on interactive widget elements

---

## 13. GAPS & MISSING ELEMENTS

### 13.1 Visual Assets — Missing

- **Social media templates:** Instagram post, carousel, story; Facebook cover; profile picture — not yet built (Group 3 — next in queue)
- **Dashboard thumbnails:** Placeholder images still live — need real product thumbnails
- **Shop product mockups:** No lifestyle hero, device mockup, or preview images for Garage Sale Planner, What's This Worth, Someday List Companion, New Grandma Planner
- **Product mockup format spec:** 4-image set per listing (lifestyle hero, device mockup, peek-inside preview, "what you get" summary graphic) — format defined but images not created

### 13.2 Design Tokens / Code — Missing

- **No CSS custom properties (variables)** — entire color system is hardcoded throughout style.css. A token layer is missing and would be a major maintainability upgrade.
- **No defined spacing scale** — spacing values exist in CSS but not as named tokens. No `--space-section`, `--space-card`, etc.
- **No dark mode system** — charcoal sections exist but there is no `prefers-color-scheme` media query or formal dark-mode spec.
- ~~Lavender web usage underspecified~~ — resolved 2026-07-27: Lavender is retired outright, no longer a gap to fill.
- ~~Soft Peach web usage underspecified~~ — resolved 2026-07-27: Soft Peach is retired outright; the logo accent bar role moved to Copper `#A15C3E`.

### 13.3 Typography — Missing

- **No line-height or letter-spacing values for print context** — web CSS defines these but the print type spec table does not.
- **No explicit weight number for Montserrat in print spec** — "Extra Bold" is named but 800 is only confirmed via web CSS.
- **No fallback font stack for Lora / DM Sans** — HTML tools load from Google Fonts with no CSS fallback for offline/slow-load states.

### 13.4 Components — Missing

- **Quiet House Meter widget:** Redesign flagged as a priority (visual gauge format, 4 questions) — current version is not the approved final design.
- **Email gate on Pick Your Mood Coloring Widget (Freebies page):** Built into dashboard but email capture not yet added to public version.
- **Dedicated downloads section on dashboard** — no section separates downloadable PDFs from interactive tools.
- **Blog content** — Blog card and post CSS are defined; zero posts written.
- **Stripe payment wiring** — Stripe Product Catalogue entries and payment links not yet generated for pipeline products.
- **Banned phrase in dashboard product card** — noted as a known live bug.

### 13.5 Brand Documentation — Missing

- **Product Copywriting Skill** — not built (next in queue)
- **Email / Blog Voice Skill** — not built (next in queue)
- **Pinterest strategy and templates** — not developed
- **Animation / motion spec** — animations exist in CSS but are not documented as named patterns with timing guidelines outside of code comments
- **Icon library** — icon color `#4B4B4B` is defined but no icon set or source is specified. No system for UI icons (arrows, close buttons, social icons) exists in brand docs.

### 13.6 Workbook 1 — Pending Edits

- Remove Life Coach certification reference from intro (pages 4–7)
- Fix brand name error in intro
- Fix "As solo moms, we…" language across multiple activities
- Remove outcome promises and assumptive statements throughout
- Revise all "What You Gained" sections
- Correct typos: "your ready," "INVISIBBLE," punctuation error, duplicate activity list entry

---

## APPENDIX A — Quick Reference Hex Codes

```css
/* Text / dark neutral */
--charcoal:      #262624;

/* Backgrounds and cards */
--page-bg:       #F6F3EC;
--clean-card:    #FEFCF8;   /* pair with a 0.5px hairline border */
--cozy-card:     #EFE8DC;

/* Buttons — two signature action colors */
--wine:          #7A2E42;   /* primary — emotional/connection CTAs */
--wine-hover:    #5E2233;
--copper:        #A15C3E;   /* secondary — product/functional CTAs */

/* Labels and icons */
--taupe:         #8C8272;   /* decorative labels only, AA-large — never buttons/bg/small text */
--warm-gray:     #6B655C;   /* icons, utility — full AA at any size */

/* Error and success */
--dark-orange:   #9E3D0F;   /* error — pair with icon/text, never color alone */
--moss:          #46703F;   /* success, and third tag color */

/* Tags — colored text only, no fill, no border. Use --wine, --copper, or --moss directly on text-color. */

/* Retired, do not use: --deep-rose #C44570, --periwinkle #8BA7D4, --lavender #C4B0E8,
   --soft-peach #F5C4A8, --rose-tint #F9ECF0, --peach-tint #FCF0E8, --peach-mid #EFA276,
   --warm-brown #6D4C3E, --tool-bg #FDFBF7, the entire Wine/Deep Rose Ramp, --powder-blue #A8C5DA,
   --peach #F2A57A, --lemon #EDD96A, --lime #B5CC6A, old --error-red #C0392B, old --success-green #1E7E34 */

/* Document elements (print/workbook only — unaffected by any web color revision) */
--icon-gray:     #4B4B4B;
--rule-line:     #D3D3D3;
--box-border:    #ABABAB;
--alt-rule:      #E0E0E0;

/* Text (print/PDF only) */
--text-title:    #0D0D0D;
--text-heading:  #333333;
--text-body:     #101010;
/* --text-mid #666666 and --text-light #999999 are retired for web use — use --charcoal or --warm-gray instead. Still fine in print/workbook context. */
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
Fonts loaded at build time from local files. Montserrat ExtraBold + Arial Regular only. Never loaded as a web font — print documents don't pull from Google Fonts.

---

*My Nest Chapter — Design System*
*Created by Cecilia Ann (Cece)*
*For Single & Solo Moms*
*DESIGN.md generated June 14, 2026 from full brand folder audit*
