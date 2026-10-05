# 5. JS: Fetch & Render the Member List

Good news: `members.js` has a **structure identical** to `books.js`
which you already dissected thoroughly in [chapter 4](04-js-fetch-render-books.md).
This chapter only highlights the parts that are **different**.

## 5.1 Full Code

```js
// Fetch & render the Member List asynchronously from data/members.json
async function loadMemberList() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 600));

        const res = await fetch("../data/members.json");
        if (!res.ok) {
            throw new Error("Failed to fetch data (status " + res.status + ")");
        }
        const members = await res.json();

        members.forEach(function (member) {
            const tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + member.member_id + "</td>" +
                "<td>" + member.name + "</td>" +
                "<td>" + member.address + "</td>" +
                "<td>" + member.phone + "</td>" +
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

document.addEventListener("DOMContentLoaded", loadMemberList);
```

## 5.2 Direct Comparison with `books.js`

| Part | `books.js` | `members.js` |
|---|---|---|
| Function name | `loadBookList` | `loadMemberList` |
| Data source | `fetch("../data/books.json")` | `fetch("../data/members.json")` |
| Result array variable name | `books` | `members` |
| Per-item variable name in `forEach` | `book` | `member` |
| Object keys accessed | `.title`, `.author`, `.year`, `.stock` | `.member_id`, `.name`, `.address`, `.phone` |
| Trigger event | `DOMContentLoaded` → `loadBookList` | `DOMContentLoaded` → `loadMemberList` |

Every other part — getting elements ([chapter 4 §4.2](04-js-fetch-render-books.md#42-getting-the-elements-needed)),
the loading indicator ([§4.3](04-js-fetch-render-books.md#43-showing-and-hiding-the-loading-indicator)),
the simulated delay ([§4.4](04-js-fetch-render-books.md#44-simulating-network-delay)),
the `res.ok` check ([§4.5](04-js-fetch-render-books.md#45-fetching-the-data-and-checking-for-success)),
error handling ([§4.7](04-js-fetch-render-books.md#47-catching-and-displaying-the-error)),
and the `finally` block ([§4.8](04-js-fetch-render-books.md#48-the-finally-block-always-hides-loading))
— is **exactly identical**, feel free to re-read [chapter 4](04-js-fetch-render-books.md)
if you've forgotten any part.

## 5.3 Why Are Different Columns Accessed?

The most important difference to notice is in the `forEach` section:
`member.member_id`, `member.name`, `member.address`, `member.phone` —
these four keys **must** match exactly the key names that actually
exist in `data/members.json` (recall the structure from
[chapter 3 §3.2](03-json-data.md#32-datamembersjson--4-member-objects)).
If you misspell a key name (e.g. writing `member.number` when the JSON
key is actually `member_id`), JavaScript will **not error** — it will
just return `undefined` (a "not present" value), so the table cell that
should contain data instead shows blank or the word "undefined". This
is a common mistake that's easy to miss because it doesn't produce a
clear error in the Console — if the table shows up but the data is
empty/odd, first check whether the key names in the code exactly match
the key names in the JSON file.

## 5.4 Why Write This in Two Separate Files, Instead of One Generic Function?

You might ask: why not create just **one** generic function that
accepts a JSON filename and a list of columns as parameters, reused for
both books and members — reducing code duplication? That's a good
question, and the answer relates to the current learning stage: writing
two separate, **similar but explicit** functions is easier to read and
follow for beginners, before learning the technique of writing more
generic/reusable functions. This is also a great follow-up exercise to
try yourself — see [chapter 8](08-summary-and-exercises.md).

Continue to: [JS: Event Delegation for the Delete Button](06-js-event-delegation-delete.md)
