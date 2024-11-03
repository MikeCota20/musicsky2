<?php
// Iniciar la sesión
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Si se desea, también se puede eliminar la cookie de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"], $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión
session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrando sesión...</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script>
        // Función para redirigir después de 2 segundos
        setTimeout(function() {
            window.location.href = "/musicsky/public/index.php"; // Cambia esto a la URL deseada
        }, 1000); // 2000 milisegundos = 2 segundos
    </script>
</head>
<body>
    <div class="container text-center" style="margin-top: 20%;">
        <h1>Cerrando sesión...</h1>
    </div>
</body>
</html>
