<?php
require_once __DIR__ . '/../models/Cart.php';
require_once __DIR__ . '/../models/Product.php';

class CartController {
    public function addToCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            $cart = new Cart();
            $cart->addItem($product_id, $quantity);

            header('Location: ' . BASE_URL . '?action=view_cart');
        }
    }

    public function viewCart() {
        $cart = new Cart();
        $items = $cart->getItems();
        include __DIR__ . '/../views/cart.php';
    }
}