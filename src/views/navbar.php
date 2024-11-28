<?php
// Iniciar la sesión
session_start();
?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Estilos para el navbar fijo a la izquierda */
        .sidebar-nav {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 200px;
            background-color: #f8f9fa; /* color de fondo */
            padding-top: 20px;
            padding-bottom: 20px;
            overflow-y: auto; /* scroll si es necesario */
            border-right: 1px solid #ddd;
            z-index: 1000; /* Asegura que el navbar esté encima del contenido */
        }

        /* Afecta el contenido principal para dejar espacio al navbar */

        @import url('https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap');

        .logo{
            text-align: center;
            font-family: "Bowlby One SC", sans-serif;
            font-weight: 400;
            font-style: normal;
            font-size: 3dvh;
            margin-bottom: 5dvh;
            color: white;
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;

        }

        .logo:hover{
            color: white;
        }
        .logo:active{
            color: skyblue;
        }

    </style>
    
</head>

<body>
    <!-- Navbar como barra lateral fija -->
    <nav class="sidebar-nav">
        <div class="container-fluid">
            <a class="navbar-brand logo" href="/musicsky/public/index.php">MusicSky</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo '/musicsky/public/index.php'; ?>">Home</a>
                </li>
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Toda la musica
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Top 10</a></li>
                        <li><a class="dropdown-item" href="#">Albums</a></li>
                        <li><a class="dropdown-item" href="#">Canciones recientes</a></li>
                    </ul>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo '/musicsky/src/views/catalogo.php'; ?>">Catalogo</a>
                </li>
                
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] != 8): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo '/musicsky/src/views/upload.php'; ?>">Subir Canción</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo '/musicsky/src/utils/logout.php'; ?>">Log Out</a>
                    </li>
                <?php elseif (isset($_SESSION['user']) && $_SESSION['user']['id'] == 8): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo '/musicsky/src/views/upload.php'; ?>">Subir Canción</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo '/musicsky/src/views/user_crud.php'; ?>">Panel de control</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo '/musicsky/src/utils/logout.php'; ?>">Log Out</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo '/musicsky/src/views/login.php'; ?>">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo '/musicsky/src/views/register.php'; ?>">Registrar</a>
                    </li>
                <?php endif; ?>
            </ul>
            <?php if (isset($_SESSION['user'])): ?>
                <span class="navbar-text mt-4">
                    <h5>Hola, <?php echo htmlspecialchars($_SESSION['user']['username']); ?></h5>
                </span>
            <?php endif; ?>
        </div>
    </nav>
</body>
