<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Products</h1>
    <?php foreach ($products as $product): ?>
        <div>
            <h2><?= $product['name'] ?></h2>
            <p><?= $product['description'] ?></p>
            <p>Price: $<?= $product['price'] ?></p>
            <form action="index.php?action=cart" method="POST">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <input type="number" name="quantity" value="1" min="1">
                <button type="submit">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</body>
</html>