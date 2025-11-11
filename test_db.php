<?php
require_once "config/database.php";

$database = new Database();
$conn = $database->getConnection();

if ($conn) {
    echo "<p>Todo funciona correctamente 👏</p>";
} else {
    echo "<p>Ocurrió un problema 😢</p>";
}
?>
