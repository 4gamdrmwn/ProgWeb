# Jobsheet 2 — Basic CSS3 Styling

Sub-CPMK: Implementing basic styling with CSS3.

## Changes from Jobsheet 1
- Added `assets/css/style.css` (box model, Flexbox for the navbar, CSS Grid for the Home page statistic cards).
- Every `.html` page now has a `<link rel="stylesheet">` added to `style.css` (relative path adjusted to the folder depth).
- The HTML structure **was not changed** — only the appearance.

## How to run
Open `index.html` directly in a browser.

## Notes
- The statistic cards on the Home page use `main section:nth-of-type(2)` as a 3-column grid.
- CSS classes are generic (based on semantic tags + `nth-child`) so they can be reused on the Members page without duplicating classes.
