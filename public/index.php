<?php
require_once '../src/models/Song.php';
$songs = Song::getSongs();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/styles.css">
    <link rel="stylesheet" href="../public/css/index.css">
    <title>MusicSky</title>
</head>
<body>
    <?php
        include '../src/views/navbar.php';
    ?>

    

    <main class="main-content index-main">
    <div class="video-background">
        <!-- Video de fondo -->
        <video autoplay muted loop id="background-video">
            <source src="../public/uploads/Untitled video (3).mp4" type="video/mp4">
            Tu navegador no soporta el elemento de video.
        </video>
    </div>

        <h1 class="index-title">MusicSky</h1>
        <h2 class="index-title">Lista de Canciones</h2>
    <ul class="index-recent-song-flex">
        <?php foreach ($songs as $song): ?>
            <li>
                <a href="<?php echo '/musicsky/src/views/'; ?>song.php?id=<?php echo $song['id']; ?>"><?php echo htmlspecialchars($song['title']); ?></a> - <?php echo htmlspecialchars($song['genre']); ?>
            </li>
        <?php endforeach; ?>
    </ul>
    </main>
</body>
</html>