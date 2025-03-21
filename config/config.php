<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'vegetable_shop');

// Stripe configuration
define('STRIPE_KEY', 'your_stripe_publishable_key');
define('STRIPE_SECRET', 'your_stripe_secret_key');

// Start session
session_start();

// Database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>