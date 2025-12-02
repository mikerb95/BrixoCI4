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
}
