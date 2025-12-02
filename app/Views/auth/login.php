<?= view('partials/header') ?>

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