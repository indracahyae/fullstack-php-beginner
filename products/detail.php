<?php
require_once __DIR__ . '/../templates/header.php';

$products = $db->query(
    "SELECT products.id, products.name as nama_produk, products.price, products.weight, products.discount, products.stock, products.description, product_categories.name as category, products.thumbnail 
    FROM products 
    INNER JOIN product_categories ON products.category_fk=product_categories.id 
    WHERE products.id=" . $_GET['id']);
$product = $products->fetch(PDO::FETCH_OBJ);
echo "Detail Products <br>
    <br><br>
    ID = $product->id ,<br> 
    Name = $product->nama_produk, <br> 
    Price = Rp $product->price, <br>  
    Weight = $product->weight gr, <br>
    Discount = $product->discount %, <br>
    Stock = $product->stock pcs, <br>
    Description = $product->description, <br>
    Category = " . ($product->category == '' ? '-' : $product->category) 
    . ", <br> ";

if ($product->thumbnail !== '') {
    echo "<img src='/php-beginner/assets/product_thumbnail/$product->thumbnail' style='width:500px;height:auto;'>";
} else {
    echo '-';
}

require_once '../templates/footer.php';
