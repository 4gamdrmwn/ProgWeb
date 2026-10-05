# 1. Basic Concepts: AJAX, JSON, Promise, async/await

This jobsheet's Sub-CPMK mentions "asynchronous communication (AJAX/fetch,
JSON)" — four terms that need to be understood before reading the
`books.js`/`members.js` code.

## 1.1 What is AJAX?

**AJAX** (*Asynchronous JavaScript and XML* — a historical name, now
almost always used with JSON instead of XML) is a technique for
fetching data from a server **without needing to reload the entire
page**. Compare this with the form you've known since
[jobsheet-01 documentation](../../jobsheet-01/Documentation/04-books-add-html.md#42-the-form-element):
submitting a regular form makes the browser reload the **entire** page.
With AJAX, JavaScript can fetch new data **in the background**, then
update just **part** of the page (in this jobsheet: filling a table's
`<tbody>`) — a much smoother experience for the user.

## 1.2 What is JSON?

**JSON** (*JavaScript Object Notation*) is a text format for storing
structured data, designed to be easy for humans to read **and** easy
for programs to process. See `data/books.json`:

```json
[
    { "title": "Laskar Pelangi", "author": "Andrea Hirata", "year": 2005, "stock": 4 },
    { "title": "Bumi Manusia", "author": "Pramoedya Ananta Toer", "year": 1980, "stock": 2 }
]
```

- The outer square brackets `[ ]` mark an **array** (a list) containing
  many items.
- Each item is wrapped in curly braces `{ }` — called an **object**, a
  collection of **key**/**value** pairs separated by a colon. Example:
  the key `"title"` has the value `"Laskar Pelangi"`.
- Compare this structure with a single `<tr>` row in a static HTML
  table you've known since
  [jobsheet-01 documentation](../../jobsheet-01/Documentation/03-books-list-html.md#33-the-displayed-data-dummy):
  one JSON object `{ "title": ..., "author": ..., "year": ..., "stock": ... }`
  carries **exactly the same** information as one `<tr>` row containing
  4 `<td>` cells — only the storage form differs. A detailed
  explanation of both JSON files is in [chapter 3](03-json-data.md).

**Important:** JSON has stricter writing rules than a regular
JavaScript object — key names **must** be wrapped in double quotes
(`"title"`, not `title` without quotes), and JSON **doesn't allow**
comments at all. These strict rules are intentional so the JSON format
can be processed consistently by almost every programming language, not
just JavaScript.

## 1.3 What is `fetch()`?

**`fetch(url)`** is a built-in browser function for **requesting** data
from an address (can be a local file like `data/books.json`, or a real
server address). The simplest form:

```js
fetch("../data/books.json")
```

This line alone does **not** give us the data yet — it only **starts**
the request. To understand why an extra step is needed, we first need
to understand the **Promise** concept.

## 1.4 What is a Promise? (Why Do We Need `await`?)

Fetching data over a network **takes time** — could be a few
milliseconds, or a few seconds depending on connection speed.
JavaScript does **not stop completely** waiting for this process to
finish (if it did, the entire page would "freeze" while waiting) —
instead, `fetch()` immediately returns a **Promise**: a "promise" that
its result (real data, or an error) will be available **later**, not
instantly.

**`await`** is a keyword meaning "wait until this Promise finishes,
then continue to the next line" — without `await`, we would only get
the "promise" itself, not the real data:

```js
const res = await fetch("../data/books.json");
```

This line means: "start fetching data from `books.json`, **wait**
until the process finishes, then store the result in `res`."

## 1.5 What is an `async function`?

`await` **may only be used** inside a function marked with **`async`**
in front of it:

```js
async function loadBookList() {
    // "await" is allowed here
}
```

The `async` keyword tells JavaScript that this function **runs
asynchronously** — it's allowed to "pause briefly" at lines containing
`await` (waiting for a Promise to finish) without blocking the entire
page from doing other things meanwhile. This `async`/`await` pair is
the **modern** way to write asynchronous code in JavaScript — much
easier to read compared to the older approaches (chained
`.then()`/`.catch()`) which are not used in this jobsheet.

## 1.6 Handling Failure: `try`/`catch`/`finally`

```js
try {
    // code that might fail (e.g. fetch fails because the file doesn't exist)
} catch (err) {
    // runs ONLY if there's an error in the try block
} finally {
    // always runs, whether it succeeded or failed
}
```

- **`try { ... }`** wraps code that might potentially fail.
- **`catch (err) { ... }`** catches that error (stored in the `err`
  variable) so the program **doesn't crash entirely** — instead, we can
  display a friendly message to the user (see it applied in
  [chapter 4](04-js-fetch-render-books.md)).
- **`finally { ... }`** always runs at the end, whether `try` succeeded
  **or** `catch` handled an error — suitable for code that must always
  run regardless of the outcome, such as hiding the loading indicator
  (explained in [chapter 4](04-js-fetch-render-books.md)).

Armed with the 6 concepts above (AJAX, JSON, `fetch`, Promise/`await`,
`async function`, `try`/`catch`/`finally`), you're ready to read the
`books.js` and `members.js` code line by line starting in chapter 4.

Continue to: [What Changed in the HTML Files?](02-html-file-changes.md)
