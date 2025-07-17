<?php
include "header.php";
include "config.php";

$result = mysqli_query($conn, "SELECT * FROM users");
?>

<div class="container my-4">
    <h3 class="mb-3">Data Pengguna</h3>
    <a href="user_add.php" class="btn btn-primary mb-3">
        <i class="bi bi-plus-lg me-1"></i> Tambah Pengguna
    </a>
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($row['role']) ?></td>
                            <td class="text-center">
                                <a href="user_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary me-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="user_delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus user?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">Tidak ada data pengguna.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>