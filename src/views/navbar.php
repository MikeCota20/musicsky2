// <?php
// // Inicia la sesión si no está iniciada
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }
// ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos para el navbar */
        .sidebar-nav {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 200px;
            background-color: #f8f9fa;
            padding-top: 20px;
            padding-bottom: 20px;
            overflow-y: auto;
            border-right: 1px solid #ddd;
        }

        .logo {
            text-align: center;
            font-family: "Bowlby One SC", sans-serif;
            font-size: 3dvh;
            margin-bottom: 5dvh;
            color: white;
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
        }

        .logo:hover {
            color: skyblue;
        }
    </style>
</head>
<body>
    <nav class="sidebar-nav">
        <div class="container-fluid">
            <a class="navbar-brand logo" href="/musicsky/public/index.php">MusicSky</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="/musicsky/public/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/musicsky/src/views/catalogo.php">Catálogo</a>
                </li>
                <?php if (isset($_SESSION['user'])): ?>
                    <?php if ($_SESSION['user']['id'] == 8): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/musicsky/src/views/user_crud.php">Panel de Control</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/musicsky/src/views/upload.php">Subir Canción</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/musicsky/src/utils/logout.php">Cerrar Sesión</a>
                    </li>
                    <span class="navbar-text">
                        Hola, <?php echo htmlspecialchars($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>
                    </span>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/musicsky/src/views/login.php">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/musicsky/src/views/register.php">Registrar</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</body>
</html>
