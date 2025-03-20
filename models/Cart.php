<?php
class Cart {
    public function getCartItems($userId) {
        global $db;
        $query = "SELECT * FROM cart WHERE user_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function addItem($userId, $productId, $quantity) {
        global $db;
        $query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('iii', $userId, $productId, $quantity);
        return $stmt->execute();
    }

    public function removeItem($userId, $productId) {
        global $db;
        $query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ii', $userId, $productId);
        return $stmt->execute();
    }
}
