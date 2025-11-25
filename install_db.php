<?php
// install_db.php

// Configuración de conexión
$host = 'brixo-petfinder.k.aivencloud.com';
$port = 20951;
$db   = 'defaultdb';
$user = 'avnadmin';

// Solicitar contraseña
echo "Por favor ingresa la contraseña de la base de datos Aiven: ";
$handle = fopen("php://stdin", "r");
$pass = trim(fgets($handle));
fclose($handle);

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::MYSQL_ATTR_SSL_CA       => true,     // Intentar usar SSL
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false, // No verificar certificado estrictamente para facilitar conexión
    PDO::MYSQL_ATTR_MULTI_STATEMENTS => true, // Permitir múltiples sentencias SQL en una sola llamada
];

try {
    echo "\nConectando a la base de datos...\n";
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Conexión exitosa.\n";

    // Función auxiliar para ejecutar archivos SQL
    function runSqlFile($pdo, $filePath)
    {
        echo "Procesando " . basename($filePath) . "...\n";

        if (!file_exists($filePath)) {
            echo "ERROR: El archivo $filePath no existe.\n";
            return;
        }

        $sql = file_get_contents($filePath);

        try {
            $pdo->exec($sql);
            echo "EXITO: " . basename($filePath) . " importado correctamente.\n";
        } catch (PDOException $e) {
            echo "ERROR al importar " . basename($filePath) . ": " . $e->getMessage() . "\n";
        }
    }

    // Ejecutar schema y seed
    runSqlFile($pdo, __DIR__ . '/public/schema.sql');
    runSqlFile($pdo, __DIR__ . '/public/seed.sql');
} catch (\PDOException $e) {
    echo "\nERROR CRÍTICO DE CONEXIÓN:\n";
    echo $e->getMessage() . "\n";
    echo "Código: " . $e->getCode() . "\n";
}
