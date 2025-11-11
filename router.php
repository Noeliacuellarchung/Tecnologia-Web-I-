<?php
// Iniciar la sesión si no está activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Obtener parámetros desde la URL
$page = $_GET['page'] ?? 'productos';  // Si no se pasa "page", se establece "productos" por defecto
$action = $_GET['action'] ?? 'index';  // Si no se pasa "action", se establece "index" por defecto

// Determinar qué controlador usar
switch ($page) {
    case 'productos':
        require_once "controllers/ProductoController.php";
        $controller = new ProductoController();
        break;
    case 'categorias':
        require_once "controllers/CategoriaController.php";
        $controller = new CategoriaController();
        break;
    case 'usuarios':
        require_once "controllers/UsuarioController.php";
        $controller = new UsuarioController();
        break;
    case 'customers':
        require_once "controllers/CustomersController.php";  
        $controller = new CustomersController();
        break;
        

    case 'orders':
        require_once "controllers/OrderController.php";
        $controller = new OrderController();

        // Determinamos la acción que se debe realizar
        if ($action == 'crear') {
            $controller->crear();  
        } elseif ($action == 'eliminar') {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $controller->eliminar($id);  // Asegúrate de que el método 'eliminar' esté en OrderController
            } else {
                echo "<h3>ID de pedido no proporcionado.</h3>";
            }
        } elseif ($action == 'anular') {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $controller->anular($id);  // Asegúrate de que el método 'anular' esté en OrderController
            } else {
                echo "<h3>ID de pedido no proporcionado.</h3>";
            }
        } else {
            // Acción por defecto: listar órdenes
            $controller->index();  // Asegúrate de que el método 'index' esté en OrderController
        }
        break;

    // Otros casos...

    default:
        echo "<h2>Página no encontrada</h2>";
        exit;
}

// Llamar al método del controlador (acción)
if (method_exists($controller, $action)) {
    $controller->$action();  // Ejecuta la acción del controlador (ej. "index", "crear", "eliminar")
} else {
    echo "<h3>Acción '$action' no encontrada en el controlador '$page'.</h3>";
}
?>
