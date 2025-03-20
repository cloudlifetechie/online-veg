<?php
$product = $productController->getProduct($_GET['id']);
?>

<h1><?= $product['name'] ?></h1>
<img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" />
<p><?= $product['description'] ?></p>
<p>Price: $<?= $product['price'] ?></p>

<a href="add_to_cart.php?id=<?= $product['product_id'] ?>">Add to Cart</a>
