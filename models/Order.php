<?php
class Order {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Get all orders
    public function getAllOrders() {
        $sql = "SELECT * FROM orders";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get order details by order ID
    public function getOrderDetails($orderId) {
        $sql = "SELECT * FROM order_items WHERE order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Update order status (for admin functionality)
    public function updateOrderStatus($orderId, $status) {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $status, $orderId);
        return $stmt->execute();
    }

    // Delete an order (for admin functionality)
    public function deleteOrder($orderId) {
        $sql = "DELETE FROM orders WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $orderId);
        return $stmt->execute();
    }
}
?>