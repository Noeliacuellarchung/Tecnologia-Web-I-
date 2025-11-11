<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>➕ Nuevo Producto - Bike Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #eef3ff 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 10px;
        }

        .card {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            animation: fadeInUp 0.8s ease;
            width: 100%;
            max-width: 650px;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card-header {
            background: linear-gradient(90deg, #0d6efd, #0b5ed7);
            color: white;
            text-align: center;
            padding: 20px;
        }

        .card-header h4 {
            margin: 0;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .card-body {
            background: #fff;
            padding: 35px;
            border-radius: 0 0 20px 20px;
        }

        /* Campos */
        .form-label {
            font-weight: 600;
            color: #1e2a3a;
        }

        .form-control, .form-select {
            border-radius: 10px;
            height: 48px;
            border: 2px solid #dee2e6;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 10px rgba(13,110,253,0.25);
            transform: scale(1.02);
        }

        /* Botones */
        .btn-custom {
            border-radius: 10px;
            font-weight: 600;
            padding: 12px 20px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .btn-success-custom {
            background: #0d6efd;
            border: none;
            color: #fff;
        }

        .btn-success-custom:hover {
            background: #0b5ed7;
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(13,110,253,0.35);
        }

        .btn-secondary-custom {
            background-color: #6c757d;
            border: none;
            color: white;
        }

        .btn-secondary-custom:hover {
            background-color: #5c636a;
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        }

        small.text-muted {
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <h4><i class="bi bi-plus-circle"></i> Registrar Nuevo Producto</h4>
    </div>

    <div class="card-body">
        <form action="router.php?page=productos&action=crear" method="POST" enctype="multipart/form-data">

            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Nombre del Producto</label>
                <input type="text" name="product_name" class="form-control" placeholder="Ej: Bicicleta de montaña" required>
            </div>

            <!-- Año -->
            <div class="mb-3">
                <label class="form-label">Año del Modelo</label>
                <input type="number" name="model_year" class="form-control" placeholder="Ej: 2025" min="1900" max="2099" required>
            </div>

            <!-- Precio -->
            <div class="mb-3">
                <label class="form-label">Precio (Bs)</label>
                <input type="number" step="0.01" name="price" class="form-control" placeholder="Ej: 1500.00" required>
            </div>

            <!-- Categoría -->
            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Seleccione una categoría</option>
                    <?php
                    require_once "config/database.php";
                    $db = new Database();
                    $conn = $db->getConnection();
                    $query = $conn->query("SELECT * FROM categorias");
                    while ($cat = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$cat['category_id']}'>{$cat['descripcion']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Foto -->
            <div class="mb-4">
                <label class="form-label">Foto del Producto</label>
                <input type="file" name="foto" class="form-control" accept="image/*" required>
                <small class="text-muted">Seleccione una imagen del producto (formatos .jpg, .png, .jpeg)</small>
            </div>

            <!-- Botones -->
            <div class="text-end">
                <a href="router.php?page=productos" class="btn btn-secondary-custom btn-custom me-2">
                    <i class="bi bi-arrow-left"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-success-custom btn-custom">
                    <i class="bi bi-check-circle"></i> Guardar Producto
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
