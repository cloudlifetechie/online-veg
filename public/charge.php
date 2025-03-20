<?php
require_once('../vendor/autoload.php'); // Make sure you include the Stripe PHP SDK

// Include the Stripe secret key
require_once('../config/config.php');

// Set the API key
\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

// Get the token from the POST data
$token = $_POST['stripeToken'];
$email = $_POST['email'];
$amount = 5000; // The amount in cents (e.g., 5000 = $50)

try {
    // Create a customer and charge the payment
    $customer = \Stripe\Customer::create([
        'email' => $email,
        'source' => $token,
    ]);

    $charge = \Stripe\Charge::create([
        'customer' => $customer->id,
        'amount' => $amount,
        'currency' => 'usd',
        'description' => 'Vegetable Shop Order',
    ]);

    // If payment is successful, redirect to success page
    header('Location: order_success.php');
    exit();
} catch (Exception $e) {
    // If there is an error, display it
    echo 'Error: ' . $e->getMessage();
}
?>
