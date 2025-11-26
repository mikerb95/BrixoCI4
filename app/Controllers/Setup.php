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
            // 1. Run Schema
            $schemaPath = FCPATH . 'schema.sql';
            if (file_exists($schemaPath)) {
                $sql = file_get_contents($schemaPath);

                $mysqli = $db->connID;
                if ($mysqli instanceof \mysqli) {
                    echo "Ejecutando schema.sql...<br>";
                    if ($mysqli->multi_query($sql)) {
                        do {
                            if ($result = $mysqli->store_result()) {
                                $result->free();
                            }
                        } while ($mysqli->more_results() && $mysqli->next_result());
                        echo "Schema importado correctamente.<br>";
                    } else {
                        echo "Error en Schema: " . $mysqli->error . "<br>";
                    }
                } else {
                    echo "Driver no es MySQLi.<br>";
                }
            } else {
                echo "No se encontró schema.sql<br>";
            }

            // 2. Run Seeds
            $seedPath = FCPATH . 'seed.sql';
            if (file_exists($seedPath)) {
                $sql = file_get_contents($seedPath);
                $mysqli = $db->connID;
                if ($mysqli instanceof \mysqli) {
                    echo "Ejecutando seed.sql...<br>";
                    if ($mysqli->multi_query($sql)) {
                        do {
                            if ($result = $mysqli->store_result()) {
                                $result->free();
                            }
                        } while ($mysqli->more_results() && $mysqli->next_result());
                        echo "Seeds importados correctamente.<br>";
                    } else {
                        echo "Error en Seeds: " . $mysqli->error . "<br>";
                    }
                }
            } else {
                echo "No se encontró seed.sql<br>";
            }

            echo "<h2>¡Proceso terminado!</h2>";
            echo "<a href='/'>Ir al Inicio</a>";
        } catch (\Throwable $e) {
            echo "<h2>Error:</h2>";
            echo $e->getMessage();
            echo "<pre>" . $e->getTraceAsString() . "</pre>";
        }
    }
}
