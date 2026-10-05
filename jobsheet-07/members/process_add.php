<?php
session_start();

$nama       = trim($_POST['name'] ?? $_POST['nama'] ?? '');
$nomor      = trim($_POST['member_no'] ?? $_POST['nomor_anggota'] ?? '');
$alamat     = trim($_POST['address'] ?? $_POST['alamat'] ?? '');
$telepon    = trim($_POST['phone_no'] ?? $_POST['telepon'] ?? '');
$email      = trim($_POST['email'] ?? '');

$errors = [];

if ($nama === '') {
    $errors[] = "Name is required.";
}

if ($nomor === '') {
    $errors[] = "Member No. is required.";
}

if ($telepon !== '' && !preg_match('/^[0-9+\s-]+$/', $telepon)) {
    $errors[] = "Phone number contains invalid characters.";
}

if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => implode(' ', $errors)
    ];
    header('Location: add.php');
    exit;
}

if (!isset($_SESSION['anggota'])) {
    $_SESSION['anggota'] = [];
}

$_SESSION['anggota'][] = [
    'nomor_anggota' => $nomor,
    'nama'          => $nama,
    'alamat'        => $alamat,
    'telepon'       => $telepon,
    'email'         => $email
];

$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Member added successfully.'
];
header('Location: list.php');
exit;