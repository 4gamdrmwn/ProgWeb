# 2. Explanation of `index.html` (Home Page)

This file is the **first page** opened when the application runs (because
its name is `index.html`, the standard name that browsers/servers
automatically look for as a folder's main page).

## 2.1 Full Code

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SIMPUS-Mini | Home</title>
</head>
<body>
    <header>
        <h1>SIMPUS-Mini</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="books/list.html">Book List</a></li>
                <li><a href="books/add.html">Add Book</a></li>
                <li><a href="members/list.html">Member List</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Welcome to the Mini Library System</h2>
            <p>A simple application to manage library book and member data.</p>
        </section>

        <section>
            <h2>Summary</h2>
            <article>
                <h3>Total Books</h3>
                <p>12</p>
            </article>
            <article>
                <h3>Total Members</h3>
                <p>8</p>
            </article>
            <article>
                <h3>Currently Borrowed</h3>
                <p>3</p>
            </article>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 SIMPUS-Mini &mdash; Jobsheet 1</p>
    </footer>
</body>
</html>
```

## 2.2 Section-by-Section Explanation

### `<header>` — Page Header

```html
<header>
    <h1>SIMPUS-Mini</h1>
    <nav>...</nav>
</header>
```

- `<h1>SIMPUS-Mini</h1>` is the application's main title. Every HTML page
  should have only **one** `<h1>` — this is the highest heading level.
- Inside `<header>` there's a `<nav>` containing a menu with links to 4
  pages: Home, Book List, Add Book, and Member List. Notice there is no
  "Add Member" link in this menu — that's expected, because the
  independent exercise (see
  [members/add.html documentation](06-members-add-html.md)) asks you to
  practice making this menu consistent yourself.

### `<nav>` — Navigation Menu

```html
<nav>
    <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="books/list.html">Book List</a></li>
        <li><a href="books/add.html">Add Book</a></li>
        <li><a href="members/list.html">Member List</a></li>
    </ul>
</nav>
```

- `<ul>` (unordered list) wraps the menu list.
- Each `<li>` (list item) is one menu item, containing one `<a>` link.
- `href` on each `<a>` determines the destination page. Since `index.html`
  is located in jobsheet-01's **root** folder, paths to the `books/` and
  `members/` folders are written directly without `../` (see
  [basic concepts §1.5](01-basic-concepts.md#15-navigation-between-pages-a-href)).

### `<main>` — Main Content

Contains two `<section>`s:

**Section 1 — Welcome**
```html
<section>
    <h2>Welcome to the Mini Library System</h2>
    <p>A simple application to manage library book and member data.</p>
</section>
```
Just a welcome text: one `<h2>` (sub-section heading, one level below
`<h1>`) and one `<p>` paragraph.

**Section 2 — Statistics Summary**
```html
<section>
    <h2>Summary</h2>
    <article>
        <h3>Total Books</h3>
        <p>12</p>
    </article>
    <article>
        <h3>Total Members</h3>
        <p>8</p>
    </article>
    <article>
        <h3>Currently Borrowed</h3>
        <p>3</p>
    </article>
</section>
```
- Each `<article>` here represents one standalone statistics "card": a
  small heading (`<h3>`, one level below `<h2>`) + a number (`<p>`).
- The numbers `12`, `8`, `3` here are **just sample (dummy) data**, typed
  manually. There is no logic yet that calculates them from real data —
  that will be learned once you get into server-side/JavaScript
  programming.
- Why choose `<article>` instead of `<div>`? Because each card can "stand
  on its own" in meaning — even if moved to another page, its information
  is still complete and makes sense (e.g. "Total Books: 12").

### `<footer>` — Page Footer

```html
<footer>
    <p>&copy; 2026 SIMPUS-Mini &mdash; Jobsheet 1</p>
</footer>
```

- `&copy;` is an **HTML entity** (a special character code) for the `©`
  symbol.
- `&mdash;` is the entity for the long dash `—` (em dash). Entities are
  used because some symbol characters aren't always safe to type directly
  in HTML, so they're written in this code form instead.

## 2.3 Conclusion

`index.html` shows the basic pattern that is **repeated** across every
other page in this jobsheet: `header` (title + nav) → `main` (page-specific
content) → `footer` (copyright). Once you understand this file, the other
4 HTML files will be easier to follow since their skeleton is the same —
only the content of `<main>` differs.

Next: [Explanation of `books/list.html`](03-books-list-html.md)
