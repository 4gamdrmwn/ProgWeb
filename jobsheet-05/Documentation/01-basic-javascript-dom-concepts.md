# 1. Basic JavaScript & DOM Concepts

This is your first introduction to JavaScript in this whole jobsheet series.
Get familiar with the basic terms first before diving into the `app.js` code.

## 1.1 What's the Difference Between HTML, CSS, and JavaScript?

You already know HTML handles **structure/content**
([jobsheet-01 documentation](../../jobsheet-01/Documentation/01-basic-concepts.md))
and CSS handles **appearance**
([jobsheet-02 documentation](../../jobsheet-02/Documentation/README.md)).
**JavaScript (JS)** adds a third layer: **behavior/interactivity**
— what happens when a user clicks something, types something,
or submits a form. These three layers are deliberately split into
different files (`.html`, `.css`, `.js`) so each can be changed without
affecting the others — the same principle as *separation of concerns*
already discussed in
[jobsheet-02 documentation §2.2](../../jobsheet-02/Documentation/02-html-file-changes.md#22-why-was-the-html-structure-intentionally-left-unchanged).

## 1.2 Connecting JavaScript to HTML

```html
<script src="assets/js/app.js"></script>
```

Compare this with how CSS is connected
(`<link rel="stylesheet" href="...">`, see
[jobsheet-02 documentation §1.3](../../jobsheet-02/Documentation/01-basic-css-concepts.md#13-connecting-css-to-html)) —
for JavaScript, the tag used is `<script>`, with the `src`
attribute pointing to the location of the `.js` file. Notice on every
page in this jobsheet, the `<script>` tag is placed **at the end of
`<body>`**, right before `</body>` closes — not in `<head>` like the
CSS `<link>`. The reason is explained in [§1.3](#13-why-is-script-placed-at-the-end-of-body).

## 1.3 Why Is `<script>` Placed at the End of `<body>`?

The browser reads and runs the HTML file **from top to bottom, line by
line**. If `<script>` is placed in `<head>` (at the very top), the
JavaScript code would run **before** the elements in `<body>` (like
`<button id="nav-toggle-btn">` or `<table>`) have finished being built
by the browser — as a result, JS code trying to find that element
would fail because the element doesn't exist yet. By placing
`<script>` at the **very end** of `<body>`, all the HTML above it is
guaranteed to already be built by the browser before `app.js` starts
running.

## 1.4 What is the DOM?

The **DOM (Document Object Model)** is a representation of the HTML
page in a form that can be "read and modified" by JavaScript — imagine
the entire HTML structure (every `<header>`, `<table>`, `<button>`,
etc.) turned into a "tree" of objects that can be traversed and
modified through code. This jobsheet's Sub-CPMK explicitly mentions
"DOM manipulation & events" — the DOM is the **object** being
manipulated, while **events** (discussed in
[§1.6](#16-what-are-events-and-event-listeners)) are the **triggers**
that determine when that manipulation happens.

## 1.5 Selecting Elements from the DOM

`app.js` uses 3 different ways to "grab" HTML elements so they can be
manipulated:

| Function | Retrieves | Example Usage in `app.js` |
|---|---|---|
| `document.getElementById("id")` | **One** element based on its `id` attribute (must be unique on one page — recall the unique `id` rule from [jobsheet-01 documentation](../../jobsheet-01/Documentation/04-books-add-html.md#43-the-pattern-for-each-form-field-label--input)). | `document.getElementById("nav-toggle-btn")` |
| `document.querySelector("selector")` | The **first** element that matches a CSS selector (any selector you already know from [jobsheet-02 documentation](../../jobsheet-02/Documentation/01-basic-css-concepts.md#14-types-of-selectors-used-in-stylecss)). | `document.querySelector("header nav")` |
| `document.querySelectorAll("selector")` | **All** elements matching the selector, as a collection (can be iterated one by one with `.forEach()`). | `document.querySelectorAll(".btn-delete")` |

Interestingly, `querySelector`/`querySelectorAll` use the **exact same
CSS selectors** you write in `style.css` — good news, meaning the
CSS-selector-reading skill you've mastered since jobsheet-02 is
immediately useful for writing JavaScript too.

## 1.6 What Are Events and Event Listeners?

An **event** is something that "happens" on the page — a user
clicking (`click`), typing then releasing a keyboard key (`keyup`),
or pressing a form's submit button (`submit`). An **event listener**
is code that "waits" for a certain event to happen on an element,
then runs a specific function in response:

```js
element.addEventListener("click", function () {
    // this code runs EVERY TIME the element is clicked
});
```

The pattern is always the same: **select the element** (§1.5) → call
`.addEventListener(eventName, function)` on that element → write the
function containing what should happen. Three events are used in this
jobsheet:

| Event | Occurs When | Used In |
|---|---|---|
| `click` | An element is clicked | Hamburger button ([chapter 4](04-js-hamburger-menu.md)), Delete button ([chapter 5](05-js-delete-confirmation.md)) |
| `keyup` | A keyboard key is released (after typing) | Search box ([chapter 6](06-js-table-filter.md)) |
| `submit` | A form is about to be sent (submit button pressed) | Form validation ([chapter 7](07-js-form-validation.md)) |

## 1.7 General Code Structure in `app.js`

Before breaking down each feature one by one in chapters 4-7, notice
the overall pattern repeated throughout the file:

```js
function initNavToggle() {
    // grab elements, attach event listeners
}

// ...other init functions...

document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initDeleteConfirm();
    initTableFilter();
    initFormValidation();
});
```

- Each feature is wrapped in **its own function** (`initNavToggle`,
  `initDeleteConfirm`, etc.) — a good coding habit so each feature is
  easy to read separately, instead of being mixed into one long block
  of code.
- **`document.addEventListener("DOMContentLoaded", ...)`** at the very
  bottom is the "entry point" of the entire script: `DOMContentLoaded`
  is a special event that occurs **after the entire HTML has finished
  loading** into the browser as the DOM. All the `init...` functions
  are called inside it to make sure the elements they look for (e.g.
  `#nav-toggle-btn`) are **guaranteed to exist** in the DOM when the
  code runs — an extra safety layer on top of placing `<script>` at
  the end of `<body>`, already discussed in
  [§1.3](#13-why-is-script-placed-at-the-end-of-body).
- Also notice each `init...` function in `app.js` always starts with a
  check like `if (!toggleBtn || !nav) return;` — this is a **guard
  clause**: if the element being looked for doesn't actually exist on
  that page (for example, a page without a table doesn't have a
  `.table-responsive table` element), the function stops early
  (`return`) instead of erroring out from trying to call a method on
  something that is `null`. Thanks to this guard, the same single
  `app.js` file can be used on **all** pages (Home without a table, a
  list page with a table, an add page with a form) without causing
  errors on pages that don't have a particular element.

Armed with these terms, you're now ready to read the concrete changes
starting in chapter 2.

Continue to: [What Changed in the HTML Files?](02-html-file-changes.md)
