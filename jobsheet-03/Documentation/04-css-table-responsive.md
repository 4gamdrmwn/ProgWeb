# 4. CSS: Responsive Tables

This short chapter discusses the solution to a classic problem: tables with many columns
(like Book List from [jobsheet-01 documentation](../../jobsheet-01/Documentation/03-books-list-html.md))
will look very narrow and hard to read if forced to fit on a mobile screen.

## 4.1 CSS Code

```css
/* ===== Responsive Table ===== */
.table-responsive {
    overflow-x: auto;
}
```

Just **one property**, but enough to solve the problem.

## 4.2 Two Approaches to Wide Tables on Narrow Screens

There are two common strategies for handling wide tables on narrow screens:

1. **Compress table contents** — force all columns to shrink so they fit on a narrow screen. The problem: text gets cut off/unreadable, especially for columns like "Author" that contain long names.
2. **Keep the table at its full width, but allow horizontal scrolling** — this is the approach chosen by this jobsheet. Column widths remain comfortably readable, and users just need to swipe (on mobile) or scroll horizontally (on trackpad/mouse) to see columns that aren't visible yet.

## 4.3 Why Wrap in a `<div>`?

Remember from [chapter 2 §2.3](02-changes-to-html-files.md#23-wrapper-div-classtable-responsive),
the `<table>` is wrapped in an additional `<div class="table-responsive">`. This is because
`overflow-x: auto` **cannot be applied directly to a `<table>` element** as effectively as when applied to a `<div>` wrapper:

- A `<table>` that is wide (has many columns) will still **push to widen** its container, rather than be clipped and
  create a scrollbar on itself.
- By wrapping it in `<div class="table-responsive">` that's given `overflow-x: auto`, the `<div>` becomes
  the one with **fixed width** (following its `<section>` container width — see
  [jobsheet-02 documentation §5.3](../../jobsheet-02/Documentation/05-css-main-and-section.md#53-white-card-for-each-section)),
  while the `<table>` inside can widen as needed. If the `<table>` width exceeds the wrapper `<div>`'s width,
  then `overflow-x: auto` will display an **automatic horizontal scrollbar**, just within the table area — not scrolling the entire page.

Next: [CSS: Media Query & Breakpoint](05-css-media-query-breakpoint.md)
