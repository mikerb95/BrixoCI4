<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nueva Solicitud - Brixo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/brixo.css">
</head>

<body class="bg-light">

    <!-- Navbar simple -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">Brixo</a>
            <div class="d-flex">
                <a href="/panel" class="btn btn-outline-light btn-sm">Volver al Panel</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-5">
                        <h2 class="fw-bold mb-4">Crear Solicitud de Servicio</h2>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <form action="/solicitud/guardar" method="post">
                            <?= csrf_field() ?>

                            <?php if (!empty($id_contratista)): ?>
                                <div class="alert alert-info d-flex align-items-center">
                                    <i class="fas fa-user-check me-2"></i>
                                    <div>
                                        Esta solicitud será enviada directamente a:
                                        <strong><?= esc($nombre_contratista) ?></strong>
                                        <input type="hidden" name="id_contratista" value="<?= esc($id_contratista) ?>">
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-secondary">
                                    <i class="fas fa-bullhorn me-2"></i>
                                    Esta solicitud será <strong>pública</strong> para todos los contratistas disponibles.
                                </div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="titulo" class="form-label fw-semibold">Título de la solicitud</label>
                                <input type="text" class="form-control p-3" id="titulo" name="titulo"
                                    placeholder="Ej: Reparación de tubería en cocina" required>
                            </div>

                            <div class="mb-3">
                                <label for="descripcion" class="form-label fw-semibold">Descripción detallada</label>
                                <textarea class="form-control p-3" id="descripcion" name="descripcion" rows="5"
                                    placeholder="Describe el problema, qué necesitas y cualquier detalle relevante..."
                                    required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="presupuesto" class="form-label fw-semibold">Presupuesto estimado
                                        (Opcional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control p-3" id="presupuesto"
                                            name="presupuesto" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ubicacion" class="form-label fw-semibold">Ubicación / Barrio</label>
                                    <input type="text" class="form-control p-3" id="ubicacion" name="ubicacion"
                                        placeholder="Ej: Chapinero, Bogotá">
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg fw-bold">Publicar Solicitud</button>
                                <a href="/panel" class="btn btn-link text-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>