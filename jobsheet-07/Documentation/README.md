# Jobsheet 7 Documentation — Basic PHP & Form Handling

This documentation continues from
[jobsheet-06 documentation](../../jobsheet-06/Documentation/README.md)
(Fetch API & JSON). Jobsheet-07 is the **biggest milestone** in
SIMPUS-Mini's journey so far: the application shifts from running
entirely in the **browser** (static HTML/CSS/JS) to an application with
a **real server** behind it, using **PHP**.

## About `docs/wireframe.md`

This file is **identical** to
[`docs/wireframe.md` in jobsheet-06](../../jobsheet-06/docs/wireframe.md) —
there's no new UI/UX design in this jobsheet. Read
[jobsheet-04 documentation](../../jobsheet-04/Documentation/README.md) if
you need to refresh your memory on the wireframe & user flow.

## Why Is This a Big Change?

Every previous jobsheet (01-06) could be run just by **opening the file
in a browser** — even jobsheet-06, which needed a local server, only
used that server to serve static files (HTML, CSS, JS, JSON) as-is,
without processing anything. In jobsheet-07, for the **first time**,
there's code that actually **runs on the server** before the page is
sent to the browser: PHP processes data, makes decisions (e.g. "is this
form valid?"), and **generates** different HTML depending on the
situation (e.g. showing an error message or not) — not just sending a
pre-made HTML file as-is like previous jobsheets.

## What's New in Jobsheet 7?

Per this jobsheet's [README.md](../README.md):

1. All `.html` pages converted to **`.php`**.
2. Two new files, `includes/header.php` and `includes/footer.php`,
   avoid duplicating the navbar/footer via `include`.
3. CSS/JS/menu paths in `includes/header.php`/`footer.php` are computed
   **automatically relative** via the `$base` variable (see
   [chapter 2 §2.3](02-includes-header-footer.md#23-automatic-relative-paths-in-includesheaderphp)),
   so they remain correct when shared by pages at different folder
   depths.
4. The Add Book/Member forms now truly **send data** to
   `process_add.php` (no longer an empty form without an `action` like
   since jobsheet-01).
5. `process_add.php` validates data on the **server**, saves it to
   `$_SESSION`, then redirects to the list page.
6. `list.php` renders the table from `$_SESSION`, replacing the
   `fetch`/JSON approach in jobsheet-06.
7. **Flash message** — a success/failure message that appears once
   after a redirect.
8. `assets/js/books.js`, `assets/js/members.js`, and the `data/` folder
   from jobsheet-06 are **removed** — no longer needed because
   rendering has moved to the server.

## Table of Contents

1. [Basic PHP Concepts](01-basic-php-concepts.md)
2. [`includes/header.php` & `includes/footer.php`](02-includes-header-footer.md)
3. [Session & Data Flow](03-session-and-data-flow.md)
4. [Processing the Form: `process_add.php`](04-process-add-server-validation.md)
5. [Displaying Data: `list.php` & Flash Message](05-list-php-render-and-flash.md)
6. [CSS: Flash Message Style](06-css-flash-message.md)
7. [Summary & Further Exercises](07-summary-and-exercises.md)

## Folder Structure

```
jobsheet-07/
├── index.php                   # Home, now a PHP file
├── includes/
│   ├── header.php               # NEW — HTML top + navbar, reused
│   └── footer.php               # NEW — HTML bottom + footer, reused
├── assets/
│   ├── css/style.css            # Added .flash style
│   └── js/app.js                 # Unchanged from jobsheet-06
├── books/
│   ├── list.php                  # Rendered from $_SESSION, no longer fetch/JSON
│   ├── add.php                   # Form now has method="post" & action
│   └── process_add.php           # NEW — server validation + save to $_SESSION
├── members/
│   ├── list.php
│   ├── add.php
│   └── process_add.php           # NEW
├── docs/wireframe.md              # Identical to jobsheet-06
├── README.md
└── Documentation/                 # This documentation folder
```

**Important note** from this jobsheet's [README.md](../README.md) worth
remembering from the start: data stored in `$_SESSION` **will be lost**
once the browser session ends (closing the browser, or the session
expiring) — this is a **temporary** bridge toward real storage.
Starting in Jobsheet 8, data will move to a PostgreSQL database for
true, permanent storage.
