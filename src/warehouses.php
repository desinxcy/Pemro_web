?php
include "header.php";
include "config.php";

// Tambah data
if (isset($_POST['tambah'])) {
    $name = sanitize_input($_POST['name']);
    $location = sanitize_input($_POST['location']);
    mysqli_query($conn, "INSERT INTO warehouses (name, location) VALUES ('$name', '$location')");
    header("Location: warehouse.php");
    exit;
}

// Update data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = sanitize_input($_POST['name']);
    $location = sanitize_input($_POST['location']);
    mysqli_query($conn, "UPDATE warehouses SET name='$name', location='$location' WHERE id=$id");
    header("Location: warehouse.php");
    exit;
}

// Hapus data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM warehouses WHERE id=$id");
    header("Location: warehouse.php");
    exit;
}

// Ambil data untuk edit
$edit_data = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM warehouses WHERE id=$id"));
}

// Ambil semua data
$warehouses = mysqli_query($conn, "SELECT * FROM warehouses ORDER BY id DESC");
?>

<h3>Manajemen Gudang Penyimpanan</h3>

<div class="row">
    <div class="col-md-6">
        <form method="POST" class="card p-4 mb-4">
            <input type="hidden" name="id" value="<?= $edit_data['id'] ?? '' ?>">
            <div class="mb-3">
                <label>Nama Gudang</label>
                <input type="text" name="name" value="<?= $edit_data['name'] ?? '' ?>" class="form-control" required />
            </div>
            <div class="mb-3">
                <label>Lokasi</label>
                <input type="text" name="location" value="<?= $edit_data['location'] ?? '' ?>" class="form-control" />
            </div>
            <?php if ($edit_data) { ?>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
                <a href="warehouse.php" class="btn btn-secondary">Batal</a>
            <?php } else { ?>
                <button type="submit" name="tambah" class="btn btn-success">Simpan</button>
            <?php } ?>
        </form>
    </div>

    <div class="col-md-6">
        <table class="table table-bordered">
            <thead><tr><th>Nama Gudang</th><th>Lokasi</th><th>Aksi</th></tr></thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($warehouses)) { ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['location'] ?></td>
                    <td>
                        <a href="warehouse.php?edit=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="warehouse.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>