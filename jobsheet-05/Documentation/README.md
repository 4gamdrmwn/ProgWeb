# Jobsheet 5 Documentation — JavaScript DOM & Event

This documentation continues from
[jobsheet-03 documentation](../../jobsheet-03/Documentation/README.md) (responsive
HTML/CSS) and [jobsheet-04](../../jobsheet-04/Documentation/README.md)
(UI/UX design). Jobsheet-05 is an important milestone: this is the
**first time** the SIMPUS-Mini application has **JavaScript** — code
that makes the page actually "react" to user actions, not just a
static display.

## About `docs/wireframe.md`

This file is **identical** to
[`docs/wireframe.md` in jobsheet-04](../../jobsheet-04/docs/wireframe.md) —
there's no new UI/UX design change in this jobsheet. If you haven't
read that design yet, read
[jobsheet-04 documentation](../../jobsheet-04/Documentation/README.md)
first before continuing here.

## What's New in Jobsheet 5?

Per this jobsheet's [README.md](../README.md), there are 4 major
additions, all through the new file `assets/js/app.js`:

1. **Hamburger menu switched from CSS to JavaScript** — previously used
   a pure-CSS "checkbox hack" (see
   [jobsheet-03 documentation](../../jobsheet-03/Documentation/03-css-hamburger-checkbox-hack.md)),
   now uses a real button + `classList.toggle()`.
2. **Client-side form validation** — the Add Book and Add Member forms
   now reject invalid data **before** being submitted, with error
   messages shown directly on the page.
3. **Real-time table filter/search** — typing in the search box
   immediately filters table rows without reloading the page.
4. **A Delete button that actually works** (on the view side) — shows a
   confirmation then removes the row from the screen.

## Table of Contents

1. [Basic JavaScript & DOM Concepts](01-basic-javascript-dom-concepts.md)
2. [What Changed in the HTML Files?](02-html-file-changes.md)
3. [CSS Supporting the JavaScript Features](03-css-supporting-javascript.md)
4. [JS: Hamburger Menu](04-js-hamburger-menu.md)
5. [JS: Delete Confirmation](05-js-delete-confirmation.md)
6. [JS: Real-Time Table Filter](06-js-table-filter.md)
7. [JS: Form Validation](07-js-form-validation.md)
8. [Summary & Further Exercises](08-summary-and-exercises.md)

## Folder Structure

```
jobsheet-05/
├── index.html
├── assets/
│   ├── css/style.css        # Added styles for error & search-box
│   └── js/
│       └── app.js            # NEW — all the interactivity in this jobsheet
├── books/
│   ├── list.html               # Added search box + btn-delete class
│   └── add.html                # Added id="add-form" for validation
├── members/
│   ├── list.html
│   └── add.html
├── docs/wireframe.md          # Identical to jobsheet-04
├── README.md
└── Documentation/              # This documentation folder
```

**Important note** from this jobsheet's [README.md](../README.md) worth
remembering from the start: validation in this jobsheet runs purely in
the **user's browser** (client-side) and **can be bypassed** if
JavaScript is disabled — not yet safe to fully rely on. Mandatory,
unbypassable server-side validation won't be added until Jobsheet 7.
Likewise for the Delete button: it currently only removes the row from
the view, **not yet** actually deleting the data — that follows in
Jobsheet 9.
