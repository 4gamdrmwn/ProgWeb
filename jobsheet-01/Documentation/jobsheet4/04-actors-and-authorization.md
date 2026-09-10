# 4. Actors & Authorization

## 4.1 What is an "Actor" in UI/UX Design?

An **actor** is the term for a **type of user** who interacts with the system, distinguished by **what they're allowed to do**.
`docs/wireframe.md` defines 2 actors for SIMPUS-Mini:

> - **Guest**: can only view the book catalog (Home, Book List) without signing in.
> - **Officer**: signs in to access all CRUD features and borrowing transactions.

Defining actors early matters because **the exact same page** can mean different things depending on who opens it —
and that determines what features need to be built for each.

## 4.2 "Guest" Actor — What You Can Already Try Now

All pages that **already exist** from jobsheet-01 through jobsheet-03 —
[Home](../index.html), [Book List](../books/list.html), and so on —
actually **represent the Guest actor perspective**: anyone can open them directly without signing in. Try it out:
these pages have no "logout" or username display anywhere — consistent with the Guest actor definition
"can only view the catalog... without signing in."

## 4.3 "Officer" Actor — What's New in This Jobsheet

All new wireframes in `docs/wireframe.md` (Login, Dashboard, Borrowing/Return forms, History) are designed from the
**Officer** actor's perspective — and **all of them** require signing in first. This is clear from the user flows already discussed in
[chapter 3](03-user-flow-borrowing-returning.md): both Borrowing and Return flows **always start** with an Officer already in the system (`[Officer Sign In]` or directly `[Dashboard]`, which only exists after login).

## 4.4 What is Authorization, and Why Isn't It in This Jobsheet Yet?

**Authorization** (*authorization*) is the system mechanism that **restricts** who can do/see what — for example,
ensuring only signed-in Officers can access the Borrowing page, while Guests trying to access it get redirected to Login.

Notice that authorization needs **real program code** to work (checking login status, storing user sessions, etc.) —
something that can't be done with static HTML/CSS like what you learned in
[jobsheets 1-3](../../jobsheet-01/Documentation/README.md).
That's why Login and Borrowing features **aren't implemented** in this jobsheet — per the note in
[README.md](../README.md), they'll be built starting in future jobsheets with JavaScript, then PHP/PostgreSQL for real server-side data management.

## 4.5 Why Design Actors First?

By defining these 2 actors **before** writing Login code, developers already have clear answers to questions that will arise during coding:

- Which pages need login checks, and which stay public? (Answer: officer pages need checks, guest pages stay public — clear from actor definitions.)
- What happens if a Guest tries accessing the Dashboard URL directly without signing in? (This "edge case" needs thinking through at design time, though the technical solution comes later.)

Next: [Code Connection: How Design Relates to Existing Code](05-code-connection.md)
