# 6. CSS: Statistic Cards with CSS Grid

This section introduces **CSS Grid**, another layout system (besides
Flexbox) used specifically to arrange the 3 statistic cards on the Home
page (Total Books, Total Members, Currently Borrowed) into 3 aligned
columns.

## 6.1 Recalling the HTML

From the
[jobsheet-01 HTML documentation](../../jobsheet-01/Documentation/02-index-html.md#22-section-by-section-explanation),
`index.html` has a `<main>` structure containing **2 `<section>`
elements**:

```html
<main>
    <section>                          <!-- section 1: welcome -->
        <h2>Welcome to...</h2>
        <p>...</p>
    </section>

    <section>                          <!-- section 2: statistics summary -->
        <h2>Summary</h2>
        <article>...Total Books...</article>
        <article>...Total Members...</article>
        <article>...Currently Borrowed...</article>
    </section>
</main>
```

It's this **second** section that contains the 3 statistic card
`<article>`s, and this is the target of the CSS Grid.

## 6.2 The CSS Code

```css
/* ===== Statistic Cards (CSS Grid) ===== */
main section:nth-of-type(2) {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
}

main section:nth-of-type(2) article {
    background-color: #eef4fa;
    border-radius: 8px;
    padding: 1.25rem;
    text-align: center;
}

main section:nth-of-type(2) article h3 {
    font-size: 0.95rem;
    color: #55677a;
    margin-bottom: 0.5rem;
}

main section:nth-of-type(2) article p {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1d5b8a;
}
```

## 6.3 The `:nth-of-type(2)` Selector — Selecting "Only the Second Section"

```css
main section:nth-of-type(2) { ... }
```

- Notice that `index.html`'s HTML has **2 `<section>` elements** of the
  same tag type, with no `class` or `id` distinguishing them at all.
- `:nth-of-type(2)` is a pseudo-class that selects an element based on
  its **order of appearance** among siblings with the **same tag**. So
  `section:nth-of-type(2)` means "the section that comes **2nd** among
  all `<section>` elements of that kind".
- Combined with `main` in front of it (a descendant selector), then
  `main section:nth-of-type(2)` means "the second section that is inside
  `<main>`" — i.e. the "Summary" section (not the "Welcome" section,
  which comes first).

This is what's meant by the note in this jobsheet's
[README.md](../README.md): *"The statistic cards on the Home page use
`main section:nth-of-type(2)` as a 3-column grid"* — and the reason this
approach was chosen (over adding a special `class` in the HTML) is
explained in [§6.7](#67-why-not-just-use-a-class).

## 6.4 Activating Grid: `display: grid`

```css
display: grid;
grid-template-columns: repeat(3, 1fr);
gap: 1rem;
```

- `display: grid;` — turns this section into a **grid container**. All
  of its direct children (here: 3 `<article>` elements) automatically
  become **grid items** arranged according to the defined
  columns/rows.
- `grid-template-columns: repeat(3, 1fr);` — defines **3 columns**, each
  `1fr` wide. `repeat(3, 1fr)` is shorthand for writing `1fr 1fr 1fr`
  three times. Recall the `fr` unit from
  [basic concepts §1.6](01-basic-css-concepts.md#16-units-of-measurement-used):
  since all three columns are equally `1fr`, the available space is
  **divided equally** among those 3 columns.
- `gap: 1rem;` — uniform spacing between columns (and between rows if
  there is more than one row), the same as the `gap` function in the
  navbar Flexbox ([chapter 4](04-css-header-navbar-flexbox.md#46-nested-flexbox-navbar-inside-header)).

## 6.5 Flexbox vs Grid — What's the Difference?

A reasonable question for beginners: why does the navbar use Flexbox but
the statistic cards use Grid, when both are "arranging elements side by
side"?

| | Flexbox | CSS Grid |
|---|---|---|
| Dimension | 1-dimensional (row **or** column) | 2-dimensional (row **and** column at once) |
| Good for | Arranging a **flexible/non-fixed** number of items in a single row/column (like a navbar menu whose item count can vary) | Arranging a **grid/box layout** with column sizes precisely defined up front (like statistic cards that are always 3 aligned columns) |

In this jobsheet, Flexbox was chosen for the navbar because it only
needs to arrange menu items side by side horizontally (1 direction),
while Grid was chosen for the statistic cards because it needs explicit
control over "3 equal-width columns" — the most common case where Grid
is more concise to use than Flexbox.

## 6.6 Styling the Content of Each Card (`<article>`)

```css
main section:nth-of-type(2) article {
    background-color: #eef4fa;
    border-radius: 8px;
    padding: 1.25rem;
    text-align: center;
}
```

Each `<article>` (individual card) is given a very light blue background
(`#eef4fa`, different from the section's own white background — see
[chapter 5](05-css-main-and-section.md#53-white-card-for-every-section)
— so the card looks like a "box inside a box"), rounded corners,
padding, and center-aligned text (`text-align: center`).

```css
main section:nth-of-type(2) article h3 {
    font-size: 0.95rem;
    color: #55677a;
    margin-bottom: 0.5rem;
}

main section:nth-of-type(2) article p {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1d5b8a;
}
```

- `<h3>` (the small heading, e.g. "Total Books") is made **smaller**
  (`0.95rem`, smaller than the normal text size of `1rem`) and colored
  a bluish gray (`#55677a`) — because this is just a label, not the main
  focus.
- `<p>` (the number, e.g. "12") is made much **larger** (`1.8rem`), bold
  (`font-weight: 700` = bold), and colored the theme blue (`#1d5b8a`) —
  because this is the main information meant to stand out to the user.
  This difference in size and font weight between the small label and
  the large number is a common UI design technique called **visual
  hierarchy** — guiding the user's eye to the most important information
  first.

## 6.7 Why Not Just Use a `class`?

As noted in this jobsheet's [README.md](../README.md): *"CSS classes are
generic (based on semantic tags + `nth-child`) so they can be reused on
the Members page without duplicating classes."* In other words, instead
of manually adding `class="stat-grid"` in the HTML and then writing
`.stat-grid { display: grid; ... }` in the CSS, this jobsheet
intentionally chose a **structure & position**-based selector approach
(`main section:nth-of-type(2)`). The benefit: the HTML stays clean
without any extra `class` attributes, and the same style automatically
applies on other pages as long as their structure is similar. The
downside (which you should be aware of as a learner): if the order of
`<section>`s in the HTML changes (e.g. the "Summary" section is moved to
be the first section), this Grid style **ends up targeting the wrong
element** because `:nth-of-type(2)` is attached to a position, not a
meaning. This is a reasonable trade-off to understand once you start
making your own CSS design decisions later on.

Next: [CSS: Table Styling](07-css-table.md)
