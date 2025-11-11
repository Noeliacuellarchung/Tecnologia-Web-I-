<?php
require_once 'config/database.php';

class Order {
    private $conn;

    public $order_id;
    public $customer_id;
    public $order_date;
    public $status;
    public $total_amount;

    // Constructor
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Crear nueva orden
    public function createOrder($customer_id, $total_amount) {
        $query = "INSERT INTO orders (customer_id, order_date, estado, total_amount) 
                  VALUES (?, NOW(), 'Pendiente', ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $customer_id);
        $stmt->bindParam(2, $total_amount);
        if ($stmt->execute()) {
            return $this->conn->lastInsertId(); // Retorna el ID de la nueva orden
        } else {
            return false;
        }
    }

    // Obtener todas las órdenes
    public function getAllOrders() {
        $query = "SELECT o.order_id, CONCAT(c.first_name, ' ', c.last_name) AS cliente, 
                         o.order_date, o.estado, o.total_amount
                  FROM orders o 
                  JOIN customers c ON o.customer_id = c.customer_id
                  ORDER BY o.order_id DESC";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Eliminar orden
    public function deleteOrder($order_id) {
        $query = "DELETE FROM order_items WHERE order_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$order_id]);

        $query = "DELETE FROM orders WHERE order_id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$order_id]);
    }

    // Anular orden
    public function cancelOrder($order_id) {
        $query = "UPDATE orders SET estado = 'Anulado' WHERE order_id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$order_id]);
    }
}
?>
