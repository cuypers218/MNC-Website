# The Middle Chapters: homepage mockup (2026-09-26)

**Nothing here is committed, pushed, or deployed.** Open `index.html` in a browser. Left/right arrow keys turn the page too.

## The idea (Cece's, 2026-09-26)
- The homepage is an open book. She turns the page: Home, About, Blog, Tools, The Hub.
- The middle of the book is hers. Chapters are open-ended and are not a page or a menu item (removed 2026-09-26).
- Products are tools she picks up. Each one is framed by what it does for a chapter, not as a chapter itself.
- **The Hub is the member card.** It opens every freebie, every product, and whatever comes next.
- She does not want anything about "the end."

## What changed from `../hub-homepage-chapter/`
Kept: the open-book pages (page edges, center fold, corner curl), the member card in the library pocket, fonts, palette.
Removed to make it calmer: pencil margin notes, ribbon bookmark, date-due slip, "From the margins" quotes, marigold color, running heads, page numbers, the picture switcher.
No invented names, quotes, or member counts remain. The card's "Your name here" and "No. 0001" are decoration.

## Page turn (2026-09-26)
One motion for every turn, forward or back: the right page lifts, swings over the fold to the left, and lands as the next left page (1.3s, one easing). Rapid clicks finish the current turn first. Phones and reduced-motion get a plain swap with no flip. Built in the script at the bottom of index.html (`flip()`), using clones of the pages for the 3D leaf.

## About = Cece's story (2026-09-26)
- About and Cece's story are ONE thing. One spread, one menu item. Left page: the handwritten "Hey. I see you…" line, a small album photo ("Still writing.") that the words wrap around, and "I'm Cece." through "So I started building what I wished had existed." Right page: "What this is not," "Where I am now," the closing line, and the Get your card button. Real words from site/about.php.
- Cut at Cece's request: the "What My Nest Chapter is" section (full long version saved in story-long-version.md). Also no longer on the page: the big sentence "I raised my kids mostly on my own…" and the "There will be glitches… Tell me when you find one." lines (still on the live Home page).
- If more pages are ever needed, they should sit under the same About menu item.
- Heads-up: the live copy says "you're not broken", close to the banned phrase "I wasn't broken". Cece's call.

## Home page critique fixes (2026-09-26)
- One line says what the Hub is ("Your card opens the Hub: free tools, a journal, and other women in the middle chapters."). New copy, needs approval.
- Card is larger with readable labels (12px+); on phones a wide crop of the card is the first thing on screen.
- Small round portrait of Cece beside "Cece here." (img/cece-portrait.jpg, from Downloads/cece-photo-with-bg.png; swap if Cece has a newer headshot). A steaming cup sits by the caption.
- The curled page corner is now a real turn-the-page button (mouse only; keyboard uses the Turn the page link).
- Browser tab title now changes per page.

## Hub facts corrected (2026-09-26)
The Hub's Support Circle is a personal list of people she leans on (name, relationship, how they help). It is NOT a group of other members. The mockup had said "other women to talk to"; that was wrong and is fixed. Hub wording now follows the real Start Here page: Reflections (a private journal, just for you), Meaningful Days (a record of what actually matters), Support Circle (the people you lean on, in one place). If a real member community is ever built, the wording can change then.

## Handwriting font (2026-09-26)
Cece chose **Nothing You Could Do** with a thin outline (`-webkit-text-stroke:.9px`) to look bolder. It is used only for short lines: card captions, the About epigraph, and the — Cece signature. The font file is hosted with the page (`fonts/nothing-you-could-do.woff2`); the outline is added only after the font has actually loaded (class `hand-ready`), so a fallback font never gets the outline. Replaces Homemade Apple. For the real build, self-host the other fonts too.

## Typewriter font (2026-09-26)
Courier Prime (Google Fonts) on the member card only: HUB MEMBER, the typed name line, and the card number. The name types itself in letter by letter. Titles, body text and handwriting are unchanged. Not yet approved for DESIGN.md.

## Café pieces (2026-09-26)
- Tools page is a menu: "On the house." (six freebies, dotted leader to "free") and "To take home." (three paid tools with prices). A small coffee cup drawing and a faint coffee-ring stain are the only decoration.
- The card has two typed fields: Member and Chapter ("Yours to write"). In the real build both should fill in from the member: her first name, and the chapter she chooses.
- "— Cece" handwritten signature on the About page.
- Still open: a real screenshot of the inside of the Hub (needs a real member view), and Cece's call on optional chapter stamps on the back of the card.

## Menu (2026-09-26)
Home, About, Blog, Tools (was "Resources"), and one "The Hub" button, in that order. The old Home/Shop/Freebies/Log In/Join free items are gone. Tools has two halves: free (all open with the Hub card) and paid (all lead to the Hub). Log In and Join both go to the same front door (/start-here in the real build), so one button covers both.

The Blog page is a placeholder: no post titles are invented, so it shows the real "Read" copy and a button to the real blog.

## New copy that needs Cece's approval
"The first chapters are written. This is the middle of the book, and every chapter in it is yours to write." / "Every chapter is yours to write." / "Pick up what helps. Put down what doesn't." / "Only you know what's next. I'll have tools ready when you do." / "The Hub opens everything." / "Whatever chapter you're in, it's in here. So is the next one." / the three product "for" lines / the example chapter names.
Kept from the live site: the tagline, Cece's story, product names/prices, monthly-email copy.
The old hero line "Tools. A real person to talk to. A growing community that gets it." is not on this mock. Decide where, or whether, it goes.

## For a real build
- Each page should be its own real URL (About, Shop, Hub), with the page turn as the transition. That keeps the back button, Google, and shared links working. This mock swaps pages inside one file.
- Join/Log in/freebie links go to `/start-here`. Buy links go straight to the Hub. Newsletter uses the existing `submitToReach()`.
- Cooking for One's cover has its title baked in; consider a photo cover per the 2026-09-20 house-style note.
- Pushing to `main` deploys live with no staging. DESIGN.md and PRODUCT.md still describe the old direction ("ongoing life stage") and need updating only after Cece says "approved."
- The Habit Tracker and Someday List Companion are intentionally not shown (back-burner / price unset).
