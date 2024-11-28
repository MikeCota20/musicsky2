<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/MusicSky/config.php';


class Genres {
    public static function addGenre($genre, $thumbnail) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO genres (genre, thumbnail) VALUES (:genre, :thumbnail)");
        return $stmt->execute(['genre' => $genre, 'thumbnail' => $thumbnail]);
    }

    public static function getGenre() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM genres");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>
