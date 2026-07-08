# MNC Build Playbook
My Nest Chapter | mynestchapter.com | Updated July 2026

---

## THE RULE

One product at a time. Finish before starting the next.

A half-built product sitting on your hard drive makes zero sales. A live product with 80% of the features makes real sales.

---

## PHASE 0 — STANDING REFERENCE

Read once. Recheck only when the price point is meaningfully higher than anything sold before, or it's been six months since the last review.

**Non-negotiable:** confirm the specific pain point, in one sentence, before any writing or building starts. No exceptions.

**What this audience trusts:**

Genericness is what makes a digital product feel cheap regardless of price — recycled templates, identical layouts, zero personality. Visible personalization, a point of view, and specific detail make an offer feel complete rather than thin.

This buyer has been burned by generic planner templates and is wary of anything selling a transformation she doesn't believe in. "Premium" for her isn't glossy — it's evidence of care. Specific touches, copy that sounds like one real person, a tool with no bugs and no broken math. The Memory Lane section in the Garage Sale Planner is the proof point for the tone that earns trust.

**Price tiers:**

| Tier | What it needs to be |
|---|---|
| Free (email-gated) | Not premium, but still the first impression — must look intentional |
| $5–15 | Personal and complete, not fancy. Doesn't look recycled, no bugs, sounds like a real person |
| $20–35 | Real finished product — consistent design, something extra included |
| $50+ | Not there yet. Comprehensive scope, social proof, multiple formats |

**Language for interactive tools:** this category uses words like inventory management, real-time tracking, exportable data — the vocabulary of a real business tool. Borrow that register in shop and in-app copy without losing Cece's voice in tone.

---

## PHASE 1 — DEFINE

Answer these in writing before anything else:

1. What is this product? One sentence.
2. Who specifically is it for? Not "solo moms" — the exact situation. Example: "A solo mom who hasn't had a garage sale before and doesn't know where to start."
3. What problem does it solve? One sentence. The reader should feel seen.
4. What is the price point, and why? Match to value using the tier table above, not to effort spent building it.

**Deliverable:** a written blueprint doc before any design or building starts.

---

## PHASE 2 — DESIGN PLAN

**This is a mandatory gate. No code until this is done.**

This phase didn't exist before Garage Sale Planner shipped looking templated. It exists now, permanently.

Produce a design plan that covers:

- **Color roles:** which color from the locked July 2026 palette does which job. Name the roles — primary action, secondary, background, text — don't just list the colors.
- **Type scale:** what sizes and weights for display headings vs. body text. Lora for display, DM Sans for body — those are the only two fonts for any interactive tool.
- **Layout concept:** how the tool is structured — tabs, sections, order — in one to two sentences per section.
- **Border-radius decision:** 0px or 8px. Choose one, apply it to everything in this tool. 0px = stark and editorial. 8px = polished and tool-like. Both are valid. Write down the choice and the reason before any code is written.
- **Signature element:** the one thing in this tool that could only be My Nest Chapter — tied to the specific content or pain point, not a generic icon or decoration. If you can't name it, the design isn't ready.

**Self-critique before moving on:** does any part of this read like a generic template default — rounded cards, soft shadows, a centered hero with a big number? Revise anything that does. The plan gets reviewed before code starts. No skipping to build.

---

## PHASE 3 — BUILD

**Build in this order, no skipping:**

1. Global shell first — header, navigation, footer, color system, typography, data saving
2. Each tab or section in order, one at a time
3. Mobile layout check after each section — not saved for the end
4. Brand compliance check before calling it done

**Design standards — non-negotiable:**

- Border-radius: use the value chosen in Phase 2 — either 0px or 8px — applied to every element in this tool. No mixing.
- No box-shadow anywhere unless a card-elevation treatment was explicitly approved in the Design Plan
- Lora for display headings, DM Sans for body — no other fonts in any HTML tool
- July 2026 color palette only — no retired colors, no invented colors
- No emojis anywhere — not in labels, buttons, toasts, or copy
- All data saves locally in the browser — no server required, no account login to use the tool

**After each major section is built:** take a screenshot at desktop and mobile sizes, deploy, and check it live before continuing.

---

## PHASE 4 — TECHNICAL QA

Break it on purpose before calling it done.

1. **Input validation** — try negative numbers, letters in number fields, empty required fields, and very long text. Does anything break or display wrong?
2. **Mobile** — does anything overflow or break at iPhone SE width (375px)?
3. **Data saving** — what happens on first load with no saved data? Does it handle a missing or corrupted saved state without crashing?
4. **Every button** — does every button actually do what its label says?

Fix everything found. Don't ask permission on obvious bugs — fix and report what changed.

---

## PHASE 5 — BRAND AND VISUAL QA

The most senior external-eye review before anything ships. Never skip it.

This is the step that was skipped on the original Garage Sale Planner launch and why it shipped looking templated. It is now permanent.

Check each of these — pass or fail on every point, then fix everything that fails:

1. **Design standards** — check every file for border-radius values that don't match the Phase 2 decision, any box-shadow that wasn't approved, and any color not in the locked July 2026 palette.
2. **Fonts** — check every file for any font other than Lora or DM Sans.
3. **Copy** — check every piece of in-tool copy against the banned words and phrases in the brand skill file.
4. **Signature check** — does this tool have one element that couldn't be mistaken for a generic template? If not, name what's missing and propose one specific fix tied to the tool's actual content. Not a generic icon. Not a color. Something that makes a real user think "this was made for me."
5. **Comparison check** — compare the finished tool against a free or $0.99 app in this same category. If they're indistinguishable, say so directly and propose the fix before shipping.

---

## THE SIX ROLES

Every build involves these six roles. One person can play multiple roles — but each role still has to happen. Don't skip a role because it feels like overhead.

| Role | Decides | Where |
|---|---|---|
| Product Manager | Pain point, feature list | Planning chat |
| UX Architect | How someone moves through the tool | Planning chat or Claude Design |
| UI Designer | Color roles, type scale, signature element | Claude Design |
| Frontend Engineer | Turns the approved design into working code | Claude Code |
| Technical QA | Breaks it on purpose | Claude Code, second pass |
| Brand and Visual QA | Checks the finished build against brand standards | Claude Code, third pass — mandatory |

---

## PHASE 6 — LAUNCH

Complete every item before calling the product live.

**Technical:**
- [ ] Deploy to Hostinger
- [ ] Save to GitHub
- [ ] Test on actual iPhone Safari
- [ ] Test on Android Chrome

**Payments:**
- [ ] Add to Stripe products
- [ ] Set price and activate
- [ ] Test checkout start to finish with a real card
- [ ] Confirm the post-purchase email fires and the link works
- [ ] Confirm the product is only accessible after purchase and login

**Shop page:**
- [ ] Product card on the shop page — cover image required, no placeholder
- [ ] CTA text: "Get the [Title]" — never "Learn More" or "Buy Now"
- [ ] Demo link if it's an interactive tool
- [ ] Short description centered on the reader's pain point, not the feature list

**Delivery:**
- [ ] Instructions doc written — how to open, save, and use on a phone
- [ ] Post-purchase email sends the instructions link or the direct tool link

---

## PHASE 7 — PROMOTE

This is where most products die. Building without this phase means zero sales.

**Email the list first — highest conversion rate:**
- One email. Subject line = the problem it solves, not the product name.
- Body: Cece's voice, peer-to-peer, three to four paragraphs, one link, one CTA.
- Send within 48 hours of going live.

**Social, same week:**
- Facebook and Instagram: what it is, why it was made, link. One real post beats ten planned ones.

**Ongoing:**
- Mention in newsletters when relevant. Add to email footer or PS. Link from related blog posts or freebies.

---

## PHASE 8 — ITERATE

After the product has been live at least two weeks:

- [ ] If purchased, email and ask: "What would make this better?"
- [ ] Review any support emails or questions
- [ ] Identify one thing to add or fix based on real feedback
- [ ] Build it, deploy it, email the list again

**Rule:** No new features until the product has had at least one real customer.

---

## SESSION STARTUP

1. Check the product roadmap — what are we working on today?
2. Open the blueprint for that product — what section comes next?
3. Take a screenshot of the current state before touching anything
4. Work on one item from the pending list
5. Deploy and test before ending the session — never leave changes undeployed

## SESSION CLOSE

1. Deploy any changes
2. Save to GitHub with a clear message
3. Update the product roadmap — check off what's done, add what came up
4. Note the next thing to do at the top of the roadmap

---

*My Nest Chapter | Build Playbook | Updated July 2026*
*Follow this. Every time. No exceptions.*
