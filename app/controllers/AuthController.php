<?php
namespace App\Controllers;

use App\Models\User;

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = User::verify($username, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: /?action=home");
                exit;
            } else {
                $error = "Invalid credentials";
            }
        }
        require __DIR__ . '/../views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];

            if ($password !== $confirm) {
                $error = "Passwords do not match.";
            } else if (User::findByUsername($username)) {
                $error = "Username already taken.";
            } else {
                User::create($username, $password);
                header("Location: /?action=login");
                exit;
            }
        }
        require __DIR__ . '/../views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        header("Location: /");
    }

    public function guest() {
        $_SESSION['guest'] = true;
        header("Location: /?action=home");
    }
}
