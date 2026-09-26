# Handoff: "Chapter One" homepage mockup → real homepage

**From:** Cece + design session (2026-09-23) · **To:** the code agent that builds `site/index.php`
**Read this first, then open `index.html` in this folder in a browser.** Nothing here has been committed, pushed, or deployed.

## The goal
Turn a visitor (a single empty-nest mom, 40+, any stage) into a **free Hub member**, then a **paying customer** inside the Hub. The Hub is free to join; purchases happen inside it (Shop: Garage Sale Planner $27, Cooking for One Planner $27, Now What? Workbook $14.99). Cece confirmed this on 2026-09-23. No paid membership tier.

## The concept (Cece chose this, and loves it)
The homepage is **the first chapter of a book**. The Hub is the book's **table of contents**.
- Two-page spread on a Deep Current "book cloth" background, cream paper pages with page-edge stacks.
- A copper **ribbon bookmark** ("Join the Hub / It's free") is fixed top-right and follows the scroll. It is the one persistent Join button on desktop (hidden under 1000px; the nav "Join free" button takes over).
- Each spread swings in like a turned page on scroll. Hero pages open on load.
- **Contents page = the Hub**: Reflections, Meaningful Days, Support Circle, Freebies, Shop. Tapping an entry opens a small sample (one open at a time).
- **Social proof** is pencil notes in the margins, a "from the margins" quotes page, and a library **"Date due" slip** ending with "You." and the Join button.
- Products sit on a shelf with Marigold price tags.
- An earlier **envelope** version is in `../hub-homepage/` for comparison only. Cece chose the book.

## Cece's feedback so far
1. "I love this so much… totally what I have wanted."
2. **"Still too much going on."** She wants it calmer. She has NOT yet said which things to cut. See "Suggested trims" below and **ask her before cutting**.
3. **Hero picture decision: the MEMBER CARD.** Cece chose it (idea #5: a library/Sam's Club/bank-style card slipped into a book pocket, on a book endpaper). Reasoning she gave: women relate to getting a card for the library, warehouse club, discounts or their bank, and it fits the chapter idea best. It is the default in the mock and is a link to the Join page. The mock also has a temporary switcher (yellow bar, bottom-left) with the alternatives she saw: My photo, Quiet kitchen, Empty chair, Drawn nest, Open journal. Remove the switcher (`.sw` markup, CSS, and the "MOCKUP ONLY" JS block) before real use.
4. "Some things need tweaking." She hasn't listed them yet.

## The card (hero)
Built in HTML/CSS (`.scene`, `.card`, `.pocket` in `index.html`), sized in `cqw` so it scales as one object. It slides up out of the pocket after the book opens, lifts on hover to show the barcode strip and number, and the "Your name here" line writes itself in. The "Free" seal is Marigold. "No. 0001" and the barcode are decoration, not real member numbers. **Open idea for the real build:** show the member's real first name on the card after they join.

## Suggested trims (my ideas, NOT decided; all need Cece's yes)
- Fold the "Explore / Belong / Read" page into the Hub spread or drop it as its own page.
- Keep only 1 or 2 pencil margin notes instead of one per spread.
- Remove the page-corner curl and the marigold highlighter on most headings (keep one).
- Merge "A note from Cece" (email) into the final spread so there are fewer spreads.
- Keep the ribbon, the contents page, and the date-due slip. Those carry the concept and the conversion.

## Everything below is FAKE and must be replaced or removed before launch
`PRODUCT.md` says there are **no testimonials on hand. Do not fabricate any.** The mock invents them only to show layout; a yellow "MOCKUP" bar at the top says so. Before launch:
- Names, quotes, cities, ages: Denise/Marcy/Linda, the pencil notes ("Same. Every Tuesday. — D., Ohio", "Same. That was me in August. — Linda, Arizona"), and the "From the margins" page.
- "1,240 women already have a Hub." and the date-due slip's names and dates.
- The Hub samples (journal entry, Meaningful Days dates, Support Circle messages, tick list) are **drawings, not screenshots**. Verify they match what the Hub really shows; the Hub is a separate repo at `C:\Users\cuype\my-nest-hub`.
- The Hub page numbers (3, 5, 7, 9, 11) and the book page numbers are decoration.
- If real testimonials don't exist yet, drop the margins/quotes/slip content or ship them empty-state style. Do not ship the placeholders.

## Real content (kept from the live homepage, verify against `site/index.php`)
Hero headline and subline, Cece's story, Explore/Belong/Read copy, Hub pitch ("Your journal, your freebies, your shop — one place to check in…"), product names/prices/descriptions, monthly-email copy, "Instant access. No waiting." New small connective copy I wrote (Cece should approve): "Cece here. I'm a single empty-nest mom too…", "Pull up a chair.", "The quiet hour.", "Start on page one.", "Ex libris — a place for you.", "Stay a minute." (the last is from the old hook line), "Yours could be next." was removed in the book version.

## Wiring the buttons (the mock links are all `#`)
Follow `CLAUDE.md`'s 2026-09-22 rules:
- Join / Log in / freebie CTAs → `/start-here` (the front door explaining the Hub). Buy buttons → straight to the Hub via `hubBuyUrl()`.
- Quiz links → the existing quiz modal (`openQuizModal()` and `/widgets/empty-nester-quiz/`) or `/nester-quiz`.
- Newsletter form → the existing `submitToReach()` in `index.php` (`/reach-subscribe.php`, segment `b236abad-55a2-45a7-a0f1-9c4bfa003c77`). The mock only fakes "Check your inbox."
- Real nav from `includes/header.php`; the mock's nav is a simplified copy.

## Design tokens used
- **Palette (Cece's real 14):** Deep Current `#0A2F3A`, Burnished Copper `#A35E33`, Golden Honey `#C8A878`, Vanilla Cream `#F6F1E6`, Deep Coffee `#2B1F18`, Oceanic Teal `#1D6B78`, Golden Drift `#D8975A`, Smoky Sienna `#5A4839`, Soft Sand `#F1D9B3`, Warm Beige `#E6D6C2`, Caramel Brown `#8B5E3C`, Mocha Brown `#5E3E2B`. Buttons: copper with **white** text (cream text fails AA).
- **ONE NEW COLOR, not yet approved:** Marigold Sticker `#F2B63D`, used for the highlighter, price tags and the mock bar. Cece said a new color was OK for the mock; confirm before it enters `DESIGN.md`.
- **Fonts (a deliberate break from Lora/DM Sans/Playfair; Cece said the old design rules don't apply to this mock except the palette):** Young Serif (titles), Source Serif 4 (reading text), Atkinson Hyperlegible Next (UI), Homemade Apple (handwriting only). All from Google Fonts. Body text is 19px on purpose (audience is 40+).
- The mock's radius/shadow values are close to the site standard but not identical. Decide with Cece whether this becomes the new standard.

## Things the repo will complain about (expected)
- `.github/workflows/mnc-qa.yml` flags fonts and hex not in the old list (it's `continue-on-error`, so it won't block).
- `DESIGN.md` and `CLAUDE.md` conflict with this design on purpose (fonts, no eyebrow/kicker rule, etc.). After Cece approves, **update DESIGN.md** rather than forcing the build back to the old rules.
- `CLAUDE.md` Gate 2: a design plan needs Cece's literal word "approved" before build.
- **Pushing to `main` deploys live over FTP with no staging.** Build on a branch or a separate file, and don't push until Cece approves.

## Build notes and gotchas
- The `.rv`/`.page` scroll-reveal must be tested **for real** (scroll it). An early bug (CSS specificity) left every spread below the hero invisible. It is fixed, but keep the `.js .spread:not(.hero).in .page…` rule ahead of the hidden state.
- Everything respects `prefers-reduced-motion` (no page turns, no ribbon drop; content just shows).
- The hero ribbon is `position: fixed` at `top: 107px` (mock bar + nav). If the mock bar is removed, change it to `72px`. Under 1000px it is hidden.
- The logo in the mock is a text wordmark plus a small drawn nest. `assets/images/logo.png` is the retired pink logo. Don't use it.
- Images live in `img/`: `cece-portrait.jpg` (from `Downloads/cece-photo-with-bg.png`), `cece-writing.jpg`, `kitchen-6pm.jpg`, `garage.jpg`, `workbook.jpg`, `cooking.jpg`. Every image shows no people except Cece. The live site references `/assets/images/cece-photo-2026.png`, which is not in the local repo. Confirm the right file. Live Cooking for One cover is `.png`, not `.jpg`.
- The Cooking for One cover has its title baked in (Cece has said before that text-on-image duplicates the card title). Consider a photo cover per her 2026-09-20 house-style note.
- Detector notes: em-dash and short-sentence cadence flags are mostly Cece's own copy; left as is.

## Files
- `index.html`: the whole mock (HTML + CSS + JS in one file)
- `img/`: the six images above
- `../hub-homepage/index.html`: the earlier envelope version (reference)
- `.impeccable/review/`: screenshots from checking the mock (desktop and mobile)
