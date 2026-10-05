# 5. JS: Delete Confirmation

This function makes the "Delete" button in the Book/Member List tables
— which since jobsheet-01 was just decoration with no function
([jobsheet-01 documentation](../../jobsheet-01/Documentation/03-books-list-html.md#the-action-column)) —
finally do something.

## 5.1 Full Code

```js
// ===== Delete confirmation (front-end only, not yet sent to the server) =====
function initDeleteConfirm() {
    document.querySelectorAll(".btn-delete").forEach(function (btn) {
        btn.addEventListener("click", function () {
            const row = btn.closest("tr");
            const name = row ? row.querySelector("td")?.textContent : "this item";
            const confirmed = confirm("Are you sure you want to delete \"" + name + "\"?");
            if (confirmed && row) {
                row.remove();
            }
        });
    });
}
```

## 5.2 Attaching an Event Listener to Multiple Buttons at Once

```js
document.querySelectorAll(".btn-delete").forEach(function (btn) {
    btn.addEventListener("click", function () {
        // ...
    });
});
```

Recall from [chapter 1 §1.5](01-basic-javascript-dom-concepts.md#15-selecting-elements-from-the-dom),
`querySelectorAll(".btn-delete")` grabs **all** Delete buttons on one
page (5 buttons on Book List, 2 buttons on Member List — recall this
class was just added in
[chapter 2 §2.3](02-html-file-changes.md#23-the-btn-delete-class-on-the-delete-button)).
Since the result is a **collection** of elements (not a single element
like `getElementById`), we need **`.forEach(...)`** to iterate one by
one, and attach `addEventListener` **separately** to each button — every
Delete button gets its own "click listener".

## 5.3 Finding the Table Row That Owns the Button

```js
const row = btn.closest("tr");
```

**`.closest("tr")`** is a method that searches **upward** from the
`btn` element (the button that was clicked) toward its ancestor
elements, stopping as soon as it finds the first element matching the
`"tr"` selector — in this case, the table row (`<tr>`) wrapping that
button (recall the table structure from
[jobsheet-01 documentation §3.2](../../jobsheet-01/Documentation/03-books-list-html.md#32-anatomy-of-an-html-table):
the Delete button is inside a `<td>`, which is inside a `<tr>`).
`.closest()` is useful precisely because the button itself **doesn't
know** which row it's in — it just knows "find the nearest `<tr>` above
me", regardless of whether it's row 1, 3, or 5.

## 5.4 Getting the Name/Title from That Row

```js
const name = row ? row.querySelector("td")?.textContent : "this item";
```

This line looks complex — let's break it down from the outside in:

- **`condition ? valueIfTrue : valueIfFalse`** is the **ternary
  operator** — a shorthand form of `if/else` written on a single line
  as a *value* (not as a separate block of code). This line is
  equivalent to:
  ```js
  let name;
  if (row) {
      name = row.querySelector("td")?.textContent;
  } else {
      name = "this item";
  }
  ```
- **`row.querySelector("td")`** — grabs the **first** `<td>` cell in
  that row (recall the Book List column order: Title, Author, Year,
  Stock, Action — so the first `<td>` always holds the book's
  **Title**, or the **Member ID** in the Member table).
- **`?.`** (called *optional chaining*) — similar to a regular dot
  (`.`) for accessing a property, but **safe** if the value before it
  is `null`/`undefined`. If `row.querySelector("td")` finds nothing
  (returns `null`), `?.textContent` won't cause an error, but will
  safely return `undefined` instead.
- **`.textContent`** — grabs the **displayed text** inside that element
  (e.g. `"Laskar Pelangi"`).
- If `row` itself turns out to be `null` (a case that should rarely
  happen), the fallback text `"this item"` is used instead, so the
  confirmation message still makes sense (see
  [§5.5](#55-showing-the-confirmation-dialog)).

## 5.5 Showing the Confirmation Dialog

```js
const confirmed = confirm("Are you sure you want to delete \"" + name + "\"?");
```

**`confirm(message)`** is a built-in browser function (not something
that needs to be imported/defined) that shows the browser's **built-in
dialog box** containing a message, with two buttons: **OK** and
**Cancel**. This function **pauses** code execution (and user
interaction with the page) until the user picks one of the buttons,
then returns `true` (if OK was clicked) or `false` (if Cancel was
clicked) — that value is what gets stored in the `confirmed` variable.

Notice the double quote escaped with a backslash (`\"`) inside a string
that is also wrapped in double quotes — this is needed so JavaScript
doesn't mistake the quote in the middle of the text as the end of the
string. The final result, the message shown to the user, would be
something like: `Are you sure you want to delete "Laskar Pelangi"?`.

## 5.6 Removing the Row from the View

```js
if (confirmed && row) {
    row.remove();
}
```

- `&&` means **and** — the code inside `if` only runs if **both**
  conditions are true: the user pressed OK (`confirmed` is `true`)
  **and** the `row` was actually found.
- **`row.remove()`** is a DOM method that removes that element **from
  the page's view** immediately — the table row will vanish from the
  screen instantly, without needing to reload the page.

**Important to remember** (also mentioned in this jobsheet's
[README.md](../README.md)): `row.remove()` **only** removes the element
from the browser's current DOM/view. Once the page is refreshed, that
row will **reappear** because the data is still written as-is in the
HTML file — there's no mechanism yet that truly deletes data
permanently (e.g. from a database). A real delete feature won't be
built until Jobsheet 9.

Continue to: [JS: Real-Time Table Filter](06-js-table-filter.md)
