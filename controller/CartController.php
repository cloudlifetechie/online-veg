<?php
require_once '../models/Cart.php';

$cartModel = new Cart($conn);
$userId = $_SESSION['user_id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $cartModel->addToCart($userId, $productId, $quantity);
}

$cartItems = $cartModel->getCartItems($userId);

include '../views/cart.php';
?>