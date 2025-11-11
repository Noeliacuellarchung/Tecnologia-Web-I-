<?php
require_once "models/Categoria.php";
require_once "config/database.php";

class CategoriaController {

    public function index() {
        $categoria = new Categoria();
        $stmt = $categoria->listar();
        include "views/categorias/listar.php";
    }

    public function crear() {
        // ✅ Permitir crear si el rol es admin o user
        if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'user') {
            die("<div style='padding:20px; color:red; font-weight:bold;'>🚫 Acceso denegado. No tienes permisos para crear categorías.</div>");
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $categoria = new Categoria();
            $categoria->descripcion = trim($_POST['descripcion']);
            $categoria->crear();

            header("Location: router.php?page=categorias");
            exit;
        } else {
            include "views/categorias/crear.php";
        }
    }

    public function editar() {
        // ❌ Solo admin puede editar
        if ($_SESSION['role'] !== 'admin') {
            die("<div style='padding:20px; color:red; font-weight:bold;'>🚫 Solo los administradores pueden editar categorías.</div>");
        }

        $categoria = new Categoria();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $categoria->category_id = $_POST['category_id'];
            $categoria->descripcion = trim($_POST['descripcion']);
            $categoria->actualizar();

            header("Location: router.php?page=categorias");
            exit;
        } else {
            $id = $_GET['id'];
            $data = $categoria->obtenerPorId($id);
            include "views/categorias/editar.php";
        }
    }

    public function eliminar() {
        // ❌ Solo admin puede eliminar
        if ($_SESSION['role'] !== 'admin') {
            die("<div style='padding:20px; color:red; font-weight:bold;'>🚫 Solo los administradores pueden eliminar categorías.</div>");
        }

        $id = $_GET['id'];
        $categoria = new Categoria();
        $categoria->eliminar($id);

        // ✅ Reasignar IDs y resetear el contador
        $db = new Database();
        $conn = $db->getConnection();

        try {
            $conn->exec("SET @count = 0;");
            $conn->exec("UPDATE categorias SET category_id = @count := @count + 1 ORDER BY category_id;");
            $conn->exec("ALTER TABLE categorias AUTO_INCREMENT = 1;");
        } catch (PDOException $e) {
            echo "<div style='color:red; font-weight:bold;'>⚠️ Error al reajustar IDs: " . $e->getMessage() . "</div>";
        }

        header("Location: router.php?page=categorias");
        exit;
    }
}
?>
