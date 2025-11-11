<?php
session_start();
require_once "config/database.php";  // Conexión a la base de datos

// Si ya está logueado, redirigir al index
if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

// Si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario  = trim($_POST['usuario'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $db   = new Database();
    $conn = $db->getConnection();

    // Obtener el usuario desde la base de datos
    $query = "SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":usuario", $usuario);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el usuario existe y la contraseña es correcta
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_id'] = $user['user_id'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Bike Store</title>

<!-- Bootstrap y iconos -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Enlace al CSS externo -->
<link href="assets/css/login.css" rel="stylesheet">
</head>
<body>

<div class="login-card">
    <h3>LOGIN</h3>

    <?php if (!empty($error)) { ?>
        <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php } ?>

    <form method="POST" action="">
        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
        </div>
        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember">
            <label for="remember" class="form-check-label">Recordarme</label>
        </div>

        <button type="submit" class="btn btn-login">Iniciar Sesión</button>
    </form>
</div>

</body>
</html>
