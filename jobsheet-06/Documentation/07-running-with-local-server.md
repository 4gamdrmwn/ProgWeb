# 7. Running with a Local Server (CORS)

This is the **most important part to know before trying** this jobsheet
yourself — different from every previous jobsheet, which could be
opened directly by double-clicking the HTML file.

## 7.1 Warning from the README

> **Important:** `fetch()` to a local file will be blocked by CORS
> policy if opened directly with `file://`. Run it through a local
> server...

If you open `books/list.html` directly the same way you did for
jobsheet-01 through jobsheet-05 (double-clicking in File Explorer), the
table will **never fill in** — it will get stuck showing "Loading
data..." forever, or immediately show a "Failed to load data" error
message. This is **not a bug** in the code, but a browser security
restriction called **CORS**.

## 7.2 What is CORS?

**CORS** (*Cross-Origin Resource Sharing*) is a browser security policy
that restricts `fetch()` requests (and similar AJAX techniques) between
different **origins**. When you open an HTML file directly from File
Explorer, its address in the browser will look something like:

```
file:///D:/1.MateriKuliah/PemogramanWeb-2026/kode-praktikum/jobsheet-06/books/list.html
```

This **`file://`** protocol is treated **very strictly** by browsers —
many modern browsers (especially Chrome) **completely disallow**
`fetch()` from fetching other files over this protocol, as part of
their security policy, even though technically the requested file
(`data/books.json`) sits right in an adjacent folder on the same
computer. This differs from `<link>` or `<script src="...">` tags you've
already used since jobsheet-02 and jobsheet-05 — those tags **are not**
subject to as strict a CORS restriction as `fetch()`.

## 7.3 Solution: Run Through a Local Server

The solution is to open this page not through `file://`, but through
**`http://`** — by running a simple **local server** on your own
computer. The README suggests 2 approaches:

**Approach 1 — Via PHP (if PHP is already installed on your computer):**
```bash
php -S localhost:8000
```
Run this command in the `jobsheet-06/` folder via a terminal, then open
`http://localhost:8000/index.html` in a browser.

**Approach 2 — The "Live Server" extension in VS Code:**
If you use the VS Code editor, install an extension called **Live
Server**, then right-click the `index.html` file → "Open with Live
Server". This will automatically run a local server and open a browser
for you, without needing to type any commands in a terminal.

**Approach 3 — Laragon (Apache):** if you use Laragon, just put the
project folder inside `C:\laragon\www\`, start Apache via the Laragon
menu, then open `http://<domain-name>.test/.../jobsheet-06/index.html`
in a browser (the domain name is automatically created by Laragon from
your project folder's name). All `fetch()` paths in this jobsheet use
regular relative paths (`../data/books.json`, etc.), so they remain
correctly accessible from any folder depth.

All three approaches share the same goal: making the page accessible
via an `http://...` address (not `file://...`), so `fetch()` is
allowed to retrieve the JSON file in the same folder.

## 7.4 Why Does This Only Show Up Now, Not in Previous Jobsheets?

Jobsheet-01 through jobsheet-05 could all be opened directly with
`file://` because **none of them** used `fetch()` to retrieve other
files — CSS (`<link>`) and JavaScript (`<script src>`) are not subject
to as strict a CORS restriction. Only in jobsheet-06, with the
introduction of `fetch()` to retrieve `data/books.json` and
`data/members.json`, does this CORS restriction first become
"noticeable" — and it's deliberately introduced together with `fetch()`
in this jobsheet because the two are **always linked** in real web
development practice.

## 7.5 How to Test Error Handling

Per the note in this jobsheet's [README.md](../README.md):

> Test error handling by temporarily renaming the file in `fetch(...)`
> to an incorrect name.

Try this as an exercise: open `assets/js/books.js`, change the line
`fetch("../data/books.json")` to, for example,
`fetch("../data/bookss.json")` (deliberately misspelled), save, then
open the `books/list.html` page through the local server. You'll see an
error message "Failed to load data: Failed to fetch data (status 404)"
appear inside the table — this directly proves that the `try`/`catch`
block already discussed in
[chapter 4 §4.7](04-js-fetch-render-books.md#47-catching-and-displaying-the-error)
really works, not just in theory. After you're done trying it, remember
to change the filename back to the original `books.json`.

Continue to: [Summary & Further Exercises](08-summary-and-exercises.md)
