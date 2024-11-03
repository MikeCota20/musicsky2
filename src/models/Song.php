<?php
// src/models/Song.php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MusicSky/config.php';


class Song {
    public static function addSong($title, $genre, $album_id, $filePath) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO songs (title, genre, album_id, file_path) VALUES (:title, :genre, :album_id, :file_path)");
        return $stmt->execute(['title' => $title, 'genre' => $genre, 'album_id' => $album_id, 'file_path' => $filePath]);
    }

    public static function getSongs() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM songs");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
