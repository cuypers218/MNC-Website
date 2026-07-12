# Exclusive Content Drip System — Claude Code Brief
**Date:** June 21, 2026
**Touches:** dashboard.php, products DB, member accounts, email (Hostinger Reach)

## What this is

Right now the Member Dashboard has no exclusive content section — this brief builds one. The model: every member gets their own personal 30-day drip of exclusive freebies, starting the day they sign up, running for as long as they're a member. No two members are ever on the same schedule unless they happened to sign up the same day.

## The rules (locked by Cece, June 21 2026)

1. **On signup:** member immediately gets the 3 existing public freebies (6pm Cheat Sheet, Pick Your Mood Coloring Pages, Someday List Builder) with no email gate at all — being a member is the gate. They also immediately unlock the first exclusive item: **The 6pm Survival Plan**.
2. **Every 30 days after their personal signup date**, the next item in the exclusive queue unlocks for them. Day 0 = item 1 (6pm Survival Plan), day 30 = item 2 (Who Am I Now), day 60 = item 3, and so on.
3. **This is per-member, not calendar-based.** Someone who signs up today and someone who signs up two years from now both get item 1 on day 0 and item 2 on day 30 of *their own* membership. Nobody's schedule depends on anybody else's or on a fixed date.
4. **No catch-up acceleration.** A member who joins after item 5 already exists doesn't get items 1–5 faster — they go through the same 30-day-per-item pace as everyone else, even though the content already exists.
5. **This runs indefinitely.** It is not capped at the current 7-item queue. As long as a member stays subscribed, they keep getting a new item every 30 days, forever — which means Cece needs to keep adding new items to the queue indefinitely to honor this for long-term members. (Flagged to Cece directly — she's aware this is an ongoing content commitment, not a one-time build.)
6. **If a member's unlock day arrives and the next queue item doesn't exist yet** (Cece hasn't built it/added it to the queue), show a graceful fallback — never an error or a blank space.
7. **Notifications:** both dashboard display AND an email when a new item unlocks.
8. **If a member cancels/unsubscribes**, the drip stops. (See open question below on what "unsubscribe" means in this context.)

## Data model needed

**Members table** — needs (if not already present): `signup_date` (timestamp, already likely exists from account creation).

**New table: `exclusive_content_queue`**
| Column | Type | Notes |
|---|---|---|
| id | int, PK | |
| sequence_number | int | 1, 2, 3... determines order |
| title | varchar | e.g. "The 6pm Survival Plan" |
| file_path | varchar | path to the PDF |
| unlock_offset_days | int | days after signup this unlocks (0, 30, 60, 90...) — store explicitly rather than computing from sequence_number, in case spacing ever needs to change |
| created_at | timestamp | |

**New table: `member_freebie_notifications`** (tracks what's already been emailed, so the daily check doesn't re-send)
| Column | Type | Notes |
|---|---|---|
| member_id | int, FK | |
| queue_item_id | int, FK | |
| emailed_at | timestamp | null until sent |

## Logic

**Unlocked items for a member at any moment:**
```
days_as_member = today - member.signup_date
unlocked_items = all rows in exclusive_content_queue WHERE unlock_offset_days <= days_as_member
next_item = the queue row with the smallest unlock_offset_days that is > days_as_member
```

**Countdown card on dashboard:**
- If `next_item` exists: show "Next exclusive freebie unlocks in: [countdown to signup_date + next_item.unlock_offset_days]"
- If `next_item` does NOT exist (member has unlocked everything currently in the queue, i.e. they've caught up to the front of what Cece has built): show fallback message — "You're all caught up. Your next exclusive freebie is on its way." No broken countdown, no countdown to nothing.

**Daily scheduled check (cron or equivalent):**
- For every member, check if `days_as_member` matches an `unlock_offset_days` in the queue exactly (i.e. something unlocked today).
- If yes and no row exists yet in `member_freebie_notifications` for that member + queue item, send the unlock email via Hostinger Reach and log it.

## Dashboard display

- Public freebies (3): always visible, direct download, no gate, no countdown — these aren't part of the drip, they're immediate member perks.
- Exclusive freebies: shown as a list/grid of cards, one per unlocked item, each a direct download.
- Countdown card: sits next to/near the exclusive freebies section, always shows the member's personal next-unlock countdown (or the fallback message described above).

## Build order

1. ✅ COMPLETED June 2026 — `exclusive_content_queue` table created and seeded: The 6pm Survival Plan (offset 0) and Who Am I Now (offset 30) both have rows in DB.
2. Create `member_freebie_notifications` table.
3. Build the unlock logic (a function that takes a member ID and returns unlocked items + next unlock date).
4. Build the dashboard UI: public freebies section (no gate), exclusive freebies section (gated by unlock logic), countdown card with fallback state.
5. Build the daily email check and wire it to Hostinger Reach.
6. Test with a fake member record set to different signup dates (today, 30 days ago, 65 days ago, 300 days ago with only 2 items in queue) to confirm the unlock math and fallback state both work correctly.

## Open question for Cece before/during build

"Unsubscribe" needs a definition — does this mean: (a) the member deletes/cancels their account entirely, or (b) they opt out of *email* notifications specifically but stay a member and still see unlocks on the dashboard? These need different handling. Flag back to Cece if this isn't already clear from existing account infrastructure.
