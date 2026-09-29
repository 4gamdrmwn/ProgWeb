# 3. CSS: Reset & Base Body Style

This is the **very top** section of `style.css` — the foundation that
affects the entire page.

## 3.1 CSS Reset with the Universal Selector `*`

```css
/* ===== Reset & Base ===== */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}
```

- `*` is the **universal selector** — meaning this rule applies to
  **every HTML element** without exception (`div`, `p`, `h1`, `button`,
  etc.).
- `margin: 0; padding: 0;` removes the default spacing that browsers
  automatically give to many elements (e.g. `<h1>`, `<p>`, `<ul>` have
  different default margins in different browsers). This is called a
  **CSS reset** — "leveling the starting line" so the appearance is
  consistent across all browsers, before being reset according to our
  own preferences in the following rules.
- `box-sizing: border-box;` — this is the most important thing to
  understand: by default (`content-box`), if you set `width: 200px` and
  then add `padding: 20px`, the **total** width of the box shown on
  screen becomes 240px (200 + 20 + 20 left-right) — confusing for
  beginners. With `border-box`, `width: 200px` means the **total** width
  of the box (including padding & border) stays 200px — the padding is
  "eaten" from the inside. This is why nearly every modern CSS developer
  always adds a `box-sizing: border-box;` rule at the top of their
  stylesheet.

The comment `/* ===== Reset & Base ===== */` above it is a **CSS
comment** (wrapped in `/* ... */`), it doesn't affect the appearance at
all — it's just a note for the programmer so the file is easier to
navigate (compare with the HTML comment `<!-- ... -->`).

## 3.2 Base `<body>` Style

```css
body {
    font-family: "Segoe UI", Arial, sans-serif;
    color: #2b2b2b;
    background-color: #f5f6f8;
    line-height: 1.5;
}
```

| Property | Value | Explanation |
|---|---|---|
| `font-family` | `"Segoe UI", Arial, sans-serif` | A **priority-ordered** list of fonts: the browser tries "Segoe UI" first; if that font isn't available on the user's computer, it tries "Arial"; if that's also not there, it uses whatever generic `sans-serif` font is available on the system. Always include a generic font at the end of the list as a fallback guarantee. |
| `color` | `#2b2b2b` | The **text** color, a very dark gray (almost black, but not pure black `#000` — so it's easier on the eyes). |
| `background-color` | `#f5f6f8` | The **background** color of the entire page, a very light gray. |
| `line-height` | `1.5` | The spacing between lines of text, 1.5 times the font height. Without a unit, it means a multiple of that element's own font size. This value makes text more comfortable to read compared to the browser default (usually around `1.2`). |

Because this rule is attached to the `body` selector, and nearly every
other element is **inside** `<body>`, the `font-family`, `color`, and
`line-height` properties are automatically "inherited" by child elements
like `<p>`, `<h2>`, `<td>`, etc., unless that element is given another
CSS rule that specifically overrides it (e.g. `header h1` has its own
`font-size`, explained in [chapter 4](04-css-header-navbar-flexbox.md)).

## 3.3 Link Style (`<a>`)

```css
a {
    color: #1d5b8a;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
```

- `a { color: #1d5b8a; }` — all links are given a blue color (matching
  the header color, see [chapter 4](04-css-header-navbar-flexbox.md)),
  replacing the browser's default blue.
- `text-decoration: none;` — removes the automatic underline that
  usually comes with links, for a cleaner look.
- `a:hover { text-decoration: underline; }` — this is a **pseudo-class**
  (see [basic concepts §1.4](01-basic-css-concepts.md#14-types-of-selectors-used-in-stylecss)):
  the underline only appears **when the mouse cursor is hovered** over
  the link. This gives the user visual feedback that the text is
  clickable, without making the appearance messy when the cursor isn't
  touching it.

Next: [CSS: Header & Navbar with Flexbox](04-css-header-navbar-flexbox.md)
