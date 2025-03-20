<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
</head>
<body>
    <h1>Products</h1>
    <ul>
        <?php foreach ($products as $product): ?>
            <li>
                <?php echo $product['name']; ?> - 
                £<?php echo number_format($product['price'] / 100, 2); ?>
                <a href="<?php echo BASE_URL; ?>?action=add_to_cart&product_id=<?php echo $product['id']; ?>">Add to Cart</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>