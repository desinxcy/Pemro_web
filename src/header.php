<?php
session_start();
include "session_check.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistem Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-white  fw-bold bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php">Sistem Gudang</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="items.php">Barang</a></li>
                <li class="nav-item"><a class="nav-link" href="categories.php">Kategori</a></li>
                <li class="nav-item"><a class="nav-link" href="suppliers.php">Pemasok</a></li>
                <li class="nav-item"><a class="nav-link" href="stock_in.php">Stok Masuk</a></li>
                <li class="nav-item"><a class="nav-link" href="stock_out.php">Stok Keluar</a></li>
                <li class="nav-item"><a class="nav-link" href="report_stock.php">Laporan</a></li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <li class="nav-item"><a class="nav-link" href="users.php">Pengguna</a></li>
                    <li class="nav-item"><a class="nav-link" href="activity_log.php">Aktivitas</a></li>
                <?php endif; ?>
            </ul>
            <span class="navbar-text text-white me-4">
                <?= isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?>
            </span>
            <a class="btn btn-outline-light" href="logout.php">Logout</a>
        </div>
    </div>
</nav>
<div class="container">
