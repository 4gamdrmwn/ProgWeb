# 8. CSS: Form Styling

This section makes the forms on `books/add.html` and `members/add.html`
look nicer (see its structure in the
[jobsheet-01 HTML documentation](../../jobsheet-01/Documentation/04-books-add-html.md)).

## 8.1 The CSS Code

```css
/* ===== Form ===== */
form p {
    margin-bottom: 1rem;
}

form label {
    display: block;
    margin-bottom: 0.35rem;
    font-weight: 600;
    color: #444;
}

form input,
form select {
    width: 100%;
    max-width: 400px;
    padding: 0.55rem 0.7rem;
    border: 1px solid #cdd4da;
    border-radius: 4px;
    font-size: 1rem;
}

form button[type="submit"] {
    background-color: #1d5b8a;
    color: #fff;
    border: none;
    padding: 0.6rem 1.5rem;
    border-radius: 4px;
    font-size: 1rem;
    cursor: pointer;
}

form button[type="submit"]:hover {
    background-color: #164869;
}
```

## 8.2 Spacing Between Fields

```css
form p {
    margin-bottom: 1rem;
}
```

Recall from the
[HTML documentation](../../jobsheet-01/Documentation/04-books-add-html.md#43-the-pattern-for-each-form-field-label--input),
every form field is wrapped in a `<p>` tag. This rule gives `1rem` of
spacing below **every** `<p>` in the form, so each field (Title, Author,
etc.) has clear spacing from the next field, instead of sticking
together tightly.

## 8.3 Label as Its Own Block

```css
form label {
    display: block;
    margin-bottom: 0.35rem;
    font-weight: 600;
    color: #444;
}
```

- `display: block;` — by default, `<label>` is an *inline* element
  (sitting alongside surrounding text, not automatically moving to a new
  line). Changing it to `block` forces the label to **always fill an
  entire line**, ensuring the input below it (recall the HTML uses
  `<br>` after the label — see
  [HTML documentation §4.3](../../jobsheet-01/Documentation/04-books-add-html.md#43-the-pattern-for-each-form-field-label--input))
  always sits precisely on a new line.
- `margin-bottom: 0.35rem;` — a small gap between the label text and the
  input box below it.
- `font-weight: 600;` — the label is made slightly bold, so the field
  name (e.g. "Title") stands out more compared to regular input text,
  helping the user scan the form quickly.
- `color: #444;` — dark gray, slightly lighter than the body text color
  (`#2b2b2b` from [chapter 3](03-css-reset-and-body.md#32-base-body-style)),
  providing color variation without excessive contrast.

## 8.4 Input & Dropdown Boxes

```css
form input,
form select {
    width: 100%;
    max-width: 400px;
    padding: 0.55rem 0.7rem;
    border: 1px solid #cdd4da;
    border-radius: 4px;
    font-size: 1rem;
}
```

- The `form input, form select` selector (separated by a comma, same as
  `th, td` in [chapter 7](07-css-table.md#73-header-cells-th-and-data-cells-td))
  applies the same style to **every** `<input>` element (including
  `type="text"` and `type="number"`) **and** `<select>` element in the
  form — covering every field discussed in the
  [HTML documentation §4.4](../../jobsheet-01/Documentation/04-books-add-html.md#44-types-of-input-used).
- `width: 100%; max-width: 400px;` — this combination means: the input
  width follows the width of its wrapping box (`100%`), **but** will
  never exceed `400px`. On narrow screens (phones), the input will
  shrink to fully fit the screen; on wide screens, the input won't
  stretch unnaturally as wide as the section (`1000px` from
  [chapter 5](05-css-main-and-section.md)).
- `border: 1px solid #cdd4da;` — a thin light-gray border, replacing the
  browser's default border which is usually thicker/darker.
- `border-radius: 4px;` and `padding`/`font-size` — slightly rounded
  corners and comfortable inner spacing, consistent with the style of
  other components (buttons, cards) on this page.

**Note:** this rule does **not** include `box-sizing`, but because
[chapter 3](03-css-reset-and-body.md#31-css-reset-with-the-universal-selector)
already has `* { box-sizing: border-box; }` applying to all elements,
the `padding` and `border` on this input are automatically "eaten" from
inside `width: 100%`/`max-width: 400px`, instead of adding to the total
width — a concrete benefit of the reset at the top of the file already
explained in [chapter 3](03-css-reset-and-body.md).

## 8.5 Submit Button

```css
form button[type="submit"] {
    background-color: #1d5b8a;
    color: #fff;
    border: none;
    padding: 0.6rem 1.5rem;
    border-radius: 4px;
    font-size: 1rem;
    cursor: pointer;
}

form button[type="submit"]:hover {
    background-color: #164869;
}
```

- **`button[type="submit"]`** is an **attribute selector** (see
  [basic concepts §1.4](01-basic-css-concepts.md#14-types-of-selectors-used-in-stylecss)):
  it selects a `<button>` element whose `type` attribute has exactly the
  value `"submit"`. This specifically targets the "Save" button (see
  [HTML documentation §4.5](../../jobsheet-01/Documentation/04-books-add-html.md#45-submit-button)),
  **without** touching the Edit/Delete buttons in the table which are
  `type="button"`
  ([HTML documentation §3.2](../../jobsheet-01/Documentation/03-books-list-html.md#the-action-column))
  — a real example of why explicitly writing `type="button"` in HTML
  (rather than leaving the default) matters: it becomes a "marker" that
  CSS can use to distinguish button types.
- The button is given a solid theme blue color, white text, no border,
  and a pointer cursor — appearing as a clear primary action button.
- `:hover` changes the color to a **darker** blue (`#164869` compared to
  `#1d5b8a`) when hovered — giving the same kind of visual feedback as
  `a:hover` ([chapter 3](03-css-reset-and-body.md#33-link-style-a)) and
  `tbody tr:hover` ([chapter 7](07-css-table.md#75-alternating-rows-hover-effect)).

Next: [CSS: Footer](09-css-footer.md)
