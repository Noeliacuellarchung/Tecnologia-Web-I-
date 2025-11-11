<?php
require_once "models/Usuario.php";

class PerfilController {

    public function index() {
        // Cargar datos del usuario logueado
        $usuario = new Usuario();
        $data = $usuario->obtenerPorId($_SESSION['user_id']);
        include "views/perfil/index.php";
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario();
            $usuario->user_id = $_SESSION['user_id'];
            $usuario->usuario = $_SESSION['usuario']; // no se cambia
            $usuario->email = $_POST['email'];
            $usuario->role = $_SESSION['role']; // se mantiene
            $usuario->password = $_POST['password']; // puede estar vacío

            $usuario->actualizar();

            echo "<script>alert('✅ Perfil actualizado correctamente'); window.location='router.php?page=perfil';</script>";
        }
    }
}
?>
