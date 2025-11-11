<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>➕ Registrar Cliente</title>
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

        .card {
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-top: 60px;
        }

        .card-header {
            background-color: #0d6efd;
            color: white;
            font-weight: bold;
        }

        .btn-custom {
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: scale(1.05);
        }

        footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 15px;
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: auto;
        }

        footer strong {
            color: #0d6efd;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card mx-auto" style="max-width: 700px;">
        <div class="card-header">
            <h4 class="mb-0"><i class="bi bi-person-plus-fill"></i> Registrar Nuevo Cliente</h4>
        </div>
        <div class="card-body">
            <form action="router.php?page=customers&action=crear" method="POST" enctype="multipart/form-data">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Apellido</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input type="text" name="phone" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ciudad</label>
                        <input type="text" name="city" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Estado</label>
                        <input type="text" name="state" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Dirección</label>
                    <input type="text" name="street" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input type="file" name="imagen" class="form-control" accept="image/*">
                </div>

                <div class="text-end">
                    <a href="router.php?page=customers" class="btn btn-secondary btn-custom">
                        <i class="bi bi-arrow-left-circle"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary btn-custom">
                        <i class="bi bi-save"></i> Guardar Cliente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<footer>
    Desarrollado por <strong>Noelia Chung</strong> © <?= date("Y") ?> | Ingeniería en Sistemas 💻
</footer>

</body>
</html>
