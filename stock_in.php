<?php
include "header.php";
include "config.php";

// Tambah stok masuk
if (isset($_POST['tambah'])) {
    $item_id = $_POST['item_id'];
    $qty = $_POST['qty'];
    $date_in = $_POST['date_in'];
    $user_id = $_SESSION['user_id'];

    // Tambah stok barang
    mysqli_query($conn, "UPDATE items SET quantity = quantity + $qty WHERE id = $item_id");

    // Simpan stok masuk
    mysqli_query($conn, "INSERT INTO stock_in (item_id, quantity, date_in, user_id) 
                         VALUES ('$item_id', '$qty', '$date_in', '$user_id')");

    // Log aktivitas
    mysqli_query($conn, "INSERT INTO activity_log (user_id, action, description, created_at) 
                         VALUES ('$user_id', 'stok masuk', 'Menambahkan $qty item ke ID $item_id', NOW())");

    header("Location: stock_in.php");
    exit;
}

// Ambil data barang
$items = mysqli_query($conn, "SELECT * FROM items");

// Ambil data stok masuk
$data = mysqli_query($conn, "
    SELECT s.*, i.name as item_name 
    FROM stock_in s 
    JOIN items i ON s.item_id = i.id 
    ORDER BY s.date_in DESC
");
?>

<div class="container my-4">
    <h3 class="fw-bold mb-3">📥 Stok Masuk</h3>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Barang</label>
                    <select name="item_id" class="form-select" required>
                        <option value="">-- Pilih Barang --</option>
                        <?php while($i = mysqli_fetch_assoc($items)) { ?>
                            <option value="<?= $i['id'] ?>"><?= htmlspecialchars($i['name']) ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="qty" class="form-control" required />
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Masuk</label>
                    <input type="date" name="date_in" class="form-control" required />
                </div>

                <button type="submit" name="tambah" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan
                </button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-center text-white fw-bold">
            Riwayat Stok Masuk
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">
                    <thead class="table-primary text-center">
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
                            <td class="text-center"><?= $r['date_in'] ?></td>
                        </tr>
                        <?php } ?>
                        <?php if (mysqli_num_rows($data) === 0): ?>
                        <tr>
                            <td colspan="3" class="text-center py-3 text-muted">Belum ada data stok masuk.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
