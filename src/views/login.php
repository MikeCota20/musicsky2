<!-- src/views/login.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>Iniciar Sesión</title>
</head>
<body>
<?php include './navbar.php';?>
    <h2>Iniciar Sesión</h2>
    <form action="../controllers/auth.php" method="POST">
        <input type="text" name="username" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit" name="login">Iniciar Sesión</button>
    </form>
</body>
</html>
