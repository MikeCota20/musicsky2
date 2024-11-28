<?php
require_once '../models/Song.php';
$songs = Song::getSongsCat();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
    <link rel="stylesheet" href="/musicsky/public/css/styles.css">
    <link rel="stylesheet" href="/musicsky/public/css/index.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap');
    </style>
</head>
<body>
    <?php
    include "./navbar.php";
    ?>

    <main class="main-content">
    Catalogo


    <ul class="index-recent-song-flex">

        <?php foreach ($songs as $song): ?>
            <li class="song-item">
                <!-- Mostrar la miniatura -->
                <a href="<?php echo '/musicsky/src/views/'; ?>song.php?id=<?php echo $song['id']; ?>">
                    <img 
                        src="<?php echo htmlspecialchars('/musicsky/public/uploads/music-thumb/' . $song['thumbnail']); ?>" 
                        alt="Thumbnail de <?php echo htmlspecialchars($song['title']); ?>" 
                        class="song-thumbnail"
                    >
                </a>

                <!-- Mostrar título y género -->
                <div class="song-text">
                    <a href="<?php echo '/musicsky/src/views/'; ?>song.php?id=<?php echo $song['id']; ?>">
                        <?php echo htmlspecialchars($song['title']); ?>
                    </a>
                </div>

            </li>
        <?php endforeach; ?>
    </ul>
    </main>

</body>
</html>