# Jobsheet 8 — PostgreSQL Connection

Sub-CPMK: Connect the application to a PostgreSQL database.

## Changes from Jobsheet 7
- Add `sql/01_books_members.sql` — DDL for the `books` and `members` tables (basic ERD).
- Add `includes/connection.php` — a `PDO` connection using the `pgsql` driver.
- `books/process_add.php` & `members/process_add.php`: `$_SESSION['books'][] = ...` (Jobsheet 7) replaced with `INSERT ... RETURNING id` via a prepared statement.
- `books/list.php` & `members/list.php`: data source changed from `$_SESSION` to `SELECT * FROM ... ORDER BY id DESC`.
- `index.php`: the Total Books/Members stat cards now use `SELECT COUNT(*)` from the database (no longer dummy/session data).

## Database setup
1. Make sure PostgreSQL is running and the PHP extension `pdo_pgsql` is active (`php -m | grep pgsql`; if not present, enable `extension=pdo_pgsql` in `php.ini` then restart the server).
2. Create the database:
   ```bash
   createdb simpus_mini
   ```
3. Run the schema:
   ```bash
   psql -d simpus_mini -f sql/01_books_members.sql
   ```
4. Adjust the credentials in `includes/connection.php` (`$user`, `$pass`) to match your local environment.

## How to run
**Option 1 — PHP built-in server**:
```bash
php -S localhost:8000
```
Open `http://localhost:8000/index.php`.

**Option 2 — Laragon (Apache)**: either via a virtual host pointing directly at the `jobsheet-08/` folder (e.g. `http://jobsheet08.test/`), or nested under the project domain (e.g. `http://dp2026.test/kode-praktikum/jobsheet-08/`) — the CSS/JS/link paths are already automatically relative (see `includes/header.php`), so both work.

## Notes
- Data entered is now **persistent** — try closing and reopening the browser, the data remains (unlike Jobsheet 7, which lost it when the session ended).
- Queries use prepared statements (`:parameter_name`) — not string concatenation — as a security foundation that is deepened in Jobsheet 11.
- The `id` column is already fetched via `SELECT *` even though it's not yet used in the view — it will be used for Edit/Delete links starting in Jobsheet 9.
