<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        :root {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: #111;
            background: #f2f2f2;
        }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(0,0,0,.1);
            padding: 2rem;
            max-width: 420px;
            width: 100%;
        }
        h1 {
            margin-top: 0;
            font-size: 1.8rem;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        label {
            font-size: .9rem;
            color: #444;
        }
        input {
            width: 100%;
            border-radius: 8px;
            border: 1px solid #dcdcdc;
            padding: .8rem;
            font-size: 1rem;
        }
        button, a.button-link {
            border: none;
            border-radius: 8px;
            background: #111;
            color: #fff;
            padding: .9rem 1rem;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }
        button:hover,
        a.button-link:hover {
            background: #333;
        }
        .alert {
            border-radius: 8px;
            padding: .9rem 1rem;
            margin-bottom: 1rem;
        }
        .alert.error {
            background: #fdecea;
            color: #b42318;
            border: 1px solid #f9c0ba;
        }
        .alert.success {
            background: #edf9f0;
            color: #1b7c3a;
            border: 1px solid #bfe6c9;
        }
        .logged-info {
            display: flex;
            flex-direction: column;
            gap: .7rem;
        }
        small {
            color: #666;
        }
    </style>
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