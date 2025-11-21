<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<main class="card">
    <?php if (! empty($user)): ?>
        <h1>Hola, <?= esc($user['nombre']) ?> 👋</h1>
        <?php if (! empty($message)): ?>
            <div class="alert success"><?= esc($message) ?></div>
        <?php endif; ?>
        <div class="logged-info">
            <p>Ya estás dentro. Puedes cerrar sesión cuando quieras.</p>
            <small>Correo: <?= esc($user['correo']) ?></small>
            <a class="button-link" href="/logout">Cerrar sesión</a>
        </div>
    <?php else: ?>
        <h1>Iniciar sesión</h1>
        <p>Escribe el correo y la contraseña tal como aparecen en la tabla ADMINISTRADOR.</p>
        <?php if (! empty($message)): ?>
            <div class="alert success"><?= esc($message) ?></div>
        <?php endif; ?>
        <?php if (! empty($error)): ?>
            <div class="alert error"><?= esc($error) ?></div>
        <?php endif; ?>
        <form method="post" action="/">
            <?= csrf_field() ?>
            <div>
                <label for="correo">Correo</label>
                <input id="correo" name="correo" type="email" placeholder="admin@brixo.com" required>
            </div>
            <div>
                <label for="contrasena">Contraseña</label>
                <input id="contrasena" name="contrasena" type="password" placeholder="Escribe tu contraseña" required>
            </div>
            <button type="submit">Entrar</button>
        </form>
    <?php endif; ?>
</main>
</body>
</html>