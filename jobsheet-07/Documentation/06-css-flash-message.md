# 6. CSS: Flash Message Style

The only `style.css` change in this jobsheet — supporting the flash
message display already discussed in
[chapter 5 §5.3](05-list-php-render-and-flash.md#53-displaying-the-flash-message-in-html).

## 6.1 CSS Code

```css
/* ===== Flash Message ===== */
.flash {
    padding: 0.75rem 1rem;
    border-radius: 6px;
    margin-bottom: 1rem;
    font-weight: 500;
}

.flash-success {
    background-color: #d4edda;
    color: #155724;
}

.flash-error {
    background-color: #f8d7da;
    color: #721c24;
}
```

## 6.2 Base Style (`.flash`)

`.flash` contains styles that are **always the same** for both message
types: comfortable padding, rounded corners (`border-radius`, recall the
concept from
[jobsheet-02 documentation §5.3](../../jobsheet-02/Documentation/05-css-main-and-section.md#53-white-card-for-every-section)),
spacing below it, and slightly bold text (`font-weight: 500`, consistent
with the weight used for form labels since
[jobsheet-02 documentation §8.3](../../jobsheet-02/Documentation/08-css-form.md#83-label-as-its-own-block)).

## 6.3 Type-Specific Styles (`.flash-success`, `.flash-error`)

Recall from [chapter 5 §5.3](05-list-php-render-and-flash.md#53-displaying-the-flash-message-in-html),
a flash message element always has **two** classes at once: `flash` and
one of `flash-success`/`flash-error`. These two additional classes give
**different colors** depending on the message type:

| Class | Background Color | Text Color | Impression |
|---|---|---|---|
| `.flash-success` | `#d4edda` (very light green) | `#155724` (dark green) | Positive — data saved successfully |
| `.flash-error` | `#f8d7da` (pale pink) | `#721c24` (dark red/maroon) | Warning — something needs fixing |

This green=success, red=failure color pattern is consistent with the
color convention you've used since the start — recall the red color on
the Delete button and validation error messages
([jobsheet-05 documentation §3.2](../../jobsheet-05/Documentation/03-css-supporting-javascript.md#32-new-style-validation-error-message))
using a matching red combination (`#d9534f`) for the same purpose:
signaling something that needs the user's attention.

Continue to: [Summary & Further Exercises](07-summary-and-exercises.md)
