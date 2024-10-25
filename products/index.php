<?php
require_once '../templates/header.php';
require_once '../global.php';
?>

<form action="" method="post">
    <!-- .
        another filter here
    . -->
    <span>Filter Data</span>
    <div>
        <label>Price</label>
        <select name="price">
            <option value="ASC" <?php if(isset($_POST["cari"]) && ($_POST["price"]=='ASC')) {echo "selected";} ?> >Ascending</option>
            <option value="DESC" <?php if(isset($_POST["cari"]) && ($_POST["price"]=='DESC')) {echo "selected";} ?> >Descending</option>
        </select>
    </div>
    <input type="search" name="sk" placeholder="Search Name ..." <?php if(isset($_POST["cari"])) {echo "value={$_POST["sk"]}";} ?> >
    <button type="submit" name="cari">🔎</button>
</form>
<a href="<?="/$rootUrl/products/create.php"?>">
    <button type="button">+Product</button>
</a>

<?php
    // cek cari
    if (isset($_POST['cari']) ){
        // cek parameter pencarian dan filter
        $products = $db->query(
            "SELECT products.id, products.name as nama_produk, products.price, products.weight, products.discount, products.stock, products.description, product_categories.name as category, products.thumbnail 
            FROM products 
            INNER JOIN product_categories ON products.category_fk=product_categories.id 
            WHERE products.name LIKE '%". $_POST['sk'] ."%' ORDER BY products.price ". $_POST['price']);
    } else {
        $products = $db->query(
            "SELECT products.id, products.name as nama_produk, products.price, products.weight, products.discount, products.stock, products.description, product_categories.name as category, products.thumbnail 
            FROM products 
            INNER JOIN product_categories ON products.category_fk=product_categories.id");
    }

    echo"
        <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Weight</th>
            <th>Discount</th>
            <th>stock</th>
            <th>Description</th>
            <th>Category</th>
            <th>Thumbnail</th>
            <th>🎮</th>
        </tr>
    ";

    while ($product = $products->fetch(PDO::FETCH_OBJ)) {
        echo"  
            <tr>
                <td>$product->id</td>
                <td>$product->nama_produk</td>
                <td>$product->price</td>
                <td>$product->weight</td>
                <td>$product->discount</td>
                <td>$product->stock</td>
                <td>$product->description</td>
                <td>". ($product->category=='' ? '-':$product->category) ."</td>
                <td>". ($product->thumbnail=='' ? '-': "<img src='/$rootUrl/assets/product_thumbnail/$product->thumbnail' style='width:200px;height:auto;'>") ."</td>
                <td>
                    <a href='./detail.php?id=$product->id'>Detail</a>   
                    <a href='./edit.php?id=$product->id'>Edit</a>
                    <a onclick='return confirm(`Are you sure delete this data ?`)' href='./?delete&id=$product->id&fileName=$product->thumbnail'>Delete</a>      
                </td>
            </tr>
            ";
        };
    
    
    
?>

</table>

<?php

if (isset($_GET['delete'])) {
    if ($_GET['id']) {
        if ($db->query("DELETE FROM products WHERE id = " . $_GET['id'])) {
            // delete file
            unlink("$_SERVER[DOCUMENT_ROOT]/$rootUrl/assets/product_thumbnail/$_GET[fileName]");
           die(header("Location:/$rootUrl/products/"));
        }else{
            echo "internal server error";
        }
    }
}

require_once '../templates/footer.php';
?>