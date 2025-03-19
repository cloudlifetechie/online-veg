<?php
require_once 'config/config.php';

class Cart {

    // Add a vegetable to the cart
    public static function addToCart($vegetableId) {
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $stmt = $db->prepare("INSERT INTO cart_items (user_id, vegetable_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $vegetableId, 1]);
    }

    // Get the items in the cart for a specific user
    public static function getItems($userId) {
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $stmt = $db->prepare("SELECT c.*, v.name, v.price FROM cart_items c JOIN vegetables v ON c.vegetable_id = v.id WHERE c.user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Calculate the total price of the items in the cart
    public static function getTotal($cartItems) {
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    // Clear the cart for a specific user
    public static function clearCart($userId) {
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $stmt = $db->prepare("DELETE FROM cart_items WHERE user_id = ?");
        $stmt->execute([$userId]);
    }
}
