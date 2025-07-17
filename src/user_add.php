<?php
include "header.php";
include "config.php";
include "functions.php"; // Tambahkan baris ini

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize_input($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    mysqli_query($conn, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')");
    header("Location: users.php");
    exit;
}
?>

<h3>Tambah Pengguna</h3>
<form method="POST" class="card p-4">
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required />
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required />
    </div>
    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-control">
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>