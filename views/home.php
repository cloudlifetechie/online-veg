<?php
require_once 'models/Product.php';

$products = Product::getAllVegetables();

?>

<h1>Welcome to Our Online Vegetable Store</h1>

<div class="products">
    <?php foreach ($products as $product): ?>
        <div class="product">
            <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>">
            <h3><?php echo $product['name']; ?></h3>
            <p><?php echo $product['description']; ?></p>
            <p>Price: £<?php echo $product['price']; ?></p>
            <a href="index.php?action=add_to_cart&id=<?php echo $product['id']; ?>">Add to Cart</a>
        </div>
    <?php endforeach; ?>
</div>
