<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow">
        <div class="card-header bg-dark text-white text-center">
            <h4 class="mb-0">👤 Mi Perfil</h4>
        </div>

        <div class="card-body">
            <form action="router.php?page=perfil&action=actualizar" method="POST">
                <div class="mb-3">
                    <label class="form-label">Nombre de Usuario</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($data['usuario']) ?>" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($data['email']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rol</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($data['role']) ?>" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nueva Contraseña (opcional)</label>
                    <input type="password" name="password" class="form-control" placeholder="Deja en blanco para mantener la actual">
                </div>

                <div class="text-end">
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Actualizar Perfil</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
