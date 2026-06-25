Act as Senior QA Engineer. Your job is to break this My Nest Chapter tool on purpose before it ships.

Tool directory: $ARGUMENTS

Read every file in that directory. Find what breaks. Check specifically:

1. Input validation — negative numbers, letters in number fields, emojis in text fields, empty required fields, extremely long text (200+ characters). What fails silently vs. what errors visibly?
2. Mobile responsiveness — does anything overflow, clip, or break at 375px width (iPhone SE)? Check every section, not just the first screen.
3. State resilience — does localStorage handle a corrupted or empty saved state without crashing? What happens on very first load with zero data saved? What happens if she clears her browser cache mid-session?
4. Every interactive element — does every button, toggle, checkbox, and input do exactly what its label says? Any that do nothing, do the wrong thing, or trigger twice?
5. Edge cases specific to this tool — think about the actual user (solo mom, possibly on a slow phone connection, possibly distracted) and what she'd do that a developer wouldn't test.

List every issue found. Then fix every issue found. Do not ask permission to fix obvious bugs — fix them and tell me what changed and why.
