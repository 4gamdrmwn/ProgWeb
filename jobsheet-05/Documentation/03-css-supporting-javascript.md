# 3. CSS Supporting the JavaScript Features

A few lines of `style.css` changed or were added, all to support the new
JavaScript features in [chapter 4](04-js-hamburger-menu.md) through
[chapter 7](07-js-form-validation.md). This chapter covers those CSS
changes **before** diving into the JavaScript itself, so the flow stays
sequential.

## 3.1 Hamburger: From `.nav-toggle` to a Real Button

**Removed** from `style.css`:
```css
.nav-toggle {
    display: none;
}
```
This rule used to hide the `<input type="checkbox">` element (see
[jobsheet-03 documentation §3.1](../../jobsheet-03/Documentation/03-css-hamburger-checkbox-hack.md#31-css-snippets-involved)).
Since the checkbox element itself has been removed from the HTML
([chapter 2 §2.1](02-html-file-changes.md#21-hamburger-from-checkbox-to-a-real-button)),
the CSS rule to hide it is no longer needed either.

**Added** to `.nav-toggle-label` (which now styles a `<button>`
element, not a `<label>`):
```css
.nav-toggle-label {
    display: none;
    font-size: 1.6rem;
    color: #fff;
    background: none;
    border: none;
    cursor: pointer;
}
```
Two new lines, `background: none;` and `border: none;`, were **not
needed** when the element was still a `<label>` (a label has no
default background or border), but are **required** now because the
element is a `<button>` — and HTML buttons have a default gray
background and a browser-provided 3D border. Without these two lines,
the hamburger button would look like a plain gray box, not a clean ☰
icon blending into the blue header color.

**Changed** inside `@media (max-width: 480px)`:
```css
header nav.nav-open {
    display: block;
}
```
Previously (jobsheet-03): `.nav-toggle:checked ~ nav { display: block; }`
— a selector based on **checkbox state** (`:checked`) and the
**sibling combinator** `~` (recall the concept from
[jobsheet-03 documentation §3.2](../../jobsheet-03/Documentation/03-css-hamburger-checkbox-hack.md#32-how-it-works-the-sibling-combinator-)).
Now the selector is much simpler: **`header nav.nav-open`** — a
`<nav>` element inside `<header>` that **has the class `nav-open`**.
There's no pseudo-class or sibling combinator at all anymore, because
the "menu open" status is now purely determined by whether the
`nav-open` class exists — and it's JavaScript that adds/removes that
class (explained in [chapter 4](04-js-hamburger-menu.md)), no longer
the checked status of a hidden checkbox.

## 3.2 New Style: Validation Error Message

```css
/* ===== Validation Error Message ===== */
.error {
    display: block;
    color: #d9534f;
    font-size: 0.85rem;
    margin-top: 0.25rem;
}
```

This `error` class **doesn't exist** statically in any HTML yet — it
will be **created and inserted entirely by JavaScript** whenever form
validation fails (explained in detail in
[chapter 7](07-js-form-validation.md)). This CSS prepares **what it
will look like** if/when the `<span class="error">` element actually
appears:

- `display: block;` — ensures the error message appears on its **own
  new line**, below the input box, rather than sitting inline next to
  it (recall a `<span>` element is *inline* by default, similar to the
  `display: block` discussion for `<label>` in
  [jobsheet-02 documentation §8.3](../../jobsheet-02/Documentation/08-css-form.md#83-label-as-its-own-block)).
- `color: #d9534f;` — red color, exactly matching the Delete button's
  color ([jobsheet-02 documentation §7.6](../../jobsheet-02/Documentation/07-css-table.md#76-action-buttons-edit--delete)) —
  consistently signaling "something needs attention/action" throughout
  the app.
- `font-size: 0.85rem;` and `margin-top: 0.25rem;` — text slightly
  smaller than the input above it, with a thin gap so it's clearly
  visible as additional information, not blended with the input.

## 3.3 New Style: Search Box

```css
/* ===== Search Box ===== */
.search-box {
    margin-bottom: 1rem;
}

.search-box input {
    width: 100%;
    max-width: 320px;
    padding: 0.5rem 0.75rem;
    border: 1px solid #cdd4da;
    border-radius: 4px;
}
```

- `.search-box { margin-bottom: 1rem; }` gives spacing between the
  search box and the table below it.
- `.search-box input` styles the search input box similarly to the
  form input style you already know from
  [jobsheet-02 documentation §8.4](../../jobsheet-02/Documentation/08-css-form.md#84-input--dropdown-boxes) —
  thin border, rounded corners, comfortable padding — except
  `max-width` is made narrower (`320px`, compared to `400px` for form
  inputs) since the search box doesn't need to be as wide as a regular
  form field.

With the CSS ready to welcome these new elements, it's time to dissect
the JavaScript that actually drives them, starting with the hamburger
menu.

Continue to: [JS: Hamburger Menu](04-js-hamburger-menu.md)
