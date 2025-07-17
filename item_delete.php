<?php
include "config.php";
include "session_check.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    mysqli_query($conn, "DELETE FROM items WHERE id = $id");
}

header("Location: items.php");
exit;
