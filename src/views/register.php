<!-- src/views/register.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>Registro</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form action="../controllers/auth.php" method="POST">
        <input type="text" name="username" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit" name="register">Registrarse</button>
    </form>
</body>
</html>
