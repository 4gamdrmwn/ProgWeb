# 2. What Changes in HTML Files?

Just like the transition from jobsheet-01 → jobsheet-02
([see explanation of this pattern](../../jobsheet-02/Documentation/02-changes-to-html-files.md#22-why-html-structure-is-intentionally-not-changed)),
the overall HTML structure in jobsheet-03 **does not change** from jobsheet-02.
There are 3 small but important additions to HTML, plus some new CSS lines purely in `style.css` (discussed starting [chapter 3](03-css-hamburger-checkbox-hack.md)).

## 2.1 `<meta viewport>`

```html
<meta name="viewport" content="width=device-width, initial-scale=1">
```

Added to the `<head>` of **all 5 HTML pages**, right below `<meta charset="UTF-8">`. The full explanation of why this line is important is in [basic concepts §1.2](01-basic-responsive-concepts.md).

## 2.2 Checkbox + Label Pair for Hamburger Menu

```html
<header>
    <h1>SIMPUS-Mini</h1>
    <input type="checkbox" id="nav-toggle" class="nav-toggle">
    <label for="nav-toggle" class="nav-toggle-label">&#9776;</label>
    <nav>
        ...
    </nav>
</header>
```

Two new elements appear inside `<header>`, **before** `<nav>`:

- **`<input type="checkbox" id="nav-toggle" class="nav-toggle">`** —
  an ordinary checkbox. But through CSS (discussed in
  [chapter 3](03-css-hamburger-checkbox-hack.md)), this checkbox will
  be **hidden** from view — it's not used to be checked visually, but rather
  just to **store status** "is the menu open or closed" (checked = open).
- **`<label for="nav-toggle" class="nav-toggle-label">&#9776;</label>`** —
  remember from
  [jobsheet-01 documentation](../../jobsheet-01/Documentation/04-books-add-html.md#43-pattern-each-form-input-label--input),
  the `for="nav-toggle"` attribute **connects** this label to the checkbox
  with `id` of `nav-toggle`. The effect: **clicking this label is the same as
  clicking the checkbox itself** — this is the basis of the "checkbox hack"
  technique explained in detail in [chapter 3](03-css-hamburger-checkbox-hack.md).
- **`&#9776;`** — this is an **HTML entity** based on numeric code
  (similar to `&copy;` or `&mdash;` already discussed in
  [jobsheet-01 documentation](../../jobsheet-01/Documentation/02-index-html.md#footer--page-footer)),
  displaying the **☰** symbol character (three horizontal lines, the "hamburger"
  icon commonly used for menus on narrow screens).

**Important:** all three elements (`h1`, `input`, `label`) are directly inside `<header>`,
at the same level as `<nav>` — not inside `<nav>`. This arrangement is intentional
so CSS can use the **sibling combinator** (`~`) between the checkbox and `<nav>`,
with the detailed mechanism explained in [chapter 3](03-css-hamburger-checkbox-hack.md).

## 2.3 Wrapper `<div class="table-responsive">`

In `books/list.html` and `members/list.html`, the table that previously stood alone
(see [jobsheet-01 documentation](../../jobsheet-01/Documentation/03-books-list-html.md#32-anatomy-of-html-table))
is now wrapped in an additional `<div>`:

```html
<div class="table-responsive">
<table>
    ...
</table>
</div>
```

The `<div>` here is used purely as a **technical wrapper** for styling purposes (`overflow-x: auto`, discussed in
[chapter 4](04-css-table-responsive.md)) — different from semantic tags
(`header`, `section`, `article`, etc. from
[jobsheet-01 documentation](../../jobsheet-01/Documentation/01-basic-concepts.md#13-semantic-html5-tags))
which carry content meaning. `<div>` intentionally **has no semantic meaning** — it's just a "plain box" used when we need a CSS/JS target without needing a special tag. The class name `table-responsive` here is
something **we create ourselves** (not a built-in HTML name), chosen to be
easy to read its purpose: "a table that has been made responsive".

Next: [CSS: Hamburger Menu with Checkbox Hack](03-css-hamburger-checkbox-hack.md)
