# 1. Basic Concepts of Responsive Design

Before diving into the code, let's first understand the key concepts behind "responsive display" that will continue to appear in upcoming chapters.

## 1.1 What is Responsive Web Design?

**Responsive Web Design (RWD)** is an approach to building web pages so that **the layout automatically adapts** to the screen width of the device being used — mobile phone, tablet, laptop, or large monitor — using **the same** HTML/CSS file, without needing to create separate versions for each device (such as the old `m.situs.com` mobile version that was popular before the RWD era).

Before this jobsheet, the `index.html` page and others were already "working" on mobile phones (browsers still display them), but not yet **responsive** — because without `<meta name="viewport">` (discussed in [§1.2](#12-meta-nameviewport--so-mobile-browsers-dont-lie)), mobile browsers will think the page is designed for desktop screens, then zoom out the entire page to fit on the small screen — resulting in very small text that users must pinch-zoom manually.

## 1.2 `<meta name="viewport">` — So Mobile Browsers Don't "Lie"

```html
<meta name="viewport" content="width=device-width, initial-scale=1">
```

This is added to the `<head>` of every page in this jobsheet (see the details of changes in [chapter 2](02-changes-to-html-files.md#21-meta-viewport)).
Without this line, mobile browsers **pretend** to have a screen width of around 980px (called *default layout viewport*) then zoom out the rendered result to fit on the actual much smaller screen — this is why many old websites appear "tiny" and need manual zoom when opened on mobile.

The `content` attribute contains two instructions:

| Instruction | Meaning |
|---|---|
| `width=device-width` | The viewport width (display area) is **set equal to** the physical screen width of the device, not the 980px default mentioned above. |
| `initial-scale=1` | Initial zoom level is set to **1:1** (no zoom out or in) when the page first loads. |

With these two instructions, 1 CSS pixel (`px` that you write in `style.css`) is roughly equal to 1 pixel that actually appears proportionally on a mobile screen, so **media queries** (discussed next) can work accurately based on the actual screen width.

## 1.3 Media Query: CSS that "Asks" First

**Media query** is a CSS feature that allows a set of CSS rules to only apply **if certain conditions are met** — most commonly, the condition is the screen width (viewport). The syntax is:

```css
@media (max-width: 768px) {
    /* CSS rules here ONLY apply
       if the screen width is 768px or narrower */
}
```

- `@media` — keyword that starts a media query block.
- `(max-width: 768px)` — **condition**: applies while viewport width is **less than or equal to** 768px.
- All CSS rules inside the curly braces `{ }` are only "active" when that condition is true. Once the screen is widened beyond 768px (for example, resizing the browser window), the rules inside automatically **stop** applying — no JavaScript or page reload needed, purely CSS capability.

Detailed explanation of each breakpoint used in this jobsheet is in [chapter 5](05-css-media-query-breakpoint.md).

## 1.4 Breakpoint: Threshold Point

**Breakpoint** is a specific screen width value used as a "boundary line" in a media query — in this jobsheet there are 2 breakpoints:

| Breakpoint | Value | Roughly Represents |
|---|---|---|
| Tablet | `768px` | Tablet and other narrow screens |
| Mobile | `480px` | Mobile phone |

These numbers **are not universal rules** — many projects choose different breakpoints depending on their design needs. 768px and 480px are just common conventions that approximate average tablet and mobile screen widths.

## 1.5 "Desktop-First" Approach Used in This Jobsheet

There are two common strategies for writing responsive CSS:

| Strategy | How It Works |
|---|---|
| **Desktop-first** | Write **default** styles for large screens first, then **override** some of them inside `@media (max-width: ...)` for narrower screens. |
| **Mobile-first** | The opposite: write default styles for **narrow** screens first, then add more styles inside `@media (min-width: ...)` for wider screens. |

This jobsheet uses the **desktop-first** approach: note that all styles from [jobsheet-02](../../jobsheet-02/Documentation/README.md) (3-column grid, horizontal navbar, etc.) remain as the **default/base styles**, and `style.css` in this jobsheet only **adds** two `@media (max-width: ...)` blocks at the **very bottom** of the file to override them on narrow screens (see [chapter 5](05-css-media-query-breakpoint.md)).

**Why must it be at the bottom of the file?** Because if two CSS rules have the same selector specificity (remember the specificity concept from [jobsheet-02 documentation](../../jobsheet-02/Documentation/04-css-header-navbar-flexbox.md#47-why-selector-header-nav-a-wins-over-a)), the rule written **later** in the file wins. If the `@media` block is placed **before** the default styles, the default styles written after would actually override the media query results back — so the responsiveness "disappears" accidentally. This is a common beginner mistake when first adding media queries to an existing stylesheet.

With these concepts as background, you're now ready to read the concrete changes starting in chapter 2.

Next: [What Changes in HTML Files?](02-changes-to-html-files.md)
