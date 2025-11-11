<?php
$password = "123456";  // Contraseña en texto plano
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo "Contraseña encriptada: " . $hashedPassword;
?>
