# 7. CSS: Table Styling

This section makes the `<table>` on `books/list.html` and
`members/list.html` look nicer (see its structure in the
[jobsheet-01 HTML documentation §3.2](../../jobsheet-01/Documentation/03-books-list-html.md#32-anatomy-of-an-html-table)).

## 7.1 The CSS Code

```css
/* ===== Table ===== */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    text-align: left;
    padding: 0.65rem 0.75rem;
    border-bottom: 1px solid #e2e6ea;
}

thead {
    background-color: #1d5b8a;
    color: #fff;
}

tbody tr:nth-child(even) {
    background-color: #f7f9fb;
}

tbody tr:hover {
    background-color: #eef4fa;
}

td button {
    padding: 0.35rem 0.7rem;
    margin-right: 0.35rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.85rem;
}

td button:first-of-type {
    background-color: #f0ad4e;
    color: #fff;
}

td button:last-of-type {
    background-color: #d9534f;
    color: #fff;
}
```

## 7.2 Table Width & `border-collapse`

```css
table {
    width: 100%;
    border-collapse: collapse;
}
```

- `width: 100%;` — the table stretches to fill the entire width of its
  wrapping box (the `<section>` card, see [chapter 5](05-css-main-and-section.md)),
  not just as wide as its longest content like the default table
  behavior.
- `border-collapse: collapse;` — makes the borders between table cells
  **merge into a single thin line**, instead of showing as two separate
  lines with a gap between them (the default `border-collapse: separate`
  behavior). This is what makes the row divider lines in the table look
  neat and thin, not doubled up.

## 7.3 Header Cells (`th`) and Data Cells (`td`)

```css
th, td {
    text-align: left;
    padding: 0.65rem 0.75rem;
    border-bottom: 1px solid #e2e6ea;
}
```

- The `th, td` selector (separated by a comma) means the same rule is
  applied to **both** cell types at once — a way to shorten the code
  when two different selectors need identical styling, instead of
  writing two separate blocks.
- `text-align: left;` — left-aligned text. This is explicitly written
  because `<th>` has center alignment (`center`) by default in most
  browsers — this rule makes `th` alignment match `td`, so the heading
  and data columns line up neatly.
- `border-bottom: 1px solid #e2e6ea;` — a thin light-gray line **only at
  the bottom** of each cell, separating one row from the row below it
  (similar to the lines in a simple Excel table, with no vertical lines
  between columns).

## 7.4 Colored Table Header

```css
thead {
    background-color: #1d5b8a;
    color: #fff;
}
```

The column heading row (`<thead>`, see the
[jobsheet-01 HTML documentation](../../jobsheet-01/Documentation/03-books-list-html.md#32-anatomy-of-an-html-table))
is given the same theme blue background as the page header, with white
text — visually emphasizing that this row is a "column heading",
distinct from the data rows below it.

## 7.5 Alternating Rows & Hover Effect

```css
tbody tr:nth-child(even) {
    background-color: #f7f9fb;
}

tbody tr:hover {
    background-color: #eef4fa;
}
```

- **`tbody tr:nth-child(even)`** — similar to `:nth-of-type(2)` in
  [chapter 6](06-css-grid-stat-cards.md#63-the-nth-of-type2-selector-selecting-only-the-second-section),
  but `:nth-child(even)` selects **every even-numbered row** (row 2, 4,
  6, etc.) inside `<tbody>`, giving it a very light gray background
  (`#f7f9fb`) that's slightly different from the section's white
  background. This effect is called **zebra stripes** — a classic table
  design technique that helps the reader's eye **follow a single row of
  data horizontally** without "getting lost" on another row, especially
  in tables with many columns.
- **`tbody tr:hover`** — the `:hover` pseudo-class, the same concept as
  `a:hover` in [chapter 3](03-css-reset-and-body.md#33-link-style-a):
  when the mouse cursor is hovered over a row, that row's background
  changes to a very light blue (`#eef4fa`, the same color as the
  statistic card background in [chapter 6](06-css-grid-stat-cards.md#66-styling-the-content-of-each-card-article)),
  indicating which row is currently being "highlighted" — useful
  especially when a table has many rows.

**Important note:** this `:hover` rule is placed **after** the
`:nth-child(even)` rule in the CSS file. Since both have the same
specificity (both are one pseudo-class plus `tr`), the order they're
written in the file **determines** which rule wins when the cursor is
over an even row — and because `:hover` is written later, its color
(`#eef4fa`) is the one that shows, overriding the zebra stripe color
(`#f7f9fb`) while the cursor is there.

## 7.6 Action Buttons (Edit & Delete)

```css
td button {
    padding: 0.35rem 0.7rem;
    margin-right: 0.35rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.85rem;
}
```

This is the base style applied to **both** buttons (Edit and Delete) in
the "Action" column (see its HTML in the
[jobsheet-01 documentation](../../jobsheet-01/Documentation/03-books-list-html.md#the-action-column)):

- `border: none;` — removes the default button border/frame (usually a
  gray 3D look like old Windows buttons).
- `border-radius: 4px;` — slightly rounded corners.
- `cursor: pointer;` — changes the mouse cursor into a "pointing hand"
  icon while over the button, giving a visual signal that this element
  is clickable (HTML buttons usually already do this by default, but
  this line guarantees consistency even if other styles change).
- `margin-right: 0.35rem;` — spacing to the right of each button, so the
  "Edit" and "Delete" buttons don't stick together.

```css
td button:first-of-type {
    background-color: #f0ad4e;
    color: #fff;
}

td button:last-of-type {
    background-color: #d9534f;
    color: #fff;
}
```

These two rules differentiate colors **based on button order**, not
based on the button's text/content:

- **`:first-of-type`** — the **first** button among buttons of the same
  kind within the same cell → given an **orange/yellow** color
  (`#f0ad4e`). Since in the HTML the first button is always "Edit", the
  Edit button visually always ends up orange.
- **`:last-of-type`** — the **last** button → given a **red** color
  (`#d9534f`), following the common UI convention that red signals a
  risky/destructive action like "Delete".

This is another example of the same pattern as the
[statistic cards in chapter 6](06-css-grid-stat-cards.md#67-why-not-just-use-a-class):
CSS "guesses" an element's role from its **position** in the HTML (first
button = Edit, last button = Delete), rather than from a special `class`
like `class="btn-edit"` or `class="btn-delete"`. This approach is
concise, but assumes the button order in the HTML **won't change** — if
you ever add a third button (e.g. "Detail") between Edit and Delete, the
colors may no longer match what you expect.

Next: [CSS: Form Styling](08-css-form.md)
