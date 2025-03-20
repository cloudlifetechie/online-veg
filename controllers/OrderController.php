<?php
include_once('models/Order.php');

class OrderController {
    public function placeOrder($userId, $paymentIntentId) {
        $order = new Order();
        return $order->createOrder($userId, $paymentIntentId);
    }

    public function getOrderDetails($orderId) {
        $order = new Order();
        return $order->getOrderDetails($orderId);
    }
    public function createOrder($userId, $amount, $paymentStatus) {
        $order = new Order();
        $order->user_id = $userId;
        $order->amount = $amount;
        $order->status = $paymentStatus;
        $order->save();
    }
}
