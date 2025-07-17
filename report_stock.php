<?php
include "header.php";
include "config.php";

// Ambil data barang
$query = "SELECT items.*, categories.name AS category_name, suppliers.name AS supplier_name 
          FROM items 
          LEFT JOIN categories ON items.category_id = categories.id 
          LEFT JOIN suppliers ON items.supplier_id = suppliers.id";
$result = mysqli_query($conn, $query);
?>

<div class="container my-4">
    <h3 class="mb-4">Laporan Stok Barang</h3>

    <a href="report_stock_download.php" class="btn btn-success mb-3">
        <i class="bi bi-download me-1"></i> Download Excel
    </a>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0">
                <thead class="table-success text-center">
                    <tr>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Pemasok</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['category_name']) ?></td>
                                <td><?= htmlspecialchars($row['supplier_name']) ?></td>
                                <td class="text-center"><?= $row['quantity'] ?></td>
                            </tr>
                        <?php endwhile ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada data.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
