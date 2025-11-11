<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>✏️ Editar Producto - Bike Store</title>
    <!-- Bootstrap 5 -->
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

        /* Imagen */
        .image-preview {
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 8px;
            background-color: #f8f9fa;
            transition: transform 0.3s ease;
        }

        .image-preview:hover {
            transform: scale(1.05);
        }

        /* Botones */
        .btn-custom {
            border-radius: 10px;
            font-weight: 600;
            padding: 12px 20px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .btn-warning-custom {
            background: #ffc107;
            border: none;
            color: #212529;
        }

        .btn-warning-custom:hover {
            background: #ffb300;
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(255,193,7,0.4);
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

        /* Texto pequeño */
        small.text-muted {
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <h4><i class="bi bi-pencil-square"></i> Editar Producto</h4>
    </div>

    <div class="card-body">
        <form action="router.php?page=productos&action=editar" method="POST" enctype="multipart/form-data">
            <!-- ID oculto -->
            <input type="hidden" name="product_id" value="<?= $data['product_id'] ?>">

            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Nombre del Producto</label>
                <input type="text" name="product_name" class="form-control" 
                       value="<?= htmlspecialchars($data['product_name']) ?>" required>
            </div>

            <!-- Año -->
            <div class="mb-3">
                <label class="form-label">Año del Modelo</label>
                <input type="number" name="model_year" class="form-control" 
                       value="<?= $data['model_year'] ?>" min="1900" max="2099" required>
            </div>

            <!-- Precio -->
            <div class="mb-3">
                <label class="form-label">Precio (Bs)</label>
                <input type="number" step="0.01" name="price" class="form-control"
                       value="<?= $data['price'] ?>" required>
            </div>

            <!-- Categoría -->
            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select name="category_id" class="form-select" required>
                    <?php
                    require_once "config/database.php";
                    $db = new Database();
                    $conn = $db->getConnection();
                    $query = $conn->query("SELECT * FROM categorias");
                    while ($cat = $query->fetch(PDO::FETCH_ASSOC)) {
                        $selected = ($cat['category_id'] == $data['category_id']) ? "selected" : "";
                        echo "<option value='{$cat['category_id']}' $selected>{$cat['descripcion']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Foto -->
            <div class="mb-4">
                <label class="form-label">Foto Actual</label><br>
                <?php if (!empty($data['imagen'])) { ?>
                    <div class="image-preview mb-2 text-center">
                        <img src="<?= $data['imagen'] ?>" width="120" class="rounded">
                    </div>
                <?php } else { ?>
                    <span class="text-muted">Sin imagen</span><br>
                <?php } ?>
                <input type="file" name="foto" class="form-control" accept="image/*">
                <small class="text-muted">Si no seleccionas una nueva foto, se mantendrá la actual.</small>
            </div>

            <!-- Botones -->
            <div class="text-end">
                <a href="router.php?page=productos" class="btn btn-secondary-custom btn-custom me-2">
                    <i class="bi bi-arrow-left"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-warning-custom btn-custom">
                    <i class="bi bi-check-circle"></i> Actualizar Producto
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
