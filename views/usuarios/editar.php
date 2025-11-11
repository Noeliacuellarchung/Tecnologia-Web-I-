<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>✏️ Editar Usuario - Bike Store</title>
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

    main {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 10px;
    }

    .card {
      width: 100%;
      max-width: 600px;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      animation: fadeIn 0.8s ease;
      overflow: hidden;
      background: #fff;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .card-header {
      background: linear-gradient(90deg, #ffc107 0%, #ffca2c 100%);
      border: none;
      text-align: center;
      padding: 18px;
    }

    .card-header h4 {
      margin: 0;
      font-weight: 700;
      color: #212529;
    }

    .form-label {
      font-weight: 600;
      color: #212529;
    }

    .form-control, .form-select {
      border-radius: 10px;
      height: 45px;
      transition: 0.3s ease;
      border: 2px solid #e2e8f0;
    }

    .form-control:focus, .form-select:focus {
      border-color: #ffc107;
      box-shadow: 0 0 8px rgba(255,193,7,0.4);
      transform: scale(1.02);
    }

    .btn {
      border-radius: 10px;
      font-weight: 500;
      padding: 10px 18px;
      transition: all 0.3s ease;
    }

    .btn:hover {
      transform: scale(1.05);
    }

    .btn-secondary {
      background-color: #6c757d;
      border: none;
    }

    .btn-warning {
      background-color: #ffc107;
      color: #212529;
      border: none;
    }

    .btn-warning:hover {
      background-color: #ffca2c;
    }

    footer {
      background-color: #212529;
      color: #fff;
      text-align: center;
      padding: 15px 0;
      font-size: 0.9rem;
      margin-top: auto;
    }
  </style>
</head>

<body>

  <main>
    <div class="card">
      <div class="card-header">
        <h4><i class="bi bi-pencil-square"></i> Editar Usuario</h4>
      </div>

      <div class="card-body">
        <form action="router.php?page=usuarios&action=editar" method="POST">
          <input type="hidden" name="user_id" value="<?= $data['user_id'] ?>">

          <div class="mb-3">
            <label class="form-label">Nombre de Usuario</label>
            <input type="text" name="usuario" class="form-control"
                   value="<?= htmlspecialchars($data['usuario']) ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Correo Electrónico</label>
            <input type="email" name="email" class="form-control"
                   value="<?= htmlspecialchars($data['email']) ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Nueva Contraseña (opcional)</label>
            <input type="password" name="password" class="form-control" placeholder="Déjalo vacío para no cambiar">
          </div>

          <div class="mb-3">
            <label class="form-label">Rol</label>
            <select name="role" class="form-select" required>
              <option value="admin" <?= ($data['role'] == 'admin') ? 'selected' : '' ?>>Administrador</option>
              <option value="user" <?= ($data['role'] == 'user') ? 'selected' : '' ?>>Usuario</option>
            </select>
          </div>

          <div class="text-end">
            <a href="router.php?page=usuarios" class="btn btn-secondary me-2">
              <i class="bi bi-x-circle"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-warning">
              <i class="bi bi-save"></i> Actualizar Usuario
            </button>
          </div>
        </form>
      </div>
    </div>
  </main>

  <footer>
    Desarrollado por <strong>Noelia Chung</strong> © <?= date("Y") ?> | Ingeniería en Sistemas 💻
  </footer>

</body>
</html>
