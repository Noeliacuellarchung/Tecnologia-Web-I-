<?php
require_once 'models/Customer.php';

class CustomersController {

    // Mostrar todos los clientes
    public function index() {
        $customer = new Customer();
        $stmt = $customer->listar();  // Llamamos al modelo para listar los clientes
        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Obtenemos todos los resultados

        // Mostrar la vista con la lista de clientes
        include "views/customers/listar.php";
    }

    // Crear un nuevo cliente
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer = new Customer();
            $customer->first_name = $_POST['first_name'];
            $customer->last_name  = $_POST['last_name'];
            $customer->imagen     = $_POST['imagen'];
            $customer->phone      = $_POST['phone'];
            $customer->email      = $_POST['email'];
            $customer->street     = $_POST['street'];
            $customer->city       = $_POST['city'];
            $customer->state      = $_POST['state'];

            if ($customer->crear()) {
                header("Location: router.php?page=customers");
                exit;
            } else {
                echo "<h3>Error al crear el cliente</h3>";
            }
        } else {
            // Mostrar el formulario para crear un cliente
            include "views/customers/crear.php";
        }
    }

    // Editar un cliente
    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer = new Customer();
            $customer->customer_id = $_POST['customer_id'];
            $customer->first_name = $_POST['first_name'];
            $customer->last_name  = $_POST['last_name'];
            $customer->imagen     = $_POST['imagen'];
            $customer->phone      = $_POST['phone'];
            $customer->email      = $_POST['email'];
            $customer->street     = $_POST['street'];
            $customer->city       = $_POST['city'];
            $customer->state      = $_POST['state'];

            if ($customer->actualizar()) {
                header("Location: router.php?page=customers");
                exit;
            } else {
                echo "<h3>Error al actualizar el cliente</h3>";
            }
        } else {
            // Obtener el cliente a editar
            $id = $_GET['id'];
            $customer = new Customer();
            $cliente = $customer->obtenerPorId($id);

            // Mostrar el formulario de edición
            include "views/customers/editar.php";
        }
    }

    // Eliminar un cliente
    public function eliminar() {
        $id = $_GET['id'];
        $customer = new Customer();
        if ($customer->eliminar($id)) {
            header("Location: router.php?page=customers");
            exit;
        } else {
            echo "<h3>Error al eliminar el cliente</h3>";
        }
    }
}
?>
