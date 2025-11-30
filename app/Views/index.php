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
</head>

<body>

    <!-- Hero Section with simple nav -->
    <section class="hero position-relative d-flex align-items-center justify-content-center text-center text-white" style="height: 100vh; background-image: url(https://brixo-services.vercel.app/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fhero2.457d5ba2.jpg&w=1920&q=75); background-size: cover; background-position: center;">
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
        <!-- Simple hero nav -->
        <nav id="hero-nav" class="hero-nav position-absolute top-0 start-0 w-100 d-flex justify-content-end gap-4 py-3 px-4">
            <a href="/" class="hero-link">Inicio</a>
            <a href="/mapa" class="hero-link">Mapa</a>
            <?php if (! empty(session()->get('user'))): ?>
                <a href="/logout" class="hero-link">Salir</a>
            <?php else: ?>
                <a href="#" class="hero-link" data-bs-toggle="modal" data-bs-target="#loginModal">Ingresar</a>
            <?php endif; ?>
        </nav>
        <!-- Floating navbar (hidden initially) -->
        <nav id="floating-nav" class="floating-navbar">
            <div class="d-flex align-items-center w-100 justify-content-between">
                <div class="d-flex align-items-center gap-4">
                    <a href="/" class="brand fw-bold">BRIXO</a>
                </div>
                <ul class="d-flex list-unstyled mb-0 align-items-center gap-3">
                    <li><a href="/mapa" class="float-link">Mapa</a></li>
                    <?php if (! empty(session()->get('user'))): ?>
                        <li><a href="/logout" class="float-link">Salir</a></li>
                    <?php else: ?>
                        <li><a href="#" class="float-link" data-bs-toggle="modal" data-bs-target="#loginModal">Ingresar</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <div class="container position-relative z-1">
            <div class="row align-items-center">
                <div class="col-lg-7 text-start mb-5 mb-lg-0">
                    <h1 class="display-3 fw-bold mb-4 lh-sm">Profesionales<br>confiables, cuando<br>los necesitas</h1>
                    <p class="fs-5 mb-4 fw-light" style="max-width: 600px;">Reserva por horas a expertos en obra, carpintería, plomería y más. Publica tu necesidad o reserva de inmediato.</p>
                    <div class="d-flex flex-wrap gap-3 align-items-center">
                        <a href="/mapa" class="btn btn-primary btn-lg rounded-pill px-4 fw-bold">Explorar Mapa</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card bg-dark bg-opacity-50 border-secondary border-opacity-50 text-white p-4 rounded-4 backdrop-blur">
                        <h5 class="fw-bold mb-4">Categorías populares</h5>
                        <div class="row g-3">
                            <div class="col-6">
                                <a href="/mapa" class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span>Obra</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/mapa" class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span>Carpintería</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/mapa" class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span>Plomería</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/mapa" class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span>Electricidad</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/mapa" class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
                                    <span>Pintura</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="/mapa" class="btn btn-outline-light w-100 text-start py-2 px-3 rounded-3 d-flex justify-content-between align-items-center">
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
                    <!-- Registration disabled -->
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Show modal if there are errors
        <?php if (! empty($error)): ?>
            var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        <?php endif; ?>

        const hero = document.querySelector('.hero');
        const floatingNav = document.getElementById('floating-nav');
        const heroNav = document.getElementById('hero-nav');
        const threshold = () => hero.offsetHeight * 0.6; // appear after 60% scroll of hero

        function onScroll() {
            if (window.scrollY > threshold()) {
                floatingNav.classList.add('visible');
                heroNav.classList.add('hidden');
            } else {
                floatingNav.classList.remove('visible');
                heroNav.classList.remove('hidden');
            }
        }

        window.addEventListener('scroll', onScroll);
        window.addEventListener('resize', onScroll);
        onScroll();
    </script>

</body>

</html>