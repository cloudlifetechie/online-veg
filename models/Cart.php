<?php
class Cart {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addToCart($userId, $productId, $quantity) {
        $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $userId, $productId, $quantity);
        $stmt->execute();
    }

    public function getCartItems($userId) {
        $sql = "SELECT * FROM cart WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>