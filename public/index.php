<?php
require_once '../src/models/Song.php';
require_once '../src/models/genres.php';
$songs = Song::getSongsIndex();
$genres = Genres::getGenre();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/musicsky/public/css/styles.css">
    <link rel="stylesheet" href="/musicsky/public/css/index.css">
    <title>MusicSky</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bowlby+One+SC&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Nokora:wght@100;300;400;700;900&display=swap');
    </style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" rel="stylesheet">


</head>
<body>
    <?php
        include '../src/views/navbar.php';
    ?>

    

<main class="main-content index-main">
    <h1 class="index-title">MusicSky</h1>
    <h2 class="index-title2">Canciones recientes</h2>
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
                    <div class="album">
                    <?php echo htmlspecialchars($song['genre_name']); ?>
                    </div>
                </div>

            </li>
        <?php endforeach; ?>
    </ul>
    <div class="more">
        <a href="/musicsky/src/views/catalogo.php">
        <i class="fa-solid fa-circle-plus"></i>
        </a>
    </div>


    <h2 class="index-title2">Géneros</h2>
    <ul class="index-recent-song-flex">

        <?php foreach ($genres as $genre): ?>
            <li class="song-item">
                <!-- Mostrar la miniatura -->
                <a href="<?php echo '/musicsky/src/views/catalogo.php'; ?>?genre=<?php echo $genre['id']; ?>&order=default">
                    <img 
                        src="<?php echo htmlspecialchars('/musicsky/public/uploads/genre/' . $genre['thumbnail']); ?>" 
                        alt="Thumbnail de <?php echo htmlspecialchars($genre['genre']); ?>" 
                        class="song-thumbnail"
                    >
                </a>

                <!-- Mostrar título y género -->
                <div class="song-text">
                    <a href="<?php echo '/musicsky/src/views/'; ?>genre.php?id=<?php echo $genre['id']; ?>">
                        <?php echo htmlspecialchars($genre['genre']); ?>
                    </a>
                </div>

            </li>
        <?php endforeach; ?>
    </ul>
    <div class="more">
        <a href="/musicsky/src/views/catalogo.php">
        <i class="fa-solid fa-circle-plus"></i>
        </a>
    </div>
        


    <h2 class="index-title2">Albums Recientes</h2>
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
                    <div class="album">
                    <?php echo htmlspecialchars($song['genre']); ?>
                    </div>
                </div>

            </li>
        <?php endforeach; ?>
    </ul>
    <div class="more">
        <a href="/musicsky/src/views/upload.php">
        <i class='fas fa-angle-down'></i>
        </a>
    </div>
</main>

</body>
</html>