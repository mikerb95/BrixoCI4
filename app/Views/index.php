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
</head>

<body class="home-page">

    <!-- Hero Section with simple nav -->
    <section class="hero position-relative d-flex align-items-center justify-content-center text-center text-white"
        style="height: 100vh; background-image: url(https://brixo-services.vercel.app/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fhero2.457d5ba2.jpg&w=1920&q=75); background-size: cover; background-position: center;">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
        <!-- Simple hero nav -->
        <nav id="hero-nav" class="hero-nav position-absolute top-0 start-0 w-100">
            <div class="hero-inner d-flex justify-content-start gap-4 py-3">
                <a href="/mapa" class="hero-link">Mapa</a>
                <?php $heroUser = session()->get('user'); ?>
                <?php if (!empty($heroUser)): ?>
                    <span class="hero-link text-white">Hola, <?= esc($heroUser['nombre'] ?? 'Usuario') ?></span>
                    <?php $role = $heroUser['rol'] ?? ''; ?>
                    <?php if ($role === 'admin'): ?>
                        <a href="/admin" class="hero-link">Mi Panel</a>
                    <?php elseif ($role === 'contratista'): ?>
                        <a href="#" class="hero-link" data-bs-toggle="modal" data-bs-target="#contractorPanel">Mi Panel</a>
                    <?php else: ?>
                        <a href="#" class="hero-link" data-bs-toggle="modal" data-bs-target="#userPanel">Mi Panel</a>
                    <?php endif; ?>
                    <a href="/logout" class="hero-link">Salir</a>
                <?php else: ?>
                    <a href="#" class="hero-link" data-bs-toggle="modal" data-bs-target="#loginModal">Ingresar</a>
                    <a href="#" class="hero-link" data-bs-toggle="modal" data-bs-target="#registerModal">Registrarse</a>
                <?php endif; ?>
            </div>
        </nav>
        <!-- Floating navbar (hidden initially) -->
        <?= view('partials/floating_nav') ?>
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
                <!-- Logo justo encima del bloque de texto principal -->
                <div class="col-lg-7 text-start mb-3">
                    <img src="/images/brixo-logo-wh.png" alt="Brixo" style="height:128px;width:auto;"
                        onerror="this.style.display='none'">
                </div>
                <div class="col-lg-7 text-start mb-5 mb-lg-0">
                    <h1 class="display-3 fw-bold mb-4 lh-sm">Profesionales<br>confiables, cuando<br>los necesitas</h1>
                    <p class="fs-5 mb-4 fw-light" style="max-width: 600px;">Reserva por horas a expertos en obra,
                        carpintería, plomería y más. Publica tu necesidad o reserva de inmediato.</p>
                    <div class="d-flex flex-wrap gap-3 align-items-center">
                        <a href="/mapa" class="btn btn-primary btn-lg rounded-pill px-4 fw-bold">Explorar Mapa</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div
                        class="card bg-dark bg-opacity-50 border-secondary border-opacity-50 text-white p-4 rounded-4 backdrop-blur">
                        <h5 class="fw-bold mb-4">Categorías populares</h5>
                        <div class="row g-3">
                            <div class="col-6">
                                <a href="/mapa"
                                    class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span>Obra</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/mapa"
                                    class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span>Carpintería</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/mapa"
                                    class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span>Plomería</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/mapa"
                                    class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span>Electricidad</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/mapa"
                                    class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span>Pintura</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/mapa"
                                    class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span>Otros</span>
                                </a>
                            </div>
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
                    <a href="/mapa" class="btn btn-primary btn-lg rounded-pill px-4">Ver mapa interactivo</a>
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
                            <a href="/mapa" class="btn btn-primary btn-lg px-4">Ver disponibilidad</a>
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
                                    <a href="/mapa" class="btn btn-sm btn-primary rounded-3">Explorar
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

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4 rounded-4 shadow">
                <div class="modal-header border-0 p-0 mb-4">
                    <h2 class="modal-title fs-4 fw-bold" id="loginModalLabel">Iniciar sesión</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <?php if (!empty($login_error)): ?>
                        <div class="alert alert-danger mb-4"><?= esc($login_error) ?></div>
                    <?php endif; ?>
                    <form method="post" action="/login">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="login_correo" class="form-label fw-semibold">Correo electrónico</label>
                            <input id="login_correo" name="correo" type="email" class="form-control p-3 rounded-3"
                                placeholder="nombre@ejemplo.com" required>
                        </div>
                        <div class="mb-4">
                            <label for="login_contrasena" class="form-label fw-semibold">Contraseña</label>
                            <input id="login_contrasena" name="contrasena" type="password"
                                class="form-control p-3 rounded-3" placeholder="Tu contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4 rounded-4 shadow">
                <div class="modal-header border-0 p-0 mb-4">
                    <h2 class="modal-title fs-4 fw-bold" id="registerModalLabel">Crear cuenta</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <?php $registerOld = $register_old ?? []; ?>
                    <?php if (!empty($register_error)): ?>
                        <div class="alert alert-danger mb-4"><?= esc($register_error) ?></div>
                    <?php endif; ?>
                    <form method="post" action="/register" id="registerForm">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="register">
                        <div class="mb-3">
                            <label for="registro_nombre" class="form-label fw-semibold">Nombre</label>
                            <input id="registro_nombre" name="nombre" type="text" class="form-control p-3 rounded-3"
                                placeholder="Tu nombre" value="<?= esc($registerOld['nombre'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="registro_correo" class="form-label fw-semibold">Correo electrónico</label>
                            <input id="registro_correo" name="correo" type="email" class="form-control p-3 rounded-3"
                                placeholder="nombre@ejemplo.com" value="<?= esc($registerOld['correo'] ?? '') ?>"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="registro_telefono" class="form-label fw-semibold">Teléfono</label>
                            <input id="registro_telefono" name="telefono" type="tel" class="form-control p-3 rounded-3"
                                placeholder="3101234567" value="<?= esc($registerOld['telefono'] ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label for="registro_contrasena" class="form-label fw-semibold">Contraseña</label>
                            <input id="registro_contrasena" name="contrasena" type="password"
                                class="form-control p-3 rounded-3" placeholder="Crea una contraseña" required>
                        </div>
                        <div class="mb-3">
                            <label for="registro_contrasena_confirm" class="form-label fw-semibold">Confirmar
                                contraseña</label>
                            <input id="registro_contrasena_confirm" name="contrasena_confirm" type="password"
                                class="form-control p-3 rounded-3" placeholder="Repite la contraseña" required>
                        </div>
                        <div class="mb-3">
                            <label for="registro_rol" class="form-label fw-semibold">Tipo de cuenta</label>
                            <select id="registro_rol" name="rol" class="form-select p-3 rounded-3" required>
                                <option value="cliente" <?= (isset($registerOld['rol']) && $registerOld['rol'] === 'cliente') ? 'selected' : '' ?>>Cliente</option>
                                <option value="contratista" <?= (isset($registerOld['rol']) && $registerOld['rol'] === 'contratista') ? 'selected' : '' ?>>Contratista</option>
                            </select>
                        </div>

                        <!-- Location Fields (Required for everyone) -->
                        <div class="mb-3">
                            <label for="registro_departamento" class="form-label fw-semibold">Departamento</label>
                            <select id="registro_departamento" class="form-select p-3 rounded-3" required></select>
                        </div>
                        <div class="mb-3">
                            <label for="registro_ciudad" class="form-label fw-semibold">Ciudad</label>
                            <select id="registro_ciudad" name="ciudad" class="form-select p-3 rounded-3" disabled
                                required></select>
                        </div>

                        <div id="contractorFields"
                            class="mb-3 <?= (isset($registerOld['rol']) && $registerOld['rol'] === 'contratista') ? '' : 'd-none' ?>">
                            <div class="mb-3">
                                <label for="registro_ubicacion" class="form-label fw-semibold">Ubicación exacta</label>
                                <div id="mapaRegistro"
                                    style="height: 300px; width: 100%; border-radius: 10px; margin-bottom: 10px;"></div>
                                <input id="registro_ubicacion" name="ubicacion_mapa" type="text"
                                    class="form-control p-3 rounded-3" placeholder="Selecciona en el mapa"
                                    value="<?= esc($registerOld['ubicacion_mapa'] ?? '') ?>" readonly>
                                <small class="text-muted">Arrastra el marcador azul para indicar tu ubicación.</small>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold">Registrarme</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="/js/colombia-locations.js"></script>
    <script src="/js/nav-floating.js"></script>

    <script>
        (function () {
            const roleSelect = document.getElementById('registro_rol');
            const contractorFields = document.getElementById('contractorFields');
            const deptInput = document.getElementById('registro_departamento');
            const cityInput = document.getElementById('registro_ciudad');
            const mapInput = document.getElementById('registro_ubicacion');

            // Initialize Colombia Selects
            const oldCity = "<?= esc($registerOld['ciudad'] ?? '') ?>";
            if (typeof initColombiaSelects === 'function') {
                initColombiaSelects('registro_departamento', 'registro_ciudad', oldCity);
            }

            let map = null;
            let marker = null;

            const initMap = () => {
                if (map) return; // Ya inicializado

                // Coordenadas por defecto (Bogotá)
                const defaultLat = 4.6097;
                const defaultLng = -74.0817;

                map = L.map('mapaRegistro').setView([defaultLat, defaultLng], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                // Icono personalizado (opcional, usando el default por ahora)

                // Crear marcador arrastrable
                marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

                // Evento al arrastrar
                marker.on('dragend', function (event) {
                    const position = marker.getLatLng();
                    mapInput.value = `${position.lat},${position.lng}`;
                });

                // Evento al hacer clic en el mapa
                map.on('click', function (e) {
                    marker.setLatLng(e.latlng);
                    mapInput.value = `${e.latlng.lat},${e.latlng.lng}`;
                });

                // Intentar geolocalización
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        const lat = position.coords.latitude;
                        const lng = position.coords.longitude;
                        const newLatLng = new L.LatLng(lat, lng);
                        marker.setLatLng(newLatLng);
                        map.setView(newLatLng, 15);
                        mapInput.value = `${lat},${lng}`;
                    });
                }

                // Si ya había un valor (ej. error de validación), poner el marcador ahí
                if (mapInput.value) {
                    const parts = mapInput.value.split(',');
                    if (parts.length === 2) {
                        const lat = parseFloat(parts[0]);
                        const lng = parseFloat(parts[1]);
                        if (!isNaN(lat) && !isNaN(lng)) {
                            const savedLatLng = new L.LatLng(lat, lng);
                            marker.setLatLng(savedLatLng);
                            map.setView(savedLatLng, 15);
                        }
                    }
                }
            };

            const toggleContractorFields = () => {
                const isContractor = roleSelect.value === 'contratista';
                contractorFields.classList.toggle('d-none', !isContractor);
                // Dept and City are always required now
                if (mapInput) mapInput.required = isContractor;

                if (isContractor) {
                    // Pequeño retraso para asegurar que el div sea visible antes de cargar el mapa
                    setTimeout(() => {
                        initMap();
                        if (map) map.invalidateSize(); // Arregla problemas de renderizado en modales
                    }, 200);
                }
            };

            if (roleSelect && contractorFields && cityInput && mapInput) {
                roleSelect.addEventListener('change', toggleContractorFields);
                // Ejecutar al inicio por si el navegador guardó la selección
                if (roleSelect.value === 'contratista') {
                    toggleContractorFields();
                }
            }

            // Asegurar que el mapa se redibuje correctamente cuando se abre el modal
            const registerModalEl = document.getElementById('registerModal');
            if (registerModalEl) {
                registerModalEl.addEventListener('shown.bs.modal', function () {
                    if (roleSelect.value === 'contratista' && map) {
                        map.invalidateSize();
                    }
                });
            }

            <?php if (!empty($login_error)): ?>
                const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                loginModal.show();
            <?php endif; ?>

            <?php if (!empty($register_error)): ?>
                const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
                registerModal.show();
            <?php endif; ?>
        })();
    </script>

</body>

</html>