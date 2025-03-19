<?php
session_start();
require_once '../config/config.php';
require_once '../models/Cart.php';
require_once '../models/Order.php';
require_once '../models/User.php';
require_once '../controllers/OrderController.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get cart details
$cart = new Cart();
$cartItems = $cart->getItems($_SESSION['user_id']); // Pass the user ID to get the cart items
$total = $cart->getTotal($cartItems); // Get the total from the cart items

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id'];
    $address = $_POST['address'];
    $paymentMethod = $_POST['payment_method'];

    // Create a new order
    $orderController = new OrderController();
    $orderSuccess = $orderController->createOrder($userId, $cartItems, $total, $address, $paymentMethod);

    if ($orderSuccess) {
        // Clear the cart after successful order
        $cart->clearCart($_SESSION['user_id']);
        header('Location: order_success.php');
        exit();
    } else {
        $error = "There was an error processing your order. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Vegetable Shop</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Checkout</h1>

        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <div class="cart-summary">
            <h2>Your Cart</h2>
            <table>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td><?= $item['name'] ?></td>
                        <td><?= number_format($item['price'], 2) ?> £</td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['price'] * $item['quantity'], 2) ?> £</td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <p><strong>Total: <?= number_format($total, 2) ?> £</strong></p>
        </div>

        <form action="checkout.php" method="POST">
            <div class="form-group">
                <label for="address">Shipping Address</label>
                <textarea name="address" id="address" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="stripe">Credit/Debit Card (Stripe)</option>
                    <!-- Add other payment methods here if needed -->
                </select>
            </div>

            <button type="submit" class="btn">Place Order</button>
        </form>
    </div>

    <script src="../assets/js/script.js"></script>
</body>
</html>
