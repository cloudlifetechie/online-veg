<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'vegetable_shop');

define('STRIPE_SECRET_KEY', 'your_stripe_secret_key');
define('STRIPE_PUBLIC_KEY', 'your_stripe_public_key');

// Create database connection
$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
