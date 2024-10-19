<?php
require_once '../templates/header.php';

$products = $db->query("SELECT * FROM products WHERE id = " . $_GET['id']);
$product = $products->fetch(PDO::FETCH_OBJ);

// GET DATA CATEGORIES
$categories = $db->query("SELECT * FROM product_categories ");
?>

<h3>Edit Product</h3>
<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product->id; ?>"> 
    <input type="hidden" name="thumbnail_" value="<?= $product->thumbnail; ?>">

    <input type="text" name="name" id="" placeholder="Name" value="<?= $product->name; ?>"> <br>
    <input type="number" name="price" id="" placeholder="Price (Rp)" value="<?= $product->price; ?>"> <br>
    <input type="number" name="weight" id="" placeholder="Weight (gr)" value="<?= $product->weight; ?>"> <br>
    <input type="number" name="discount" id="" placeholder="Discount (%)" value="<?= $product->discount; ?>"> <br>
    <input type="number" name="stock" id="" placeholder="Stock (pcs)" value="<?= $product->stock; ?>"> <br>
    <textarea name="description" id="" rows="7" placeholder="Description" ><?= $product->description; ?></textarea> <br>
    <span>Category</span>
    <select name="category_fk" id="">
    <?php 

        while ($category = $categories->fetch(PDO::FETCH_OBJ)){
            ($category->id == $product->category_fk) ? $selected_category="selected" : $selected_category = "" ;
            echo "
                <option value='$category->id' $selected_category >$category->name</option>
            ";
        } 
    ?>
    </select> <br>
    <span>Thumbnail</span>
    <input type="file" name="thumbnail" id="" placeholder="Thumbnail"><br><br>
    <button type="submit" name="update">Update</button>
</form>

<!-- update DB -->
 <?php

if (isset($_POST['update'])) {
    $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/php-beginner/assets/product_thumbnail/';

    // ? ADA GAMBAR
    if ($_FILES['thumbnail']['name'] !='') {
        // delete file
        unlink($_SERVER['DOCUMENT_ROOT'].'/php-beginner/assets/product_thumbnail/'. $_POST['thumbnail_']);

        $type = end(explode(".", $_FILES["thumbnail"]["name"]));
        $thumbnail = round(microtime(true)). "-$_POST[name]" . '.' . $type;
         // upload file to web directory
        //  $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/php-beginner/assets/product_thumbnail/'. $thumbnail;
         if (!move_uploaded_file($_FILES['thumbnail']['tmp_name'], $uploadDir .$thumbnail)) {
             echo "terjadi kesalahan pada server saat upload file";
         }
    } else {
        // ? TIDAK ADA GAMBAR
        if ($_POST['thumbnail_'] !== $_POST['name']) { //UBAH NAMA
            // rename
            $type = end(explode(".", $_POST['thumbnail_']));
            $thumbnail = round(microtime(true)). "-$_POST[name]" . '.' . $type;
            rename ($uploadDir.$_POST['thumbnail_'], $uploadDir.$thumbnail);
        } else {
            $thumbnail = $_POST['thumbnail_'];
        }
        
    }

    // SAVE TO DB
    $params = [
        ':name' => $_POST['name'],
        ':price' => $_POST['price'],
        ':weight' => $_POST['weight'],
        ':discount' => $_POST['discount'],
        ':stock' => $_POST['stock'],
        ':description' => $_POST['description'],
        ':category' => $_POST['category_fk'],
        ':thumbnail' => $thumbnail,
    ];
    $query = $db->prepare(
        "UPDATE products
        SET name=:name, price=:price, weight=:weight, discount=:discount, stock=:stock, description=:description, category_fk=:category, thumbnail=:thumbnail
        WHERE id = " . $_GET['id']);
    if ($query->execute($params)) {
        exit(header('Location:/php-beginner/products'));
    } else {
        echo "terjadi kesalahan pada server";
    }
}

 ?>