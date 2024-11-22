<?php
// src/models/Song.php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MusicSky/config.php';


class Song {
    public static function addSong($title, $genre, $album_id, $filePath, $thumbnail) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO songs (title, genre, album_id, file_path, thumbnail) VALUES (:title, :genre, :album_id, :file_path, :thumbnail)");
        return $stmt->execute(['title' => $title, 'genre' => $genre, 'album_id' => $album_id, 'file_path' => $filePath, 'thumbnail' => $thumbnail]);
    }

    public static function getSongs() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM songs");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getSongsIndex() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM songs ORDER BY uploaded_at DESC LIMIT 5");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getSongById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM songs WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
