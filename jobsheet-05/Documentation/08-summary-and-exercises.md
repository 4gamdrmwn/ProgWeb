# 8. Summary & Further Exercises

## 8.1 Overall Jobsheet 5 Summary

| Section | Function in `app.js` | Concepts Learned |
|---|---|---|
| [Basic JS & DOM Concepts](01-basic-javascript-dom-concepts.md) | — | `<script>`, DOM, `getElementById`/`querySelector`, events & event listeners |
| [HTML Changes](02-html-file-changes.md) | — | Real hamburger button, `search-box`, `btn-delete` class, `id="add-form"` |
| [Supporting CSS](03-css-supporting-javascript.md) | — | Styles for `.error`, `.search-box`, hamburger adjustments |
| [Hamburger Menu](04-js-hamburger-menu.md) | `initNavToggle` | `classList.toggle()`, `click` event, guard clause |
| [Delete Confirmation](05-js-delete-confirmation.md) | `initDeleteConfirm` | `querySelectorAll` + `forEach`, `closest()`, `confirm()`, `remove()` |
| [Table Filter](06-js-table-filter.md) | `initTableFilter` | `keyup` event, `textContent`, `style.display`, `includes()` |
| [Form Validation](07-js-form-validation.md) | `initFormValidation`, `showError`, `removeError` | `submit` event, `preventDefault()`, `createElement`, `insertAdjacentElement`, `classList.contains()` |

## 8.2 Core Concepts to Remember

1. **JavaScript adds a behavior layer**, separate from structure (HTML)
   and appearance (CSS) — connected via `<script src="...">` placed at
   the end of `<body>` ([chapter 1](01-basic-javascript-dom-concepts.md)).
2. **The DOM is an object "tree"** that can be read and modified via
   `getElementById`/`querySelector`/`querySelectorAll`, using the same
   CSS selectors you've mastered since jobsheet-02
   ([chapter 1 §1.5](01-basic-javascript-dom-concepts.md#15-selecting-elements-from-the-dom)).
3. **Event listeners are the core interactivity pattern**: select an
   element → `.addEventListener(event, function)` → write the
   reaction. Three main events in this jobsheet: `click`, `keyup`,
   `submit`
   ([chapter 1 §1.6](01-basic-javascript-dom-concepts.md#16-what-are-events-and-event-listeners)).
4. **`classList.toggle()`/`.contains()`** are modern ways to manage
   display state via CSS classes, replacing pure-CSS tricks like the
   checkbox hack once JavaScript is available
   ([chapter 4 §4.6](04-js-hamburger-menu.md#46-comparison-with-the-checkbox-hack-jobsheet-03)).
5. **Guard clauses** (`if (!element) return;`) matter so the same
   JavaScript file can safely be used across many different pages,
   without errors on pages that lack a certain element
   ([chapter 1 §1.7](01-basic-javascript-dom-concepts.md#17-general-code-structure-in-appjs)).
6. **Client-side validation can be bypassed** and is not a substitute
   for server-side validation — it's a user-convenience layer, not a
   security layer
   ([chapter 7 §7.8](07-js-form-validation.md#78-why-do-html-validations-required-min-max-still-need-to-be-duplicated-in-js)).

## 8.3 How to Try It Yourself

1. Open `index.html`, shrink the screen to mobile mode (responsive
   DevTools, recall how from
   [jobsheet-03 documentation §5.6](../../jobsheet-03/Documentation/05-css-media-query-breakpoint.md#56-how-to-test-yourself-in-browser)),
   then click the hamburger icon — compare the feel with the checkbox
   hack version in jobsheet-03 (visually identical, but the mechanism
   is totally different under the hood).
2. Open `books/list.html`, type part of a book title (e.g. "bumi") in
   the search box, watch other rows automatically disappear. Delete
   the text again, watch all rows reappear.
3. Click the "Delete" button on one of the rows — a confirmation dialog
   appears. Click "Cancel", the row stays. Try again and click "OK",
   the row disappears. Refresh the page — notice that row reappears
   (recall the note in
   [chapter 5 §5.6](05-js-delete-confirmation.md#56-removing-the-row-from-the-view)).
4. Open `books/add.html`, immediately click "Save" without filling in
   anything — watch red error messages appear below the required
   fields. Fill in one of the fields with an error, click "Save" again
   — watch that field's error message disappear, while other fields
   still empty keep showing their errors.
5. Open **DevTools Console** (`F12` → *Console* tab) while trying steps
   2-4 above — notice no JavaScript error messages appear, indicating
   the guard clauses and element handling are correct.

## 8.4 Additional Exercise Ideas (Optional)

1. **Add validation for a new field** — for example the ISBN field on
   the Add Book form (which is currently not required, recall from
   [jobsheet-01 documentation §4.4](../../jobsheet-01/Documentation/04-books-add-html.md#44-types-of-input-used))
   so it only accepts numbers and hyphens.
2. **Add a simple animation** to `initNavToggle` — for example add a
   CSS `transition` class on `header nav` in `style.css` so the menu
   opens/closes with a smooth slide effect, instead of appearing/
   disappearing instantly.
3. **Extend `initTableFilter`** so the search can be limited to just
   one column (e.g. only the "Title" column), instead of searching
   the entire row's text — hint: use `row.querySelector("td")` like
   the pattern already used in
   [chapter 5 §5.4](05-js-delete-confirmation.md#54-getting-the-nametitle-from-that-row),
   instead of `row.textContent`.
4. **Add a remaining-row counter** after filtering or deleting —
   display something like "Showing 3 of 5 books" above the table,
   updated every time `initTableFilter` or `initDeleteConfirm` runs.
5. **Refactor the validation** — try changing `initFormValidation` so
   the required field names are taken from an array/list, instead of
   writing a separate `if` block for each field one by one (hint: think
   about the `forEach` iteration pattern already used in
   [chapter 5](05-js-delete-confirmation.md) and [chapter 6](06-js-table-filter.md)).

If any part is still confusing, try re-reading
[chapter 1](01-basic-javascript-dom-concepts.md) while practicing
directly in the DevTools Console — type
`document.querySelector("header nav")` in the Console tab of any page,
then observe what element gets returned, so the concept of "selecting
elements from the DOM" feels real, not just theory.
