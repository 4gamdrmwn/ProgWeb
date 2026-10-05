# 5. Saving Data: Prepared Statement & `INSERT`

This directly replaces the `$_SESSION['books'][] = [...]` you already
learned in
[jobsheet-07 documentation §4.5](../../jobsheet-07/Documentation/04-process-add-server-validation.md#45-if-valid-save-to-session--redirect-to-the-list) —
now data is truly sent to the database, not just stored in temporary
memory.

## 5.1 The Code That Changed in `books/process_add.php`

**Before (jobsheet-07):**
```php
if (!isset($_SESSION['books'])) {
    $_SESSION['books'] = [];
}

$_SESSION['books'][] = [
    'title' => $title,
    'author' => $author,
    'year' => (int) $year,
    'isbn' => $isbn,
    'stock' => (int) $stock,
    'category' => $category,
];
```

**Now (jobsheet-08):**
```php
require __DIR__ . '/../includes/connection.php';

// ...validation (unchanged from jobsheet-07)...

$stmt = $pdo->prepare(
    "INSERT INTO books (title, author, year, isbn, stock, category)
     VALUES (:title, :author, :year, :isbn, :stock, :category)
     RETURNING id"
);
$stmt->execute([
    'title' => $title,
    'author' => $author,
    'year' => (int) $year,
    'isbn' => $isbn,
    'stock' => (int) $stock,
    'category' => $category,
]);
```

Notice all the **validation** ($title === '', is_numeric($year), etc. —
recall from
[jobsheet-07 documentation §4.3](../../jobsheet-07/Documentation/04-process-add-server-validation.md#43-server-side-validation))
**doesn't change at all** — validation remains important and runs
exactly as before, **before** the code below gets to run. Only the
**data-saving** part has changed.

## 5.2 Preparing the Query: `$pdo->prepare(...)`

```php
$stmt = $pdo->prepare(
    "INSERT INTO books (title, author, year, isbn, stock, category)
     VALUES (:title, :author, :year, :isbn, :stock, :category)
     RETURNING id"
);
```

Let's break down this `INSERT` SQL statement piece by piece:

- **`INSERT INTO books (title, author, year, isbn, stock, category)`** —
  "add a new row to the `books` table, filling in these columns..."
  (recall the `books` table structure from
  [chapter 2](02-database-sql-schema.md#21-full-code)).
- **`VALUES (:title, :author, ...)`** — "...with the following values."
  Notice what's written here is **not** the real values (like
  `'Laskar Pelangi'`), but named **placeholders**, marked with a colon
  in front (`:title`, `:author`, etc).
- **`RETURNING id`** — a PostgreSQL-specific instruction: after the new
  row is successfully added, **return** the value of the `id` column
  that was just automatically created (recall `SERIAL` from
  [chapter 2 §2.4](02-database-sql-schema.md#24-defining-columns-name-type-and-constraints)).
  This `id` value is **not yet used** in this jobsheet (recall the note
  in this jobsheet's [README.md](../README.md)), but is prepared as a
  foundation for the real Edit/Delete features starting in Jobsheet 9 —
  to edit/delete one specific book, the application needs to know its
  `id`.
- **`$pdo->prepare(...)`** — the PDO method that **prepares** (but
  doesn't yet **run**) this query. The result is stored in `$stmt`
  (short for *statement*), an object representing a "query ready to be
  executed."

## 5.3 What Is a Prepared Statement, and Why Does It Matter?

A **prepared statement** is a technique for running an SQL query in
**two separate stages**: (1) preparing the query's **structure** with
placeholders like `:title` ([§5.2](#52-preparing-the-query-pdo-prepare)),
then (2) filling those placeholders with **real values** when executed
([§5.4](#54-running-the-query-stmt-execute)) — **separate** from the
query text itself.

This is **much safer** than the "naive" way of concatenating values
directly into the query text, for example:

```php
// DO NOT DO THIS — example of UNSAFE code, for illustration only
$pdo->query("INSERT INTO books (title) VALUES ('" . $title . "')");
```

If `$title` contains text **deliberately crafted to be malicious** by
an attacker (e.g. containing quote characters and extra SQL command
fragments), this string-concatenation approach could **change the
meaning** of the SQL query itself — a vulnerability called **SQL
injection**. With a prepared statement, the values sent via
`execute()` are **never** treated as part of the SQL command — they're
always treated purely as **data**, whatever their content, making it
impossible to alter the original query structure. Recall the note in
this jobsheet's [README.md](../README.md): this is only a **security
foundation**, to be deepened further in Jobsheet 11.

## 5.4 Running the Query: `$stmt->execute(...)`

```php
$stmt->execute([
    'title' => $title,
    'author' => $author,
    'year' => (int) $year,
    'isbn' => $isbn,
    'stock' => (int) $stock,
    'category' => $category,
]);
```

**`$stmt->execute([...])`** actually **runs** the query prepared
earlier, filling each placeholder with the value from the given
associative array — notice the array's **keys** (`'title'`, `'author'`,
etc., **without** a colon) must **match** the placeholder names in the
query (`:title`, `:author`, **with** a colon). PDO automatically matches
them by name. After this line runs, one new row is **truly saved** in
the `books` table — compare this with the jobsheet-07 version, which
"only" saved it to the `$_SESSION['books']` array in temporary memory.

## 5.5 The Part That Doesn't Change at All

The rest of the code after `execute()` — flash message and redirect —
is **exactly identical** to jobsheet-07:

```php
$_SESSION['flash'] = ['type' => 'success', 'message' => 'Book added successfully.'];
header('Location: list.php');
exit;
```

This shows something important: `$_SESSION['flash']` (a single-display
message, recall from
[jobsheet-07 documentation §5.2](../../jobsheet-07/Documentation/05-list-php-render-and-flash.md#52-retrieving-and-deleting-the-flash-message))
**is still used** in this jobsheet — only `$_SESSION['books']`/
`$_SESSION['members']` (the book/member data itself) moves to the
database. `$_SESSION` is still useful for **temporary** data like
notification messages, which **should** only last briefly, unlike
book/member data which should be permanent.

Continue to: [Reading Data: `SELECT`](06-reading-data-select.md)
