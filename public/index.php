<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/CartController.php';
require_once __DIR__ . '/../controllers/OrderController.php';
require_once __DIR__ . '/../controllers/ProductController.php';

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'login':
        $controller = new UserController();
        $controller->login();
        break;
    case 'logout':
        $controller = new UserController();
        $controller->logout();
        break;
    case 'dashboard':
        $controller = new UserController();
        $controller->dashboard();
        break;
    case 'products':
        $controller = new ProductController();
        $controller->listProducts();
        break;
    case 'add_to_cart':
        $controller = new CartController();
        $controller->addToCart();
        break;
    case 'view_cart':
        $controller = new CartController();
        $controller->viewCart();
        break;
    case 'place_order':
        $controller = new OrderController();
        $controller->placeOrder();
        break;
    case 'order_success':
        include __DIR__ . '/../views/order_success.php';
        break;
    default:
        include __DIR__ . '/../views/home.php';
        break;
}