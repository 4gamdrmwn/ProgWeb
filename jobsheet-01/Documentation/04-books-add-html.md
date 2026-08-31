# 4. Explanation of `books/add.html` (Add Book Form)

This file displays a **form** for adding new book data. It is the first
file in this jobsheet to introduce the `<form>` element and various
`<input>` types.

## 4.1 Full Form Code

```html
<form>
    <p>
        <label for="judul">Title</label><br>
        <input type="text" id="judul" name="judul" required>
    </p>
    <p>
        <label for="pengarang">Author</label><br>
        <input type="text" id="pengarang" name="pengarang" required>
    </p>
    <p>
        <label for="tahun">Publication Year</label><br>
        <input type="number" id="tahun" name="tahun" min="1900" max="2026" required>
    </p>
    <p>
        <label for="isbn">ISBN</label><br>
        <input type="text" id="isbn" name="isbn">
    </p>
    <p>
        <label for="stok">Stock</label><br>
        <input type="number" id="stok" name="stok" min="0" required>
    </p>
    <p>
        <label for="kategori">Category</label><br>
        <select id="kategori" name="kategori">
            <option value="fiksi">Fiction</option>
            <option value="non-fiksi">Non-Fiction</option>
            <option value="referensi">Reference</option>
        </select>
    </p>
    <p>
        <button type="submit">Save</button>
    </p>
</form>
```

## 4.2 The `<form>` Element

```html
<form>
    ...
</form>
```

`<form>` wraps all the input elements that **will be sent together** when
the submit button is pressed. Notice that the `<form>` tag here **has no
`action` or `method` attribute** — meaning if the "Save" button is pressed
right now, this form **doesn't send data anywhere yet** (the browser will
just reload the same page). This matches the note in the README: the
form is "not yet processed". Connecting the form to data storage
(`action="..."`, `method="post"`, then a backend that processes it) is
material for the next jobsheet.

## 4.3 The Pattern for Each Form Field: `<label>` + `<input>`

Each field is wrapped in a `<p>` (paragraph) and contains a
`<label>`–`<input>` pair, for example:

```html
<p>
    <label for="judul">Title</label><br>
    <input type="text" id="judul" name="judul" required>
</p>
```

- **`<label for="judul">Title</label>`** — the caption text "Title" shown
  next to/above the input box. The `for="judul"` attribute **connects**
  this label to the input whose `id` is `judul`. Benefit: if the user
  clicks the "Title" label text, the browser automatically focuses the
  cursor on its input box — an important practice for accessibility and
  user convenience (especially on mobile, where the click area becomes
  larger).
- **`<br>`** — line break, moves the input to a new line below the label
  (instead of sitting next to it).
- **`<input>`** — the input box itself. Its important attributes:
  - `type="text"` — an input type for free-form text.
  - `id="judul"` — this element's unique identity on the page, used to
    connect it with the `<label for="judul">` above.
  - `name="judul"` — the field name sent to the server when the form is
    submitted (e.g. `judul=Laskar+Pelangi`). **`id` and `name` are
    intentionally given the same value** in this form for convenience,
    but they serve different purposes: `id` connects to
    `<label>`/CSS/JS on **this page**, while `name` is for the **data
    sent** to the server.
  - `required` — a built-in HTML5 validation attribute: the browser will
    refuse to submit the form (and show a warning message) if this field
    is left empty.

## 4.4 Types of Input Used

| Field | Code | Explanation |
|---|---|---|
| Title | `<input type="text" ... required>` | Free-form text, required. |
| Author | `<input type="text" ... required>` | Free-form text, required. |
| Publication Year | `<input type="number" min="1900" max="2026" required>` | Only accepts numbers; `min`/`max` limits the year to a sensible range (1900–2026) directly in the browser, with no extra JavaScript needed. |
| ISBN | `<input type="text" ... >` (no `required`) | Free-form text, **can be left empty** — not every old book has an ISBN. |
| Stock | `<input type="number" min="0" required>` | Number, minimum `0` (stock can't be negative), required. |
| Category | `<select>` with `<option>` | See explanation below. |

### `<select>` and `<option>` — Dropdown Choices

```html
<select id="kategori" name="kategori">
    <option value="fiksi">Fiction</option>
    <option value="non-fiksi">Non-Fiction</option>
    <option value="referensi">Reference</option>
</select>
```

- `<select>` creates a **dropdown menu** (a box that can be clicked to
  open a list of options).
- Each `<option>` is one choice inside that dropdown.
  - `value="fiksi"` — the value **actually sent** to the server when
    selected.
  - `Fiction` (the text between the tags) — what is **displayed** to the
    user on screen.
  - The `value` and displayed text **don't have to match**; here they
    happen to be similar (`non-fiksi` vs `Non-Fiction`) to keep the code
    and the display consistent and readable.
- Unlike the other fields, `<select>` here does **not** have `required`
  because there's always a default selected option (the first one,
  `Fiction`), so this field is automatically "filled".

## 4.5 Submit Button

```html
<button type="submit">Save</button>
```

- `type="submit"` makes this button, when clicked, **send the entire form
  content** (according to the `action`/`method` rules on the `<form>`
  tag — which are currently empty). This differs from the
  `type="button"` buttons in
  [books/list.html](03-books-list-html.md#the-action-column) which don't
  submit anything.
- Because `<form>` has no `action` yet, clicking "Save" right now will
  just reload the same page with no visible effect.

## 4.6 Learning Flow Summary

Key order to remember from this file:

1. `<form>` = the container for sending data.
2. `<label for="...">` is paired with an `<input id="...">` sharing the
   same value.
3. `name="..."` determines the name of the data sent to the server.
4. HTML5 attributes (`required`, `min`, `max`) provide basic validation
   **without JavaScript**.
5. `<select>`/`<option>` is used when the user's choice is limited to a
   few fixed options (rather than free text).

Next: [Explanation of `members/list.html`](05-members-list-html.md)
