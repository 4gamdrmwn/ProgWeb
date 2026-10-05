# 2. What Changed in the HTML Files?

## 2.1 The `<tbody>` is Now Empty

Direct comparison with `books/list.html` in
[jobsheet-01 documentation](../../jobsheet-01/Documentation/03-books-list-html.md#32-anatomy-of-an-html-table):
previously the `<tbody>` contained 5 manually written `<tr>` rows. Now:

```html
<tbody>
    <!-- Rows filled dynamically by assets/js/books.js via fetch('../data/books.json') -->
</tbody>
```

The `<tbody>` is **genuinely empty** — it only contains an HTML comment
(`<!-- ... -->`, not displayed on screen, just a note for anyone
reading the code) explaining that the rows will be filled in later by
JavaScript after the page loads. If you open this file directly without
JavaScript active, the table will **appear empty** — only the column
header row (`<thead>`) will be visible.

## 2.2 New Element: Loading Indicator

```html
<p id="loading-indicator" style="display:none;">Loading data...</p>
```

A new `<p>` element is placed between the search box
([jobsheet-05 documentation §2.2](../../jobsheet-05/Documentation/02-html-file-changes.md#22-new-search-box-on-the-list-pages))
and the table. Two things to note:

- **`id="loading-indicator"`** — the "hook" JavaScript looks for via
  `document.getElementById("loading-indicator")` (explained in
  [chapter 4](04-js-fetch-render-books.md)).
- **`style="display:none;"`** — this is an example of **inline style**,
  CSS written **directly** in an HTML element's `style` attribute,
  rather than in a separate `style.css` file as you've always done
  since [jobsheet-02 documentation](../../jobsheet-02/Documentation/README.md).
  This element is **deliberately hidden from the start** (`display:none`)
  because the "Loading data..." text only needs to be visible
  **briefly**, while the data-fetching process is in progress —
  JavaScript will show and hide it again programmatically (explained in
  [chapter 4 §4.3](04-js-fetch-render-books.md#43-showing-and-hiding-the-loading-indicator)).
  Since this style is only used **once** on one specific element and
  its status will keep being changed via JavaScript (not via a CSS
  selector), writing it inline here is more practical than creating a
  new dedicated rule in `style.css`.

## 2.3 The New `<script>` Tag Order

```html
<script src="../assets/js/app.js"></script>
<script src="../assets/js/books.js"></script>
```

There are now **two** `<script>` tags in `books/list.html` (and
`members/list.html` loads `app.js` + `members.js`), loaded
**sequentially** from top to bottom — just like the browser reads HTML
from top to bottom, as already discussed in
[jobsheet-05 documentation §1.3](../../jobsheet-05/Documentation/01-basic-javascript-dom-concepts.md#13-why-is-script-placed-at-the-end-of-body).
`app.js` (containing general-purpose functions like the hamburger menu,
form validation, table filter — see
[jobsheet-05 documentation](../../jobsheet-05/Documentation/README.md)) is
always loaded **first**, followed by the page-specific file
(`books.js` or `members.js`) whose content is specific to just that one
page. The `books/add.html` page and Home **don't** load
`books.js`/`members.js` at all — because those pages don't have a table
that needs to be filled with dynamic data.

## 2.4 Why Are `books.js` and `members.js` Separated, Instead of Merged into `app.js`?

This is a good design decision to understand: `app.js` contains
functions that are **relevant across many pages at once** (the
hamburger menu appears on every page, form validation only on "add"
pages, table filter on "list" pages). Meanwhile, the logic for fetching
JSON data is **specific** to one type of data (books **or** members) —
separating it into its own file makes each file shorter, easier to
find, and pages that don't need it (e.g. Home) don't need to load
irrelevant code at all.

Continue to: [JSON Data: `books.json` & `members.json`](03-json-data.md)
