<?php
// src/controllers/auth.php
require_once '../models/User.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        User::register($_POST['username'], $_POST['password']);
        header('Location: ../views/login.php');
    } elseif (isset($_POST['login'])) {
        $user = User::authenticate($_POST['username'], $_POST['password']);
        if ($user) {
            $_SESSION['user'] = $user;
            header('Location: ../../public/index.php');
        } else {
            echo "Credenciales incorrectas.";
        }
    }
}
?>
