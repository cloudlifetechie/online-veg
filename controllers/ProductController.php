<?php
include_once('models/Product.php');

class ProductController {
    // Method to get all products
    public function getAllProducts() {
        $product = new Product();
        return $product->getAllProducts();
    }

    // Method to get a single product by its ID
    public function getProduct($productId) {
        $product = new Product();
        return $product->getProductById($productId);
    }

    // Method to add a new product
    public function addProduct($name, $price, $description, $image) {
        $product = new Product();
        return $product->createProduct($name, $price, $description, $image);
    }

    // Method to update product details
    public function updateProduct($productId, $name, $price, $description, $image) {
        $product = new Product();
        return $product->updateProduct($productId, $name, $price, $description, $image);
    }

    // Method to delete a product
    public function deleteProduct($productId) {
        $product = new Product();
        return $product->deleteProduct($productId);
    }
}
