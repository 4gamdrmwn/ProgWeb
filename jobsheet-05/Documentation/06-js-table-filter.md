# 6. JS: Real-Time Table Filter

This function connects the new search box
([chapter 2 §2.2](02-html-file-changes.md#22-new-search-box-on-the-list-pages))
with the table below it, filtering rows **while** the user types —
no separate "Search" button, no page reload.

## 6.1 Full Code

```js
// ===== Real-time table filter/search =====
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    if (!input || !table) return;

    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");
        rows.forEach(function (row) {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(keyword) ? "" : "none";
        });
    });
}
```

## 6.2 Getting the Input Box and the Table

```js
const input = document.getElementById("search-input");
const table = document.querySelector(".table-responsive table");
```

- `input` — the search box, found via `id="search-input"` (recall from
  [chapter 2 §2.2](02-html-file-changes.md#22-new-search-box-on-the-list-pages)).
- `table` — found with the selector `".table-responsive table"`, a
  descendant selector that grabs the `<table>` element inside `<div
  class="table-responsive">` (recall this wrapper from
  [jobsheet-03 documentation](../../jobsheet-03/Documentation/04-css-table-responsive.md)).
  This selector is intentionally **specific** (not just `"table"`) so
  that if there's ever another table on the same page for a different
  purpose, this function won't target the wrong one.
- Guard clause `if (!input || !table) return;` — the exact same pattern
  as [chapter 4 §4.3](04-js-hamburger-menu.md#43-guard-clause),
  ensuring this function is safe to call on any page (including Home,
  which has neither a search box nor a table at all).

## 6.3 The `keyup` Event: Reacting to Every Keystroke

```js
input.addEventListener("keyup", function () {
    // ...
});
```

Recall from [chapter 1 §1.6](01-basic-javascript-dom-concepts.md#16-what-are-events-and-event-listeners),
the `keyup` event occurs every time a keyboard key is **released**
(after being pressed) while focus is on the `input` element. Since this
event fires for **every letter** typed (rather than waiting for the
user to press Enter or a "Search" button), the effect feels like
"real-time" search — the table gets filtered immediately as the user
types.

## 6.4 Getting the Search Keyword

```js
const keyword = input.value.toLowerCase();
```

- **`input.value`** — the value/text **currently** typed inside the
  input box (different from the `placeholder` from
  [chapter 2 §2.2](02-html-file-changes.md#22-new-search-box-on-the-list-pages),
  which is just example text, not an actual value).
- **`.toLowerCase()`** — converts all letters to lowercase. This is
  important so the search is **case-insensitive** — typing "laskar"
  still finds "Laskar Pelangi" even though the "L" is uppercase in the
  original data.

## 6.5 Iterating Over Every Table Row

```js
const rows = table.querySelectorAll("tbody tr");
rows.forEach(function (row) {
    const text = row.textContent.toLowerCase();
    row.style.display = text.includes(keyword) ? "" : "none";
});
```

- `table.querySelectorAll("tbody tr")` — grabs **all** data rows
  (recall from [jobsheet-01 documentation §3.2](../../jobsheet-01/Documentation/03-books-list-html.md#32-anatomy-of-an-html-table),
  data rows live inside `<tbody>`, separate from the column header row
  in `<thead>` — so the header row is **not** filtered/hidden along
  with the rest).
- For **every** row, `row.textContent` grabs **all the text** inside
  that row (combining all its `<td>` cells into one long string,
  including the "Edit"/"Delete" button text), then also converts it to
  lowercase (`.toLowerCase()`) to stay consistent with `keyword`.
- **`text.includes(keyword)`** — returns `true` if `text` **contains**
  `keyword` anywhere (not necessarily an exact match from the start).
  Example: `"laskar pelangi andrea hirata 2005 4"
  .includes("hirata")` is `true`.
- **`row.style.display = ... ? "" : "none";`** — sets the CSS `display`
  property **directly from JavaScript**:
  - If `text.includes(keyword)` is `true` (row matches) →
    `row.style.display = ""` — clears the `display` value so it
    reverts to the table's default behavior (row shows normally).
  - If `false` (no match) → `row.style.display = "none"` — the row is
    **completely hidden** from view.

## 6.6 Why Hide the Row, Instead of Deleting It?

Notice this function uses `row.style.display = "none"`, **not**
`row.remove()` like the Delete button in
[chapter 5 §5.6](05-js-delete-confirmation.md#56-removing-the-row-from-the-view).
This is an important distinction: `.remove()` **permanently deletes**
the element from the DOM (it would need to be recreated to bring it
back), while `style.display = "none"` only **temporarily hides** it —
the element stays in the DOM, just invisible. This is the right choice
for a search feature: as soon as the user **deletes** the text in the
search box (back to empty), this function runs again and `keyword`
becomes an empty string (`""`) — and **every** row's text is
guaranteed to "contain" the empty string (`text.includes("")` is
always `true`), so **all rows automatically reappear** without any
extra logic needed.

Continue to: [JS: Form Validation](07-js-form-validation.md)
