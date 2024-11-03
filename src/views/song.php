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
    <link rel="stylesheet" href="../css/style.css">
    <title>Reproductor de Canción - <?php echo htmlspecialchars($song['title']); ?></title>
</head>
<body>
    <?php include './navbar.php';?>
    <h2><?php echo htmlspecialchars($song['title']); ?></h2>
    <p>Artista: <?php echo htmlspecialchars($song['genre']); ?></p>
    <p>Álbum: <?php echo htmlspecialchars($song['album_id']); ?></p>

    <!-- Reproductor de audio -->
    <audio controls>
        <source src="<?php echo htmlspecialchars($song['file_path']); ?>" type="audio/mpeg">
        Tu navegador no soporta el elemento de audio.
    </audio>

    <!-- Formulario de comentarios -->
    <h3>Comentarios</h3>
    <form action="../controllers/comments.php" method="POST">
        <input type="hidden" name="song_id" value="<?php echo $songId; ?>">
        <textarea name="comment" placeholder="Deja tu comentario" required></textarea>
        <button type="submit">Enviar comentario</button>
    </form>

    <!-- Mostrar comentarios -->
    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <p><strong><?php echo htmlspecialchars($comment['username']); ?></strong>:</p>
                <p><?php echo htmlspecialchars($comment['comment']); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay comentarios para esta canción.</p>
    <?php endif; ?>

    <a href="../index.php">Volver al inicio</a>
</body>
</html>
