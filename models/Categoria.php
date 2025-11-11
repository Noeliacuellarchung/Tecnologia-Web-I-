<?php
require_once "config/database.php";

class Categoria {
    private $conn;
    private $table_name = "categorias";

    public $category_id;
    public $descripcion;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Crear nueva categoría
    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " (descripcion) VALUES (:descripcion)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":descripcion", $this->descripcion);
        return $stmt->execute();
    }

    // Listar todas las categorías
    public function listar() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY category_id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Obtener una categoría por ID
    public function obtenerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE category_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar categoría
    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " SET descripcion = :descripcion WHERE category_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":id", $this->category_id);
        return $stmt->execute();
    }

    // Eliminar categoría
    public function eliminar($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE category_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
