# 8. Installing PostgreSQL on Laragon (Windows Users Only)

This chapter is a **practical appendix** for Windows users who use
**Laragon** as their local development environment. Unlike
[chapter 3](03-database-preparation.md), which explains the **concept**
behind each database preparation step, this chapter is purely
**click-by-click steps** for users who are truly new and have never
installed PostgreSQL before.

## 8.1 What is Laragon?

**Laragon** is an "instant package" application for Windows that
provides a local web development environment — bundling Apache/Nginx,
PHP, MySQL/MariaDB, and other tools in one application, without needing
to install each one separately. Something worth knowing from the start:
**PostgreSQL isn't always installed automatically** when you first
install Laragon — it needs to be **added** via a feature called
**Quick Add**, explained starting in
[§8.3](#83-adding-postgresql-via-quick-add).

## 8.2 Making Sure Laragon Is Already Installed

If you've already been able to run `php -S localhost:8000` since
jobsheet-07, that means Laragon (or a similar tool) is already
installed — jump straight to
[§8.3](#83-adding-postgresql-via-quick-add). If not at all, here are
the Laragon installation steps:

1. Open a browser, visit **laragon.org**, click the **Download**
   button.
2. Choose **Laragon Full** (recommended for beginners — it comes with
   more built-in components) or **Laragon Lite** (lighter, additional
   components downloaded later via Quick Add). For this guide, **either
   works** since PostgreSQL is still installed via Quick Add in both
   variants.
3. Run the downloaded installer file (`laragon-wamp.exe` or similar).
   Follow the installation wizard: click **Next** repeatedly, leave the
   default installation location (`C:\laragon`), then click
   **Finish**.
4. Laragon will open automatically once installation finishes — its
   interface is a window with a list of services (Apache, MySQL, etc.)
   on the left, and several buttons (**Start All**, **Stop All**,
   **Menu**, etc.) on the right.

## 8.3 Adding PostgreSQL via Quick Add

**Quick Add** is a built-in Laragon feature for adding new components
(databases, programming languages, editors, etc.) with just a few
clicks, without needing to manually download and configure from other
websites.

1. Open the Laragon application (if not already open).
2. Right-click an **empty area** of the Laragon main window (or
   right-click the Laragon icon in the *system tray* — the small icon
   area near the clock, in the bottom-right corner of the screen).
3. From the menu that appears, go to **Tools → Quick Add**.
4. A list of addable components will appear, one of which is
   **PostgreSQL** with several version options (e.g. `postgresql-15`,
   `postgresql-16`, etc). Choose the **latest** version available in
   that list, unless you have a specific reason to choose a particular
   version.
5. Click that option — Laragon will **automatically download and
   install** that version of PostgreSQL into the Laragon folder
   (usually `C:\laragon\bin\postgresql\` for the program, and
   `C:\laragon\data\postgresql-XX\` for its database data). This
   process needs an internet connection and takes a few minutes
   depending on download speed.
6. Once finished, **restart Laragon** — click the **Stop All** button
   (if any service is running), then close and reopen the Laragon
   application, or click **Start All** again. This is important so
   Laragon "recognizes" the PostgreSQL that was just added.

**Technical prerequisite:** make sure your (64-bit) Windows already has
the **Visual C++ Redistributable** (2015-2019 version) installed —
most modern Windows computers already have this built in. If the
PostgreSQL installation process fails strangely, this is a likely
cause, and it can be downloaded for free from Microsoft's official
site.

## 8.4 Starting the PostgreSQL Service

After restarting, reopen the Laragon main window:

1. Look at the **service list** on the left side of the window — there
   should now be a **PostgreSQL** entry there, with a colored dot
   indicator (red = inactive, green = active/running).
2. If the indicator is **red**, click the **Start All** button on the
   right side of the window (turns on all services at once), or
   right-click specifically on the **PostgreSQL** row and choose
   **Start**.
3. Wait a few seconds, the indicator will turn **green** — a sign that
   PostgreSQL is running and ready to accept connections.

Recall from [jobsheet-08 documentation §4.2](04-pdo-connection.md#42-five-configuration-variables):
PostgreSQL by default "listens" on **port `5432`** — this value already
matches `$port = "5432";` in `includes/connection.php`, so you **don't
need to change anything** related to the port. This port also won't
conflict with Laragon's MySQL/MariaDB, which uses port `3306` — both
can be active at the same time.

## 8.5 Opening the Laragon Terminal

Some of the following steps require typing commands — Laragon has a
**built-in Terminal** that already automatically "knows" the location
of the `psql`, `php`, and all other installed components' programs,
without you needing to manually set the Windows *PATH*.

1. In the Laragon main window, click **Menu → Laragon → Terminal** (or
   press the key combination **Ctrl + `** — the backtick key, usually
   at the top-left of the keyboard near the number 1 — while the
   Laragon window is active).
2. A terminal window (similar to Command Prompt, but more advanced)
   will open/appear at the bottom of the Laragon window.
3. All the commands in the rest of this chapter (`psql`, `createdb`)
   are typed in this terminal.

## 8.6 Activating the PHP `pdo_pgsql` Extension

Recall from [chapter 3 §3.1](03-database-preparation.md#31-step-1-make-sure-postgresql--the-php-extension-are-ready):
PHP needs the `pdo_pgsql` extension active so it can "talk" to
PostgreSQL via PDO. How to activate it specifically in Laragon:

**Easiest way (via menu):**
1. Right-click the Laragon window → **Menu → PHP → Extensions**.
2. Look for **`pdo_pgsql`** in the list (and preferably also
   **`pgsql`**), click to activate it. If that extension has never
   been downloaded before, Laragon will download it automatically.
3. **Restart** Apache/the server (click **Stop All** then **Start
   All**) so PHP re-reads its extension configuration.

**Manual way (edit `php.ini` directly):**
1. Right-click the Laragon window → **Menu → PHP → php.ini** — this
   will open PHP's configuration file in a text editor.
2. Find the lines `;extension=pdo_pgsql` and `;extension=pgsql` (the
   leading semicolon `;` means "disabled").
3. Remove the semicolon on **both** lines, save the file.
4. Restart Apache/the server as above.

**Verifying the extension is active** — open the Laragon Terminal
([§8.5](#85-opening-the-laragon-terminal)), type:
```bash
php -m | findstr pgsql
```
(`findstr` is a built-in Windows "text search" tool, equivalent to
`grep` on Linux/Mac which you may see in other references.) If the
lines `pdo_pgsql` and `pgsql` appear, the extensions are active and
ready to be used by `includes/connection.php`.

## 8.7 Logging Into PostgreSQL & Matching the Password with `connection.php`

Recall from [jobsheet-08 documentation §4.2](04-pdo-connection.md#42-five-configuration-variables),
this jobsheet's `includes/connection.php` uses the default credentials
**`$user = "postgres";`** and **`$pass = "postgres";`**. A PostgreSQL
installation via Laragon Quick Add **doesn't always** use the exact
same default credentials (depending on the version) — so the safest
step is to **log in once**, then **set the password yourself** to
match the code already written.

In the Laragon Terminal, type:
```bash
psql -U postgres
```

There are 2 possible outcomes:

**Outcome 1 — you're logged in directly without being asked for a
password at all** (the `postgres=#` prompt appears immediately). If
this happens, proceed to the **setting the password** step below.

**Outcome 2 — you're asked to type `Password for user postgres:`.**
Try one of the following (type it, then press Enter):
- Leave it blank (just press Enter without typing anything).
- Type `postgres`.
- Type `root`.

If any of these succeed (the `postgres=#` prompt appears), proceed to
the next step. **If all of them fail**
(`password authentication failed`), and port `5432` has already been
confirmed **not** used by another installation
([§8.9](#89-if-the-laragon-postgresql-service-fails-to-start-port-5432-conflict)),
follow
[§8.10](#810-shortcut-if-you-forget-dont-know-the-postgres-password)
to forcibly reset the password.

**After successfully logging in** (seeing the `postgres=#` prompt),
type exactly:
```sql
ALTER USER postgres WITH PASSWORD 'postgres';
```
Press Enter — `ALTER ROLE` will appear, a sign of success. This **sets**
the `postgres` account's password to `postgres`, exactly matching what's
already written in `includes/connection.php`
([jobsheet-08 documentation §4.2](04-pdo-connection.md#42-five-configuration-variables)) —
so you **don't need to edit any PHP code** after this. Type `\q` then
Enter to exit `psql`.

## 8.8 Creating the Database & Running the Schema

Once PostgreSQL is running and the password matches, follow
[chapter 3 §3.2-3.3](03-database-preparation.md#32-step-2-creating-the-database)
as usual, from the Laragon Terminal:

```bash
createdb -U postgres simpus_mini
```

(Notice the addition of `-U postgres` compared to the example in
[chapter 3](03-database-preparation.md) — this specifies **which
user** is used to create the database, useful if your Laragon has more
than one PostgreSQL account.)

Then navigate to the jobsheet-08 folder with the `cd` command, for
example:
```bash
cd D:\1.MateriKuliah\PemogramanWeb-2026\kode-praktikum\jobsheet-08
psql -U postgres -d simpus_mini -f sql/01_books_members.sql
```

If successful, two `CREATE TABLE` lines will appear — exactly as
discussed in
[chapter 3 §3.3](03-database-preparation.md#33-step-3-running-the-schema).

## 8.9 If the Laragon PostgreSQL Service Fails to Start (Port 5432 Conflict)

Sometimes an error dialog **"waiting for server to start...."** appears
when clicking **Start All**/**Start** in Laragon, even though the steps
above were followed exactly. This **doesn't mean** something is wrong
with your PostgreSQL installation — the most common cause is **another
program already using port `5432`**, so Laragon's built-in PostgreSQL
doesn't get a port to "listen" for connections (recall from
[§8.4](#84-starting-the-postgresql-service), PostgreSQL always uses
this port by default). The most frequent cause: the same computer also
had PostgreSQL installed **separately** at some point (e.g. via the
official installer from postgresql.org, not via Laragon) that
automatically starts as a *Windows Service* every time the computer
boots up — both compete for port `5432`, and whichever starts **first**
wins.

**How to confirm this is the cause** — open **Command Prompt** or
**PowerShell** (doesn't have to be the Laragon Terminal for this step),
type:
```powershell
netstat -ano | findstr ":5432"
```
If a `LISTENING` line appears with a PID (*Process ID*) number at the
far right, find out what process that is:
```powershell
Get-Process -Id <PID_that_appears>
```
If the result is `postgres` but you're **sure** you haven't run your
Laragon PostgreSQL that day, it's likely another PostgreSQL
installation running automatically as a *service*.

**How to fix it** — choose one:

1. **Stop the other PostgreSQL service** (if it's indeed not used for
   another project). Open PowerShell **as Administrator** (right-click
   the PowerShell icon → "Run as administrator" — mandatory, otherwise
   you'll get an "Access is denied" error), then:
   ```powershell
   Get-Service | Where-Object { $_.DisplayName -match "PostgreSQL" }
   ```
   This displays **all** PostgreSQL services installed on the computer
   (usually more than one if there's indeed a conflict). Find the
   service name that is **not** Laragon's (usually named something
   like `postgresql-x64-<version>`), then:
   ```powershell
   Stop-Service -Name "<service-name>" -Force
   Set-Service -Name "<service-name>" -StartupType Manual
   ```
   `StartupType Manual` prevents that service from automatically
   starting again every time the computer restarts (if left
   `Automatic`, port `5432` will be taken over again on the next
   restart) — the service itself is **not deleted**, just not
   automatically run again.
2. **Or, leave that other service running**, and move Laragon's
   PostgreSQL to a different port (e.g. `5433`) via `postgresql.conf`
   in its data folder (`C:\laragon\data\postgresql-XX\`), then adjust
   `$port` in `includes/connection.php` to match. This option is more
   complex and **only recommended** if that other service is indeed
   still needed for something else.

After completing one of the steps above, click **Stop** then **Start
All** again in Laragon — the PostgreSQL indicator should turn green
without an error dialog.

## 8.10 Shortcut If You Forget/Don't Know the `postgres` Password

If in [§8.7](#87-logging-into-postgresql--matching-the-password-with-connectionphp)
every password possibility fails, you can **force** PostgreSQL to
accept connections without a password **temporarily**, change the
password, then restore the original setting.

1. Open the PostgreSQL data folder, e.g.
   `C:\laragon\data\postgresql-16\` (adjust the version number to what
   you installed). Find a file named **`pg_hba.conf`**, open it with
   Notepad.
2. Find the line containing `127.0.0.1/32` (usually ending with the
   word `scram-sha-256` or `md5`), for example:
   ```
   host    all             all             127.0.0.1/32            scram-sha-256
   ```
3. Change the last word on that line (`scram-sha-256`/`md5`) to
   **`trust`**, save the file.
4. Go back to Laragon, **restart** the PostgreSQL service (right-click
   PostgreSQL in the service list → **Stop**, then **Start** again).
5. In the Laragon Terminal, type `psql -U postgres` — this time you
   should be **logged in directly** without being asked for a password
   at all (because `trust` means "trust anyone connecting from this
   computer").
6. Run `ALTER USER postgres WITH PASSWORD 'postgres';` as in
   [§8.7](#87-logging-into-postgresql--matching-the-password-with-connectionphp),
   then `\q`.
7. **Restore** the line in `pg_hba.conf` you changed earlier, change
   `trust` back to its original value (`scram-sha-256`/`md5`), save.
8. Restart the PostgreSQL service again via Laragon.

Now the `postgres` password is guaranteed to be `postgres`, and the
connection still requires a password (not left as `trust` forever) —
steps 7-8 are **important** not to skip, so PostgreSQL doesn't accept
just any connection.

## 8.11 Summary Checklist

Before running `php -S localhost:8000` (or via Laragon) in the
jobsheet-08 folder, make sure all of these are "checked":

- [ ] Laragon is installed and open.
- [ ] PostgreSQL has been added via Quick Add ([§8.3](#83-adding-postgresql-via-quick-add)).
- [ ] The PostgreSQL indicator in Laragon's service list is **green**,
      with no "waiting for server to start...." error dialog
      ([§8.4](#84-starting-the-postgresql-service); if that error
      appears, it's likely a port conflict — see
      [§8.9](#89-if-the-laragon-postgresql-service-fails-to-start-port-5432-conflict)).
- [ ] `php -m | findstr pgsql` shows `pdo_pgsql` and `pgsql`
      ([§8.6](#86-activating-the-php-pdo_pgsql-extension)).
- [ ] `psql -U postgres` can log in, and the password has been set to
      `postgres`
      ([§8.7](#87-logging-into-postgresql--matching-the-password-with-connectionphp)).
- [ ] The `simpus_mini` database has been created and the
      `01_books_members.sql` schema has been run
      ([§8.8](#88-creating-the-database--running-the-schema)).

Once everything is checked, continue to
[jobsheet-08 documentation §4](04-pdo-connection.md) to understand how
`includes/connection.php` actually uses everything you just prepared.
