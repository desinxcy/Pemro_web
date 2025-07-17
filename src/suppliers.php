<?php
include "header.php";
include "config.php";

// Fungsi tambah
if (isset($_POST['tambah'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    mysqli_query($conn, "INSERT INTO suppliers (name, contact) VALUES ('$name', '$contact')");
    header("Location: suppliers.php");
    exit;
}

// Fungsi edit
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    mysqli_query($conn, "UPDATE suppliers SET name='$name', contact='$contact' WHERE id=$id");
    header("Location: suppliers.php");
    exit;
}

// Fungsi hapus
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM suppliers WHERE id=$id");
    header("Location: suppliers.php");
    exit;
}

// Jika ingin edit
$edit_data = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM suppliers WHERE id=$id"));
}

// Ambil semua data
$suppliers = mysqli_query($conn, "SELECT * FROM suppliers ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Pemasok</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-4">
    <h3 class="fw-bold mb-4">📦 Manajemen Pemasok</h3>

    <div class="row">
        <!-- Form Tambah/Edit -->
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <?= $edit_data ? 'Edit Pemasok' : 'Tambah Pemasok' ?>
                </div>
                <div class="card-body">
                    <form method="POST" autocomplete="off">
                        <input type="hidden" name="id" value="<?= $edit_data['id'] ?? '' ?>">
                        <div class="mb-3">
                            <label class="form-label">Nama Pemasok</label>
                            <input type="text" name="name" value="<?= $edit_data['name'] ?? '' ?>" class="form-control" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kontak</label>
                            <input type="text" name="contact" value="<?= $edit_data['contact'] ?? '' ?>" class="form-control" />
                        </div>
                        <div class="d-flex justify-content-between">
                            <?php if ($edit_data) { ?>
                                <button type="submit" name="update" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Update
                                </button>
                                <a href="suppliers.php" class="btn btn-secondary">Batal</a>
                            <?php } else { ?>
                                <button type="submit" name="tambah" class="btn btn-primary"> Simpan </button>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-black text-center fw-bold">
                    Daftar Pemasok
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="text-center">
                                <tr>
                                    <th>Nama</th>
                                    <th>Kontak</th>
                                    <th style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($suppliers) > 0): ?>
                                    <?php while ($row = mysqli_fetch_assoc($suppliers)) { ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['name']) ?></td>
                                        <td><?= htmlspecialchars($row['contact']) ?></td>
                                        <td class="text-center">
                                            <a href="suppliers.php?edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="suppliers.php?delete=<?= $row['id'] ?>" 
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('Yakin ingin menghapus pemasok ini?');">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center py-3">Belum ada data pemasok.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
