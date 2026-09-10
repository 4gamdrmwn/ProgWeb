# 3. User Flow: Borrowing & Returning

If a wireframe ([chapter 2](02-how-to-read-wireframe.md)) shows **one page**, a **user flow** shows the **sequence of steps** a user takes across multiple pages/actions to complete one task.

## 3.1 What is User Flow?

**User flow** (user journey) is a simple diagram of boxes connected by arrows `->`, showing the **step-by-step sequence**. Each box represents one screen, one action, or one decision the user makes. Its purpose: ensure **nothing is missed or ambiguous** before the feature is actually coded.

## 3.2 User Flow: Borrow Book

```
[Officer Sign In] -> [Dashboard] -> [Select "New Borrowing" menu]
        -> [Select Member] -> [Select Book (stock > 0)]
        -> [Save] -> [Book stock decreases by 1] -> [Back to Dashboard]
```

Let's trace through each box:

1. **`[Officer Sign In]`** — Officer must sign in first (the wireframe for this page is shown in
[chapter 2 §2.1](02-how-to-read-wireframe.md#21-example-login-page-wireframe)).
This box emphasizes that borrowing **cannot be accessed by guests** — discussed more in
[chapter 4](04-actors-and-authorization.md).

2. **`[Dashboard]`** — after successful sign-in, Officer lands on Dashboard (wireframe in
[chapter 2 §2.3](02-how-to-read-wireframe.md#23-more-complex-wireframe-officer-dashboard)).

3. **`[Select "New Borrowing" menu]`** — Officer clicks one of the Quick Action buttons on Dashboard.

4. **`[Select Member]`** and **`[Select Book (stock > 0)]`** — two sequential form-filling steps. Notice the important note `(stock > 0)` — this is a **business rule** that's written in the user flow: books with 0 stock **cannot appear** as an option. Writing this rule at the design stage ensures developers don't forget to implement it when coding (remember why designing first matters, from
[chapter 1 §1.2](01-basic-uiux-design-concepts.md#12-why-design-first-code-later)).

5. **`[Save]`** — Officer presses the submit button (like `<button type="submit">` from
[jobsheet-01 documentation](../../jobsheet-01/Documentation/04-books-add-html.md#45-submit-button),
except this form will **actually process** to the database — different from Add Books/Members forms in jobsheets 1-3 which weren't set up to really process).

6. **`[Book stock decreases by 1]`** — this is an **automatic side effect** behind the scenes: once borrowing is saved, the system must automatically reduce that book's stock count. This box is **not** a page,
but a reminder that **program logic** needs to be written behind the Save button (will be implemented with JavaScript/backend in future jobsheets — see
[README.md](../README.md) of this jobsheet).

7. **`[Back to Dashboard]`** — the flow closes by returning to the starting point, showing the cycle is complete and Officer can repeat for the next borrowing.

## 3.3 User Flow: Return Book

```
[Dashboard] -> [Select "Return" menu] -> [Search active transaction (member/book)]
        -> [Mark "Returned"] -> [Book stock increases by 1]
        -> [Back to Dashboard]
```

This flow has a similar shape, but notice the key difference:

- Starts by **searching for an active transaction** (an outstanding borrow, not filling a new form from scratch) — makes sense because returning a book means **matching** it with existing borrow data, not creating new data.
- The side effect is **reversed**: stock **increases** by 1, not decreases.

Comparing two similar-structured user flows like this is a good way to check **consistency** of your design — if two flows are wildly different in structure without good reason, that's a sign something might need rethinking.

## 3.4 Why Write User Flow Before the Form Exists?

Same reason as [chapter 1 §1.2](01-basic-uiux-design-concepts.md#12-why-design-first-code-later):
writing this sequence **before** any line of Borrowing form code exists ensures important questions are answered up front, such as:

- Can a member borrow **more than one book** in a single transaction? (The wireform in `docs/wireframe.md` shows one book per transaction — this design decision is made at this stage.)
- Who is allowed to access this feature? (Answered in [chapter 4](04-actors-and-authorization.md).)
- What's the most natural sequence from an Officer's real-world perspective?

Next: [Actors & Authorization](04-actors-and-authorization.md)
