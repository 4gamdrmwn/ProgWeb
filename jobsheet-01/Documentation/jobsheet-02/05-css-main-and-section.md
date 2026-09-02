# 5. CSS: `main` & `section` Layout

This section sets the width of the page's main content and turns every
`<section>` into a white "card" that's raised above the gray background.

## 5.1 The CSS Code

```css
/* ===== Main Layout ===== */
main {
    max-width: 1000px;
    margin: 2rem auto;
    padding: 0 1.5rem;
}

section {
    background-color: #fff;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
}

section h2 {
    margin-bottom: 1rem;
    color: #1d5b8a;
}
```

## 5.2 Constraining Width & Centering Content (`main`)

```css
main {
    max-width: 1000px;
    margin: 2rem auto;
    padding: 0 1.5rem;
}
```

- `max-width: 1000px;` — the width of `<main>` **will never exceed**
  1000px, even if the monitor screen is much wider. This is common
  practice so text/content doesn't stretch unnaturally wide and become
  hard to read on large screens (imagine reading a paragraph as wide as
  a 27-inch monitor screen — your eyes would get tired quickly).
- `margin: 2rem auto;` — remember from [chapter 4](04-css-header-navbar-flexbox.md#45-padding-on-the-header),
  2 values mean top-bottom then left-right. Here: top-bottom margin of
  `2rem`, and left-right margin of `auto`. The `auto` value on left-right
  margin is a **classic CSS trick** for **centering an element
  horizontally** — the browser automatically distributes the remaining
  empty space evenly on the left and right of `<main>` (whose width is
  capped by `max-width: 1000px`), so the content is always centered on
  the screen.
- `padding: 0 1.5rem;` — top-bottom padding of `0`, left-right padding of
  `1.5rem`. This gives a bit of space from the screen edge so the
  content isn't too tight against the border, especially on narrow
  screens (phone/tablet) where `max-width: 1000px` doesn't yet apply
  (the screen is already narrower than that).

## 5.3 White Card for Every `<section>`

```css
section {
    background-color: #fff;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
}
```

| Property | Effect |
|---|---|
| `background-color: #fff;` | White background, contrasting with the gray page background (`#f5f6f8` from `body`, [chapter 3](03-css-reset-and-body.md#32-base-body-style)) — this is what makes each `<section>` look like a separate "card". |
| `border-radius: 8px;` | Makes the box corners **rounded/curved** by 8px, instead of sharp right angles. A common visual effect used for a modern, soft impression. |
| `padding: 1.5rem;` | A single value means **the same spacing on all four sides** (top, bottom, left, right) — giving breathing room between the card's edge and its content. |
| `margin-bottom: 1.5rem;` | Spacing **below** each card, separating it from the next card/element below it. |
| `box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);` | Gives a **soft shadow** around the card, creating the impression that the card is "raised" slightly from the background. Its values: `0` (the shadow isn't shifted left/right), `1px` (shifted 1px downward), `3px` (blur radius of 3px), and `rgba(0, 0, 0, 0.08)` (black color with only 8% opacity/transparency — a very faint/soft shadow, not overpowering). |

**Note about `rgba()`:** this is an alternative color format to hex
(`#1d5b8a`) explained in [basic concepts §1.7](01-basic-css-concepts.md#17-colors-in-hex-format).
`rgba(R, G, B, A)` writes a color as Red-Green-Blue numbers (0–255) plus
**Alpha** (transparency level, from `0` = fully transparent to `1` =
fully opaque). This format is chosen here **because transparency is
needed** for the shadow, something plain hex format can't do.

## 5.4 Heading Inside a Section

```css
section h2 {
    margin-bottom: 1rem;
    color: #1d5b8a;
}
```

Every `<h2>` inside a `<section>` (every section heading across all
pages, such as "Summary", "Book List", "Add Member") is given `1rem` of
spacing below it (separating the heading from the content below it) and
a blue color matching the header (`#1d5b8a`) — giving a consistent
"theme color" impression across the whole application.

Next: [CSS: Statistic Cards with CSS Grid](06-css-grid-stat-cards.md)
