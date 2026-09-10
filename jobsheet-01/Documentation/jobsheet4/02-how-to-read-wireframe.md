# 2. How to Read Wireframes

**Wireframes** used in `docs/wireframe.md` are written as **ASCII art** (pictures made from plain text characters) inside code blocks in markdown — similar to the approach used for box model diagrams in
[jobsheet-02 documentation](../../jobsheet-02/Documentation/01-basic-css-concepts.md#15-each-element-box-box-model)
before they were replaced with SVG. The difference is that for **design wireframes** (not final published diagrams), ASCII art is actually the right choice:
quick to draw, easy to change if the design evolves, and doesn't require special design software — perfect for the "rough sketch" stage before something is really built.

## 2.1 Example: Login Page Wireframe

```
+--------------------------------------+
|              SIMPUS-Mini             |
|--------------------------------------|
|                                      |
|        [ Login Officer ]            |
|                                      |
|   Username : [______________]       |
|   Password : [______________]       |
|                                      |
|          [    Sign In    ]          |
|                                      |
|   Don't have an account? Sign up    |
+--------------------------------------+
```

## 2.2 Rules for Reading the Symbols

These text wireframes follow simple conventions:

- Box made from hash (`+`), dashes (`-`), and pipe (`|`) characters — marks the **outer boundary** of a page or panel inside it.
- Single pipe in the middle (vertical divider) — marks **section separators** inside one page, similar to the `<section>` elements you know from
[jobsheet-01 documentation](../../jobsheet-01/Documentation/01-basic-concepts.md#13-semantic-html5-tags).
- `[______________]` (brackets with underscores) — an **input box** where users type text (will become `<input type="text">` or `<input type="password">`, remember this concept from
[jobsheet-01 documentation](../../jobsheet-01/Documentation/04-books-add-html.md#43-pattern-each-form-input-label--input)).
- `[  Text  ]` (brackets with text) — a **button** that can be clicked (will become `<button>`).
- Plain text without brackets — static label or description (will become `<label>`, `<h1>`, `<p>`, etc).

Translating the Login wireframe above into HTML terms you know:

- `SIMPUS-Mini` at the top → will become `<header><h1>` like on all existing pages.
- `Login Officer` → a section title, like `<h2>` on other pages (e.g., "Book List" in
[jobsheet-01 documentation](../../jobsheet-01/Documentation/03-books-list-html.md)).
- `Username : [______________]` and `Password : [______________]` →
will become `<label>` + `<input>` pairs, exactly like the form pattern you learned in
[jobsheet-01 documentation §4.3](../../jobsheet-01/Documentation/04-books-add-html.md#43-pattern-each-form-input-label--input) —
except Password will use `type="password"` (a new input type not used in jobsheets 1-3, so typed characters are hidden as dots).
- `[ Sign In ]` → a submit button, like `<button type="submit">Save</button>` from the Add Books/Members forms.

## 2.3 More Complex Wireframe: Officer Dashboard

```
+-----------------------------------------------------+
| SIMPUS-Mini      Home | Books | Members | Borrowing | (Officer Name) Logout |
|-------------------------------------------------------|
|  [Total Books]   [Total Members]   [Currently Borrowed]    |
|                                                         |
|  Quick Actions:                                        |
|  [ + New Borrowing ]   [ + Return ]                    |
|                                                         |
|  Recent Transactions                                  |
|  --------------------------------------------------    |
|  Member | Book | Borrow Date | Status                  |
+-----------------------------------------------------+
```

Note the top navigation bar: `Home | Books | Members | Borrowing` — this looks very similar to the navbar that **already exists** in
[`index.html`](../index.html) now, only **adding** one new menu item ("Borrowing") and a login status indicator on the right (`(Officer Name) Logout`).
The row `[Total Books] [Total Members] [Currently Borrowed]` also appears to be the stat cards that **you've already built** since jobsheet-02 using CSS Grid (see
[jobsheet-02 documentation](../../jobsheet-02/Documentation/06-css-grid-stat-cards.md)).

This is not by chance — the Officer Dashboard wireframe is intentionally designed to **reuse** existing elements (navbar, stat cards),
plus new sections (Quick Actions, Recent Transactions). This relationship is discussed in detail in
[chapter 5](05-code-connection.md).

Next: [User Flow: Borrowing & Returning](03-user-flow-borrowing-returning.md)
