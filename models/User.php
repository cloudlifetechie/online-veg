<?php
class User {
    public function authenticate($email, $password) {
        global $db;
        $query = "SELECT * FROM users WHERE email = ? AND password = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createUser($email, $password, $name) {
        global $db;
        $query = "INSERT INTO users (email, password, name) VALUES (?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('sss', $email, $password, $name);
        return $stmt->execute();
    }
}
