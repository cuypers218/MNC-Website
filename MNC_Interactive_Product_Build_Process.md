# The Full Product Process — Every New Digital Product, Every Time
**My Nest Chapter — from idea to launch, with Garage Sale Planner as the worked example**

---

## Phase 0 — Before Any Build Starts

Run this every single time, before any design or code work begins. Three steps:

**1. Confirm the pain point.** Already locked as a non-negotiable rule — never start writing or building until the specific pain point is named in one sentence.

**2. Check what this audience trusts vs. distrusts in a product like this.** This is the part that was missing from Garage Sale Planner, and it's answered in full below — once, as a standing reference, not something to re-research from zero on every product. Re-check it only when: the price point is meaningfully higher than anything you've sold before, or it's been 6+ months since you last looked (design/market signals drift; your audience's core psychology doesn't).

**3. Set the price tier on purpose, before building** — using the tier guide below — so the build target (how polished, how bundled, how complete) matches what that price actually has to deliver. Building first and pricing after means the product and the price were never actually designed together.

---

## Phase 0a — What This Niche Actually Trusts (the standing answer)

**Important distinction up front:** general "premium" design advice (glassmorphism, vast white space, luxury-brand minimalism) is built for SaaS and tech buyers. Your audience is not that buyer, and chasing that look would actually work against you — it would read as corporate and clash with the peer-to-peer, no-coaching-speak voice that's the actual reason people trust you. What follows is calibrated to *your* audience, not generic SaaS buyers.

**What's confirmed by real market signals** (digital product / PLR market research, current as of mid-2026): the thing that makes a digital product feel cheap, regardless of price, is genericness — recycled templates, identical color schemes and layouts across multiple sellers, content with "zero personality or originality." The thing that makes it feel worth the price is the opposite: visible personalization, a point of view, and "bonus" material that makes the offer feel complete rather than thin — a checklist alongside a workbook, a short companion guide alongside a tool, that kind of thing. Bundling related pieces together increases how complete something feels even when the actual content didn't change.

**Applied to your specific audience** (this part is reasoning, not a cited statistic — there isn't a published study on "solo mom empty nesters" specifically, so treat this as informed judgment to sanity-check against your own read of your audience, not as settled fact): a solo mom in this exact situation is buying with two guards up at once — she's been burned by generic "girlboss" planner templates that don't know her actual life, and she's wary of anything that feels like it's selling her a transformation she doesn't believe in. So "premium" for this buyer isn't glossy — it's *evidence of care*. Specific touches (not generic icons), copy that sounds like one real person rather than a brand voice, and a tool that clearly works (no bugs, no broken math) read as premium here. A tool that looks expensively minimal but emotionally flat would actually undersell you. The Memory Box copy in Garage Sale Planner is the proof point — that's the register that earns trust with this buyer, and the visual design needs to finally match it instead of undercutting it.

**Price tier expectations** (reasoning applied from comparable adjacent-niche products — midlife/quiet-creator workbooks in the $17 range, PLR-adjacent ebooks at $9.99–$47 — cross-referenced against what you're already charging):

- **Free (email-gated):** No "premium" bar, but it's the first thing a stranger ever sees from you — it still needs to look intentional, not thrown together, since it's setting the expectation for everything paid that follows.
- **$5–15 (Garage Sale Planner's tier, Someday List Companion, single-purpose tools):** Expected to feel personal and complete, not necessarily fancy. The bar is: doesn't look recycled, doesn't have bugs, sounds like a real person. This is where you are right now, and it's an achievable bar with the fixes in this doc — no need to "go luxury."
- **$20–35 (Now What? Workbook tier):** Expectation steps up to feeling like a *real, finished product* — consistent design system throughout, ideally something extra bundled in (a short companion checklist, a printable insert), because bundling is what justifies the jump from "single tool" to "worth more."
- **$50+ (not where you are yet, but worth knowing):** Needs comprehensive scope, social proof, and multiple formats. Not a near-term concern — flagging it so a future bundle decision starts from the right bar.

---

## Part 1 — Why It Reads as a Canva Template (the actual diagnosis)

Pulled straight from the code in `widgets/garage-sale-planner/widget.html`:

1. **Rounded corners everywhere.** `border-radius` appears 52 times — every card, button, input, and badge is softened. Your own Design System says *no border-radius, no box shadows*. This isn't a small miss: rounded corners + soft shadows + gradient accents are the exact visual signature of templated, AI-generated, drag-and-drop UI. It's the thing that makes a tool *read* as a template even when the content is good.
2. **A hardcoded box-shadow on the topbar**, despite the file's own `--shadow` variables all being set to `none`. Someone (or some pass) broke the rule directly in the markup rather than through the token system — a sign the build didn't go through a real design-review step.
3. **Typography is Montserrat + Arial** — safe, neutral, and identical to what most templated SaaS tools default to. Your own locked pairing for interactive HTML tools is **Lora (display) + DM Sans (body)** — more distinctive, and not what a generic template would reach for.
4. **No signature element.** Outside the Memory Box copy ("This mattered. It had its season. I do not have to keep the item to keep the memory.") nothing about the visual design could only belong to My Nest Chapter. Swap the logo and it could be any decluttering tool on the App Store.

None of this is a coding problem. The tool works. It's a design-review problem — nobody checked the build against the brand system or against "does this look like anyone else's" before calling it done.

---

## Part 2 — How This Category Is Built & Talked About Right Now

The terminology and feature bar professionals are actually working to, separate from the trust/pricing question above:

**Terminology.** Professionals in this space don't call these "garage sale planners" in isolation — they're built and marketed as **inventory management tools** with a garage-sale or moving use case layered on top. Apps like Sortly and BoxOrganizer are described as digital inventory catalogs people use for "a digital jewelry box or a virtual garage closet"; competitors in the garage-sale-specific space (YardSale, Garage Sale AI Marketplace) lean hard on words like *inventory management, real-time sales tracking, detailed analytics, export your data, sync across devices* — the vocabulary of a real business tool, not a fun weekend project. That's useful: your shop copy and in-app language can borrow that register (inventory, tracking, analytics) without losing your voice in the *tone* of the copy itself.

**Feature expectations.** The bar in this category now includes real-time sales/revenue tracking, exportable data, and AI-assisted pricing as a baseline — your build already clears most of this (live calculator, pricing engine, print center). The gap isn't features. It's execution polish.

**What "premium" looks like visually right now.** 2026 design coverage is consistent on a few points worth applying directly: motion is now treated as structural, not decorative — specced transitions (how a card expands, how a section enters) rather than scattered hover effects bolted on at the end. Vast white space and restraint are what premium/luxury-adjacent brands use to signal exclusivity and calm, not density or decoration. And the field is actively naming "anti-template" as a trend in its own right — tools that visibly refuse to look like a cookie-cutter starter kit are getting called out specifically because most don't.

That last point is the real opportunity. The most current design thinking agrees with what you're feeling: a tool that doesn't commit to a specific point of view *will* read as generic, no matter how many features it has.

---

## Part 3 — The Professional Team, Mapped to Your Actual Tools

You already sketched this out, and it's a genuinely good framework. Here's how it maps onto what you actually have access to, with one role added — the one that's missing, and the one that would have caught the rounded-corner problem before it shipped.

| Role | What they decide | Where it happens for you |
|---|---|---|
| **Product Manager** | The pain point, the feature list, what matters and what doesn't | This chat — already your locked process (pain point before anything else) |
| **UX Architect** | The flow — how someone moves through the tool, what triggers what | This chat, or Claude Design for a visual flow map |
| **UI Designer** | The actual look — token system (colors, type, spacing), the one signature element | Claude Design, using the `frontend-design` design system — token system, type pairing, one deliberate "risk," then self-critique against generic defaults |
| **Frontend Engineer** | Turns the approved design into real code | Claude Code |
| **Technical QA** | Breaks the tool on purpose — bad input, empty states, mobile widths | Claude Code, second pass |
| **Brand & Visual QA** *(the missing role)* | Checks the *finished* build against your actual brand system and against "does this look like a template" | Claude Code, third pass — this is the one that didn't happen here |

The fix isn't "redo everything." It's adding that sixth role as a mandatory last step on every interactive product, the same way the brand-compliance check is already mandatory before anything goes live.

---

## Part 4 — The Five Reusable Prompts

Use these in order, in Claude Code (or here for the first two, if you want to talk through the design before handing it off). Drop them in as-is.

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

### 2. UX/UI Designer — Build the Design Plan (do this BEFORE any code)
```
Act as the design lead for this tool. Read CLAUDE.md and the brand skill file —
use ONLY the locked May 2026 colors, Lora (display) + DM Sans (body) for this HTML
tool, and zero border-radius / zero box-shadow per our Design System.

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
- Zero border-radius anywhere in the CSS
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

## Part 5 — Applying This to Garage Sale Planner Right Now

The fastest path isn't a rebuild from zero — the structure, features, and copy are good. It's running prompts 2, 4, and 5 against the existing file:

1. Run **Prompt 2** (design plan) against the *current* widget — but reframed as "redesign this existing tool's visual system" rather than starting fresh, so Claude Code proposes the token system, type swap (Montserrat/Arial → Lora/DM Sans), and one signature element before touching code.
2. Run **Prompt 3** to rebuild the CSS layer only against that approved plan — the JS logic, copy, and feature set stay as-is.
3. Run **Prompt 5** last, no exceptions, before you call it done.

Once this round-trips clean on Garage Sale Planner, the same five prompts apply to What's This Worth, the New Grandma Planner, and anything else in the interactive tools pipeline — same process, every time, no more one-off builds.
