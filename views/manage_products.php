<h2>Manage Products</h2>
<a href="?action=add_product">Add New Product</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><?= $product['name'] ?></td>
                <td>$<?= $product['price'] ?></td>
                <td>
                    <a href="?action=edit_product&id=<?= $product['id'] ?>">Edit</a>
                    <a href="?action=delete_product&id=<?= $product['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>