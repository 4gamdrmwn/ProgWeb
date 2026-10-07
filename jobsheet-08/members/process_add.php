<?php
session_start();
require __DIR__ . '/../includes/connection.php';

// Tangkap input (antisipasi jika input di HTML bernama member_id atau member_no)
$name    = trim($_POST['name'] ?? '');
$member_id = trim($_POST['member_id'] ?? $_POST['member_no'] ?? '');
$address = trim($_POST['address'] ?? '');
$phone   = trim($_POST['phone'] ?? '');

// Validasi
$errors = [];
if ($name === '') {
    $errors[] = "Name is required.";
}
if ($member_id === '') {
    $errors[] = "Member ID is required.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = [
        'type'    => 'error',
        'message' => implode(' ', $errors)
    ];
    header('Location: add.php');
    exit;
}

// Simpan ke database
try {
    $stmt = $pdo->prepare(
        "INSERT INTO members (name, member_id, address, phone)
         VALUES (:name, :member_id, :address, :phone)
         RETURNING id"
    );

    $stmt->execute([
        'name'      => $name,
        'member_id' => $member_id, // Pastikan variabel di sini adalah $member_id
        'address'   => $address,
        'phone'     => $phone,
    ]);

    $_SESSION['flash'] = [
        'type'    => 'success',
        'message' => 'Member added successfully.'
    ];
    header('Location: list.php');
    exit;

} catch (PDOException $e) {
    if ($e->getCode() === '23505' || strpos($e->getMessage(), 'unique') !== false) {
        $_SESSION['flash'] = [
            'type'    => 'error',
            'message' => 'Member ID is already in use, please use another ID.'
        ];
    } else {
        $_SESSION['flash'] = [
            'type'    => 'error',
            'message' => 'Database error: ' . $e->getMessage()
        ];
    }
    header('Location: add.php');
    exit;
}