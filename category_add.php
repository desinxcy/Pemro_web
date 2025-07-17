<?php
include "header.php";
include "config.php";
include "session_check.php";

$categories = mysqli_query($conn, "SELECT * FROM categories");
$suppliers = mysqli_query($conn, "SELECT * FROM suppliers");
$warehouses = mysqli_query($conn, "SELECT * FROM warehouses");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name         = $_POST['name'];
    $category_id  = $_POST['category_id'];
    $supplier_id  = $_POST['supplier_id'];
    $warehouse_id = $_POST['warehouse_id'];
    $unit         = $_POST['unit'];
    $quantity     = $_POST['quantity'];

    $sql = "INSERT INTO items (name, category_id, supplier_id, warehouse_id, unit, quantity)
            VALUES ('$name', '$category_id', '$supplier_id', '$warehouse_id', '$unit', '$quantity')";
    mysqli_query($conn, $sql);
    header("Location: items.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Tambah Barang</h3>
        <a href="items.php" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm p-4">
        <form method="POST" autocomplete="off">
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Pemasok</label>
                <select name="supplier_id" class="form-select" required>
                    <option value="">-- Pilih Pemasok --</option>
                    <?php while ($sup = mysqli_fetch_assoc($suppliers)) { ?>
                        <option value="<?= $sup['id'] ?>"><?= htmlspecialchars($sup['name']) ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Gudang</label>
                <select name="warehouse_id" class="form-select" required>
                    <option value="">-- Pilih Gudang --</option>
                    <?php while ($wh = mysqli_fetch_assoc($warehouses)) { ?>
                        <option value="<?= $wh['id'] ?>"><?= htmlspecialchars($wh['name']) ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="row g-3">
                <div class="col-sm-6">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="quantity" class="form-control" required>
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
