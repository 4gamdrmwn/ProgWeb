<?php
session_start();
require __DIR__ . '/../includes/connection.php';

$title = trim($_POST['title'] ?? '');
$author = trim($_POST['author'] ?? '');
$year = $_POST['year'] ?? '';
$isbn = trim($_POST['isbn'] ?? '');
$stock = $_POST['stock'] ?? '';
$category = trim($_POST['category'] ?? '');

// Server-side validation — required even though it's already validated by JS in
// Jobsheet 5, because client-side validation can be bypassed (disable JS / send
// a manual request).
$errors = [];
if ($title === '') {
    $errors[] = "Title is required.";
}
if ($author === '') {
    $errors[] = "Author is required.";
}
if (!is_numeric($year) || $year < 1900 || $year > 2026) {
    $errors[] = "Year must be between 1900-2026.";
}
if (!is_numeric($stock) || $stock < 0) {
    $errors[] = "Stock cannot be negative.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => implode(' ', $errors)];
    header('Location: add.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO books (title, author, year, isbn, stock, category)
     VALUES (:title, :author, :year, :isbn, :stock, :category)
     RETURNING id"
);
$stmt->execute([
    'title' => $title,
    'author' => $author,
    'year' => (int) $year,
    'isbn' => $isbn,
    'stock' => (int) $stock,
    'category' => $category,
]);

$_SESSION['flash'] = ['type' => 'success', 'message' => 'Book added successfully.'];
header('Location: list.php');
exit;
