<?php
require_once "models/Usuario.php";

class UsuarioController {

    public function index() {
        $usuario = new Usuario();
        $stmt = $usuario->listar("ORDER BY user_id ASC");
        include "views/usuarios/listar.php";
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = new Usuario();

            // Sanitizar datos
            $usuario->usuario = trim($_POST['usuario']);
            $usuario->password = trim($_POST['password']); // 🔹 sin encriptar aquí
            $usuario->email = trim($_POST['email']);
            $usuario->role = $_POST['role'];

            // Validar campos
            if (empty($usuario->usuario) || empty($usuario->password) || empty($usuario->email)) {
                $error = "Por favor, completa todos los campos.";
                include "views/usuarios/crear.php";
                return;
            }

            // Verificar si ya existe el usuario
            if ($usuario->verificarExistenciaUsuario($usuario->usuario)) {
                $error = "El nombre de usuario ya está en uso.";
                include "views/usuarios/crear.php";
                return;
            }

            // ✅ Crear usuario (el hash se genera en el modelo)
            $usuario->crear();

            header("Location: router.php?page=usuarios");
            exit;
        } else {
            include "views/usuarios/crear.php";
        }
    }

    public function editar() {
        if ($_SESSION['role'] !== 'admin') {
            die("<div style='padding:20px; color:red; font-weight:bold;'>🚫 Acceso denegado. Solo administradores pueden realizar esta acción.</div>");
        }

        $usuario = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario->user_id = $_POST['user_id'];
            $usuario->usuario = $_POST['usuario'];
            $usuario->email = $_POST['email'];
            $usuario->role = $_POST['role'];
            $usuario->password = $_POST['password']; // puede estar vacío
            $usuario->actualizar();
            header("Location: router.php?page=usuarios");
        } else {
            $id = $_GET['id'];
            $data = $usuario->obtenerPorId($id);
            include "views/usuarios/editar.php";
        }
    }

    public function eliminar() {
        if ($_SESSION['role'] !== 'admin') {
            die("<div style='padding:20px; color:red; font-weight:bold;'>🚫 Acceso denegado. Solo administradores pueden realizar esta acción.</div>");
        }

        $id = $_GET['id'];
        $usuario = new Usuario();
        $usuario->eliminar($id);

        // Reiniciar auto_increment
        $db = new Database();
        $conn = $db->getConnection();
        $conn->exec("ALTER TABLE usuarios AUTO_INCREMENT = 1");

        header("Location: router.php?page=usuarios");
    }
}
?>
