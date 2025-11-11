<div class="container mt-5">
    <h2 class="mb-4 text-center">🧾 Crear Nueva Orden</h2>

    <form method="POST" action="router.php?page=orders&action=crear">
        <div class="mb-3">
            <label for="customer_id" class="form-label">Seleccionar Cliente</label>
            <select name="customer_id" class="form-select" required>
                <option value="">-- Seleccione un cliente --</option>
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?= $cliente['customer_id'] ?>">
                        <?= htmlspecialchars($cliente['first_name'] . ' ' . $cliente['last_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="total_amount" class="form-label">Total (Bs)</label>
            <input type="number" name="total_amount" class="form-control" required>
        </div>

        <div class="text-end mt-4">
            <a href="router.php?page=orders" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-custom">Crear Orden</button>
        </div>
    </form>
</div>
