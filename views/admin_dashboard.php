<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Include necessary files
require_once '../config/config.php';
require_once '../models/Product.php';
require_once '../models/Order.php';
require_once '../models/User.php';

$productModel = new Product($conn);
$orderModel = new Order($conn);
$userModel = new User($conn);

// Handle actions
$action = $_GET['action'] ?? 'dashboard';

switch ($action) {
    case 'manage_products':
        $products = $productModel->getAllProducts();
        include 'manage_products.php';
        break;
    case 'manage_orders':
        $orders = $orderModel->getAllOrders();
        include 'manage_orders.php';
        break;
    case 'manage_users':
        $users = $userModel->getAllUsers();
        include 'manage_users.php';
        break;
    default:
        echo "<p>Welcome to the Admin Dashboard!</p>";
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <nav>
        <a href="?action=manage_products">Manage Products</a>
        <a href="?action=manage_orders">Manage Orders</a>
        <a href="?action=manage_users">Manage Users</a>
        <a href="../controllers/AdminController.php?action=logout">Logout</a>
    </nav>

    <?php
    // Display the appropriate view based on the action
    if (isset($action)) {
        switch ($action) {
            case 'manage_products':
                include 'manage_products.php';
                break;
            case 'manage_orders':
                include 'manage_orders.php';
                break;
            case 'manage_users':
                include 'manage_users.php';
                break;
            default:
                echo "<p>Welcome to the Admin Dashboard!</p>";
                break;
        }
    }
    ?>
</body>
</html>