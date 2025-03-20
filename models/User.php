<?php
class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Get user by email
    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Get all users
    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Add a new user (for admin functionality)
    public function addUser($username, $email, $password, $role = 'customer') {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);
        return $stmt->execute();
    }

    // Update user role (for admin functionality)
    public function updateUserRole($userId, $role) {
        $sql = "UPDATE users SET role = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $role, $userId);
        return $stmt->execute();
    }

    // Delete a user (for admin functionality)
    public function deleteUser($userId) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }
}
?>