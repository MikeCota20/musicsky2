<?php
// src/controllers/songs.php
require_once '../models/genres.php';

// Verificar si el método de solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['thumbnail'];
    $thumb_name = $file['name'];


    // Validar el tipo de archivo de la imagen
    $allowedImages = ['image/jpg', 'image/jpeg', 'image/png'];
    if (!in_array($file['type'], $allowedImages)) {
        echo "Tipo de archivo no permitido para la imagen.";
        exit();
    }

    // Definir rutas de destino
    $ImagePath = '../../public/uploads/genre/' . basename($file['name']);

    // Intentar mover ambos archivos
    $isImageUploaded = move_uploaded_file($file['tmp_name'], $ImagePath);

    if ($isImageUploaded) {
        // Insertar la canción en la base de datos (sin usuario por ahora)
        Genres::addGenre($_POST['genre'], $thumb_name); // Asegúrate de que la base de datos soporte almacenar ambos campos
        header('Location: ../../public/index.php');
        exit(); // Asegúrate de usar exit después de redirigir
    } else {
        if (!$isImageUploaded) {
            echo "Error al subir la imagen: " . $file['error'];
        }
    }
}
?>
