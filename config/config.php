<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'Maria@2025');
define('DB_NAME', 'vegetable_shop');

// Stripe configuration
define('STRIPE_SECRET_KEY', 'sk_test_XXXXXXXXXXXXXXXXXXXXXXXX'); 
define('STRIPE_PUBLIC_KEY', 'pk_test_XXXXXXXXXXXXXXXXXXXXXXXX'); 

// Base URL
define('BASE_URL', 'http://52.90.66.221/public/');

// Start session
session_start();