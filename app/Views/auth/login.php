<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión - Brixo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/css/brixo.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <?= view('partials/navbar') ?>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">Iniciar sesión</h3>

                    <?php if (!empty($login_error)): ?>
                        <div class="alert alert-danger"><?= esc($login_error) ?></div>
                    <?php endif; ?>

                    <form method="post" action="/login">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo electrónico</label>
                            <input id="correo" name="correo" type="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input id="contrasena" name="contrasena" type="password" class="form-control" required>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?= view('partials/footer') ?>
</body>
</html>