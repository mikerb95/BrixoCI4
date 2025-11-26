<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Regístrate en Brixo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/styles.css">
    <style>
        .role-selector {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            justify-content: center;
        }
        .role-btn {
            padding: 1rem 2rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            flex: 1;
            max-width: 200px;
            text-align: center;
        }
        .role-btn.active {
            border-color: #007bff;
            background-color: #f0f7ff;
            color: #007bff;
        }
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
            animation: fadeIn 0.5s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .auth-container {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <h1 style="text-align: center; margin-bottom: 2rem;">Únete a Brixo</h1>
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert error" style="margin-bottom: 1rem; padding: 1rem; background: #fee; color: #c00; border-radius: 4px;">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (isset($validation)): ?>
            <div class="alert error" style="margin-bottom: 1rem; padding: 1rem; background: #fee; color: #c00; border-radius: 4px;">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <div class="role-selector">
            <div class="role-btn active" onclick="selectRole('cliente')">
                <h3>Usuario</h3>
                <small>Busco servicios</small>
            </div>
            <div class="role-btn" onclick="selectRole('contratista')">
                <h3>Profesional</h3>
                <small>Ofrezco servicios</small>
            </div>
        </div>

        <form action="/signup" method="post" id="signupForm">
            <?= csrf_field() ?>
            <input type="hidden" name="tipo_usuario" id="tipo_usuario" value="cliente">

            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" required value="<?= old('nombre') ?>" class="form-control">
            </div>

            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" required value="<?= old('correo') ?>" class="form-control">
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" required value="<?= old('telefono') ?>" class="form-control">
            </div>

            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" required class="form-control">
            </div>

            <div class="form-group">
                <label for="confirmar_contrasena">Confirmar Contraseña</label>
                <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required class="form-control">
            </div>

            <!-- Campos específicos para contratista (inicialmente ocultos) -->
            <div id="contratista-fields" style="display: none;">
                <div class="form-group">
                    <label for="profesion">Profesión / Especialidad</label>
                    <input type="text" id="profesion" name="profesion" placeholder="Ej: Plomero, Electricista..." value="<?= old('profesion') ?>" class="form-control">
                    <small>Esto aparecerá en tu perfil público</small>
                </div>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; margin-top: 1rem; padding: 1rem; background: #007bff; color: white; border: none; border-radius: 4px; font-size: 1.1rem; cursor: pointer;">
                Registrarme
            </button>
        </form>

        <p style="text-align: center; margin-top: 1.5rem;">
            ¿Ya tienes cuenta? <a href="/">Inicia sesión aquí</a>
        </p>
    </div>

    <script>
        function selectRole(role) {
            // Update hidden input
            document.getElementById('tipo_usuario').value = role;

            // Update UI classes
            const buttons = document.querySelectorAll('.role-btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            
            if (role === 'cliente') {
                buttons[0].classList.add('active');
                document.getElementById('contratista-fields').style.display = 'none';
            } else {
                buttons[1].classList.add('active');
                document.getElementById('contratista-fields').style.display = 'block';
            }
        }

        // Check URL params for role
        const urlParams = new URLSearchParams(window.location.search);
        const roleParam = urlParams.get('role');
        if (roleParam === 'contratista') {
            selectRole('contratista');
        }
    </script>
</body>
</html>