<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>👥 Lista de Usuarios - Bike Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #eef3ff 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
        }

        h2 {
            font-weight: 700;
            color: #212529;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }

        /* Tarjeta de la tabla */
        .card {
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            animation: fadeIn 0.8s ease;
            overflow: hidden;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Botones */
        .btn-custom {
            border-radius: 10px;
            font-weight: 500;
            padding: 8px 14px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: scale(1.05);
        }

        .btn-new {
            font-size: 1rem;
        }

        /* Filtro de búsqueda */
        .search-box {
            position: relative;
            max-width: 350px;
            margin-left: auto;
            margin-bottom: 15px;
        }

        .search-box input {
            height: 46px;
            border-radius: 12px;
            padding-left: 40px;
            border: 2px solid #dee2e6;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 10px rgba(13,110,253,0.3);
            transform: scale(1.03);
        }

        .search-box i {
            position: absolute;
            top: 12px;
            left: 12px;
            color: #6c757d;
        }
/* ===== TABLA ===== */
        .table {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 6px 25px rgba(0,0,0,0.08);
        }

        .table thead {
            background: linear-gradient(90deg, #0d6efd 0%, #0b5ed7 100%);
            color: #fff;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #e8f0ffff;
            transform: scale(1.01);
        }

        /* Pie de página */
        footer {
            background-color: #212529;
            color: #fff;
            text-align: center;
            padding: 15px;
            font-size: 0.9rem;
            margin-top: auto;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">👥 Lista de Usuarios</h2>

    <!-- Botón de nuevo usuario y volver al inicio -->
    <div class="d-flex justify-content-between mb-3">
        <div>
            <a href="router.php?page=usuarios&action=crear" class="btn btn-primary btn-custom btn-new">
                <i class="bi bi-person-plus-fill"></i> Nuevo Usuario
            </a>
        </div>
        <div>
            <a href="index.php" class="btn btn-secondary btn-custom btn-new">
                <i class="bi bi-house-door"></i> Volver al Inicio
            </a>
        </div>
    </div>

    <!-- Buscador -->
    <div class="search-box mb-2">
        <i class="bi bi-search"></i>
        <input type="text" id="searchInput" class="form-control" placeholder="Buscar por ID o Usuario...">
    </div>

    <!-- Tabla -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="userTable">
                <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= $row['user_id'] ?></td>
                    <td><?= htmlspecialchars($row['usuario']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td>
                        <?php if ($row['role'] == 'admin'): ?>
                            <span class="badge bg-danger">Administrador</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Usuario</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="router.php?page=usuarios&action=editar&id=<?= $row['user_id'] ?>" class="btn btn-warning btn-sm btn-custom">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <a href="router.php?page=usuarios&action=eliminar&id=<?= $row['user_id'] ?>"
                           class="btn btn-danger btn-sm btn-custom"
                           onclick="return confirm('¿Seguro que deseas eliminar este usuario?');">
                           <i class="bi bi-trash"></i> Eliminar
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Footer -->
<footer>
    Desarrollado por <strong>Noelia Chung</strong> © <?= date("Y") ?> | Ingeniería en Sistemas 💻
</footer>

<script>
// Filtro dinámico (por ID o nombre)
document.getElementById("searchInput").addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#userTable tr");
    rows.forEach(row => {
        let id = row.cells[0].textContent.toLowerCase();
        let nombre = row.cells[1].textContent.toLowerCase();
        row.style.display = (id.includes(filter) || nombre.includes(filter)) ? "" : "none";
    });
});
</script>

</body>
</html>
