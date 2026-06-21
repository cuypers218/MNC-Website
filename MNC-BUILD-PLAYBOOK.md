# MNC Build Playbook
**The process every product goes through — start to first sale**
My Nest Chapter | mynestchapter.com

---

## THE RULE
**One product at a time. Finish before starting the next.**
A half-built product sitting on your hard drive makes zero sales.
A live product with 80% of the features makes real sales.

---

## PHASE 1 — DEFINE (before any code)

Before building anything, answer these four questions in writing:

**1. What is this product?**
One sentence. Example: "A printable + interactive planner for women running their first garage sale alone."

**2. Who specifically is it for?**
Not "women" — be specific. Example: "A solo mom who hasn't had a garage sale before and doesn't know where to start or how to price things."

**3. What problem does it solve?**
One sentence. The reader should feel seen. Example: "She has a house full of stuff and no system for what to do with it."

**4. What is the price point and why?**
Match to value, not effort. Reference: MNC Premium Widget Research memory file for 2026 price point data.

**Deliverable:** Blueprint doc (.docx or .md) — use GarageSalePlanner_Blueprint_v2.docx as the template format.

---

## PHASE 2 — BUILD

**Follow MNC_Widget_Standards_Updated.md.pdf for ALL build decisions.**

Build order (always this order, no skipping):
1. Global shell first (header, nav, footer, color system, typography, localStorage)
2. Each tab/section in order, one at a time
3. Mobile layout check after each tab — do not save this for the end
4. Brand compliance check (Section 11 of blueprint) before calling it done

**Tools:**
- Single-file HTML: HTML + CSS + JS in one .html file
- No frameworks, no build system
- localStorage for all persistence
- File location: C:\Users\cuype\MNC-Website\widgets\[product-name]\index.html

**Build standards (non-negotiable):**
- No border-radius (except pill buttons: border-radius 9999px)
- No drop shadows
- No emojis in UI, labels, or toasts
- Never use alert() — always showToast()
- esc() on all user-generated content before HTML injection
- Colors: follow DESIGN.md exactly — no retired palette colors

**After each major section is built:**
- Run Playwright visual check before moving on
- Screenshot: desktop + mobile
- Deploy to FTP and check live before continuing

---

## PHASE 3 — LAUNCH

Complete ALL of these before calling the product live:

**Technical:**
- [ ] Deploy to Hostinger via FTP (see project_deployment.md memory for credentials)
- [ ] Commit to GitHub: github.com/cuypers218/MNC-Website
- [ ] Test on actual iPhone Safari (not just desktop)
- [ ] Test on Android Chrome

**Payments:**
- [ ] Add product to Stripe products table (see project_stripe_setup.md memory)
- [ ] Set price and activate in Stripe dashboard
- [ ] Test checkout flow end to end — buy it yourself with a real card
- [ ] Confirm post-purchase email fires and link works
- [ ] Confirm product is gated (only accessible after purchase + login)

**Shop page:**
- [ ] Product card on mynestchapter.com/shop — cover image required, no placeholder
- [ ] CTA text: "Get the [Title]" — never "Learn More" or "Buy Now"
- [ ] Demo link if product is interactive (links to the widget itself or a demo mode)
- [ ] Short description centered on reader pain, not feature list

**Delivery:**
- [ ] Instructions PDF written (1–2 pages: how to open, save, use on phone)
- [ ] Post-purchase email sends instructions PDF link OR direct widget link

---

## PHASE 4 — PROMOTE

This is where most products die. Build without this phase = zero sales.

**Email your list (do this first — highest conversion rate):**
- Write ONE email. Subject: the problem it solves, not the product name.
- Example: "I made a plan for the stuff taking up space in my garage"
- Body: Cece voice, peer-to-peer, 3–4 paragraphs, one link, one CTA
- Send within 48 hours of going live

**Social (do within the same week):**
- Facebook post: what it is + why you made it + link
- Instagram post: same content, visual-first
- No need to be perfect. One real post beats ten planned ones.

**Ongoing:**
- Mention in newsletters when relevant
- Add to email footer or PS section
- Link from related blog posts or freebies

---

## PHASE 5 — ITERATE

After the product has been live for at least 2 weeks:

- [ ] Check if anyone has purchased — if yes, email them and ask one question: "What would make this better?"
- [ ] Review any support emails or questions
- [ ] Identify ONE thing to add or fix based on real feedback
- [ ] Build it, deploy it, email your list again ("just made this better")

**Rule:** No new features until the product has had at least one real customer.

---

## SESSION STARTUP CHECKLIST

At the start of every work session, do this in order:
1. Open MNC-PRODUCT-ROADMAP.md — what are we working on today?
2. Open the blueprint for that product — what section comes next?
3. Open index.html for that product in VS Code
4. Run a Playwright screenshot to see the current state before touching anything
5. Work on ONE item from the pending list
6. Deploy and test before ending the session — never leave code undeployed

---

## SESSION CLOSE CHECKLIST

Before ending every session:
1. Deploy any changes to FTP
2. Commit to GitHub with a clear message
3. Update MNC-PRODUCT-ROADMAP.md — check off what's done, add what came up
4. Note the NEXT thing to do at the top of the roadmap file

---

*My Nest Chapter | Build Playbook | Created June 2026*
*Follow this. Every time. No exceptions.*
