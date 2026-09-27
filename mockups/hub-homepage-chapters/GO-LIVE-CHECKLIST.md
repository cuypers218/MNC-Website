# Phase 6: going live

Written 2026-09-27. Nothing here has happened yet. This is the last step before the book site
replaces the live one. Read `INTEGRATION-PLAN.md` in this same folder for how we got here.

## What "going live" means

Right now, all the new work sits on a branch called `book-site`, and your real site keeps
running from `main` exactly as it always has. Going live means merging `book-site` into `main`.
Because this repo auto-publishes over FTP the moment anything lands on `main`, that merge is the
one moment your visitors start seeing the new design. Everything before this point has been
safe to redo; this step is not undone by editing a file, only by rolling back.

## Before you say go

Please look at the private preview one more time: **https://preview.mynestchapter.com**
(same login as before). Click through Home, About, Blog, a post, Tools, and The Hub, on your
phone and your computer. If anything still bothers you, tell me now, not after.

## What ships

Every page the redesign touched: Home, About, Blog (list and posts), Tools (replacing Shop,
Resources and Freebies), The Hub's front door, product pages, the Workbook, Connect, Coloring,
the quiz page, and the "page not found" page. Old addresses like `/shop`, `/resources` and
`/freebies` keep working, they just quietly forward to `/tools` now.

## What does not ship, and is not touched by this at all

The Hub app itself (a separate project), Stripe and payments, your database, the widgets
(Garage Sale Planner, Cooking for One, the quizzes), the admin area, and your emails.

## The safety net already in place

- `pre-book-site` is a marker on your site exactly as it was before any of this started. If
  something goes wrong after going live, we can put the site back to that exact state.
- Everything on `book-site` has already been checked on the private preview with a real
  browser: every link, every page's colors and text size, and how heavy each page is to load.

## The go-live steps, in order

1. **You say the word "approved."** Nothing below happens before that.
2. I merge `book-site` into `main` and push. Hostinger starts publishing automatically; this
   normally takes a few minutes.
3. I watch the automatic publish finish, then go through this list on the real, live site:
   - Home, About, Blog, a real blog post, Tools, and The Hub all load and look right.
   - `/shop`, `/resources` and `/freebies` land on Tools.
   - A "Get the card" button and a "See it in the Hub" button both reach the real Hub.
   - The newsletter box actually sends an email (I'll use my own address to check, not yours).
   - The quiz opens.
   - The site works on a phone.
   - No page shows an error.
4. I tell you plainly whether everything on that list passed, or exactly what didn't.
5. **The Hostinger security page ("checking your browser") that appears on the private preview
   is a preview-only thing** and will not appear on your real site once this is live, since it's
   tied to that separate preview address, not to mynestchapter.com.

## If something goes wrong after going live

I put the site back to the `pre-book-site` marker, tell you exactly what broke, and we fix it
on `book-site` before trying again. Nothing about this design makes a rollback harder than
normal.

## Two things still waiting on you, unrelated to whether the design is safe to ship

1. **The Workbook's Amazon paperback link** is still the placeholder address it's always been.
   If you have the real link, send it and I'll drop it in before we go live; otherwise it ships
   exactly as it is today, unfixed but no worse than before.
2. **Wording that's mine, not yours,** waiting on your OK: the "What's the Hub?" line on Home
   and the Hub page, the Tools page's "On the house" / "To take home" headings, the short line
   under each product describing which chapter it's for, and the closing lines on About. None
   of it is a wall against going live; if you'd rather ship first and wordsmith after, that's a
   fine choice, just tell me either way.
