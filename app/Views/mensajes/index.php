<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Mensajes - Brixo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .conversation-item {
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .conversation-item:hover {
            background-color: #f8f9fa;
        }
        .unread {
            font-weight: bold;
            background-color: #eef2ff;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Navbar (Simplificado para mantener consistencia) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="<?= base_url('/') ?>">Brixo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/panel') ?>">Panel</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('/auth/logout') ?>">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-3">
                        <h4 class="mb-0"><i class="fas fa-comments text-primary me-2"></i>Mis Conversaciones</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <?php if (empty($conversaciones)): ?>
                                <div class="p-4 text-center text-muted">
                                    <p>No tienes conversaciones activas.</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($conversaciones as $conv): ?>
                                    <a href="<?= base_url('/mensajes/chat/' . $conv['id'] . '/' . $conv['rol']) ?>" 
                                       class="list-group-item list-group-item-action conversation-item p-3 <?= !$conv['leido'] ? 'unread' : '' ?>">
                                        <div class="d-flex w-100 justify-content-between align-items-center">
                                            <h5 class="mb-1 text-dark"><?= esc($conv['nombre']) ?></h5>
                                            <small class="text-muted"><?= date('d/m H:i', strtotime($conv['fecha'])) ?></small>
                                        </div>
                                        <p class="mb-1 text-secondary text-truncate" style="max-width: 90%;">
                                            <?= esc($conv['ultimo_mensaje']) ?>
                                        </p>
                                        <small class="text-muted text-capitalize"><?= $conv['rol'] ?></small>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
