<?php
require_once "config/session_check.php"; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>🏪 Bike Store</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* Navbar */
    .navbar {
      box-shadow: 0 2px 10px rgba(0,0,0,0.15);
    }

    /* Animación de entrada general */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
      animation: fadeInUp 0.9s ease;
    }

    /* Tarjetas principales */
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.08);
      transition: all 0.3s ease;
      background-color: #fff;
      animation: fadeInUp 0.9s ease;
    }

    .card:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0 12px 25px rgba(0,0,0,0.15);
    }

    .card .fs-1 {
      transition: transform 0.3s ease;
    }
    .card:hover .fs-1 {
      transform: scale(1.15);
    }

    /* Footer */
    footer {
      background: #212529;
      color: #fff;
      text-align: center;
      padding: 20px 0;
      margin-top: auto;
      font-size: 0.9rem;
      letter-spacing: 0.3px;
      box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
    }

    /* Botones */
    .btn {
      border-radius: 10px;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    .btn:hover {
      transform: scale(1.05);
    }
  </style>
</head>
<body>

<!-- 🔹 Navbar -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold text-uppercase" href="index.php">
      <i class="bi bi-bicycle me-2"></i>Bike Store
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-lg-center">

        <li class="nav-item">
          <a class="nav-link" href="router.php?page=productos">
            <i class="bi bi-box-seam me-1"></i> Productos
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="router.php?page=categorias">
            <i class="bi bi-folder2-open me-1"></i> Categorías
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="router.php?page=customers">
            <i class="bi bi-person-vcard me-1"></i> Clientes
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="router.php?page=orders">
            <i class="bi bi-person-vcard me-1"></i> Order
          </a>
        </li>

        <?php if ($_SESSION['role'] === 'admin'): ?>
        <li class="nav-item">
          <a class="nav-link" href="router.php?page=usuarios">
            <i class="bi bi-people me-1"></i> Usuarios
          </a>
        </li>
        <?php endif; ?>

        <?php if (isset($_SESSION['usuario'])): ?>
        <li class="nav-item dropdown ms-2">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-bs-toggle="dropdown">
            👋 <?= htmlspecialchars($_SESSION['usuario']) ?> (<?= $_SESSION['role'] ?>)
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow">
            <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión</a></li>
          </ul>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- 🔹 Sección principal -->
<section class="py-5 flex-grow-1">
  <div class="container fade-in">
    <div class="text-center mb-5">
      <h1 class="fw-bold display-5 text-dark">Bienvenido a <span class="text-primary">Bike Store</span></h1>
      <p class="text-muted fs-5">Administra tus productos, categorías, clientes, órdenes y usuarios con estilo y facilidad 🚴‍♀️</p>
    </div>

    <!-- 🔹 Primera fila -->
    <div class="row justify-content-center g-4">
      <div class="col-md-4">
        <div class="card text-center py-4">
          <div class="card-body">
            <div class="fs-1 text-primary mb-3"><i class="bi bi-box-seam"></i></div>
            <h5 class="fw-bold mb-3">Gestión de Productos</h5>
            <p class="text-muted mb-4">Crea, edita o elimina productos fácilmente.</p>
            <a href="router.php?page=productos" class="btn btn-primary w-100">
              <i class="bi bi-arrow-right-circle me-1"></i> Ir a Productos
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card text-center py-4">
          <div class="card-body">
            <div class="fs-1 text-success mb-3"><i class="bi bi-folder2-open"></i></div>
            <h5 class="fw-bold mb-3">Gestión de Categorías</h5>
            <p class="text-muted mb-4">Administra las categorías de tus productos.</p>
            <a href="router.php?page=categorias" class="btn btn-success w-100">
              <i class="bi bi-arrow-right-circle me-1"></i> Ir a Categorías
            </a>
          </div>
        </div>
      </div>

      <?php if ($_SESSION['role'] === 'admin'): ?>
      <div class="col-md-4">
        <div class="card text-center py-4">
          <div class="card-body">
            <div class="fs-1 text-warning mb-3"><i class="bi bi-people"></i></div>
            <h5 class="fw-bold mb-3">Gestión de Usuarios</h5>
            <p class="text-muted mb-4">Accede al control completo de tus usuarios.</p>
            <a href="router.php?page=usuarios" class="btn btn-warning w-100">
              <i class="bi bi-arrow-right-circle me-1"></i> Ir a Usuarios
            </a>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>

    <!-- 🔹 Segunda fila -->
    <div class="row justify-content-center g-4 mt-4">
      <div class="col-md-4">
        <div class="card text-center py-4">
          <div class="card-body">
            <div class="fs-1 text-info mb-3"><i class="bi bi-person-vcard"></i></div>
            <h5 class="fw-bold mb-3">Gestión de Clientes</h5>
            <p class="text-muted mb-4">Registra y consulta la información de tus clientes.</p>
            <a href="router.php?page=customers" class="btn btn-info text-white w-100">
              <i class="bi bi-arrow-right-circle me-1"></i> Ir a Clientes
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card text-center py-4">
          <div class="card-body">
            <div class="fs-1" style="color:#6610f2;"><i class="bi bi-receipt"></i></div>
            <h5 class="fw-bold mb-3">Gestión de Órdenes</h5>
            <p class="text-muted mb-4">Registra y controla las órdenes de venta.</p>
            <a href="router.php?page=orders" class="btn btn-primary w-100">
              <i class="bi bi-arrow-right-circle me-1"></i> Ir a Órdenes
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>


</section>

<!-- 🔹 Footer -->
<footer>
  <p class="mb-0">
    Desarrollado por <strong>Noelia Chung</strong> © <?= date("Y") ?> | Ingeniería en Sistemas 💻
  </p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
