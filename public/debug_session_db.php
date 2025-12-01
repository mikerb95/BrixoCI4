<?php
// public/debug_session_db.php

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Debug Session DB</h1>";

// 1. Load CI4 Config
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
$pathsPath = FCPATH . '../app/Config/Paths.php';
require $pathsPath;
$paths = new Config\Paths();
$appConfigPath = $paths->appDirectory . '/Config/App.php';
$dbConfigPath = $paths->appDirectory . '/Config/Database.php';

require $appConfigPath;
require $dbConfigPath;

// 2. Connect to DB manually
$dbConfig = new Config\Database();
$group = 'default';
$config = $dbConfig->$group;

echo "<h2>Database Connection</h2>";
echo "Host: " . ($config['hostname'] ?? 'N/A') . "<br>";
echo "User: " . ($config['username'] ?? 'N/A') . "<br>";
echo "Database: " . ($config['database'] ?? 'N/A') . "<br>";

try {
    $dsn = "mysql:host={$config['hostname']};port={$config['port']};dbname={$config['database']};charset={$config['charset']}";
    $pdo = new PDO($dsn, $config['username'], $config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p style='color:green'>✅ PDO Connection Successful</p>";

    // 3. Check Table
    echo "<h2>Table Check</h2>";
    $stmt = $pdo->query("SHOW TABLES LIKE 'ci_sessions'");
    if ($stmt->rowCount() > 0) {
        echo "<p style='color:green'>✅ Table 'ci_sessions' exists.</p>";

        // Count rows
        $stmt = $pdo->query("SELECT COUNT(*) FROM ci_sessions");
        $count = $stmt->fetchColumn();
        echo "<p>Current active sessions: <strong>$count</strong></p>";

        // Show last 5 sessions (masked IP)
        $stmt = $pdo->query("SELECT id, ip_address, timestamp, LENGTH(data) as data_len FROM ci_sessions ORDER BY timestamp DESC LIMIT 5");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($rows) {
            echo "<table border='1' cellpadding='5'><tr><th>ID</th><th>IP</th><th>Time</th><th>Data Size</th></tr>";
            foreach ($rows as $row) {
                echo "<tr>";
                echo "<td>" . substr($row['id'], 0, 10) . "...</td>";
                echo "<td>" . $row['ip_address'] . "</td>";
                echo "<td>" . date('Y-m-d H:i:s', $row['timestamp']) . "</td>";
                echo "<td>" . $row['data_len'] . " bytes</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No sessions found.</p>";
        }

    } else {
        echo "<p style='color:red'>❌ Table 'ci_sessions' DOES NOT exist.</p>";
    }

    // 4. Test Write Permission
    echo "<h2>Write Test</h2>";
    $testId = 'test_' . bin2hex(random_bytes(8));
    $ip = '127.0.0.1';
    $ts = time();
    $data = 'blob_data_test';

    try {
        $sql = "INSERT INTO ci_sessions (id, ip_address, timestamp, data) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$testId, $ip, $ts, $data]);
        echo "<p style='color:green'>✅ Manual INSERT successful (ID: $testId)</p>";

        // Clean up
        $pdo->exec("DELETE FROM ci_sessions WHERE id = '$testId'");
        echo "<p>Test row deleted.</p>";

    } catch (Exception $e) {
        echo "<p style='color:red'>❌ Manual INSERT failed: " . $e->getMessage() . "</p>";
    }

} catch (PDOException $e) {
    echo "<p style='color:red'>❌ Connection Failed: " . $e->getMessage() . "</p>";
}

// 5. CI4 Session Test (Simulated)
echo "<h2>CI4 Session Config Check</h2>";
$sessionConfigPath = $paths->appDirectory . '/Config/Session.php';
require $sessionConfigPath;
$sessionConfig = new Config\Session();

echo "Driver: " . $sessionConfig->driver . "<br>";
echo "Save Path: " . $sessionConfig->savePath . "<br>";
echo "Cookie Name: " . $sessionConfig->cookieName . "<br>";
echo "Match IP: " . ($sessionConfig->matchIP ? 'Yes' : 'No') . "<br>";

?>