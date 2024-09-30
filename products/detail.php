<?php
require_once __DIR__ . '/../templates/header.php';

$products = $db->query("SELECT * FROM products WHERE id=" . $_GET['id']);
$product = $products->fetch(PDO::FETCH_OBJ);
echo "Detail Products <br>
    <br><br>
    ID = $product->id ,<br> 
    Name = $product->name, <br> 
    Price = $product->price, <br>  
    Weight = $product->weight, <br>
    Description = $product->description, <br>
    Thumbnail = $product->thumbnail, <br> 
    Discount = $product->discount,  <br>
    Stock = $product->stock, <br>
    Category = ". ($product->category_fk=='' ? '-':$product->category_fk);

require_once '../templates/footer.php';
