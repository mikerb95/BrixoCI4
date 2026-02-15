<?php

namespace App\Controllers;

class Setup extends BaseController
{
    public function solicitudes()
    {
        $db = db_connect();

        $sql = "
        CREATE TABLE IF NOT EXISTS SOLICITUD (
            id_solicitud INT AUTO_INCREMENT PRIMARY KEY,
            id_cliente INT NOT NULL,
            id_contratista INT NULL, -- NULL significa que es una solicitud abierta para todos
            titulo VARCHAR(150) NOT NULL,
            descripcion TEXT NOT NULL,
            presupuesto DECIMAL(12,2) DEFAULT 0,
            ubicacion VARCHAR(255),
            estado ENUM('ABIERTA', 'ASIGNADA', 'COMPLETADA', 'CANCELADA') DEFAULT 'ABIERTA',
            creado_en DATETIME DEFAULT CURRENT_TIMESTAMP,
            CONSTRAINT fk_solicitud_cliente FOREIGN KEY (id_cliente) REFERENCES CLIENTE(id_cliente) ON DELETE CASCADE,
            CONSTRAINT fk_solicitud_contratista FOREIGN KEY (id_contratista) REFERENCES CONTRATISTA(id_contratista) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";

        try {
            $db->query($sql);
            echo "<h1>✅ Tabla SOLICITUD creada correctamente.</h1>";
            echo "<p>La base de datos se ha actualizado usando la conexión nativa de CodeIgniter.</p>";
            echo "<p><a href='/panel'>Volver al Panel</a></p>";
        } catch (\Throwable $e) {
            echo "<h1>❌ Error al crear la tabla:</h1>";
            echo "<pre>" . $e->getMessage() . "</pre>";
        }
    }

    public function update_cliente()
    {
        $db = db_connect();
        try {
            // Check if column exists
            $fields = $db->getFieldData('CLIENTE');
            $exists = false;
            foreach ($fields as $field) {
                if ($field->name === 'ciudad') {
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {
                $db->query("ALTER TABLE CLIENTE ADD COLUMN ciudad VARCHAR(100) AFTER telefono");
                echo "<h1>✅ Columna 'ciudad' agregada a la tabla CLIENTE.</h1>";
            } else {
                echo "<h1>ℹ️ La columna 'ciudad' ya existe en la tabla CLIENTE.</h1>";
            }
            echo "<p><a href='/'>Volver al Inicio</a></p>";
        } catch (\Throwable $e) {
            echo "<h1>❌ Error:</h1>";
            echo "<pre>" . $e->getMessage() . "</pre>";
        }
    }

    public function update_fotos()
    {
        $db = db_connect();
        try {
            // Check CLIENTE
            $fields = $db->getFieldData('CLIENTE');
            $exists = false;
            foreach ($fields as $field) {
                if ($field->name === 'foto_perfil') {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $db->query("ALTER TABLE CLIENTE ADD COLUMN foto_perfil VARCHAR(255) DEFAULT NULL");
                echo "<h1>✅ Columna 'foto_perfil' agregada a CLIENTE.</h1>";
            } else {
                echo "<h1>ℹ️ Columna 'foto_perfil' ya existe en CLIENTE.</h1>";
            }

            // Check CONTRATISTA
            $fields = $db->getFieldData('CONTRATISTA');
            $exists = false;
            foreach ($fields as $field) {
                if ($field->name === 'foto_perfil') {
                    $exists = true;
                    break;
                }
            }
            if (!$exists) {
                $db->query("ALTER TABLE CONTRATISTA ADD COLUMN foto_perfil VARCHAR(255) DEFAULT NULL");
                echo "<h1>✅ Columna 'foto_perfil' agregada a CONTRATISTA.</h1>";
            } else {
                echo "<h1>ℹ️ Columna 'foto_perfil' ya existe en CONTRATISTA.</h1>";
            }

            echo "<p><a href='/panel'>Volver al Panel</a></p>";

        } catch (\Throwable $e) {
            echo "<h1>❌ Error:</h1>";
            echo "<pre>" . $e->getMessage() . "</pre>";
        }
    }

    public function mensajes()
    {
        $db = db_connect();

        $sql = "
        CREATE TABLE IF NOT EXISTS MENSAJE (
            id_mensaje INT AUTO_INCREMENT PRIMARY KEY,
            remitente_id INT NOT NULL,
            remitente_rol ENUM('cliente', 'contratista') NOT NULL,
            destinatario_id INT NOT NULL,
            destinatario_rol ENUM('cliente', 'contratista') NOT NULL,
            contenido TEXT NOT NULL,
            leido TINYINT(1) DEFAULT 0,
            creado_en DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ";

        try {
            $db->query($sql);
            echo "<h1>✅ Tabla MENSAJE creada correctamente.</h1>";
            echo "<p>Sistema de mensajería listo para usar.</p>";
            echo "<p><a href='/mensajes'>Ir a Mensajes</a></p>";
        } catch (\Throwable $e) {
            echo "<h1>❌ Error al crear la tabla:</h1>";
            echo "<pre>" . $e->getMessage() . "</pre>";
        }
    }

    /**
     * Inserta 1000 clientes con información realista colombiana.
     * Endpoint: /setup/seed-clientes
     */
    public function seed_clientes()
    {
        $db = db_connect();

        // --- Datos base para generación realista ---
        $nombres_m = [
            'Juan','Carlos','Andrés','Luis','Jorge','Pedro','Miguel','Santiago','Sebastián','Daniel',
            'Felipe','Alejandro','David','Diego','Nicolás','Camilo','Sergio','Ricardo','Óscar','Fernando',
            'Hernán','Mauricio','Rafael','Fabián','Gustavo','Roberto','Eduardo','Iván','Álvaro','Julio',
            'Francisco','Javier','Mario','César','Enrique','Tomás','Pablo','Arturo','Gerardo','Manuel',
            'Cristian','Brayan','Esteban','Martín','Gabriel','Héctor','Hugo','Leonardo','Mateo','Samuel',
        ];
        $nombres_f = [
            'María','Laura','Ana','Carolina','Valentina','Natalia','Camila','Paula','Andrea','Diana',
            'Sofía','Isabella','Lucía','Daniela','Juliana','Mariana','Gabriela','Catalina','Sara','Valeria',
            'Ángela','Patricia','Mónica','Sandra','Paola','Luisa','Tatiana','Marcela','Liliana','Gloria',
            'Yolanda','Adriana','Silvia','Claudia','Estefanía','Fernanda','Alejandra','Mélissa','Verónica','Manuela',
            'Elena','Rocío','Diana','Beatriz','Teresa','Rosa','Clara','Lina','Karen','Lorena',
        ];
        $apellidos = [
            'García','Rodríguez','Martínez','López','Hernández','González','Pérez','Sánchez','Ramírez','Torres',
            'Flores','Rivera','Gómez','Díaz','Cruz','Morales','Reyes','Gutiérrez','Ortiz','Vásquez',
            'Castillo','Jiménez','Moreno','Romero','Álvarez','Ruiz','Mendoza','Aguilar','Medina','Castro',
            'Vargas','Ramos','Herrera','Suárez','Ríos','Rojas','Acosta','Pardo','Molina','Duarte',
            'Salazar','Quintero','Pineda','Lozano','Carrillo','Navas','Peña','Correa','Castaño','Bernal',
            'Ospina','Zapata','Mejía','Cardona','Valencia','Gil','Cárdenas','Arango','Sierra','Duque',
            'Parra','Beltrán','Campos','Vega','Muñoz','Giraldo','Echeverri','Marín','Soto','Guerra',
            'Prieto','Barrera','Delgado','Bohórquez','Caicedo','Londoño','Rey','Arias','Cortés','Cabrera',
        ];
        $ciudades = [
            'Bogotá','Medellín','Cali','Barranquilla','Cartagena','Bucaramanga','Pereira','Manizales',
            'Santa Marta','Ibagué','Cúcuta','Villavicencio','Pasto','Neiva','Montería','Armenia',
            'Popayán','Valledupar','Tunja','Sincelejo',
        ];
        $barrios = [
            'Chapinero','Usaquén','Suba','Kennedy','Engativá','Fontibón','Teusaquillo','La Candelaria',
            'Laureles','El Poblado','Belén','Envigado','San Fernando','Granada','Ciudad Jardín',
            'El Prado','Alto Prado','Riomar','Buenavista','Manga','Bocagrande','Cabecera','Real de Minas',
            'Centro','La Aurora','Cedritos','Niza','Santa Bárbara','Chicó','La Soledad','Galerías',
            'Normandía','Modelia','Hayuelos','Santa Isabel','Restrepo','La Macarena','Palermo',
            'San Cristóbal','Quinta Paredes','Las Américas','La Floresta','El Campín','Nicolás de Federmán',
        ];
        $tipos_via = ['Calle','Carrera','Avenida','Transversal','Diagonal'];
        $dominios = ['gmail.com','hotmail.com','outlook.com','yahoo.com','live.com'];

        // Contraseña: "password" (bcrypt hash estándar)
        $hash_password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

        // Función para limpiar acentos para emails
        $limpiar = function (string $str): string {
            $map = [
                'á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u',
                'Á'=>'A','É'=>'E','Í'=>'I','Ó'=>'O','Ú'=>'U',
                'ñ'=>'n','Ñ'=>'N','ü'=>'u','Ü'=>'U',
            ];
            return strtr(mb_strtolower($str, 'UTF-8'), $map);
        };

        $total = 1000;
        $insertados = 0;
        $duplicados = 0;
        $errores = [];
        $usedEmails = [];
        $startTime = microtime(true);

        // Cabecera HTML
        echo "<!DOCTYPE html><html lang='es'><head><meta charset='utf-8'><title>Seed 1000 Clientes</title>
        <style>
            body { font-family: 'Segoe UI', sans-serif; max-width: 800px; margin: 40px auto; padding: 0 20px; background: #f8f9fa; }
            .card { background: white; border-radius: 12px; padding: 30px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); margin-bottom: 20px; }
            h1 { color: #2d3436; }
            .stat { display: inline-block; background: #dfe6e9; border-radius: 8px; padding: 12px 20px; margin: 5px; font-size: 1.1em; }
            .stat strong { color: #6c5ce7; }
            .success { color: #00b894; }
            .warn { color: #fdcb6e; }
            .error { color: #d63031; }
            .progress { height: 20px; background: #dfe6e9; border-radius: 10px; overflow: hidden; margin: 15px 0; }
            .progress-bar { height: 100%; background: linear-gradient(90deg, #6c5ce7, #a29bfe); border-radius: 10px; }
            a.btn { display: inline-block; margin-top: 15px; padding: 10px 25px; background: #6c5ce7; color: white; text-decoration: none; border-radius: 8px; }
            a.btn:hover { background: #5a4bd1; }
            table { width: 100%; border-collapse: collapse; margin-top: 15px; }
            th, td { padding: 8px 12px; text-align: left; border-bottom: 1px solid #eee; font-size: 0.9em; }
            th { background: #f1f2f6; }
        </style></head><body>";
        echo "<div class='card'><h1>🌱 Seed: 1000 Clientes Colombianos</h1>";
        echo "<p>Insertando clientes con datos realistas...</p></div>";

        try {
            // Verificar que la tabla existe
            $db->query("SELECT 1 FROM CLIENTE LIMIT 1");

            // Verificar campo dirección
            $fields = $db->getFieldData('CLIENTE');
            $hasDireccion = false;
            foreach ($fields as $field) {
                if ($field->name === 'direccion') {
                    $hasDireccion = true;
                    break;
                }
            }
            if (!$hasDireccion) {
                $db->query("ALTER TABLE CLIENTE ADD COLUMN direccion VARCHAR(255) DEFAULT NULL AFTER ciudad");
                echo "<div class='card'><p class='success'>✅ Columna 'direccion' agregada a CLIENTE.</p></div>";
            }

            // Generar e insertar clientes en lotes
            $batch = [];
            for ($i = 0; $i < $total; $i++) {
                $esMujer = ($i % 2 === 0);
                $nombre1 = $esMujer ? $nombres_f[array_rand($nombres_f)] : $nombres_m[array_rand($nombres_m)];
                $ap1 = $apellidos[array_rand($apellidos)];
                $ap2 = $apellidos[array_rand($apellidos)];
                $nombre_completo = "$nombre1 $ap1 $ap2";

                // Email único
                $base = $limpiar($nombre1) . '.' . $limpiar($ap1);
                $dominio = $dominios[array_rand($dominios)];
                $email = $base . ($i + 1) . '@' . $dominio;

                // Asegurar unicidad
                while (in_array($email, $usedEmails)) {
                    $email = $base . ($i + 1) . rand(10, 99) . '@' . $dominio;
                }
                $usedEmails[] = $email;

                // Teléfono colombiano realista (3xx xxx xxxx)
                $prefijos = ['300','301','302','310','311','312','313','314','315','316','317','318','319','320','321','322','323','324','325','350','351'];
                $telefono = $prefijos[array_rand($prefijos)] . rand(1000000, 9999999);

                $ciudad = $ciudades[array_rand($ciudades)];

                // Dirección colombiana realista
                $tipo_via = $tipos_via[array_rand($tipos_via)];
                $num1 = rand(1, 170);
                $num2 = rand(1, 99);
                $num3 = rand(1, 80);
                $barrio = $barrios[array_rand($barrios)];
                $direccion = "$tipo_via $num1 # $num2 - $num3, $barrio";

                // Foto de perfil (randomuser.me, IDs 1-99)
                $genero = $esMujer ? 'women' : 'men';
                $foto_id = rand(1, 99);
                $foto = "https://randomuser.me/api/portraits/$genero/$foto_id.jpg";

                $batch[] = [
                    'nombre'      => $nombre_completo,
                    'correo'      => $email,
                    'contrasena'  => $hash_password,
                    'telefono'    => $telefono,
                    'ciudad'      => $ciudad,
                    'direccion'   => $direccion,
                    'foto_perfil' => $foto,
                ];

                // Insertar en lotes de 100
                if (count($batch) >= 100) {
                    $result = $this->insertBatch($db, $batch, $hasDireccion);
                    $insertados += $result['ok'];
                    $duplicados += $result['dup'];
                    if (!empty($result['errors'])) {
                        $errores = array_merge($errores, $result['errors']);
                    }
                    $batch = [];
                }
            }
            // Insertar remanente
            if (!empty($batch)) {
                $result = $this->insertBatch($db, $batch, $hasDireccion);
                $insertados += $result['ok'];
                $duplicados += $result['dup'];
                if (!empty($result['errors'])) {
                    $errores = array_merge($errores, $result['errors']);
                }
            }

            $elapsed = round(microtime(true) - $startTime, 2);

            // Contar total en tabla
            $totalEnTabla = $db->query("SELECT COUNT(*) as total FROM CLIENTE")->getRow()->total;

            echo "<div class='card'>";
            echo "<h2 class='success'>✅ Seed completado</h2>";
            echo "<div class='progress'><div class='progress-bar' style='width:" . round($insertados/$total*100) . "%'></div></div>";
            echo "<div class='stat'>Insertados: <strong>$insertados</strong></div>";
            echo "<div class='stat'>Duplicados (omitidos): <strong>$duplicados</strong></div>";
            echo "<div class='stat'>Total en tabla: <strong>$totalEnTabla</strong></div>";
            echo "<div class='stat'>Tiempo: <strong>{$elapsed}s</strong></div>";

            if (!empty($errores)) {
                echo "<h3 class='error'>Errores (" . count($errores) . "):</h3><ul>";
                foreach (array_slice($errores, 0, 10) as $err) {
                    echo "<li>$err</li>";
                }
                if (count($errores) > 10) echo "<li>...y " . (count($errores) - 10) . " más</li>";
                echo "</ul>";
            }

            // Muestra de 10 clientes insertados
            $muestra = $db->query("SELECT id_cliente, nombre, correo, telefono, ciudad, direccion FROM CLIENTE ORDER BY id_cliente DESC LIMIT 10")->getResultArray();
            if (!empty($muestra)) {
                echo "<h3>📋 Últimos 10 clientes insertados:</h3>";
                echo "<table><tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Teléfono</th><th>Ciudad</th><th>Dirección</th></tr>";
                foreach ($muestra as $c) {
                    echo "<tr><td>{$c['id_cliente']}</td><td>{$c['nombre']}</td><td>{$c['correo']}</td><td>{$c['telefono']}</td><td>{$c['ciudad']}</td><td>{$c['direccion']}</td></tr>";
                }
                echo "</table>";
            }

            echo "<p style='margin-top:20px; color:#636e72;'>🔑 Contraseña de todos los clientes: <code>password</code></p>";
            echo "<a class='btn' href='/panel'>Ir al Panel</a> <a class='btn' href='/admin/usuarios'>Admin Usuarios</a>";
            echo "</div>";

        } catch (\Throwable $e) {
            echo "<div class='card'><h2 class='error'>❌ Error</h2>";
            echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
            echo "<a class='btn' href='/'>Volver al Inicio</a></div>";
        }

        echo "</body></html>";
    }

    /**
     * Inserta un lote de clientes manejando duplicados.
     */
    private function insertBatch($db, array $batch, bool $hasDireccion): array
    {
        $ok = 0;
        $dup = 0;
        $errors = [];

        foreach ($batch as $row) {
            try {
                if ($hasDireccion) {
                    $db->query(
                        "INSERT INTO CLIENTE (nombre, correo, contrasena, telefono, ciudad, direccion, foto_perfil) VALUES (?, ?, ?, ?, ?, ?, ?)",
                        [$row['nombre'], $row['correo'], $row['contrasena'], $row['telefono'], $row['ciudad'], $row['direccion'], $row['foto_perfil']]
                    );
                } else {
                    $db->query(
                        "INSERT INTO CLIENTE (nombre, correo, contrasena, telefono, ciudad, foto_perfil) VALUES (?, ?, ?, ?, ?, ?)",
                        [$row['nombre'], $row['correo'], $row['contrasena'], $row['telefono'], $row['ciudad'], $row['foto_perfil']]
                    );
                }
                $ok++;
            } catch (\Throwable $e) {
                if (str_contains($e->getMessage(), 'Duplicate')) {
                    $dup++;
                } else {
                    $errors[] = htmlspecialchars($e->getMessage());
                }
            }
        }

        return ['ok' => $ok, 'dup' => $dup, 'errors' => $errors];
        }

    /**
     * Test endpoint para verificar que las rutas /setup funcionan.
     */
    public function test()
    {
        echo "<h1>✅ Setup controller funciona correctamente</h1>";
        echo "<p>Si ves esto, las rutas /setup están funcionando.</p>";
        echo "<p><a href='/setup/seed-contratistas'>Probar seed-contratistas</a></p>";
    }

    /**
     * Inserta 1842 contratistas con información realista colombiana,
     * incluyendo profesiones coherentes con el negocio, servicios vinculados,
     * ubicaciones y certificaciones.
     * Endpoint: /setup/seed-contratistas
     */
    public function seed_contratistas()
    {
        $db = db_connect();

        $nombres_m = [
            'Juan','Carlos','Andrés','Luis','Jorge','Pedro','Miguel','Santiago','Sebastián','Daniel',
            'Felipe','Alejandro','David','Diego','Nicolás','Camilo','Sergio','Ricardo','Óscar','Fernando',
            'Hernán','Mauricio','Rafael','Fabián','Gustavo','Roberto','Eduardo','Iván','Álvaro','Julio',
            'Francisco','Javier','Mario','César','Enrique','Tomás','Pablo','Arturo','Gerardo','Manuel',
            'Cristian','Brayan','Esteban','Martín','Gabriel','Héctor','Hugo','Leonardo','Mateo','Samuel',
        ];
        $nombres_f = [
            'María','Laura','Ana','Carolina','Valentina','Natalia','Camila','Paula','Andrea','Diana',
            'Sofía','Isabella','Lucía','Daniela','Juliana','Mariana','Gabriela','Catalina','Sara','Valeria',
            'Ángela','Patricia','Mónica','Sandra','Paola','Luisa','Tatiana','Marcela','Liliana','Gloria',
            'Yolanda','Adriana','Silvia','Claudia','Estefanía','Fernanda','Alejandra','Melissa','Verónica','Manuela',
            'Elena','Rocío','Beatriz','Teresa','Rosa','Clara','Lina','Karen','Lorena','Viviana',
        ];
        $apellidos = [
            'García','Rodríguez','Martínez','López','Hernández','González','Pérez','Sánchez','Ramírez','Torres',
            'Flores','Rivera','Gómez','Díaz','Cruz','Morales','Reyes','Gutiérrez','Ortiz','Vásquez',
            'Castillo','Jiménez','Moreno','Romero','Álvarez','Ruiz','Mendoza','Aguilar','Medina','Castro',
            'Vargas','Ramos','Herrera','Suárez','Ríos','Rojas','Acosta','Pardo','Molina','Duarte',
            'Salazar','Quintero','Pineda','Lozano','Carrillo','Navas','Peña','Correa','Castaño','Bernal',
            'Ospina','Zapata','Mejía','Cardona','Valencia','Gil','Cárdenas','Arango','Sierra','Duque',
            'Parra','Beltrán','Campos','Vega','Muñoz','Giraldo','Echeverri','Marín','Soto','Guerra',
            'Prieto','Barrera','Delgado','Bohórquez','Caicedo','Londoño','Rey','Arias','Cortés','Cabrera',
        ];

        // Ciudades con coordenadas centro para ubicación_mapa
        $ciudades_coords = [
            'Bogotá'        => [4.7110, -74.0721],
            'Medellín'      => [6.2442, -75.5812],
            'Cali'          => [3.4516, -76.5320],
            'Barranquilla'  => [10.9685, -74.7813],
            'Cartagena'     => [10.3910, -75.5144],
            'Bucaramanga'   => [7.1193, -73.1227],
            'Pereira'       => [4.8133, -75.6961],
            'Manizales'     => [5.0689, -75.5174],
            'Santa Marta'   => [11.2408, -74.1990],
            'Ibagué'        => [4.4389, -75.2322],
            'Cúcuta'        => [7.8939, -72.5078],
            'Villavicencio' => [4.1420, -73.6266],
            'Pasto'         => [1.2136, -77.2811],
            'Neiva'         => [2.9273, -75.2819],
            'Montería'      => [8.7479, -75.8814],
            'Armenia'       => [4.5339, -75.6811],
            'Popayán'       => [2.4419, -76.6064],
            'Valledupar'    => [10.4631, -73.2532],
            'Tunja'         => [5.5353, -73.3678],
            'Sincelejo'     => [9.3047, -75.3978],
        ];
        $ciudades = array_keys($ciudades_coords);

        // Perfiles profesionales coherentes con el modelo de negocio
        // Cada uno tiene: experiencia template, descripción, servicios afines (IDs), certificaciones posibles
        $perfiles = [
            // --- Plomería (servicio ID 2) ---
            ['exp' => '{n} años en plomería residencial y comercial', 'desc' => 'Soluciones rápidas en tuberías, grifería y desagües', 'servicios' => [2], 'certs' => ['Técnico en Instalaciones Hidráulicas','Certificación en Gas Domiciliario','Plomería Residencial Avanzada']],
            ['exp' => 'Plomero con {n} años de experiencia en reparaciones de emergencia', 'desc' => 'Atención 24/7 para emergencias de plomería', 'servicios' => [2], 'certs' => ['Plomería de Emergencia','Normas NTC Gas Natural']],
            ['exp' => 'Especialista en instalaciones sanitarias con {n} años', 'desc' => 'Instalación y reparación de sistemas sanitarios completos', 'servicios' => [2,5], 'certs' => ['Instalaciones Sanitarias','Normativa Hidráulica NTC']],
            ['exp' => 'Maestro plomero con {n} años, experto en detección de fugas', 'desc' => 'Detección y reparación de fugas sin demolición', 'servicios' => [2], 'certs' => ['Detección de Fugas por Termografía','Plomería Profesional']],

            // --- Electricidad (servicio ID 3) ---
            ['exp' => 'Electricista certificado CONTE con {n} años de experiencia', 'desc' => 'Instalaciones eléctricas residenciales y comerciales seguras', 'servicios' => [3], 'certs' => ['CONTE Nivel 1','CONTE Nivel 2','RETIE Actualizado']],
            ['exp' => 'Ingeniero eléctrico con {n} años de trayectoria', 'desc' => 'Diseño e instalación de redes eléctricas profesionales', 'servicios' => [3], 'certs' => ['Ingeniería Eléctrica','Certificación RETIE','Normas NTC Eléctricas']],
            ['exp' => 'Técnico electricista con {n} años en automatización del hogar', 'desc' => 'Domótica, iluminación inteligente y automatización', 'servicios' => [3], 'certs' => ['Domótica y Automatización','Instalaciones Eléctricas Residenciales']],
            ['exp' => '{n} años como electricista en proyectos residenciales e industriales', 'desc' => 'Cableado, tableros y puesta a tierra', 'servicios' => [3], 'certs' => ['CONTE Nivel 1','Seguridad Eléctrica Industrial']],

            // --- Limpieza (servicio ID 1) ---
            ['exp' => '{n} años en limpieza profesional de hogares y oficinas', 'desc' => 'Limpieza profunda con productos ecológicos', 'servicios' => [1], 'certs' => ['Limpieza Profesional','Manejo de Productos Químicos']],
            ['exp' => 'Especialista en limpieza post-obra con {n} años de experiencia', 'desc' => 'Entregas de obra impecables, pisos, vidrios y acabados', 'servicios' => [1], 'certs' => ['Limpieza Post-Obra','Seguridad en Alturas']],
            ['exp' => '{n} años ofreciendo servicios de aseo y organización del hogar', 'desc' => 'Hogares ordenados, frescos y relucientes', 'servicios' => [1], 'certs' => ['Organización Profesional de Espacios']],
            ['exp' => 'Empresa de limpieza con {n} años en el mercado', 'desc' => 'Limpieza de edificios, oficinas y centros comerciales', 'servicios' => [1], 'certs' => ['ISO 9001 en Servicios de Limpieza','SST Vigente']],

            // --- Hogar / Pintura (servicio ID 4) ---
            ['exp' => 'Pintor profesional con {n} años de experiencia', 'desc' => 'Pintura interior y exterior, acabados perfectos', 'servicios' => [4], 'certs' => ['Técnico en Pintura Decorativa','Trabajo en Alturas']],
            ['exp' => '{n} años en pintura decorativa y artística de interiores', 'desc' => 'Murales, estuco veneciano y técnicas decorativas', 'servicios' => [4], 'certs' => ['Decoración de Interiores','Pintura Artística']],
            ['exp' => 'Maestro pintor con {n} años, especialista en acabados finos', 'desc' => 'Acabados de lujo, lacas y barnices', 'servicios' => [4], 'certs' => ['Acabados Finos de Alta Gama']],
            ['exp' => '{n} años en diseño y pintura de espacios residenciales', 'desc' => 'Transformo tu hogar con color y diseño', 'servicios' => [4], 'certs' => ['Diseño de Interiores','Asesoría en Color']],

            // --- Construcción / Remodelación (servicio ID 5) ---
            ['exp' => 'Maestro de obra con {n} años en construcción y remodelación', 'desc' => 'Construcción, ampliaciones y remodelaciones integrales', 'servicios' => [5], 'certs' => ['Maestro de Obra Certificado','SST en Construcción','Trabajo en Alturas']],
            ['exp' => 'Ingeniero civil con {n} años de experiencia en remodelación', 'desc' => 'Remodelación de baños, cocinas y espacios completos', 'servicios' => [5], 'certs' => ['Ingeniería Civil','Normativa NSR-10']],
            ['exp' => '{n} años en enchapes, pisos y acabados de construcción', 'desc' => 'Instalación de enchapes, porcelanatos y pisos laminados', 'servicios' => [5], 'certs' => ['Enchapes y Acabados','Instalación de Pisos']],
            ['exp' => 'Contratista con {n} años especializado en remodelación de baños', 'desc' => 'Baños modernos y funcionales, diseño completo', 'servicios' => [5], 'certs' => ['Remodelación Integral','Instalaciones Hidráulicas']],

            // --- Multi-servicio ---
            ['exp' => 'Todero profesional con {n} años de experiencia', 'desc' => 'Reparaciones generales del hogar: plomería, electricidad y pintura', 'servicios' => [2,3,4], 'certs' => ['Todero Profesional','Mantenimiento Locativo']],
            ['exp' => '{n} años como técnico integral de mantenimiento', 'desc' => 'Mantenimiento preventivo y correctivo de hogares y oficinas', 'servicios' => [1,2,3,4], 'certs' => ['Mantenimiento Locativo','SST Vigente']],
            ['exp' => 'Contratista multidisciplinario con {n} años de trayectoria', 'desc' => 'Construcción, remodelación y acabados completos', 'servicios' => [4,5], 'certs' => ['Gestión de Proyectos de Construcción','PMP Básico']],
            ['exp' => '{n} años en reparaciones del hogar y mantenimiento general', 'desc' => 'Soluciones completas para tu hogar', 'servicios' => [1,2,4,5], 'certs' => ['Mantenimiento General','Atención al Cliente']],

            // --- Especializados ---
            ['exp' => 'Técnico en drywall y cielos rasos con {n} años', 'desc' => 'Instalación de drywall, divisiones y cielos rasos', 'servicios' => [5], 'certs' => ['Instalación de Drywall','Trabajo en Alturas']],
            ['exp' => '{n} años en carpintería y ebanistería fina', 'desc' => 'Muebles a medida, closets, cocinas y puertas', 'servicios' => [5], 'certs' => ['Carpintería Profesional','Ebanistería y Acabados']],
            ['exp' => 'Técnico en impermeabilización con {n} años de experiencia', 'desc' => 'Impermeabilización de techos, terrazas y muros', 'servicios' => [5,2], 'certs' => ['Impermeabilización Profesional','Trabajo en Alturas']],
            ['exp' => '{n} años en instalación de pisos y porcelanatos', 'desc' => 'Pisos laminados, vinílicos y porcelanatos de alta calidad', 'servicios' => [5], 'certs' => ['Instalación de Pisos','Nivelación y Acabados']],
            ['exp' => 'Jardinero profesional con {n} años de experiencia', 'desc' => 'Paisajismo, mantenimiento de jardines y zonas verdes', 'servicios' => [1], 'certs' => ['Jardinería Profesional','Paisajismo']],
            ['exp' => '{n} años en instalación y mantenimiento de aires acondicionados', 'desc' => 'Instalación, reparación y mantenimiento de A/C y refrigeración', 'servicios' => [3], 'certs' => ['Refrigeración y Aire Acondicionado','Manipulación de Refrigerantes']],
            ['exp' => 'Cerrajero profesional con {n} años de trayectoria', 'desc' => 'Apertura, cambio de guardas, cerraduras de seguridad', 'servicios' => [4], 'certs' => ['Cerrajería Profesional','Sistemas de Seguridad']],
            ['exp' => 'Técnico en vidrios y ventanería con {n} años', 'desc' => 'Ventanas en aluminio, vidrio templado y divisiones de baño', 'servicios' => [5], 'certs' => ['Vidriero Profesional','Ventanería en Aluminio']],
        ];

        $dominios = ['gmail.com','hotmail.com','outlook.com','yahoo.com','live.com'];
        $hash_password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

        $limpiar = function (string $str): string {
            $map = ['á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u','Á'=>'A','É'=>'E','Í'=>'I','Ó'=>'O','Ú'=>'U','ñ'=>'n','Ñ'=>'N','ü'=>'u','Ü'=>'U'];
            return strtr(mb_strtolower($str, 'UTF-8'), $map);
        };

        $total = 1842;
        $insertados = 0;
        $duplicados = 0;
        $serviciosVinculados = 0;
        $certificacionesCreadas = 0;
        $ubicacionesCreadas = 0;
        $errores = [];
        $usedEmails = [];
        $startTime = microtime(true);

        echo "<!DOCTYPE html><html lang='es'><head><meta charset='utf-8'><title>Seed 1842 Contratistas</title>
        <style>
            body { font-family: 'Segoe UI', sans-serif; max-width: 900px; margin: 40px auto; padding: 0 20px; background: #f8f9fa; }
            .card { background: white; border-radius: 12px; padding: 30px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); margin-bottom: 20px; }
            h1 { color: #2d3436; } h2 { color: #636e72; }
            .stat { display: inline-block; background: #dfe6e9; border-radius: 8px; padding: 12px 20px; margin: 5px; font-size: 1.05em; }
            .stat strong { color: #6c5ce7; }
            .success { color: #00b894; } .error { color: #d63031; }
            .progress { height: 20px; background: #dfe6e9; border-radius: 10px; overflow: hidden; margin: 15px 0; }
            .progress-bar { height: 100%; background: linear-gradient(90deg, #00b894, #55efc4); border-radius: 10px; }
            a.btn { display: inline-block; margin-top: 15px; padding: 10px 25px; background: #6c5ce7; color: white; text-decoration: none; border-radius: 8px; margin-right:8px; }
            a.btn:hover { background: #5a4bd1; }
            table { width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 0.85em; }
            th, td { padding: 6px 10px; text-align: left; border-bottom: 1px solid #eee; }
            th { background: #f1f2f6; position: sticky; top: 0; }
            .table-wrap { max-height: 400px; overflow-y: auto; }
        </style></head><body>";
        echo "<div class='card'><h1>🔨 Seed: 1842 Contratistas Colombianos</h1>";
        echo "<p>Insertando contratistas con profesiones realistas, servicios vinculados, ubicaciones y certificaciones...</p></div>";

        try {
            $db->query("SELECT 1 FROM CONTRATISTA LIMIT 1");

            // Verificar campo dirección
            $fields = $db->getFieldData('CONTRATISTA');
            $hasDireccion = false;
            foreach ($fields as $field) {
                if ($field->name === 'direccion') { $hasDireccion = true; break; }
            }
            if (!$hasDireccion) {
                $db->query("ALTER TABLE CONTRATISTA ADD COLUMN direccion VARCHAR(255) DEFAULT NULL AFTER ciudad");
                echo "<div class='card'><p class='success'>✅ Columna 'direccion' agregada a CONTRATISTA.</p></div>";
                $hasDireccion = true;
            }

            // Verificar servicios
            $svcCount = $db->query("SELECT COUNT(*) as c FROM SERVICIO")->getRow()->c;
            if ($svcCount == 0) {
                echo "<div class='card'><p class='error'>⚠️ No hay servicios en la tabla SERVICIO. Ejecuta primero setup_db.</p></div></body></html>";
                return;
            }
            $serviciosExistentes = array_column($db->query("SELECT id_servicio FROM SERVICIO")->getResultArray(), 'id_servicio');

            $barrios = [
                'Chapinero','Usaquén','Suba','Kennedy','Engativá','Fontibón','Teusaquillo','La Candelaria',
                'Laureles','El Poblado','Belén','Envigado','San Fernando','Granada','Ciudad Jardín',
                'El Prado','Alto Prado','Riomar','Buenavista','Manga','Bocagrande','Cabecera','Real de Minas',
                'Centro','La Aurora','Cedritos','Niza','Santa Bárbara','Chicó','La Soledad','Galerías',
                'Normandía','Modelia','Hayuelos','Santa Isabel','Restrepo','La Macarena','Palermo',
                'San Cristóbal','Quinta Paredes','Las Américas','La Floresta','El Campín',
            ];
            $tipos_via = ['Calle','Carrera','Avenida','Transversal','Diagonal'];
            $prefijos_tel = ['300','301','302','310','311','312','313','314','315','316','317','318','319','320','321','322','323','324','325','350','351'];

            $entidades_cert = [
                'SENA','Universidad Nacional de Colombia','Universidad de los Andes','Universidad Javeriana',
                'Camacol','ICONTEC','ARL Sura','MinTrabajo','Consejo Colombiano de Seguridad',
                'Bureau Veritas Colombia','SGS Colombia','CONTE','Universidad del Valle',
                'Universidad de Antioquia','Politécnico Gran Colombiano','Compensar','ACIEM',
            ];
            $departamentos = [
                'Bogotá'=>'Cundinamarca','Medellín'=>'Antioquia','Cali'=>'Valle del Cauca',
                'Barranquilla'=>'Atlántico','Cartagena'=>'Bolívar','Bucaramanga'=>'Santander',
                'Pereira'=>'Risaralda','Manizales'=>'Caldas','Santa Marta'=>'Magdalena',
                'Ibagué'=>'Tolima','Cúcuta'=>'Norte de Santander','Villavicencio'=>'Meta',
                'Pasto'=>'Nariño','Neiva'=>'Huila','Montería'=>'Córdoba','Armenia'=>'Quindío',
                'Popayán'=>'Cauca','Valledupar'=>'Cesar','Tunja'=>'Boyacá','Sincelejo'=>'Sucre',
            ];
            $precioBase = [1 => 50000, 2 => 80000, 3 => 120000, 4 => 25000, 5 => 1500000];

            for ($i = 0; $i < $total; $i++) {
                $esMujer = ($i % 3 === 0); // ~33% mujeres
                $nombre1 = $esMujer ? $nombres_f[array_rand($nombres_f)] : $nombres_m[array_rand($nombres_m)];
                $ap1 = $apellidos[array_rand($apellidos)];
                $ap2 = $apellidos[array_rand($apellidos)];
                $nombre_completo = "$nombre1 $ap1 $ap2";

                $base = $limpiar($nombre1) . '.' . $limpiar($ap1);
                $dominio = $dominios[array_rand($dominios)];
                $email = $base . '.pro' . ($i + 1) . '@' . $dominio;
                while (in_array($email, $usedEmails)) {
                    $email = $base . '.pro' . ($i + 1) . rand(10, 99) . '@' . $dominio;
                }
                $usedEmails[] = $email;

                $telefono = $prefijos_tel[array_rand($prefijos_tel)] . rand(1000000, 9999999);
                $ciudad = $ciudades[array_rand($ciudades)];
                $coords = $ciudades_coords[$ciudad];
                $lat = round($coords[0] + (rand(-300, 300) / 10000), 6);
                $lng = round($coords[1] + (rand(-300, 300) / 10000), 6);
                $ubicacion_mapa = "$lat,$lng";

                $barrio = $barrios[array_rand($barrios)];
                $tipo_via = $tipos_via[array_rand($tipos_via)];
                $direccion = "$tipo_via " . rand(1, 170) . " # " . rand(1, 99) . " - " . rand(1, 80) . ", $barrio";

                $genero = $esMujer ? 'women' : 'men';
                $foto = "https://randomuser.me/api/portraits/$genero/" . rand(1, 99) . ".jpg";

                $perfil = $perfiles[array_rand($perfiles)];
                $anos_exp = rand(2, 25);
                $experiencia = str_replace('{n}', (string) $anos_exp, $perfil['exp']);
                $descripcion = $perfil['desc'];
                $portafolio = 'https://portfolio.example.com/' . $limpiar($nombre1) . $limpiar($ap1) . ($i + 1);
                $verificado = (rand(1, 100) <= 75) ? 1 : 0;

                try {
                    $db->query(
                        "INSERT INTO CONTRATISTA (nombre, correo, contrasena, telefono, ciudad, direccion, ubicacion_mapa, foto_perfil, experiencia, portafolio, descripcion_perfil, verificado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                        [$nombre_completo, $email, $hash_password, $telefono, $ciudad, $direccion, $ubicacion_mapa, $foto, $experiencia, $portafolio, $descripcion, $verificado]
                    );
                    $insertados++;
                    $idContratista = $db->insertID();

                    // Vincular servicios del perfil
                    foreach ($perfil['servicios'] as $idSvc) {
                        if (!in_array($idSvc, $serviciosExistentes)) continue;
                        $bp = $precioBase[$idSvc] ?? 100000;
                        $precioPersonalizado = round($bp * (1 + rand(-20, 30) / 100), -3);
                        try {
                            $db->query(
                                "INSERT INTO CONTRATISTA_SERVICIO (id_contratista, id_servicio, precio_personalizado, descripcion_personalizada) VALUES (?, ?, ?, ?)",
                                [$idContratista, $idSvc, $precioPersonalizado, $descripcion]
                            );
                            $serviciosVinculados++;
                        } catch (\Throwable $e2) { /* duplicado o FK */ }
                    }

                    // Crear ubicación y vincular
                    try {
                        $depto = $departamentos[$ciudad] ?? 'Cundinamarca';
                        $db->query(
                            "INSERT INTO UBICACION (ciudad, departamento, direccion, latitud, longitud) VALUES (?, ?, ?, ?, ?)",
                            [$ciudad, $depto, $direccion, $lat, $lng]
                        );
                        $idUbicacion = $db->insertID();
                        $db->query(
                            "INSERT INTO CONTRATISTA_UBICACION (id_contratista, id_ubicacion) VALUES (?, ?)",
                            [$idContratista, $idUbicacion]
                        );
                        $ubicacionesCreadas++;
                    } catch (\Throwable $e3) { /* ignorar */ }

                    // Certificaciones (60% tiene al menos 1)
                    if (rand(1, 100) <= 60) {
                        $numCerts = rand(1, min(3, count($perfil['certs'])));
                        $certsElegidas = array_rand(array_flip($perfil['certs']), $numCerts);
                        if (!is_array($certsElegidas)) $certsElegidas = [$certsElegidas];
                        foreach ($certsElegidas as $certNombre) {
                            $entidad = $entidades_cert[array_rand($entidades_cert)];
                            $fechaCert = date('Y-m-d', strtotime('-' . rand(180, 3650) . ' days'));
                            try {
                                $db->query(
                                    "INSERT INTO CERTIFICACION (nombre, entidad_emisora, fecha_obtenida, id_contratista) VALUES (?, ?, ?, ?)",
                                    [$certNombre, $entidad, $fechaCert, $idContratista]
                                );
                                $certificacionesCreadas++;
                            } catch (\Throwable $e4) { /* ignorar */ }
                        }
                    }

                } catch (\Throwable $e) {
                    if (str_contains($e->getMessage(), 'Duplicate')) {
                        $duplicados++;
                    } else {
                        $errores[] = htmlspecialchars($e->getMessage());
                    }
                }
            }

            $elapsed = round(microtime(true) - $startTime, 2);
            $totalEnTabla = $db->query("SELECT COUNT(*) as total FROM CONTRATISTA")->getRow()->total;
            $totalServicios = $db->query("SELECT COUNT(*) as total FROM CONTRATISTA_SERVICIO")->getRow()->total;
            $totalCerts = $db->query("SELECT COUNT(*) as total FROM CERTIFICACION")->getRow()->total;

            echo "<div class='card'>";
            echo "<h2 class='success'>✅ Seed de Contratistas completado</h2>";
            $pct = round($insertados / $total * 100);
            echo "<div class='progress'><div class='progress-bar' style='width:{$pct}%'></div></div>";
            echo "<div class='stat'>Contratistas insertados: <strong>$insertados</strong></div>";
            echo "<div class='stat'>Duplicados (omitidos): <strong>$duplicados</strong></div>";
            echo "<div class='stat'>Servicios vinculados: <strong>$serviciosVinculados</strong></div>";
            echo "<div class='stat'>Ubicaciones creadas: <strong>$ubicacionesCreadas</strong></div>";
            echo "<div class='stat'>Certificaciones: <strong>$certificacionesCreadas</strong></div>";
            echo "<br>";
            echo "<div class='stat'>Total contratistas en DB: <strong>$totalEnTabla</strong></div>";
            echo "<div class='stat'>Total vínculos servicio: <strong>$totalServicios</strong></div>";
            echo "<div class='stat'>Total certificaciones: <strong>$totalCerts</strong></div>";
            echo "<div class='stat'>Tiempo: <strong>{$elapsed}s</strong></div>";

            if (!empty($errores)) {
                echo "<h3 class='error'>Errores (" . count($errores) . "):</h3><ul>";
                foreach (array_slice($errores, 0, 10) as $err) echo "<li>$err</li>";
                if (count($errores) > 10) echo "<li>...y " . (count($errores) - 10) . " más</li>";
                echo "</ul>";
            }

            // Distribución por ciudad
            $porCiudad = $db->query("SELECT ciudad, COUNT(*) as total FROM CONTRATISTA GROUP BY ciudad ORDER BY total DESC LIMIT 10")->getResultArray();
            if (!empty($porCiudad)) {
                echo "<h3>📍 Top 10 ciudades:</h3><table><tr><th>Ciudad</th><th>Contratistas</th></tr>";
                foreach ($porCiudad as $c) echo "<tr><td>{$c['ciudad']}</td><td>{$c['total']}</td></tr>";
                echo "</table>";
            }

            // Muestra de 15 contratistas
            $muestra = $db->query("SELECT c.id_contratista, c.nombre, c.correo, c.ciudad, c.experiencia, c.verificado, COUNT(cs.id_servicio) as servicios
                FROM CONTRATISTA c LEFT JOIN CONTRATISTA_SERVICIO cs ON cs.id_contratista = c.id_contratista
                GROUP BY c.id_contratista ORDER BY c.id_contratista DESC LIMIT 15")->getResultArray();
            if (!empty($muestra)) {
                echo "<h3>📋 Últimos 15 contratistas:</h3><div class='table-wrap'>";
                echo "<table><tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Ciudad</th><th>Experiencia</th><th>✓</th><th>Svcs</th></tr>";
                foreach ($muestra as $c) {
                    $v = $c['verificado'] ? '✅' : '❌';
                    echo "<tr><td>{$c['id_contratista']}</td><td>{$c['nombre']}</td><td>{$c['correo']}</td><td>{$c['ciudad']}</td><td style='max-width:200px'>{$c['experiencia']}</td><td>{$v}</td><td>{$c['servicios']}</td></tr>";
                }
                echo "</table></div>";
            }

            echo "<p style='margin-top:20px; color:#636e72;'>🔑 Contraseña de todos: <code>password</code></p>";
            echo "<a class='btn' href='/panel'>Panel</a><a class='btn' href='/admin/usuarios'>Admin</a><a class='btn' href='/map'>Mapa</a><a class='btn' href='/especialidades'>Especialidades</a>";
            echo "</div>";

        } catch (\Throwable $e) {
            echo "<div class='card'><h2 class='error'>❌ Error</h2>";
            echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
            echo "<a class='btn' href='/'>Volver</a></div>";
        }

        echo "</body></html>";
    }
}
