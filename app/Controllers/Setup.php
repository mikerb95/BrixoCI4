<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Setup extends Controller
{
    public function index()
    {
        $db = db_connect();

        echo "<h1>Inicializando Base de Datos...</h1>";

        try {
            $db->connect(); // Forzar conexión
            echo "Conectado. Driver: " . $db->DBDriver . "<br>";
        } catch (\Throwable $e) {
            echo "<h2>Error conectando:</h2> " . $e->getMessage();
            return;
        }

        // Función auxiliar para ejecutar SQL
        $runSQL = function ($path) use ($db) {
            $filename = basename($path);
            if (!file_exists($path)) {
                echo "No se encontró $filename<br>";
                return;
            }

            $sql = file_get_contents($path);

            // Intento 1: MySQLi multi_query (Más rápido y soporta todo)
            $mysqli = $db->connID;
            if ($mysqli instanceof \mysqli) {
                echo "Intentando modo nativo para $filename...<br>";
                try {
                    if ($mysqli->multi_query($sql)) {
                        do {
                            if ($result = $mysqli->store_result()) {
                                $result->free();
                            }
                        } while ($mysqli->more_results() && $mysqli->next_result());
                        echo "✅ $filename importado correctamente (Nativo).<br>";
                        return;
                    }
                } catch (\Throwable $e) {
                    echo "⚠️ Falló modo nativo: " . $e->getMessage() . ". Intentando modo compatibilidad...<br>";
                }
            }

            // Intento 2: Modo compatibilidad (Lento, sentencia por sentencia)
            echo "Ejecutando modo compatibilidad para $filename...<br>";

            // Limpiar comentarios y saltos de línea para evitar errores de parseo simples
            $lines = explode("\n", $sql);
            $cleanSql = "";
            foreach ($lines as $line) {
                $line = trim($line);
                if ($line && !str_starts_with($line, '--') && !str_starts_with($line, '#')) {
                    $cleanSql .= $line . "\n";
                }
            }

            $statements = explode(';', $cleanSql);
            $errors = 0;
            foreach ($statements as $stmt) {
                if (trim($stmt) !== '') {
                    try {
                        $db->query($stmt);
                    } catch (\Throwable $e) {
                        $errors++;
                        echo "Error en sentencia: " . $e->getMessage() . "<br>";
                    }
                }
            }

            if ($errors === 0) {
                echo "✅ $filename importado correctamente (Compatibilidad).<br>";
            } else {
                echo "❌ $filename terminó con $errors errores.<br>";
            }
        };

        try {
            $runSQL(FCPATH . 'schema.sql');
            $runSQL(FCPATH . 'seed.sql');

            echo "<h2>¡Proceso terminado!</h2>";
            echo "<a href='/'>Ir al Inicio</a>";
        } catch (\Throwable $e) {
            echo "<h2>Error Crítico:</h2>";
            echo $e->getMessage();
            echo "<pre>" . $e->getTraceAsString() . "</pre>";
        }
    }
}
