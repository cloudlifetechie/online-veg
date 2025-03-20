<?php
include_once('models/Cart.php');
include_once('models/Product.php');

class CartController {
    public function viewCart($userId) {
        $cart = new Cart();
        return $cart->getCartItems($userId);
    }

    public function addToCart($userId, $productId, $quantity) {
        $cart = new Cart();
        return $cart->addItem($userId, $productId, $quantity);
    }

    public function removeFromCart($userId, $productId) {
        $cart = new Cart();
        return $cart->removeItem($userId, $productId);
    }

    public function checkout($userId) {
        $cart = new Cart();
        $items = $cart->getCartItems($userId);
        $totalAmount = 0;

        foreach ($items as $item) {
            $totalAmount += $item['product_price'] * $item['quantity'];
        }

        // Create Stripe payment intent
        $stripe = new \Stripe\StripeClient(STRIPE_SECRET_KEY);
        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $totalAmount * 100,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);

        return $paymentIntent;
    }
}
