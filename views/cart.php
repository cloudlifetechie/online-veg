<h1>Your Cart</h1>
<table>
    <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Action</th>
    </tr>
    <?php foreach ($cartItems as $item): ?>
        <tr>
            <td><?= $item['product_name'] ?></td>
            <td><?= $item['quantity'] ?></td>
            <td>$<?= $item['product_price'] ?></td>
            <td><a href="remove_item.php?id=<?= $item['cart_id'] ?>">Remove</a></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="checkout.php">Checkout</a>
