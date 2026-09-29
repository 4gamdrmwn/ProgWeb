# 10. Summary & Further Exercises

## 10.1 Overall Jobsheet 2 Summary

| `style.css` Section | Main Selector | CSS Concepts Learned |
|---|---|---|
| [Reset & Body](03-css-reset-and-body.md) | `*`, `body`, `a` | CSS reset, `box-sizing: border-box`, style inheritance, `:hover` pseudo-class |
| [Header & Navbar](04-css-header-navbar-flexbox.md) | `header`, `header nav ul` | **Flexbox** (`display: flex`, `align-items`, `justify-content`, `flex-wrap`, `gap`) |
| [Main & Section](05-css-main-and-section.md) | `main`, `section` | `max-width` + `margin: auto` to center content, `box-shadow`, `border-radius` |
| [Statistic Cards Grid](06-css-grid-stat-cards.md) | `main section:nth-of-type(2)` | **CSS Grid** (`display: grid`, `grid-template-columns`, `fr` unit), positional pseudo-class `:nth-of-type` |
| [Table](07-css-table.md) | `table`, `th, td`, `tbody tr:nth-child(even)` | `border-collapse`, *zebra stripes* with `:nth-child(even)`, button styling with `:first-of-type`/`:last-of-type` |
| [Form](08-css-form.md) | `form label`, `form input, form select` | Attribute selector `button[type="submit"]`, `display: block`, responsive width limits |
| [Footer](09-css-footer.md) | `footer` | Visual hierarchy through text size & color |

## 10.2 Core Concepts to Remember

1. **CSS is separate from HTML** and connected via `<link rel="stylesheet">`
   — one CSS file can be reused across many HTML pages at once
   ([chapter 1](01-basic-css-concepts.md), [chapter 2](02-html-file-changes.md)).
2. **`box-sizing: border-box`** makes an element's width/height
   calculation far more predictable when there's `padding`/`border`
   ([chapter 3](03-css-reset-and-body.md)).
3. **Flexbox** for 1-dimensional layout (navbar), **CSS Grid** for
   2-dimensional column/row-based layout (statistic cards) — two
   different tools for different needs
   ([chapter 4](04-css-header-navbar-flexbox.md), [chapter 6](06-css-grid-stat-cards.md)).
4. **Pseudo-classes** (`:hover`, `:nth-child`, `:nth-of-type`,
   `:first-of-type`, `:last-of-type`) allow styling based on **state**
   (cursor condition) or **position** of an element, without needing to
   add any attribute in the HTML.
5. **Specificity** determines which rule wins when two CSS rules target
   the same element — a more specific selector (more "conditions")
   generally wins, unless the specificity is equal, in which case the
   **order written in the file** decides
   ([chapter 4 §4.7](04-css-header-navbar-flexbox.md#47-why-does-the-header-nav-a-selector-win-over-a),
   [chapter 7 §7.5](07-css-table.md#75-alternating-rows-hover-effect)).

## 10.3 How to Try It Yourself

1. Open `index.html` in a browser and compare it with jobsheet-01's
   `index.html` (no CSS) — notice the navbar is now aligned horizontally,
   and the statistic cards are arranged in 3 columns.
2. Open the browser's *DevTools* (right-click → *Inspect*, or press
   `F12`), click the **Elements/Inspector** tab, then click one of the
   elements (e.g. the "Total Books" card). The panel next to it will
   show which CSS rules apply to that element — the best way to **see
   directly** the relationship between a CSS selector and its
   appearance.
3. In DevTools, try changing a CSS value directly (e.g. change
   `grid-template-columns: repeat(3, 1fr)` to `repeat(2, 1fr)`) and see
   the effect immediately — this change is **temporary**, only in the
   browser, it doesn't modify the actual file, so it's safe to
   experiment with.

## 10.4 Additional Exercise Ideas (Optional)

1. **Change the color scheme** — replace the `#1d5b8a` value (the theme
   blue) throughout `style.css` with another color, e.g. dark green, then
   observe how that color consistently appears in the header, section
   headings, submit button, and table header — because they all use the
   same hex value.
2. **Add a fourth column** to the statistic card grid — add a new
   `<article>` in the HTML (e.g. "Overdue Books"), then change
   `repeat(3, 1fr)` to `repeat(4, 1fr)` in the CSS.
3. **Create a third button in the table** — add a "Detail" button between
   Edit and Delete on `books/list.html`, then observe whether its color
   matches your expectation (recall the note in
   [chapter 7 §7.6](07-css-table.md#76-action-buttons-edit-delete) about
   `:first-of-type`/`:last-of-type` being position-based, not
   meaning-based). Try fixing it by giving it a special `class` if the
   color doesn't match.
4. **Test simple responsiveness** — gradually shrink the browser window
   width until it's very narrow (like a phone width), and observe when
   `flex-wrap: wrap` on the navbar starts moving the menu to a new line.

If any part is still confusing, try rereading
[the basic CSS concepts in chapter 1](01-basic-css-concepts.md) — most
of the technical terms in the other chapters are explained there.
