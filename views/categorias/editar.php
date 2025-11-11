<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>✏️ Editar Categoría - Bike Store</title>
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
            max-width: 600px;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card-header {
            background: linear-gradient(90deg, #ffc107, #ffcd39);
            color: #212529;
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

        .form-control {
            border-radius: 10px;
            height: 48px;
            border: 2px solid #dee2e6;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 10px rgba(255,193,7,0.3);
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

        .btn-warning-custom {
            background: linear-gradient(90deg, #ffc107, #ffcd39);
            border: none;
            color: #212529;
        }

        .btn-warning-custom:hover {
            background: linear-gradient(90deg, #ffcd39, #ffe066);
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
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <h4><i class="bi bi-pencil-square"></i> Editar Categoría</h4>
    </div>

    <div class="card-body">
        <form action="router.php?page=categorias&action=editar" method="POST">
            <input type="hidden" name="category_id" value="<?= $data['category_id'] ?>">

            <div class="mb-4">
                <label class="form-label">Descripción</label>
                <input type="text" name="descripcion" class="form-control" 
                       value="<?= htmlspecialchars($data['descripcion']) ?>" required>
            </div>

            <div class="text-end">
                <a href="router.php?page=categorias" class="btn btn-secondary-custom btn-custom me-2">
                    <i class="bi bi-arrow-left"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-warning-custom btn-custom">
                    <i class="bi bi-check-circle"></i> Actualizar Categoría
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
