<?php
require_once 'config/config.php';
require_once 'models/Order.php';

class OrderController {

    // Create a new order
    public function createOrder($userId, $cartItems, $total, $address, $paymentMethod) {
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);

        // Insert the order into the orders table
        $stmt = $db->prepare("INSERT INTO orders (user_id, total, address, payment_method, order_date) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$userId, $total, $address, $paymentMethod]);

        // Get the last inserted order ID
        $orderId = $db->lastInsertId();

        // Insert the cart items into the order_items table
        $stmt = $db->prepare("INSERT INTO order_items (order_id, vegetable_id, quantity, price) VALUES (?, ?, ?, ?)");
        foreach ($cartItems as $item) {
            $stmt->execute([$orderId, $item['vegetable_id'], $item['quantity'], $item['price']]);
        }

        // Return true if the order was successfully created
        return $stmt->rowCount() > 0;
    }
}
