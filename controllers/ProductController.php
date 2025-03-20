<?php
require_once __DIR__ . '/../models/Product.php';

class ProductController {
    public function listProducts() {
        $productModel = new Product();
        $products = $productModel->getAllProducts();
        include __DIR__ . '/../views/products.php';
    }
}