# 7. Summary & Further Exercises

## 7.1 Overall Jobsheet 7 Summary

| Section | Concepts Learned |
|---|---|
| [Basic PHP Concepts](01-basic-php-concepts.md) | Server-side vs client-side, the `<?php ?>` tag, `$` variables, `echo`, superglobals, `??` |
| [Header/Footer Includes](02-includes-header-footer.md) | `include`, `__DIR__`, automatic relative paths (`$base`), alternative syntax `if/foreach: endif/endforeach` |
| [Session & Data Flow](03-session-and-data-flow.md) | `session_start()`, `$_SESSION` as a data "basket" across pages, form → process → table flow |
| [Processing Add & Server Validation](04-process-add-server-validation.md) | `$_POST`, `is_numeric`, `header('Location: ...')` + `exit`, `(int)` type casting |
| [List.php & Flash Message](05-list-php-render-and-flash.md) | `unset()` for a single-use message, PHP `foreach`, rendering on the server vs in the browser |
| [CSS Flash Message](06-css-flash-message.md) | Success/failure color convention |

## 7.2 Core Concepts to Remember

1. **Server-side runs before the page reaches the browser** — PHP code
   is never seen by the user, only its result
   ([chapter 1 §1.1](01-basic-php-concepts.md#11-server-side-vs-client-side-whats-the-difference)).
2. **`include` removes code duplication** across pages — change
   `header.php` once, every page that includes it changes too
   ([chapter 2](02-includes-header-footer.md)).
3. **`$_SESSION` bridges data across separate HTTP requests** — but is
   temporary, lost when the browser session ends
   ([chapter 3](03-session-and-data-flow.md)).
4. **Server-side validation cannot be bypassed by the user**, unlike
   HTML/JavaScript validation which both run in the browser and can be
   disabled
   ([chapter 4 §4.6](04-process-add-server-validation.md#46-why-is-this-validation-the-one-that-can-truly-be-relied-on)).
5. **Redirect after POST (`header('Location: ...')` + `exit`)** is a
   common pattern to prevent data from being resubmitted if the user
   refreshes the result page, and to route directly to the relevant
   page (the form if there's an error, the list if successful)
   ([chapter 4 §4.4-4.5](04-process-add-server-validation.md#44-if-there-are-errors-save-the-flash--redirect-back)).
6. **A flash message is a "show once" pattern** — stored then
   immediately removed (`unset`) after being read, so it doesn't
   reappear on the next visit
   ([chapter 5 §5.2](05-list-php-render-and-flash.md#52-retrieving-and-deleting-the-flash-message)).

## 7.3 How to Try It Yourself

1. **Run the server** (recall
   [chapter 1 §1.7](01-basic-php-concepts.md#17-running-php-needs-a-real-server)
   and [chapter 2 §2.3](02-includes-header-footer.md#23-automatic-relative-paths-in-includesheaderphp) —
   the paths are already automatically relative, so it doesn't have to
   be from a specific folder):
   ```bash
   php -S localhost:8000
   ```
   Open `http://localhost:8000/index.php` (or via Laragon, see
   [README.md](../README.md) for the vhost option).
2. Click "Add Book", fill in the form with valid data, click "Save" —
   notice you're redirected to `list.php` with a green message "Book
   added successfully." above the table, and your new book appears in
   the last row.
3. Refresh the `list.php` page — notice that green message **no longer
   appears** (proof that `unset()` from
   [chapter 5 §5.2](05-list-php-render-and-flash.md#52-retrieving-and-deleting-the-flash-message)
   works), but the book data **is still there** (because
   `$_SESSION['books']` isn't removed, only `$_SESSION['flash']` is).
4. Try submitting an empty form — notice a **red** message appears on
   `add.php`, and no new data is saved.
5. Practice the test from this jobsheet's [README.md](../README.md):
   disable JavaScript in your browser settings, submit an empty form
   again — prove server validation still works even with JavaScript
   completely off (recall
   [chapter 4 §4.6](04-process-add-server-validation.md#46-why-is-this-validation-the-one-that-can-truly-be-relied-on)).
6. Close the browser completely (not just the tab), reopen it — notice
   the book data you added earlier **is gone** (proof of `$_SESSION`'s
   temporary nature from
   [chapter 3 §3.5](03-session-and-data-flow.md#35-why-is-this-data-temporary)).

## 7.4 Additional Exercise Ideas (Optional)

1. **Add ISBN validation** in `books/process_add.php` — for example,
   ensure the ISBN entered (if not empty) only contains digits and
   hyphens, using the PHP function `preg_match()`.
2. **Add a flash message in `members/process_add.php`** for cases not
   yet handled — compare with the `books/process_add.php` version,
   which is already validated more thoroughly (year range, non-negative
   stock) — what other fields in the member form might need additional
   validation rules?
3. **Create a temporary `debug_session.php` page** (for practice, delete
   it when done) that displays the raw contents of `$_SESSION` via
   `<pre><?php print_r($_SESSION); ?></pre>` — a useful way to "peek"
   directly at what's actually stored on the server while learning.
4. **Add a "Reset Data" button** that calls `session_destroy()` to
   clear the entire `$_SESSION` manually, without needing to close the
   browser — look up how this function works yourself via the official
   PHP documentation.

If any part is still confusing, try re-reading
[chapter 3](03-session-and-data-flow.md) while practicing steps 2-3 in
[§7.3](#73-how-to-try-it-yourself) — seeing data "persist" across pages
and then "vanish" after closing the browser yourself is the most
effective way to truly understand what a session is.
