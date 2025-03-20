<?php
class Order {
    private $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function create($user_id, $items) {
        // Insert order into database
        $stmt = $this->db->prepare("INSERT INTO orders (user_id, total_amount) VALUES (?, ?)");
        $totalAmount = $this->calculateTotalAmount($items);
        $stmt->bind_param("ii", $user_id, $totalAmount);
        $stmt->execute();
        $order_id = $stmt->insert_id;

        // Insert order items
        foreach ($items as $product_id => $quantity) {
            $product = (new Product())->getProductById($product_id);
            $this->addOrderItem($order_id, $product_id, $quantity, $product['price']);
        }

        return $order_id;
    }

    private function calculateTotalAmount($items) {
        $totalAmount = 0;
        foreach ($items as $product_id => $quantity) {
            $product = (new Product())->getProductById($product_id);
            $totalAmount += $product['price'] * $quantity;
        }
        return $totalAmount;
    }

    private function addOrderItem($order_id, $product_id, $quantity, $price) {
        $stmt = $this->db->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiii", $order_id, $product_id, $quantity, $price);
        $stmt->execute();
    }

    public function __destruct() {
        $this->db->close();
    }
}