<?php
/**
 * Setup: Tabla ADMIN
 * ──────────────────
 * Ejecuta este archivo UNA VEZ para crear la tabla de administradores
 * y el usuario admin por defecto.
 *
 * Acceder a: /setup_admin.php
 *
 * Credenciales por defecto:
 *   Correo:    admin@brixo.co
 *   Contraseña: Admin123!
 */

// Bootstrap de CodeIgniter
$pathsConfig = __DIR__ . '/../app/Config/Paths.php';
require $pathsConfig;
$paths = new Config\Paths();

$bootstrap = rtrim($paths->systemDirectory, '\\/ ') . '/bootstrap.php';
require_once $bootstrap;

$app = \Config\Services::codeigniter();
$app->initialize();
$app->setContext('web');

$db = \Config\Database::connect();

echo "<h2>🔧 Setup: Tabla ADMIN</h2>";
echo "<pre style='background:#222;color:#0f0;padding:20px;border-radius:8px;'>";

// 1. Crear tabla ADMIN
try {
    $db->query("
        CREATE TABLE IF NOT EXISTS ADMIN (
            id_admin INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(255) NOT NULL,
            correo VARCHAR(255) NOT NULL UNIQUE,
            contrasena VARCHAR(255) NOT NULL,
            foto_perfil VARCHAR(255) DEFAULT NULL,
            activo TINYINT(1) DEFAULT 1,
            creado_en DATETIME DEFAULT CURRENT_TIMESTAMP,
            ultimo_acceso DATETIME DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    echo "✅ Tabla ADMIN creada correctamente.\n";
} catch (\Exception $e) {
    echo "⚠️  Error creando tabla ADMIN: " . $e->getMessage() . "\n";
}

// 2. Insertar admin por defecto (solo si no existe)
try {
    $exists = $db->table('ADMIN')->where('correo', 'admin@brixo.co')->countAllResults();
    
    if ($exists === 0) {
        $db->table('ADMIN')->insert([
            'nombre'     => 'Administrador',
            'correo'     => 'admin@brixo.co',
            'contrasena' => password_hash('Admin123!', PASSWORD_BCRYPT),
            'activo'     => 1,
        ]);
        echo "✅ Admin por defecto creado: admin@brixo.co / Admin123!\n";
    } else {
        echo "ℹ️  El admin admin@brixo.co ya existe, no se insertó.\n";
    }
} catch (\Exception $e) {
    echo "⚠️  Error insertando admin: " . $e->getMessage() . "\n";
}

echo "\n──────────────────────────────────────────────\n";
echo "🎉 Setup completado.\n";
echo "   Accede al panel admin en: /admin\n";
echo "   Correo:    admin@brixo.co\n";
echo "   Contraseña: Admin123!\n";
echo "──────────────────────────────────────────────\n";
echo "</pre>";
