<?php
require_once 'config/database.php';

class Customer {
    private $conn;
    private $table = 'customers';

    public $customer_id;
    public $first_name;
    public $last_name;
    public $imagen;
    public $phone;
    public $email;
    public $street;
    public $city;
    public $state;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Listar todos los clientes
    public function listar() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY customer_id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Crear un nuevo cliente
    public function crear() {
        $query = "INSERT INTO " . $this->table . " (first_name, last_name, imagen, phone, email, street, city, state) 
                  VALUES (:first_name, :last_name, :imagen, :phone, :email, :street, :city, :state)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":imagen", $this->imagen);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":street", $this->street);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":state", $this->state);

        return $stmt->execute();
    }

    // Obtener un cliente por ID
    public function obtenerPorId($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE customer_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un cliente
    public function actualizar() {
        $query = "UPDATE " . $this->table . " SET
            first_name = :first_name,
            last_name = :last_name,
            imagen = :imagen,
            phone = :phone,
            email = :email,
            street = :street,
            city = :city,
            state = :state
            WHERE customer_id = :id";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":imagen", $this->imagen);
        $stmt->bindParam(":phone", $this->phone);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":street", $this->street);
        $stmt->bindParam(":city", $this->city);
        $stmt->bindParam(":state", $this->state);
        $stmt->bindParam(":id", $this->customer_id);

        return $stmt->execute();
    }

    // Eliminar un cliente
    public function eliminar($id) {
        $query = "DELETE FROM " . $this->table . " WHERE customer_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
