# 6. Summary & Exercises

## 6.1 Overall Summary of Jobsheet 4

| Section | Concepts Learned |
|---|---|
| [Basic UI/UX Concepts](01-basic-uiux-design-concepts.md) | Difference between UI and UX, why design before coding |
| [How to Read Wireframes](02-how-to-read-wireframe.md) | ASCII wireframe conventions, translating wireframe symbols to HTML elements |
| [User Flow](03-user-flow-borrowing-returning.md) | Step-by-step flow diagrams, capturing business rules at design time |
| [Actors & Authorization](04-actors-and-authorization.md) | User types (Guest vs Officer), intro to authorization concept |
| [Code Connection](05-code-connection.md) | How new design reuses existing CSS/patterns, edge cases noted at design stage |

## 6.2 Core Concepts to Remember

1. **Not every jobsheet adds code.** Designing before coding is a legitimate and important part of software development, not a step to skip
([chapter 1](01-basic-uiux-design-concepts.md)).

2. **Wireframe answers "what's on this page", user flow answers "how does the user get here"** — both complement each other, neither replaces the other
([chapter 2](02-how-to-read-wireframe.md),
[chapter 3](03-user-flow-borrowing-returning.md)).

3. **Defining actors early** helps determine which pages need authorization protection, long before the actual login code is written
([chapter 4](04-actors-and-authorization.md)).

4. **Good design reuses what already exists** (CSS, component patterns) instead of building from scratch — seen in how new wireframes adopt the navbar, stat cards, and form styles already built in jobsheets 2-3
([chapter 5](05-code-connection.md)).

5. **Recording edge cases at design time** (books out of stock, members with late fees) prevents them from being forgotten during coding
([chapter 5 §5.5](05-code-connection.md#55-edge-cases-already-noted-at-design-time)).

## 6.3 How to Experience This Jobsheet

Since there's no new code to run in a browser, the best way to practice is by **reading wireframes and imagining yourself as an Officer**:

1. Open [`docs/wireframe.md`](../docs/wireframe.md) and read each wireframe while imagining what it would look like if drawn in real style following the `style.css` that already exists.
2. Follow the Borrowing user flow ([chapter 3 §3.2](03-user-flow-borrowing-returning.md#32-user-flow-borrow-book))
step-by-step, imagining which page opens at each box.
3. Compare the navbar and stat cards on [`index.html`](../index.html) (already working now) with the Officer Dashboard wireframe — spot which parts are identical and which are new additions.

## 6.4 Optional Extra Exercises

1. **Draw your own wireframe** using the same ASCII conventions ([chapter 2 §2.2](02-how-to-read-wireframe.md#22-rules-for-reading-the-symbols)) —
for example, a "New Member Registration" page where a Guest can become a Member.

2. **Create your own user flow** for a scenario not yet documented in `wireframe.md`, such as "Officer searches for a member with overdue fees."

3. **Identify additional edge cases** that might need to be handled, beyond the two already noted — for example: what happens if an Officer tries to borrow a book for a member who has already borrowed the same book?

4. **Try implementing the Login wireframe as static HTML** (without real login logic, like how Add Book form works in jobsheets 1-3) as practice in translating wireframe to code —
use the `<label>` + `<input>` pattern you mastered from
[jobsheet-01 documentation](../../jobsheet-01/Documentation/04-books-add-html.md),
plus a new `<input type="password">` for the password field.

If any part still feels unclear, re-read [chapter 1](01-basic-uiux-design-concepts.md) — the "why design first" concept is the foundation that explains the reasoning behind this entire jobsheet.
