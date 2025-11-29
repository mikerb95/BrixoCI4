<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pro['nombre'] ?> - Perfil Profesional | Brixo</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .profile-header-bg {
            background-color: #f8f9fa;
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        .profile-img-large {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .verified-badge {
            color: #009fd9;
        }

        .rating-star {
            color: #ffc107;
        }

        .service-card {
            transition: transform 0.2s;
        }

        .service-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }

        .sticky-sidebar {
            position: sticky;
            top: 90px;
            /* Height of navbar + some gap */
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <?= view('partials/navbar') ?>

    <!-- Spacer for fixed navbar -->
    <div style="height: 80px;"></div>


    <!-- Profile Header -->
    <div class="profile-header-bg border-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-auto text-center text-md-start">
                    <img src="<?= $pro['imagen'] ?>" alt="<?= $pro['nombre'] ?>" class="rounded-circle profile-img-large">
                </div>
                <div class="col-md text-center text-md-start mt-3 mt-md-0">
                    <h1 class="fw-bold mb-1">
                        <?= $pro['nombre'] ?>
                        <?php if ($pro['verificado']): ?>
                            <i class="fas fa-check-circle verified-badge fs-4" title="Identidad Verificada"></i>
                        <?php endif; ?>
                    </h1>
                    <h4 class="text-muted mb-2"><?= $pro['profesion'] ?></h4>
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-3 mb-2">
                        <div class="d-flex align-items-center">
                            <span class="fw-bold fs-5 me-1"><?= $pro['rating'] ?></span>
                            <div class="text-warning me-1">
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <?php if ($i < floor($pro['rating'])): ?>
                                        <i class="fas fa-star"></i>
                                    <?php elseif ($i < $pro['rating']): ?>
                                        <i class="fas fa-star-half-alt"></i>
                                    <?php else: ?>
                                        <i class="far fa-star"></i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                            <span class="text-muted text-decoration-underline">(<?= $pro['reviews_count'] ?> reseñas)</span>
                        </div>
                        <div class="text-muted">
                            <i class="fas fa-map-marker-alt me-1"></i> <?= $pro['ubicacion'] ?>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2">
                        <span class="badge bg-light text-dark border"><i class="fas fa-trophy text-warning me-1"></i> Súper Pro</span>
                        <span class="badge bg-light text-dark border"><i class="fas fa-clock me-1"></i> 10 trabajos este mes</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">

                <!-- About Section -->
                <section class="mb-5">
                    <h3 class="fw-bold mb-3">Sobre mí</h3>
                    <p class="lead fs-6 text-secondary"><?= $pro['descripcion'] ?></p>
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle p-3 me-3">
                                    <i class="fas fa-briefcase text-primary fs-4"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">Experiencia</div>
                                    <div class="text-muted"><?= $pro['experiencia'] ?> en el sector</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle p-3 me-3">
                                    <i class="fas fa-user-shield text-primary fs-4"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">Garantía</div>
                                    <div class="text-muted">Trabajo asegurado y garantizado</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <hr class="my-5">

                <!-- Services Section -->
                <section class="mb-5">
                    <h3 class="fw-bold mb-4">Servicios Ofrecidos</h3>
                    <div class="row g-3">
                        <?php foreach ($servicios as $servicio): ?>
                            <div class="col-md-6">
                                <div class="card h-100 border shadow-sm service-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h5 class="card-title fw-bold mb-0"><?= $servicio['nombre'] ?></h5>
                                            <span class="badge bg-primary bg-opacity-10 text-primary">Desde $<?= number_format($servicio['precio'], 0, ',', '.') ?></span>
                                        </div>
                                        <p class="card-text text-muted small"><?= $servicio['descripcion'] ?></p>
                                        <button class="btn btn-outline-primary btn-sm w-100 mt-2">Cotizar este servicio</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <hr class="my-5">

                <!-- Reviews Section -->
                <section class="mb-5">
                    <h3 class="fw-bold mb-4">Reseñas de clientes</h3>

                    <?php foreach ($resenas as $resena): ?>
                        <div class="card border-0 mb-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center fw-bold text-secondary" style="width: 50px; height: 50px;">
                                        <?= substr($resena['autor'], 0, 1) ?>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="fw-bold mb-0"><?= $resena['autor'] ?></h6>
                                        <small class="text-muted"><?= $resena['fecha'] ?></small>
                                    </div>
                                    <div class="text-warning mb-2 rating-star">
                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                            <i class="<?= $i < $resena['calificacion'] ? 'fas' : 'far' ?> fa-star"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <p class="text-secondary mb-0"><?= $resena['comentario'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <button class="btn btn-outline-secondary w-100">Ver todas las reseñas</button>
                </section>

            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-sidebar">
                    <div class="card shadow-sm border-0 rounded-4 mb-4">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-4">Contactar a <?= explode(' ', $pro['nombre'])[0] ?></h4>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary btn-lg fw-bold">Solicitar Cotización</button>
                                <button class="btn btn-outline-dark btn-lg fw-bold">Enviar Mensaje</button>
                            </div>
                            <div class="text-center mt-3">
                                <small class="text-muted"><i class="fas fa-bolt text-warning"></i> Responde en menos de 1 hora</small>
                            </div>
                        </div>
                        <div class="card-footer bg-light p-3 text-center border-top-0 rounded-bottom-4">
                            <small class="text-muted">Contratación segura a través de Brixo</small>
                        </div>
                    </div>

                    <div class="card border shadow-sm rounded-4 mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Certificaciones</h5>
                            <ul class="list-unstyled mb-0">
                                <?php foreach ($certificaciones as $cert): ?>
                                    <li class="mb-2 d-flex align-items-start">
                                        <i class="fas fa-certificate text-success mt-1 me-2"></i>
                                        <span><?= $cert ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="card border shadow-sm rounded-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Disponibilidad</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Lunes - Viernes</span>
                                <span class="fw-bold">8:00 - 18:00</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Sábados</span>
                                <span class="fw-bold">9:00 - 14:00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5 class="fw-bold mb-3">brixo</h5>
                    <p class="text-white-50">Conectando a los mejores profesionales con clientes que necesitan soluciones de calidad.</p>
                </div>
                <div class="col-md-2">
                    <h6 class="fw-bold mb-3">Descubrir</h6>
                    <ul class="list-unstyled text-white-50">
                        <li><a href="#" class="text-reset text-decoration-none">Servicios</a></li>
                        <li><a href="#" class="text-reset text-decoration-none">Profesionales</a></li>
                        <li><a href="#" class="text-reset text-decoration-none">Cómo funciona</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h6 class="fw-bold mb-3">Para Profesionales</h6>
                    <ul class="list-unstyled text-white-50">
                        <li><a href="#" class="text-reset text-decoration-none">Regístrate</a></li>
                        <li><a href="#" class="text-reset text-decoration-none">Éxito en Brixo</a></li>
                        <li><a href="#" class="text-reset text-decoration-none">Recursos</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6 class="fw-bold mb-3">Síguenos</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white fs-5"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white fs-5"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white fs-5"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white fs-5"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <div class="text-center text-white-50 small">
                &copy; 2025 Brixo. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>