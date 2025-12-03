<?= view('partials/header') ?>

<main class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 mb-0">Solicitudes recibidas</h2>
        <div>
            <a href="/panel" class="btn btn-outline-primary btn-sm">Mi Panel</a>
            <a href="/mapa" class="btn btn-outline-secondary btn-sm">Mapa</a>
        </div>
    </div>

    <?php if (empty($solicitudes)): ?>
        <div class="alert alert-info">No hay solicitudes recientes.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($solicitudes as $s): ?>
                    <tr>
                        <td><?= esc($s['id_contrato']) ?></td>
                        <td><?= esc($s['cliente']) ?></td>
                        <td><?= esc($s['cliente_telefono'] ?? '') ?></td>
                        <td><span class="badge bg-secondary"><?= esc($s['estado']) ?></span></td>
                        <td><?= esc($s['fecha_inicio'] ?? '') ?></td>
                        <td><?= esc($s['fecha_fin'] ?? '') ?></td>
                        <td>$<?= esc(number_format((float) ($s['costo_total'] ?? 0), 0, ',', '.')) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</main>

<?= view('partials/footer') ?>
