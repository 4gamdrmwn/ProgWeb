# Jobsheet 7 — Basic PHP & Form Handling

Sub-CPMK: Implement PHP basics & form processing.

## Changes from Jobsheet 6
- All `.html` pages converted to `.php`.
- Introduced `includes/header.php` & `includes/footer.php` to avoid duplicating the navbar/footer on every page (used via `include`).
- CSS/JS/menu paths use **relative** paths (`assets/css/style.css`, `index.php`, etc., without a leading `/`), computed automatically in `includes/header.php` based on the depth of the folder the current page is in (`$base` = `""` at the root, `"../"` for a page one level deep like `books/`, `members/`). So this project still runs correctly whether accessed from the server root (`php -S`) **or** through a subfolder (e.g. Laragon with the document root at a parent folder).
- `books/add.php` & `members/add.php`: forms now use `method="post"` pointing to their respective `process_add.php`.
- `books/process_add.php` & `members/process_add.php`: validate `$_POST` on the server (this validation is **separate** from the JS validation in Jobsheet 5 — it works on its own even if JS is disabled), then save temporarily to `$_SESSION['books']` / `$_SESSION['members']` (array), redirect to `list.php`.
- `books/list.php` & `members/list.php`: table rendered from `$_SESSION` via `foreach` (replacing the fetch/JSON approach in Jobsheet 6 — main rendering is now on the server).
- Success/failure flash messages are shown via `$_SESSION['flash']`.
- The `assets/js/books.js`, `assets/js/members.js` files and the `data/` folder from Jobsheet 6 are **removed** because rendering has moved to server-side PHP.

## How to run
**Option 1 — PHP built-in server**, run from inside the `jobsheet-07/` folder:
```bash
php -S localhost:8000
```
Open `http://localhost:8000/index.php`.

**Option 2 — Laragon (Apache)**: either via a virtual host whose document root points directly at the `jobsheet-07/` folder (e.g. `http://jobsheet07.test/`), or accessed nested under the project domain (e.g. `http://dp2026.test/kode-praktikum/jobsheet-07/`) — both work because the CSS/JS/link paths are already automatically relative (see the note above).

## Notes
- Data stored in `$_SESSION` will be lost when the browser session ends — this is a temporary bridge. Starting in Jobsheet 8, storage moves to PostgreSQL for persistence.
- Try disabling JavaScript in the browser and submitting an empty form: server validation still prevents invalid data from being saved.
