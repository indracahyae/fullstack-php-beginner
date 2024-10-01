<?php
require_once '../templates/header.php';
?>

<a href="/php-beginner/products/create.php">
    <button type="button">+Product</button>
</a>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Weight</th>
        <th>Discount</th>
        <th>stock</th>
        <th>Category</th>
        <th>Description</th>
        <th>Thumbnail</th>
        <th>🎮</th>
    </tr>

    <?php
    $products = $db->query("SELECT * FROM products");
    while ($product = $products->fetch(PDO::FETCH_OBJ)) {
        echo"  
            <tr>
                <td>$product->id</td>
                <td>$product->name</td>
                <td>$product->price</td>
                <td>$product->weight</td>
                <td>$product->discount</td>
                <td>$product->stock</td>
                <td>". ($product->category_fk=='' ? '-':$product->category_fk) ."</td>
                <td>$product->description</td>
                <td>$product->thumbnail</td>
                <td>
                    <a href='./detail.php?id=$product->id'>Detail</a>   
                    <a href='./edit.php?id=$product->id'>Edit</a>
                    <a onclick='return confirm(`Are you sure delete this data ?`)' href='./?delete&id=$product->id'>Delete</a>      
                </td>
            </tr>
            ";
    };
    ?>

</table>

<?php

if (isset($_GET['delete'])) {
    if ($_GET['id']) {
        $result = $db->query("DELETE FROM products WHERE id = " . $_GET['id']);
        if ($result) {
           exit( header('Location:/php-beginner/products/'));
        }
    }
}

require_once '../templates/footer.php';
?>