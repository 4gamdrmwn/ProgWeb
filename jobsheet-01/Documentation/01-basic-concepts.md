# 1. Basic Concepts Used in This Jobsheet

Before diving into the explanation of each file, first get familiar with
the terms that will keep appearing in every HTML file in this jobsheet.

## 1.1 What is a "tag" and an "element"?

HTML is written using **tags**, which usually come in pairs: an opening
tag `<tagname>` and a closing tag `</tagname>`. The content between the
two is called an **element**.

```html
<h1>SIMPUS-Mini</h1>
```

`<h1>` is the opening tag, `</h1>` is the closing tag, and the whole
snippet above is an `h1` element (level 1 heading).

## 1.2 The Required Structure of Every HTML Page

Every file in this jobsheet starts with the same pattern:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SIMPUS-Mini | Home</title>
</head>
<body>
    ...
</body>
</html>
```

| Part | Function |
|---|---|
| `<!DOCTYPE html>` | Tells the browser that this document is HTML5. Must be on the very first line. |
| `<html lang="en">` | The element that wraps the whole page. `lang="en"` tells the browser (and screen readers) that the page content is in English. |
| `<head>` | Contains information *about* the page that is **not displayed** on screen: the tab title, character encoding, CSS links, etc. |
| `<meta charset="UTF-8">` | Sets the character encoding to UTF-8, so characters like `é`, `&mdash;`, or non-Latin letters display correctly instead of turning into odd symbols. |
| `<title>` | The text shown on the **browser tab**. Notice each page has a different title (`SIMPUS-Mini \| Home`, `SIMPUS-Mini \| Book List`, etc.) so the user knows which page they are on. |
| `<body>` | Contains all the content that is **displayed** on screen: text, images, tables, forms, etc. |

## 1.3 HTML5 Semantic Tags

"Semantic" means the tag name explains the **meaning/role** of its
content, instead of being just an empty box like `<div>`. Here is what is
used in this jobsheet:

- **`<header>`** — the page's header section, usually containing the site
  title and navigation. It appears on **every** page in this jobsheet with
  similar content (the `SIMPUS-Mini` title + the `nav` menu).
- **`<nav>`** — a group of navigation links (menu). Regular `<ul>`/`<li>`/`<a>`
  is used inside it, but wrapping it in `<nav>` lets the browser/screen
  reader know this is a "menu", not just a regular list.
- **`<main>`** — the page's **main** content. There may only be **one**
  `<main>` per page.
- **`<section>`** — groups content that shares a common theme, usually
  started with a heading (`<h2>`, etc.).
- **`<article>`** — a piece of content that stands on its own/can be
  separated from its surrounding context. In `index.html`, each statistic
  card (Total Books, Total Members, Currently Borrowed) is wrapped in
  `<article>` because each is a standalone piece of information.
- **`<footer>`** — the page's footer section, usually containing
  copyright/additional info. The same on every page:
  `© 2026 SIMPUS-Mini — Jobsheet 1`.

Why not just use `<div>` for everything? Because `<div>` carries no
meaning at all — browsers, search engines, and assistive tools (screen
readers) have no way of knowing whether a `<div>` is a menu, main content,
or a footer. With semantic tags, the code is easier to read **and** more
accessibility- and SEO-friendly.

## 1.4 Why Is There No CSS Yet?

As noted in this jobsheet's [README.md](../README.md), this stage
**intentionally has no CSS/JavaScript yet**. The goal is for you to focus
first on the page structure (skeleton). Because there's no CSS yet, the
page will look plain in the browser (default font, no colors/neat layout)
— that's **normal**, not a mistake. Styling will be covered in the next
jobsheet.

## 1.5 Navigation Between Pages (`<a href="...">`)

Notice that the `<nav>` menu in each file uses different relative paths
depending on the file's own location, for example:

- From `index.html` (in the root folder) to the book list:
  `href="books/list.html"` (going down into the `books` folder).
- From `books/list.html` back to home: `href="../index.html"`
  (`../` means going up one folder).
- From `books/list.html` to `books/add.html`: just `href="add.html"`
  since both are in the same folder.

This is important to understand because relative path mistakes are one of
the most common causes of "broken" links when learning HTML.

Next: [Explanation of `index.html`](02-index-html.md)
