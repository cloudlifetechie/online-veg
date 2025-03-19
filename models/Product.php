<?php
require_once 'config/config.php';

class Product {

    public static function getAllVegetables() {
        $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $stmt = $db->prepare("SELECT * FROM vegetables");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
