# 2. `includes/header.php` & `includes/footer.php`

This is the first PHP feature that truly solves a real problem: since
jobsheet-01, the **exact same** `<header>` and `<footer>` are repeated
in **every** HTML file
([jobsheet-01 documentation §2.2](../../jobsheet-01/Documentation/02-index-html.md#22-section-by-section-explanation)).
If the navigation menu ever needs a new link added, you'd have to edit
**every** file one by one. PHP's `include` solves this once and for
all.

## 2.1 `includes/header.php` — Full Code

```php
<?php
session_start();

$__jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPUS-Mini<?php echo isset($page_title) ? ' | ' . $page_title : ''; ?></title>
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
</head>
<body>
    <header>
        <h1>SIMPUS-Mini</h1>
        <button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Menu">&#9776;</button>
        <nav>
            <ul>
                <li><a href="<?php echo $base; ?>index.php">Home</a></li>
                <li><a href="<?php echo $base; ?>books/list.php">Book List</a></li>
                <li><a href="<?php echo $base; ?>books/add.php">Add Book</a></li>
                <li><a href="<?php echo $base; ?>members/list.php">Member List</a></li>
                <li><a href="<?php echo $base; ?>members/add.php">Add Member</a></li>
            </ul>
        </nav>
    </header>

    <main>
```

Notice this file is **not neatly closed** — the `<main>` tag is opened
but never closed, `<body>` and `<html>` aren't closed either. This is
**deliberate**, explained in
[§2.4](#24-how-are-these-two-pieces-combined).

The `$base = ...` line at the very top hasn't been explained yet — hold
on, it's covered fully in
[§2.3](#23-automatic-relative-paths-in-includesheaderphp)
once you first understand the **problem** that makes that line
necessary.

## 2.2 Calling `include`

```php
<?php
$page_title = "Home";
include __DIR__ . '/includes/header.php';
```

- **`include`** is a PHP statement that **inserts** the entire contents
  of another file **right at that spot** — the effect is as if the
  entire contents of `header.php` were "pasted" directly in place of
  this `include` line.
- **`__DIR__`** is a built-in PHP constant that always contains the path
  of the folder where the currently running file is located. Combining
  it with `'/includes/header.php'` produces a path that is **always
  correct**, no matter which page calls this `include` — unlike a
  relative path (`../`) which has to be calculated manually depending
  on folder depth (recall the `../` calculation from
  [jobsheet-01 documentation §1.5](../../jobsheet-01/Documentation/01-basic-concepts.md#15-navigation-between-pages-a-href).
  Compare the call in `index.php` (`__DIR__ . '/includes/header.php'`)
  with the one in `books/list.php` (`__DIR__ . '/../includes/header.php'`) —
  both are correct because `__DIR__` automatically adjusts to each
  file's own location.
- **`$page_title = "Home";`** is written **before** the `include` line —
  this order matters! Variables created in `index.php` **remain
  accessible** inside `header.php` after it's included (PHP merges the
  two as if they were one big file), so the line
  `<?php echo isset($page_title) ? ' | ' . $page_title : ''; ?>` inside
  `header.php` can "see" the `$page_title` value just set by the page
  that called it.

## 2.3 Automatic Relative Paths in `includes/header.php`

Compare the menu links in `header.php` now:
```php
<li><a href="<?php echo $base; ?>index.php">Home</a></li>
<li><a href="<?php echo $base; ?>books/list.php">Book List</a></li>
```

with the jobsheet-05/06 version which used hand-written **relative**
paths (`../index.html`, `list.html`, etc. — recall the concept from
[jobsheet-01 documentation §1.5](../../jobsheet-01/Documentation/01-basic-concepts.md#15-navigation-between-pages-a-href)).

**Why isn't a hand-written relative path enough here?** Because
`header.php` is now **shared** by pages at **different** folder depths
(`index.php` at the root, `books/list.php` one folder deeper). If the
menu were written with a fixed relative path like in jobsheet-05/06, a
single link (e.g. to Home) would need `index.php` when called from the
root, but `../index.php` when called from `books/list.php` —
it's **impossible** to write one line of HTML that's correct for both
situations at once in the same `header.php` file.

**The solution used: compute the prefix automatically with PHP**,
rather than writing it manually. Here's an explanation of the 4 lines
not yet covered in
[§2.1](#21-includesheaderphp--full-code):

```php
$__jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);
```

- **`$__jobsheetRoot = dirname(__DIR__);`** — `__DIR__` inside
  `header.php` always contains the `includes/` folder (recall
  [§2.2](#22-calling-include)). `dirname()` goes up one level from
  there, so `$__jobsheetRoot` is this project's root folder
  (`jobsheet-07/`) — **always correct**, no matter which domain this
  project is accessed through.
- **`$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);`** —
  `$_SERVER['SCRIPT_FILENAME']` is another superglobal (similar to
  `$_SESSION`/`$_POST` from
  [chapter 1 §1.5](01-basic-php-concepts.md#15-superglobals-built-in-variables-always-available))
  containing the full path of the PHP file **first invoked** for this
  request — for example `books/list.php`, **not** `header.php` even
  though this code is currently running inside `header.php` (recall
  `include` again from [§2.2](#22-calling-include): once included,
  everything becomes "one big file," including the value of
  `$_SERVER['SCRIPT_FILENAME']`).
- **`$__rel = ...`** — extracts the portion of the path **after** the
  project's root folder. If the page opened is `index.php`, the result
  is an empty string. If the page opened is `books/list.php`, the
  result is `"books"`. `str_replace('\\', '/', ...)` is needed because
  Windows uses `\` as a folder separator, unlike `/` used in URLs.
- **`$base = ...`** — if `$__rel` is empty, `$base` becomes an empty
  string (no need to go up any folder at all). If `$__rel` contains one
  folder segment (`"books"`), `$base` becomes a single `"../"`. This
  formula automatically produces `"../../"`, etc. if a page ever exists
  even deeper.

The bottom line: `$base` computes **"how many levels do I need to go up
to reach this project's root"**, calculated from the **folder structure
on disk** (via `__DIR__` and `SCRIPT_FILENAME`) — not from the domain
address in the browser. The calculation is done **once** in
`header.php`, and the result is reused everywhere via
`<?php echo $base; ?>` in every `href`/`src` — the same principle
behind why `header.php`/`footer.php` themselves were created:
**don't repeat the same work in many places**.

**The consequence**: this project is **no longer tied** to having to
run with the `jobsheet-07/` folder as the server root. `php -S
localhost:8000` from inside the `jobsheet-07/` folder is still valid
and simplest for independent practice — but this project **also**
remains correct when accessed via Laragon even if Apache's document
root isn't the `jobsheet-07/` folder itself (e.g.
`http://dp2026.test/kode-praktikum/jobsheet-07/`), because `$base`
adjusts itself automatically, rather than being anchored to the domain
root like the simpler *root-relative path* approach (`/index.php`)
which requires the server to be exactly at the project folder.

## 2.4 How Are These Two Pieces Combined?

Recall from [§2.1](#21-includesheaderphp--full-code), `header.php`
opens the `<main>` tag but doesn't close it. This is because each
page's **specific content** (e.g. the "Welcome to..." `<section>` on
Home) is written **between** the `include header.php` and
`include footer.php` calls:

```php
<?php
$page_title = "Home";
include __DIR__ . '/includes/header.php';
?>
        <section>
            <h2>Welcome to Mini Library System</h2>
            ...
        </section>
<?php include __DIR__ . '/includes/footer.php'; ?>
```

And `includes/footer.php`:

```php
    </main>

    <footer>
        <p>&copy; 2026 SIMPUS-Mini &mdash; Jobsheet 7</p>
    </footer>
    <script src="<?php echo $base; ?>assets/js/app.js"></script>
    <?php if (!empty($extra_scripts)): foreach ($extra_scripts as $src): ?>
    <script src="<?php echo $src; ?>"></script>
    <?php endforeach;
    endif; ?>
</body>
</html>
```

Notice `footer.php` also uses `<?php echo $base; ?>` for its
`<script src="...">` — the `$base` variable computed in `header.php`
([§2.3](#23-automatic-relative-paths-in-includesheaderphp))
**remains available** here because `header.php` and `footer.php` are
both `include`d from the same file ([§2.2](#22-calling-include)), so
they share the exact same variables as if it were one big file.

`footer.php` **closes** what `header.php` opened: `</main>`,
`<footer>`, then `</body></html>`. When PHP processes `index.php`, the
merge order is:

1. The entire contents of `header.php` (open `<html>`...`<main>`).
2. The Home-specific `<section>` content written in `index.php`.
3. The entire contents of `footer.php` (`</main>`...close `</html>`).

The end result: **one complete, valid HTML document** sent to the
browser — structured exactly like the static HTML files in previous
jobsheets, just now "assembled" from 3 different file pieces on the
server, instead of being manually rewritten in every file.

## 2.5 The `$extra_scripts` Pattern for Per-Page Extra Scripts

```php
<?php if (!empty($extra_scripts)): foreach ($extra_scripts as $src): ?>
<script src="<?php echo $src; ?>"></script>
<?php endforeach;
endif; ?>
```

This is an example of PHP's **alternative syntax** for control
structures — `if (...): ... endif;` and `foreach (...): ... endforeach;`
instead of regular curly braces `{ }`. This syntax is **deliberately
chosen** for PHP code mixed with HTML (as here) because it's easier to
read than curly braces, which can get confusing among HTML tags — this
pattern will show up again often in
[chapter 5](05-list-php-render-and-flash.md). `!empty($extra_scripts)`
checks whether this variable **has content** (this variable itself
hasn't been actively used yet in jobsheet-07 — it's prepared as a
"hook" for future needs, similar in spirit to preparing structure ahead
of time, which you already saw in
[jobsheet-04 documentation](../../jobsheet-04/Documentation/README.md)
when designing before coding).

Continue to: [Session & Data Flow](03-session-and-data-flow.md)
