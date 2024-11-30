<?php
// src/controllers/auth.php
require_once '../models/User.php';

// Manejar solicitudes POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        User::register($_POST['username'], $_POST['password'], $_POST['email']);
        header('Location: /musicsky/src/views/login.php');
        exit; // Asegúrate de detener la ejecución
    } elseif (isset($_POST['login'])) {
        $user = User::authenticate($_POST['username'], $_POST['password']);
        if ($user) {
            $_SESSION['user'] = $user;
            header('Location: ../../public/index.php');
            exit; // Detén la ejecución después de redireccionar
        } else {
            echo "Credenciales incorrectas.";
        }
    }
}