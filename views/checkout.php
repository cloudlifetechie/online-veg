<?php
// Include config file to get the Stripe API key
require_once('../config/config.php');

// Assuming you have a Cart model or session to hold cart items
// For example, the cart could be stored in the session
session_start();

// Example cart data (In production, this should come from your cart model/session)
$cartItems = [
    [
        'name' => 'Carrot',
        'quantity' => 2,
        'price' => 150 // price in cents, $1.50
    ],
    [
        'name' => 'Broccoli',
        'quantity' => 1,
        'price' => 200 // price in cents, $2.00
    ]
];

// Calculate the total amount
$totalAmount = 0;
foreach ($cartItems as $item) {
    $totalAmount += $item['quantity'] * $item['price'];
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

        <h2>Your Cart</h2>
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            <?php foreach ($cartItems as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= htmlspecialchars($item['quantity']) ?></td>
                <td>$<?= number_format($item['price'] / 100, 2) ?></td>
                <td>$<?= number_format(($item['quantity'] * $item['price']) / 100, 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <h3>Total Amount: $<?= number_format($totalAmount / 100, 2) ?></h3>

        <!-- Stripe Payment Form -->
        <h2>Payment Details</h2>
        <form action="charge.php" method="POST" id="payment-form">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div id="card-element" class="form-group">
                <!-- A Stripe Element will be inserted here. -->
            </div>
            <div id="card-errors" role="alert"></div>

            <button type="submit" class="submit-btn">Pay Now</button>
        </form>

        <script src="https://js.stripe.com/v3/"></script>
        <script>
            var stripe = Stripe('<?= STRIPE_PUBLISHABLE_KEY ?>');
            var elements = stripe.elements();
            var style = {
                base: {
                    color: "#32325d",
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: "antialiased",
                    fontSize: "16px",
                    "::placeholder": {
                        color: "#aab7c4"
                    }
                },
                invalid: {
                    color: "#fa755a",
                    iconColor: "#fa755a"
                }
            };
            var card = elements.create("card", {style: style});
            card.mount("#card-element");

            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Add total amount as a hidden field
                var hiddenAmountInput = document.createElement('input');
                hiddenAmountInput.setAttribute('type', 'hidden');
                hiddenAmountInput.setAttribute('name', 'amount');
                hiddenAmountInput.setAttribute('value', '<?= $totalAmount ?>'); // Amount in cents
                form.appendChild(hiddenAmountInput);

                // Submit the form
                form.submit();
            }
        </script>
    </div>
</body>
</html>
