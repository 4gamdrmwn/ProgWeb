# Jobsheet 3 — Responsive Design

Sub-CPMK: Build a responsive display.

## Changes from Jobsheet 2
- Add `<meta name="viewport">` on all pages.
- Navbar: hamburger menu uses pure CSS **checkbox hack** technique (`input[type=checkbox] + label`), active on screens ≤480px.
- Table is wrapped in `<div class="table-responsive">` to enable horizontal scrolling on narrow screens.
- Add media query in `style.css`: grid of stat cards 3 → 2 → 1 columns following tablet/mobile breakpoints.

## How to run
Open `index.html` in your browser, test with DevTools responsive mode at 3 breakpoints (mobile ≤480px, tablet ~768px, desktop ≥1024px).

## Notes
- Hamburger in this jobsheet is still pure CSS (checkbox hack). In Jobsheet 5 it will be replaced with JavaScript-based toggle.
