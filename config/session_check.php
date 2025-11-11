<?php
// Iniciar sesión si aún no se ha iniciado
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si no hay usuario logueado, redirigir al login
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>
