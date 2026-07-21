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

> **Locked July 5, 2026** (`MNC_Color_Reference_July2026.html`, source: `Skill_File_07-05-2026_v4.md`). This supersedes the May 2026 palette below site-wide — web, print, and interactive tools all draw from this same set now. Previously each context (site vs. widgets) had drifted onto separately-patched colors; as of this lock there is one palette for everything carrying the My Nest Chapter brand.

### 2.1 Foundation Colors

| Name | Hex | Role |
|---|---|---|
| Velvety Charcoal | `#252535` | Primary dark — backgrounds, hero overlays, section fills. Never more than 20–30% of any page. |
| Warm Antique White | `#FAF7ED` | Main page background — hero, all content sections. 70–80% of every page is this color. *(replaces Vanilla Cream `#FFF8EE`, retired)* |

### 2.2 Confident Colors

| Name | Hex | Role |
|---|---|---|
| Deep Rose | `#C44570` | **Primary signature color** — every CTA button, every hover state, active nav link, section-divider accent. Action only — never decorative. *(replaces Vibrant Pink `#E87AAA`, retired)* |
| Periwinkle | `#8BA7D4` | Logo "MY NEST," eyebrow labels above headings, section category labels, supporting text accents/captions/metadata. Never on buttons. Never as a background. |

**Retired as accents, 2026-07-16:** Lavender `#C4B0E8` and Soft Peach `#F5C4A8` are no longer used as accent/badge/divider colors. Cece's direction, confirmed against a live mockup: one committed color story (near-black + Deep Rose family) reads more confident and cohesive than mixing in extra accent hues. Anywhere Lavender or Soft Peach previously sat (badges, tags, dividers, callout accents) now pulls from the Deep Rose Ramp in §2.2b instead. Periwinkle stays — it's locked separately for eyebrow labels only and wasn't part of this change.

### 2.2b Deep Rose Ramp (added 2026-07-16)

One hue, light tint to near-black shade, used for icon backgrounds, secondary accents, depth, and all button hover states — replacing the old single hover-pink token and the retired Peach/Lavender accent roles above. Source: Cece's Coolors "Rose Wine" palette, reconciled with the brand's existing Deep Rose anchor and Rose Tint/Link Hover Pink tokens so nothing gets orphaned.

| Stop | Hex | Role |
|---|---|---|
| 50 | `#F9ECF0` | Lightest tint — card icon backgrounds, hover backgrounds on white cards, selected-item backgrounds *(same token as "Rose Tint" below — now the ramp's 50 stop)* |
| 100 | `#F3D8E1` | Light tint — secondary icon backgrounds, subtle section fills |
| 200 | `#E7B1C3` | Light-mid — badge/tag fills where a soft pink chip is needed |
| 300 | `#DA8BA5` | Mid-light — eyebrow/label text on dark backgrounds (replaces Periwinkle-on-dark in some contexts — use judgment, Periwinkle rule for eyebrow labels is unchanged elsewhere) |
| 400 | `#CE6487` | Mid — secondary CTAs, icon glyph color on light tint backgrounds |
| **500** | **`#C44570`** | **Deep Rose — the brand anchor, unchanged. Primary buttons, primary CTAs.** |
| 600 | `#A33359` | Button hover state (replaces "Link Hover Pink" below — now the ramp's 600 stop), darker icon glyphs |
| 700 | `#74253F` | Deeper hover/active state, icon glyphs needing more contrast on light tints |
| 800 | `#4E182A` | Dark accent text on light-pink fills, deep icon glyphs |
| 900 | `#270C15` | Near-black-pink, rarely used — deep shadow tints only |
| 950 | `#1B090F` | Darkest — paired with or in place of Velvety Charcoal for hero/dark sections wanting maximum confidence/contrast (Cece: "I love the black... black is one of my favorite colors") |

**How to use it:** pick two stops per screen max (e.g. a 50 or 100 for a fill, a 600 or 700 for the icon/text on top) — don't rainbow across the whole ramp on one screen. Velvety Charcoal `#252535` is still the default dark section color; stop 950 (`#1B090F`) is an alternate, moodier dark for screens that want to lean into the "confident/sexy" end (see §5.6b).

### 2.3 Warm Colors

**Retired 2026-07-16 — this entire section.** Soft Peach `#F5C4A8` is retired as an accent color; see §2.2 note above. Where warmth is still needed, it now comes from Warm Antique White (background) and the Deep Rose Ramp's light stops (§2.2b), not a separate peach hue.

**Judgment call, flagged (unchanged):** Lemon `#EDD96A` and Lime `#B5CC6A` (old role: decorative only) remain retired outright — the lock doc calls them "wrong emotional register." Remove decorative Lemon/Lime uses rather than substituting a color; if a genuine accent is still needed in that spot, use the Deep Rose Ramp (§2.2b).

### 2.3b Utility Colors (new — infrastructure only, not brand-facing)

| Name | Hex | Role |
|---|---|---|
| Rose Tint | `#F9ECF0` | Hover state background on cards, selected-item backgrounds, focused input field tint *(= Deep Rose Ramp 50, §2.2b)* |
| Warm Brown | `#6D4C3E` | Icons, small UI elements on light backgrounds |

**Retired 2026-07-16:** Peach Tint `#FCF0E8` and Peach Mid `#EFA276` are retired along with Soft Peach (§2.3). Product card fills, text box backgrounds, and input borders now pull from the Deep Rose Ramp (§2.2b) — typically stop 50 or 100 for fills, stop 300 or 400 for borders/outlines needing definition.

**Rule: no cool gray anywhere.** Any gray text/border/fill (`#666666`, `#999999`, `#6e6e6e`, `#ABABAB`-as-a-text-color, etc.) is a violation going forward — use Periwinkle for text, the utility tints above for fills/borders. The one exception is disabled-state UI affordance (grayed-out buttons/inputs to signal "not interactive") — that's a UI convention orthogonal to brand color, not a text/label choice, and is left alone pending an explicit call from Cece if she wants that changed too.

### 2.3c Special Use

| Name | Hex | Role |
|---|---|---|
| Tool Background | `#FDFBF7` | Interactive HTML tools only (Garage Sale Planner, trackers, widgets). Not a brand surface — not for site pages or product covers. |

### 2.4 Workbook / Document Element Colors

**Unchanged by the July 5, 2026 lock.** Per §5.5/§9.2 below, workbook *content pages* (non-cover) are deliberately brand-color-free — neutral grays, off-whites, black text only, for print legibility. The lock doc has no print/workbook section; these technical grays are a separate, intentional exception, not a "cool gray" violation.

| Name | Hex | Role |
|---|---|---|
| Icon Gray | `#4B4B4B` | Icons in workbook/PDF context |
| Text Lines | `#D3D3D3` | Ruled lines in workbook pages |
| Text Box Outline | `#ABABAB` | Box borders in workbooks and web |
| Alt Text Lines | `#E0E0E0` | Alternate ruled lines |

### 2.5 Text Colors

| Name | Hex | Role |
|---|---|---|
| Near-Black | `#0D0D0D` | Main titles in print/PDF, H1 on light web backgrounds |
| Dark Gray | `#333333` | Headings web + print, H2/H3 on light web backgrounds |
| Body Near-Black | `#101010` | All body/paragraph text |
| ~~Mid Gray~~ `#666666` | **Retired for web captions/labels/metadata** — replace with Periwinkle `#8BA7D4` per the "no cool gray anywhere" rule in §2.3b. Still fine for workbook/PDF print context (§2.4). |
| ~~Light Gray~~ `#999999` | **Retired for footer copyright text** — replace with Periwinkle `#8BA7D4`. |
| Disabled | `#ABABAB` | Borders, disabled button/input affordance — left as-is, a UI-state convention rather than a brand text color (see §2.3b note) |

### 2.6 Utility / State Colors

| Name | Hex | Role |
|---|---|---|
| Link Hover Pink | `#A33359` | Deep Rose, one shade darker — hover/active states *(= Deep Rose Ramp 600, §2.2b; matches the "Sweet Peony" hover/active step already established in the Garage Sale Planner widget — see CLAUDE.md 2026-07-06)* |
| Error Red | `#C0392B` | Form errors |
| Error BG | `#FDEDEC` | Error message background |
| Success Green | `#1E7E34` | Form success |
| Success BG | `#E8F5E9` | Success message background |
| Page Gray | `#FAFAFA` | Default page background (not pure white) |
| Alt Section BG | `#E8EEF4` | Dusty blue-gray section variant — **flagged, not replaced**: this predates the lock and isn't in the approved list; needs a call from Cece on whether to retire it in favor of Warm Antique White or keep it as a distinct "alt section" fill |
| Input BG | `#FCFCFC` | Form input background — **flagged**: close to but not identical to the lock's Peach Tint `#FCF0E8`; recommend switching to Peach Tint for consistency, not yet applied without confirmation |

### 2.7 Retired Colors — Never Use

**Newly retired July 5, 2026:** Vibrant Pink `#E87AAA`, Vanilla Cream `#FFF8EE`, Powder Blue `#A8C5DA`, Peach `#F2A57A`, Lemon `#EDD96A`, Lime `#B5CC6A`, cool gray as a text/label/caption color (`#666666`, `#999999`, `#6e6e6e` and similar — disabled-state UI gray excepted, see §2.5).

**Retired previously:** Deep Berry `#811453`, all Berry shades, Soft Pink `#F8BBD0`, Warm Cream `#F4E8C1`, Warm Tan `#C8A982`, Warm Mauve `#BCAAA4`, Coral Orange `#FF6F61`, Teal `#00CACA`, Bright Yellow `#FFDD00`, Deep Plum `#6B3B50`, Light Peach `#F5D4B1`, Warm Gray `#B19D8D`, Soft Linen `#EAD3B7`, Dusty Rose `#D7A8A4`, old widget palette (Sage Gold, Peach Tan, Sage Gray, Blush Pink, Linen White, Muted Mauve), Gold `#FFD700`, Navy `#000080`, and all prior pink/blue shades.

---

## 3. TYPOGRAPHY

### 3.1 Print / PDF / Workbook Context

| Element | Font | Weight | Size | Color |
|---|---|---|---|---|
| Main Title | Montserrat | Extra Bold (800) | 16pt | `#0D0D0D` |
| Heading | Montserrat | Extra Bold (800) | 14pt | `#333333` |
| Subheading | Montserrat | Extra Bold (800) | 13pt | `#333333` |
| Body / Paragraph | Arial | Regular (400) | 12pt | `#101010` |

**Font rule:** Montserrat Extra Bold handles ALL display text. Arial Regular handles all body/paragraph text. No other fonts — ever.

### 3.2 Web Context (site CSS)

| Element | Font | Weight | Size | Notes |
|---|---|---|---|---|
| h1 | Montserrat | 800 | 1.75rem | Uppercase, letter-spacing 0.02em |
| h2 | Montserrat | 800 | 1.25rem | Uppercase |
| h3 | Montserrat | 800 | 1rem | Uppercase |
| h4 | Montserrat | 800 | — | Uppercase |
| Body | Arial | 400 | 16px | line-height 1.6 |
| Nav links | Montserrat | 800 | 0.8rem | Uppercase, letter-spacing 1px |
| Buttons | Montserrat | 800 | 0.85rem | Uppercase, letter-spacing 1px |
| Labels / Categories | Montserrat | 800 | 0.65–0.75rem | Uppercase, letter-spacing 0.05–0.1em |

**Web font stack:** `'Montserrat', sans-serif` and `'Arial', sans-serif`

### 3.3 Interactive HTML Tools Context

| Element | Font | Weight | Notes |
|---|---|---|---|
| Display / Story text | Lora | 400 / 600 / italic | Serif — emotional, narrative moments |
| Body / UI | DM Sans | — | Clean, readable for interactive UI |
| Brand tag / labels | Montserrat | 800 | Uppercase, letter-spacing 3px |

**Rule:** Lora + DM Sans are for interactive HTML tools only. They do not replace the print/web typography system.

### 3.4 Type Treatment Rules

- All headings and nav elements: `text-transform: uppercase`
- Hero tagline: Montserrat 800, 2.2rem, `#FAF7ED`, uppercase, `letter-spacing: 0.02em`, `line-height: 1.15`
- No italics in print context
- No decorative fonts
- Fragments allowed and encouraged when they "land harder"

---

## 4. LOGO SYSTEM

### 4.1 Wordmark — Locked (May 2026), colors updated to July 5, 2026 lock

- **Stacked wordmark:** "MY NEST" in Periwinkle `#8BA7D4` | "Chapter" large in Deep Rose `#C44570` | Soft Peach `#F5C4A8` accent bar
- **Tagline version adds:** "FOR SINGLE & SOLO MOMS." in Periwinkle `#8BA7D4`

### 4.2 Favicon / Brand Mark — Option B (Locked), colors updated to July 5, 2026 lock

- **Doorway icon** — slightly ajar door
- **Standalone:** Velvety Charcoal `#252535` door frame | Deep Rose `#C44570` doorknob | Soft Peach `#F5C4A8` light spill
- **Favicon:** Warm Antique White `#FAF7ED` icon on Velvety Charcoal `#252535` background | Deep Rose doorknob
- Files: `mnc-logo-black.svg`, `MNC_Brand_Mark_Doorway.svg`, `MNC_Logo_Stacked_Wordmark.svg`, `MNC_Logo_Tagline.svg`, `MNC_Favicon.svg`

**Not yet done:** these are Canva-exported SVG assets living outside this repo (not found under `MNC-Website/`) — this doc update is text-only. The actual asset files still need to be re-exported from Canva with the new colors before the favicon/logo files themselves match this spec.

### 4.3 Usage Rules

- Web brand mark in header: Montserrat 800, `#8BA7D4`, uppercase, `letter-spacing: 2px`, 1.1rem
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

- Velvety Charcoal `#252535` background with photo overlay
- `linear-gradient(to bottom, rgba(37,37,53,0.55) 0%, rgba(37,37,53,0.75) 100%)` overlay on hero images
- Photo opacity ~0.55 where text sits above it

### 5.3 Widget / Interactive Tool Aesthetic

- Full-screen or large viewport experiences
- Charcoal `#252535` base with Lora serif text in Warm Antique White `#FAF7ED`
- Scene backgrounds with 55% opacity overlay
- `linear-gradient(to bottom, rgba(0,0,0,0.25) 0%, rgba(0,0,0,0.55) 100%)` text legibility overlay
- Story text in Lora 22pt; italic intro text at 16pt
- Brand tag: Montserrat 800, 9pt, Deep Rose `#C44570`, letter-spacing 3px

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
- **Confidence/boldness** lives in one committed dark moment per screen — a near-black (`#1B090F`, Deep Rose Ramp 950, or Velvety Charcoal `#252535`) section with a single decisive Deep Rose accent (e.g. a circular progress ring), not scattered small accents. Restraint is what makes it read confident rather than loud.
- **Warmth/nurturing** lives in everything surrounding that moment — Warm Antique White space, soft-shadow white cards (§5.4), rounded icon circles pulling from the Deep Rose Ramp's light stops, encouraging first-person-adjacent copy ("Pick up where you left off," not "Dashboard").
- Apply this zone split to every new screen: pick one moment to be bold and dark, let the rest be soft and warm. Don't spread boldness evenly (reads busy) or softness evenly (reads flat/timid).

---

## 6. COMPONENT PATTERNS

### 6.1 Buttons

Each button variant has its own distinct hover color — never one shared hover color across all variants — and as of 2026-07-16, every hover/active stop is drawn from the Deep Rose Ramp (§2.2b) so all hovers read as one cohesive color family instead of unrelated one-off shades.

| Variant | Background | Text | Border | Hover | Active |
|---|---|---|---|---|---|
| `.btn-primary` | `#C44570` (Ramp 500) | `#FFFFFF` | none | `#A33359` (Ramp 600) | `#74253F` (Ramp 700) |
| `.btn-outline` | `#FFFFFF` | `#C44570` (Ramp 500) | 1px `#C44570` | `#F9ECF0` bg (Ramp 50) | `#F3D8E1` bg (Ramp 100) |
| `.btn-dark` | `#101010` | `#FFFFFF` | none | `#C44570` bg (Ramp 500) | `#A33359` bg (Ramp 600) |
| `.btn-hero` | transparent | `#FFFFFF` | 2px rgba(255,255,255,0.7) | Glow pulse animation (unchanged) | — |
| Disabled | `#DDDDDD` | `#ABABAB` | none | — | `cursor: not-allowed` |

- All buttons: Montserrat 800, 0.85rem, uppercase, letter-spacing 1px
- Padding: `14px 32px` (standard), `14px 36px` (hero)
- Border-radius: `6px` (per the corrected §5.4 standard — pill/`9999px` is now reserved for tags/badges, not buttons)
- Active: `transform: translateY(1px)` on tap/click, combined with the active-state color above — should feel like a visible press, not just a color shift
- Minimum touch target: 44×44px on mobile (`min-height: 44px`)

### 6.2 Cards

**Product Cards:**
- Background: `#FFFFFF`, border-radius `8–10px` (per §5.4), border removed in favor of the standard soft shadow (`0 10px 40px rgba(37,37,53,0.07)`) — border only if a card needs a hard edge for contrast against a similar-colored background
- Hover: `transform: translateY(-4px)`, `transition: 0.3s ease`
- Image height: 220px, `object-fit: cover`, top corners inherit the card's radius (clip to match)
- Category label: Montserrat 800, 0.7rem, uppercase, letter-spacing 0.1em, `#8BA7D4` (Periwinkle — was `#666666`)
- Title: Montserrat 800, 1.15rem, uppercase, `#333333`
- Description: Arial, 0.95rem, `#444444`
- CTA: full-width button, always at bottom
- Badges: positioned `top: 1rem; right: 1rem` — pill radius (`9999px`), 1px border

**Locked card (dashboard):** border with 40% opacity, grayscale + opacity on image, gradient background.

**Blog Cards:**
- Same border/shadow system as product cards
- Image height: 180px
- Title: 1rem (smaller than product cards)
- Date: Montserrat 400, 0.75rem, `#8BA7D4` (Periwinkle — was `#666666`)

### 6.3 Navigation

**Desktop header:**
- Sticky, white background, `border-bottom: 1px solid #ABABAB`
- Nav links: Montserrat 800, 0.8rem, uppercase, letter-spacing 1px, `#101010`
- Active/hover: `color: #C44570` + `border-bottom: 2px solid #C44570`
- Auth link: `#C44570` text

**Mobile nav:**
- Slide-in panel from right, 280px wide, `border-left: 1px solid #ABABAB`
- Hamburger: 24px width, 2px height bars, `#101010`
- Each link: `border-bottom: 1px solid #D3D3D3`
- Overlay: `rgba(0,0,0,0.3)` backdrop

### 6.4 Forms & Inputs

- Input border: `1px solid #ABABAB`, no radius
- Input background: `#FCFCFC`
- Focus: `border-color: #C44570`
- Placeholder: `#BCBCBC`
- Labels: Montserrat 800, 0.75rem, uppercase, letter-spacing 0.05em, `#333333`
- Error state: `1px solid #C0392B`, red `#C0392B` text, `#FDEDEC` background
- Success state: `1px solid #1E7E34`, green text, `#E8F5E9` background
- Form max-width: 420px centered

### 6.5 Email Capture

- Background `#FFFFFF`, border `1px solid #ABABAB`, no radius
- Padding 2.5rem, centered text
- Inline form: input + button, no gap (flush joined)
- Input border-right removed to join with button
- Mobile: stacks to full-width column

### 6.6 Filter Tabs

- Montserrat 800, 0.8rem, uppercase
- Active/hover: `color: #C44570` + `border-bottom: 2px solid #C44570`
- No background change on active
- Mobile: horizontal scroll, `flex-wrap: nowrap`

### 6.7 Toast Notifications

- Fixed top-center, Deep Rose `#C44570` background, white text
- Montserrat 800, 0.7rem, uppercase, letter-spacing 2px
- `border-bottom: 2px solid #A33359`
- Fade in/out via opacity

### 6.8 Dashboard

- Section titles: Montserrat 800, 0.85rem, uppercase, letter-spacing 0.1em, `#8BA7D4` (Periwinkle — was `#666666`), `border-bottom: 1px solid #4B4B4B`
- Welcome: Montserrat 800, 1.5rem, uppercase, `#333333`

### 6.9 Footer

- White background, `border-top: 1px solid #ABABAB`
- Centered text layout
- Brand name: Montserrat 800, 0.9rem, uppercase, `#8BA7D4`, letter-spacing 2px
- Tagline below: Montserrat 400, 0.7rem, uppercase, letter-spacing 0.1em, `#8BA7D4` (Periwinkle — was `#666666`)
- Nav links: 0.7rem, uppercase
- Copyright: Arial, 0.75rem, `#8BA7D4` (Periwinkle — was `#999999`)

### 6.10 Animations

```css
@keyframes heroGlow {
  0%, 100% { box-shadow: 0 0 0 0 rgba(232,122,170,0); }
  50%       { box-shadow: 0 0 22px 6px rgba(232,122,170,0.55); }
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
| `.section-cream` | `#FAF7ED` | `4rem 0` |
| `.section-warm` | `#FAF7ED` | `4rem 0` |
| `.section-charcoal` | `#252535` | `4rem 0` |
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

- Skip link implemented: `#C44570` bg, Montserrat 800, uppercase, appears on `:focus`
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
- **Lavender `#C4B0E8` web usage underspecified** — no assigned CSS classes yet beyond "decorative." (Lemon/Lime/Peach, previously flagged here too, are now retired outright per the July 5, 2026 lock — no longer a gap to fill.)
- **Soft Peach `#F5C4A8`** — defined in brand spec as logo accent bar but not referenced in site CSS; web usage underspecified.

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
/* Foundation */
--charcoal:      #252535;
--warm-white:    #FAF7ED;   /* was --cream, #FFF8EE */

/* Confident */
--deep-rose:     #C44570;   /* Primary signature — was --pink, #E87AAA */
--deep-rose-hover: #A33359; /* was --pink-hover, #C45A84 */
--periwinkle:    #8BA7D4;   /* text accent role only now — never buttons/bg */
--lavender:      #C4B0E8;

/* Warm */
--soft-peach:    #F5C4A8;

/* Utility (new, infrastructure only) */
--rose-tint:     #F9ECF0;
--peach-tint:    #FCF0E8;
--peach-mid:     #EFA276;
--warm-brown:    #6D4C3E;

/* Special use */
--tool-bg:       #FDFBF7;   /* interactive HTML tools only, not site pages */

/* Retired, do not use: --powder-blue #A8C5DA, --peach #F2A57A, --lemon #EDD96A, --lime #B5CC6A */

/* Document elements (print/workbook only — unaffected by the July 5 lock) */
--icon-gray:     #4B4B4B;
--rule-line:     #D3D3D3;
--box-border:    #ABABAB;
--alt-rule:      #E0E0E0;

/* Text */
--text-title:    #0D0D0D;
--text-heading:  #333333;
--text-body:     #101010;
/* --text-mid #666666 and --text-light #999999 are retired for web use — use --periwinkle instead. Still fine in print/workbook context. */

/* UI / States */
--page-bg:       #FAFAFA;
--input-bg:      #FCFCFC;
--error:         #C0392B;
--success:       #1E7E34;
--disabled:      #DDDDDD;
```

---

## APPENDIX B — Font Loading

**Web (site):**
```html
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&display=swap" rel="stylesheet">
```

**Interactive HTML tools:**
```html
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;800&family=Lora:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
<!-- Add &family=DM+Sans to the query if DM Sans is needed -->
```

**Print / Workbook / PDF:**
Fonts loaded at build time from local files. Montserrat ExtraBold + Arial Regular only.

---

*My Nest Chapter — Design System*
*Created by Cecilia Ann (Cece)*
*For Single & Solo Moms*
*DESIGN.md generated June 14, 2026 from full brand folder audit*
