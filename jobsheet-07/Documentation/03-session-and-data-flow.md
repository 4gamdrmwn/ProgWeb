# 3. Session & Data Flow

Before dissecting `process_add.php` and `list.php`, first understand
**where** the book/member data is actually "stored" in this jobsheet —
because the answer is quite surprising for beginners.

## 3.1 What is a Session?

A **session** is a way for the server to "remember" a visitor **across
pages**, even across separate visits within a certain timeframe. The
HTTP protocol (the foundation of web communication) is actually
**stateless** (remembers nothing) — every time a browser requests a
page, the server treats it as a **completely new** request, with no
knowledge of whether the previous request came from the same person. A
session solves this: the server gives each visitor a unique
"identifier" (usually via a hidden cookie in the browser), so the
server can match "oh, this request comes from the same visitor as
before" and retrieve the relevant data.

## 3.2 Activating a Session: `session_start()`

```php
<?php
session_start();
?>
```

Recall this line from
[chapter 2 §2.1](02-includes-header-footer.md#21-includesheaderphp--full-code) —
it's at the **very top** of `header.php`. `session_start()` **must**
be called on **every** page that wants to use `$_SESSION` (recall this
superglobal from
[chapter 1 §1.5](01-basic-php-concepts.md#15-superglobals-built-in-variables-always-available)),
and **must** be called **before** any output is sent to the browser
(which is why it's placed at the very top of the file, before
`<!DOCTYPE html>`). Because every page `include`s `header.php`
([chapter 2 §2.2](02-includes-header-footer.md#22-calling-include)),
`session_start()` is automatically called on **every** page without
needing to write it repeatedly — another benefit of the `include`
pattern already discussed in [chapter 2](02-includes-header-footer.md).

## 3.3 `$_SESSION` as a Temporary Data "Basket"

Imagine `$_SESSION` as a **basket** the server provides specifically for
**one** visitor, and that basket **stays with them** as they move
between pages (as long as their browser session is active). In this
jobsheet, there are 2 "slots" used in that basket:

| Key | Contains | Filled by |
|---|---|---|
| `$_SESSION['books']` | An array containing all books added so far | `books/process_add.php` ([chapter 4](04-process-add-server-validation.md)) |
| `$_SESSION['members']` | An array containing all members added so far | `members/process_add.php` |
| `$_SESSION['flash']` | A success/failure message to display **just once** | Both `process_add.php` files |

## 3.4 The Full Flow: From Form to Table

Let's trace the **entire journey** of data from the moment you fill in
the Add Book form to when it appears in the Book List table:

1. You open `books/add.php`, fill in the form, click "Save".
2. The browser sends the form data (via `method="post"`, discussed in
   [chapter 4 §4.2](04-process-add-server-validation.md#42-receiving-form-data-_post)) to
   `books/process_add.php`.
3. `process_add.php` **validates** that data
   ([chapter 4](04-process-add-server-validation.md)). If valid: the
   data is added to the **array** `$_SESSION['books']` (previously
   existing book data is **not lost** — recall `$_SESSION` acts as a
   "basket", new data is added to it, not overwriting it).
4. `process_add.php` sets `$_SESSION['flash']` containing a success
   message, then **redirects** the browser to `books/list.php`.
5. `books/list.php` opens (as a **new** page request, separate from
   the previous step) — it reads `$_SESSION['books']` (which now
   **already contains** the book just added in step 3) and
   `$_SESSION['flash']` (the success message from step 4), then renders
   both as an HTML table and a flash message (discussed in
   [chapter 5](05-list-php-render-and-flash.md)).

Notice **each step above is a separate HTTP request** to the server
(step 2, step 5 are each a new "visit") — and `$_SESSION` is the
**only** way data (the newly added book, the flash message) can
"cross over" from one request to the next, because as discussed in
[§3.1](#31-what-is-a-session), HTTP itself remembers nothing between
requests.

## 3.5 Why Is This Data "Temporary"?

Recall the important note in this jobsheet's [README.md](../README.md):
data in `$_SESSION` will **be lost** once the browser session ends
(fully closing the browser, clearing cookies, or the session expiring
on the server after a period of inactivity). This is a **temporary
bridge** — not real data storage. Compare this with `data/books.json`
in jobsheet-06
([jobsheet-06 documentation §3](../../jobsheet-06/Documentation/03-json-data.md)):
that JSON file **stays** in the folder regardless of which browser
session accesses it — but it also **cannot be added to** via a form
(read-only, not writable). `$_SESSION` in jobsheet-07 **can be added
to** via a form, but is **not permanent** across sessions. The
combination of "can be added to **and** permanent" won't be achieved
until Jobsheet 8 with a real PostgreSQL database.

Continue to: [Processing the Form: `process_add.php`](04-process-add-server-validation.md)
