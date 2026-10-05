# 6. JS: Event Delegation for the Delete Button

This small change in `app.js` has a big reason behind it — and
introduces an important pattern called **event delegation**.

## 6.1 Code Before and After

**Before (jobsheet-05):**
```js
function initDeleteConfirm() {
    document.querySelectorAll(".btn-delete").forEach(function (btn) {
        btn.addEventListener("click", function () {
            const row = btn.closest("tr");
            const name = row ? row.querySelector("td")?.textContent : "this item";
            const confirmed = confirm("Are you sure you want to delete \"" + name + "\"?");
            if (confirmed && row) {
                row.remove();
            }
        });
    });
}
```

**Now (jobsheet-06):**
```js
// Uses event delegation on document because table rows are now
// rendered dynamically via fetch (see books.js/members.js), so the
// .btn-delete button might not exist yet at DOMContentLoaded.
function initDeleteConfirm() {
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".btn-delete");
        if (!btn) return;

        const row = btn.closest("tr");
        const name = row ? row.querySelector("td")?.textContent : "this item";
        const confirmed = confirm("Are you sure you want to delete \"" + name + "\"?");
        if (confirmed && row) {
            row.remove();
        }
    });
}
```

## 6.2 What Problem Does This Fix?

Recall how `initDeleteConfirm` worked in the jobsheet-05 version
([jobsheet-05 documentation §5.2](../../jobsheet-05/Documentation/05-js-delete-confirmation.md#52-attaching-an-event-listener-to-multiple-buttons-at-once)):
`document.querySelectorAll(".btn-delete")` finds **all** Delete buttons
that **already exist in the DOM at that moment**, then attaches an
event listener to each one individually. This code runs once at
`DOMContentLoaded` ([jobsheet-05 documentation §1.7](../../jobsheet-05/Documentation/01-basic-javascript-dom-concepts.md#17-general-code-structure-in-appjs)).

The problem: in jobsheet-06, the `.btn-delete` button **no longer
exists** in the HTML from the start — recall from
[chapter 2 §2.1](02-html-file-changes.md#21-the-tbody-is-now-empty),
the `<tbody>` is now **empty**, and the table rows (including the
Delete button inside them) are only **created later** by
`books.js`/`members.js` via `tbody.appendChild(tr)` (recall from
[chapter 4 §4.6](04-js-fetch-render-books.md#46-building-table-rows-from-the-data)) —
and that process itself only finishes **after** the asynchronous
`fetch` process completes (which takes time, especially with the
simulated 600ms delay from
[chapter 4 §4.4](04-js-fetch-render-books.md#44-simulating-network-delay)).

If the old version of `initDeleteConfirm` were still used: when
`DOMContentLoaded` fires and `querySelectorAll(".btn-delete")` runs,
**not a single** `.btn-delete` button exists yet in the DOM (because
`books.js` hasn't finished fetching data) — as a result, **no event
listener gets attached at all**, and the Delete buttons that appear
later will never react when clicked.

## 6.3 Solution: Event Delegation

**Event delegation** is a technique of attaching **one** event listener
to an **ancestor** element (here: `document`, the topmost/outermost
element of all) instead of attaching separate listeners to each target
element. This technique takes advantage of a natural browser event
behavior called **event bubbling** — when an element is clicked, that
click "event" **travels upward** through all its ancestor elements
(from the button → `<td>` → `<tr>` → `<tbody>` → ... → `document`), not
just occurring at the clicked element itself.

```js
document.addEventListener("click", function (e) {
    const btn = e.target.closest(".btn-delete");
    if (!btn) return;
    // ...
});
```

- The event listener is attached **only once**, on `document` — an
  element that **always exists** from the start, regardless of which
  table rows have or haven't been created yet.
- **`e.target`** — a property on the event object (`e`) referring to
  the **most specific** element that the user actually clicked (could
  be the button itself, or sometimes some other element inside it).
- **`e.target.closest(".btn-delete")`** — recall the `.closest()`
  method from
  [jobsheet-05 documentation §5.3](../../jobsheet-05/Documentation/05-js-delete-confirmation.md#53-finding-the-table-row-that-owns-the-button),
  but this time used for a different purpose: searching **upward** from
  the clicked element to confirm the click **really happened** on (or
  inside) a `.btn-delete` button — because `document` receives click
  events from **anywhere** on the entire page (including clicks on the
  Edit button, clicks on the search box, etc).
- **`if (!btn) return;`** — if the click actually happened somewhere
  else (not a Delete button), `.closest(".btn-delete")` will return
  `null`, and the function stops here — doing nothing for irrelevant
  clicks.

Once `btn` is found, the rest of the code (finding `row` via
`btn.closest("tr")`, showing `confirm()`, calling `row.remove()`) is
**exactly the same** as the jobsheet-05 version — those concepts were
already covered thoroughly in
[jobsheet-05 documentation §5.3-5.6](../../jobsheet-05/Documentation/05-js-delete-confirmation.md#53-finding-the-table-row-that-owns-the-button).

## 6.4 Why Does This Work for Buttons That "Don't Exist Yet"?

This is the most important part to understand: because the event
listener is attached to `document` (not to each button individually),
this listener **doesn't care** when that `.btn-delete` button was
created — whether it already existed since `DOMContentLoaded`, or only
appeared a few hundred milliseconds later after `fetch` finishes
([chapter 4](04-js-fetch-render-books.md)). As long as the button
**exists in the DOM at the moment it's clicked** (whenever that is), a
click on that button will still "bubble" up to `document`, and the
listener attached from the start will still detect it via
`e.target.closest(".btn-delete")`.

## 6.5 When Should You Use Event Delegation?

| Situation | Suitable Approach |
|---|---|
| Target elements **already exist** when the page loads, fixed count | Attach listeners directly to each element (`querySelectorAll(...).forEach(...)`, as in [jobsheet-05 documentation](../../jobsheet-05/Documentation/05-js-delete-confirmation.md)) |
| Target elements are **created/removed dynamically** after the page loads (via `fetch`, or other user interaction) | Event delegation on a stable ancestor element (as in this jobsheet) |

The practical rule: once you start creating elements dynamically via
JavaScript (like `books.js`/`members.js` in this jobsheet), the
question "does this element need an event listener, and when will this
element exist?" becomes important to think about — if the answer is
"this element could appear at any time, even after this code first
runs", event delegation is usually the safer choice.

Continue to: [Running with a Local Server (CORS)](07-running-with-local-server.md)
