<?php
require_once '../models/Song.php';
require_once '../models/Genres.php';

// Obtener géneros disponibles
$genres = Genres::getGenre();

// Filtro por género si se selecciona uno
$genreFilter = isset($_GET['genre']) ? $_GET['genre'] : null;

// Filtro por orden si se selecciona uno
$orderFilter = isset($_GET['order']) ? $_GET['order'] : 'default';

// Inicializar la variable para las canciones
$songs = [];

// Obtener canciones
if ($genreFilter) {
    // Filtrar canciones por género
    $songs = Song::getSongsByGenre($genreFilter);
} else {
    // Mostrar todas las canciones
    $songs = Song::getSongsCat();
}

// Si no hay canciones para el género seleccionado, mostrar el mensaje y no aplicar el filtro de orden
if (empty($songs) && $genreFilter) {
    $noSongsMessage = true; // Activamos el mensaje de "Oopss..."
} else {
    // Si hay canciones, aplicar el filtro de orden
    if ($orderFilter == 'popular') {
        // Ordenar por la cantidad de comentarios (de mayor a menor)
        $songs = Song::getSongsOrderedByComments('desc', $songs);
    } elseif ($orderFilter == 'least_popular') {
        // Ordenar por la cantidad de comentarios (de menor a mayor)
        $songs = Song::getSongsOrderedByComments('asc', $songs);
    }
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

        <div class="division">
            <?php if (isset($noSongsMessage) && $noSongsMessage): ?>
                <!-- Mostrar mensaje cuando no haya canciones para el género seleccionado -->
                <div class="no-songs">
                    <h2>Oopss... parece que aun no hay canciones. ¡Ayúdanos a agregar alguna!</h2>
                </div>
            <?php else: ?>
                <!-- Mostrar las canciones si existen -->
                <ul class="index-recent-song-flex">
                    <?php foreach ($songs as $song): ?>
                        <li class="song-item">
                            <!-- Mostrar la miniatura -->
                            <a href="<?php echo '/musicsky/src/views/'; ?>song.php?id=<?php echo $song['id']; ?>">
                                <img 
                                    src="<?php echo htmlspecialchars('/musicsky/public/uploads/music-thumb/' . $song['thumbnail']); ?>" 
                                    alt="Thumbnail de <?php echo htmlspecialchars($song['title']); ?>" 
                                    class="song-thumbnail"
                                >
                            </a>

                            <!-- Mostrar título y género -->
                            <div class="song-text">
                                <a href="<?php echo '/musicsky/src/views/'; ?>song.php?id=<?php echo $song['id']; ?>">
                                    <?php echo htmlspecialchars($song['title']); ?>
                                </a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <!-- Formulario de filtro -->
            <div class="filter">
                <form method="GET" action="" class="filtro">
                    <label for="genre">Filtrar por género:</label>
                    <select name="genre" id="genre">
                        <option value="">Todos los géneros</option>
                        <?php foreach ($genres as $genre): ?>
                            <option value="<?php echo htmlspecialchars($genre['id']); ?>" 
                                <?php echo ($genre['id'] == $genreFilter) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($genre['genre']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    
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
