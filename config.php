
<?php
// config.php
define('DB_HOST', '108.179.194.14');
define('DB_NAME', 'avrgyoco_musicsky');
define('DB_USER', 'avrgyoco_mike');
define('DB_PASS', 'mimamixdZ1');



// Configuración de conexión a la base de datos
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>




