<?php
include "header.php";
include "config.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$result = mysqli_query($conn, "SELECT * FROM items WHERE id = $id");
$item = mysqli_fetch_assoc($result);

if (!$item) {
    echo "<div class='container mt-4'><div class='alert alert-danger'>Data barang tidak ditemukan.</div></div>";
    include "footer.php";
    exit;
}

$categories = mysqli_query($conn, "SELECT * FROM categories");
$suppliers = mysqli_query($conn, "SELECT * FROM suppliers");
$warehouses = mysqli_query($conn, "SELECT * FROM warehouses");

function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name         = sanitize_input($_POST['name']);
    $category_id  = (int)$_POST['category_id'];
    $supplier_id  = (int)$_POST['supplier_id'];
    $warehouse_id = (int)$_POST['warehouse_id'];
    $quantity     = (int)$_POST['quantity'];

    $sql = "UPDATE items SET 
                name='$name', 
                category_id='$category_id', 
                supplier_id='$supplier_id', 
                warehouse_id='$warehouse_id', 
                quantity='$quantity' 
            WHERE id=$id";
    mysqli_query($conn, $sql);

    header("Location: items.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">✏️ Edit Barang</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="name" value="<?= htmlspecialchars($item['name']) ?>" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="category_id" class="form-select" required>
                                <?php while ($cat = mysqli_fetch_assoc($categories)) { ?>
                                    <option value="<?= $cat['id'] ?>" <?= ($item['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cat['name']) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pemasok</label>
                            <select name="supplier_id" class="form-select" required>
                                <?php while ($sup = mysqli_fetch_assoc($suppliers)) { ?>
                                    <option value="<?= $sup['id'] ?>" <?= ($item['supplier_id'] == $sup['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($sup['name']) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gudang</label>
                            <select name="warehouse_id" class="form-select" required>
                                <?php while ($wh = mysqli_fetch_assoc($warehouses)) { ?>
                                    <option value="<?= $wh['id'] ?>" <?= ($item['warehouse_id'] == $wh['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($wh['name']) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" name="quantity" value="<?= (int)$item['quantity'] ?>" class="form-control" required />
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="items.php" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
