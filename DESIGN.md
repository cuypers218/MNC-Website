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

> All previous palettes are retired. Only the colors below are in use as of May 2026.

### 2.1 Foundation Colors

| Name | Hex | Role |
|---|---|---|
| Velvety Charcoal | `#252535` | Primary dark — backgrounds, hero overlays, section fills |
| Vanilla Cream | `#FFF8EE` | Primary light — page backgrounds, card fills, high-contrast sections |

### 2.2 Confident Colors

| Name | Hex | Role |
|---|---|---|
| Vibrant Pink | `#E87AAA` | **Primary signature color** — CTAs, links, active states, brand highlights |
| Lavender | `#C4B0E8` | Accent — secondary buttons, outlines, decorative accents |
| Powder Blue | `#A8C5DA` | Accent — section backgrounds, illustration fills |
| Periwinkle | `#8BA7D4` | Accent — logo wordmark ("MY NEST"), footer brand label, tagline |

### 2.3 Warm Colors

| Name | Hex | Role |
|---|---|---|
| Peach | `#F2A57A` | Warm accent — secondary CTAs, warm illustration elements |
| Soft Peach | `#F5C4A8` | Warm accent — logo accent bar, soft highlight fills |
| Lemon | `#EDD96A` | Warm accent — decorative only |
| Lime | `#B5CC6A` | Warm accent — decorative only |

### 2.4 Workbook / Document Element Colors

| Name | Hex | Role |
|---|---|---|
| Icon Gray | `#4B4B4B` | Icons in workbook/PDF context |
| Text Lines | `#D3D3D3` | Ruled lines in workbook pages |
| Text Box Outline | `#ABABAB` | Box borders in workbooks and web |
| Alt Text Lines | `#E0E0E0` | Alternate ruled lines |

### 2.5 Text Colors

| Name | Hex | Role |
|---|---|---|
| Near-Black | `#0D0D0D` | Main titles in print/PDF |
| Dark Gray | `#333333` | Headings web + print |
| Body Near-Black | `#101010` | All body/paragraph text |
| Mid Gray | `#666666` | Category labels, metadata, captions |
| Light Gray | `#999999` | Footer copyright, disabled states |
| Disabled | `#ABABAB` | Borders, disabled button text |

### 2.6 Utility / State Colors

| Name | Hex | Role |
|---|---|---|
| Link Hover Pink | `#C45A84` | Vibrant Pink darkened — hover/active states |
| Error Red | `#C0392B` | Form errors |
| Error BG | `#FDEDEC` | Error message background |
| Success Green | `#1E7E34` | Form success |
| Success BG | `#E8F5E9` | Success message background |
| Page Gray | `#FAFAFA` | Default page background (not pure white) |
| Alt Section BG | `#E8EEF4` | Dusty blue-gray section variant |
| Input BG | `#FCFCFC` | Form input background |

### 2.7 Retired Colors — Never Use

Deep Berry `#811453`, all Berry shades, Soft Pink `#F8BBD0`, Warm Cream `#F4E8C1`, Warm Tan `#C8A982`, Warm Mauve `#BCAAA4`, Coral Orange `#FF6F61`, Teal `#00CACA`, Bright Yellow `#FFDD00`, Deep Plum `#6B3B50`, Light Peach `#F5D4B1`, Warm Gray `#B19D8D`, Soft Linen `#EAD3B7`, Dusty Rose `#D7A8A4`, old widget palette (Sage Gold, Peach Tan, Sage Gray, Blush Pink, Linen White, Muted Mauve), Gold `#FFD700`, Navy `#000080`, and all prior pink/blue shades.

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
- Hero tagline: Montserrat 800, 2.2rem, `#FFF8EE`, uppercase, `letter-spacing: 0.02em`, `line-height: 1.15`
- No italics in print context
- No decorative fonts
- Fragments allowed and encouraged when they "land harder"

---

## 4. LOGO SYSTEM

### 4.1 Wordmark — Locked (May 2026)

- **Stacked wordmark:** "MY NEST" in Periwinkle `#8BA7D4` | "Chapter" large in Vibrant Pink `#E87AAA` | Soft Peach `#F5C4A8` accent bar
- **Tagline version adds:** "FOR SINGLE & SOLO MOMS." in Periwinkle `#8BA7D4`

### 4.2 Favicon / Brand Mark — Option B (Locked)

- **Doorway icon** — slightly ajar door
- **Standalone:** Velvety Charcoal `#252535` door frame | Vibrant Pink `#E87AAA` doorknob | Soft Peach `#F5C4A8` light spill
- **Favicon:** Vanilla Cream `#FFF8EE` icon on Velvety Charcoal `#252535` background | Vibrant Pink doorknob
- Files: `mnc-logo-black.svg`, `MNC_Brand_Mark_Doorway.svg`, `MNC_Logo_Stacked_Wordmark.svg`, `MNC_Logo_Tagline.svg`, `MNC_Favicon.svg`

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
- Charcoal `#252535` base with Lora serif text in Vanilla Cream `#FFF8EE`
- Scene backgrounds with 55% opacity overlay
- `linear-gradient(to bottom, rgba(0,0,0,0.25) 0%, rgba(0,0,0,0.55) 100%)` text legibility overlay
- Story text in Lora 22pt; italic intro text at 16pt
- Brand tag: Montserrat 800, 9pt, Vibrant Pink `#E87AAA`, letter-spacing 3px

### 5.4 Design Rules — Hard Constraints

The CSS comment block at the top of the global stylesheet names these explicitly:

> **No border-radius. No shadows. No emojis.**

**Exception:** Buttons use `border-radius: 9999px` (pill shape) — this is the one confirmed radius in the system.

- No decorative box shadows on content elements
- No emoji in any brand material
- Sharp corners on all cards, inputs, and content blocks

### 5.5 Workbook / PDF Page Design

- Cover pages: brand colors, Montserrat titles, doorway motif
- **Content pages (non-cover):** neutral grays, off-whites, and black text ONLY — no brand colors on content pages
- Workbook interior: rule lines `#D3D3D3`, box borders `#ABABAB`, alt lines `#E0E0E0`, icon gray `#4B4B4B`
- Montserrat 800 for all headings; Arial Regular for all body text

---

## 6. COMPONENT PATTERNS

### 6.1 Buttons

| Variant | Background | Text | Border | Notes |
|---|---|---|---|---|
| `.btn-primary` | `#E87AAA` | `#FFFFFF` | none | Hover: `#C45A84` |
| `.btn-outline` | `#FFFFFF` | `#E87AAA` | 1px `#E87AAA` | Hover: `#FFF8EE` bg |
| `.btn-dark` | `#101010` | `#FFFFFF` | none | Hover: `#E87AAA` bg |
| `.btn-hero` | transparent | `#FFFFFF` | 2px rgba(255,255,255,0.7) | Glow pulse animation |
| Disabled | `#DDDDDD` | `#ABABAB` | none | `cursor: not-allowed` |

- All buttons: Montserrat 800, 0.85rem, uppercase, letter-spacing 1px
- Padding: `14px 32px` (standard), `14px 36px` (hero)
- Border-radius: `9999px` (pill — the only radius in the system)
- Active: `transform: translateY(1px)`
- Minimum touch target: 44×44px on mobile (`min-height: 44px`)

### 6.2 Cards

**Product Cards:**
- Background: `#FFFFFF`, border: `1px solid #ABABAB`, no radius, no shadow
- Hover: `transform: translateY(-4px)`, `transition: 0.3s ease`
- Image height: 220px, `object-fit: cover`
- Category label: Montserrat 800, 0.7rem, uppercase, letter-spacing 0.1em, `#666666`
- Title: Montserrat 800, 1.15rem, uppercase, `#333333`
- Description: Arial, 0.95rem, `#444444`
- CTA: full-width button, always at bottom
- Badges: positioned `top: 1rem; right: 1rem` — no radius, 1px border

**Locked card (dashboard):** border with 40% opacity, grayscale + opacity on image, gradient background.

**Blog Cards:**
- Same border/shadow system as product cards
- Image height: 180px
- Title: 1rem (smaller than product cards)
- Date: Montserrat 400, 0.75rem, `#666666`

### 6.3 Navigation

**Desktop header:**
- Sticky, white background, `border-bottom: 1px solid #ABABAB`
- Nav links: Montserrat 800, 0.8rem, uppercase, letter-spacing 1px, `#101010`
- Active/hover: `color: #E87AAA` + `border-bottom: 2px solid #E87AAA`
- Auth link: `#E87AAA` text

**Mobile nav:**
- Slide-in panel from right, 280px wide, `border-left: 1px solid #ABABAB`
- Hamburger: 24px width, 2px height bars, `#101010`
- Each link: `border-bottom: 1px solid #D3D3D3`
- Overlay: `rgba(0,0,0,0.3)` backdrop

### 6.4 Forms & Inputs

- Input border: `1px solid #ABABAB`, no radius
- Input background: `#FCFCFC`
- Focus: `border-color: #E87AAA`
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
- Active/hover: `color: #E87AAA` + `border-bottom: 2px solid #E87AAA`
- No background change on active
- Mobile: horizontal scroll, `flex-wrap: nowrap`

### 6.7 Toast Notifications

- Fixed top-center, Vibrant Pink `#E87AAA` background, white text
- Montserrat 800, 0.7rem, uppercase, letter-spacing 2px
- `border-bottom: 2px solid #C45A84`
- Fade in/out via opacity

### 6.8 Dashboard

- Section titles: Montserrat 800, 0.85rem, uppercase, letter-spacing 0.1em, `#666666`, `border-bottom: 1px solid #4B4B4B`
- Welcome: Montserrat 800, 1.5rem, uppercase, `#333333`

### 6.9 Footer

- White background, `border-top: 1px solid #ABABAB`
- Centered text layout
- Brand name: Montserrat 800, 0.9rem, uppercase, `#8BA7D4`, letter-spacing 2px
- Tagline below: Montserrat 400, 0.7rem, uppercase, letter-spacing 0.1em, `#666666`
- Nav links: 0.7rem, uppercase
- Copyright: Arial, 0.75rem, `#999999`

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
| `.section-cream` | `#FFF8EE` | `4rem 0` |
| `.section-warm` | `#FFF8EE` | `4rem 0` |
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

- Skip link implemented: `#E87AAA` bg, Montserrat 800, uppercase, appears on `:focus`
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
- **Warm accent web usage undefined** — Lemon `#EDD96A`, Lime `#B5CC6A`, Lavender `#C4B0E8`, Peach `#F2A57A` have no assigned CSS classes or documented web use cases beyond "decorative."
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
--cream:         #FFF8EE;

/* Confident */
--pink:          #E87AAA;   /* Primary signature */
--pink-hover:    #C45A84;
--lavender:      #C4B0E8;
--powder-blue:   #A8C5DA;
--periwinkle:    #8BA7D4;

/* Warm */
--peach:         #F2A57A;
--soft-peach:    #F5C4A8;
--lemon:         #EDD96A;
--lime:          #B5CC6A;

/* Document elements */
--icon-gray:     #4B4B4B;
--rule-line:     #D3D3D3;
--box-border:    #ABABAB;
--alt-rule:      #E0E0E0;

/* Text */
--text-title:    #0D0D0D;
--text-heading:  #333333;
--text-body:     #101010;
--text-mid:      #666666;
--text-light:    #999999;

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
