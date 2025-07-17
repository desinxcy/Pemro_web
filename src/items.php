<?php
include "header.php";
include "config.php";

// Ambil data barang dengan relasi kategori dan pemasok
$query = "SELECT items.*, categories.name AS category_name, suppliers.name AS supplier_name 
          FROM items 
          LEFT JOIN categories ON items.category_id = categories.id 
          LEFT JOIN suppliers ON items.supplier_id = suppliers.id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">📦 Data Barang</h3>
        <a href="item_add.php" class="btn btn-primary">Tambah Barang</a>
    </div>

    <div class="card shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">
                    <thead class="table-dark text-center align-middle">
                        <tr>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Pemasok</th>
                            <th>Jumlah</th>
                            <th style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && mysqli_num_rows($result) > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= htmlspecialchars($row['category_name'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($row['supplier_name'] ?? '-') ?></td>
                                    <td class="text-center"><?= htmlspecialchars($row['quantity']) ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="item_edit.php?id=<?= $row['id'] ?>">
                                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger" 
                                                       href="item_delete.php?id=<?= $row['id'] ?>" 
                                                       onclick="return confirm('Yakin ingin menghapus?');">
                                                        <i class="bi bi-trash me-1"></i> Hapus
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-4">Tidak ada data barang.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (wajib untuk dropdown bekerja) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
