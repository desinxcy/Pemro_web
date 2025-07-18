<?php
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

?>
