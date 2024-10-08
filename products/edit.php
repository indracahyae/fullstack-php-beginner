<?php
require_once '../templates/header.php';

$products = $db->query("SELECT * FROM products WHERE id = " . $_GET['id']);
// $query->execute();
$product = $products->fetch(PDO::FETCH_OBJ);
?>

<h3>Edit Product</h3>
<form action="" method="post">
    <input type="hidden" name="id" value="<?= $product->id; ?>"> <br>
    <input type="text" name="name" id="" placeholder="Name" value="<?= $product->name; ?>"> <br>
    <input type="number" name="price" id="" placeholder="Price (Rp)" value="<?= $product->price; ?>"> <br>
    <input type="number" name="weight" id="" placeholder="Weight (gr)" value="<?= $product->weight; ?>"> <br>
    <input type="number" name="discount" id="" placeholder="Discount (%)" value="<?= $product->discount; ?>"> <br>
    <input type="number" name="stock" id="" placeholder="Stock (pcs)" value="<?= $product->stock; ?>"> <br>
    <textarea name="description" id="" rows="7" placeholder="Description" ><?= $product->description; ?></textarea> <br>
    <span>Category</span>
    <select name="category_fk" id="">
        <option value="1">xxx</option>
        <option value="2">yyy</option>
        <option value="3">zzz</option>
    </select> <br>
    <span>Thumbnail</span>
    <input type="file" name="thumbnail" id="" placeholder="Thumbnail"><br><br>
    <button type="submit" name="update">Update</button>
</form>

<!-- update here -->
 <?php

if (isset($_POST['update'])) {
    $params = [
        ':name' => $_POST['name'],
        ':price' => $_POST['price'],
        ':weight' => $_POST['weight'],
        ':discount' => $_POST['discount'],
        ':stock' => $_POST['stock'],
        ':description' => $_POST['description'],
    ];
    $query = $db->prepare(
        "INSERT INTO products(name, price, weight, discount, stock, description) 
        VALUES(:name, :price, :weight, :discount, :stock, :description)");
    if ($query->execute($params)) {
        exit(header('Location:/php-beginner/products'));
    } else {
        echo "terjadi kesalahan pada server";
    }
}

 ?>