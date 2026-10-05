# 5. Displaying Data: `list.php` & Flash Message

This is the other side of the data flow already mapped out in
[chapter 3 §3.4](03-session-and-data-flow.md#34-the-full-flow-from-form-to-table) —
how `$_SESSION['books']`, already filled by
`process_add.php` ([chapter 4](04-process-add-server-validation.md)),
finally actually appears as a table on screen.

## 5.1 Full Code of `books/list.php`

```php
<?php
$page_title = "Book List";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$books = $_SESSION['books'] ?? [];
?>
        <section>
            <h2>Book List</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['message']; ?></p>
            <?php endif; ?>

            <div class="search-box">
                <label for="search-input">Search Book Title</label>
                <input type="text" id="search-input" placeholder="Type book title...">
            </div>

            <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Year</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($books)): ?>
                    <tr>
                        <td colspan="5">No book data yet. Please add one via the "Add Book" menu.</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?php echo $book['title']; ?></td>
                            <td><?php echo $book['author']; ?></td>
                            <td><?php echo $book['year']; ?></td>
                            <td><?php echo $book['stock']; ?></td>
                            <td>
                                <button type="button">Edit</button>
                                <button type="button" class="btn-delete">Delete</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            </div>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
```

## 5.2 Retrieving and "Deleting" the Flash Message

```php
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
```

- The first line retrieves `$_SESSION['flash']`, which may have been
  set by `process_add.php` ([chapter 4 §4.4-4.5](04-process-add-server-validation.md#44-if-there-are-errors-save-the-flash--redirect-back)),
  or `null` if nothing has been set yet.
- **`unset($_SESSION['flash']);`** — removes the `'flash'` key from
  `$_SESSION` **immediately after reading it**. This is the key to the
  "flash message" concept — a message that **only appears once**. If
  this `unset` line didn't exist, the "Book added successfully."
  message would **keep appearing** every time you reopen `list.php`
  later on (because that data would still be stored in `$_SESSION`),
  even though the message should only be relevant **right after** the
  add action happens. With `unset` right after reading it, the message
  automatically becomes "single use."

## 5.3 Displaying the Flash Message in HTML

```php
<?php if ($flash): ?>
    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['message']; ?></p>
<?php endif; ?>
```

- **`<?php if ($flash): ?>`** — recall this alternative syntax from
  [chapter 2 §2.5](02-includes-header-footer.md#25-the-extra_scripts-pattern-for-per-page-extra-scripts):
  if `$flash` contains something (not `null`), this paragraph is
  displayed; if not, this entire block is **skipped entirely** — no
  empty `<p>` appears in the HTML if there's no flash message.
- **`class="flash flash-<?php echo $flash['type']; ?>"`** — notice
  **two** classes are written at once, separated by a space: `flash`
  (the base style, the same for all flash messages) and
  `flash-error`/`flash-success` (a specific style, depending on the
  value of `$flash['type']` set in `process_add.php`). If
  `$flash['type']` is `'success'`, the final result becomes
  `class="flash flash-success"`. The CSS explanation for both classes
  is in [chapter 6](06-css-flash-message.md).

## 5.4 Rendering the Table from the Session Array

```php
<?php if (empty($books)): ?>
<tr>
    <td colspan="5">No book data yet. Please add one via the "Add Book" menu.</td>
</tr>
<?php else: ?>
    <?php foreach ($books as $book): ?>
    <tr>
        <td><?php echo $book['title']; ?></td>
        <td><?php echo $book['author']; ?></td>
        <td><?php echo $book['year']; ?></td>
        <td><?php echo $book['stock']; ?></td>
        <td>
            <button type="button">Edit</button>
            <button type="button" class="btn-delete">Delete</button>
        </td>
    </tr>
    <?php endforeach; ?>
<?php endif; ?>
```

- **`empty($books)`** — checks whether the `$books` array is **empty**
  (no book has been added yet during this session). If empty, display
  **one message row** ("No book data yet...") using `colspan="5"`
  (recall this attribute from
  [jobsheet-06 documentation §4.7](../../jobsheet-06/Documentation/04-js-fetch-render-books.md#47-catching-and-displaying-the-error) —
  the exact same concept, just now handled in PHP instead of
  JavaScript).
- **`foreach ($books as $book): ... endforeach;`** — iterates over
  **every** element in the `$books` array, with `$book` representing
  one book on each pass. Compare this directly with
  `books.forEach(function (book) { ... })` you already used in
  JavaScript
  ([jobsheet-06 documentation §4.6](../../jobsheet-06/Documentation/04-js-fetch-render-books.md#46-building-table-rows-from-the-data)) —
  **the identical concept** (iterating over every array item), just
  different language syntax.
- **`<?php echo $book['title']; ?>`** — retrieves the value from the
  `'title'` key on the `$book` associative array, exactly the same
  structure as what `process_add.php` stores
  ([chapter 4 §4.5](04-process-add-server-validation.md#45-if-valid-save-to-session--redirect-to-the-list)).

## 5.5 The Big Comparison: Rendering on the Server vs in the Browser

This is the most important conceptual shift in this jobsheet:

| | Jobsheet-06 (Fetch/JSON) | Jobsheet-07 (PHP) |
|---|---|---|
| Where is the table "assembled"? | In the **browser**, by JavaScript (`books.js`) | On the **server**, by PHP (`list.php`) |
| Data source | `data/books.json` file, fetched via `fetch()` | `$_SESSION['books']`, read directly on the server |
| HTML received by the browser | Empty `<tbody>` first, filled in later by JS | `<tbody>` is **already fully filled** from the start — the final result, ready to display |
| Needs a loading indicator? | Yes (recall [jobsheet-06 documentation §4.3](../../jobsheet-06/Documentation/04-js-fetch-render-books.md#43-showing-and-hiding-the-loading-indicator)) | No — the data is already "done" before the page is sent, no gap visible to the user |

Notice `books/list.php` **no longer has** the `#loading-indicator`
element nor loads `books.js` — because there's no more "waiting"
process visible to the user: once `list.php` finishes being processed
by the server, the HTML sent is **already complete**, containing every
table row, ready to be displayed instantly by the browser.

Continue to: [CSS: Flash Message Style](06-css-flash-message.md)
