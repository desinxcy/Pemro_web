<?php
include "header.php";
include "config.php";

$result = mysqli_query($conn, "SELECT * FROM categories");
?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">📂 Data Kategori</h3>
        <a href="category_add.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Kategori
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Nama Kategori</th>
                            <th style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td class="text-center">
                                        <a href="category_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning me-1">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <a href="category_delete.php?id=<?= $row['id'] ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Hapus data ini?');">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2" class="text-center py-4">Tidak ada data kategori.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
