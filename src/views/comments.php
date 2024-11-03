<?php
// src/views/comments.php
require_once '../models/Comment.php';

$song_id = $_GET['song_id'] ?? 0;
$comments = Comment::getCommentsBySongId($song_id);
?>

<div class="comments-section">
    <h3>Comentarios</h3>

    <?php if (isset($_SESSION['user'])): ?>
        <form action="../controllers/comments.php" method="POST">
            <input type="hidden" name="song_id" value="<?php echo htmlspecialchars($song_id); ?>">
            <textarea name="comment" placeholder="Escribe un comentario..." required></textarea>
            <button type="submit">Enviar</button>
        </form>
    <?php else: ?>
        <p>Debe estar registrado para dejar un comentario.</p>
    <?php endif; ?>

    <div class="comments-list">
        <?php if (count($comments) > 0): ?>
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <p><strong><?php echo htmlspecialchars($comment['username']); ?>:</strong></p>
                    <p><?php echo htmlspecialchars($comment['comment']); ?></p>
                    <small><?php echo htmlspecialchars($comment['created_at']); ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay comentarios todavía. ¡Sé el primero en comentar!</p>
        <?php endif; ?>
    </div>
</div>
