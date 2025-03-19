<?php
require_once 'models/Cart.php';

class CartController {

    public function addToCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $vegetableId = $_GET['id'];
            Cart::addToCart($vegetableId);
        }
        header("Location: index.php");
    }

    public function viewCart() {
        $cartItems = Cart::getCartItems();
        include 'views/cart.php';
    }
}
