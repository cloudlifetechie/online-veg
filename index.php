<?php
require_once 'config/config.php';
require_once 'controllers/CartController.php';
require_once 'controllers/OrderController.php';
require_once 'controllers/UserController.php';

$cartController = new CartController();
$orderController = new OrderController();
$userController = new UserController();

// Route handling logic (simplified)
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'add_to_cart') {
        $cartController->addToCart();
    } elseif ($action == 'checkout') {
        $orderController->checkout();
    } elseif ($action == 'login') {
        $userController->login();
    } elseif ($action == 'register') {
        $userController->register();
    }
} else {
    include 'views/home.php';  // Default homepage displaying vegetables
}
