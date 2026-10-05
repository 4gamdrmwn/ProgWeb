<?php
session_start();

// Prefix relative to this project's root (not the domain root) — so
// /assets, /index.php, etc. stay correct even when the project is
// accessed via a subfolder (e.g. dp2026.test/kode-praktikum/jobsheet-07/),
// not just via a vhost whose document root points directly at this folder.
$__jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPUS-Mini<?php echo isset($page_title) ? ' | ' . $page_title : ''; ?></title>
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
</head>
<body>
    <header>
        <h1>SIMPUS-Mini</h1>
        <button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Menu">&#9776;</button>
        <nav>
            <ul>
                <li><a href="<?php echo $base; ?>index.php">Home</a></li>
                <li><a href="<?php echo $base; ?>books/list.php">Book List</a></li>
                <li><a href="<?php echo $base; ?>books/add.php">Add Book</a></li>
                <li><a href="<?php echo $base; ?>members/list.php">Member List</a></li>
                <li><a href="<?php echo $base; ?>members/add.php">Add Member</a></li>
            </ul>
        </nav>
    </header>

    <main>
