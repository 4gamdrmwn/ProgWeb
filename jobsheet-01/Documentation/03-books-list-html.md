# 3. Explanation of `books/list.html` (Book List)

This file displays a **table** containing the library's book list (sample
/static data, 5 rows).

## 3.1 Page Skeleton

The `<header>` and `<footer>` sections follow the **exact same** pattern
as `index.html` (see [index.html documentation](02-index-html.md)), except
the `href` paths change because this file is located inside the `books/`
folder, not at the root:

```html
<li><a href="../index.html">Home</a></li>
<li><a href="list.html">Book List</a></li>
<li><a href="add.html">Add Book</a></li>
<li><a href="../members/list.html">Member List</a></li>
```

- `../index.html` → go up one folder to root, then open `index.html`.
- `list.html` and `add.html` → no prefix, since both are in the same
  `books/` folder.
- `../members/list.html` → go up one folder to root, then down into the
  `members/` folder.

The genuinely new part in this file is inside `<main>`: the **HTML
table**.

## 3.2 Anatomy of an HTML Table

```html
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
            <th>Stock</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Laskar Pelangi</td>
            <td>Andrea Hirata</td>
            <td>2005</td>
            <td>4</td>
            <td>
                <button type="button">Edit</button>
                <button type="button">Delete</button>
            </td>
        </tr>
        <!-- ... 4 more rows with the same pattern ... -->
    </tbody>
</table>
```

| Tag | Full Name | Function |
|---|---|---|
| `<table>` | table | Wraps the entire table. |
| `<thead>` | table head | The table's **header** section — contains the column names. |
| `<tbody>` | table body | The table's **body** section — contains the actual data rows. |
| `<tr>` | table row | One (horizontal) table **row**. |
| `<th>` | table header cell | One **column heading cell** (text is automatically bold & centered by the browser). |
| `<td>` | table data cell | One regular **data cell** within a row. |

How to read the structure: `<table>` contains rows (`<tr>`), and each row
contains cells (`<th>` for headers, `<td>` for data). So this table has 5
columns (Title, Author, Year, Stock, Action) and 5 rows of book data.

### The "Action" Column

```html
<td>
    <button type="button">Edit</button>
    <button type="button">Delete</button>
</td>
```

- Each row has 2 buttons: **Edit** and **Delete**.
- `type="button"` means this is a **plain button**, not a form submit
  button (unlike the "Save" button on the form page — see
  [books/add.html documentation §4.5](04-books-add-html.md#45-submit-button)).
  If `type` is left unspecified and this button is **inside** a `<form>`,
  the browser treats it as a submit button by default — that's why
  `type="button"` is written explicitly here.
- **Important to understand:** these buttons **don't do anything yet**.
  There is no JavaScript connecting the button click to an edit/delete
  action. This is just the UI skeleton — the logic follows in the next
  jobsheet when learning JavaScript.

## 3.3 The Displayed Data (Dummy)

There are 5 rows of book data typed manually directly in HTML:

| Title | Author | Year | Stock |
|---|---|---|---|
| Laskar Pelangi | Andrea Hirata | 2005 | 4 |
| Bumi Manusia | Pramoedya Ananta Toer | 1980 | 2 |
| Negeri 5 Menara | Ahmad Fuadi | 2009 | 0 |
| Filosofi Teras | Henry Manampiring | 2018 | 5 |
| Ronggeng Dukuh Paruk | Ahmad Tohari | 1982 | 1 |

Since this is **static HTML** (not yet connected to a database), this data
cannot be added to/changed through the application — to add a new row,
you have to edit the HTML code directly (copy-paste one `<tr>...</tr>`
block and change its contents).

## 3.4 Why Use `<table>` Instead of Nested `<div>`s?

A table is the right tag choice here because the data is genuinely
**tabular** — it has clearly related columns and rows (each row is one
book, each column is one attribute of the book). Browsers and screen
readers also understand `<table>` structure specifically (e.g. they can
announce "Year column, row 2, value 1980"), which you can't get from
using a plain `<div>`.

Next: [Explanation of `books/add.html`](04-books-add-html.md)
