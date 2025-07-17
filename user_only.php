<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['status'] !== 'user') {
    header("Location: unauthorized.php");
    exit;
}
