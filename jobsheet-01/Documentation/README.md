# Jobsheet 1 Documentation — SIMPUS-Mini

This documentation was written specifically for students who are new to
HTML/CSS. Every code file in jobsheet-01 is explained line by line: which
tag is used, why it is used, and what it is good for in the real world.

## Table of Contents

1. [Basic Concepts Used in This Jobsheet](01-basic-concepts.md)
2. [Explanation of `index.html` (Home Page)](02-index-html.md)
3. [Explanation of `books/list.html` (Book List)](03-books-list-html.md)
4. [Explanation of `books/add.html` (Add Book Form)](04-books-add-html.md)
5. [Explanation of `members/list.html` (Member List)](05-members-list-html.md)
6. [Explanation of `members/add.html` (Add Member Form)](06-members-add-html.md)
7. [Summary & Further Exercises](07-summary-exercises.md)

## About This Program

Jobsheet 1 builds the initial skeleton of the **SIMPUS-Mini** application,
a mini library system that can manage **book** and **member** data.
At this stage the application **cannot yet save real data** — all the data
in the tables is still dummy (sample) data written manually in HTML, and
the forms are not processed anywhere yet. The focus of this jobsheet is
purely on:

- Web page structure using **HTML5 semantics** (`header`, `nav`, `main`,
  `section`, `article`, `footer`), instead of plain `div`s everywhere.
- Naming the `id` and `name` attributes on forms, which will be reused
  later when learning CSS (jobsheet 2) and JavaScript/backend (the
  following jobsheet).

## Folder Structure

```
jobsheet-01/
├── index.html            # Home page
├── books/
│   ├── list.html          # Book list table (static)
│   └── add.html           # Add book form (not yet processed)
├── members/
│   ├── list.html          # Member list table (static)
│   └── add.html           # Add member form (not yet processed)
├── README.md              # Short jobsheet summary (from the lecturer)
└── Documentation/         # This documentation folder
```

Please read in order starting from number 1 so the concepts connect, or
jump straight to the file you want to understand.
