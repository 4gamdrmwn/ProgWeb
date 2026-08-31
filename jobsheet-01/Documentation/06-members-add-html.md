# 6. Explanation of `members/add.html` (Add Member Form)

Just like `members/list.html`, this file is also part of the
**independent exercise**: its pattern is made similar to
[`books/add.html`](04-books-add-html.md), but for member data.

## 6.1 Full Code

```html
<form>
    <p>
        <label for="nama">Name</label><br>
        <input type="text" id="nama" name="nama" required>
    </p>
    <p>
        <label for="no_anggota">Member No.</label><br>
        <input type="text" id="no_anggota" name="no_anggota" required>
    </p>
    <p>
        <label for="alamat">Address</label><br>
        <input type="text" id="alamat" name="alamat">
    </p>
    <p>
        <label for="no_hp">Phone No.</label><br>
        <input type="text" id="no_hp" name="no_hp">
    </p>
    <p>
        <button type="submit">Save</button>
    </p>
</form>
```

## 6.2 What's the Same as `books/add.html`?

The basic pattern is identical to the add-book form: each field is
wrapped in `<p>`, contains a `<label for="...">` + `<input id="..."
name="...">` pair, and ends with a
`<button type="submit">Save</button>`. If you don't yet understand how
the label-input pair works or why the button is `type="submit"`, first
read
[books/add.html documentation §4.3–4.5](04-books-add-html.md#43-the-pattern-for-each-form-field-label--input).

## 6.3 What's Different?

The requested fields are fewer and simpler than the book form — **all**
fields here are `type="text"` (no `type="number"` or `<select>`, since
member data in this jobsheet doesn't need numbers or category choices):

| Field | Input Code | Required? |
|---|---|---|
| Name | `<input type="text" id="nama" name="nama" required>` | Yes (`required`) |
| Member No. | `<input type="text" id="no_anggota" name="no_anggota" required>` | Yes (`required`) |
| Address | `<input type="text" id="alamat" name="alamat">` | No |
| Phone No. | `<input type="text" id="no_hp" name="no_hp">` | No |

Notice the `id`/`name` attributes use an **underscore**
(`no_anggota`, `no_hp`) because the field name consists of multiple
words. This is a common naming convention in HTML/programming so that
variable names don't contain spaces (a space in `name` can cause problems
when the data is sent/processed).

## 6.4 Why Is "Member No." Text, Not a Number?

Worth noting: the **"Member No."** field uses `type="text"`, not
`type="number"`, even though its name contains the word "number". This is
because this application's member number format is a combination of
letters + digits, e.g. `A001`, `A002` (see the data in
[members/list.html](05-members-list-html.md#53-whats-different)) — and
`type="number"` only accepts pure digits, so it can't hold the letter
`A`. This is a real-world example of why it's important to choose an
input's `type` based on the **actual shape of the data**, not just its
name.

## 6.5 Reflective Exercise

As an independent exercise, try comparing this form with the book form
yourself and answer the following questions to test your understanding:

1. Why aren't the "Address" and "Phone No." fields given `required`,
   while "Name" and "Member No." are?
2. What will happen (in the browser) if you click "Save" without filling
   in the "Name" field? Try opening the file in a browser and test it.
3. This form also **doesn't have an `action`** on its `<form>` tag yet —
   what effect does that have when the "Save" button is pressed?

Next: [Summary & Further Exercises](07-summary-exercises.md)
