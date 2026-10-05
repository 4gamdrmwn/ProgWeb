# 4. Processing the Form: `process_add.php`

This is the most important file to understand in this jobsheet — where
form data is truly **processed** for the first time since jobsheet-01.

## 4.1 A Form That's Now Truly "Alive"

Recall from [jobsheet-01 documentation §4.2](../../jobsheet-01/Documentation/04-books-add-html.md#42-the-form-element),
the `<form>` tag since jobsheet-01 had **no** `action`/`method`, so
pressing "Save" did nothing. Now:

```php
<form id="add-form" method="post" action="process_add.php">
```

- **`method="post"`** — determines **how** the data is sent. Data sent
  via `POST` **doesn't appear** in the browser's address bar (unlike
  `method="get"` which attaches data to the URL, a common approach for
  search). `POST` is more suitable for forms that add/change data, like
  adding a new book.
- **`action="process_add.php"`** — determines **where** the data is
  sent when the form is submitted. Notice this is a **plain relative**
  path (without the `$base` prefix like the navigation menu in
  [chapter 2 §2.3](02-includes-header-footer.md#23-automatic-relative-paths-in-includesheaderphp)) —
  because `process_add.php` is **always** located in exactly the same
  folder as the `add.php` that calls it (`books/add.php` →
  `books/process_add.php`, `members/add.php` →
  `members/process_add.php`), so a simple relative path is already
  sufficient here, no need for `__DIR__` or the `$base` calculation.

## 4.2 Receiving Form Data: `$_POST`

```php
<?php
session_start();

$title = trim($_POST['title'] ?? '');
$author = trim($_POST['author'] ?? '');
$year = $_POST['year'] ?? '';
$isbn = trim($_POST['isbn'] ?? '');
$stock = $_POST['stock'] ?? '';
$category = trim($_POST['category'] ?? '');
```

- **`$_POST['title']`** — retrieves the value of the field named
  `title` sent via the form (recall the `name="title"` attribute on the
  `<input>` since
  [jobsheet-01 documentation §4.3](../../jobsheet-01/Documentation/04-books-add-html.md#43-the-pattern-for-each-form-field-label--input) —
  `$_POST` retrieves the data based exactly on that `name` attribute).
- **`?? ''`** — the null coalescing operator already discussed in
  [chapter 1 §1.6](01-basic-php-concepts.md#16-the--operator-null-coalescing):
  if that field somehow wasn't sent at all, use an empty string
  instead, preventing an error.
- **`trim(...)`** — removes leading/trailing whitespace (the exact same
  concept as `.trim()` in JavaScript you already used in
  [jobsheet-05 documentation §7.6](../../jobsheet-05/Documentation/07-js-form-validation.md#76-per-field-check-pattern)).
  Notice `$year` and `$stock` are **not** `trim()`-ed — because both
  will be checked as **numbers** ([§4.3](#43-server-side-validation)),
  not text, so surrounding whitespace isn't relevant to check the same
  way as a text field.

## 4.3 Server-Side Validation

```php
$errors = [];
if ($title === '') {
    $errors[] = "Title is required.";
}
if ($author === '') {
    $errors[] = "Author is required.";
}
if (!is_numeric($year) || $year < 1900 || $year > 2026) {
    $errors[] = "Year must be between 1900-2026.";
}
if (!is_numeric($stock) || $stock < 0) {
    $errors[] = "Stock cannot be negative.";
}
```

- **`$errors = [];`** — creates an **empty array**, a place to collect
  the list of error messages found (the `[]` syntax in modern PHP is
  equivalent to `array()`).
- **`$errors[] = "...";`** — adds one new item to the **end** of the
  `$errors` array (empty square brackets `[]` on the left side mean
  "add a new item," not accessing a specific index).
- **`is_numeric($year)`** — checks whether the value of `$year` **is a
  number** (or text that can be treated as a number, like `"2005"`).
  This function is conceptually equivalent to the `isNaN()` check you
  already used in JavaScript
  ([jobsheet-05 documentation §7.6](../../jobsheet-05/Documentation/07-js-form-validation.md#76-per-field-check-pattern)),
  just with reversed logic (`is_numeric` returns `true` if it really is
  a number, `isNaN` returns `true` if it's **not** a number).
- The year-range check (`1900-2026`) and non-negative stock pattern
  **exactly mirror** the same rule that has existed since
  [jobsheet-01 documentation §4.4](../../jobsheet-01/Documentation/04-books-add-html.md#44-types-of-input-used)
  (the HTML `min`/`max` attributes) and re-validated in JavaScript since
  [jobsheet-05 documentation §7.6](../../jobsheet-05/Documentation/07-js-form-validation.md#76-per-field-check-pattern) —
  now written for the **third time**, this time on the server. Why this
  is **not** a pointless duplication is explained in
  [§4.6](#46-why-is-this-validation-the-one-that-can-truly-be-relied-on).

## 4.4 If There Are Errors: Save the Flash & Redirect Back

```php
if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => implode(' ', $errors)];
    header('Location: add.php');
    exit;
}
```

- **`!empty($errors)`** — checks whether the `$errors` array **has
  content** (at least one error message was added above).
- **`$_SESSION['flash'] = ['type' => 'error', 'message' => ...];`** —
  stores an **associative array** (an array with named keys, similar
  to an object in JavaScript) into `$_SESSION['flash']` — recall this
  concept from
  [chapter 3 §3.3](03-session-and-data-flow.md#33-_session-as-a-temporary-data-basket).
  The `'type'` key (`'error'` or `'success'`) determines the message's
  **kind** (used for styling, see [chapter 6](06-css-flash-message.md)),
  and the `'message'` key contains the message **text**.
- **`implode(' ', $errors)`** — joins **all** items in the `$errors`
  array into **one string**, separated by a space (`' '`). If there are
  2 errors ("Title is required." and "Year must be between
  1900-2026."), the result becomes one combined sentence: `"Title is
  required. Year must be between 1900-2026."`.
- **`header('Location: add.php');`** — the PHP command to send an
  **HTTP redirect** to the browser: an instruction "please open the
  `add.php` page instead." The browser will automatically navigate
  there without user intervention.
- **`exit;`** — stops PHP script execution **immediately**. This is
  **mandatory** after `header('Location: ...')` — without `exit`, PHP
  would **keep going**, running the subsequent lines of code (including
  the code that saves data in
  [§4.5](#45-if-valid-save-to-session--redirect-to-the-list)) even
  though the redirect has already been "sent," because `header()` only
  sets an HTTP instruction, it doesn't actually stop the program like
  `return` does in a function.

## 4.5 If Valid: Save to Session & Redirect to the List

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

$_SESSION['flash'] = ['type' => 'success', 'message' => 'Book added successfully.'];
header('Location: list.php');
exit;
```

- **`if (!isset($_SESSION['books'])) { $_SESSION['books'] = []; }`** —
  checks whether `$_SESSION['books']` **has already been created**
  before (`isset` = "is it set"). If this is the **first** book added
  during this session, `$_SESSION['books']` doesn't exist at all yet —
  this line creates it as an empty array first, so the next line
  (`$_SESSION['books'][] = ...`) can add an item to it directly without
  error.
- **`$_SESSION['books'][] = [...]`** — adds **one new associative
  array** (representing one book, with keys **exactly matching** the
  structure of `data/books.json` in jobsheet-06, recall from
  [jobsheet-06 documentation §3.1](../../jobsheet-06/Documentation/03-json-data.md#31-databooksjson--10-book-objects)) —
  to the **end** of the `$_SESSION['books']` array, without removing
  books added previously.
- **`(int) $year`** and **`(int) $stock`** — this is **type casting**,
  forcing the value to be treated as an **integer** type, no longer
  text. Recall from
  [jobsheet-06 documentation §3.4](../../jobsheet-06/Documentation/03-json-data.md#34-data-types-inside-json)
  the importance of distinguishing numbers from text — data sent via
  `$_POST` is **always** plain text (even if it looks like a number),
  so `(int)` ensures the `year`/`stock` value stored in `$_SESSION` is
  truly of number type, not the text `"2005"`.
- Redirect to `list.php` (not `add.php` as in the error case) — taking
  the user straight to seeing the **result** of the data just added.

## 4.6 Why Is This Validation the One That Can Truly Be Relied On?

Recall the important note from
[jobsheet-05 documentation §7.8](../../jobsheet-05/Documentation/07-js-form-validation.md#78-why-do-html-validations-required-min-max-still-need-to-be-duplicated-in-js):
HTML validation (`required`, `min`/`max`) **and** JavaScript validation
both run in the **user's browser**, and both **can be bypassed**
(disabling JavaScript, or sending data directly without going through
the form at all). Validation in this `process_add.php` is
**fundamentally different**: because it runs on the **server**
([chapter 1 §1.1](01-basic-php-concepts.md#11-server-side-vs-client-side-whats-the-difference)),
this code **always** runs for **every** piece of incoming data, no
matter how it's sent — the user has no way to "turn off" the PHP code
on the server, unlike turning off JavaScript in their own browser.

Prove it to yourself per the note in this jobsheet's
[README.md](../README.md): **disable JavaScript** in your browser
settings, then open `books/add.php` and submit an empty form. The
JavaScript validation
([jobsheet-05 documentation chapter 7](../../jobsheet-05/Documentation/07-js-form-validation.md))
won't run at all (since JS is off), but the form will still fail to
save and you'll be redirected back to `add.php` with an error message —
concrete proof that server validation works **independently** from
client validation.

Continue to: [Displaying Data: `list.php` & Flash Message](05-list-php-render-and-flash.md)
