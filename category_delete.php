<?php
include "config.php";
include "session_check.php";

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM categories WHERE id = $id");
header("Location: categories.php");
exit;
?>
