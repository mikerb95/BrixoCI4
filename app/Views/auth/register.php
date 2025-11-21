<!DOCTYPE html> <!-- Documento HTML para registro de admins -->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear cuenta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/styles.css"> <!-- Carga los estilos globales -->
</head>
<body>
<main class="card"> <!-- Contenedor principal con estilos -->
    <h1>Crear cuenta</h1>
    <p>Completa el formulario para agregar un nuevo administrador.</p>

    <?php if (! empty($message)): ?> <!-- Mensaje positivo -->
        <div class="alert success"><?= esc($message) ?></div>
    <?php endif; ?>

    <?php if (! empty($error)): ?> <!-- Mensaje de error -->
        <div class="alert error"><?= esc($error) ?></div>
    <?php endif; ?>

    <?php if (isset($validation) && $validation !== null): ?> <!-- Lista los errores de validacion -->
        <div class="alert error">
            <ul>
                <?php foreach ($validation->getErrors() as $validationError): ?>
                    <li><?= esc($validationError) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="/register"> <!-- Formulario principal -->
        <?= csrf_field() ?> <!-- Token CSRF -->
        <div>
            <label for="nombre">Nombre</label>
            <input id="nombre" name="nombre" type="text" value="<?= old('nombre') ?>" placeholder="Admin" required>
        </div>
        <div>
            <label for="correo">Correo</label>
            <input id="correo" name="correo" type="email" value="<?= old('correo') ?>" placeholder="admin@brixo.com" required>
        </div>
        <div>
            <label for="contrasena">Contraseña</label>
            <input id="contrasena" name="contrasena" type="password" placeholder="Mínimo 8 caracteres" required>
        </div>
        <div>
            <label for="contrasena_confirmar">Confirmar contraseña</label>
            <input id="contrasena_confirmar" name="contrasena_confirmar" type="password" placeholder="Repite la contraseña" required>
        </div>
        <button type="submit">Registrar</button>
    </form>

    <p><a class="button-link" href="/">Volver al inicio de sesión</a></p> <!-- Enlace para volver al login -->
</main>
</body>
</html>