#!/usr/bin/env python3
"""
MNC Automated QA Checker
Runs on every push to GitHub. Catches brand and code violations
before they reach Hostinger.

WHAT THIS CHECKS (objective, automatable rules):
  - Retired hex colors
  - border-radius violations (only 0 or 9999px allowed)
  - box-shadow violations (only 'none' allowed)
  - Wrong fonts in widget files (Lora + DM Sans only in /widgets/)
  - Banned brand phrases (exact string matches)

WHAT THIS DOES NOT CHECK (requires Claude Code judgment at session end):
  - Does the tool look like a generic template?
  - Does the copy sound like Cece's voice?
  - Is there a signature element that's distinctly My Nest Chapter?
  - Do input validation and localStorage edge cases work correctly?
  Those are covered by Gates 1-3 in CLAUDE.md.
"""

import os
import re
import sys
from pathlib import Path
from dataclasses import dataclass, field
from typing import List

# ─────────────────────────────────────────────────────────────────
# WHAT TO SCAN
# ─────────────────────────────────────────────────────────────────

SCAN_DIRS = ['widgets', 'site']
SCAN_EXTENSIONS = {'.html', '.php', '.css', '.js'}

# ─────────────────────────────────────────────────────────────────
# RETIRED COLORS
# These must never appear anywhere. May 2026 palette is the only valid palette.
# ─────────────────────────────────────────────────────────────────

RETIRED_COLORS = [
    ('#811453', 'Deep Berry — retired May 2026'),
    ('#5e1337', 'Dark Berry — retired May 2026'),
    ('#a3918a', 'Muted Mauve — retired May 2026'),
    ('#d6c2b7', 'Warm Blush — retired May 2026'),
    ('#f8d4d4', 'Blush Pink — retired May 2026'),
    ('#f4e8c1', 'Warm Cream — retired May 2026'),
]

# ─────────────────────────────────────────────────────────────────
# WIDGET-ONLY FONT VIOLATIONS
# Lora (display) + DM Sans (body) only in /widgets/.
# Montserrat + Arial are for print PDFs only.
# ─────────────────────────────────────────────────────────────────

WIDGET_BANNED_FONTS = ['Montserrat', 'Arial']

# ─────────────────────────────────────────────────────────────────
# BANNED PHRASES
# Exact string matches, case-insensitive.
# Only phrases specific enough to catch without false positives.
# ─────────────────────────────────────────────────────────────────

BANNED_PHRASES = [
    # Brand-specific bans
    ('no judgment',                 'Use nothing — just remove it. Ex: "Takes 60 seconds." not "No judgment. Takes 60 seconds."'),
    ('zero judgment',               'Same rule — remove it entirely'),
    ('what you carried',            'Use "what you lived" or "what you dealt with"'),
    ('as solo moms, we',            'Never speak for the reader. Cece speaks for herself only.'),
    ('lightbox',                    'Always call it "6pm Experience" or "6pm Experience widget"'),
    ('no wrong answers',            'Remove entirely — never use'),
    ('change things for me',        'Banned — remove'),
    ('which one keeps coming back', 'Banned — remove'),
    # Therapy speak
    ('hold space',                  'Use "share" or "write it down"'),
    ('healing journey',             'Remove or rephrase entirely'),
    ('sit with your feelings',      'Rephrase in plain language'),
    ('honor your journey',          'Remove — therapy speak'),
    ('safe space',                  'Rephrase in plain language'),
    ('inner child',                 'Remove — therapy speak'),
    ('lean into',                   'Use "move through" or "get through"'),
    # Coaching speak
    ("you've got this",             'Remove — coaching speak'),
    ('level up',                    'Remove — coaching speak'),
    ('step into your power',        'Remove — coaching speak'),
    ('own your story',              'Remove — coaching speak'),
    ('mindset shift',               'Remove — coaching speak'),
    ('living your best life',       'Remove — coaching speak'),
    # Toxic positivity
    ('everything happens for a reason', 'Remove — toxic positivity'),
    ('you are enough',              'Remove — toxic positivity'),
    ('good vibes only',             'Remove — toxic positivity'),
    ('sending love and light',      'Remove — toxic positivity'),
    # Outcome promises
    ("you'll find",                 'Use possibility language: "you might find" or "I found"'),
    ("you'll feel",                 'Use: "I felt" or "you might notice"'),
    ("you'll discover",             'Use: "I found" or "you may find"'),
    ('this will help you',          'Use: "this helped me" or "this is one way to"'),
    ('this gives you',              'Use: "this gave me"'),
    ("you'll walk away",            'Remove outcome promise'),
    ('this changes everything',     'Remove outcome promise'),
    # Demanding tone
    ('you need to',                 'Use: "you might want to"'),
    ('you must',                    'Remove — demanding tone'),
    ('you have to',                 'Remove or soften'),
    ("don't skip this",             'Remove — demanding tone'),
]

# ─────────────────────────────────────────────────────────────────
# VIOLATION COLLECTOR
# ─────────────────────────────────────────────────────────────────

@dataclass
class Violation:
    category: str
    filepath: str
    line_number: int
    line_content: str
    fix: str

violations: List[Violation] = []
files_scanned = 0

def flag(category, filepath, line_number, line_content, fix):
    violations.append(Violation(
        category    = category,
        filepath    = str(filepath),
        line_number = line_number,
        line_content= line_content.strip()[:120],
        fix         = fix
    ))

# ─────────────────────────────────────────────────────────────────
# SCANNER
# ─────────────────────────────────────────────────────────────────

def scan_file(filepath: Path):
    global files_scanned
    files_scanned += 1
    is_widget = 'widgets' in filepath.parts

    try:
        lines = filepath.read_text(encoding='utf-8', errors='ignore').splitlines()
    except Exception as e:
        print(f"  Could not read {filepath}: {e}")
        return

    for i, line in enumerate(lines, 1):
        if not line.strip():
            continue

        line_lower = line.lower()

        # 1 — Retired hex colors
        for hex_val, label in RETIRED_COLORS:
            if hex_val in line_lower:
                flag('RETIRED COLOR', filepath, i, line,
                     f'{label} — replace with a May 2026 palette color')

        # 2 — border-radius violations
        #     Allowed: border-radius: 0 | 0px | 9999px | var(--something)
        #     CSS variable declarations are allowed (e.g. --radius-pill: 9999px)
        if 'border-radius' in line_lower:
            # Skip CSS variable declarations (--variable-name: value)
            is_var_declaration = bool(re.search(r'--[\w-]+\s*:', line))
            if not is_var_declaration:
                allowed = bool(re.search(
                    r'border-radius\s*:\s*(0|0px|9999px|var\()',
                    line, re.IGNORECASE
                ))
                if not allowed:
                    flag('BORDER-RADIUS', filepath, i, line,
                         'Only 0 or 9999px (pill buttons) allowed — Design System rule')

        # 3 — box-shadow violations
        #     Allowed: box-shadow: none | var(--something)
        if 'box-shadow' in line_lower:
            is_var_declaration = bool(re.search(r'--[\w-]+\s*:', line))
            if not is_var_declaration:
                allowed = bool(re.search(
                    r'box-shadow\s*:\s*(none|var\()',
                    line, re.IGNORECASE
                ))
                if not allowed:
                    flag('BOX-SHADOW', filepath, i, line,
                         'Only box-shadow: none allowed — Design System rule')

        # 4 — Wrong fonts in widget files
        if is_widget:
            for font in WIDGET_BANNED_FONTS:
                if re.search(rf"['\"]?{re.escape(font)}['\"]?", line, re.IGNORECASE):
                    flag('WRONG FONT', filepath, i, line,
                         f'{font} not allowed in /widgets/ — use Lora (display) + DM Sans (body) only')

        # 5 — Banned phrases
        for phrase, fix in BANNED_PHRASES:
            if phrase.lower() in line_lower:
                flag('BANNED PHRASE', filepath, i, line, fix)

# ─────────────────────────────────────────────────────────────────
# RUN THE SCAN
# ─────────────────────────────────────────────────────────────────

for scan_dir in SCAN_DIRS:
    dir_path = Path(scan_dir)
    if not dir_path.exists():
        continue
    for filepath in sorted(dir_path.rglob('*')):
        if filepath.suffix in SCAN_EXTENSIONS and filepath.is_file():
            scan_file(filepath)

# ─────────────────────────────────────────────────────────────────
# REPORT
# ─────────────────────────────────────────────────────────────────

DIVIDER = '─' * 65

lines_out = [
    DIVIDER,
    'MY NEST CHAPTER — AUTOMATED QA REPORT',
    DIVIDER,
    f'Files scanned : {files_scanned}',
    f'Violations    : {len(violations)}',
    '',
]

if violations:
    # Group by category for readability
    by_category: dict = {}
    for v in violations:
        by_category.setdefault(v.category, []).append(v)

    for category in sorted(by_category.keys()):
        items = by_category[category]
        lines_out.append(f'[ {category} ] — {len(items)} violation{"s" if len(items) != 1 else ""}')
        lines_out.append('')
        for v in items:
            lines_out.append(f'  ✗  {v.filepath}  line {v.line_number}')
            lines_out.append(f'     Fix : {v.fix}')
            lines_out.append(f'     Code: {v.line_content}')
            lines_out.append('')

    lines_out += [
        DIVIDER,
        'Fix all violations above before deploying to Hostinger.',
        'The GitHub Action will go green once they are resolved.',
        DIVIDER,
    ]
else:
    lines_out += [
        '✓  All automated checks passed.',
        '',
        'Note: automated checks cover CSS rules, retired colors, and banned phrases.',
        'Claude Code session-end QA (Gates 1–3 in CLAUDE.md) still covers:',
        '  - Input validation and edge cases',
        '  - Mobile layout at 375px',
        '  - localStorage resilience',
        '  - Voice and template checks (requires judgment)',
        DIVIDER,
    ]

report = '\n'.join(lines_out)
print(report)

Path('qa-report.txt').write_text(report)

sys.exit(1 if violations else 0)
