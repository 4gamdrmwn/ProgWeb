# Jobsheet 8 Documentation — PostgreSQL Connection

This documentation continues from
[jobsheet-07 documentation](../../jobsheet-07/Documentation/README.md)
(Basic PHP & Form Handling). Jobsheet-08 closes one important "gap"
already touched on repeatedly in previous documentation: data that
**truly stays saved**, not lost once the browser session ends.

## About `docs/wireframe.md`

This file is **identical** to
[`docs/wireframe.md` in jobsheet-07](../../jobsheet-07/docs/wireframe.md) —
there's no new UI/UX design in this jobsheet.

## Why Does This Matter?

Recall the note that has come up repeatedly since
[jobsheet-07 documentation §3.5](../../jobsheet-07/Documentation/03-session-and-data-flow.md#35-why-is-this-data-temporary):
data in `$_SESSION` **is lost** once the browser session ends.
Jobsheet-08 replaces the data source from `$_SESSION` with a real
**PostgreSQL database** — data you add now will **remain** even if you
close the browser, shut down your computer, or come back tomorrow.

## What's New in Jobsheet 8?

Per this jobsheet's [README.md](../README.md):

1. **`sql/01_books_members.sql`** — the database schema: SQL commands
   to create the `books` and `members` tables.
2. **`includes/connection.php`** — PHP code that connects the
   application to the PostgreSQL database, using **PDO**.
3. **`process_add.php`** (books & members) — `$_SESSION['books'][] = ...`
   from jobsheet-07 replaced with `INSERT ... RETURNING id` via a
   **prepared statement**.
4. **`list.php`** (books & members) — data source changed from
   `$_SESSION` to `SELECT * FROM ... ORDER BY id DESC`.
5. **`index.php`** — the Total Books/Members stat cards now use
   `SELECT COUNT(*)` from a real database, no longer dummy/session data.

## Table of Contents

1. [Basic Database & SQL Concepts](01-basic-database-sql-concepts.md)
2. [Database Schema: `01_books_members.sql`](02-database-sql-schema.md)
3. [Database Preparation Before Running](03-database-preparation.md)
4. [PHP Connection to the Database: `connection.php`](04-pdo-connection.md)
5. [Saving Data: Prepared Statement & `INSERT`](05-insert-prepared-statement.md)
6. [Reading Data: `SELECT`](06-reading-data-select.md)
7. [Summary & Further Exercises](07-summary-and-exercises.md)
8. [Appendix: Installing PostgreSQL on Laragon (Windows)](08-postgresql-installation-laragon.md)

## Folder Structure

```
jobsheet-08/
├── index.php                      # Stat cards from SELECT COUNT(*)
├── includes/
│   ├── header.php, footer.php      # Unchanged from jobsheet-07
│   └── connection.php               # NEW — PDO connection to PostgreSQL
├── sql/
│   └── 01_books_members.sql         # NEW — books & members table schema
├── books/
│   ├── list.php                     # SELECT * FROM books, no longer $_SESSION
│   ├── add.php                      # Unchanged from jobsheet-07
│   └── process_add.php              # INSERT via prepared statement
├── members/
│   ├── list.php
│   ├── add.php
│   └── process_add.php              # INSERT via prepared statement
├── docs/wireframe.md                 # Identical to jobsheet-07
├── README.md
└── Documentation/                     # This documentation folder
```

**Important note** from this jobsheet's [README.md](../README.md):

- Queries here use a **prepared statement** (`:parameter_name`),
  rather than concatenating raw strings — this is a security
  foundation that will be deepened in Jobsheet 11.
- The `id` column is already fetched via `SELECT *`, even though it's
  not yet used in the view — it will be used for Edit/Delete links
  starting in Jobsheet 9.
- **This jobsheet needs extra preparation** (installing/running
  PostgreSQL, creating a database) before it can be tried — covered
  fully in [chapter 3](03-database-preparation.md).
