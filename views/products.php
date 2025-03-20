<h1>Product List</h1>
<table>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><?= $product['name'] ?></td>
            <td>$<?= $product['price'] ?></td>
            <td><?= $product['description'] ?></td>
            <td>
                <a href="product_detail.php?id=<?= $product['product_id'] ?>">View</a>
                <a href="edit_product.php?id=<?= $product['product_id'] ?>">Edit</a>
                <a href="delete_product.php?id=<?= $product['product_id'] ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="add_product.php">Add New Product</a>
