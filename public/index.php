<?php
require_once '../config/config.php';

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        include '../views/home.php';
        break;
    case 'products':
        include '../controllers/ProductController.php';
        break;
    case 'cart':
        include '../controllers/CartController.php';
        break;
    case 'checkout':
        include '../views/checkout.php';
        break;
    case 'admin':
        include '../controllers/AdminController.php';
        break;
    case 'admin_login':
        include '../views/admin_login.php';
        break;
    case 'admin_dashboard':
        include '../views/admin_dashboard.php';
        break;
    default:
        include '../views/home.php';
        break;
}
?>