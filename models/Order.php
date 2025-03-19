<?php
require_once 'config/config.php';

class Order {

    public static function createOrder($userId, $totalPrice) {
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $stmt = $db->prepare("INSERT INTO orders (user_id, total_price, status) VALUES (?, ?, 'Pending')");
        $stmt->execute([$userId, $totalPrice]);
        return $db->lastInsertId();
    }

    public static function createOrderItem($orderId, $vegetableId, $quantity, $price) {
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $stmt = $db->prepare("INSERT INTO order_items (order_id, vegetable_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$orderId, $vegetableId, $quantity, $price]);
    }
}
