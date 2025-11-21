README.md

---------

## Flujo de inicio de sesión y registro

- La ruta `/` (controlador `Home::index`) muestra el formulario de inicio de sesión. Valida que se envíen `correo` y `contrasena`, busca el registro en la tabla `ADMINISTRADOR` y compara la contraseña usando `password_verify()`. Por compatibilidad, todavía acepta contraseñas planas si existieran datos antiguos. Tras un inicio de sesión exitoso se regenera la sesión y se guarda la información mínima del usuario.
- La vista `app/Views/index.php` carga `public/css/styles.css` y muestra mensajes flash (`message` y `error`). Cuando no hay sesión activa incluye un enlace a `/register`.
- La ruta `/register` (controlador `Auth::register`) sirve tanto GET como POST. En GET muestra `app/Views/auth/register.php`. En POST valida `nombre`, `correo` (único en la tabla) y la confirmación de contraseña. Si todo es correcto inserta el administrador con `password_hash()` y redirige a `/` con un mensaje de éxito.
- Las rutas están definidas en `app/Config/Routes.php`. `/logout` destruye la sesión y redirige a `/`.
- Todos los formularios incluyen `csrf_field()` y dependen del helper `form`, que se carga desde los controladores correspondientes antes de renderizar las vistas.
