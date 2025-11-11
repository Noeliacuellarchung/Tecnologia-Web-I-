<?php
require_once "models/Producto.php";

class ProductoController {

    public function index() {
        $producto = new Producto();
        $stmt = $producto->listar();
        include "views/productos/listar.php";
    }

    public function crear() {
        // ✅ Permitir crear si el usuario es 'admin' o 'user'
        if ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'user') {
            die("<div style='padding:20px; color:red; font-weight:bold;'>🚫 Acceso denegado. No tienes permisos para crear productos.</div>");
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $producto = new Producto();
            $producto->product_name = $_POST['product_name'];
            $producto->model_year = $_POST['model_year'];
            $producto->price = $_POST['price'];
            $producto->category_id = $_POST['category_id'];

            // ✅ Subir imagen si existe
            if (!empty($_FILES['foto']['name'])) {
                $nombreArchivo = time() . "_" . basename($_FILES['foto']['name']);
                $rutaTemporal = $_FILES['foto']['tmp_name'];
                $destino = "assets/uploads/" . $nombreArchivo;
                if (move_uploaded_file($rutaTemporal, $destino)) {
                    $producto->imagen = $destino;
                } else {
                    $producto->imagen = null;
                }
            } else {
                $producto->imagen = null;
            }

            $producto->crear();
            header("Location: router.php?page=productos");
        } else {
            include "views/productos/crear.php";
        }
    }

    public function editar() {
        // ❌ Solo los administradores pueden editar
        if ($_SESSION['role'] !== 'admin') {
            die("<div style='padding:20px; color:red; font-weight:bold;'>🚫 Solo los administradores pueden editar productos.</div>");
        }

        $producto = new Producto();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $producto->product_id = $_POST['product_id'];
            $producto->product_name = $_POST['product_name'];
            $producto->model_year = $_POST['model_year'];
            $producto->price = $_POST['price'];
            $producto->category_id = $_POST['category_id'];

            // ✅ Imagen actualizada o conservada
            if (!empty($_FILES['foto']['name'])) {
                $nombreArchivo = time() . "_" . basename($_FILES['foto']['name']);
                $rutaTemporal = $_FILES['foto']['tmp_name'];
                $destino = "assets/uploads/" . $nombreArchivo;
                move_uploaded_file($rutaTemporal, $destino);
                $producto->imagen = $destino;
            } else {
                $productoActual = $producto->obtenerPorId($_POST['product_id']);
                $producto->imagen = $productoActual['imagen'];
            }

            $producto->actualizar();
            header("Location: router.php?page=productos");
        } else {
            $id = $_GET['id'];
            $data = $producto->obtenerPorId($id);
            include "views/productos/editar.php";
        }
    }

    public function eliminar() {
        // ❌ Solo los administradores pueden eliminar
        if ($_SESSION['role'] !== 'admin') {
            die("<div style='padding:20px; color:red; font-weight:bold;'>🚫 Solo los administradores pueden eliminar productos.</div>");
        }

        $id = $_GET['id'];
        $producto = new Producto();
        $producto->eliminar($id);

        $db = new Database();
        $conn = $db->getConnection();
        $query = "ALTER TABLE productos AUTO_INCREMENT = 1";
        $conn->exec($query);

        header("Location: router.php?page=productos");
    }
}
?>
