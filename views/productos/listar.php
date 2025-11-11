<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>📦 Lista de Productos - Bike Store</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* ===== GENERAL ===== */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #eef3ff 100%);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            font-weight: 700;
            color: #1e2a3a;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .container {
            flex: 1;
            animation: fadeIn 1s ease;
        }

        /* ===== BOTONES ===== */
        .btn-custom {
            border-radius: 10px;
            font-weight: 600;
            padding: 12px 22px;
            transition: all 0.3s ease;
            background-color: #0d6efd;
            border: none;
            color: white;
            box-shadow: 0 4px 10px rgba(13,110,253,0.2);
        }

        .btn-custom i {
            margin-right: 6px;
        }

        .btn-custom:hover {
            background-color: #0b5ed7;
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(13,110,253,0.3);
        }

        .btn-secondary-custom {
            background-color: #6c757d;
            border: none;
            color: white;
        }

        /* ===== BUSCADOR ===== */
        .filter-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.8rem;
            gap: 10px;
        }

        .search-wrapper {
            position: relative;
            width: 370px;
            transition: all 0.3s ease;
        }

        .search-wrapper input {
            width: 100%;
            border-radius: 12px;
            height: 56px;
            padding-left: 45px;
            font-size: 1rem;
            border: 2px solid #ced4da;
            background-color: #fff;
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .search-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 1.2rem;
        }

        .search-wrapper:hover input {
            border-color: #0d6efd;
            transform: scale(1.02);
            box-shadow: 0 0 12px rgba(13,110,253,0.25);
        }

        .search-wrapper input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 15px rgba(13,110,253,0.3);
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
            background-color: #e8f0ff;
            transform: scale(1.01);
        }

        img.rounded {
            border: 2px solid #dee2e6;
            transition: transform 0.3s ease;
        }

        img.rounded:hover {
            transform: scale(1.25);
        }

        /* ===== BOTONES DE ACCIÓN ===== */
        .btn-action {
            font-size: 0.95rem;
            padding: 11px 18px;
            border-radius: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .btn-action:hover {
            transform: scale(1.08);
            filter: brightness(1.1);
        }

        /* ===== FOOTER ===== */
        footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 15px 10px;
            margin-top: auto;
            border-top: 1px solid #dee2e6;
            color: #6c757d;
            font-size: 0.9rem;
        }

        footer strong {
            color: #0d6efd;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4 text-center">📦 Lista de Productos</h2>

    <!-- 🔹 Botones + Buscador -->
    <div class="filter-container">
        <div>
            <a href="index.php" class="btn btn-custom">
                <i class="bi bi-house-door"></i> Volver al Inicio
            </a>

            <?php if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'user'): ?>
                <a href="router.php?page=productos&action=crear" class="btn btn-custom">
                    <i class="bi bi-plus-circle"></i> Nuevo Producto
                </a>
            <?php endif; ?>
        </div>

        <div class="search-wrapper">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar por ID o nombre...">
        </div>
    </div>

    <!-- 🔹 Tabla moderna -->
    <div class="table-responsive">
        <table class="table table-hover align-middle text-center bg-white" id="productosTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Año</th>
                    <th>Precio (Bs)</th>
                    <th>Categoría</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?= $row['product_id'] ?></td>
                    <td><?= htmlspecialchars($row['product_name']) ?></td>
                    <td><?= $row['model_year'] ?></td>
                    <td><?= number_format($row['price'], 2) ?></td>
                    <td><?= htmlspecialchars($row['categoria']) ?></td>
                    <td>
                        <?php if (!empty($row['imagen'])): ?>
                            <img src="<?= htmlspecialchars($row['imagen']) ?>" alt="foto" width="65" height="65" class="rounded">
                        <?php else: ?>
                            <span class="text-muted fst-italic">Sin imagen</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <a href="router.php?page=productos&action=editar&id=<?= $row['product_id'] ?>" class="btn btn-warning btn-action">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <a href="router.php?page=productos&action=eliminar&id=<?= $row['product_id'] ?>"
                               class="btn btn-danger btn-action"
                               onclick="return confirm('¿Seguro que deseas eliminar este producto?');">
                               <i class="bi bi-trash"></i> Eliminar
                            </a>
                        <?php else: ?>
                            <span class="text-muted fst-italic">Solo creación y lectura</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<footer>
    <p>Desarrollado por <strong>Noelia Chung</strong> © <?= date("Y") ?> | Ingeniería en Sistemas 💻</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- 🔹 Buscador dinámico -->
<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('#productosTable tbody tr');
    
    rows.forEach(row => {
        const id = row.cells[0].textContent.toLowerCase();
        const nombre = row.cells[1].textContent.toLowerCase();
        row.style.display = (id.includes(filter) || nombre.includes(filter)) ? '' : 'none';
    });
});
</script>

</body>
</html>
