<?php
class Order {
    private $db;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    }

    public function create($user_id, $items) {
        // Insert order into database
        $stmt = $this->db->prepare("INSERT INTO orders (user_id) VALUES (?)");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->insert_id;
    }
}