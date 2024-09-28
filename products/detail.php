<?php 
    require_once __DIR__.'/../templates/header.php';
   
    $products = $db->query("SELECT * FROM products WHERE id=" .$_GET['id']);
    $product = $products->fetch(PDO::FETCH_OBJ);
    echo "Detail Products <br>" ;
    echo "$product->id , $product->name , $product->price";
    
    require_once '../templates/footer.php';
?>