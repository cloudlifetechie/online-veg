<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    <script src="https://js.stripe.com/v3/"></script> <!-- Include Stripe.js -->
</head>
<body>
    <h1>Your Cart</h1>
    <ul>
        <?php foreach ($items as $product_id => $quantity): ?>
            <?php $product = (new Product())->getProductById($product_id); ?>
            <li>
                <?php echo $product['name']; ?> - 
                Quantity: <?php echo $quantity; ?> - 
                Price: £<?php echo number_format($product['price'] / 100, 2); ?> each
            </li>
        <?php endforeach; ?>
    </ul>

    <p>Total: £<?php echo number_format($totalAmount / 100, 2); ?></p>

    <form id="payment-form">
        <div id="card-element">
            <!-- Stripe Card Element will be inserted here -->
        </div>
        <button id="submit-button">Pay Now</button>
        <div id="payment-message" class="hidden"></div>
    </form>

    <script>
        const stripe = Stripe('<?php echo STRIPE_PUBLIC_KEY; ?>');
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit-button');
        const paymentMessage = document.getElementById('payment-message');

        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            submitButton.disabled = true;

            const { paymentIntent, error } = await stripe.confirmCardPayment(
                '<?php echo $clientSecret; ?>', {
                    payment_method: {
                        card: cardElement,
                    }
                }
            );

            if (error) {
                paymentMessage.textContent = error.message;
                paymentMessage.classList.remove('hidden');
                submitButton.disabled = false;
            } else {
                window.location.href = '<?php echo BASE_URL; ?>?action=order_success&payment_intent=' + paymentIntent.id;
            }
        });
    </script>
</body>
</html>