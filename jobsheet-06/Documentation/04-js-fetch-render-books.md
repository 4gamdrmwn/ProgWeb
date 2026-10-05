# 4. JS: Fetch & Render the Book List

This is the most important function in this jobsheet — combining
**all** the concepts from [chapter 1](01-basic-fetch-json-concepts.md)
into one real workflow.

## 4.1 Full Code

```js
// Fetch & render the Book List asynchronously from data/books.json
async function loadBookList() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        // simulate network delay so the loading indicator is visible
        await new Promise((resolve) => setTimeout(resolve, 600));

        const res = await fetch("../data/books.json");
        if (!res.ok) {
            throw new Error("Failed to fetch data (status " + res.status + ")");
        }
        const books = await res.json();

        books.forEach(function (book) {
            const tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + book.title + "</td>" +
                "<td>" + book.author + "</td>" +
                "<td>" + book.year + "</td>" +
                "<td>" + book.stock + "</td>" +
                "<td>" +
                "<button type=\"button\">Edit</button> " +
                "<button type=\"button\" class=\"btn-delete\">Delete</button>" +
                "</td>";
            tbody.appendChild(tr);
        });
    } catch (err) {
        tbody.innerHTML =
            "<tr><td colspan=\"5\">Failed to load data: " + err.message + "</td></tr>";
    } finally {
        loading.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", loadBookList);
```

## 4.2 Getting the Elements Needed

```js
const tbody = document.querySelector(".table-responsive table tbody");
const loading = document.getElementById("loading-indicator");
if (!tbody) return;
```

- `tbody` — the empty `<tbody>` element already discussed in
  [chapter 2 §2.1](02-html-file-changes.md#21-the-tbody-is-now-empty),
  where the rows from the fetch will be inserted.
  where the rows from the fetch will be inserted.
- `loading` — the "Loading data..." indicator element from
  [chapter 2 §2.2](02-html-file-changes.md#22-new-element-loading-indicator).
- Guard clause `if (!tbody) return;` — the same pattern from
  [jobsheet-05 documentation §1.7](../../jobsheet-05/Documentation/01-basic-javascript-dom-concepts.md#17-general-code-structure-in-appjs).
  Notice only `tbody` is checked (not `loading` too) — this is slightly
  inconsistent with the more complete guard clause pattern in `app.js`
  ([jobsheet-05 documentation §4.3](../../jobsheet-05/Documentation/04-js-hamburger-menu.md#43-guard-clause)),
  but is safe **for now** because `books.js` is only loaded on pages
  that always have both elements (recall from
  [chapter 2 §2.3](02-html-file-changes.md#23-the-new-script-tag-order)).

## 4.3 Showing (and Hiding) the Loading Indicator

```js
loading.style.display = "block";
tbody.innerHTML = "";
```

- **`loading.style.display = "block";`** — changes the loading
  indicator's `display` style directly from JavaScript (the same
  concept as `row.style.display` you already used in
  [jobsheet-05 documentation §6.5](../../jobsheet-05/Documentation/06-js-table-filter.md#65-iterating-over-every-table-row)),
  overriding the default `style="display:none;"` from the HTML
  ([chapter 2 §2.2](02-html-file-changes.md#22-new-element-loading-indicator)) —
  the "Loading data..." text now appears.
- **`tbody.innerHTML = "";`** — clears the contents of `<tbody>` (just
  in case this function is called more than once, e.g. if a "Reload"
  button is added later).

At the end of the function (whether it succeeds or fails), the line
`loading.style.display = "none";` inside the **`finally`** block
([§4.8](#48-the-finally-block-always-hides-loading)) will hide it
again.

## 4.4 Simulating Network Delay

```js
await new Promise((resolve) => setTimeout(resolve, 600));
```

Recall from [jobsheet-06 documentation §1.4](01-basic-fetch-json-concepts.md#14-what-is-a-promise-why-do-we-need-await),
`fetch()` itself already returns a Promise. This line **manually
creates a new Promise** that deliberately "delays" for 600 milliseconds
(`setTimeout(resolve, 600)`) before continuing — purely for **learning
purposes**, so the loading indicator has time to actually be seen
(because fetching a local JSON file is usually **very fast**, less than
a fraction of a second, so without this artificial delay, the "Loading
data..." text might never be seen at all). Recall the note from this
jobsheet's [README.md](../README.md): this delay is indeed simulated,
not a real network delay.

## 4.5 Fetching the Data and Checking for Success

```js
const res = await fetch("../data/books.json");
if (!res.ok) {
    throw new Error("Failed to fetch data (status " + res.status + ")");
}
const books = await res.json();
```

- **`fetch("../data/books.json")`** — notice the relative path `../`
  because `books.js` is loaded from the `books/list.html` page (inside
  the `books/` folder), while `data/books.json` is in the sibling
  `data/` folder (`../` goes up first to the root, recall the relative
  path rule from
  [jobsheet-01 documentation §1.5](../../jobsheet-01/Documentation/01-basic-concepts.md#15-navigation-between-pages-a-href).
- **`res.ok`** — a property on the `fetch` result that is `true` if the
  request succeeded (HTTP status in the 200s), `false` if it failed
  (e.g. file not found, status 404). Interestingly, `fetch()` is **not
  automatically** considered failed (doesn't go into `catch`) just
  because the file wasn't found — that's why a manual check
  `if (!res.ok)` is needed.
- **`throw new Error("...")`** — manually creates and "throws" an Error
  object. Throwing an error here **deliberately** moves the execution
  flow straight to the `catch` block below
  ([§4.7](#47-catching-and-displaying-the-error)), as if a real error
  occurred — a common trick to turn a "logical failure" (fetch
  "succeeded" technically but the file turned out not to exist) into a
  uniform error-handling flow.
- **`await res.json()`** — converts the response body (initially raw
  JSON text) into a real **array of JavaScript objects** accessible via
  `.title`, `.author`, etc. (recall this concept discussed in
  [jobsheet-06 documentation §3.5](03-json-data.md#35-how-does-this-data-turn-into-a-javascript-object)).
  Notice `.json()` **also** uses `await` — it's itself a separate
  asynchronous process (reading and parsing text also takes time, even
  if usually very brief).

## 4.6 Building Table Rows from the Data

```js
books.forEach(function (book) {
    const tr = document.createElement("tr");
    tr.innerHTML =
        "<td>" + book.title + "</td>" +
        "<td>" + book.author + "</td>" +
        "<td>" + book.year + "</td>" +
        "<td>" + book.stock + "</td>" +
        "<td>" +
        "<button type=\"button\">Edit</button> " +
        "<button type=\"button\" class=\"btn-delete\">Delete</button>" +
        "</td>";
    tbody.appendChild(tr);
});
```

- **`books.forEach(...)`** — iterates over **every** book object in the
  array returned by `res.json()` (the same `forEach` pattern you
  already used in
  [jobsheet-05 documentation §5.2](../../jobsheet-05/Documentation/05-js-delete-confirmation.md#52-attaching-an-event-listener-to-multiple-buttons-at-once)
  and [§6.5](../../jobsheet-05/Documentation/06-js-table-filter.md#65-iterating-over-every-table-row)).
- **`document.createElement("tr")`** — creates a new `<tr>` element
  from code (recall the similar method, `createElement("span")`, from
  [jobsheet-05 documentation §7.3](../../jobsheet-05/Documentation/07-js-form-validation.md#73-helper-function-showerror)).
- **`tr.innerHTML = "..."`** — fills the newly created `<tr>` element
  with a chunk of HTML (as **text**, joined with the `+` operator)
  containing 5 `<td>` cells, including the Edit and Delete buttons.
  Notice **`book.title`**, **`book.author`**, etc. — this is how you
  access the **value** of a key inside a JavaScript object (`book` here
  is one object from the `books` array, matching the structure already
  discussed in [chapter 3](03-json-data.md)).
- **`tbody.appendChild(tr);`** — a DOM method for **adding** the newly
  created `tr` element as the last child of `tbody`. This method is
  called **once per book**, so after the entire `forEach` finishes, the
  `<tbody>` will contain 10 `<tr>` rows (the number of objects in
  `data/books.json`, recall from
  [chapter 3 §3.1](03-json-data.md#31-databooksjson--10-book-objects)) —
  even though in the original HTML that `<tbody>` was completely empty.

**A note on security:** writing `tr.innerHTML = "<td>" + book.title + "</td>"`
by concatenating text directly like this can create a security hole
(called **XSS**, *Cross-Site Scripting*) **if** the `book.title` data
comes from untrusted user input (e.g. if a malicious user manages to
inject HTML/JavaScript code into a book title). In this jobsheet it
stays safe because the `books.json` data is entirely controlled by the
developer themselves (not user input) — but this is an important note
to remember for later, once data really does come from users (starting
with forms connected to a server in later jobsheets).

## 4.7 Catching and Displaying the Error

```js
} catch (err) {
    tbody.innerHTML =
        "<tr><td colspan=\"5\">Failed to load data: " + err.message + "</td></tr>";
}
```

If **anything** inside the `try` block fails — whether `fetch` itself
fails entirely (e.g. a misspelled filename), or `throw new Error` in
[§4.5](#45-fetching-the-data-and-checking-for-success) is deliberately
called — this `catch` block's code runs. `err.message` contains the
error's explanatory text (either a message we wrote ourselves via
`throw new Error("...")`, or the browser's built-in message for other
error types). Notice **`colspan="5"`** — an HTML attribute not used in
previous jobsheets: makes one `<td>` cell **span 5 columns at once**
(the number of columns in the Book List table), so the error message
displays as one neat full-width row, instead of being squeezed into
just the first column.

## 4.8 The `finally` Block: Always Hides Loading

```js
} finally {
    loading.style.display = "none";
}
```

Recall from [jobsheet-06 documentation §1.6](01-basic-fetch-json-concepts.md#16-handling-failure-trycatchfinally),
the `finally` block **always** runs — whether the data loads
successfully ([§4.6](#46-building-table-rows-from-the-data)) or fails
([§4.7](#47-catching-and-displaying-the-error)). This is why the code
that hides the loading indicator again is placed here, instead of just
at the end of the `try` block — if placed at the end of `try`, that
line would **never run** if an error occurred (because an error jumps
straight to `catch`, skipping the rest of the code in `try`), and the
loading indicator would be **stuck** showing forever even though the
fetch process has already failed and stopped.

## 4.9 Calling the Function When the Page is Ready

```js
document.addEventListener("DOMContentLoaded", loadBookList);
```

The same pattern as `app.js`
([jobsheet-05 documentation §1.7](../../jobsheet-05/Documentation/01-basic-javascript-dom-concepts.md#17-general-code-structure-in-appjs)):
`loadBookList` is only called **after** the entire HTML has finished
loading into the DOM, ensuring the `<tbody>` and `#loading-indicator`
elements are guaranteed to exist when this function starts looking for
them.

Continue to: [JS: Fetch & Render the Member List](05-js-fetch-render-members.md)
