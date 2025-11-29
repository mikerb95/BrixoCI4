<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos los Servicios - Brixo</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/brixo.css">

    <style>
        .filter-sidebar {
            border-right: 1px solid #e0e0e0;
            min-height: 100vh;
        }

        .filter-title {
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .filter-link {
            color: #333;
            text-decoration: none;
            font-size: 0.9rem;
            display: block;
            margin-bottom: 0.3rem;
        }

        .filter-link:hover {
            color: #009fd9;
            text-decoration: underline;
        }

        .rating-filter i {
            color: #ffc107;
            font-size: 0.8rem;
        }

        .service-card {
            transition: box-shadow 0.2s;
            border: 1px solid #eee;
        }

        .service-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .service-img {
            height: 200px;
            object-fit: cover;
            background-color: #f8f9fa;
        }

        .price-tag {
            font-size: 1.2rem;
            font-weight: 700;
        }

        .breadcrumb-item a {
            color: #555;
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: #009fd9;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <?= view('partials/navbar') ?>

    <!-- Spacer for fixed navbar -->
    <div style="height: 80px;"></div>


    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-2 d-none d-lg-block filter-sidebar py-4 ps-4">

                <div class="mb-4">
                    <h6 class="filter-title">Categorías</h6>
                    <?php foreach ($categories as $cat): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="cat-<?= md5($cat) ?>">
                            <label class="form-check-label small" for="cat-<?= md5($cat) ?>">
                                <?= $cat ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="mb-4">
                    <h6 class="filter-title">Opinión de clientes</h6>
                    <a href="#" class="filter-link rating-filter">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                        <span class="ms-1 text-dark">o más</span>
                    </a>
                    <a href="#" class="filter-link rating-filter">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                        <span class="ms-1 text-dark">o más</span>
                    </a>
                    <a href="#" class="filter-link rating-filter">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                        <span class="ms-1 text-dark">o más</span>
                    </a>
                </div>

                <div class="mb-4">
                    <h6 class="filter-title">Precio</h6>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <input type="number" class="form-control form-control-sm" placeholder="Mín">
                        <span class="text-muted">-</span>
                        <input type="number" class="form-control form-control-sm" placeholder="Máx">
                    </div>
                    <button class="btn btn-outline-secondary btn-sm rounded-pill w-100">Ir</button>
                </div>

                <div class="mb-4">
                    <h6 class="filter-title">Ubicación</h6>
                    <?php foreach ($locations as $loc): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="loc-<?= md5($loc) ?>">
                            <label class="form-check-label small" for="loc-<?= md5($loc) ?>">
                                <?= $loc ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>

            <!-- Results List -->
            <div class="col-lg-10 py-4 px-4">

                <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-3">
                    <div>
                        <h5 class="fw-bold mb-1">Resultados para "Servicios"</h5>
                        <small class="text-muted"><?= count($services) ?> resultados encontrados</small>
                    </div>
                    <div class="d-flex align-items-center">
                        <label class="me-2 small text-muted">Ordenar por:</label>
                        <select class="form-select form-select-sm rounded-pill" style="width: auto;">
                            <option selected>Destacados</option>
                            <option value="1">Precio: Bajo a Alto</option>
                            <option value="2">Precio: Alto a Bajo</option>
                            <option value="3">Calificación promedio</option>
                        </select>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-3 row-cols-xl-4 g-3">
                    <?php foreach ($services as $service): ?>
                        <div class="col">
                            <div class="card h-100 service-card rounded-3 overflow-hidden">
                                <div class="position-relative">
                                    <img src="<?= $service['imagen'] ?>" class="card-img-top service-img" alt="<?= $service['titulo'] ?>">
                                    <span class="position-absolute top-0 end-0 m-2 badge bg-dark bg-opacity-75 rounded-pill">
                                        <?= $service['categoria'] ?>
                                    </span>
                                </div>
                                <div class="card-body p-3">
                                    <a href="/profesional/<?= $service['profesional']['id'] ?>" class="text-decoration-none text-dark">
                                        <h6 class="card-title fw-bold mb-1 text-truncate" title="<?= $service['titulo'] ?>"><?= $service['titulo'] ?></h6>
                                    </a>
                                    <div class="mb-2 small">
                                        <a href="/profesional/<?= $service['profesional']['id'] ?>" class="text-muted text-decoration-none hover-underline">
                                            Por <?= $service['profesional']['nombre'] ?>
                                        </a>
                                    </div>
                                    <div class="mb-2">
                                        <span class="text-warning small">
                                            <?php for ($i = 0; $i < 5; $i++): ?>
                                                <i class="<?= $i < floor($service['rating']) ? 'fas' : 'far' ?> fa-star"></i>
                                            <?php endfor; ?>
                                        </span>
                                        <span class="text-primary small ms-1"><?= $service['reviews'] ?></span>
                                    </div>
                                    <div class="mb-3">
                                        <span class="price-tag">$<?= number_format($service['precio'], 0, ',', '.') ?></span>
                                        <span class="small text-muted">/ servicio</span>
                                    </div>
                                    <div class="d-grid">
                                        <a href="/profesional/<?= $service['profesional']['id'] ?>" class="btn btn-warning btn-sm rounded-pill fw-bold">Ver detalles</a>
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-top-0 pt-0 pb-3">
                                    <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> <?= $service['profesional']['ubicacion'] ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation" class="mt-5 d-flex justify-content-center">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Siguiente</a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>