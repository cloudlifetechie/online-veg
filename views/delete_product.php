<?php
include_once('../config/config.php');
include_once('../controllers/ProductController.php');

$productController = new ProductController();
if ($productController->deleteProduct($_GET['id'])) {
    header('Location: products.php');
} else {
    echo "Error deleting product.";
}
