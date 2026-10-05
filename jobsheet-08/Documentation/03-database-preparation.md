# 3. Database Preparation Before Running

This chapter breaks down **step by step** the preparation written in
this jobsheet's [README.md](../README.md) — **mandatory** before trying
to run the application, unlike previous jobsheets which could be tried
immediately.

## 3.1 Step 1: Make Sure PostgreSQL & the PHP Extension Are Ready

> Make sure PostgreSQL is running and the PHP extension `pdo_pgsql` is
> active (`php -m | grep pgsql`; if not present, enable
> `extension=pdo_pgsql` in `php.ini` then restart the server).

- **PostgreSQL must be installed and running** on your computer (recall
  from [chapter 1 §1.1](01-basic-database-sql-concepts.md#11-why-do-we-need-a-database-recalling-the-problem):
  it's a separate program that runs on its own, not part of PHP). If
  you use **Windows with Laragon** and have never installed PostgreSQL
  at all, follow the step-by-step guide in
  [chapter 8 (Appendix)](08-postgresql-installation-laragon.md) first
  before continuing this chapter.
- **`php -m`** displays the list of all **extensions** (add-on modules)
  active in your PHP installation. `pdo_pgsql` is the **specific**
  extension that lets PDO (recall from
  [chapter 1 §1.4](01-basic-database-sql-concepts.md#14-what-is-pdo)) talk
  to PostgreSQL — without this extension active, the line
  `new PDO("pgsql:...")` in [chapter 4](04-pdo-connection.md) will fail
  entirely.
- **`php.ini`** is PHP's main configuration file. If the `pdo_pgsql`
  extension isn't active yet, you need to open this file, find the line
  `;extension=pdo_pgsql` (the leading semicolon means "disabled/
  commented out"), remove that semicolon, save the file, then
  **restart** the PHP server so the configuration change is re-read.

## 3.2 Step 2: Creating the Database

```bash
createdb simpus_mini
```

**`createdb`** is a built-in PostgreSQL command-line tool for creating a
new **database** named `simpus_mini` — an empty container where all
tables (and their data) will be stored. Compare this with the `db`
term in
[`includes/connection.php`](04-pdo-connection.md#42-five-configuration-variables) —
this `simpus_mini` name must **exactly match** what's written there.

## 3.3 Step 3: Running the Schema

```bash
psql -d simpus_mini -f sql/01_books_members.sql
```

**`psql`** is the command-line program for **interacting** with
PostgreSQL. This command means: "connect to the `simpus_mini` database
(`-d simpus_mini`), then run all the SQL commands in the file
`sql/01_books_members.sql` (`-f ...`)." After this command succeeds,
the `books` and `members` tables already discussed in
[chapter 2](02-database-sql-schema.md) will truly **exist** inside the
`simpus_mini` database, ready to receive data.

## 3.4 Step 4: Adjusting Credentials

> Adjust the credentials in `includes/connection.php` (`$user`, `$pass`)
> to match your local environment.

**Credentials** are identity/authorization information — here, the
username (`$user`) and password (`$pass`) used to log into PostgreSQL
on your computer. Different PostgreSQL installations have different
default credentials (depending on the installation method) — if the
default values `"postgres"`/`"postgres"` already written in
`connection.php` (discussed in [chapter 4](04-pdo-connection.md)) don't
match your PostgreSQL installation, you need to manually replace them
with the correct credentials on your own computer.

## 3.5 This Order Matters — Don't Reverse It

Notice the 4 steps above **depend on each other**: you can't run the
schema ([§3.3](#33-step-3-running-the-schema)) before the database is
created ([§3.2](#32-step-2-creating-the-database)), and the PHP
application won't be able to connect at all
([chapter 4](04-pdo-connection.md)) if the `pdo_pgsql` extension isn't
active ([§3.1](#31-step-1-make-sure-postgresql--the-php-extension-are-ready))
or the credentials are wrong
([§3.4](#34-step-4-adjusting-credentials)). If any step is skipped, the
symptom usually appears as a **"Database connection failed: ..."**
message — how to read this error message is discussed in
[chapter 4 §4.4](04-pdo-connection.md#44-handling-connection-failure).

Continue to: [PHP Connection to the Database: `connection.php`](04-pdo-connection.md)
