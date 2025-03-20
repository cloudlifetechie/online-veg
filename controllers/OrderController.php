<?php
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../vendor/autoload.php'; // Include Composer autoload

use Stripe\Stripe;
use Stripe\PaymentIntent;

class OrderController {
    public function placeOrder() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user_id'];
            $cart = new Cart();
            $items = $cart->getItems();

            // Calculate total amount in pence
            $totalAmount = 0;
            foreach ($items as $product_id => $quantity) {
                $product = (new Product())->getProductById($product_id);
                $totalAmount += $product['price'] * $quantity; // Price is already in pence
            }

            // Set your secret key
            Stripe::setApiKey(STRIPE_SECRET_KEY);

            // Create a PaymentIntent
            try {
                $paymentIntent = PaymentIntent::create([
                    'amount' => $totalAmount, // Amount in pence
                    'currency' => 'gbp', // Currency set to GBP
                    'metadata' => [
                        'user_id' => $user_id,
                        'cart_items' => json_encode($items)
                    ],
                ]);

                // Pass the client secret to the view
                $clientSecret = $paymentIntent->client_secret;
                include __DIR__ . '/../views/cart.php';
            } catch (\Stripe\Exception\ApiErrorException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
}