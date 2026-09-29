# 2. What Changed in the HTML Files?

Good news: if you already understand the
[jobsheet-01 HTML documentation](../../jobsheet-01/Documentation/README.md),
you **don't need to relearn** the HTML structure in this jobsheet. Every
`header`, `nav`, `main`, `section`, `article`, `table`, `form`, `footer`
across the 5 HTML files is **exactly the same** as jobsheet-01.

The only change in every HTML file is **one new line** inside `<head>`:

```html
<link rel="stylesheet" href="assets/css/style.css">
```

(the `<link>` tag is explained in
[basic CSS concepts §1.3](01-basic-css-concepts.md#13-connecting-css-to-html))

## 2.1 CSS Path Differs per File

Because `style.css` is stored in a single location
(`jobsheet-02/assets/css/style.css`), while the HTML files are spread
across several folders at different depths, the `href` value on the
`<link>` tag has to be adjusted:

| HTML File | File Location | `href` Used |
|---|---|---|
| `index.html` | root folder (`jobsheet-02/`) | `assets/css/style.css` |
| `books/list.html` | inside the `books/` folder | `../assets/css/style.css` |
| `books/add.html` | inside the `books/` folder | `../assets/css/style.css` |
| `members/list.html` | inside the `members/` folder | `../assets/css/style.css` |
| `members/add.html` | inside the `members/` folder | `../assets/css/style.css` |

The pattern is the same as the paths in `<a href="...">` in the
navigation menu
([see the jobsheet-01 explanation §1.5](../../jobsheet-01/Documentation/01-basic-concepts.md#15-navigation-between-pages-a-href)):
`../` means "go up one folder" before going into `assets/css/style.css`.

**The most common mistake** beginners make when adding CSS to many pages
across different folders is **forgetting to adjust the number of
`../`** — the result is the CSS file "fails to load" and the page still
looks plain with no clear error message on screen (the error usually only
shows up in the browser DevTools *Console*/*Network* tab).

## 2.2 Why Was the HTML Structure Intentionally Left Unchanged?

This is an important design decision to understand: CSS **should** be
able to completely change how a page looks **without** needing to change
its HTML structure. This principle is called **separation of concerns**
— HTML handles the structure/meaning of the content, CSS handles the
appearance. This jobsheet was deliberately designed this way so you can
directly compare: the "Segoe UI" font, the blue color of the header, the
horizontally-aligned navbar, the neatly arranged 3-column statistic
cards — all of that is **purely the result of CSS**, not new HTML.

Try comparing a screenshot of jobsheet-01's `index.html` (no CSS,
default browser look, all elements stacked plainly on top of each other)
with jobsheet-02's `index.html` (with CSS) to see for yourself just how
big of an effect CSS has on the appearance, even though the HTML is
identical.

Next: [CSS: Reset & Base Body Style](03-css-reset-and-body.md)
