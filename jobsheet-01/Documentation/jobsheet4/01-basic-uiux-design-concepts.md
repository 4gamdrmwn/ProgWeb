# 1. Basic Concepts of UI/UX Design

## 1.1 What's the Difference Between UI and UX?

These two terms are often mentioned together, but they mean different things:

| Term | Full Form | Focus |
|---|---|---|
| **UI** | *User Interface* (User Interface) | **Appearance** — colors, buttons, layout, typography. This is what you've built since jobsheet-02 through `style.css` ([see its documentation](../../jobsheet-02/Documentation/README.md)). |
| **UX** | *User Experience* (User Experience) | **Flow & feeling** — is it easy for the user to complete their task, do the steps make sense, is it confusing? |

Simple analogy: if an application were a store, **UI** is how the shelves and displays are arranged so they look nice; **UX** is whether a customer can easily find what they're looking for and reach the checkout without getting lost. A store can look beautiful (good UI) but be confusing to shop in (bad UX), or vice versa.

## 1.2 Why Design First, Code Later?

Imagine jumping straight to writing HTML for a "Book Borrowing" page without planning first — you'd have to decide all at once: what fields do we need, what's the order of steps, what happens if a book is out of stock, what page appears after saving, etc. — all while writing HTML tags. Very easy to forget an important condition (like "a book with 0 stock can't be borrowed") when designing and coding **simultaneously**.

By creating a design first on paper/text (like `docs/wireframe.md`), developers can:

1. Think through the **entire flow** before getting locked into technical code details.
2. Find gaps/questions (e.g., "what if a member still owes late fees?") **before** coding — when it's still cheap to change — changing one line of text design costs way less than rewriting code that's already built.
3. Have a clear "map" to follow when starting to code for real.

That's why jobsheet-04 **intentionally adds no code** — all this jobsheet's energy goes into designing first, as per this jobsheet's Sub-CPMK: *"Design the UI/UX of the application (project)."*

## 1.3 Two Design Tools: Wireframe & User Flow

`docs/wireframe.md` contains two types of design documents that complement each other:

- **Wireframe** — a rough sketch of the layout of *one page*, without color/font details, just showing what elements exist and where. Discussed in detail in [chapter 2](02-how-to-read-wireframe.md).
- **User flow** — a diagram showing the **sequence of page transitions** that a user goes through to complete one task (e.g., borrowing a book). Discussed in detail in [chapter 3](03-user-flow-borrowing-returning.md).

If a wireframe answers "what's on this page?", a user flow answers "what pages does the user visit to accomplish this task?" — both are needed to understand the design completely.

Next: [How to Read Wireframes](02-how-to-read-wireframe.md)
