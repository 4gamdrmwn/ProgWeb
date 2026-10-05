# 2. What Changed in the HTML Files?

Before dissecting `app.js` function by function, first get familiar with
the small HTML changes that become "hooks" for JavaScript to find the
elements it needs to manipulate. Without these changes, `app.js` would
have no elements it could find via `getElementById`/`querySelector`
(recall the concept from
[chapter 1 §1.5](01-basic-javascript-dom-concepts.md#15-selecting-elements-from-the-dom)).

## 2.1 Hamburger: From Checkbox to a Real Button

**Previously (jobsheet-03),** the hamburger menu was made from a pair of
`<input type="checkbox">` + `<label>` (checkbox hack, see
[jobsheet-03 documentation](../../jobsheet-03/Documentation/03-css-hamburger-checkbox-hack.md)).
**Now:**

```html
<button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Menu">&#9776;</button>
```

- The `<input type="checkbox">` element is **completely removed** — no
  longer needed because the open/closed status of the menu is now
  stored via a CSS class added by JavaScript, not the checkbox's
  "checked" status (explained in detail in
  [chapter 4](04-js-hamburger-menu.md)).
- `<label>` is replaced with `<button type="button">` — a real button
  designed to be clicked, with `id="nav-toggle-btn"` as the "hook" so
  `document.getElementById("nav-toggle-btn")` in `app.js` can find it.
- The class `nav-toggle-label` is **kept as-is** (even though the
  element is no longer a `<label>`) so the existing CSS style (font
  size, color, etc. — see
  [jobsheet-03 documentation §3.1](../../jobsheet-03/Documentation/03-css-hamburger-checkbox-hack.md#31-css-snippets-involved))
  doesn't need to be rewritten. The CSS changes needed are discussed in
  [chapter 3](03-css-supporting-javascript.md).
- **`aria-label="Menu"`** is a new attribute for **accessibility** —
  telling screen readers that this button with the ☰ symbol has the
  function "Menu", because the `&#9776;` text itself (recall this
  entity from
  [jobsheet-03 documentation §2.2](../../jobsheet-03/Documentation/02-changes-to-html-files.md#22-checkbox--label-pair-for-hamburger-menu))
  doesn't mean anything if read out as plain text.

## 2.2 New Search Box on the List Pages

In `books/list.html` and `members/list.html`, there's a new `<div>`
before the table:

```html
<div class="search-box">
    <label for="search-input">Search Book Title</label>
    <input type="text" id="search-input" placeholder="Type book title...">
</div>
```

- This `<label for="...">` + `<input id="...">` pattern is **exactly
  the same** as the form pattern you've mastered since
  [jobsheet-01 documentation](../../jobsheet-01/Documentation/04-books-add-html.md#43-the-pattern-for-each-form-field-label--input) —
  even though this `<input>` is **not inside a `<form>`**, because it's
  not meant to be "saved" or submitted, only to have its value read
  directly by JavaScript every time it's typed into (explained in
  [chapter 6](06-js-table-filter.md)).
- The **`placeholder`** attribute is an HTML attribute not used in
  previous jobsheets — it shows gray example text (e.g. "Type book
  title...") inside the input box **while it's still empty**, and the
  text automatically disappears once the user starts typing. Unlike
  `value`, placeholder text **is not submitted** when the form is
  submitted.
- `id="search-input"` is the "hook" that
  `document.getElementById("search-input")` looks for in `app.js`
  ([chapter 6](06-js-table-filter.md)).

## 2.3 The `btn-delete` Class on the Delete Button

```html
<button type="button">Edit</button>
<button type="button" class="btn-delete">Delete</button>
```

Recall from [jobsheet-01 documentation](../../jobsheet-01/Documentation/03-books-list-html.md#the-action-column),
both the Edit and Delete buttons in the "Action" column originally had
no function at all (`type="button"` with no action). Now the Delete
button is given **`class="btn-delete"`** — not for CSS styling purposes
(its color is still set via `:last-of-type` as explained in
[jobsheet-02 documentation §7.6](../../jobsheet-02/Documentation/07-css-table.md#76-action-buttons-edit--delete)),
but so that `document.querySelectorAll(".btn-delete")` in `app.js` can
find **all** Delete buttons at once on one page (explained in
[chapter 5](05-js-delete-confirmation.md)). The **Edit button isn't given
any class** because this jobsheet hasn't added any function for it yet.

## 2.4 `id="add-form"` on the Add Book/Member Form

```html
<form id="add-form">
```

Both forms (`books/add.html` and `members/add.html`) now have
`id="add-form"` on their `<form>` tag — previously
([jobsheet-01 documentation](../../jobsheet-01/Documentation/04-books-add-html.md#42-the-form-element))
the `<form>` tag had no attributes at all. This `id` is the "hook"
that `document.getElementById("add-form")` looks for, so JavaScript can
attach a **submit event listener** for validation (explained in detail
in [chapter 7](07-js-form-validation.md)). Note that **both forms** use
the **same** `id` (`add-form`) even though their fields differ
(Title/Author for books, Name/Member ID for members) — this is safe
because an `id` only needs to be unique **within a single page**, and
these two forms live on different pages. How `app.js` handles the
difference in fields between the two forms with **one shared
validation function** is discussed in
[chapter 7](07-js-form-validation.md).

Continue to: [CSS Supporting the JavaScript Features](03-css-supporting-javascript.md)
