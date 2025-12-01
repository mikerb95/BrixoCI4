<?php
/** @var array $user */
/** @var array $contracts */
/** @var array $reviews */
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario - Brixo</title>
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
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="h5 fw-bold">Mis contratos</h2>
                            <?php if (!empty($contracts)): ?>
                                <ul class="list-group list-group-flush mt-3">
                                    <?php foreach ($contracts as $c): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="fw-semibold"><?= esc($c['detalle']) ?></div>
                                                <div class="small text-secondary">Contratista: <?= esc($c['contratista']) ?>
                                                </div>
                                                <span class="badge bg-primary"><?= esc($c['estado']) ?></span>
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
                                <p class="text-secondary mt-2">No tienes contratos aún.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="h5 fw-bold">Mis reseñas</h2>
                            <?php if (!empty($reviews)): ?>
                                <ul class="list-group list-group-flush mt-3">
                                    <?php foreach ($reviews as $r): ?>
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <div class="fw-semibold">Calificación: <?= esc($r['calificacion']) ?>/5
                                                    </div>
                                                    <div class="small">A: <?= esc($r['contratista']) ?></div>
                                                </div>
                                                <div class="small text-secondary"><?= esc($r['fecha_resena']) ?></div>
                                            </div>
                                            <div class="mt-2 text-secondary"><?= esc($r['comentario']) ?></div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-secondary mt-2">Aún no has publicado reseñas.</p>
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