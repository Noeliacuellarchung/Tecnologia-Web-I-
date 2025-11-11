<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">➕ Registrar Nuevo Usuario</h4>
        </div>

        <div class="card-body">
            <form action="router.php?page=usuarios&action=crear" method="POST">

                <div class="mb-3">
                    <label class="form-label">Nombre de Usuario</label>
                    <input type="text" name="usuario" class="form-control" placeholder="Ejemplo: juan123" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="********" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" placeholder="usuario@correo.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rol</label>
                    <select name="role" class="form-select" required>
                        <option value="">Seleccione un rol</option>
                        <option value="admin">Administrador</option>
                        <option value="user">Usuario</option>
                    </select>
                </div>

                <div class="text-end">
                    <a href="router.php?page=usuarios" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
