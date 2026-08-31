# 5. Explanation of `members/list.html` (Member List)

This file is an **independent exercise** in jobsheet 1 — its pattern is
intentionally made similar to
[`books/list.html`](03-books-list-html.md) so you learn to apply the HTML
table concept yourself to different data (members, not books).

## 5.1 Full Code

```html
<table>
    <thead>
        <tr>
            <th>Member No.</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone No.</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>A001</td>
            <td>Siti Aminah</td>
            <td>Malang</td>
            <td>0812xxxx</td>
            <td>
                <button type="button">Edit</button>
                <button type="button">Delete</button>
            </td>
        </tr>
        <tr>
            <td>A002</td>
            <td>Budi Santoso</td>
            <td>Batu</td>
            <td>0813xxxx</td>
            <td>
                <button type="button">Edit</button>
                <button type="button">Delete</button>
            </td>
        </tr>
    </tbody>
</table>
```

## 5.2 What's the Same as `books/list.html`?

The structure is **identical** to the book list: `<table>` → `<thead>`
(column heading row) → `<tbody>` (data rows) → each `<tr>` row contains
`<td>` cells, and the last "Action" column contains two `type="button"`
buttons (Edit & Delete) that are also **not functional yet**. If this
part isn't clear yet, first read the detailed explanation in
[books/list.html documentation §3.2](03-books-list-html.md#32-anatomy-of-an-html-table).

## 5.3 What's Different?

The only difference is the **column names** and **the data**, since the
entity being displayed is different (members, not books):

| Book Column | Member Column |
|---|---|
| Title | Member No. |
| Author | Name |
| Year | Address |
| Stock | Phone No. |
| Action | Action |

The displayed data (2 rows, fewer than the book list's 5 rows):

| Member No. | Name | Address | Phone No. |
|---|---|---|---|
| A001 | Siti Aminah | Malang | 0812xxxx |
| A002 | Budi Santoso | Batu | 0813xxxx |

The phone numbers are intentionally written as `0812xxxx`/`0813xxxx` (not
full real numbers) because this is only **sample data** for practice, not
real personal data — a good practice when creating sample/dummy data.

## 5.4 Note: Navigation Menu

```html
<nav>
    <ul>
        <li><a href="../index.html">Home</a></li>
        <li><a href="../books/list.html">Book List</a></li>
        <li><a href="list.html">Member List</a></li>
        <li><a href="add.html">Add Member</a></li>
    </ul>
</nav>
```

Notice that this file has 4 navigation links, including **"Add Member"**
pointing to `add.html` — different from the menu in `index.html` and
`books/*.html`, which don't include that link. This is part of the
independent exercise: make sure the menu on every page **consistently**
shows all 5 pages in this jobsheet (Home, Book List, Add Book, Member
List, Add Member) — as practice, try checking and completing the menu
yourself in `index.html`, `books/list.html`, and `books/add.html` so that
both the "Member List" **and** "Add Member" links appear on every page.

Next: [Explanation of `members/add.html`](06-members-add-html.md)
