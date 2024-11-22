<?php
require_once '../src/models/Song.php';
$songs = Song::getSongsIndex();
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
    </style>
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
                <div>
                    <a href="<?php echo '/musicsky/src/views/'; ?>song.php?id=<?php echo $song['id']; ?>">
                        <?php echo htmlspecialchars($song['title']); ?>
                    </a>
                    - <?php echo htmlspecialchars($song['genre']); ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</main>

</body>
</html>