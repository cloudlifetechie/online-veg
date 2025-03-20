<?php
class Product {
    // Method to fetch all products from the database
    public function getAllProducts() {
        global $db;
        $query = "SELECT * FROM products";
        $result = $db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Method to fetch a single product by its ID
    public function getProductById($productId) {
        global $db;
        $query = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $productId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Method to add a new product to the database
    public function createProduct($name, $price, $description, $image) {
        global $db;
        $query = "INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ssss', $name, $price, $description, $image);
        return $stmt->execute();
    }

    // Method to update an existing product
    public function updateProduct($productId, $name, $price, $description, $image) {
        global $db;
        $query = "UPDATE products SET name = ?, price = ?, description = ?, image = ? WHERE product_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('ssssi', $name, $price, $description, $image, $productId);
        return $stmt->execute();
    }

    // Method to delete a product
    public function deleteProduct($productId) {
        global $db;
        $query = "DELETE FROM products WHERE product_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $productId);
        return $stmt->execute();
    }
}
