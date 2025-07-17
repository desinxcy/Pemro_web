<?php
$host = "localhost";
$user = "root";
$password = ""; // sesuaikan dengan password database Anda
$database = "guda";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
