# MNC Build Playbook
**The complete process — every product, idea to first sale, including the design-quality gate that was missing.**
My Nest Chapter | mynestchapter.com

*This file replaces both the old MNC-BUILD-PLAYBOOK.md and MNC_Interactive_Product_Build_Process.md. Delete both of those once this is pushed.*

---

## THE RULE
**One product at a time. Finish before starting the next.**
A half-built product sitting on your hard drive makes zero sales.
A live product with 80% of the features makes real sales.

---

## PHASE 0 — STANDING REFERENCE
Read once. Recheck only when the price point is meaningfully higher than anything sold before, or it's been 6+ months since last review.

**Non-negotiable:** confirm the specific pain point, in one sentence, before any writing or building starts. No exceptions.

**What this audience trusts** *(confirmed market signal, not audience-specific data — there's no published study on "solo mom empty nesters" specifically, so the second half below is reasoning applied to that signal, not settled fact):*
- Confirmed: genericness is what makes a digital product feel cheap regardless of price — recycled templates, identical layouts across sellers, zero personality. Visible personalization, a point of view, and bundled "extra" material make an offer feel complete rather than thin.
- Reasoning applied: this buyer has two guards up — burned by generic "girlboss" planner templates, wary of anything selling a transformation she doesn't believe in. "Premium" for her isn't glossy, it's *evidence of care* — specific touches, copy that sounds like one real person, a tool with no bugs and no broken math. Emotionally flat + expensively minimal undersells here. Memory Box copy in Garage Sale Planner is the proof point for the register that earns trust.

**Price tier expectations** *(reasoning applied from comparable adjacent-niche products — midlife/quiet-creator workbooks ~$17, PLR-adjacent ebooks $9.99–$47 — cross-referenced against current MNC pricing):*

| Tier | Bar |
|---|---|
| Free (email-gated) | Not "premium," but still the first impression — must look intentional |
| $5–15 (Garage Sale Planner, Someday Companion, single-purpose tools) | Personal and complete, not fancy. Doesn't look recycled, no bugs, sounds like a real person |
| $20–35 (Now What? Workbook tier) | Real, finished product — consistent design system, something extra bundled in |
| $50+ (not there yet) | Comprehensive scope, social proof, multiple formats |

**Category terminology (interactive tools):** this category is marketed with words like *inventory management, real-time tracking, exportable data* — the vocabulary of a real business tool. Borrow that register in shop/in-app copy without losing voice in tone.

---

## PHASE 1 — DEFINE
Answer in writing before anything else:
1. **What is this product?** One sentence.
2. **Who specifically is it for?** Not "solo moms" — the exact situation. Example: "A solo mom who hasn't had a garage sale before and doesn't know where to start."
3. **What problem does it solve?** One sentence. The reader should feel seen.
4. **What is the price point, and why?** Match to value using the Phase 0 tier table, not effort.

**Deliverable:** Blueprint doc — use GarageSalePlanner_Blueprint_v2.docx as the template format.

---

## PHASE 2 — DESIGN PLAN (mandatory gate — before any code)
This phase didn't exist before Garage Sale Planner shipped looking templated. It exists now, permanently.

Produce a design plan before writing a line of code:
- **Token system:** which locked color for which role (primary action, secondary, background, text) — name them, don't just list the palette
- **Type scale:** sizes/weights for display vs. body, using Lora + DM Sans only
- **Layout concept:** page/section structure, 1–2 sentences each
- **Signature element:** the ONE thing in this tool that could only be My Nest Chapter — tied to the actual content or pain point, not a generic icon or gradient

**Self-critique before moving on:** does any part of this read as a generic template default (rounded cards, soft shadows, centered hero with a big number)? Revise anything that does. Show the plan before writing code — don't skip straight to build.

---

## PHASE 3 — BUILD
**Build order (always this order, no skipping):**
1. Global shell first (header, nav, footer, color system, typography, localStorage)
2. Each tab/section in order, one at a time
3. Mobile layout check after each tab — not saved for the end
4. Brand compliance check before calling it done

**Tools:**
- Single-file HTML: HTML + CSS + JS in one .html file, no frameworks, no build system
- localStorage for all persistence

**Build standards — non-negotiable, no exceptions:**
- **Zero border-radius anywhere in the CSS.** *(Corrected: the old pill-button exception at 9999px is removed — it's the same pattern already flagged as a compliance problem on the homepage. There is no border-radius exception.)*
- Zero box-shadow anywhere — no hardcoded shadows, no shadow token set to anything but "none"
- Only Lora (display) + DM Sans (body) — no Montserrat, no Arial, no other fonts, in HTML tools
- Only the locked May 2026 color palette — no retired colors, no invented colors
- No emojis anywhere — UI, labels, or toasts
- Never use `alert()` — always `showToast()`
- `esc()` on all user-generated content before HTML injection

**After each major section is built:** screenshot desktop + mobile, deploy, and check live before continuing.

---

## PHASE 4 — TECHNICAL QA
Break it on purpose before calling it done:
1. **Input validation** — negative numbers, letters in number fields, emojis, empty required fields, extremely long text
2. **Mobile responsiveness** — anything overflow or break at 375px width (iPhone SE)?
3. **State resilience** — does localStorage handle a corrupted/empty saved state without crashing? First load with zero data?
4. **Every button** — does every click handler actually do what its label says?

Fix everything found. Don't ask permission on obvious bugs — fix and report what changed.

---

## PHASE 5 — BRAND & VISUAL QA (the step that was skipped)
The most senior-level external-eye review before anything ships — this is the role that would have caught Garage Sale Planner's rounded corners before launch. Never skip it.

1. Grep for `border-radius`, `box-shadow`, and any hex color outside the locked palette. List every violation with file + line number.
2. Grep for Montserrat, Arial, or any font outside Lora/DM Sans.
3. Grep for any banned word or phrase from the brand skill file.
4. **Signature check:** does this tool have ONE element that couldn't be mistaken for a generic template? If not, name what's missing and propose one specific fix tied to the tool's actual content.
5. Compare against a $0.99 App Store version of this category — if indistinguishable, say so directly and propose the fix.

Pass/fail on each point, then fix everything that fails.

**The six roles, mapped:**

| Role | Decides | Where it happens |
|---|---|---|
| Product Manager | Pain point, feature list | This chat |
| UX Architect | Flow — how someone moves through the tool | This chat, or Claude Design |
| UI Designer | Token system, type pairing, signature element | Claude Design, `frontend-design` system |
| Frontend Engineer | Turns approved design into code | Claude Code |
| Technical QA | Breaks it on purpose | Claude Code, second pass |
| Brand & Visual QA | Checks finished build against brand system | Claude Code, third pass — mandatory, same as brand compliance |

---

## PHASE 6 — LAUNCH
Complete ALL of these before calling the product live:

**Technical:**
- [ ] Deploy to Hostinger
- [ ] Commit to GitHub: github.com/cuypers218/MNC-Website
- [ ] Test on actual iPhone Safari (not just desktop)
- [ ] Test on Android Chrome

**Payments:**
- [ ] Add product to Stripe products table
- [ ] Set price and activate in Stripe dashboard
- [ ] Test checkout flow end to end — buy it with a real card
- [ ] Confirm post-purchase email fires and link works
- [ ] Confirm product is gated (accessible only after purchase + login)

**Shop page:**
- [ ] Product card on mynestchapter.com/shop — cover image required, no placeholder
- [ ] CTA text: "Get the [Title]" — never "Learn More" or "Buy Now"
- [ ] Demo link if interactive
- [ ] Short description centered on reader pain, not feature list

**Delivery:**
- [ ] Instructions PDF written (1–2 pages: how to open, save, use on phone)
- [ ] Post-purchase email sends instructions PDF link OR direct widget link

---

## PHASE 7 — PROMOTE
This is where most products die. Build without this phase = zero sales.

**Email the list first — highest conversion rate:**
- One email. Subject = the problem it solves, not the product name.
- Body: Cece voice, peer-to-peer, 3–4 paragraphs, one link, one CTA
- Send within 48 hours of going live

**Social, same week:**
- Facebook + Instagram: what it is + why it was made + link. One real post beats ten planned ones.

**Ongoing:**
- Mention in newsletters when relevant. Add to email footer/PS. Link from related blog posts or freebies.

---

## PHASE 8 — ITERATE
After the product has been live at least 2 weeks:
- [ ] If purchased, email and ask: "What would make this better?"
- [ ] Review support emails/questions
- [ ] Identify ONE thing to add or fix based on real feedback
- [ ] Build it, deploy it, email the list again ("just made this better")

**Rule:** No new features until the product has had at least one real customer.

---

## THE FIVE REUSABLE PROMPTS
Use in order, in Claude Code. Drop in as-is.

### 1. Product Manager — Define the Build
```
Act as Product Manager for a My Nest Chapter interactive HTML tool.

Tool: [name]
Pain point this solves (one sentence, specific — not "helps moms organize"):
Who's using it and when (e.g. "a solo mom prepping for a sale this weekend, on her phone"):

Read CLAUDE.md and the brand skill file in this repo first.

List the 5-8 features that actually serve the pain point above. Cut anything that's
"nice to have" but doesn't serve it. Flag if this should be a one-time-use PDF instead
of a repeat-use interactive tool per our Product Format Rules.
```

### 2. UX/UI Designer — Build the Design Plan (before any code)
```
Act as the design lead for this tool. Read CLAUDE.md and the brand skill file —
use ONLY the locked May 2026 colors, Lora (display) + DM Sans (body) for this HTML
tool, and zero border-radius / zero box-shadow per our Design System. No exceptions
for pills or any other shape.

Before writing any code, produce a design plan:
- Token system: which of our locked colors for which role (primary action, secondary,
  background, text) — name them, don't just list the palette
- Type scale: sizes/weights for display vs body, using Lora + DM Sans
- Layout concept: describe the page/section structure in 1-2 sentences each
- Signature element: the ONE thing in this tool that could only be My Nest Chapter —
  not a generic icon or gradient, something tied to the actual content or pain point

Then self-critique: does any part of this read as a generic template default
(rounded cards, soft shadows, a centered hero with a big number) rather than a
choice made specifically for this tool and this pain point? Revise anything that does,
and tell me what you changed and why. Show me the plan before writing code.
```

### 3. Frontend Engineer — Build It
```
Act as Senior Frontend Engineer. Build this tool exactly to the approved design plan
above. Read CLAUDE.md and the brand skill file before touching any code.

Hard rules, no exceptions:
- Zero border-radius anywhere in the CSS — including buttons, badges, and pills
- Zero box-shadow anywhere in the CSS (no hardcoded shadows, no shadow tokens set to
  anything but "none")
- Only Lora (display) + DM Sans (body) — no Montserrat, no Arial, no other fonts
- Only the locked May 2026 color palette — no retired colors, no invented colors
- No emojis anywhere

Build it now. When done, list every CSS variable you used for color, radius, and
shadow so I can verify compliance at a glance.
```

### 4. Technical QA — Break It On Purpose
```
Act as Senior QA Engineer. Review every file in [tool directory] and find what breaks.

Check specifically:
1. Input validation — negative numbers, letters in number fields, emojis, empty
   required fields, extremely long text
2. Mobile responsiveness — does anything overflow or break at 375px width (iPhone SE)?
3. State resilience — does localStorage handle a corrupted/empty saved state without
   crashing? What happens on first load with zero data?
4. Every button — does every click handler actually do what its label says?

List every issue found, then fix it. Don't ask permission to fix obvious bugs —
just fix them and tell me what changed.
```

### 5. Brand & Visual QA — The Step That Was Skipped
```
Act as Brand & Visual QA reviewer — the most senior-level external-eye review before
anything ships. Read CLAUDE.md and the brand skill file in full first.

Audit [tool directory] against:
1. Grep for border-radius, box-shadow, and any hex color not in the locked May 2026
   palette. List every violation with file + line number.
2. Grep for Montserrat, Arial, or any font outside Lora/DM Sans in this HTML tool.
3. Grep for any banned word or phrase from the brand skill file.
4. Visual signature check: does this tool have ONE element that couldn't be mistaken
   for a generic decluttering/inventory app template? If not, name what's missing and
   propose one specific addition tied to the tool's actual content (not a generic
   icon, gradient, or stock illustration).
5. Compare against what a $0.99 App Store inventory app looks like vs. what we're
   building — if the answer is "indistinguishable," say so directly and propose the fix.

Give me a pass/fail on each point, then fix everything that fails.
```

---

## SESSION STARTUP CHECKLIST
1. Open MNC-PRODUCT-ROADMAP.md — what are we working on today?
2. Open the blueprint for that product — what section comes next?
3. Open the tool's index.html in VS Code
4. Screenshot the current state before touching anything
5. Work on ONE item from the pending list
6. Deploy and test before ending the session — never leave code undeployed

## SESSION CLOSE CHECKLIST
1. Deploy any changes
2. Commit to GitHub with a clear message
3. Update MNC-PRODUCT-ROADMAP.md — check off what's done, add what came up
4. Note the NEXT thing to do at the top of the roadmap file

---

*My Nest Chapter | Build Playbook | Merged version — combines the original lifecycle playbook with the interactive-tool design-quality process. Created June 2026.*
*Follow this. Every time. No exceptions.*
