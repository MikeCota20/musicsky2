<?php
require_once '../models/Song.php';
require_once '../models/Genres.php';

// Obtener géneros con conteo de uso
$genresWithUsage = Genres::countGenreUsage();

// Filtro por orden si se selecciona uno
$orderFilter = isset($_GET['order']) ? $_GET['order'] : 'default';

if ($orderFilter === 'popular') {
    usort($genresWithUsage, fn($a, $b) => $b['usage_count'] - $a['usage_count']);
} elseif ($orderFilter === 'least_popular') {
    usort($genresWithUsage, fn($a, $b) => $a['usage_count'] - $b['usage_count']);
} else {
    // Ordenar por defecto en orden descendente de id
    usort($genresWithUsage, fn($a, $b) => $b['id'] - $a['id']);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo</title>
    <link rel="stylesheet" href="/musicsky/public/css/styles.css">
    <link rel="stylesheet" href="/musicsky/public/css/index.css">
    <link rel="stylesheet" href="/musicsky/public/css/catalogo.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap');
    </style>
</head>
<body>
    <?php include "./navbar.php"; ?>

    <main class="main-content">
        <h1>Catálogo</h1>


        <div class="topbar">
            <a href="./catalogo.php" class="linktop">Canciones</a>
            <a href="./generos.php" class="linktop">Generos</a>
            <a class="linktop">Albums</a>
        </div>

        <div class="division">
            <?php if (isset($noSongsMessage) && $noSongsMessage): ?>
                <!-- Mostrar mensaje cuando no haya canciones para el género seleccionado -->
                <div class="no-songs">
                    <h2>Oopss... parece que aun no hay canciones. ¡Ayúdanos a agregar alguna!</h2>
                </div>
            <?php else: ?>
                <!-- Mostrar las canciones si existen -->
                <ul class="index-recent-song-flex">
                <?php foreach ($genresWithUsage as $genre): ?>
                    <li class="song-item">
                        <!-- Mostrar la miniatura -->
                        <a href="<?php echo '/musicsky/src/views/catalogo.php'; ?>?genre=<?php echo $genre['id']; ?>&order=default">
                            <img 
                                src="<?php echo htmlspecialchars('/musicsky/public/uploads/genre/' . $genre['thumbnail']); ?>" 
                                alt="Thumbnail de <?php echo htmlspecialchars($genre['genre']); ?>" 
                                class="song-thumbnail"
                            >
                        </a>

                        <!-- Mostrar título y conteo de uso -->
                        <div class="song-text">
                            <a href="<?php echo '/musicsky/src/views/'; ?>genre.php?id=<?php echo $genre['id']; ?>">
                                <?php echo htmlspecialchars($genre['genre']); ?>
                            </a>
                            <p class="c_can"><?php echo $genre['usage_count']; ?> canciones</p>
                        </div>
                    </li>
                <?php endforeach; ?>

                </ul>
            <?php endif; ?>

            <!-- Formulario de filtro -->
            <div class="filter">
                <form method="GET" action="" class="filtro">

                    
                    <label for="order">Ordenar por:</label>
                    <select name="order" id="order">
                        <option value="default" <?php echo ($orderFilter == 'default') ? 'selected' : ''; ?>>Orden original</option>
                        <option value="popular" <?php echo ($orderFilter == 'popular') ? 'selected' : ''; ?>>Más populares</option>
                        <option value="least_popular" <?php echo ($orderFilter == 'least_popular') ? 'selected' : ''; ?>>Menos populares</option>
                    </select>

                    <div class="izq-bot">
                        <button type="submit">Aplicar filtro</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
