<?php
require_once __DIR__ . '/../templates/header.php';

$products = $db->query("SELECT * FROM products WHERE id=" . $_GET['id']);
$product = $products->fetch(PDO::FETCH_OBJ);
echo "Detail Products <br>
    <br><br>
    ID = $product->id ,<br> 
    Name = $product->name, <br> 
    Price = Rp $product->price, <br>  
    Weight = $product->weight gr, <br>
    Discount = $product->discount %, <br>
    Stock = $product->stock pcs, <br>
    Description = $product->description, <br>
    Category = " . ($product->category_fk == '' ? '-' : $product->category_fk) . ", <br>
    Thumbnail =  " . ($product->thumbnail == '' ? '-' : $product->thumbnail) . ", <br> ";

require_once '../templates/footer.php';
