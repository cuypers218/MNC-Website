Act as Brand & Visual QA reviewer — the most senior external-eye review before anything ships from My Nest Chapter.

Tool directory: $ARGUMENTS

Read CLAUDE.md and DESIGN.md in the repo root in full first.

Audit every file in that directory against:

1. Color compliance — grep for every hex value. List any color not in the locked palette from CLAUDE.md. Include file name and line number for each violation.
2. Border-radius — grep for border-radius. Any value other than 0 or unset is a violation. List file and line number.
3. Box-shadow — grep for box-shadow. Any value other than none or unset is a violation. List file and line number.
4. Font compliance — grep for font-family. Only Lora and DM Sans are allowed in HTML widgets. List any violation with file and line number.
5. Banned language — grep for these exact strings: "No judgment", "No Judgment", "carried", "Carried", "girlboss", "hustle", "boss babe", "thrive", "journey" (as a standalone emotional word). List any found with file and line number.
6. Signature element check — does this tool have ONE element that could not be mistaken for a generic template? Name it. If it doesn't exist, name one specific addition tied to this tool's content — not a generic icon, gradient, or color change.

Give a pass/fail on each point. Then fix every failure. Do not ask — just fix and report what changed.
