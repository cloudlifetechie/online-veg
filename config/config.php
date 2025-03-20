<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'vegetable_shop');

// Stripe configuration
define('STRIPE_SECRET_KEY', 'sk_test_XXXXXXXXXXXXXXXXXXXXXXXX'); // Replace with your Stripe Secret Key
define('STRIPE_PUBLIC_KEY', 'pk_test_XXXXXXXXXXXXXXXXXXXXXXXX'); // Replace with your Stripe Publishable Key

// Base URL
define('BASE_URL', 'http://localhost/vegetable-shop/public/');

// Start session
session_start();