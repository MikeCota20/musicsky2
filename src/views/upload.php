<!-- src/views/upload.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/musicsky/public/css/styles.css">
    <title>Subir Canción</title>
</head>
<body>
    <?php include './navbar.php';?>
    <main class="main-content">    
    <h2>Subir Canción</h2>
    <form action="../controllers/songs.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Título de la canción" required>
        <input type="text" name="genre" placeholder="Genero">
        <input type="text" name="album_id" placeholder="Álbum">
        <input type="file" name="songFile" accept="audio/*" required>
        <input type="file" name="thumbnail" accept="image/*" required>
        <button type="submit">Subir Canción</button>
    </form>
</main>

</body>
</html>
