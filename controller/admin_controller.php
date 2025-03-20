<?php
require_once '../models/User.php';
require_once '../models/Product.php';
require_once '../models/Order.php';

class AdminController {
    private $userModel;
    private $productModel;
    private $orderModel;

    public function __construct($conn) {
        $this->userModel = new User($conn);
        $this->productModel = new Product($conn);
        $this->orderModel = new Order($conn);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password']) && $user['role'] === 'admin') {
                $_SESSION['admin_id'] = $user['id'];
                header("Location: ../views/admin_dashboard.php");
                exit();
            } else {
                echo "Invalid credentials or not an admin.";
            }
        }
    }

    public function logout() {
        session_destroy();
        header("Location: ../views/admin_login.php");
        exit();
    }

    public function manageProducts() {
        $products = $this->productModel->getAllProducts();
        include '../views/manage_products.php';
    }

    public function manageOrders() {
        $orders = $this->orderModel->getAllOrders();
        include '../views/manage_orders.php';
    }

    public function manageUsers() {
        $users = $this->userModel->getAllUsers();
        include '../views/manage_users.php';
    }
}

// Handle actions
$action = $_GET['action'] ?? '';

$adminController = new AdminController($conn);

switch ($action) {
    case 'login':
        $adminController->login();
        break;
    case 'logout':
        $adminController->logout();
        break;
    case 'manage_products':
        $adminController->manageProducts();
        break;
    case 'manage_orders':
        $adminController->manageOrders();
        break;
    case 'manage_users':
        $adminController->manageUsers();
        break;
    default:
        header("Location: ../views/admin_dashboard.php");
        break;
}
?>