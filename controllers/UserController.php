<?php
require_once 'models/User.php';

class UserController {

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = User::login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                header("Location: index.php");
            } else {
                echo "Invalid credentials.";
            }
        }
        include 'views/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            User::register($name, $email, $password);
            header("Location: index.php?action=login");
        }
        include 'views/register.php';
    }
}
