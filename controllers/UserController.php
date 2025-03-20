<?php
require_once __DIR__ . '/../models/User.php';

class UserController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = new User();
            if ($user->authenticate($username, $password)) {
                $_SESSION['user'] = $username;
                header('Location: ' . BASE_URL . '?action=dashboard');
            } else {
                echo "Invalid credentials!";
            }
        } else {
            include __DIR__ . '/../views/admin_login.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL);
    }

    public function dashboard() {
        if (isset($_SESSION['user'])) {
            include __DIR__ . '/../views/admin_dashboard.php';
        } else {
            header('Location: ' . BASE_URL . '?action=login');
        }
    }
}