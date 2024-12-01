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

    public static function getGenres() {
        global $pdo;
        $stmt = $pdo->query("SELECT genre FROM genres");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getGenreIndex() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM genres LIMIT 5");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function countGenreUsage() {
        global $pdo;
        $stmt = $pdo->query("
            SELECT g.id, g.genre, g.thumbnail, COUNT(s.genre) AS usage_count
            FROM genres g
            LEFT JOIN songs s ON g.id = s.genre
            GROUP BY g.id, g.genre, g.thumbnail
            ORDER BY usage_count DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}


?>
