<?php
require_once 'models/Order.php';

class OrderController {

    // Mostrar todas las órdenes
    public function index() {
        $order = new Order();
        $ordenes = $order->getAllOrders();  // Obtener todas las órdenes
        include 'views/orders/listar.php';  // Mostrar la vista listar.php
    }

    // Crear nueva orden
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_id = $_POST['customer_id'];
            $total_amount = $_POST['total_amount'];

            $order = new Order();
            $order_id = $order->createOrder($customer_id, $total_amount);

            if ($order_id) {
                header("Location: router.php?page=orders"); // Redirige a la lista de órdenes
                exit();
            } else {
                echo "Error al crear la orden.";
            }
        } else {
            // Mostrar formulario de creación
            include 'views/orders/crear.php';
        }
    }

    // Eliminar orden
    public function eliminar() {
        if (isset($_GET['id'])) {
            $order_id = $_GET['id'];
            $order = new Order();
            $order->deleteOrder($order_id);  // Eliminar la orden
            header("Location: router.php?page=orders"); // Redirige a la lista de órdenes
            exit();
        }
    }

    // Anular orden
    public function anular() {
        if (isset($_GET['id'])) {
            $order_id = $_GET['id'];
            $order = new Order();
            $order->cancelOrder($order_id);  // Anular la orden
            header("Location: router.php?page=orders"); // Redirige a la lista de órdenes
            exit();
        }
    }
}
?>
