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
# These must never appear anywhere. DESIGN.md §2 is the source of truth.
# ─────────────────────────────────────────────────────────────────

RETIRED_COLORS = [
    ('#811453', 'Deep Berry — retired May 2026'),
    ('#5e1337', 'Dark Berry — retired May 2026'),
    ('#a3918a', 'Muted Mauve — retired May 2026'),
    ('#d6c2b7', 'Warm Blush — retired May 2026'),
    ('#f8d4d4', 'Blush Pink — retired May 2026'),
    ('#f4e8c1', 'Warm Cream — retired May 2026'),
]

# Retired 2026-07-16, enforced only on site/ so far — every widget,
# including Garage Sale Planner (whose radius/shadow already matches the
# new standard, but whose colors don't yet), still uses these colors
# throughout (~200 occurrences total) and gets fixed as its own pass,
# not flagged as a CI failure in the meantime. This is a separate axis
# from NEW_STANDARD_WIDGET_FILES above (radius/shadow) — don't conflate
# "this widget's corners are already migrated" with "this widget's
# colors are already migrated," they migrate independently per-widget.
RETIRED_COLORS_TRANSITIONAL = [
    ('#c4b0e8', 'Lavender — retired as an accent 2026-07-16, use the Deep Rose Ramp instead'),
    ('#f5c4a8', 'Soft Peach — retired as an accent 2026-07-16, use the Deep Rose Ramp instead'),
    ('#fcf0e8', 'Peach Tint — retired 2026-07-16 alongside Soft Peach, use Deep Rose Ramp 50/100 instead'),
    ('#efa276', 'Peach Mid — retired 2026-07-16 alongside Soft Peach, use Deep Rose Ramp 300/400 instead'),
]

# ─────────────────────────────────────────────────────────────────
# WIDGET-ONLY FONT VIOLATIONS
# Lora (display) + DM Sans (body) only in /widgets/.
# Montserrat + Arial are for print PDFs only.
# ─────────────────────────────────────────────────────────────────

WIDGET_BANNED_FONTS = ['Montserrat', 'Arial']

# ─────────────────────────────────────────────────────────────────
# BORDER-RADIUS / BOX-SHADOW — TRANSITIONAL, mid-migration.
# Corrected 2026-07-16: moderate radius + soft shadow is now the
# sitewide target standard (was: zero-radius/zero-shadow) — see
# DESIGN.md §5.4. `site/` has been migrated to the new standard
# (2026-07-17). `widgets/` has NOT been migrated yet, including the
# Garage Sale Planner — despite its 2026-07-03/04 exception giving it
# a head start (it already uses --radius-lg tokens in places), it also
# has several deliberate `box-shadow: none` flat-card-with-border
# patterns that aren't accidental omissions and don't match §5.4's
# soft-shadow spec exactly. Assuming it was "already compliant" without
# actually checking was wrong (2026-07-17) — every widget, this one
# included, needs its own real review pass before joining this list.
#
# When a widget is migrated, add it to NEW_STANDARD_WIDGET_FILES.
# NOT YET MIGRATED: garage-sale-planner, 6pm-experience,
# know-before-you-sell, cooking-for-one, empty-nester-quiz,
# someday-list, coloring-widget.
# ─────────────────────────────────────────────────────────────────

NEW_STANDARD_WIDGET_FILES = []

# Line-scoped exemption (not file-scoped): workbook.php's 3D book-cover
# mockup graphic needs literal square corners to look like a real book —
# a representational-accuracy judgment call, not a UI card/button.
ZERO_RADIUS_EXEMPT_LINES = {
    ('site/workbook.php', 144),  # 3D book mockup front cover face
    ('site/workbook.php', 155),  # 3D book mockup spine face
}

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
    on_new_radius_standard = (not is_widget) or filepath.as_posix() in NEW_STANDARD_WIDGET_FILES

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
        if not is_widget:
            for hex_val, label in RETIRED_COLORS_TRANSITIONAL:
                if hex_val in line_lower:
                    flag('RETIRED COLOR', filepath, i, line,
                         f'{label} — replace with a Deep Rose Ramp color')

        # 2 — border-radius violations
        #     Corrected 2026-07-16: moderate radius is now the standard for
        #     site/ and any widget listed in NEW_STANDARD_WIDGET_FILES.
        #     Allowed there: 6–10px (cards/buttons/inputs), 9999px
        #     (tags/badges/pills), 50% (circular elements), var(--something).
        #     Flat 0/0px is now the violation — see DESIGN.md §5.4.
        #     Not-yet-migrated widgets still get the OLD rule (0/9999px only)
        #     so CI doesn't fail on pre-existing, not-yet-touched code.
        if 'border-radius' in line_lower and (filepath.as_posix(), i) not in ZERO_RADIUS_EXEMPT_LINES:
            # Skip CSS variable declarations (--variable-name: value)
            is_var_declaration = bool(re.search(r'--[\w-]+\s*:', line))
            if not is_var_declaration:
                if on_new_radius_standard:
                    allowed = bool(re.search(
                        r'border-radius\s*:\s*([6-9]px|10px|9999px|50%|var\()',
                        line, re.IGNORECASE
                    ))
                    if not allowed:
                        flag('BORDER-RADIUS', filepath, i, line,
                             'Use 6–10px (cards/buttons/inputs) or 9999px (tags/badges) — Design System rule, corrected 2026-07-16')
                else:
                    allowed = bool(re.search(
                        r'border-radius\s*:\s*(0|0px|9999px|50%|var\()',
                        line, re.IGNORECASE
                    ))
                    if not allowed:
                        flag('BORDER-RADIUS', filepath, i, line,
                             'This widget has not been migrated to the new radius standard yet — only 0, 9999px, or 50% (circles) allowed until it is')

        # 3 — box-shadow violations
        #     Corrected 2026-07-16, site/ and migrated widgets only: cards
        #     should carry the standard soft elevation shadow. box-shadow:
        #     none is now the violation — see DESIGN.md §5.4.
        #     KNOWN GAP (2026-07-17): unlike border-radius above, this does
        #     NOT re-check not-yet-migrated widgets against the old
        #     box-shadow:none rule. Garage Sale Planner already has several
        #     legitimate real shadow values (e.g. widget.html:273) mixed in
        #     with old-style flat cards, so neither the old rule nor the new
        #     rule cleanly fits it yet — that needs its own migration
        #     decision, not a blind check either way. Restore proper old-rule
        #     box-shadow checking for the OTHER (non-Garage-Sale-Planner)
        #     widgets when doing their migration pass.
        if 'box-shadow' in line_lower and on_new_radius_standard:
            is_var_declaration = bool(re.search(r'--[\w-]+\s*:', line))
            if not is_var_declaration:
                is_none = bool(re.search(r'box-shadow\s*:\s*none\b', line, re.IGNORECASE))
                if is_none:
                    flag('BOX-SHADOW', filepath, i, line,
                         'box-shadow: none is now the violation — cards should carry the standard soft shadow 0 10px 40px rgba(37,37,53,0.07). Design System rule, corrected 2026-07-16')

        # 4 — Wrong fonts in widget files
        # 6pm-experience is exempt: cinematic full-screen widget, predates font rule
        is_6pm_exempt = '6pm-experience' in str(filepath)
        if is_widget and not is_6pm_exempt:
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

VENDOR_DIR_NAMES = {'phpmailer', 'vendor', 'node_modules'}

for scan_dir in SCAN_DIRS:
    dir_path = Path(scan_dir)
    if not dir_path.exists():
        continue
    for filepath in sorted(dir_path.rglob('*')):
        if filepath.suffix in SCAN_EXTENSIONS and filepath.is_file():
            if VENDOR_DIR_NAMES.intersection(p.lower() for p in filepath.parts):
                continue
            if 'DRAFT' in filepath.name.upper():
                continue
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
