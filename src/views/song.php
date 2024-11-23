<?php
// src/views/song.php

require_once '../models/Song.php';
require_once '../models/Comment.php';

// Obtener el ID de la canción desde la URL
$songId = isset($_GET['id']) ? (int)$_GET['id'] : null;
$song = null;

if ($songId) {
    // Obtener los detalles de la canción con el ID proporcionado
    $song = Song::getSongById($songId);
    $comments = Comment::getCommentsBySongId($songId);

    if (!$song) {
        echo "<p>Canción no encontrada.</p>";
        exit();
    }
} else {
    echo "<p>ID de la canción no proporcionado.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/musicsky/public/css/styles.css">
    <link rel="stylesheet" href="/musicsky/public/css/player.css">
    <title>Reproductor de Canción - <?php echo htmlspecialchars($song['title']); ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Nokora:wght@100;300;400;700;900&display=swap');
    </style>
</head>
<body class="main-content">
    <?php include './navbar.php';?>
    <div class="player">

    <h2 class="titulo"><?php echo htmlspecialchars($song['title']); ?></h2>
    <div class="desc">

        <p><span class="bold">Artista: </span><?php echo htmlspecialchars($song['genre']); ?></p>
        <p><span class="bold">Álbum: </span><?php echo htmlspecialchars($song['album_id']); ?></p>

    </div>


    <div class="gstuff">
        <!-- Reproductor de audio -->
        <audio controls>
                <source src="<?php echo htmlspecialchars($song['file_path']); ?>" type="audio/mpeg">
                Tu navegador no soporta el elemento de audio.
            </audio>
            <img 
                src="<?php echo htmlspecialchars('/musicsky/public/uploads/music-thumb/' . $song['thumbnail']); ?>" 
                alt="Thumbnail de <?php echo htmlspecialchars($song['title']); ?>" 
                class="song-thumbnail"
            >
    </div>
    
    <div class="comment-cont">
    <!-- Formulario de comentarios -->
        <h3>Comentarios</h3>
        <br>
        <form action="../controllers/comments.php" method="POST">
            <input type="hidden" name="song_id" value="<?php echo $songId; ?>">
            <div class="comment">
                <textarea name="comment" placeholder="Deja tu comentario" required></textarea>
                <button type="submit">Enviar comentario</button>
            </div>

        </form>

    
            <!-- Mostrar comentarios -->
        <?php if (!empty($comments)): ?>
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <p><strong><?php echo htmlspecialchars($comment['username']); ?></strong>:</p>
                    <p class="escrito"><?php echo htmlspecialchars($comment['comment']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay comentarios para esta canción.</p>
        <?php endif; ?>

    </div>

    <a href="/musicsky/public/index.php">Volver al inicio</a>

    </div>
   
</body>
</html>
