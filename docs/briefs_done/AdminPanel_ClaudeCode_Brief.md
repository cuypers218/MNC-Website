# My Nest Chapter — Admin Panel Build Brief
**For: Claude Code in VS Code**
**Date: June 24, 2026**
**Status: Ready to build**

---

## FIRST: Read these files before touching anything

1. `CLAUDE.md` — decision log, live page list, locked decisions
2. `YNC_Brand_SKILL_v4_June2026.md` — brand colors, fonts, banned words

---

## WHAT WE'RE BUILDING

A password-protected admin control panel that lives at `mynestchapter.com/admin/`. This is for Cece only — not visible to members, not linked from the public site anywhere. It gives her full control over products, blog posts, exclusive content, members, orders, files, and quiz results without touching code or Hostinger's database manager directly.

**8 sections:**
1. Dashboard — stats + action items checklist
2. Products — add, edit, toggle active/hidden
3. Blog Posts — write, edit, publish/draft
4. Exclusive Content Queue — manage the member drip sequence
5. Members — read-only list with purchase count
6. Orders — full purchase history with search
7. File Manager — list and upload downloadable files
8. Quiz Results — Nester / Busy-er / Wonderer breakdown totals

---

## SECURITY — READ THIS CAREFULLY

The admin panel uses its OWN session variable, completely separate from the member login session.

- Member session: `$_SESSION['user_id']` (already exists)
- Admin session: `$_SESSION['mnc_admin']` (new — only set by the admin login)

A logged-in member is NOT an admin. Never mix these. A logged-in admin is also not automatically a member. Two completely separate auth layers.

**Password storage:** Store the admin password as a hashed value in `site/admin/config.php`. Use PHP's `password_hash()` to generate the hash, and `password_verify()` to check it at login. Never store the password in plain text.

**Config file structure (`site/admin/config.php`):**
```php
<?php
// Change this password before going live.
// To generate a new hash: echo password_hash('your-new-password', PASSWORD_DEFAULT);
define('ADMIN_PASSWORD_HASH', 'REPLACE_WITH_HASH_AT_BUILD_TIME');
define('ADMIN_SESSION_KEY', 'mnc_admin');
define('ADMIN_SESSION_VALUE', 'authenticated');
?>
```

After building, tell Cece: "Run this one line in a test PHP file to generate your hash, then paste it into config.php:
`echo password_hash('your-chosen-password', PASSWORD_DEFAULT);`"

---

## FILE STRUCTURE

Create this directory and file structure inside the repo:

```
site/
  admin/
    index.php          — login page (redirects to dashboard if already logged in)
    logout.php         — destroys admin session, redirects to login
    config.php         — password hash + session constants (see above)
    auth.php           — include file: checks admin session, dies with redirect if missing
    dashboard.php      — main panel — all sections rendered via ?page= parameter
    sections/
      stats.php        — Dashboard section
      products.php     — Products section
      blog.php         — Blog Posts section
      queue.php        — Exclusive Content Queue section
      members.php      — Members section
      orders.php       — Orders section
      files.php        — File Manager section
      quiz.php         — Quiz Results section
    ajax/
      save-product.php
      toggle-product.php
      save-post.php
      save-queue-item.php
      upload-file.php
```

---

## DATABASE

**Connection:** Match the existing DB connection pattern already in the site (check how `dashboard.php` or other pages connect). DB details from CLAUDE.md:
- Host: `localhost`
- Database: `u540670132_nest_chapter`

**Before writing any SQL:** Run `SHOW TABLES;` and `DESCRIBE users;` and `DESCRIBE products;` to confirm actual column names. Do not assume — the foreign keys in new tables must match whatever is actually in the live schema.

### Tables that must exist (CREATE IF NOT EXISTS for all of these)

**`purchases`** — may already exist from a previous build:
```sql
CREATE TABLE IF NOT EXISTS purchases (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  product_id INT NOT NULL,
  stripe_session_id VARCHAR(255),
  purchased_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

**`exclusive_content_queue`** — from the ExclusiveContentDrip brief:
```sql
CREATE TABLE IF NOT EXISTS exclusive_content_queue (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sequence_number INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  file_path VARCHAR(500),
  unlock_offset_days INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

**`quiz_results`** — new, needed for the Quiz Results section:
```sql
CREATE TABLE IF NOT EXISTS quiz_results (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  result_type ENUM('nester', 'busyer', 'wonderer') NOT NULL,
  taken_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

**`blog_posts`** — may already exist. If it does, use the existing schema. If it doesn't:
```sql
CREATE TABLE IF NOT EXISTS blog_posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(500) NOT NULL,
  slug VARCHAR(500) NOT NULL UNIQUE,
  body LONGTEXT,
  status ENUM('draft', 'published') DEFAULT 'draft',
  social_image VARCHAR(500),
  published_at DATETIME,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

**After creating tables:** Seed `exclusive_content_queue` with the two items that already exist:
```sql
INSERT IGNORE INTO exclusive_content_queue (sequence_number, title, file_path, unlock_offset_days)
VALUES
  (1, 'The 6pm Survival Plan', '/downloads/exclusive/freebie_6pm_survival_plan.pdf', 0),
  (2, 'Who Am I Now?', '/downloads/exclusive/freebie_who_am_i_now.pdf', 30);
```

---

## DESIGN SYSTEM

**Fonts (admin panel uses site fonts, not HTML tool fonts):**
- Headlines: Montserrat ExtraBold (load from Google Fonts if not already in the admin)
- Body / labels / table text: Arial

**Colors:**
- Background: `#f5f4f0` (light gray page bg)
- Sidebar: `#252535` (Velvety Charcoal)
- Primary accent: `#E87AAA` (Vibrant Pink) — active nav, primary buttons, alerts
- Secondary accent: `#8BA7D4` (Periwinkle) — stat card borders, info callouts
- Supporting: `#C4B0E8` lavender, `#F2A57A` peach, `#B5CC6A` lime, `#EDD96A` lemon
- Content background: `#ffffff`
- Vanilla Cream: `#FFF8EE` — modal backgrounds, login card

**Rules (non-negotiable):**
- Zero `border-radius` anywhere
- Zero `box-shadow` anywhere
- No emojis in rendered UI elements
- No retired colors: no `#811453`, no `#5E1337`, no berry shades, no warm cream `#F4E8C1`

**Layout:** Left sidebar (210px wide, charcoal) + main content area. Sidebar nav items highlight in pink on active section. Section switching via `?page=` GET parameter. Default page = dashboard stats.

---

## SECTION SPECS

### 1. DASHBOARD (default — `?page=dashboard` or no page param)

**Stat cards (pull live from DB):**
- Total members: `SELECT COUNT(*) FROM users`
- Products live: `SELECT COUNT(*) FROM products WHERE status = 'active'` (adjust column name to match actual schema)
- Total orders: `SELECT COUNT(*) FROM purchases`
- Total revenue: `SELECT SUM(p.price) FROM purchases pu JOIN products p ON pu.product_id = p.id`
- Blog posts published: `SELECT COUNT(*) FROM blog_posts WHERE status = 'published'`
- Queue items built: `SELECT COUNT(*) FROM exclusive_content_queue`

**Action items checklist:** Hardcoded list of known open items from CLAUDE.md. Display as checkboxes — but these are display-only, not functional checkboxes (Cece uses these as a visual reminder, not a tracking tool). Pull from the CLAUDE.md ACTION ITEMS list at build time and hardcode them. Include:
- Upload thumbnail images for: 6pm Cheat Sheet, Coloring Pages, Someday List Builder
- Build Exclusive Content section on dashboard.php
- Add Slot 3 to exclusive content drip queue
- Fix banned phrase in Quiet House Meter description (site/index.php line ~429)
- Fix banned word "Carried" in workbook.php line ~722

---

### 2. PRODUCTS (`?page=products`)

**List view:** Table showing all rows from `products` table. Columns: Name, Price, Type, Status, Actions.

**Add product form (modal or inline section below table):**
- Product Name (text)
- Price (text — e.g. "27.00"; leave blank = free)
- Product Type (select: Interactive Tool / PDF Download / Amazon KDP)
- Short Description (textarea)
- Thumbnail Image (file upload — save to `/uploads/thumbnails/`)
- File Path or URL (text — where the download lives)
- Stripe Product ID (text, optional)
- Set as Active immediately (checkbox, checked by default)

**Edit product:** Same form, pre-populated. Save updates the DB row.

**Toggle active/hidden:** Button on each row. Toggles the `status` column between `active` and `draft` (or whatever the actual column values are — check live schema first).

**Thumbnail flag:** If a product has no thumbnail image, show a warning indicator on that row.

---

### 3. BLOG POSTS (`?page=blog`)

**If `blog_posts` table already exists and blog is already built:** Match the existing schema exactly — don't introduce new columns. Read from and write to whatever is there.

**If blog_posts table does not exist:** Use the CREATE TABLE statement above.

**List view:** Title, Status badge, Published date, Edit button.

**Add post form:**
- Title (text)
- URL Slug (text — auto-generate from title, allow override; must be URL-safe)
- Body (textarea — large; future enhancement would be a rich text editor but textarea is fine for now)
- Social Image (file upload — `/uploads/blog/`)
- Publish immediately (checkbox — if checked, sets status = 'published' and published_at = NOW(); if unchecked, saves as draft)

**Edit post:** Same form, pre-populated. Save updates the row. Include a "Publish" / "Unpublish" toggle button separate from the form.

---

### 4. EXCLUSIVE CONTENT QUEUE (`?page=queue`)

**Explanation callout at top of section (display-only text):**
"Each item unlocks for a member based on how many days they've been a member. Item 1 unlocks on Day 0 (the day they sign up), Item 2 on Day 30, Item 3 on Day 60, and so on. This runs indefinitely — keep adding items so long-term members always have something coming."

**List view:** Sequence #, Title, File path, Unlock day offset, Edit button. Flag rows where file_path is empty.

**Add item form:**
- Title (text)
- PDF Upload (file — save to `/downloads/exclusive/`)
- Sequence Number (number — determines order)
- Unlock Day Offset (number — 0 = signup day, 30 = 1 month in, 60 = 2 months in, etc.)

**Edit item:** Same fields, pre-populated.

---

### 5. MEMBERS (`?page=members`)

**Read-only.** No delete button — Cece deletes via Hostinger DB manager if ever needed.

**List view:** Name (or email if no name column), Email, Join date (`created_at` from users table), Purchase count (subquery from purchases table).

**No search needed** at this stage — member list is small enough to scroll.

---

### 6. ORDERS (`?page=orders`)

**List view:** Customer name, Email, Product name, Amount, Purchase date, Stripe session ID.

**Search bar at top:** Filters the table in real-time (PHP — reloads with `?page=orders&q=searchterm`). Searches across email, name, and product name.

**Running totals at bottom:** Total orders count + total revenue sum.

**How to query:**
```sql
SELECT 
  u.name, u.email,
  p.name AS product_name,
  p.price,
  pu.stripe_session_id,
  pu.purchased_at
FROM purchases pu
JOIN users u ON pu.user_id = u.id
JOIN products p ON pu.product_id = p.id
ORDER BY pu.purchased_at DESC
```
Adjust column names to match actual schema.

---

### 7. FILE MANAGER (`?page=files`)

**Purpose:** See what downloadable files are currently live on the server, and upload new files, without leaving the admin panel.

**Folders to list** (Claude Code: confirm these actual paths exist on the Hostinger server by checking where existing downloads live):
- `/downloads/products/`
- `/downloads/freebies/`
- `/downloads/exclusive/`

For each folder: list all files with filename, file size, last modified date, and a "Replace" button (which is just another file upload that overwrites the existing file with the same name).

**Upload new file form:**
- File input (PDF only, max 20MB)
- Destination folder (select: products / freebies / exclusive)
- Filename (text — lowercase, hyphens only, .pdf extension)
- On submit: `move_uploaded_file()` to the selected folder

**Security:** Only allow `.pdf` file uploads. Reject anything else.

---

### 8. QUIZ RESULTS (`?page=quiz`)

**Query:**
```sql
SELECT result_type, COUNT(*) as count FROM quiz_results GROUP BY result_type
```

**Display:** Three stat cards (Nester count, Busy-er count, Wonderer count) + a horizontal bar chart showing percentages. The bar chart is CSS-only — no JavaScript library needed. Bar width = percentage of total takers.

**Also show:** Total quiz takers, and how many members in the `users` table have NOT taken the quiz yet (total members minus total quiz takers).

**Interpretation callout:** One plain-language sentence after the chart explaining what the biggest segment means for content strategy. Example: "The Nester is your biggest segment at X% — content about reclaiming home, routines, and space will land broadest." Generate this dynamically based on whichever result_type has the highest count.

**If quiz_results table is empty:** Show "No quiz results yet. Once members take the quiz and results are recorded, they'll appear here." — do not show broken charts or zero-division errors.

---

## LOGIN PAGE (`site/admin/index.php`)

Simple centered card on a charcoal background:
- "My Nest Chapter" in pink (small, uppercase)
- "Admin Panel" as the headline
- Password field
- Sign In button
- On submit: check password with `password_verify()` against the stored hash in config.php
- On success: set `$_SESSION['mnc_admin'] = 'authenticated'` and redirect to `dashboard.php?page=dashboard`
- On failure: show "Incorrect password." below the field — no hint about username or what went wrong

---

## AUTH INCLUDE (`site/admin/auth.php`)

Every section file and dashboard.php must include this at the very top:

```php
<?php
require_once __DIR__ . '/config.php';
session_start();
if (!isset($_SESSION[ADMIN_SESSION_KEY]) || $_SESSION[ADMIN_SESSION_KEY] !== ADMIN_SESSION_VALUE) {
    header('Location: /admin/index.php');
    exit;
}
?>
```

---

## LOGOUT (`site/admin/logout.php`)

```php
<?php
session_start();
session_destroy();
header('Location: /admin/index.php');
exit;
?>
```

---

## BUILD ORDER

Do these in sequence. Confirm each step is working before moving to the next.

1. Create the `/site/admin/` folder structure
2. Write `config.php` with placeholder hash and note for Cece to replace it
3. Write `auth.php`
4. Write `index.php` (login page)
5. Write `logout.php`
6. Run `SHOW TABLES` and `DESCRIBE` on users + products — confirm actual column names before any joins
7. Run CREATE TABLE IF NOT EXISTS for: purchases, exclusive_content_queue, quiz_results, blog_posts
8. Seed exclusive_content_queue with the 2 existing items
9. Build `dashboard.php` shell with sidebar nav and section switcher
10. Build sections one at a time in this order: stats — products — blog — queue — members — orders — files — quiz
11. Run brand QA (colors, fonts, no border-radius, no box-shadow, no banned words)
12. Commit and push to GitHub
13. Test every section on the live site

---

## BRAND QA CHECKLIST — RUN BEFORE COMMITTING

- [ ] No `border-radius` anywhere in admin CSS
- [ ] No `box-shadow` anywhere in admin CSS
- [ ] No retired colors (`#811453`, `#5E1337`, `#F4E8C1`, or any berry/mauve/blush shades)
- [ ] Fonts: Montserrat ExtraBold for headings, Arial for body text
- [ ] All form save buttons say "Save Changes" — not "Submit" or "Update"
- [ ] No banned copy ("fluff," "journey," "no judgment," "what you carried," "zero judgment")
- [ ] Admin session (`mnc_admin`) is completely independent from member session (`user_id`)
- [ ] File upload only accepts `.pdf` — no other file types
- [ ] All sections handle empty states gracefully (no PHP errors when tables are empty)
- [ ] Admin panel is not linked from any public page

---

## AFTER BUILD — TELL CECE

Confirm these URLs work and show Cece exactly:
1. `mynestchapter.com/admin/` — should show login screen
2. After logging in — should land on Dashboard with live stats
3. How to set her admin password (run the `password_hash()` line, paste result into config.php)
4. How to get back to the admin panel in the future (bookmark the URL — it's not linked from anywhere)

---

## PASTE THIS INTO CLAUDE CODE TO START

"Read CLAUDE.md at the repo root first. Then read this entire file: `AdminPanel_ClaudeCode_Brief.md`. Build the admin panel exactly as specified. Start by running SHOW TABLES and DESCRIBE on the users and products tables so you know the actual column names before writing any SQL joins. Build in the order specified in the BUILD ORDER section. Confirm each section is working before moving to the next. When complete, give me the live URL to test and tell me how to set my admin password."
