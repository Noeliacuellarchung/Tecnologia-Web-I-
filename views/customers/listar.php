<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>👥 Lista de Clientes - Bike Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f3f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .container {
            flex: 1;
            max-width: 1200px;
            padding-top: 30px;
        }

        h2 {
            font-weight: 700;
            color: #343a40;
            text-align: center;
        }

        .btn-custom {
            font-weight: 600;
            padding: 12px 22px;
            background-color: #0dcaf0;
            border-radius: 5px;
            color: white;
            box-shadow: 0 4px 10px rgba(13,202,240,0.2);
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0bb8da;
            transform: scale(1.05);
        }

        .btn-primary {
            background-color: #007bff;
        }

        /* Estilos para el filtro */
        .filter-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 30px;
        }

        .filter-container .search-wrapper {
            max-width: 350px;
        }

        .search-wrapper {
            position: relative;
            width: 100%;
        }

        .search-wrapper input {
            width: 100%;
            height: 45px;
            padding-left: 35px;
            border-radius: 25px;
            font-size: 1rem;
            border: 2px solid #ced4da;
            background-color: #fff;
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
        }

        .search-wrapper i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        /* Estilo de la tabla */
        .table {
            border-radius: 10px;
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-collapse: separate;
            border-spacing: 0 15px;
        }

        .table thead {
            background: #0dcaf0;
            color: white;
            font-weight: bold;
        }

        .table tbody tr:hover {
            background-color: #f1f8ff;
        }

        .table th, .table td {
            vertical-align: middle;
            padding: 15px;
            border-radius: 5px;
        }

        .table td {
            background-color: white;
        }

        .action-buttons a {
            margin-right: 10px;
            padding: 8px 16px;
            font-size: 1rem;
            transition: transform 0.3s ease;
        }

        .action-buttons a:hover {
            transform: scale(1.1);
        }

        footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 15px;
            border-top: 1px solid #dee2e6;
            color: #6c757d;
            font-size: 0.9rem;
        }

        footer strong { color: #0dcaf0; }

        .back-btn {
            background-color: #ff7f50;
            color: white;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(255,127,80,0.3);
        }

        .back-btn:hover {
            background-color: #e76a3e;
            transform: scale(1.05);
        }

        .action-buttons-container {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            justify-content: flex-start;
        }

        /* Los botones estarán más cerca de la tabla */
        .filter-container {
            margin-bottom: 30px;
        }

    </style>
</head>
<body>
    <!-- 🔹 Filtro y Botón Volver -->
    <div class="container mt-5">
        <h2>Clientes</h2>

        <!-- Botones alineados abajo de la tabla -->
        <div class="action-buttons-container">
            <a href="index.php" class="back-btn">Volver al Inicio</a>
            <a href="router.php?page=customers&action=crear" class="btn btn-custom">Nuevo Cliente</a>
        </div>

        <!-- Filtro al costado de los botones -->
        <div class="filter-container">
            <div class="search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" id="searchInput" placeholder="Buscar por ID, Nombre o Teléfono" />
            </div>
        </div>

        <table class="table table-bordered" id="clientesTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($clientes)) : ?>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= $cliente['customer_id'] ?></td>
                            <td><?= $cliente['first_name'] ?></td>
                            <td><?= $cliente['last_name'] ?></td>
                            <td><?= $cliente['email'] ?></td>
                            <td><?= $cliente['phone'] ?></td>
                            <td class="action-buttons">
                                <a href="router.php?page=customers&action=editar&id=<?= $cliente['customer_id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="router.php?page=customers&action=eliminar&id=<?= $cliente['customer_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este cliente?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No se encontraron clientes</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <footer>
        <p>Desarrollado por <strong>Noelia Chung</strong> © <?= date("Y") ?> | Ingeniería en Sistemas 💻</p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const input = document.getElementById("searchInput");
            const table = document.getElementById("clientesTable");

            if (!input || !table) return;

            input.addEventListener("input", () => {
                const filter = input.value.trim().toLowerCase();
                const rows = table.querySelectorAll("tbody tr");

                rows.forEach(row => {
                    const id = row.cells[0].textContent.toLowerCase();
                    const nombre = row.cells[1].textContent.toLowerCase();
                    const telefono = row.cells[4].textContent.toLowerCase();

                    if (
                        id.includes(filter) ||
                        nombre.includes(filter) ||
                        telefono.includes(filter)
                    ) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });
    </script>

</body>
</html>
