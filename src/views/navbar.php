<?php
// Iniciar la sesión
session_start();
?>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
 
<body>
<nav>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MusicSky</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto"> <!-- Asegúrate de que los elementos a la izquierda se alineen correctamente -->
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo '/musicsky/public/index.php'; ?>">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Toda la musica
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Top 10</a></li>
            <li><a class="dropdown-item" href="#">Albums</a></li>
            <li><a class="dropdown-item" href="#">Canciones recientes</a></li>
          </ul>
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
        <span class="navbar-text ms-auto fw-bold">
            <h5>Hola, <?php echo htmlspecialchars($_SESSION['user']['username']); ?></h5>
        </span>
      <?php endif; ?>
    </div>
  </div>
</nav>

</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
