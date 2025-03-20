<?php
require_once '../config/config.php';

\Stripe\Stripe::setApiKey(STRIPE_SECRET);

$checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price_data' => [
            'currency' => 'usd',
            'product_data' => [
                'name' => 'Vegetable Shop Order',
            ],
            'unit_amount' => 2000, // $20.00
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'http://yourdomain.com/stripe/success.php',
    'cancel_url' => 'http://yourdomain.com/stripe/cancel.php',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
?>