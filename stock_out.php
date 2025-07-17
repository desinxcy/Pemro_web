<?php
include "header.php";
include "config.php";

// Tambah stok keluar
if (isset($_POST['tambah'])) {
    $item_id = $_POST['item_id'];
    $qty = $_POST['qty'];
    $date_out = $_POST['date_out'];
    $user_id = $_SESSION['user_id'];

    // Kurangi stok barang
    mysqli_query($conn, "UPDATE items SET quantity = quantity - $qty WHERE id = $item_id");

    // Simpan stok keluar
    mysqli_query($conn, "INSERT INTO stock_out (item_id, quantity, date_out, user_id) VALUES ('$item_id', '$qty', '$date_out', '$user_id')");

    // Log aktivitas
    mysqli_query($conn, "INSERT INTO activity_log (user_id, action, description, created_at) VALUES ('$user_id', 'stok keluar', 'Mengeluarkan $qty item dari ID $item_id', NOW())");

    header("Location: stock_out.php");
    exit;
}

// Ambil data barang
$items = mysqli_query($conn, "SELECT * FROM items");

// Ambil data stok keluar
$data = mysqli_query($conn, "
    SELECT s.*, i.name as item_name 
    FROM stock_out s 
    JOIN items i ON s.item_id = i.id 
    ORDER BY s.date_out DESC
");
?>

<div class="container my-4">
    <h3 class="mb-4">Stok Keluar</h3>

    <form method="POST" class="card p-4 mb-4 shadow-sm">
        <div class="mb-3">
            <label for="item_id" class="form-label">Barang</label>
            <select id="item_id" name="item_id" class="form-select" required>
                <option value="">-- Pilih Barang --</option>
                <?php while($i = mysqli_fetch_assoc($items)) { ?>
                    <option value="<?= $i['id'] ?>"><?= htmlspecialchars($i['name']) ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="qty" class="form-label">Jumlah</label>
            <input type="number" id="qty" name="qty" class="form-control" min="1" required />
        </div>
        <div class="mb-3">
            <label for="date_out" class="form-label">Tanggal Keluar</label>
            <input type="date" id="date_out" name="date_out" class="form-control" required />
        </div>
        <button type="submit" name="tambah" class="btn btn-danger">
            <i class="bi bi-box-arrow-in-up-right me-1"></i> Simpan
        </button>
    </form>

    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white fw-bold">
            Riwayat Stok Keluar
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">
                    <thead class="table-danger text-center">
                        <tr>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($r = mysqli_fetch_assoc($data)) { ?>
                        <tr>
                            <td><?= htmlspecialchars($r['item_name']) ?></td>
                            <td class="text-center"><?= $r['quantity'] ?></td>
                            <td class="text-center"><?= $r['date_out'] ?></td>
                        </tr>
                        <?php } ?>
                        <?php if (mysqli_num_rows($data) === 0) { ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">Data stok keluar kosong</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
