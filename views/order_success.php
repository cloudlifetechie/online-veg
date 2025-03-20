<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Success</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
</head>
<body>
    <h1>Order Placed Successfully!</h1>
    <p>Your payment intent ID is: <?php echo $_GET['payment_intent']; ?></p>
    <a href="<?php echo BASE_URL; ?>">Continue Shopping</a>
</body>
</html>