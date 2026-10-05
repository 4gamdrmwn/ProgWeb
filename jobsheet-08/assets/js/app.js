// ===== Hamburger menu (JS-driven, replaces the checkbox hack) =====
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}

// ===== Delete confirmation (front-end only, not yet sent to the server) =====
// Uses event delegation on document because table rows are rendered by PHP
// (see books/list.php and members/list.php), so a .btn-delete button might
// not exist yet at DOMContentLoaded.
function initDeleteConfirm() {
    document.addEventListener("click", function (e) {
        const btn = e.target.closest(".btn-delete");
        if (!btn) return;

        const row = btn.closest("tr");
        const name = row ? row.querySelector("td")?.textContent : "this item";
        const confirmed = confirm("Are you sure you want to delete \"" + name + "\"?");
        if (confirmed && row) {
            row.remove();
        }
    });
}

// ===== Real-time table filter/search =====
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");
    if (!input || !table) return;

    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");
        rows.forEach(function (row) {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(keyword) ? "" : "none";
        });
    });
}

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

        const author = form.querySelector("[name='author']");
        if (author && author.value.trim() === "") {
            showError(author, "Author is required.");
            valid = false;
        } else if (author) {
            removeError(author);
        }

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

        const stock = form.querySelector("[name='stock']");
        if (stock) {
            const value = parseInt(stock.value, 10);
            if (isNaN(value) || value < 0) {
                showError(stock, "Stock cannot be negative.");
                valid = false;
            } else {
                removeError(stock);
            }
        }

        if (!valid) {
            e.preventDefault();
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initDeleteConfirm();
    initTableFilter();
    initFormValidation();
});
