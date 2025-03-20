<?php
include_once('../config/config.php');
include_once('../controllers/ProductController.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    if (!empty($image)) {
        move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $image); // Save image to folder
    }

    $productController = new ProductController();
    if ($productController->updateProduct($_GET['id'], $name, $price, $description, $image)) {
        header('Location: products.php');
    } else {
        echo "Error updating product.";
    }
}
