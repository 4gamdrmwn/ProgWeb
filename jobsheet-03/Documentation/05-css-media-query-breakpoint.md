# 5. CSS: Media Query & Breakpoint

This chapter discusses two `@media` blocks at the **very bottom** of `style.css`
— where most of the "magic" of this jobsheet's responsiveness truly happens.

## 5.1 Complete CSS Code

```css
/* ===== Responsive Breakpoints ===== */

/* Tablet and down */
@media (max-width: 768px) {
    main section:nth-of-type(2) {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Mobile */
@media (max-width: 480px) {
    header {
        position: relative;
    }

    .nav-toggle-label {
        display: block;
    }

    header nav {
        display: none;
        width: 100%;
        order: 3;
        margin-top: 1rem;
    }

    .nav-toggle:checked ~ nav {
        display: block;
    }

    header nav ul {
        flex-direction: column;
        gap: 0.75rem;
    }

    main section:nth-of-type(2) {
        grid-template-columns: 1fr;
    }

    form input,
    form select {
        width: 100%;
    }
}
```

## 5.2 Tablet Breakpoint: 768px

```css
@media (max-width: 768px) {
    main section:nth-of-type(2) {
        grid-template-columns: repeat(2, 1fr);
    }
}
```

At 768px and below, the statistics cards (the second `<section>` in `<main>`,
remember from [jobsheet-02 documentation](../../jobsheet-02/Documentation/06-css-grid-stat-cards.md))
change from a 3-column grid to a **2-column grid**. This is the first "breakpoint"
where the layout noticeably changes to fit tablet screens.

## 5.3 Mobile Breakpoint: 480px

```css
@media (max-width: 480px) {
    /* ... hamburger menu styles from chapter 3 ... */
    
    header nav ul {
        flex-direction: column;
        gap: 0.75rem;
    }

    main section:nth-of-type(2) {
        grid-template-columns: 1fr;
    }

    form input,
    form select {
        width: 100%;
    }
}
```

At 480px and below (mobile phones), several things happen:
1. The hamburger checkbox/label system activates (from [chapter 3](03-css-hamburger-checkbox-hack.md)).
2. The navbar menu changes from **horizontal flex layout** to **vertical** (flex-direction: column).
3. The statistics cards grid collapses from 2 columns to **1 column**.
4. Form inputs and selects expand to **100% width** of their container.

## 5.4 Order Matters: Why Are Media Queries at the Bottom?

Crucially, both `@media` blocks are placed at the **very end** of `style.css`.

Recall from [basic concepts §1.5](01-basic-responsive-concepts.md#15-desktop-first-approach-used-in-this-jobsheet),
when two CSS rules have **equal specificity**, the one written **later** in the file wins.

If we put the media queries at the **top** or **middle** of the file, then all the default styles written **below** them would override the media query rules — defeating the entire purpose of the responsive design.

By putting them at the **bottom**, we ensure that:
- Desktop default styles are written first (unchanged from jobsheet-02).
- Media queries come last and can successfully **override** those defaults on narrow screens.

## 5.5 Desktop-First Summary

This is the **desktop-first** workflow in action:
1. Start with a full-featured desktop layout (3-column grid, horizontal menu, wide form fields).
2. Test at your smallest target screen size (mobile 480px).
3. Add `@media` rules to progressively adapt the layout as screens get narrower.
4. Each breakpoint keeps only the CSS needed to **change** from the previous breakpoint; it doesn't repeat everything.

## 5.6 How to Test Yourself in Browser

1. Open `index.html` in Firefox or Chrome.
2. Open DevTools (F12 or Ctrl+Shift+I).
3. Click the **responsive mode** button (usually a phone/tablet icon, or Ctrl+Shift+M).
4. Start at 1200px width and slowly drag to resize narrower.
5. At exactly 768px, watch the statistics cards snap from 3 columns to 2.
6. At 480px, watch them snap to 1 column, the hamburger menu appears, and the navbar disappears.
7. Click the hamburger icon ☰ — the menu toggles open/closed smoothly, proving the CSS-only checkbox hack works.

Next: [Summary & Exercises](06-summary-and-exercises.md)
