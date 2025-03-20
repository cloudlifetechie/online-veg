<?php
include_once('models/User.php');

class UserController {
    public function login($email, $password) {
        $user = new User();
        return $user->authenticate($email, $password);
    }

    public function register($email, $password, $name) {
        $user = new User();
        return $user->createUser($email, $password, $name);
    }
}
