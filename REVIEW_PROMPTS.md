# REVIEW_PROMPTS.md
**Widget review prompts for My Nest Chapter.**
Lives in the repo root alongside CLAUDE.md.

---

## WHEN TO USE WHICH PROMPT

| Prompt | Use when |
|---|---|
| Prompt 1 — Focused Review | Mid-build. You want the one most important fix before moving forward. |
| Prompt 2 — Full Audit | Pre-launch. You want everything wrong before something goes live. |

---

## HOW TO USE EITHER PROMPT

1. Open this file.
2. Copy the full prompt text.
3. Rewrite the second sentence only — the user persona line. Keep everything else exactly as written.
4. Paste it into Claude Code (or a chat session) with the widget code attached or open.

**The swap line is always sentence two. It follows this formula:**
Who she is + what she's carrying when she opens it.
That one sentence changes every answer you get.

---

## SWAP EXAMPLES

Use these as-is or adapt them for your widget:

| Widget | Swap line |
|---|---|
| Garage Sale Planner | The user is a solo mom who has never sold anything online before and is moderately overwhelmed — she just needs to get through her garage sale without feeling like she's doing it wrong. |
| Know Before You Sell | The user is a solo mom who has never sold anything online and is quietly worried about being ripped off or doing it wrong. |
| Cooking for One Planner | The user is a solo mom cooking for herself for the first time in decades — she feels slightly embarrassed that she needs help with something this basic. |
| 6pm Experience | The user is a solo mom who just hit 6pm in a quiet house and is already starting to spiral — she opened this because she didn't know what else to do. |
| Goal & Habit Tracker | The user is a solo mom trying to figure out who she is now — she wants to feel like she's moving forward but is one more abandoned checklist away from giving up on the idea entirely. |
| Weekly Reset Planner | The user is a solo mom trying to build structure into weekends that used to organize themselves around her kids — she needs help but doesn't want it to feel like homework. |

---

## PROMPT 1 — FOCUSED REVIEW

*Use mid-build. One answer per question. Fast, targeted fix.*

---

You are a senior full-stack engineer and UX designer who specializes in tools for women 45-65. The user of this widget is a solo mom who has never sold anything online before and is moderately overwhelmed — she just needs to get through her garage sale without feeling like she's doing it wrong.

Review this widget and tell me:

1. What one step, field, or label is most likely to make her close the tab and not come back — and what specifically about that element loses her?
2. What one interaction feels clunky or unclear for someone who is not tech-savvy?
3. What one CSS or layout change would make this look significantly more polished and trustworthy to her?
4. Is there any logic that could break on mobile or with unusual input — for example, if she leaves it open overnight, types something unexpected, or has slow internet?

Be specific. Reference actual elements, labels, buttons, or sections by name. Do not give general principles — give me the exact thing to fix and why it matters for this user.

---

## PROMPT 2 — FULL AUDIT

*Use pre-launch. Exhaustive sweep. Numbered list of everything wrong.*

---

You are a Lead Product Engineer and Design Critic. The user of this widget is a solo mom who has never sold anything online before and is moderately overwhelmed — she just needs to get through her garage sale without feeling like she's doing it wrong. Audit this widget exhaustively across 4 layers in order — do not skip ahead:

**Layer 1 — Bugs & Usability:** Every broken logic piece, edge case, mobile failure, accessibility issue.

**Layer 2 — Visuals & Typography:** Every instance of lazy padding, misalignment, bad contrast. Note: flat design with no border-radius and no box-shadow is intentional — do not flag these. Widget fonts (Lora + DM Sans) are brand-locked — do not flag these.

**Layer 3 — Motion & Feel:** Every harsh transition, missing micro-interaction, or moment that feels cheap or abrupt.

**Layer 4 — Micro-copy:** Every generic label, button, or placeholder text that could be more specific to the user's situation.

Output: a numbered list of issues only. No code rewrites. Be specific — name the exact element or line, not the general principle.

---

*Last updated: June 2026*
