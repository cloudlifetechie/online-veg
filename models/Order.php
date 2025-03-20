<?php
class Order {
    public function createOrder($userId, $paymentIntentId) {
        global $db;
        $query = "INSERT INTO orders (user_id, payment_intent_id) VALUES (?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('is', $userId, $paymentIntentId);
        return $stmt->execute();
    }

    public function getOrderDetails($orderId) {
        global $db;
        $query = "SELECT * FROM orders WHERE order_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $orderId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
