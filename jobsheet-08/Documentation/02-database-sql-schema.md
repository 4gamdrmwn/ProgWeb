# 2. Database Schema: `01_books_members.sql`

This file is the **blueprint** (schema) of the database structure — the
SQL commands that determine which tables exist and each column's rules.

## 2.1 Full Code

```sql
-- Jobsheet 8: initial schema for the simpus_mini database (PostgreSQL)
-- Run this after creating the database, e.g.:
--   createdb simpus_mini
--   psql -d simpus_mini -f sql/01_books_members.sql

CREATE TABLE IF NOT EXISTS books (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    year INTEGER NOT NULL,
    isbn VARCHAR(50),
    stock INTEGER NOT NULL DEFAULT 0,
    category VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS members (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    member_id VARCHAR(50) NOT NULL UNIQUE,
    address VARCHAR(255),
    phone VARCHAR(30)
);
```

## 2.2 SQL Comments

```sql
-- Jobsheet 8: initial schema for the simpus_mini database (PostgreSQL)
```

A line starting with **two hyphens** (`--`) is an **SQL comment** — not
executed at all, purely a note for whoever reads the code (similar to
the function of `<!-- ... -->` in HTML you've known since
[jobsheet-06 documentation §2.1](../../jobsheet-06/Documentation/02-html-file-changes.md#21-the-tbody-is-now-empty),
or `//` in JavaScript/PHP).

## 2.3 `CREATE TABLE IF NOT EXISTS`

```sql
CREATE TABLE IF NOT EXISTS books (
    ...
);
```

- **`CREATE TABLE table_name (...)`** — the SQL command to create a new
  table named `books`, with the column structure defined inside the
  parentheses.
- **`IF NOT EXISTS`** — a safeguard: if the `books` table **already
  exists** (e.g. you accidentally ran this file twice), this command
  **won't error** — it will simply skip it, rather than trying to
  recreate a table that already exists (which would actually fail and
  wipe out existing data without this safeguard).

## 2.4 Defining Columns: Name, Type, and Constraints

Each line inside the `CREATE TABLE` parentheses defines **one column**,
following the pattern: `column_name DATA_TYPE [additional constraints]`.

### `id SERIAL PRIMARY KEY`

- **`SERIAL`** — a PostgreSQL-specific data type for a **self-
  incrementing number** (*auto-increment*): every time a new row is
  added, PostgreSQL itself fills in the `id` value (1, 2, 3, and so
  on), you **don't need** to set it manually.
- **`PRIMARY KEY`** — marks this column as the **primary key**: its
  value **must be unique** (no two rows can share the same `id`) and
  **must always be present** (cannot be empty). Every well-designed
  table usually has one primary key column — the most reliable way to
  refer to **one specific row**, which will be used for Edit/Delete
  features starting in Jobsheet 9 (recall the note in this jobsheet's
  [README.md](../README.md)).

### `title VARCHAR(255) NOT NULL`

- **`VARCHAR(255)`** — a data type for **text**, with a **maximum**
  length of 255 characters (`VARCHAR` = *variable character*, meaning
  the actual length may be shorter than the maximum, unlike `CHAR`
  which always uses a fixed length). Recall the text columns you've
  known since
  [jobsheet-01 documentation](../../jobsheet-01/Documentation/04-books-add-html.md#44-types-of-input-used):
  `title`, `author`, `isbn`, `category` are all `VARCHAR` type because
  their content is text.
- **`NOT NULL`** — a constraint requiring this column to **always be
  filled in**, cannot be empty/`NULL` (the database term for "no value
  at all," different from an empty string `""`). Notice this
  **matches** the `required` attribute on `<input>` you've known since
  [jobsheet-01 documentation §4.4](../../jobsheet-01/Documentation/04-books-add-html.md#44-types-of-input-used) —
  the `title`, `author` columns here are both `NOT NULL`, consistent
  with the `title`/`author` fields that have always been required from
  the start.

### `year INTEGER NOT NULL`

**`INTEGER`** — a data type for **whole numbers** (no decimals). The
`year` and `stock` columns are this type, consistent with the
`type="number"` you've already used in HTML since
[jobsheet-01 documentation §4.4](../../jobsheet-01/Documentation/04-books-add-html.md#44-types-of-input-used),
and the `(int)` type casting you've already used in PHP since
[jobsheet-07 documentation §4.5](../../jobsheet-07/Documentation/04-process-add-server-validation.md#45-if-valid-save-to-session--redirect-to-the-list).

### `isbn VARCHAR(50)` (Without `NOT NULL`)

Notice the `isbn` and `category` columns are **not** given `NOT NULL` —
meaning this column **may be empty** (`NULL`). This is consistent with
[jobsheet-01 documentation §4.4](../../jobsheet-01/Documentation/04-books-add-html.md#44-types-of-input-used):
the ISBN field in the form was never given `required` from the start
(not every old book has an ISBN) — this database rule is **aligned**
with the rule already present in the HTML form.

### `stock INTEGER NOT NULL DEFAULT 0`

**`DEFAULT 0`** — if during `INSERT` (discussed in
[chapter 5](05-insert-prepared-statement.md)) the `stock` column is
**not filled in at all**, PostgreSQL automatically fills it with `0`.
This is an extra safety net, even though in practice
`process_add.php` always sends a stock value explicitly.

### `member_id VARCHAR(50) NOT NULL UNIQUE`

**`UNIQUE`** — a new constraint not yet seen on the `books` table: the
value of this column **must not be the same** across any rows. This
makes sense for a member ID — recall from
[jobsheet-01 documentation §6.4](../../jobsheet-01/Documentation/06-members-add-html.md#64-why-is-member-no-text-not-a-number),
`member_id` (like `A001`) acts as a member's **identity**, so it must
be different for each person — the database itself will **reject**
any attempt to save two members with the exact same `member_id`,
without needing extra PHP code to check it manually (although this
jobsheet does **not yet** handle that error gracefully on the PHP
side — a follow-up exercise idea in
[chapter 7](07-summary-and-exercises.md)).

## 2.5 How Do These Columns Relate to the PHP Code?

Notice **each column name** here — `title`, `author`, `year`, `isbn`,
`stock`, `category` for the `books` table; `name`, `member_id`,
`address`, `phone` for the `members` table — **exactly matches** the
associative array key names used by `process_add.php` since
[jobsheet-07 documentation](../../jobsheet-07/Documentation/04-process-add-server-validation.md),
which is also the same as the `name` attribute on `<input>` since
[jobsheet-01 documentation](../../jobsheet-01/Documentation/04-books-add-html.md).
This consistent naming (already touched on in
[jobsheet-06 documentation §3.3](../../jobsheet-06/Documentation/03-json-data.md#33-why-do-the-key-names-exactly-match-the-name-attribute-in-the-form))
now proves its value at the **deepest** layer: from HTML, through PHP,
all the way to the database column — the same field always has the
same name at **every** layer of the application.

Continue to: [Database Preparation Before Running](03-database-preparation.md)
