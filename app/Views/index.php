<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Brixo - Encuentra profesionales locales</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/brixo.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top py-3 px-4">
        <div class="container-fluid">
            <a href="/" class="navbar-brand fw-bold fs-3 text-primary logo">Brixo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <nav class="navbar-nav align-items-center gap-3 fw-semibold">
                    <a href="/mapa" class="nav-link text-dark">Mapa</a>
                    <a href="/signup?role=contratista" class="nav-link text-dark">Únete como profesional</a>
                    <?php if (! empty($user)): ?>
                        <span class="nav-item">Hola, <?= esc($user['nombre']) ?></span>
                        <a href="/logout" class="btn btn-outline-secondary rounded-pill px-3">Cerrar sesión</a>
                    <?php else: ?>
                        <button type="button" class="btn btn-primary rounded-pill px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#loginModal">Inicia sesión</button>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>

    <!-- Service Navigation Strip -->
    <div class="service-nav-container border-bottom bg-white">
        <div class="container">
            <div class="service-nav-wrapper position-relative d-flex align-items-center">
                <div class="service-nav d-flex gap-4 overflow-auto pt-3 flex-grow-1 align-items-end">
                    <a href="#" class="service-nav-item active d-flex flex-column align-items-center gap-2 text-decoration-none pb-3 border-bottom border-3 border-primary text-dark fw-bold">
                        <i class="fas fa-spray-can fs-4"></i>
                        <span class="small">Limpieza</span>
                    </a>
                    <a href="#" class="service-nav-item d-flex flex-column align-items-center gap-2 text-decoration-none pb-3 border-bottom border-3 border-transparent text-secondary fw-medium">
                        <i class="fas fa-wrench fs-4"></i>
                        <span class="small">Reparaciones</span>
                    </a>
                    <a href="#" class="service-nav-item d-flex flex-column align-items-center gap-2 text-decoration-none pb-3 border-bottom border-3 border-transparent text-secondary fw-medium">
                        <i class="fas fa-leaf fs-4"></i>
                        <span class="small">Jardinería</span>
                    </a>
                    <a href="#" class="service-nav-item d-flex flex-column align-items-center gap-2 text-decoration-none pb-3 border-bottom border-3 border-transparent text-secondary fw-medium">
                        <i class="fas fa-truck-loading fs-4"></i>
                        <span class="small">Mudanzas</span>
                    </a>
                    <a href="#" class="service-nav-item d-flex flex-column align-items-center gap-2 text-decoration-none pb-3 border-bottom border-3 border-transparent text-secondary fw-medium">
                        <i class="fas fa-tint fs-4"></i>
                        <span class="small">Plomería</span>
                    </a>
                    <a href="#" class="service-nav-item d-flex flex-column align-items-center gap-2 text-decoration-none pb-3 border-bottom border-3 border-transparent text-secondary fw-medium">
                        <i class="fas fa-plug fs-4"></i>
                        <span class="small">Electricistas</span>
                    </a>
                    <a href="#" class="service-nav-item d-flex flex-column align-items-center gap-2 text-decoration-none pb-3 border-bottom border-3 border-transparent text-secondary fw-medium">
                        <i class="fas fa-paint-roller fs-4"></i>
                        <span class="small">Pintura</span>
                    </a>
                    <a href="#" class="service-nav-item d-flex flex-column align-items-center gap-2 text-decoration-none pb-3 border-bottom border-3 border-transparent text-secondary fw-medium">
                        <i class="fas fa-snowflake fs-4"></i>
                        <span class="small">Climatización</span>
                    </a>
                </div>
                <button class="scroll-right-btn btn btn-white border rounded-circle shadow-sm position-absolute end-0 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; z-index: 10;">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero position-relative d-flex align-items-center justify-content-center text-center text-white" style="height: 500px; background-image: url('https://images.unsplash.com/photo-1581578731117-104f2a863a30?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80'); background-size: cover; background-position: center;">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
        <div class="hero-content position-relative z-1 container" style="max-width: 800px;">
            <h1 class="display-4 fw-bold mb-4 text-shadow">Encuentra profesionales locales para cualquier proyecto</h1>
            <form action="/search" method="get" class="search-bar bg-white p-2 rounded-pill shadow d-flex align-items-center mx-auto" style="max-width: 700px;">
                <div class="input-group border-end">
                    <span class="input-group-text bg-transparent border-0 text-secondary"><i class="fas fa-search"></i></span>
                    <input type="text" name="q" class="form-control border-0 shadow-none" placeholder="¿Qué necesitas hacer?">
                </div>
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-0 text-secondary"><i class="fas fa-map-marker-alt"></i></span>
                    <input type="text" name="zip" class="form-control border-0 shadow-none" placeholder="Código postal (Colombia)">
                </div>
                <button type="submit" class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center p-0 ms-2" style="width: 48px; height: 48px;">
                    <i class="fas fa-search"></i>
                </button>
            </form>
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
                    <div class="card border-0 rounded-4 overflow-hidden text-white shadow-sm h-100 position-relative card-img-overlay-container">
                        <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" class="card-img h-100 object-fit-cover" alt="Electricidad">
                        <div class="card-img-overlay d-flex align-items-end p-0">
                            <div class="w-100 p-4 bg-gradient-overlay">
                                <h5 class="card-title fw-bold mb-0">Electricidad</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Obra -->
                <div class="col">
                    <div class="card border-0 rounded-4 overflow-hidden text-white shadow-sm h-100 position-relative card-img-overlay-container">
                        <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" class="card-img h-100 object-fit-cover" alt="Obra y Construcción">
                        <div class="card-img-overlay d-flex align-items-end p-0">
                            <div class="w-100 p-4 bg-gradient-overlay">
                                <h5 class="card-title fw-bold mb-0">Obra y Construcción</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Plomería -->
                <div class="col">
                    <div class="card border-0 rounded-4 overflow-hidden text-white shadow-sm h-100 position-relative card-img-overlay-container">
                        <img src="https://images.unsplash.com/photo-1585704032915-c3400ca199e7?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" class="card-img h-100 object-fit-cover" alt="Plomería">
                        <div class="card-img-overlay d-flex align-items-end p-0">
                            <div class="w-100 p-4 bg-gradient-overlay">
                                <h5 class="card-title fw-bold mb-0">Plomería</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Domótica -->
                <div class="col">
                    <div class="card border-0 rounded-4 overflow-hidden text-white shadow-sm h-100 position-relative card-img-overlay-container">
                        <img src="https://images.unsplash.com/photo-1558002038-1091a166111c?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" class="card-img h-100 object-fit-cover" alt="Domótica">
                        <div class="card-img-overlay d-flex align-items-end p-0">
                            <div class="w-100 p-4 bg-gradient-overlay">
                                <h5 class="card-title fw-bold mb-0">Domótica</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mascotas -->
                <div class="col">
                    <div class="card border-0 rounded-4 overflow-hidden text-white shadow-sm h-100 position-relative card-img-overlay-container">
                        <img src="https://images.unsplash.com/photo-1517635676447-3a326f5ebc3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" class="card-img h-100 object-fit-cover" alt="Mascotas">
                        <div class="card-img-overlay d-flex align-items-end p-0">
                            <div class="w-100 p-4 bg-gradient-overlay">
                                <h5 class="card-title fw-bold mb-0">Cuidado de Mascotas</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Control de Plagas -->
                <div class="col">
                    <div class="card border-0 rounded-4 overflow-hidden text-white shadow-sm h-100 position-relative card-img-overlay-container">
                        <img src="https://images.unsplash.com/photo-1629196914375-f7e48f477b6d?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" class="card-img h-100 object-fit-cover" alt="Control de Plagas">
                        <div class="card-img-overlay d-flex align-items-end p-0">
                            <div class="w-100 p-4 bg-gradient-overlay">
                                <h5 class="card-title fw-bold mb-0">Control de Plagas</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light py-5 border-top mt-auto">
        <div class="container" style="max-width: 1200px;">
            <div class="row g-4">
                <div class="col-md-4">
                    <h4 class="h5 fw-bold mb-3">Brixo</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-underline">Sobre nosotros</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-underline">Carreras</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-underline">Prensa</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4 class="h5 fw-bold mb-3">Clientes</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-underline">Cómo funciona</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-underline">Seguridad</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-underline">Ayuda</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4 class="h5 fw-bold mb-3">Profesionales</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-underline">Únete como pro</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-underline">Historias de éxito</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-secondary hover-underline">Recursos</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4 rounded-4 shadow">
                <div class="modal-header border-0 p-0 mb-4">
                    <h2 class="modal-title fs-4 fw-bold" id="loginModalLabel">Iniciar sesión</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <?php if (! empty($message)): ?>
                        <div class="alert alert-success"><?= esc($message) ?></div>
                    <?php endif; ?>
                    <?php if (! empty($error)): ?>
                        <div class="alert alert-danger"><?= esc($error) ?></div>
                    <?php endif; ?>

                    <form method="post" action="/">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="correo" class="form-label fw-semibold">Correo electrónico</label>
                            <input id="correo" name="correo" type="email" class="form-control p-3 rounded-3" placeholder="nombre@ejemplo.com" required>
                        </div>
                        <div class="mb-4">
                            <label for="contrasena" class="form-label fw-semibold">Contraseña</label>
                            <input id="contrasena" name="contrasena" type="password" class="form-control p-3 rounded-3" placeholder="Tu contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold">Entrar</button>
                    </form>
                    <div class="mt-3 text-center">
                        <p class="text-secondary">¿No tienes cuenta? <a href="/signup" class="text-primary fw-bold text-decoration-none">Regístrate</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Show modal if there are errors (so user sees the error message)
        <?php if (! empty($error)): ?>
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        <?php endif; ?>
    </script>

</body>

</html>