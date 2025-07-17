<?php
// Membuat hash dari password
$password = 'admin';  // Ganti dengan password yang ingin di-hash

// Hash password menggunakan bcrypt (defaultnya password_hash menggunakan bcrypt)
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

echo "Password yang sudah di-hash: " . $hashedPassword;
?>