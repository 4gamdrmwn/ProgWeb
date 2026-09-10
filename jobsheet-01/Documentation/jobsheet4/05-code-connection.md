# 5. Code Connection: How Design Relates to Existing Code

This chapter connects the wireframes in `docs/wireframe.md` to the HTML/CSS code that's **already working** from jobsheets 1-3 —
so you see that this design isn't a separate project, but a **direct continuation** of what you've built.

## 5.1 Official Note from `wireframe.md`

The [`wireframe.md`](../docs/wireframe.md) document ends with a section "Consistency with Design Already Running":

> - Colors, typography navbar, and table/card styles follow `assets/css/style.css` already built in Jobsheet 2-3.
> - Navbar will add a **Borrowing** menu and login status indicator (officer name / Logout button) starting implementation in Jobsheet 10.
> - Edge cases to handle during implementation: books with zero stock cannot be selected in borrowing forms; members with late fees are validated in Jobsheet 12 (independent assignment).

Let's break down each point.

## 5.2 Colors & Styles Stay the Same — No Need to Rebuild CSS from Scratch

Remember from [jobsheet-02 documentation](../../jobsheet-02/Documentation/README.md),
you've already built:

- Blue accent color `#1d5b8a` for header, section titles, and submit buttons (see
[jobsheet-02 documentation §3.2](../../jobsheet-02/Documentation/03-css-reset-and-body.md#32-default-body-style)).
- White card style with subtle shadow for `<section>` (see
[jobsheet-02 documentation §5.3](../../jobsheet-02/Documentation/05-css-main-and-section.md#53-white-card-for-each-section)).
- Table style with colored header and alternating row colors (see
[jobsheet-02 documentation §7](../../jobsheet-02/Documentation/07-css-table.md)).
- Form style with bold labels and neat inputs (see
[jobsheet-02 documentation §8](../../jobsheet-02/Documentation/08-css-form.md)).

All new wireframe pages (Login, Dashboard, Borrowing/Return forms) are **intentionally designed following the same pattern** —
meaning when these pages are actually coded later, you **won't need to write new CSS from scratch**. The Login form, for example, will use the exact same `<label>` + `<input>` pattern as the existing Add Book form from
[jobsheet-01 documentation](../../jobsheet-01/Documentation/04-books-add-html.md),
so it automatically gets the neat styling from `form label` and `form input` rules in `style.css` without new CSS.

## 5.3 Navbar Will Grow — But Flexbox Handles It Automatically

Remember from [jobsheet-02 documentation](../../jobsheet-02/Documentation/04-css-header-navbar-flexbox.md)
and [jobsheet-03 documentation](../../jobsheet-03/Documentation/03-css-hamburger-checkbox-hack.md),
the navbar is built with Flexbox (`header nav ul { display: flex; ... }`) that automatically arranges **any number** of menu items
horizontally (or vertically on mobile via checkbox hack). This means adding a new "Borrowing" menu item later in Jobsheet 10
**requires no CSS changes whatsoever** — just add one new `<li><a>` in HTML, and Flexbox auto-arranges everything. This is a real example of how good system CSS design from the start (remember notes about generic selectors in
[jobsheet-02 documentation §6.7](../../jobsheet-02/Documentation/06-css-grid-stat-cards.md#67-why-not-just-use-class))
pays off later.

Similarly, the login status indicator (`(Officer Name) Logout`) that will appear in the navbar will be another element in `<header>`,
likely arranged side-by-side with `<h1>` and `<nav>` using the same `justify-content: space-between` that currently
positions `<h1>` and `<nav>` (see
[jobsheet-02 documentation §4.4](../../jobsheet-02/Documentation/04-css-header-navbar-flexbox.md#44-positioning-flex-items)).

## 5.4 Same Stat Cards, Different Context

The Officer Dashboard wireframe shows `[Total Books] [Total Members] [Currently Borrowed]` stat cards — compare this with the
**already working** stat cards on [`index.html`](../index.html) right now (explained in detail in
[jobsheet-01 documentation](../../jobsheet-01/Documentation/02-index-html.md#main--main-content)
and CSS Grid styling in
[jobsheet-02 documentation](../../jobsheet-02/Documentation/06-css-grid-stat-cards.md)).
This is no coincidence — the Dashboard wireframe **reuses** the exact same stat card component, just in a different page (Officer-only Dashboard instead of public Home). This is a real example of component reuse: build something good once, then use it in multiple places.

## 5.5 Edge Cases Already Noted at Design Time

Two "edge cases" (special exceptions) are already written down in `wireframe.md`:

1. **Books with zero stock cannot be selected** in the Borrowing form — this rule already appears in the user flow
([chapter 3 §3.2](03-user-flow-borrowing-returning.md#32-user-flow-borrow-book),
the note `(stock > 0)`). The stock data **already exists** since jobsheet-01:
look at the "Stock" column in the
[Book List table](../../jobsheet-01/Documentation/03-books-list-html.md#33-data-displayed-dummy) —
later we just need to add a check: "if stock > 0, show in the borrowing dropdown; else hide."

2. **Members with overdue fees** — this case is marked for "Jobsheet 12 (independent assignment)", showing that not everything needs to be solved **at once**;
writing it at design time ensures this case doesn't get forgotten even though implementation is delayed.

Next: [Summary & Exercises](06-summary-and-exercises.md)
