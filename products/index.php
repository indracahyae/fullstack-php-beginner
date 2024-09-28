<?php 
    require_once '../templates/header.php';
   
    $products = $db->query("SELECT * FROM products");
    echo 'Data Products <br>';
    while($product = $products->fetch(PDO::FETCH_OBJ)) { 
        echo "$product->id , $product->name <a href='./detail.php?id=$product->id'>detail</a> <br>";
    };
        
    require_once '../templates/footer.php';
?>
