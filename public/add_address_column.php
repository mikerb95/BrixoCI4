<?php
// public/add_address_column.php

header('Content-Type: text/html; charset=utf-8');
echo "<h1>Actualización de Esquema: Agregar Dirección</h1>";

$host = getenv('database.default.hostname') ?: getenv('DB_HOST') ?: 'localhost';
$user = getenv('database.default.username') ?: getenv('DB_USER') ?: 'root';
$pass = getenv('database.default.password') ?: getenv('DB_PASSWORD') ?: '';
$db = getenv('database.default.database') ?: getenv('DB_NAME') ?: 'brixo';
$port = getenv('database.default.port') ?: getenv('DB_PORT') ?: 3306;

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "<p style='color:green'><strong>✅ Conexión exitosa.</strong></p>";

    function columnExists($pdo, $table, $column)
    {
        $stmt = $pdo->prepare("SHOW COLUMNS FROM `$table` LIKE ?");
        $stmt->execute([$column]);
        return $stmt->fetch() !== false;
    }

    // CLIENTE
    if (!columnExists($pdo, 'CLIENTE', 'direccion')) {
        echo "Agregando 'direccion' a CLIENTE... ";
        $pdo->exec("ALTER TABLE CLIENTE ADD COLUMN direccion VARCHAR(255) AFTER ciudad");
        echo "<span style='color:green'>OK</span><br>";
    } else {
        echo "Columna 'direccion' ya existe en CLIENTE.<br>";
    }

    // CONTRATISTA
    if (!columnExists($pdo, 'CONTRATISTA', 'direccion')) {
        echo "Agregando 'direccion' a CONTRATISTA... ";
        $pdo->exec("ALTER TABLE CONTRATISTA ADD COLUMN direccion VARCHAR(255) AFTER ciudad");
        echo "<span style='color:green'>OK</span><br>";
    } else {
        echo "Columna 'direccion' ya existe en CONTRATISTA.<br>";
    }

} catch (PDOException $e) {
    echo "<p style='color:red'>Error: " . $e->getMessage() . "</p>";
}
