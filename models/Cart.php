<?php
class Cart {
    public function addItem($product_id, $quantity) {
        // Add item to cart (session or database)
        $_SESSION['cart'][$product_id] = $quantity;
    }

    public function getItems() {
        return $_SESSION['cart'] ?? [];
    }

    public function clear() {
        unset($_SESSION['cart']);
    }
}