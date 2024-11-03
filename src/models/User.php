<?php
// src/models/User.php
require_once '../../config.php';

class User {
    public static function register($username, $password, $email) {
        global $pdo;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
        return $stmt->execute(['username' => $username, 'password' => $hashedPassword, 'email'=> $email]);
    }

    public static function authenticate($username, $password) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
?>
