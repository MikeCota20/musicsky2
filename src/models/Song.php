<?php
// src/models/Song.php
require_once $_SERVER['DOCUMENT_ROOT'] . '/musicsky/config.php';


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
        $stmt = $pdo->query("
            SELECT 
                songs.*, 
                genres.genre AS genre_name 
            FROM songs
            LEFT JOIN genres ON songs.genre = genres.id
            ORDER BY songs.uploaded_at DESC 
            LIMIT 5
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public static function getSongById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT songs.*, 
                               genres.genre AS genre_name
                               FROM songs
                               LEFT JOIN genres ON songs.genre = genres.id
                               WHERE songs.id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public static function getSongsCat() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM songs ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getSongsByGenre($genreId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM songs WHERE genre = :genre ORDER BY id DESC");
        $stmt->execute(['genre' => $genreId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getSongsOrderedByComments($order = 'desc', $songs = null) {
        global $pdo;
        
        // Si no se pasa un conjunto de canciones, se obtiene todas
        if ($songs === null) {
            $stmt = $pdo->prepare(
                "SELECT songs.*, COUNT(comments.id) AS comment_count
                FROM songs
                LEFT JOIN comments ON songs.id = comments.song_id
                GROUP BY songs.id
                ORDER BY comment_count $order"
            );
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        // Si se pasan canciones filtradas, solo se ordenan esas
        $songIds = array_map(fn($song) => $song['id'], $songs);
        $inQuery = implode(",", $songIds);
        $stmt = $pdo->prepare(
            "SELECT songs.*, COUNT(comments.id) AS comment_count
            FROM songs
            LEFT JOIN comments ON songs.id = comments.song_id
            WHERE songs.id IN ($inQuery)
            GROUP BY songs.id
            ORDER BY comment_count $order"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    
    
}
?>
