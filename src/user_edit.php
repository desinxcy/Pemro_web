<?php
include "header.php";
include "config.php";
include "functions.php"; // agar sanitize_input tersedia

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    echo "<div class='container my-4'><div class='alert alert-danger'>ID tidak valid.</div></div>";
    include "footer.php";
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "<div class='container my-4'><div class='alert alert-danger'>Pengguna tidak ditemukan.</div></div>";
    include "footer.php";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize_input($_POST['username']);
    $role = $_POST['role'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($conn, "UPDATE users SET username=?, password=?, role=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "sssi", $username, $password, $role, $id);
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE users SET username=?, role=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "ssi", $username, $role, $id);
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: users.php");
    exit;
}
?>

<h3>Edit Pengguna</h3>
<form method="POST" class="card p-4">
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" class="form-control" required />
    </div>
    <div class="mb-3">
        <label>Password Baru (kosongkan jika tidak diubah)</label>
        <input type="password" name="password" class="form-control" />
    </div>
    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-control">
            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="staff" <?= $user['role'] == 'staff' ? 'selected' : '' ?>>Staff</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
