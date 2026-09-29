# 4. CSS: Header & Navbar with Flexbox

This section is the first introduction to **Flexbox** — one of the most
important layout systems in modern CSS.

## 4.1 The CSS Code

```css
/* ===== Header & Navbar (Flexbox) ===== */
header {
    background-color: #1d5b8a;
    color: #fff;
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}

header h1 {
    font-size: 1.4rem;
}

header nav ul {
    list-style: none;
    display: flex;
    gap: 1.25rem;
}

header nav a {
    color: #fff;
    font-weight: 500;
}
```

## 4.2 What is Flexbox?

By default, HTML elements like `<h1>` and `<nav>` inside `<header>` will
stack **vertically** (piled downward), because both are *block*
elements. But what we want is: the "SIMPUS-Mini" title on the left, the
navigation menu on the right, **aligned in a single horizontal row**.
This is where Flexbox comes in — a 1-dimensional layout system that
controls how child elements are arranged inside a wrapping box.

## 4.3 Activating Flexbox: `display: flex`

```css
header {
    display: flex;
    ...
}
```

Writing `display: flex;` on `<header>` turns `<header>` into a **flex
container**, and **all of its direct children** (here: `<h1>` and
`<nav>`) automatically become **flex items** that are lined up
horizontally (the default), instead of stacking vertically anymore.

## 4.4 Positioning Flex Items

| Property | Value | Effect |
|---|---|---|
| `align-items: center;` | — | Aligns flex items **vertically at the center** of the cross axis — so `<h1>` and `<nav>` are both vertically centered even though their heights differ. |
| `justify-content: space-between;` | — | Controls the spacing between flex items on the main axis (horizontal). `space-between` pushes the **first item to the left edge**, the **last item to the right edge**, and distributes any remaining space evenly between them. This is what puts `<h1>` on the left and `<nav>` on the right of the header. |
| `flex-wrap: wrap;` | — | Allows flex items to **move to a new line** if there isn't enough room (e.g. on a narrow phone screen), instead of being forced to fit on one line until they're cut off/squeezed too much. |

## 4.5 Padding on the Header

```css
padding: 1rem 1.5rem;
```

CSS allows writing 2 values at once for the `padding` property (or
`margin`): the **first value for top-bottom**, the **second value for
left-right**. So `1rem 1.5rem` means top & bottom padding of `1rem`,
left & right padding of `1.5rem`. This is a shorthand way of writing 4
different values without having to write `padding-top`, `padding-right`,
`padding-bottom`, `padding-left` one by one.

## 4.6 Nested Flexbox: Navbar Inside Header

Interestingly, Flexbox is used **twice, nested** here — once on
`<header>` (arranging `h1` & `nav` horizontally), and again inside
`<nav> <ul>` to arrange the **menu items**:

```css
header nav ul {
    list-style: none;
    display: flex;
    gap: 1.25rem;
}
```

- **`header nav ul`** — a descendant selector (see
  [basic concepts §1.4](01-basic-css-concepts.md#14-types-of-selectors-used-in-stylecss)):
  selects the `<ul>` element that is inside a `<nav>` that is inside a
  `<header>`.
- `list-style: none;` — removes the default bullet points on the `<ul>`
  list, since we don't need a bullet-list look in the navbar.
- `display: flex;` — turns `<ul>` (whose content is one `<li>` per menu
  item) into a flex container too, so all `<li>`s are lined up
  horizontally instead of stacking vertically like a regular list.
- `gap: 1.25rem;` — a modern Flexbox/Grid property for giving **uniform
  spacing** between flex items, without having to manually set `margin`
  on each item one by one.

```css
header nav a {
    color: #fff;
    font-weight: 500;
}
```

This overrides the default link color (`a { color: #1d5b8a; }` from
[chapter 3](03-css-reset-and-body.md#33-link-style-a)) **specifically
for links inside the navbar** — so the menu text is white (`#fff`),
contrasting with the dark blue header background. `font-weight: 500`
makes the text a little bolder than normal (`400`) but not as bold as
`bold` (`700`).

## 4.7 Why Does the `header nav a` Selector "Win" Over `a`?

This is a simple example of the **CSS specificity** concept: a more
specific/detailed selector (`header nav a`, naming 3 nested tags) beats
a more general selector (`a`, just 1 tag), **regardless of the order
they're written in the file**. So even though the rule
`a { color: #1d5b8a; }` is written earlier in the file, the `header nav a`
rule still determines the link color inside the navbar, because it's
more specific.

Next: [CSS: `main` & `section` Layout](05-css-main-and-section.md)
