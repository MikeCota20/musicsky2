<?php
// src/controllers/songs.php
require_once '../models/Song.php';

// Verificar si el método de solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['songFile'];
    $file_thumb = $_FILES['thumbnail'];
    $thumb_name = $file_thumb['name'];

    // Validar el tipo de archivo de la canción
    $allowedTypes = ['audio/mpeg', 'audio/wav', 'audio/ogg'];
    if (!in_array($file['type'], $allowedTypes)) {
        echo "Tipo de archivo no permitido para la canción.";
        exit();
    }

    // Validar el tipo de archivo de la imagen
    $allowedImages = ['image/jpg', 'image/jpeg', 'image/png'];
    if (!in_array($file_thumb['type'], $allowedImages)) {
        echo "Tipo de archivo no permitido para la imagen.";
        exit();
    }

    // Definir rutas de destino
    $filePath = '../../public/uploads/' . basename($file['name']);
    $ImagePath = '../../public/uploads/music-thumb/' . basename($file_thumb['name']);

    // Intentar mover ambos archivos
    $isSongUploaded = move_uploaded_file($file['tmp_name'], $filePath);
    $isImageUploaded = move_uploaded_file($file_thumb['tmp_name'], $ImagePath);

    if ($isSongUploaded && $isImageUploaded) {
        // Insertar la canción en la base de datos (sin usuario por ahora)
        Song::addSong($_POST['title'], $_POST['genre'], $_POST['album_id'], $filePath, $thumb_name); // Asegúrate de que la base de datos soporte almacenar ambos campos
        header('Location: ../../public/index.php');
        exit(); // Asegúrate de usar exit después de redirigir
    } else {
        if (!$isSongUploaded) {
            echo "Error al subir la canción: " . $file['error'];
        }
        if (!$isImageUploaded) {
            echo "Error al subir la imagen: " . $file_thumb['error'];
        }
    }
}
?>
