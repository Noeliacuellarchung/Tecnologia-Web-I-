<?php
require_once "config/database.php";

class Producto {
    private $conn;
    private $table_name = "productos";

    public $product_id;
    public $product_name;
    public $imagen;
    public $model_year;
    public $price;
    public $category_id;

    public function __construct() { 
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function crear() {
        $query = "INSERT INTO " . $this->table_name . "
                  (product_name, model_year, price, category_id, imagen)
                  VALUES (:product_name, :model_year, :price, :category_id, :imagen)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":product_name", $this->product_name);
        $stmt->bindParam(":model_year", $this->model_year);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":imagen", $this->imagen);
        return $stmt->execute();
    }

    public function listar() {
        $query = "SELECT p.*, c.descripcion AS categoria
                  FROM " . $this->table_name . " p
                  LEFT JOIN categorias c ON p.category_id = c.category_id
                  ORDER BY p.product_id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function obtenerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE product_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar() {
        $query = "UPDATE " . $this->table_name . "
                  SET product_name=:product_name, model_year=:model_year,
                      price=:price, category_id=:category_id, imagen=:imagen
                  WHERE product_id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":product_name", $this->product_name);
        $stmt->bindParam(":model_year", $this->model_year);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":imagen", $this->imagen);
        $stmt->bindParam(":id", $this->product_id);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE product_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
