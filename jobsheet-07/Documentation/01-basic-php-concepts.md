# 1. Basic PHP Concepts

This is your first introduction to PHP. First get familiar with how PHP
differs **fundamentally** from the HTML/CSS/JavaScript you've already
learned.

## 1.1 Server-Side vs Client-Side: What's the Difference?

This is the **most important** concept to understand before anything
else:

| | **Client-side** (HTML, CSS, JavaScript) | **Server-side** (PHP) |
|---|---|---|
| Where does it run? | In the visitor's **browser** (the reader's computer/phone) | On the **server** (the computer where the web application is hosted) |
| When? | After the page is **received** by the browser | **Before** the page is sent to the browser |
| Can the user see it? | Yes — via "View Source"/DevTools, the original code is visible | **Never** — the user only receives the **final result** (plain HTML) |
| Example in SIMPUS-Mini | `app.js` controls the hamburger menu ([jobsheet-05 documentation](../../jobsheet-05/Documentation/README.md)) | `process_add.php` validates & saves data ([chapter 4](04-process-add-server-validation.md)) |

Imagine sending a letter through the post office: **server-side** is
the process at the post office (sorting, validating the address,
recording it) that is **invisible** to both the sender and recipient of
the letter — they only see the result (letter delivered or returned).
**Client-side** is what happens after the letter reaches the
recipient's hands (e.g. the recipient opens the envelope, reads its
contents).

## 1.2 Basic Syntax: The `<?php ?>` Tag

```php
<?php
$page_title = "Home";
?>
```

PHP code is always wrapped in the opening tag **`<?php`** and closing
tag **`?>`**. **Outside** this tag, all text (including plain HTML) is
treated as-is, exactly like a regular `.html` file. This is why a
`.php` file can contain a **mixture** of HTML and PHP in one file —
notice `books/list.php` ([chapter 5](05-list-php-render-and-flash.md))
contains plain HTML tags like `<section>`, `<table>`, **interspersed**
with chunks of PHP code here and there.

## 1.3 PHP Variables: Always Start with `$`

```php
$page_title = "Home";
$totalBooks = count($_SESSION['books'] ?? []);
```

- Every **variable** (a place to store a value) in PHP **must** start
  with a dollar sign (**`$`**) — unlike JavaScript, which uses `let`/
  `const` without a special symbol (recall from
  [jobsheet-05 documentation §4.2](../../jobsheet-05/Documentation/04-js-hamburger-menu.md#42-getting-the-two-elements-needed)).
  `$page_title` and `$totalBooks` are two different variables.
- Every PHP statement line ends with a **semicolon** (`;`) — just like
  the habit you've already seen in JavaScript.

## 1.4 Displaying a Value in HTML: `echo`

```php
<p><?php echo $totalBooks; ?></p>
```

**`echo`** is the PHP command to "print/display" a value into the HTML
output sent to the browser. This line produces HTML like `<p>12</p>`
(if the value of `$totalBooks` is `12`) — notice that once PHP finishes
processing, **no trace of PHP remains** in the HTML the browser
receives; all that's visible is a plain number inside a `<p>` tag. This
is the concrete manifestation of "server-side" discussed in
[§1.1](#11-server-side-vs-client-side-whats-the-difference) — the
`echo` process happens on the server, and its result (the number `12`)
is what reaches the browser.

## 1.5 Superglobals: Built-in Variables Always Available

PHP has several special variables called **superglobals** — always
available anywhere without needing to be declared, always named in all
uppercase:

| Superglobal | Contains |
|---|---|
| `$_SESSION` | Data stored **across pages** for a **single** visitor, for as long as their browser session stays active. Discussed in depth in [chapter 3](03-session-and-data-flow.md). |
| `$_POST` | Data **sent** via a form with `method="post"` (recall from [jobsheet-01 documentation §4.2](../../jobsheet-01/Documentation/04-books-add-html.md#42-the-form-element), previously the form had no `method` at all). Discussed in [chapter 4](04-process-add-server-validation.md). |

## 1.6 The `??` Operator (Null Coalescing)

```php
$flash = $_SESSION['flash'] ?? null;
$totalBooks = count($_SESSION['books'] ?? []);
```

**`??`** is the "if not present, use this value instead" operator —
conceptually similar to *optional chaining* `?.` in JavaScript you
already know from
[jobsheet-05 documentation §5.4](../../jobsheet-05/Documentation/05-js-delete-confirmation.md#54-getting-the-nametitle-from-that-row),
but it works slightly differently: `$_SESSION['flash'] ?? null` means
"get `$_SESSION['flash']` **if it exists**; if that key was never set
at all, use `null` instead" — preventing the "undefined array key"
error that would appear if that key were accessed directly when it had
never existed.

## 1.7 Running PHP: Needs a Real Server

Unlike plain HTML that can be opened directly by double-clicking
(`file://`), a `.php` file **must** be processed by a **PHP
interpreter** before it can be viewed as a web page — if you open
`index.php` directly in a browser without a server, the browser will
only display the **raw PHP code as text**, not the final result. Per
this jobsheet's [README.md](../README.md), run:

```bash
php -S localhost:8000
```

Run this command **from inside the `jobsheet-07/` folder** so that
`http://localhost:8000/` maps directly to this folder. The CSS/JS/menu
paths in this jobsheet are computed **automatically relative** to the
project folder (not anchored to the server root) — explained in detail
in
[chapter 2 §2.3](02-includes-header-footer.md#23-automatic-relative-paths-in-includesheaderphp),
so besides `php -S`, this project can also still be opened via Laragon
even when accessed nested inside several folders (e.g.
`http://dp2026.test/kode-praktikum/jobsheet-07/`).
Once the server is running, open `http://localhost:8000/index.php` —
similar to how you ran jobsheet-06 (recall
[jobsheet-06 documentation §7.3](../../jobsheet-06/Documentation/07-running-with-local-server.md#73-solution-run-through-a-local-server)),
except this time the same server also **processes** the PHP code, not
just serving static files as-is.

Armed with these basic concepts, you're ready to read this jobsheet's
PHP files starting in chapter 2.

Continue to: [`includes/header.php` & `includes/footer.php`](02-includes-header-footer.md)
