<!-- src/views/register.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/musicsky/public/css/styles.css">
    <link rel="stylesheet" href="/musicsky/public/css/register.css">
    <title>Registro</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap');
    </style>
</head>
<body >
<?php include './navbar.php';?>
    <main class="main-content">
        <h2>Registro de Usuario</h2>
        <form action="../controllers/auth.php" method="POST">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="email" name="email" placeholder="Email" required>
            <button type="submit" name="register">Registrarse</button>
        </form>
    </main>

</body>
</html>
