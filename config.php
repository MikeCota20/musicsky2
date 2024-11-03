
<?php
// config.php
define('DB_HOST', 'localhost');
define('DB_NAME', 'musicsky');
define('DB_USER', 'root');
define('DB_PASS', '');



// Configuración de conexión a la base de datos
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>




