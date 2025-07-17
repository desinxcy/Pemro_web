<?php
include "header.php";
include "config.php";

$id = $_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id = $id"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize_input($_POST['username']);
    $role = $_POST['role'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE users SET username='$username', password='$password', role='$role' WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE users SET username='$username', role='$role' WHERE id=$id");
    }

    header("Location: users.php");
    exit;
}
?>

<h3>Edit Pengguna</h3>
<form method="POST" class="card p-4">
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" value="<?= $user['username'] ?>" class="form-control" required />
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