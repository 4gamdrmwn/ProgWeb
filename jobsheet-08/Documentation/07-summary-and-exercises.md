# 7. Summary & Further Exercises

## 7.1 Overall Jobsheet 8 Summary

| Section | Concepts Learned |
|---|---|
| [Basic Concepts](01-basic-database-sql-concepts.md) | Relational databases, tables/columns/rows, SQL, PDO |
| [SQL Schema](02-database-sql-schema.md) | `CREATE TABLE`, data types (`SERIAL`, `VARCHAR`, `INTEGER`), constraints (`PRIMARY KEY`, `NOT NULL`, `UNIQUE`, `DEFAULT`) |
| [Database Preparation](03-database-preparation.md) | `createdb`, `psql -f`, the `pdo_pgsql` extension, credentials |
| [PDO Connection](04-pdo-connection.md) | DSN, `new PDO(...)`, `try`/`catch` for connection failure, `require` vs `include` |
| [Prepared Statement & INSERT](05-insert-prepared-statement.md) | `prepare()`, `:name` placeholders, `execute()`, why it's safer than string concatenation |
| [Reading Data with SELECT](06-reading-data-select.md) | `query()` vs `prepare()`, `fetchAll(PDO::FETCH_ASSOC)`, `fetchColumn()`, `COUNT(*)` |

## 7.2 Core Concepts to Remember

1. **A database solves the "data disappears" problem** from jobsheet-07
   — data is now stored permanently in PostgreSQL, independent of any
   browser session
   ([chapter 1 §1.1](01-basic-database-sql-concepts.md#11-why-do-we-need-a-database-recalling-the-problem)).
2. **An SQL schema defines data rules**, not just column names —
   `NOT NULL`, `UNIQUE`, and correct data types all help maintain data
   quality right from the database layer
   ([chapter 2](02-database-sql-schema.md)).
3. **PDO is a uniform bridge** between PHP and various database types,
   starting with creating a connection via a DSN
   ([chapter 4](04-pdo-connection.md)).
4. **Prepared statements (`prepare()`+`execute()`) are the safe way**
   to insert user data into an SQL query — use this whenever there's a
   value from outside (like `$_POST`) that needs to go into a query
   ([chapter 5 §5.3](05-insert-prepared-statement.md#53-what-is-a-prepared-statement-and-why-does-it-matter)).
5. **The array structure from `fetchAll(PDO::FETCH_ASSOC)` is
   consistent** with the previous `$_SESSION` structure — the code
   that displays data doesn't need to change at all, only the data
   source moves
   ([chapter 6 §6.4](06-reading-data-select.md#64-displaying-the-result-in-the-table-unchanged)).

## 7.3 How to Try It Yourself

1. Complete **all** the preparation steps in
   [chapter 3](03-database-preparation.md) — this is **mandatory**
   before going any further.
2. Run `php -S localhost:8000` (or via Laragon), open
   `http://localhost:8000/index.php` — the stat cards should show `0`
   for Total Books and Total Members (a fresh database, no data yet).
3. Add one book via `books/add.php`. Notice you're redirected to
   `list.php` with your new book appearing **at the very top row**
   (recall `ORDER BY id DESC` from
   [chapter 6 §6.1](06-reading-data-select.md#61-bookslistphp-fetching-all-rows)).
4. Go back to Home — notice the "Total Books" card now shows `1`.
5. **Test persistence** per the note in this jobsheet's
   [README.md](../README.md): close the browser **completely**, reopen
   it, visit `list.php` — the book you added earlier **is still
   there**. Compare this experience with the same test in
   [jobsheet-07 documentation §7.3](../../jobsheet-07/Documentation/07-summary-and-exercises.md#73-how-to-try-it-yourself)
   step 6, where the data **disappeared** after the browser was closed.
6. Try adding **two** members with the **exact same** `member_id` —
   observe what happens (recall the `UNIQUE` constraint from
   [chapter 2 §2.4](02-database-sql-schema.md#24-defining-columns-name-type-and-constraints)).
   You'll most likely see a **raw PHP error page**, not a neat flash
   message — a great opportunity to practice
   [§7.4](#74-additional-exercise-ideas-optional) point 1.

## 7.4 Additional Exercise Ideas (Optional)

1. **Handle the `UNIQUE` error gracefully** — wrap `$stmt->execute(...)`
   in `members/process_add.php` with `try`/`catch (PDOException $e)`,
   then set `$_SESSION['flash']` containing a message like "Member ID
   already in use, please use a different number." instead of letting
   the raw error be shown to the user.
2. **Add a new column** — e.g. `date_added TIMESTAMP DEFAULT NOW()` on
   the `books` table (look up the meaning of `NOW()` and `TIMESTAMP`
   yourself via the PostgreSQL documentation), then display that column
   in `books/list.php`.
3. **Build a server-side search query** — add
   `WHERE title ILIKE :keyword` (`ILIKE` = case-insensitive text
   matching in PostgreSQL) to the `SELECT` query in `books/list.php`,
   connected to the existing search box in the HTML — compare this
   with the **client-side** table filter you already built in
   [jobsheet-05 documentation §6](../../jobsheet-05/Documentation/06-js-table-filter.md).
4. **Migrate old data** — try writing a small separate PHP script that
   reads `data/books.json` from jobsheet-06
   ([jobsheet-06 documentation §3](../../jobsheet-06/Documentation/03-json-data.md))
   then inserts all its contents into the `books` table via `INSERT` —
   a good exercise for understanding how old data can be "migrated" to
   a new database.

If any part is still confusing, try re-reading
[chapter 1](01-basic-database-sql-concepts.md) while practicing step 5
in [§7.3](#73-how-to-try-it-yourself) — experiencing data that
**truly persists** after closing the browser yourself is the most
convincing way to understand why a database matters.
