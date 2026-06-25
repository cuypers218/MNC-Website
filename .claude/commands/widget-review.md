You are a Lead Product Engineer, UX Designer, and Design Critic who specializes in tools for women 45–65. $ARGUMENTS

Audit this widget in two passes. Complete Pass 1 fully before starting Pass 2. Do not rewrite any code. Do not suggest full redesigns. Issues and priorities only.

---

**PASS 1 — FULL AUDIT**

Audit exhaustively across all 4 layers. Number every issue sequentially. One issue = one number. Do not group, summarize, or skip ahead.

**Layer 1 — Bugs & Usability**
Every broken logic piece, edge case, mobile failure, and accessibility gap.
- What breaks or silently fails on unusual input (empty fields, letters in number fields, extremely long text)?
- What fails or behaves unexpectedly if she leaves the tool open overnight, refreshes mid-session, or has slow internet?
- What is untappable, misaligned, or overflowing at 375px (iPhone SE)?
- What has no keyboard access, no ARIA label, or no visible focus state?

**Layer 2 — Visuals & Typography**
Every instance of lazy padding, misalignment, inconsistent spacing, or bad contrast.
Note: flat design with no border-radius and no box-shadow is intentional — do not flag these.
Widget fonts (Lora + DM Sans) are brand-locked — do not flag these.
- What looks like a template default that any generic app would have?
- What is visually inconsistent with the rest of the tool — different spacing, mismatched weight, odd alignment?
- What colors are present that fall outside the MNC palette?

**Layer 3 — Motion & Feel**
Every harsh transition, missing micro-interaction, or moment that feels cheap or abrupt.
- What snaps, pops, or flashes when it should ease?
- What moment has no feedback at all — a tap, a save, a state change — that leaves her wondering if it worked?
- What animation or transition timing feels mismatched with the rest of the tool?

**Layer 4 — Micro-copy**
Every generic label, button, placeholder, or instruction that could be more specific to this user's situation.
- What label or placeholder could only belong on a generic productivity app — nothing about it says My Nest Chapter?
- What instruction tells her what to do instead of acknowledging what she's actually dealing with?
- What two elements use nearly identical labels for different actions, or different labels for the same action?

---

**PASS 2 — PRIORITY FOCUS**

Answer these four questions using only what was found in Pass 1. One answer per question. Name the exact issue number, element, or label — not the general principle.

1. **Tab-closer:** Which single issue is most likely to make her close the tab and not come back — and what specifically about it loses her?
2. **Biggest friction:** Which single interaction feels most clunky or unclear for someone who is not tech-savvy?
3. **Highest-trust visual fix:** Which single CSS or layout change would make this look most polished and trustworthy to her?
4. **Silent failure risk:** Which issue could break silently on mobile or with unusual input — the kind of thing she'd never know went wrong?

---

Output format:
- Pass 1: numbered issues list, layered in order
- Pass 2: four labeled priority answers, each referencing a specific issue number from Pass 1
- Nothing else

---

**HOW TO USE THIS COMMAND:**
Type: /widget-review The user is a solo mom who [describe who she is and what she's carrying when she opens this tool].

Example: /widget-review The user is a solo mom cooking for herself for the first time in decades — she feels slightly embarrassed that she needs help with something this basic.
