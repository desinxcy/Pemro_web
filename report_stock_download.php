<?php
include "config.php";

// Set header agar browser menganggap ini file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_stok.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Ambil data
$query = "SELECT items.*, categories.name AS category_name, suppliers.name AS supplier_name 
          FROM items 
          LEFT JOIN categories ON items.category_id = categories.id 
          LEFT JOIN suppliers ON items.supplier_id = suppliers.id";

$result = mysqli_query($conn, $query);

// Mulai output tabel HTML
echo "<table border='1'>";
echo "<tr>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Pemasok</th>
        <th>Jumlah</th>
      </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>" . htmlspecialchars($row['name']) . "</td>
            <td>" . htmlspecialchars($row['category_name']) . "</td>
            <td>" . htmlspecialchars($row['supplier_name']) . "</td>
            <td>" . $row['quantity'] . "</td>
          </tr>";
}

echo "</table>";
exit;
