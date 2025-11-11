<?php
require_once "config/database.php";

class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public $user_id;
    public $usuario;
    public $password;
    public $email;
    public $role;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Verificar si existe un usuario
    public function verificarExistenciaUsuario($usuario) {
        $query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE usuario = :usuario";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Crear usuario (con contraseña encriptada)
    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " (usuario, password, email, role)
                  VALUES (:usuario, :password, :email, :role)";
        $stmt = $this->conn->prepare($query);

        // 🔒 Encriptar contraseña aquí
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(":usuario", $this->usuario);
        $stmt->bindParam(":password", $hashedPassword);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":role", $this->role);

        return $stmt->execute();
    }

    // Listar usuarios
    public function listar() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY user_id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Obtener usuario por ID
    public function obtenerPorId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar usuario
    public function actualizar() {
        if (!empty($this->password)) {
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $query = "UPDATE " . $this->table_name . "
                      SET usuario = :usuario, password = :password, email = :email, role = :role
                      WHERE user_id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":password", $hashedPassword);
        } else {
            $query = "UPDATE " . $this->table_name . "
                      SET usuario = :usuario, email = :email, role = :role
                      WHERE user_id = :id";
            $stmt = $this->conn->prepare($query);
        }

        $stmt->bindParam(":usuario", $this->usuario);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":role", $this->role);
        $stmt->bindParam(":id", $this->user_id);
        return $stmt->execute();
    }

    // Eliminar usuario
    public function eliminar($id) {
    // Eliminar el usuario
    $query = "DELETE FROM " . $this->table_name . " WHERE user_id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    
    // Reiniciar el AUTO_INCREMENT para la tabla de usuarios
    $resetQuery = "ALTER TABLE " . $this->table_name . " AUTO_INCREMENT = 1";
    $this->conn->exec($resetQuery);

    return true;
}

}
?>
