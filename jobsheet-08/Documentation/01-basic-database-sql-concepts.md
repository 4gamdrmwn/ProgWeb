# 1. Basic Database & SQL Concepts

This is your first introduction to a real database. First get familiar
with the basic terms before reading the PHP code that connects to it.

## 1.1 Why Do We Need a Database? (Recalling the Problem)

SIMPUS-Mini's data storage journey so far:

| Jobsheet | Data Storage Method | The Problem |
|---|---|---|
| 01-05 | Written manually in HTML | Cannot be added to via a form at all |
| 06 | `data/*.json` file | Can be **read**, but cannot be **added to** via a form (recall [jobsheet-06 documentation](../../jobsheet-06/Documentation/README.md)) |
| 07 | `$_SESSION` | Can be added to **and** read, but **lost** when the browser session ends (recall [jobsheet-07 documentation §3.5](../../jobsheet-07/Documentation/03-session-and-data-flow.md#35-why-is-this-data-temporary)) |
| **08** | **PostgreSQL Database** | **Can be added to, read, and stored permanently** |

A database solves this last problem: data is stored in a **dedicated
program** (called a *Database Management System*/DBMS — PostgreSQL is
one example) that runs **continuously** on a computer/server, separate
from your PHP application itself. If you close the browser, or even
shut down the PHP server, PostgreSQL **keeps running** and its data
stays safely stored, ready to be read again whenever your PHP
application reconnects.

## 1.2 Relational Databases: Tables, Rows, Columns

PostgreSQL is a **relational database** — data is stored in the form of
**tables**, a concept similar to the HTML tables you're already very
familiar with since
[jobsheet-01 documentation](../../jobsheet-01/Documentation/03-books-list-html.md#32-anatomy-of-an-html-table):

| Database Term | Equivalent HTML Table Term |
|---|---|
| **Table** | `<table>` — e.g. the `books` table |
| **Column** | `<th>` — e.g. the `title`, `author`, `year` columns |
| **Row** | `<tr>` — one row = one book |

The difference: a database table is **actually stored** on disk (not
just a display), and has **strict rules** about what kind of data is
allowed into each column (discussed in
[chapter 2](02-database-sql-schema.md)) — something a regular HTML
table doesn't have.

## 1.3 What is SQL?

**SQL** (*Structured Query Language*) is a special language for
"talking" to relational databases — creating tables, storing data,
retrieving data, etc. Unlike PHP/JavaScript, which write **step-by-step
instructions** (create a variable, then do this, then do that), SQL is
more about **declaring what you want**, and the database itself figures
out the most efficient way to get it. Four basic SQL commands you'll
encounter:

| Command | Function | Discussed In |
|---|---|---|
| `CREATE TABLE` | Creates a new table along with its column structure | [chapter 2](02-database-sql-schema.md) |
| `INSERT` | Adds one new row of data | [chapter 5](05-insert-prepared-statement.md) |
| `SELECT` | Retrieves/reads data | [chapter 6](06-reading-data-select.md) |
| `UPDATE`/`DELETE` | Modifies/deletes data | Not yet used in this jobsheet — coming in Jobsheet 9 |

## 1.4 What is PDO?

PHP itself doesn't **automatically** know how to communicate with
PostgreSQL — a "bridge" is needed. **PDO** (*PHP Data Objects*) is a
built-in PHP layer that provides a **uniform way** to connect to
various types of databases (PostgreSQL, MySQL, SQLite, etc.) using
similar PHP code, differing only slightly in the initial connection
part. The details of how it's used in this jobsheet are discussed in
[chapter 4](04-pdo-connection.md).

## 1.5 Why Is There a "Preparation" Step Before Running This Jobsheet?

Unlike jobsheet-01 through jobsheet-07, which could be tried right
away (at most needing `php -S localhost:8000` or Laragon), this
jobsheet requires **real PostgreSQL installed and running** on your
computer, plus a new database that **must be created and have its
schema loaded** first before the PHP application can connect to
anything. These preparation steps are covered fully in
[chapter 3](03-database-preparation.md) — don't skip that chapter
before trying to run this jobsheet yourself.

Continue to: [Database Schema: `01_books_members.sql`](02-database-sql-schema.md)
