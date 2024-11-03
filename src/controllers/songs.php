<?php
// src/controllers/songs.php
require_once '../models/Song.php';

// Verificar si el método de solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['songFile'];

    // Validar el tipo de archivo
    $allowedTypes = ['audio/mpeg', 'audio/wav', 'audio/ogg'];
    if (!in_array($file['type'], $allowedTypes)) {
        echo "Tipo de archivo no permitido.";
        exit();
    }

    // Intentar mover el archivo subido
    $filePath = '../../public/uploads/' . basename($file['name']);
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Insertar la canción en la base de datos (sin usuario por ahora)
        Song::addSong($_POST['title'], $_POST['genre'], $_POST['album_id'], $filePath); // Usar null o eliminar el argumento de usuario
        header('Location: ../../public/index.php');
        exit(); // Asegúrate de usar exit después de redirigir
    } else {
        echo "Error al subir el archivo: " . $file['error'];
    }
}
?>
