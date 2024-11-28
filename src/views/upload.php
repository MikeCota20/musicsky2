<!-- src/views/upload.php -->


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/musicsky/public/css/styles.css">
    <link rel="stylesheet" href="/musicsky/public/css/upload.css">
    <title>Subir Canción</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap');
    </style>
</head>
<body>
    <?php 
    require_once '../models/genres.php';
    include './navbar.php';
    $genres = Genres::getGenre();

    ?>
    <main class="main-content">    
    <h2>Subir Canción</h2>
    <form action="../controllers/songs.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Título de la canción" required>
        <label for="genre">Género</label>
            <select name="genre" id="genre" required>
                <option value="" disabled selected>Selecciona un género</option>
                <?php foreach ($genres as $genre): ?>
                    <option value="<?= htmlspecialchars($genre['id']) ?>">
                        <?= htmlspecialchars($genre['genre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <input type="text" name="album_id" placeholder="Álbum">
        <p class="input-title">Selecciona tu canción.</p>
        <input type="file" name="songFile" accept="audio/*" required value="Selecciona tu canción.">
        <p class="input-title">Selecciona tu miniatura.</p>
        <input type="file" name="thumbnail" accept="image/*" required value="Selecciona tu miniatura.">
        <button type="submit">Subir Canción</button>
    </form>
</main>

</body>
</html>
