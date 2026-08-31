# 7. Summary & Further Exercises

## 7.1 Overall Jobsheet 1 Summary

| File | Function | New Elements Learned |
|---|---|---|
| [`index.html`](02-index-html.md) | Home + statistics summary | `header`, `nav`, `main`, `section`, `article`, `footer` |
| [`books/list.html`](03-books-list-html.md) | Book list table | `table`, `thead`, `tbody`, `tr`, `th`, `td`, `button type="button"` |
| [`books/add.html`](04-books-add-html.md) | Add book form | `form`, `label`, `input` (`text`/`number`), `select`/`option`, `button type="submit"`, `required`/`min`/`max` attributes |
| [`members/list.html`](05-members-list-html.md) | Member list table (independent exercise) | Re-applying the table pattern to different data |
| [`members/add.html`](06-members-add-html.md) | Add member form (independent exercise) | Re-applying the form pattern to different data |

Overall, jobsheet 1 teaches **3 HTML patterns** that will keep being used
throughout the whole application:

1. **Page skeleton** (`header` + `nav` + `main` + `footer`) — the same on
   all 5 pages.
2. **Data table** (`table`/`thead`/`tbody`/`tr`/`th`/`td`) — used on both
   "list" pages.
3. **Input form** (`form`/`label`/`input`/`select`/`button`) — used on
   both "add" pages.

## 7.2 Things to Remember: This Is Just the Skeleton

A few things that are **intentionally missing** from this jobsheet (not
bugs, just not the right time to learn them yet):

- **No CSS** → the display is still plain, without colors/neat layout.
- **No JavaScript** → the Edit/Delete buttons in the tables don't work
  yet.
- **Forms aren't connected to anything** (`<form>` with no `action`) →
  the "Save" button doesn't actually save data yet.
- **Table data is static (dummy) data**, typed manually in HTML, not
  fetched from a database.

All of this will start being covered in the next jobsheet.

## 7.3 How to Try It Yourself

1. Open the `index.html` file directly in a browser (double-click, or
   right-click → *Open with* → choose a browser). No server needed yet.
2. Click the navigation menu in the header to move between pages, and
   notice how the `href` on each `<a>` determines the destination page.
3. Try filling out the form in `books/add.html` or `members/add.html`,
   then click "Save" — observe that nothing happens besides a page reload
   (since there's no `action` yet).
4. Try leaving one of the fields with a `required` attribute empty, then
   click "Save" — notice the browser shows its built-in HTML5 validation
   warning automatically.

## 7.4 Additional Exercise Ideas (Optional)

To deepen your understanding, try doing these yourself (not mandatory,
but highly recommended for practice):

1. **Complete menu consistency** — add "Member List" and "Add Member"
   links to the `<nav>` menu in `index.html`, `books/list.html`, and
   `books/add.html` (see the note in
   [members/list.html documentation §5.4](05-members-list-html.md#54-note-navigation-menu)).
2. **Add 2 new book data rows** in `books/list.html` by copying one
   `<tr>...</tr>` block and changing its content.
3. **Add a new column** to the members table, e.g. "Join Date", complete
   with its `<th>` and `<td>` in every row.
4. **Add a new field** to the add-member form, e.g. "Email" using
   `<input type="email">` (`type="email"` automatically validates the
   email address format without needing extra JavaScript).

Happy learning — if any part is still confusing, try re-reading the
[basic concepts in file 1](01-basic-concepts.md), since nearly every
technical term in the other files is explained there.
