# 9. CSS: Footer

The final and simplest section of `style.css`.

## 9.1 The CSS Code

```css
/* ===== Footer ===== */
footer {
    text-align: center;
    padding: 1.25rem;
    color: #7a8794;
    font-size: 0.9rem;
}
```

## 9.2 Explanation

Styles the copyright text in [`<footer>`](../../jobsheet-01/Documentation/02-index-html.md#footer-page-footer)
(`© 2026 SIMPUS-Mini — Jobsheet 1`) that appears on every page:

| Property | Effect |
|---|---|
| `text-align: center;` | Text is centered on the page, rather than left-aligned like typical text — giving the footer a "neutral", balanced closing impression. |
| `padding: 1.25rem;` | Uniform spacing on all four sides, giving breathing room around the copyright text. |
| `color: #7a8794;` | Medium gray — deliberately made **more muted/less prominent** than the main text color (`#2b2b2b` from [chapter 3](03-css-reset-and-body.md#32-base-body-style)), since copyright info isn't the main information that needs to grab the user's attention. |
| `font-size: 0.9rem;` | A text size slightly **smaller** than normal (`1rem`), reinforcing the impression that this is secondary/supplementary text. |

This pattern — shrinking the size and muting the color for less
important information — is the same visual hierarchy technique discussed
in [chapter 6 (statistic card labels)](06-css-grid-stat-cards.md#66-styling-the-content-of-each-card-article):
elements that are functionally less important are given lighter visual
weight, so the user's attention stays focused on the page's main
content.

Next: [Summary & Further Exercises](10-summary-and-exercises.md)
