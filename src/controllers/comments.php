<?php
// src/controllers/comments.php
require_once '../models/Comment.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['song_id']) && isset($_POST['comment'])) {
        $songId = (int)$_POST['song_id'];
        $userId = $_SESSION['user']['id'] ?? null;
        $commentText = trim($_POST['comment']);
        
        if ($userId && !empty($commentText)) {
            // Guardar el comentario en la base de datos
            Comment::addComment($songId, $userId, $commentText);
            header("Location: ../views/song.php?id=$songId");
            exit();
        } else {
            echo "Debe estar registrado para dejar un comentario.";
        }
    } else {
        echo "ID de la canción o comentario no proporcionado.";
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>
