<?php
class Product {
    private $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    /**
     * Get all products from the database.
     */
    public function getAllProducts() {
        $query = "SELECT * FROM products";
        $result = $this->db->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get a single product by its ID.
     */
    public function getProductById($product_id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Add a new product to the database.
     */
    public function addProduct($name, $description, $price, $stock) {
        $stmt = $this->db->prepare("INSERT INTO products (name, description, price, stock) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssii", $name, $description, $price, $stock);
        return $stmt->execute();
    }

    /**
     * Update an existing product.
     */
    public function updateProduct($product_id, $name, $description, $price, $stock) {
        $stmt = $this->db->prepare("UPDATE products SET name = ?, description = ?, price = ?, stock = ? WHERE id = ?");
        $stmt->bind_param("ssiii", $name, $description, $price, $stock, $product_id);
        return $stmt->execute();
    }

    /**
     * Delete a product from the database.
     */
    public function deleteProduct($product_id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        return $stmt->execute();
    }

    /**
     * Close the database connection.
     */
    public function __destruct() {
        $this->db->close();
    }
}