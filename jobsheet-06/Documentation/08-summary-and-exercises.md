# 8. Summary & Further Exercises

## 8.1 Overall Jobsheet 6 Summary

| Section | Concepts Learned |
|---|---|
| [Basic Concepts](01-basic-fetch-json-concepts.md) | AJAX, JSON format, `fetch()`, Promise, `async`/`await`, `try`/`catch`/`finally` |
| [HTML Changes](02-html-file-changes.md) | Empty `<tbody>`, loading indicator, `<script>` order |
| [JSON Data](03-json-data.md) | Structure of `books.json`/`members.json`, JSON data types |
| [Fetch & Render Books](04-js-fetch-render-books.md) | Full `loadBookList` flow: fetch → check status → parse → render → error handling |
| [Fetch & Render Members](05-js-fetch-render-members.md) | The same pattern applied to different data |
| [Event Delegation](06-js-event-delegation-delete.md) | Why & how to handle dynamically created elements |
| [Local Server & CORS](07-running-with-local-server.md) | Why `fetch()` needs `http://`, how to run a local server |

## 8.2 Core Concepts to Remember

1. **`fetch()` is always asynchronous** — its result is a Promise,
   requiring `await` (inside an `async function`) to get the real data
   ([chapter 1](01-basic-fetch-json-concepts.md)).
2. **`res.ok` must be checked manually** — `fetch()` is not
   automatically considered failed just because a file/endpoint isn't
   found
   ([chapter 4 §4.5](04-js-fetch-render-books.md#45-fetching-the-data-and-checking-for-success)).
3. **`try`/`catch`/`finally` keeps the app "alive"** even when a network
   failure occurs — users see a clear error message, not a broken/blank
   page with no explanation
   ([chapter 1 §1.6](01-basic-fetch-json-concepts.md#16-handling-failure-trycatchfinally)).
4. **Event delegation is needed for dynamic elements** — once an
   element is created after `DOMContentLoaded` (via `fetch` or other
   interaction), attach the listener on a stable ancestor element,
   instead of on the element itself
   ([chapter 6](06-js-event-delegation-delete.md)).
5. **`fetch()` needs a server, not `file://`** — remember to run it via
   `php -S localhost:8000`, Live Server, or Laragon every time you try
   this jobsheet ([chapter 7](07-running-with-local-server.md)).

## 8.3 How to Try It Yourself

1. **Run a local server first** (recall [chapter 7](07-running-with-local-server.md) —
   this is **mandatory**, unlike previous jobsheets).
2. Open `http://localhost:8000/books/list.html` (adjust the port if
   different). Notice the "Loading data..." text briefly appears before
   the table fills with 10 book rows.
3. Open **DevTools → Network tab**, refresh the page, find the request
   to `books.json` — click it to see the raw JSON response, compare it
   with the contents of `data/books.json` you already read in
   [chapter 3](03-json-data.md).
4. Try the search feature and Delete button just like in jobsheet-05 —
   notice both still work normally even though the rows are now created
   dynamically.
5. Practice the error-testing steps in
   [chapter 7 §7.5](07-running-with-local-server.md#75-how-to-test-error-handling) —
   deliberately misspell the JSON filename, watch the error message
   display neatly inside the table.

## 8.4 Additional Exercise Ideas (Optional)

1. **Add a "Reload" button** on the Book List page that, when clicked,
   calls `loadBookList()` again — notice this function already clears
   `tbody` first
   ([chapter 4 §4.3](04-js-fetch-render-books.md#43-showing-and-hiding-the-loading-indicator)),
   so it's safe to call multiple times.
2. **Merge `books.js` and `members.js`** into one generic function that
   accepts a JSON filename and a list of key names as parameters — a
   direct exercise for the question raised in
   [chapter 5 §5.4](05-js-fetch-render-members.md#54-why-write-this-in-two-separate-files-instead-of-one-generic-function).
3. **Add a new column** in `data/books.json` (e.g. `"category"`), then
   display it in the table by adding one `<th>` in the HTML and one
   `<td>` in `tr.innerHTML` in `books.js`.
4. **Test event delegation further** — add `console.log(e.target)` at
   the start of the `initDeleteConfirm` function ([chapter 6](06-js-event-delegation-delete.md)),
   open the Console, then click various places on the page (not just
   the Delete button) to see for yourself how `document` receives
   **every** click event on the page, and how `e.target.closest(...)`
   filters out only the relevant ones.
5. **Change the simulated delay** in
   [chapter 4 §4.4](04-js-fetch-render-books.md#44-simulating-network-delay)
   from `600` to `3000` (3 seconds), notice the loading indicator
   becomes much more visible — this is also a good way to feel the
   importance of a loading indicator on a slow connection.

If any part is still confusing, try re-reading
[chapter 1](01-basic-fetch-json-concepts.md) while opening the DevTools
Console — type `await fetch("../data/books.json").then(r => r.json())`
directly in the Console (from the `books/list.html` page opened through
the local server) to see the returned data for yourself, without
needing to read it through the table.
