# 3. JSON Data: `books.json` & `members.json`

Before dissecting the code that **reads** this JSON file, first get
familiar with its content and structure.

## 3.1 `data/books.json` — 10 Book Objects

```json
[
    { "title": "Laskar Pelangi", "author": "Andrea Hirata", "year": 2005, "stock": 4 },
    { "title": "Bumi Manusia", "author": "Pramoedya Ananta Toer", "year": 1980, "stock": 2 },
    { "title": "Negeri 5 Menara", "author": "Ahmad Fuadi", "year": 2009, "stock": 0 },
    { "title": "Filosofi Teras", "author": "Henry Manampiring", "year": 2018, "stock": 5 },
    { "title": "Ronggeng Dukuh Paruk", "author": "Ahmad Tohari", "year": 1982, "stock": 1 },
    { "title": "Cantik Itu Luka", "author": "Eka Kurniawan", "year": 2002, "stock": 3 },
    { "title": "Pulang", "author": "Tere Liye", "year": 2015, "stock": 2 },
    { "title": "Sang Pemimpi", "author": "Andrea Hirata", "year": 2006, "stock": 6 },
    { "title": "Perahu Kertas", "author": "Dee Lestari", "year": 2009, "stock": 0 },
    { "title": "Gadis Kretek", "author": "Ratih Kumala", "year": 2012, "stock": 4 }
]
```

Compare this with the Book List table you've known since
[jobsheet-01 documentation](../../jobsheet-01/Documentation/03-books-list-html.md#33-the-displayed-data-dummy):
the first 5 books are **exactly the same** as the dummy data that used
to be written manually in HTML — only now in JSON format, and **5 new
books are added** (total becomes 10), which would never appear if you
opened the old HTML since the old HTML rows are static and not
connected to this file at all.

## 3.2 `data/members.json` — 4 Member Objects

```json
[
    { "member_id": "A001", "name": "Siti Aminah", "address": "Malang", "phone": "0812xxxx" },
    { "member_id": "A002", "name": "Budi Santoso", "address": "Batu", "phone": "0813xxxx" },
    { "member_id": "A003", "name": "Dewi Lestari", "address": "Malang", "phone": "0814xxxx" },
    { "member_id": "A004", "name": "Rizky Firmansyah", "address": "Lawang", "phone": "0815xxxx" }
]
```

Same pattern: the first 2 members match the old dummy data in
[jobsheet-01 documentation](../../jobsheet-01/Documentation/05-members-list-html.md#53-whats-different),
plus 2 new members added.

## 3.3 Why Do the Key Names Exactly Match the `name` Attribute in the Form?

Notice these JSON keys — `title`, `author`, `year`, `stock` for books;
`member_id`, `name`, `address`, `phone` for members — **exactly match**
the `name` attributes on the Add Book/Add Member form inputs you
learned in
[jobsheet-01 documentation §4](../../jobsheet-01/Documentation/04-books-add-html.md)
and [§6](../../jobsheet-01/Documentation/06-members-add-html.md). This
is **not a coincidence** — consistent naming throughout the application
(HTML, JSON, and later the real database) makes data much easier to
trace: the same field always has the **same name** at every layer,
without needing to "translate" different field names in every place.

## 3.4 Data Types Inside JSON

JSON supports several basic value types, and both these files use 2 of
them:

| Type | Example in This Data | Trait |
|---|---|---|
| **String** (text) | `"Laskar Pelangi"`, `"A001"` | Always wrapped in double quotes. |
| **Number** | `2005`, `4`, `0` | **Not** wrapped in quotes. |

Notice `"year": 2005` and `"stock": 4` are written **without** quotes —
meaning JavaScript will read them as **real numbers**, not text. This
matters: if you wrote `"year": "2005"` (with quotes), the value would
become the text `"2005"`, which even though it looks the same on
screen, **cannot** be directly used for number comparisons like
`year > 2000` without converting it first (recall `parseInt()` used for
a similar purpose in
[jobsheet-05 documentation §7.6](../../jobsheet-05/Documentation/07-js-form-validation.md#76-per-field-check-pattern)).
Conversely, notice `"member_id": "A001"` is deliberately written as a
**string** (not a number) — consistent with the discussion in
[jobsheet-01 documentation §6.4](../../jobsheet-01/Documentation/06-members-add-html.md#64-why-is-member-no-text-not-a-number)
about why member numbers use letters+numbers, so they could never be
stored as a pure number type.

## 3.5 How Does This Data "Turn Into" a JavaScript Object?

This `.json` file is **just text** stored on a server/folder — it isn't
a JavaScript object accessible via `book.title` until it's actually
**fetched and parsed** by code. This process is done by the `.json()`
method called after `fetch()` succeeds — explained step by step in
[chapter 4 §4.5](04-js-fetch-render-books.md#45-fetching-the-data-and-checking-for-success).

Continue to: [JS: Fetch & Render the Book List](04-js-fetch-render-books.md)
