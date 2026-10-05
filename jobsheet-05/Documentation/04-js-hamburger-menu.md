# 4. JS: Hamburger Menu

The first function in `app.js`, and the simplest — a good starting
point for learning to read JavaScript code.

## 4.1 Full Code

```js
// ===== Hamburger menu (JS-driven, replaces the checkbox hack) =====
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}
```

## 4.2 Getting the Two Elements Needed

```js
const toggleBtn = document.getElementById("nav-toggle-btn");
const nav = document.querySelector("header nav");
```

- `const` is the keyword for declaring a **variable** (a place to store
  a value) whose value **will not be reassigned** after it's defined —
  suitable here since `toggleBtn` and `nav` always refer to the same
  element throughout this function's execution.
- `toggleBtn` is set to the hamburger button (`id="nav-toggle-btn"`,
  recall from [chapter 2 §2.1](02-html-file-changes.md#21-hamburger-from-checkbox-to-a-real-button)).
- `nav` is set to the `<nav>` element inside `<header>` — using the CSS
  selector `"header nav"`, **exactly the same** descendant selector
  you already know from
  [jobsheet-02 documentation](../../jobsheet-02/Documentation/01-basic-css-concepts.md#14-types-of-selectors-used-in-stylecss).

## 4.3 Guard Clause

```js
if (!toggleBtn || !nav) return;
```

- The exclamation mark `!` before a value means **negation** —
  `!toggleBtn` is `true` when `toggleBtn` is `null` (element not found).
- `||` means **or** — this condition is true if **either** `toggleBtn`
  or `nav` is not found.
- If this condition is true, `return;` stops the function **before**
  the next line (`toggleBtn.addEventListener(...)`) gets a chance to
  run — preventing the "Cannot read properties of null" error that
  would appear if we tried to call `.addEventListener` on a `null`
  value.

This line is exactly the concept already touched on in
[jobsheet-05 documentation §1.7](01-basic-javascript-dom-concepts.md#17-general-code-structure-in-appjs):
since the same `app.js` is loaded on **every** page via
`<script src="assets/js/app.js">`, and this function is called on all
those pages too (see [chapter 1 §1.7](01-basic-javascript-dom-concepts.md#17-general-code-structure-in-appjs)),
this guard clause ensures the code won't error even if (hypothetically)
some page turns out not to have a hamburger button.

## 4.4 Attaching the Event Listener

```js
toggleBtn.addEventListener("click", function () {
    nav.classList.toggle("nav-open");
});
```

- `toggleBtn.addEventListener("click", ...)` — recall this pattern from
  [chapter 1 §1.6](01-basic-javascript-dom-concepts.md#16-what-are-events-and-event-listeners):
  "every time this button is clicked, run the following function."
- **`nav.classList`** is an object representing the **list of all
  classes** the `nav` element currently has (similar to the
  `class="..."` attribute in HTML, but in a programmable form).
- **`.toggle("nav-open")`** is a method that **flips the status** of a
  specific class:
  - If the `nav` element **doesn't** have the `nav-open` class yet →
    the class is **added**.
  - If the `nav` element **already** has the `nav-open` class → the
    class is **removed**.

This is why the same click handler function can be used to **open and
close** the menu alternately — we don't need to write manual `if/else`
conditions to check the previous state; `classList.toggle()` already
handles that back-and-forth logic automatically.

## 4.5 Connecting Back to CSS

Recall from [chapter 3 §3.1](03-css-supporting-javascript.md#31-hamburger-from-nav-toggle-to-a-real-button),
the CSS inside `@media (max-width: 480px)` has the rule:

```css
header nav.nav-open {
    display: block;
}
```

The full flow now:

1. The user clicks the hamburger button (`#nav-toggle-btn`).
2. The `click` event listener in [§4.4](#44-attaching-the-event-listener)
   fires.
3. `nav.classList.toggle("nav-open")` adds the `nav-open` class to the
   `<nav>` element.
4. The CSS `header nav.nav-open { display: block; }` automatically
   applies because the `<nav>` element now matches that selector → the
   menu **appears**.
5. Clicking the button once more → `classList.toggle()` **removes** the
   `nav-open` class → the `<nav>` element no longer matches that CSS
   selector → the menu reverts to `display: none` from its base style
   → the menu **hides again**.

## 4.6 Comparison with the Checkbox Hack (Jobsheet-03)

| | Checkbox Hack (Jobsheet-03) | JS-Driven (Jobsheet-05) |
|---|---|---|
| Stores the state | `checked` attribute on a hidden `<input type="checkbox">` | `nav-open` class on the `<nav>` element |
| What changes the state | Browser automatically (built-in checkbox behavior) | JavaScript code (`classList.toggle`) |
| CSS selector | `.nav-toggle:checked ~ nav` (pseudo-class + sibling combinator) | `header nav.nav-open` (plain class selector) |
| Needs JavaScript? | Not at all | Yes |

The checkbox hack ([jobsheet-03 documentation](../../jobsheet-03/Documentation/03-css-hamburger-checkbox-hack.md))
remains a valid and useful CSS trick, especially when JavaScript hasn't
been learned/available yet. But once JavaScript is available (as in
this jobsheet), a `classList`-based approach is usually **easier to
read and extend** — no need to understand the sibling combinator just
to know "is this menu open or closed", just check whether one class
exists.

Continue to: [JS: Delete Confirmation](05-js-delete-confirmation.md)
