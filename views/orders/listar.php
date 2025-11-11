<div class="container mt-5">
  <h2 class="mb-4 text-center">🧾 Lista de Órdenes</h2>

  <!-- 🔹 Botones + Buscador -->
  <div class="filter-container mb-4">
    <div>
      <a href="router.php?page=orders&action=crear" class="btn btn-custom">
        <i class="bi bi-plus-circle"></i> Nueva Orden
      </a>
    </div>

    <div class="search-wrapper">
      <i class="bi bi-search"></i>
      <input type="text" id="searchInput" class="form-control" placeholder="Buscar por cliente o estado...">
    </div>
  </div>

  <!-- 🔹 Tabla moderna -->
  <div class="table-responsive">
    <table class="table table-hover align-middle text-center bg-white" id="ordersTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Cliente</th>
          <th>Fecha</th>
          <th>Estado</th>
          <th>Total (Bs)</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($ordenes as $orden): ?>
        <tr>
          <td><?= $orden['order_id'] ?></td>
          <td><?= $orden['cliente'] ?></td>
          <td><?= $orden['order_date'] ?></td>
          <td><span class="badge bg-info text-dark"><?= $orden['estado'] ?></span></td>
          <td><?= number_format($orden['total_amount'], 2) ?> Bs</td>
          <td>
            <a href="router.php?page=orders&action=anular&id=<?= $orden['order_id'] ?>" class="btn btn-warning btn-sm">
              <i class="bi bi-x-circle"></i> Anular
            </a>
            <a href="router.php?page=orders&action=eliminar&id=<?= $orden['order_id'] ?>" class="btn btn-danger btn-sm"
               onclick="return confirm('¿Seguro que deseas eliminar esta orden?');">
              <i class="bi bi-trash"></i> Eliminar
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
