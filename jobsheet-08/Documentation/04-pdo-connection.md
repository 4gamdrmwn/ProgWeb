# 4. PHP Connection to the Database: `connection.php`

A new PHP file that becomes the **bridge** between PHP code and the
PostgreSQL database prepared in [chapter 3](03-database-preparation.md).

## 4.1 Full Code

```php
<?php
$host = "localhost";
$port = "5432";
$db   = "simpus_mini";
$user = "postgres";
$pass = "postgres";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
```

## 4.2 Five Configuration Variables

```php
$host = "localhost";
$port = "5432";
$db   = "simpus_mini";
$user = "postgres";
$pass = "postgres";
```

| Variable | Meaning |
|---|---|
| `$host` | The address of the **computer** where PostgreSQL is running. `"localhost"` means "the same computer where this PHP code is running" — for local development, PostgreSQL usually runs on the same computer. |
| `$port` | The network "door" where PostgreSQL "listens" for connection requests. `5432` is PostgreSQL's **standard/default** port. |
| `$db` | The name of the database to connect to — must exactly match the name created via `createdb` ([chapter 3 §3.2](03-database-preparation.md#32-step-2-creating-the-database)). |
| `$user`, `$pass` | Login credentials for PostgreSQL (recall from [chapter 3 §3.4](03-database-preparation.md#34-step-4-adjusting-credentials)). |

## 4.3 Creating the Connection: `new PDO(...)`

```php
$pdo = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
```

- **`new PDO(...)`** — creates a new PDO **object**, representing one
  active connection to the database. This `$pdo` object is what's later
  used to run `SELECT`/`INSERT` queries in
  [chapter 5](05-insert-prepared-statement.md) and [chapter 6](06-reading-data-select.md).
- **`"pgsql:host=$host;port=$port;dbname=$db"`** — called a **DSN**
  (*Data Source Name*), a string that summarizes **all** the location
  and type information of the database to connect to in one line of
  text. The `pgsql:` prefix tells PDO to use the PostgreSQL **driver**
  specifically (recall from
  [chapter 1 §1.4](01-basic-database-sql-concepts.md#14-what-is-pdo), PDO
  can be used for various database types — `pgsql:` is what determines
  the type here). Notice the PHP variables (`$host`, `$port`, `$db`)
  are written **directly inside the string**, wrapped in double quotes
  — this is called **string interpolation**, PHP automatically
  replaces `$host` with its real value (`"localhost"`) when this string
  is processed.
- **`$user`, `$pass`** — sent as **separate parameters** (not merged
  into the DSN string), because both are sensitive information that is
  conventionally kept separate from the connection string.

## 4.4 Handling Connection Failure

```php
try {
    $pdo = new PDO(...);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
```

- Recall the **`try`/`catch`** pattern from
  [jobsheet-06 documentation §1.6](../../jobsheet-06/Documentation/01-basic-fetch-json-concepts.md#16-handling-failure-trycatchfinally) —
  the exact same concept in PHP: code that **could potentially fail**
  (here, attempting to create a database connection) is wrapped in
  `try`, and if it fails, `catch` catches the error so the program
  doesn't halt entirely without explanation.
- **`catch (PDOException $e)`** — `PDOException` is the **specific
  error type** thrown by PDO when a connection fails (e.g. because
  PostgreSQL isn't running, the credentials are wrong, or the database
  name isn't found — exactly the cases discussed in
  [chapter 3 §3.5](03-database-preparation.md#35-this-order-matters--dont-reverse-it)).
- **`die("...")`** — a PHP command that **immediately stops** the
  entire script execution **right then and there**, while displaying
  the given message. This is a sensible choice specifically for
  database connection failures: if the database can't be reached at
  all, **almost every** page in this application (which needs to
  read/write data) won't be able to function at all — better to stop
  right away with a clear message, rather than continuing and producing
  confusing errors in many different places.
- **`$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);`** —
  sets PDO so that, **after the connection succeeds**, any subsequent
  query failure (e.g. an `INSERT` that fails due to violating `UNIQUE`
  in [chapter 2 §2.4](02-database-sql-schema.md#24-defining-columns-name-type-and-constraints))
  will also be thrown as a `PDOException`, rather than being silently
  ignored — a good practice so database problems are never "hidden"
  unnoticed.

## 4.5 How Is `connection.php` Used on Other Pages?

```php
require __DIR__ . '/includes/connection.php';
```

Notice pages that need database access (`index.php`, `books/list.php`,
`books/process_add.php`, etc.) call this file via **`require`**, not
**`include`** which you already know from
[jobsheet-07 documentation §2.2](../../jobsheet-07/Documentation/02-includes-header-footer.md#22-calling-include).
The difference: if the file being `include`d turns out to be **not
found**, PHP only shows a **warning** and still **continues** running
the rest of the code (potentially causing other confusing errors down
the line, since the `$pdo` variable that should exist won't be there).
`require` that fails to find its file will immediately halt the script
with a **fatal error** right away. Because `$pdo` is something that
**must exist** for all subsequent database queries to work (without
`$pdo`, this whole page is useless), `require` is the more appropriate
choice compared to `include` — reflecting that this file **must**
successfully load, unlike `header.php`/`footer.php` which, although
important, technically the page can still "run" (albeit incompletely)
without them.

Continue to: [Saving Data: Prepared Statement & `INSERT`](05-insert-prepared-statement.md)
