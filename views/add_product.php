<h1>Add New Product</h1>
<form action="add_product_action.php" method="POST" enctype="multipart/form-data">
    <label for="name">Product Name:</label>
    <input type="text" name="name" required><br>

    <label for="price">Price:</label>
    <input type="number" name="price" required><br>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea><br>

    <label for="image">Product Image:</label>
    <input type="file" name="image" required><br>

    <button type="submit">Add Product</button>
</form>
