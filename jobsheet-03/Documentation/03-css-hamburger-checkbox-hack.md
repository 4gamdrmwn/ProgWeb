# 3. CSS: Hamburger Menu with Checkbox Hack

This is the most "magical" part of this jobsheet: a menu that can be opened and closed by clicking, **without a single line of JavaScript**. The trick is called **checkbox hack**, leveraging the `:checked` pseudo-class and **sibling combinator** CSS.

## 3.1 CSS Snippets Involved

This code is spread across 2 different places in `style.css`: base styles (always active) and styles inside mobile media query (only active on narrow screens).

**Base styles** (outside media query):
```css
/* ===== Hamburger Menu (checkbox hack) ===== */
.nav-toggle {
    display: none;
}

.nav-toggle-label {
    display: none;
    font-size: 1.6rem;
    color: #fff;
    cursor: pointer;
}
```

**Inside `@media (max-width: 480px)`** (discussed in detail in
[chapter 5](05-css-media-query-breakpoint.md)):
```css
header {
    position: relative;
}

.nav-toggle-label {
    display: block;
}

header nav {
    display: none;
    width: 100%;
    order: 3;
    margin-top: 1rem;
}

.nav-toggle:checked ~ nav {
    display: block;
}
```

## 3.2 How It Works: The Sibling Combinator ~

The key line is:

```css
.nav-toggle:checked ~ nav {
    display: block;
}
```

This uses the **sibling combinator** `~`, read as "any following sibling". It means:
"if `.nav-toggle` (the checkbox) is `:checked`, then show any `nav` that comes after it as a sibling in the HTML."

Breaking it down:
- `.nav-toggle:checked` — targets the checkbox input when it's in the checked state.
- `~` — sibling combinator: targets elements that come **after** this one in the HTML (at the same level).
- `nav` — the target: any `<nav>` element that is a sibling of the checkbox.

In `header`, the order is: `<h1>`, `<input type="checkbox">`, `<label>`, `<nav>`.
Both the checkbox and `<nav>` are children of `<header>` (siblings of each other), so the `~` combinator can target `<nav>` based on the checkbox's state.

When users click the hamburger label, they're actually clicking the invisible checkbox behind it (because of the label's `for` attribute linking to the checkbox's `id`). The click toggles the checkbox's `:checked` state, and the CSS rule automatically shows/hides the menu — all without JavaScript.

## 3.3 Why Responsive?

On **desktop screens** (outside media query), the checkbox and label are hidden (`display: none`), and the navbar is always visible. Users see a normal horizontal menu.

On **mobile screens** (inside `@media (max-width: 480px)`), the hamburger icon appears, the navbar starts hidden, and clicking the icon toggles it open/closed via the checkbox trick.

This is why this pattern is so powerful: **the same HTML** automatically adapts its behavior based on screen size, purely through CSS — no JavaScript needed for basic toggle functionality.

Next: [CSS: Responsive Tables](04-css-table-responsive.md)
