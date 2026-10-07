<?php
require __DIR__ . '/includes/connection.php';

$jsonFile = __DIR__ . '/../jobsheet-06/data/books.json';

if (!file_exists($jsonFile)) {
    die("File books.json tidak ditemukan.");
}

$books = json_decode(file_get_contents($jsonFile), true);

$stmt = $pdo->prepare(
    "INSERT INTO books (title, author, year, isbn, stock, category)
     VALUES (:title, :author, :year, :isbn, :stock, :category)"
);

$count = 0;
foreach ($books as $b) {
    $stmt->execute([
        'title'    => $b['title'],
        'author'   => $b['author'],
        'year'     => (int)$b['year'],
        'isbn'     => $b['isbn'] ?? null,
        'stock'    => (int)$b['stock'],
        'category' => $b['category'] ?? null
    ]);
    $count++;
}

echo "Migrasi berhasil! Sebanyak {$count} buku berhasil dimasukkan ke PostgreSQL.";