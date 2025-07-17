<?php
include "header.php";
include "config.php";

$result = mysqli_query($conn, "
    SELECT l.*, u.username 
    FROM activity_log l 
    JOIN users u ON l.user_id = u.id 
    ORDER BY l.created_at DESC
");
?>

<div class="container my-4">
    <h3 class="mb-3">Log Aktivitas Pengguna</h3>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-info text-center">
                    <tr>
                        <th>Waktu</th>
                        <th>User</th>
                        <th>Aksi</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td class="text-center"><?= htmlspecialchars($row['action']) ?></td>
                            <td><?= htmlspecialchars($row['description']) ?></td>
                        </tr>
                        <?php } ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada data log aktivitas.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
