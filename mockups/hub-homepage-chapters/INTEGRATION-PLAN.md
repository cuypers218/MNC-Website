# Plan: bringing the book design into the real website

Written 2026-09-26 for Cece. Nothing in this plan has been built, committed, or deployed. The live site is untouched.
Per CLAUDE.md Gate 2, nothing gets built into the real site until Cece says the word "approved."

## 1. The goal
The real mynestchapter.com becomes the open-book website from the mockup: Home, About (Cece's story), Blog, Tools, and the Hub card. It keeps everything that works today: the blog, the products, the newsletter, the quiz, payments through the Hub, and every link that Google and other sites already know.

## 2. What the real site is made of (checked today)
- A PHP site with one shared header (`site/includes/header.php`), one shared footer, and one shared stylesheet (`site/assets/css/style.css`, 54KB) used by nearly every page.
- Pages: home (`index.php`), about, blog (reads the database), blog posts (database, comments), shop and product pages (database), resources, freebies, workbook, coloring, connect, start-here, nester-quiz, 404. Login, register, dashboard and checkout only redirect to the Hub.
- Two pages, `start-here.php` and `connect.php`, carry their own copy of the header instead of using the shared one.
- Fonts today: Lora and DM Sans. The mockup uses Young Serif, Source Serif 4, Atkinson Hyperlegible Next, Courier Prime and Nothing You Could Do. The colors are the same palette.
- Every push to the `main` branch goes live on Hostinger within minutes, with no preview step. This is the single biggest risk in the whole project.
- PHP 8.4 is installed on this computer, so pages that do not need the database can be previewed locally. Blog and shop pages need the database, which lives on Hostinger.

## 3. The approach (recommended)
**Real pages with the page turn on top.** Each book page is its own real page with its own web address, just like today. The page-turn animation is added on top: when a visitor clicks to the next page, the site fetches it, flips the page, and updates the address. If anything fails, or JavaScript is off, the link simply opens the page normally.

Why not build it as one big page like the mockup? Google would see one page instead of many, the blog and shop could not load their data, and the Back button would break. The mockup is a single file only because it is a sketch.

## 4. Page by page
| Book page | Real address | Built from | Notes |
|---|---|---|---|
| Home | `/` | `index.php` | Card, headline, the "what the Hub is" line, newsletter strip. Remove the placeholder quotes section. |
| About | `/about` | `about.php` | Cece's story, exactly the shortened wording from the mockup. Long version stays in `story-long-version.md`. |
| Blog | `/blog`, `/blog/{post}` | `blog.php`, `blog-post.php` (database) | Keep categories and comments. New book styling for the list and for reading a post. |
| Tools | `/tools` (new) | products and freebies from the database | Menu layout: "On the house" and "To take home." The old `/shop`, `/resources` and `/freebies` become permanent redirects to `/tools`. Buy buttons keep using `hubBuyUrl()`. |
| The Hub | `/start-here` | `start-here.php` | The card page. Join and log in both start here. The nav button "The Hub" goes here. |
| Everything else | unchanged addresses | product, workbook, coloring, connect, quiz, 404 | New header, footer, and fonts only. Not part of the book spreads. |

Not touched at all: the Hub app (separate project), Stripe and payments, the database structure, the widgets (Garage Sale Planner, Cooking for One), the admin area, and the emails.

## 5. What to bring from the live site into the new design
1. The real newsletter form (Hostinger Reach) in place of the mockup's fake "Check your inbox."
2. The quiz: "Not sure where to start?" opens the existing quiz window.
3. Real products, prices and covers from the database on the Tools page instead of hand-typed ones.
4. The real freebies list (the live Freebies page lists three public ones plus the quiz; the mockup shows the six that are inside the Hub). Decide which to show.
5. Blog categories and guest comments.
6. Social links (Facebook, Instagram, Pinterest) and the "Belong" idea: the live homepage points to the Facebook group. Decide where that goes in the book (About or Hub page).
7. Page titles, descriptions, canonical links and social-share images, which every real page already has.
8. A privacy link in the footer. Today it only appears on the Connect page. `MNC_Privacy_Policy.pdf` is in the repo.

## 6. What comes from the mockup into the site
The book pages, the member card in its pocket, the café menu, the page-turn flip, the type system, and everything from the accessibility audit: skip link, darker focus outline, 44px tap targets, reduce-motion behavior, working at 200% text size.

Left behind: the yellow MOCKUP bar, the placeholder card number and name (they become real: her first name, and the chapter she picks), the "Chapter: Yours to write" line becoming real data (Hub feature, later), and the hash-based page switching.

## 7. Phases, with a checkpoint where Cece looks before we go on
0. **Approval and safety.** Cece says "approved." Work happens on a separate branch called `book-site`. A rollback marker (`pre-book-site`) is saved on the current live version. DESIGN.md and PRODUCT.md are updated to the new direction. The preview method is chosen (see decisions).
1. **Foundation.** Host all fonts ourselves. Add one new stylesheet, `book.css`, so the old stylesheet keeps working while we migrate. New shared header and footer (Home, About, Blog, Tools, The Hub button). Fix the two pages with their own header copy.
2. **Home, About, The Hub** (no database needed). Build and preview. **Checkpoint 1: Cece reviews.**
3. **Tools and Blog** (database). Needs a preview that can read the database. **Checkpoint 2: Cece reviews.**
4. **The page turn on real pages.** Progressive enhancement. Test with JavaScript off, reduced motion, and fast clicking. **Checkpoint 3.**
5. **Everything else.** New header, footer and fonts on the remaining pages. Permanent redirects. SEO check: titles, descriptions, sitemap, no broken links. Full QA (Gate 3), accessibility audit, and performance check.
6. **Go live** only on Cece's explicit word: merge to `main`, watch the deploy, run a checklist (home, about, blog post, tools, buy link, newsletter, quiz, login link, mobile), and keep the rollback ready.

## 8. Safety rules
- Nothing is pushed to `main` until Cece says so. The branch name alone cannot deploy anything.
- The current live version is tagged first, so we can go back in one step.
- The database is only read from, never changed. No payment code is touched.
- Every old web address keeps working, either the same page or a permanent redirect.

## 9. Risks and how they are handled
| Risk | Handling |
|---|---|
| A shared stylesheet change breaks pages we didn't look at | New `book.css` next to the old stylesheet. Pages move over one at a time. |
| Google rankings drop | Same addresses or 301 redirects, same titles and descriptions, one heading per page, real links (not hash links). |
| Database pages can't be previewed on this computer | Preview on a Hostinger test address, or use sample data locally. Decide below. |
| The page turn breaks on some device | It is an add-on. Without it, links just open normally. |
| Slow pages from five font files | Host fonts ourselves, load only the weights used, preload the main ones. |
| Widgets and the automatic brand check disagree with the new fonts | The check only bans Montserrat and Arial in widgets. Widgets keep Lora and DM Sans for now. |

## 10. Decisions (answered by Cece, 2026-09-26)
1. **Look and feel:** it must look exactly like the mockup: the open book and the page turn. Approach used: real pages, each with its own web address, with the page turn layered on top so visitors see exactly the mockup.
2. **Merge Shop, Resources and Freebies into Tools, with permanent redirects.**
3. **Preview on a private test address on Hostinger** before going live.
4. **Fonts:** new fonts on the website pages now; the planners keep Lora and DM Sans for now.

Still needed: Cece's word "approved" on this plan before Phase 0 starts.

(Original questions, kept for reference)
1. Real pages with a page-turn on top (recommended), or another approach.
2. Merge Shop, Resources and Freebies into Tools with redirects (recommended).
3. Where to preview before going live.
4. Whether widgets and the other pages get the new fonts now or later.

## 11. Still open from earlier in the project (not blockers)
- Cece's approval of the new wording: the Hub line ("Your card opens the Hub: free tools, a journal, and other women in the middle chapters."), the "On the house" and "To take home" headings, the chapter line under each product, and the closing lines.
- A real screenshot of the inside of the Hub for the Hub page.
- The Amazon paperback link on the workbook page is still a placeholder.
- "You're not broken" in the About story is close to a banned phrase.
- No testimonials exist, so none are shown.
- Which freebies to list on Tools.
- Later: the "Chapter" field and first name becoming real on the card, and optional chapter stamps.
