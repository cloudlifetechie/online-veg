<?php
require_once '../models/Product.php';

$productModel = new Product($conn);
$products = $productModel->getAllProducts();

include '../views/products.php';
?>