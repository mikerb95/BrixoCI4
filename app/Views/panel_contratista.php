<?php
/** @var array $user */
/** @var array $contracts */
/** @var array $reviews */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Contratista - Brixo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/brixo.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <?= view('partials/navbar') ?>
    <?= view('partials/floating_nav') ?>

    <main class="flex-grow-1">
        <div class="container my-5" style="max-width:1200px;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 fw-bold mb-0">Hola, <?= esc($user['nombre']) ?></h1>
                <a href="/" class="btn btn-outline-secondary">Inicio</a>
            </div>

            <?php if (!empty($message)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= esc($message) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="row g-4">
                <div class="col-lg-8">
                    <!-- Sección de Oportunidades / Solicitudes Recientes -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h2 class="h5 fw-bold mb-0">Oportunidades Recientes</h2>
                                <a href="/tablon-tareas" class="btn btn-primary btn-sm">Ver todas</a>
                            </div>

                            <?php if (!empty($solicitudesDisponibles)): ?>
                                <div class="list-group list-group-flush">
                                    <?php foreach ($solicitudesDisponibles as $s): ?>
                                        <a href="/tablon-tareas"
                                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="fw-semibold text-primary"><?= esc($s['titulo']) ?></div>
                                                <div class="small text-secondary">
                                                    <i class="fas fa-user me-1"></i> <?= esc($s['nombre_cliente']) ?> &bull;
                                                    <i class="fas fa-map-marker-alt me-1"></i> <?= esc($s['ubicacion']) ?>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <span class="badge bg-success rounded-pill">
                                                    $<?= esc(number_format((float) $s['presupuesto'], 0, ',', '.')) ?>
                                                </span>
                                                <div class="small text-muted mt-1">
                                                    <?= date('d M', strtotime($s['creado_en'])) ?>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-3 text-secondary">
                                    <p class="mb-0">No hay solicitudes abiertas en este momento.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="h5 fw-bold">Contratos activos</h2>
                            <?php if (!empty($contracts)): ?>
                                <ul class="list-group list-group-flush mt-3">
                                    <?php foreach ($contracts as $c): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="fw-semibold"><?= esc($c['detalle']) ?></div>
                                                <div class="small text-secondary">Cliente: <?= esc($c['cliente']) ?></div>
                                                <span class="badge bg-dark"><?= esc($c['estado']) ?></span>
                                            </div>
                                            <div class="text-end small">
                                                <div>Inicio: <?= esc($c['fecha_inicio']) ?></div>
                                                <div>Fin: <?= esc($c['fecha_fin']) ?></div>
                                                <div class="fw-semibold text-dark">
                                                    $<?= esc(number_format((float) $c['costo_total'], 0, ',', '.')) ?></div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-secondary mt-2">No tienes contratos activos aún.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="h5 fw-bold">Reseñas recibidas</h2>
                            <?php if (!empty($reviews)): ?>
                                <ul class="list-group list-group-flush mt-3">
                                    <?php foreach ($reviews as $r): ?>
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <div class="fw-semibold">Calificación: <?= esc($r['calificacion']) ?>/5
                                                    </div>
                                                    <div class="small">De: <?= esc($r['cliente']) ?></div>
                                                </div>
                                                <div class="small text-secondary"><?= esc($r['fecha_resena']) ?></div>
                                            </div>
                                            <div class="mt-2 text-secondary"><?= esc($r['comentario']) ?></div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-secondary mt-2">Aún no has recibido reseñas.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/nav-floating.js"></script>
</body>

</html>