<?php
require_once '../templates/header.php';

// GET DATA CATEGORIES
$categories = $db->query("SELECT * FROM product_categories ");
?>

<h3>New Product</h3>
<form enctype="multipart/form-data" action="" method="post">


    <input type="text" name="name" id="" placeholder="Name"> <br>
    <input type="number" name="price" id="" placeholder="Price (Rp)"> <br>
    <input type="number" name="weight" id="" placeholder="Weight (gr)"> <br>
    <input type="number" name="discount" id="" placeholder="Discount (%)"> <br>
    <input type="number" name="stock" id="" placeholder="Stock (pcs)"> <br>
    <textarea name="description" id="" rows="7" placeholder="Description"></textarea> <br>
    <span>Category</span>
     <select name="category_fk" id="">
        <?php 
            while ($category = $categories->fetch(PDO::FETCH_OBJ)){
                echo "
                    <option value='$category->id'>$category->name</option>
                ";
            }
        ?>
    </select> <br>
     <span>Thumbnail</span>
     <input type="file" name="thumbnail" id="" placeholder="Thumbnail" ><br><br>
    <button type="submit" name="create">Submit</button>
</form>


<?php
if (isset($_POST['create'])) {
        // validasi form here

        $params = [
            ':name' => $_POST['name'],
            ':price' => $_POST['price'],
            ':weight' => $_POST['weight'],
            ':discount' => $_POST['discount'],
            ':stock' => $_POST['stock'],
            ':description' => $_POST['description'],
            ':category' => $_POST['category_fk'],
            ':thumbnail' => $_FILES['thumbnail']['name'],
        ];
        $query = $db->prepare("INSERT INTO products(name, price, weight, discount, stock, description, category_fk, thumbnail) VALUES(:name, :price, :weight, :discount, :stock, :description, :category, :thumbnail)");
        if ($query->execute($params)) {
            // Validasi FILE before UPLOAD (isset, image, size,)
            if (isset($_FILES['thumbnail'])) {
                // print_r($_FILES);
                // upload file to web directory
                $uploadDir = $_SERVER['DOCUMENT_ROOT'].'/php-beginner/assets/product_thumbnail/';
                $destinationFile = $uploadDir . basename($_FILES['thumbnail']['name']);
                if (!move_uploaded_file($_FILES['thumbnail']['tmp_name'], $destinationFile)) {
                    echo "terjadi kesalahan pada server saat upload file";
                }
            }        
            exit(header('Location:/php-beginner/products'));
        } else {
            echo "terjadi kesalahan pada server";
        }
}



require_once '../templates/footer.php';
?>