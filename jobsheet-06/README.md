# Jobsheet 6 — Fetch API & JSON

Sub-CPMK: Apply asynchronous communication (AJAX/fetch, JSON).

## Changes from Jobsheet 5
- Add `data/books.json` (10 objects) and `data/members.json` (4 objects) as a temporary substitute for a real API.
- `books/list.html` & `members/list.html`: `<tbody>` is emptied, rows are now rendered dynamically by `assets/js/books.js` / `assets/js/members.js` using `fetch` + `async/await`.
- Loading indicator (`#loading-indicator`) shown during the fetch process (simulated with a 600ms delay).
- Error handling (`try/catch`) shows a message inside the table if the fetch fails.
- `app.js`: `initDeleteConfirm` changed to use **event delegation** (`document.addEventListener("click", ...)`) because the Delete button now lives in rows created after the page has finished loading.

## How to run
**Important:** `fetch()` to a local file will be blocked by CORS policy if opened directly with `file://`. Run it through a local server, for example:
```bash
php -S localhost:8000
```
then open `http://localhost:8000/index.html`. You can also use the "Live Server" extension in VSCode.

## Notes
- Test error handling by temporarily renaming the file in `fetch(...)` to an incorrect name.
- The `fetch` + `async/await` pattern here will be reused to call a real PHP endpoint starting in Jobsheet 9 (once the PostgreSQL back-end is ready in Jobsheet 8), even though starting in Jobsheet 7 the main rendering moves to server-side PHP.
