<?php
// src/models/Comment.php
require_once '../../config.php';

class Comment {
    public static function addComment($songId, $userId, $comment) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO comments (song_id, user_id, comment) VALUES (:song_id, :user_id, :comment)");
        return $stmt->execute(['song_id' => $songId, 'user_id' => $userId, 'comment' => $comment]);
    }

    public static function getCommentsBySongId($songId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT comments.comment, users.username FROM comments INNER JOIN users ON comments.user_id = users.id WHERE comments.song_id = :song_id ORDER BY comments.created_at DESC");
        $stmt->execute(['song_id' => $songId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
