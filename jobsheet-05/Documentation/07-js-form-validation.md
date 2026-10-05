# 7. JS: Form Validation

The longest chapter in this jobsheet — form validation involves 3
functions working together: two helper functions (`showError`,
`removeError`) and one main function (`initFormValidation`).

## 7.1 Full Code

```js
// ===== Form validation (client-side) =====
function showError(input, message) {
    removeError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = message;
    input.insertAdjacentElement("afterend", span);
}

function removeError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
}

function initFormValidation() {
    const form = document.getElementById("add-form");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;

        const title = form.querySelector("[name='title'], [name='name']");
        if (title && title.value.trim() === "") {
            showError(title, "This field is required.");
            valid = false;
        } else if (title) {
            removeError(title);
        }

        // ...(similar checks for author, year, stock)...

        if (!valid) {
            e.preventDefault();
        }
    });
}
```

## 7.2 Recall First: The "Not Yet Processed" Concept from Jobsheet-01

Recall from [jobsheet-01 documentation §4.2](../../jobsheet-01/Documentation/04-books-add-html.md#42-the-form-element),
the `<form>` tag on the Add Book/Member pages has **no** `action`/
`method` attribute — meaning pressing "Save" just reloads the page
without sending data anywhere. Validation in this jobsheet **doesn't
change that fact** — the form still doesn't actually save data
anywhere yet. What's newly added is only a **check** that runs right
**before** the submit process (which actually does nothing yet) —
preparing a pattern that will remain useful once the form is really
connected to a server.

## 7.3 Helper Function: `showError`

```js
function showError(input, message) {
    removeError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = message;
    input.insertAdjacentElement("afterend", span);
}
```

This function receives 2 **parameters** (input values): `input` (the
problematic field element) and `message` (the error text to display).

1. **`removeError(input);`** — calls another function
   ([§7.4](#74-helper-function-removeerror)) to **clean up first** any
   old error message (if any) before adding a new one — preventing two
   error messages from stacking up for the same field.
2. **`document.createElement("span")`** — a DOM method for **creating a
   new HTML element** from JavaScript code, entirely absent from any
   HTML until this line runs. This is different from all previous
   functions (`initNavToggle`, `initDeleteConfirm`, `initTableFilter`)
   which only **select** existing elements — this is the first time
   `app.js` actually **creates** a new element.
3. **`span.className = "error";`** — gives the newly created `<span>`
   element the attribute `class="error"`, connecting it to the `.error`
   CSS style already discussed in
   [chapter 3 §3.2](03-css-supporting-javascript.md#32-new-style-validation-error-message).
4. **`span.textContent = message;`** — fills the text inside that
   `<span>` with the given error message (e.g. "This field is
   required.").
5. **`input.insertAdjacentElement("afterend", span);`** — a DOM method
   for **inserting** a new element at a specific position **relative**
   to another element, without needing to know the surrounding DOM
   structure in detail. `"afterend"` means "right after the `input`
   element, as a sibling, not inside it." As a result, the
   `<span class="error">` will appear **right below** the problematic
   input box (recall `.error { display: block; }` from
   [chapter 3 §3.2](03-css-supporting-javascript.md#32-new-style-validation-error-message)
   makes it move to a new line).

## 7.4 Helper Function: `removeError`

```js
function removeError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
}
```

- **`input.nextElementSibling`** — a property that gets the element
  **right after** `input` at the same level (the next sibling) — the
  logical opposite of `insertAdjacentElement("afterend", ...)` used in
  [§7.3](#73-helper-function-showerror) to insert it.
- **`next.classList.contains("error")`** — checks **whether** that next
  sibling element has the `error` class (recall `classList` from
  [chapter 4 §4.4](04-js-hamburger-menu.md#44-attaching-the-event-listener),
  `.contains()` here checks for the existence of one specific class,
  different from `.toggle()` which flips the state).
- If it exists **and** its class is `error` → it means it really is an
  error message previously added by `showError`, safe to remove with
  `.remove()`. This `classList.contains("error")` check matters so this
  function **doesn't accidentally remove** some other element that
  happens to be the next sibling (for example a `<br>` on a field that
  has never had an error at all).

## 7.5 Main Function: `initFormValidation`

```js
function initFormValidation() {
    const form = document.getElementById("add-form");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;
        // ...check each field...
        if (!valid) {
            e.preventDefault();
        }
    });
}
```

- `form` is found via `id="add-form"` — recall from
  [chapter 2 §2.4](02-html-file-changes.md#24-id-add-form-on-the-add-bookmember-form),
  this `id` was deliberately made **the same** on both the Add Book and
  Add Member forms.
- `let valid = true;` — unlike the `const` used in other functions
  ([chapter 4 §4.2](04-js-hamburger-menu.md#42-getting-the-two-elements-needed)),
  `let` is used here because the value of `valid` **will be changed**
  to `false` if an invalid field is found during checking.
- **`form.addEventListener("submit", function (e) { ... })`** — the
  `submit` event (recall from
  [chapter 1 §1.6](01-basic-javascript-dom-concepts.md#16-what-are-events-and-event-listeners))
  fires right when the `<button type="submit">` is pressed. Notice the
  function receives the **parameter `e`** (short for *event*) — an
  object containing information about this occurrence, used in
  [§7.7](#77-preventing-submit-if-invalid).

## 7.6 Per-Field Check Pattern

```js
const title = form.querySelector("[name='title'], [name='name']");
if (title && title.value.trim() === "") {
    showError(title, "This field is required.");
    valid = false;
} else if (title) {
    removeError(title);
}
```

- **`form.querySelector("[name='title'], [name='name']")`** — an
  attribute selector (recall this concept from
  [jobsheet-02 documentation §8.5](../../jobsheet-02/Documentation/08-css-form.md#85-submit-button))
  separated by a comma, meaning "find the field whose `name` is
  `title` **or** `name`." This is the **key trick** that lets one
  `initFormValidation` function handle **two forms with different
  fields**: on the Add Book form the first field is named `title`
  ([jobsheet-01 documentation](../../jobsheet-01/Documentation/04-books-add-html.md#41-full-form-code)),
  on the Add Member form it's named `name`
  ([jobsheet-01 documentation](../../jobsheet-01/Documentation/06-members-add-html.md#61-full-code)) —
  this selector will find **whichever one actually exists** on the form
  where this code runs, since only one of the two will match depending
  on which page is open.
- **`title.value.trim() === ""`** — `.trim()` removes leading/trailing
  whitespace (so typing "   " -- only spaces -- is still treated as
  empty, not considered valid). `=== ""` checks whether the result is
  truly an empty string.
- If empty → call `showError` ([§7.3](#73-helper-function-showerror))
  with its message, then set `valid = false` — marking that this form
  **must not** be processed further.
- If **not** empty (`else if (title)`) → call `removeError`
  ([§7.4](#74-helper-function-removeerror)) — clearing any old error
  message if this field **previously** had an error but has now been
  fixed by the user.

The exact same pattern repeats for the `author` field, with adjustments
for `year` and `stock`:

```js
const year = form.querySelector("[name='year']");
if (year) {
    const value = parseInt(year.value, 10);
    if (isNaN(value) || value < 1900 || value > 2026) {
        showError(year, "Year must be between 1900-2026.");
        valid = false;
    } else {
        removeError(year);
    }
}
```

- **`parseInt(year.value, 10)`** — converts text (e.g. `"2005"`) into
  an actual **number** (`2005`), with `10` indicating base-10 (decimal)
  — a good practice to always include explicitly, though it's often
  skipped for common cases.
- **`isNaN(value)`** — `NaN` stands for *Not a Number*, the value that
  appears when `parseInt` fails to convert text into a number (e.g. if
  the field was left empty). `isNaN()` checks whether the value is
  indeed not a valid number.
- **`value < 1900 || value > 2026`** — checks a reasonable year range,
  **duplicating** a rule that already exists in the HTML via
  `min="1900" max="2026"` (recall from
  [jobsheet-01 documentation §4.4](../../jobsheet-01/Documentation/04-books-add-html.md#44-types-of-input-used)).
  This is **not** a pointless duplication — the reason is discussed in
  [§7.8](#78-why-do-html-required-min-max-validations-still-need-to-be-duplicated-in-js).

The `stock` field uses a similar pattern, only checking `value < 0`
(stock cannot be negative, with no upper limit).

## 7.7 Preventing Submit if Invalid

```js
if (!valid) {
    e.preventDefault();
}
```

After **all** fields are checked, if `valid` is still `false` (meaning
at least one field has a problem), the line **`e.preventDefault();`**
is called — this method **cancels** the default behavior of the event
currently occurring. For the `submit` event, the default behavior is
"send the form" (which in this jobsheet actually just reloads the
page, recall
[§7.2](#72-recall-first-the-not-yet-processed-concept-from-jobsheet-01)).
With `preventDefault()` called, the page does **not** reload — the user
stays on the same form, with the error messages just shown still
visible, ready to be fixed.

If `valid` stays `true` (all fields pass the check),
`e.preventDefault()` is **not** called, so the form continues its
default behavior as usual (reload the page, matching the fact that the
form isn't yet connected to a real server).

## 7.8 Why Do HTML Validations (`required`, `min`, `max`) Still Need to Be Duplicated in JS?

A fair question: if HTML already has `required` and `min`/`max` since
jobsheet-01, why rewrite the logic in JavaScript? The answer was
already hinted at as an important note in this jobsheet's
[README.md](../README.md):

> Validation here is purely client-side and can be bypassed (by disabling JS).

Actually, the **opposite** point needs to be underlined here: both
HTML's built-in validation (`required`, `min`, `max`) **and** JavaScript
validation **both** run on the **client side** (the user's browser) —
both can be bypassed by a sufficiently knowledgeable user (e.g. via
DevTools, or by sending a request directly without going through the
form). Duplicating the rules in JavaScript in this jobsheet is meant
for **practicing** the use of `insertAdjacentElement`, `classList`, and
other DOM manipulation per this jobsheet's Sub-CPMK — **not** to add
real security. The layer of validation that **truly cannot be
bypassed** is **server-side** validation, which won't be added until
Jobsheet 7 — per the official note in this jobsheet's
[README.md](../README.md). The important rule: **never rely on
client-side validation alone** for data that is genuinely sensitive/
important.

Continue to: [Summary & Further Exercises](08-summary-and-exercises.md)
