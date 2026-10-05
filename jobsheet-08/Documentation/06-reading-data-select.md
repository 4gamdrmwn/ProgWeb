# 6. Reading Data: `SELECT`

The last chapter before the summary: how `list.php` and `index.php`
**read back** the data already saved via the `INSERT` process in
[chapter 5](05-insert-prepared-statement.md).

## 6.1 `books/list.php`: Fetching All Rows

**Before (jobsheet-07):**
```php
$books = $_SESSION['books'] ?? [];
```

**Now (jobsheet-08):**
```php
require __DIR__ . '/../includes/connection.php';

$books = $pdo->query("SELECT * FROM books ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
```

Let's break down the SQL query:

- **`SELECT * FROM books`** — "get **all columns** (`*`) from **all
  rows** in the `books` table" (recall the table structure from
  [chapter 2](02-database-sql-schema.md)).
- **`ORDER BY id DESC`** — sorts the result by the `id` column, in
  **descending** order (`DESC` = *descending*, from largest to
  smallest). Recall `id` auto-increments with every new row
  ([chapter 2 §2.4](02-database-sql-schema.md#24-defining-columns-name-type-and-constraints)) —
  sorting descending by `id` means **the most recently added book
  appears at the top** of the table. Compare this with
  `$_SESSION['books']` in jobsheet-07, which always displayed books
  **in the order they were added** (newest always at the bottom,
  since `[] = ...` appends to the end of the array) — now the order is
  deliberately reversed so the newest data is easier to see.

## 6.2 Running a Simple Query: `$pdo->query(...)`

```php
$pdo->query("SELECT * FROM books ORDER BY id DESC")
```

Notice here **`$pdo->query(...)`** is used, **not**
`$pdo->prepare(...)` + `execute(...)` like the `INSERT` in
[chapter 5](05-insert-prepared-statement.md#52-preparing-the-query-pdo-prepare).
The difference: `query()` is used for SQL commands that **don't
involve any outside values** (no user data needs to be inserted into
this query) — this query is always exactly the same text every time
it's run, so it doesn't need a placeholder mechanism like a prepared
statement. The practical rule: **whenever there's a value from
`$_POST` (or any other outside source)** that needs to go into a
query, always use `prepare()`+`execute()` for security
([chapter 5 §5.3](05-insert-prepared-statement.md#53-what-is-a-prepared-statement-and-why-does-it-matter)) —
if there's no outside value at all, the simpler `query()` is
sufficient.

## 6.3 Turning the Query Result into a PHP Array: `fetchAll(PDO::FETCH_ASSOC)`

```php
->fetchAll(PDO::FETCH_ASSOC)
```

- **`fetchAll(...)`** — retrieves **all** rows of the query result at
  once, returned as an array.
- **`PDO::FETCH_ASSOC`** — a fetch mode that determines the **shape**
  of each row in that array: as an **associative array**, with keys
  being the **column names** (`'title'`, `'author'`, etc.) — exactly
  the form you already use to access `$book['title']` in
  [§6.4](#64-displaying-the-result-in-the-table-unchanged) and that
  you already know from the structure of `$_SESSION['books']` in
  jobsheet-07. The end result, `$books` now has **exactly the same**
  structure as the previous `$_SESSION['books']` — an array containing
  many associative arrays, one per book.

## 6.4 Displaying the Result in the Table: Unchanged

```php
<?php foreach ($books as $book): ?>
<tr>
    <td><?php echo $book['title']; ?></td>
    ...
```

This is the **most reassuring** part to realize: the `foreach` code
for displaying the table
([jobsheet-07 documentation §5.4](../../jobsheet-07/Documentation/05-list-php-render-and-flash.md#54-rendering-the-table-from-the-session-array))
**doesn't need to change at all**. Because `fetchAll(PDO::FETCH_ASSOC)`
produces an array structure identical to the previous
`$_SESSION['books']`, the code that **displays** the data doesn't care
where `$books` actually came from (session or database) — this is the
real benefit of keeping data structures **consistent** throughout every
layer of the application, as already touched on in
[chapter 2 §2.5](02-database-sql-schema.md#25-how-do-these-columns-relate-to-the-php-code).

## 6.5 `index.php`: Counting Totals with `COUNT(*)`

```php
require __DIR__ . '/includes/connection.php';

$totalBooks = $pdo->query("SELECT COUNT(*) FROM books")->fetchColumn();
$totalMembers = $pdo->query("SELECT COUNT(*) FROM members")->fetchColumn();
```

- **`SELECT COUNT(*) FROM books`** — instead of fetching **all** book
  data just to count how many there are (which would be wasteful,
  especially with a huge amount of data), `COUNT(*)` is an SQL
  instruction that asks the database **itself** to count the number of
  rows, and only return **one number** as the result.
- **`->fetchColumn()`** — a PDO method to retrieve **a single value**
  from the query result (suitable here since the `COUNT(*)` result is
  indeed just one number, unlike `fetchAll()` which retrieves many rows
  at once as in [§6.3](#63-turning-the-query-result-into-a-php-array-fetchallpdofetch_assoc)).

Compare this with jobsheet-07:
```php
$totalBooks = count($_SESSION['books'] ?? []);
```
The PHP function `count()` (counting the number of items in a PHP array
in memory) is replaced with `SELECT COUNT(*)` (counting the number of
rows in the database) — two different ways for the **same conceptual
goal**: knowing how much data exists, only now the data truly comes
from the database, not a temporary array in `$_SESSION`.

Continue to: [Summary & Further Exercises](07-summary-and-exercises.md)
