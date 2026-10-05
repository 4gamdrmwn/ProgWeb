# Jobsheet 6 Documentation — Fetch API & JSON

This documentation continues from
[jobsheet-05 documentation](../../jobsheet-05/Documentation/README.md)
(JavaScript DOM & Event). If you don't yet understand JavaScript
basics — selecting DOM elements, event listeners, `classList`, etc. —
read the jobsheet-05 documentation first before continuing here,
because this jobsheet builds heavily on those concepts.

## About `docs/wireframe.md`

This file is **identical** to
[`docs/wireframe.md` in jobsheet-05](../../jobsheet-05/docs/wireframe.md) —
there's no new UI/UX design in this jobsheet. Read
[jobsheet-04 documentation](../../jobsheet-04/Documentation/README.md) if
you need to refresh your memory on the wireframe & user flow.

## What's New in Jobsheet 6?

Per this jobsheet's [README.md](../README.md), this is another
important milestone in SIMPUS-Mini's journey: for the **first time**,
table data (Book List & Member List) is **no longer written manually**
in HTML — it's fetched dynamically from a JSON file using JavaScript.
Four major changes:

1. **Two new JSON files** (`data/books.json`, `data/members.json`) —
   the data source, temporarily replacing a real API/server that
   doesn't exist yet.
2. **Table rendering moved to JavaScript** — the `<tbody>` in the HTML
   is now **empty**, filled dynamically by `assets/js/books.js` /
   `assets/js/members.js` via `fetch` + `async/await`.
3. **Loading indicator** — the text "Loading data..." briefly appears
   while the data is being fetched.
4. **Error handling** with `try/catch` — if fetching data fails, the
   table shows an error message instead of a blank/broken page.

Plus one supporting change: `initDeleteConfirm` in `app.js` was changed
to the **event delegation** pattern, because the Delete button now
lives in a row that's newly created after the page has finished loading
(discussed in [chapter 6](06-js-event-delegation-delete.md)).

## Table of Contents

1. [Basic Concepts: AJAX, JSON, Promise, async/await](01-basic-fetch-json-concepts.md)
2. [What Changed in the HTML Files?](02-html-file-changes.md)
3. [JSON Data: `books.json` & `members.json`](03-json-data.md)
4. [JS: Fetch & Render the Book List](04-js-fetch-render-books.md)
5. [JS: Fetch & Render the Member List](05-js-fetch-render-members.md)
6. [JS: Event Delegation for the Delete Button](06-js-event-delegation-delete.md)
7. [Running with a Local Server (CORS)](07-running-with-local-server.md)
8. [Summary & Further Exercises](08-summary-and-exercises.md)

## Folder Structure

```
jobsheet-06/
├── index.html
├── assets/
│   ├── css/style.css        # Unchanged from jobsheet-05
│   └── js/
│       ├── app.js            # initDeleteConfirm changed (event delegation)
│       ├── books.js          # NEW — fetch + render Book List
│       └── members.js        # NEW — fetch + render Member List
├── data/
│   ├── books.json              # NEW — 10 book data objects
│   └── members.json            # NEW — 4 member data objects
├── books/
│   ├── list.html                # empty <tbody> + loading-indicator
│   └── add.html
├── members/
│   ├── list.html
│   └── add.html
├── docs/wireframe.md            # Identical to jobsheet-05
├── README.md
└── Documentation/                # This documentation folder
```

**Important note** from the start (from this jobsheet's
[README.md](../README.md)): `data/books.json` and `data/members.json`
are a **temporary substitute** for a real API. The `fetch` +
`async/await` pattern you learn here will be reused to call a real PHP
endpoint starting in Jobsheet 9 — even though starting in Jobsheet 7,
the main rendering actually moves to the server side (PHP), no longer
entirely in the browser as in this jobsheet.
