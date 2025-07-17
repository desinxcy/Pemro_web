<?php
include "header.php";
include "config.php";

// Fungsi ambil nilai tunggal
function query_single_value($conn, $sql, $field, $default = 0) {
    $res = mysqli_query($conn, $sql);
    if ($res === false) {
        echo "<div class='alert alert-danger'><strong>Error:</strong> " . htmlspecialchars(mysqli_error($conn)) . "<br><small>$sql</small></div>";
        return $default;
    }
    $row = mysqli_fetch_assoc($res);
    return $row[$field] ?? $default;
}

// Ambil data
$total_items  = query_single_value($conn, "SELECT COUNT(*) AS total_items FROM items", "total_items");
$total_masuk  = query_single_value($conn, "SELECT COALESCE(SUM(quantity),0) AS total_masuk FROM stock_in", "total_masuk");
$total_keluar = query_single_value($conn, "SELECT COALESCE(SUM(quantity),0) AS total_keluar FROM stock_out", "total_keluar");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Gudang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

<div class="container my-4">
    <h2 class="mb-4 text-center">Dashboard Gudang</h2>
    <div class="row g-4 justify-content-center">
        <!-- Jumlah Barang -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card text-white bg-primary shadow h-100">
                <div class="card-body text-center">
                    <div class="mb-2 fs-2"><i class="bi bi-box-seam"></i></div>
                    <h5 class="card-title">Jumlah Jenis Barang</h5>
                    <p class="fs-1 fw-bold mb-0"><?= number_format($total_items) ?></p>
                </div>
            </div>
        </div>
        <!-- Barang Masuk -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card text-white bg-success shadow h-100">
                <div class="card-body text-center">
                    <div class="mb-2 fs-2"><i class="bi bi-box-arrow-in-down"></i></div>
                    <h5 class="card-title">Barang Masuk</h5>
                    <p class="fs-1 fw-bold mb-0"><?= number_format($total_masuk) ?></p>
                </div>
            </div>
        </div>
        <!-- Barang Keluar -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card text-white bg-danger shadow h-100">
                <div class="card-body text-center">
                    <div class="mb-2 fs-2"><i class="bi bi-box-arrow-up"></i></div>
                    <h5 class="card-title">Barang Keluar</h5>
                    <p class="fs-1 fw-bold mb-0"><?= number_format($total_keluar) ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="mt-5">
        <h5 class="text-center mb-3">Grafik Barang Masuk vs Keluar</h5>
        <canvas id="stockChart" height="100"></canvas>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Chart.js Config -->
<script>
    const ctx = document.getElementById('stockChart').getContext('2d');
    const stockChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Barang Masuk', 'Barang Keluar'],
            datasets: [{
                label: 'Jumlah',
                data: [<?= $total_masuk ?>, <?= $total_keluar ?>],
                backgroundColor: ['#198754', '#dc3545'], // Bootstrap success & danger
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>

</body>
</html>
