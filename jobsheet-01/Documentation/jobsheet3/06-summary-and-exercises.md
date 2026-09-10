# 6. Summary & Exercises

## 6.1 Overall Summary of Jobsheet 3

| Section | Code Location | Concepts Learned |
|---|---|---|
| [Basic Concepts](01-basic-responsive-concepts.md) | — | Responsive design, `<meta viewport>`, media query, breakpoint, desktop-first strategy |
| [HTML Changes](02-changes-to-html-files.md) | All `.html` files | Viewport tag, `input[checkbox]`+`label` pair, `<div class="table-responsive">` |
| [Hamburger Checkbox Hack](03-css-hamburger-checkbox-hack.md) | `.nav-toggle`, `.nav-toggle-label`, `.nav-toggle:checked ~ nav` | Sibling combinator `~`, `:checked` pseudo-class, CSS-only interactivity without JavaScript |
| [Responsive Tables](04-css-table-responsive.md) | `.table-responsive` | `overflow-x: auto`, wrapper `<div>` pattern for horizontal scroll |
| [Media Query & Breakpoint](05-css-media-query-breakpoint.md) | `@media (max-width: 768px)`, `@media (max-width: 480px)` | `@media` syntax, tablet/mobile breakpoints, rule override by writing order |

## 6.2 Core Concepts to Remember

1. **`<meta name="viewport">` is mandatory** for responsive design — without it, all media queries in CSS won't work properly on mobile because the mobile browser will think the page is designed for 980px width ([chapter 1](01-basic-responsive-concepts.md#12-meta-nameviewport--so-mobile-browsers-dont-lie)).

2. **CSS can be made interactive without JavaScript**, leveraging built-in state pseudo-classes like `:checked` (checkbox hack) combined with sibling combinator `~`
([chapter 3](03-css-hamburger-checkbox-hack.md)). This technique is useful for simple interactions, though for more complex cases JavaScript is still more flexible (mentioned in
[README.md](../README.md) of this jobsheet — will be replaced with JavaScript in Jobsheet 5).

3. **`overflow-x: auto` on a wrapper `<div>`** is a common pattern for handling wide tables/content on narrow screens without breaking the rest of the page layout ([chapter 4](04-css-table-responsive.md)).

4. **Media query rules override base styles based on writing order** when selectors have equal specificity — that's why breakpoints in this jobsheet are intentionally placed at the **very bottom** of the file ([chapter 5](05-css-media-query-breakpoint.md)).

5. **Desktop-first vs mobile-first** are two strategies for writing responsive CSS; this jobsheet uses desktop-first (`max-width`), the opposite of mobile-first (`min-width`) — both are valid, choice depends on team/project preference
([chapter 1 §1.5](01-basic-responsive-concepts.md#15-desktop-first-approach-used-in-this-jobsheet)).

## 6.3 How to Try It Yourself

1. Follow the DevTools testing steps in [chapter 5 §5.6](05-css-media-query-breakpoint.md#56-how-to-test-yourself-in-browser).
2. In DevTools responsive mode, **slowly change the screen width** while watching the statistics cards — notice exactly at 768px and 480px the layout "breaks" to a different number of columns. This is the breakpoint effect working precisely at the specified points.
3. Click the hamburger ☰ icon multiple times in mobile mode, watch the menu open/close **without page reload** — prove to yourself this is pure CSS by opening the **Console** tab in DevTools; you won't see any JavaScript errors or activity — this is evidence that nothing is running except CSS.

## 6.4 Optional Extra Exercises

1. **Add your own breakpoint** at 1024px (widescreen/large desktop) where the statistics cards switch from 2 columns back to **3 columns** (or try 4 columns). Test it to see the grid adapt at that breakpoint.
2. **Modify the hamburger** to appear/disappear at a different screen size (e.g., 600px instead of 480px). Observe how changing `@media (max-width:)` values affects which screen sizes trigger which layouts.
3. **Experiment with form layout** — at tablet size, make form inputs wider/narrower than they currently are. Add a new media query rule to adjust form styling.
4. **Create a new page** (e.g., `borrowing.html`) with its own responsive design using the patterns you've learned (hamburger menu, media queries, form styling).

If any part is still confusing, re-read [chapter 1](01-basic-responsive-concepts.md) — the "why design responsively" concept is the foundation that explains the reasoning behind everything in this jobsheet.
