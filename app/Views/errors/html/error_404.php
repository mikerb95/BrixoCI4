<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Página no encontrada - Brixo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/brixo.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
</head>

<body class="d-flex flex-column min-vh-100">
    <?= view('partials/navbar') ?>

    <!-- 404 Content -->
    <section class="d-flex align-items-center justify-content-center flex-grow-1 py-5 text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h1 class="display-1 fw-bold text-primary mb-3">404</h1>
                    <h2 class="h3 fw-bold mb-4">¡Ups! Página no encontrada</h2>
                    <p class="lead text-secondary mb-5">
                        Lo sentimos, la página que estás buscando no existe o ha sido movida.
                        Tal vez quieras volver al inicio o buscar un profesional.
                    </p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="/" class="btn btn-primary btn-lg rounded-pill px-4 fw-bold">
                            <i class="fas fa-home me-2"></i>Volver al Inicio
                        </a>
                        <a href="/map" class="btn btn-outline-dark btn-lg rounded-pill px-4 fw-bold">
                            <i class="fas fa-map-marked-alt me-2"></i>Ver Mapa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Partial -->
    <?= view('partials/footer') ?>

    <script>
        // Asegurar que la navbar flotante esté visible en 404 y no interfiera con layout
        (function () {
            const nav = document.getElementById('floating-nav');
            if (nav) {
                nav.classList.add('visible');
                document.body.classList.add('floating-offset');
            }
        })();
    </script>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4 rounded-4 shadow">
                <div class="modal-header border-0 p-0 mb-4">
                    <h2 class="modal-title fs-4 fw-bold" id="loginModalLabel">Iniciar sesión</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <form method="post" action="/login">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="correo" class="form-label fw-semibold">Correo electrónico</label>
                            <input id="correo" name="correo" type="email" class="form-control p-3 rounded-3"
                                placeholder="nombre@ejemplo.com" required>
                        </div>
                        <div class="mb-4">
                            <label for="contrasena" class="form-label fw-semibold">Contraseña</label>
                            <input id="contrasena" name="contrasena" type="password" class="form-control p-3 rounded-3"
                                placeholder="Tu contraseña" required>
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
                    <form method="post" action="/register">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="register">
                        <div class="mb-3">
                            <label for="registro_nombre" class="form-label fw-semibold">Nombre</label>
                            <input id="registro_nombre" name="nombre" type="text" class="form-control p-3 rounded-3"
                                placeholder="Tu nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="registro_correo" class="form-label fw-semibold">Correo electrónico</label>
                            <input id="registro_correo" name="correo" type="email" class="form-control p-3 rounded-3"
                                placeholder="nombre@ejemplo.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="registro_telefono" class="form-label fw-semibold">Teléfono</label>
                            <input id="registro_telefono" name="telefono" type="tel" class="form-control p-3 rounded-3"
                                placeholder="3101234567">
                        </div>
                        <div class="mb-3">
                            <label for="registro_contrasena" class="form-label fw-semibold">Contraseña</label>
                            <input id="registro_contrasena" name="contrasena" type="password"
                                class="form-control p-3 rounded-3" placeholder="Crea una contraseña" required>
                        </div>
                        <div class="mb-4">
                            <label for="registro_rol" class="form-label fw-semibold">Tipo de cuenta</label>
                            <select id="registro_rol" name="rol" class="form-select p-3 rounded-3" required>
                                <option value="cliente">Cliente</option>
                                <option value="contratista">Contratista</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold">Registrarme</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/nav-floating.js"></script>
</body>

</html>