<?php
require_once '../src/models/Song.php';
$songs = Song::getSongs();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MusicSky</title>
</head>
<body>
    <?php
        include '../src/views/navbar.php';
    ?>

    <main>
        <h1>Index</h1>
        <h2>Lista de Canciones</h2>
    <ul>
        <?php foreach ($songs as $song): ?>
            <li>
                <a href="<?php echo '/musicsky/src/views/'; ?>song.php?id=<?php echo $song['id']; ?>"><?php echo htmlspecialchars($song['title']); ?></a> - <?php echo htmlspecialchars($song['genre']); ?>
            </li>
        <?php endforeach; ?>
    </ul>
    </main>
</body>
</html>