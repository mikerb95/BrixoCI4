<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Brixo - Encuentra profesionales locales</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/brixo.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
</head>

<body class="home-page">
    <?= view('partials/navbar') ?>

    <!-- Hero Section with simple nav -->
    <section class="hero position-relative d-flex align-items-center justify-content-center text-center text-white"
        style="height: 70vh; background-image: url(https://brixo-services.vercel.app/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fhero2.457d5ba2.jpg&w=1920&q=75); background-size: cover; background-position: center;">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>

        <div class="container position-relative z-1">
            <?php if (!empty($message)): ?>
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <?= esc($message) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <?= esc($error) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <div class="row align-items-center">
                <!-- Logo removido del hero -->
                <div class="col-lg-7 text-start mb-3"></div>
                <div class="col-lg-7 text-start mb-5 mb-lg-0">
                    <h1 class="display-3 fw-bold mb-4 lh-sm">Profesionales<br>confiables, cuando<br>los necesitas</h1>
                    <p class="fs-5 mb-4 fw-light" style="max-width: 600px;">Reserva por horas a expertos en obra,
                        carpintería, plomería y más. Publica tu necesidad o reserva de inmediato.</p>
                    <div class="d-flex flex-wrap gap-3 align-items-center">
                        <a href="/map" class="btn btn-primary btn-lg rounded-pill px-4 fw-bold">Explorar Mapa</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div
                        class="card bg-dark bg-opacity-50 border-secondary border-opacity-50 text-white p-4 rounded-4 backdrop-blur">
                        <h5 class="fw-bold mb-4">Categorías populares</h5>
                        <div class="row g-3">
                            <div class="col-6">
                                <a href="/map"
                                    class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span>Obra</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/map"
                                    class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span>Carpintería</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/map"
                                    class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span>Plomería</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/map"
                                    class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span>Electricidad</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/map"
                                    class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span>Pintura</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/map"
                                    class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span>Otros</span>
                                </a>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="/especialidades" class="btn btn-light w-100 fw-semibold">
                                <i class="fas fa-th-large me-2"></i>Ver todas las especialidades
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        </div>
    </section>

    <!-- Sección de llamada a la acción hacia el mapa -->
    <section class="py-5 bg-light">
        <div class="container" style="max-width: 1200px;">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <h2 class="h3 fw-bold mb-3">Encuentra profesionales cerca de ti</h2>
                    <p class="text-secondary mb-4">
                        Explora el mapa interactivo para ver contratistas verificados, reseñas y precios
                        estimados en tu zona.
                    </p>
                    <a href="/map" class="btn btn-primary btn-lg rounded-pill px-4">Ver mapa interactivo</a>
                </div>
                <div class="col-lg-5">
                    <div class="border rounded-4 overflow-hidden shadow-sm">
                        <img src="/images/map-ico.png" alt="Mapa de profesionales cercanos" class="w-100"
                            style="object-fit: cover; max-height: 260px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tools Banner Section (same width as map container) -->
    <section class="py-4 bg-light">
        <div class="container d-flex justify-content-center" style="max-width: 1200px;">
            <div class="position-relative overflow-hidden rounded-4 shadow-sm" style="width: 100%; max-height: 275px;">
                <img src="/images/toolsbig.webp" alt="Herramientas Brixo" class="img-fluid w-100 h-100"
                    style="object-fit: cover; object-position: center;">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="padding: 24px 40px;">
                    <div class="text-white" style="max-width: 520px;">
                        <h3 class="h2 fw-bold mb-3">¿Necesitas herramientas puntuales?</h3>
                        <p class="mb-4">Alquila taladros, sierras, andamios y más por día u horas, sin comprar. Ideal
                            para proyectos rápidos y profesionales en movimiento.</p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="/map" class="btn btn-primary btn-lg px-4">Ver disponibilidad</a>
                            <a href="/solicitud/nueva" class="btn btn-outline-light btn-lg px-4">Publicar necesidad</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories-section py-5">
        <div class="container" style="max-width: 1200px;">
            <h2 class="h3 fw-bold mb-4">Servicios populares</h2>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4">
                <div class="col">
                    <div class="card h-100 text-center p-4 border rounded-3 shadow-sm hover-shadow transition">
                        <i class="fas fa-broom fs-2 mb-3 text-dark"></i>
                        <div class="fw-semibold small">Limpieza</div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 text-center p-4 border rounded-3 shadow-sm hover-shadow transition">
                        <i class="fas fa-tools fs-2 mb-3 text-dark"></i>
                        <div class="fw-semibold small">Reparaciones</div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 text-center p-4 border rounded-3 shadow-sm hover-shadow transition">
                        <i class="fas fa-truck fs-2 mb-3 text-dark"></i>
                        <div class="fw-semibold small">Mudanzas</div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 text-center p-4 border rounded-3 shadow-sm hover-shadow transition">
                        <i class="fas fa-camera fs-2 mb-3 text-dark"></i>
                        <div class="fw-semibold small">Fotografía</div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 text-center p-4 border rounded-3 shadow-sm hover-shadow transition">
                        <i class="fas fa-paint-roller fs-2 mb-3 text-dark"></i>
                        <div class="fw-semibold small">Pintura</div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 text-center p-4 border rounded-3 shadow-sm hover-shadow transition">
                        <i class="fas fa-dog fs-2 mb-3 text-dark"></i>
                        <div class="fw-semibold small">Mascotas</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Services Section (Image Cards) -->
    <section class="featured-services py-5 bg-light">
        <div class="container" style="max-width: 1200px;">
            <h2 class="h3 fw-bold mb-4">Proyectos destacados</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <!-- Electricidad -->
                <div class="col">
                    <div
                        class="card border-0 rounded-4 overflow-hidden text-white shadow-sm h-100 position-relative card-img-overlay-container">
                        <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                            class="card-img h-100 object-fit-cover" alt="Electricidad">
                        <div class="card-img-overlay d-flex align-items-end p-0">
                            <div class="w-100 p-4 bg-gradient-overlay">
                                <h5 class="card-title fw-bold mb-0">Electricidad</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Obra -->
                <div class="col">
                    <div
                        class="card border-0 rounded-4 overflow-hidden text-white shadow-sm h-100 position-relative card-img-overlay-container">
                        <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                            class="card-img h-100 object-fit-cover" alt="Obra y Construcción">
                        <div class="card-img-overlay d-flex align-items-end p-0">
                            <div class="w-100 p-4 bg-gradient-overlay">
                                <h5 class="card-title fw-bold mb-0">Obra y Construcción</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Plomería -->
                <div class="col">
                    <div
                        class="card border-0 rounded-4 overflow-hidden text-white shadow-sm h-100 position-relative card-img-overlay-container">
                        <img src="https://images.unsplash.com/photo-1585704032915-c3400ca199e7?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                            class="card-img h-100 object-fit-cover" alt="Plomería">
                        <div class="card-img-overlay d-flex align-items-end p-0">
                            <div class="w-100 p-4 bg-gradient-overlay">
                                <h5 class="card-title fw-bold mb-0">Plomería</h5>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- User Panel Modal -->
                <div class="modal fade" id="userPanel" tabindex="-1" aria-labelledby="userPanelLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content p-4 rounded-4 shadow">
                            <div class="modal-header border-0 p-0 mb-3">
                                <h2 class="modal-title fs-4 fw-bold" id="userPanelLabel">Panel de Usuario</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <?php $u = session()->get('user'); ?>
                                <div class="d-flex gap-3 align-items-center mb-4">
                                    <img src="<?= esc($u['foto_perfil'] ?? 'https://via.placeholder.com/80') ?>"
                                        alt="Perfil" class="rounded-3" style="width:80px;height:80px;object-fit:cover;">
                                    <div>
                                        <div class="fw-bold"><?= esc($u['nombre'] ?? 'Usuario') ?></div>
                                        <div class="text-secondary small"><?= esc($u['correo'] ?? '') ?></div>
                                        <span class="badge bg-primary">Cliente</span>
                                    </div>
                                </div>
                                <hr>
                                <h3 class="h6 fw-bold mb-3">Mis contratos recientes</h3>
                                <?php if (!empty($userContracts)): ?>
                                    <ul class="list-group list-group-flush mb-3">
                                        <?php foreach ($userContracts as $c): ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <div class="fw-semibold"><?= esc($c['detalle'] ?? 'Servicio') ?>
                                                    </div>
                                                    <div class="small text-secondary">Contratista:
                                                        <?= esc($c['contratista'] ?? '') ?>
                                                    </div>
                                                    <div class="small text-secondary">Estado:
                                                        <?= esc($c['estado'] ?? '') ?>
                                                    </div>
                                                </div>
                                                <div class="text-end small text-secondary">
                                                    <div>Inicio: <?= esc($c['fecha_inicio'] ?? '') ?></div>
                                                    <div>Fin: <?= esc($c['fecha_fin'] ?? '') ?></div>
                                                    <div class="fw-semibold text-dark">
                                                        $<?= esc(number_format((float) ($c['costo_total'] ?? 0), 0, ',', '.')) ?>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p class="text-secondary">Aún no tienes contratos. Explora el mapa y solicita
                                        una cotización.</p>
                                <?php endif; ?>
                                <div class="d-flex justify-content-end">
                                    <a href="/map" class="btn btn-sm btn-primary rounded-3">Explorar
                                        profesionales</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contractor Panel Modal -->
                <div class="modal fade" id="contractorPanel" tabindex="-1" aria-labelledby="contractorPanelLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content p-4 rounded-4 shadow">
                            <div class="modal-header border-0 p-0 mb-3">
                                <h2 class="modal-title fs-4 fw-bold" id="contractorPanelLabel">Panel de
                                    Contratista</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <?php $u = session()->get('user'); ?>
                                <div class="d-flex gap-3 align-items-center mb-4">
                                    <img src="<?= esc($u['foto_perfil'] ?? 'https://via.placeholder.com/80') ?>"
                                        alt="Perfil" class="rounded-3" style="width:80px;height:80px;object-fit:cover;">
                                    <div>
                                        <div class="fw-bold"><?= esc($u['nombre'] ?? 'Contratista') ?></div>
                                        <div class="text-secondary small"><?= esc($u['correo'] ?? '') ?></div>
                                        <span class="badge bg-dark">Contratista</span>
                                    </div>
                                </div>
                                <hr>
                                <h3 class="h6 fw-bold mb-3">Mis contratos activos</h3>
                                <?php if (!empty($contractorContracts)): ?>
                                    <ul class="list-group list-group-flush mb-3">
                                        <?php foreach ($contractorContracts as $c): ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div>
                                                    <div class="fw-semibold"><?= esc($c['detalle'] ?? 'Servicio') ?>
                                                    </div>
                                                    <div class="small text-secondary">Cliente:
                                                        <?= esc($c['cliente'] ?? '') ?>
                                                    </div>
                                                    <div class="small text-secondary">Estado:
                                                        <?= esc($c['estado'] ?? '') ?>
                                                    </div>
                                                </div>
                                                <div class="text-end small text-secondary">
                                                    <div>Inicio: <?= esc($c['fecha_inicio'] ?? '') ?></div>
                                                    <div>Fin: <?= esc($c['fecha_fin'] ?? '') ?></div>
                                                    <div class="fw-semibold text-dark">
                                                        $<?= esc(number_format((float) ($c['costo_total'] ?? 0), 0, ',', '.')) ?>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p class="text-secondary">Aún no tienes contratos activos. Responde cotizaciones
                                        aceptadas.</p>
                                <?php endif; ?>
                                <div class="d-flex justify-content-end">
                                    <a href="/tablon-tareas" class="btn btn-sm btn-primary rounded-3">Ver
                                        solicitudes</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?= view('partials/footer') ?>



</body>

</html>