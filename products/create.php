<?php
require_once '../templates/header.php';
?>

<h3>New Product</h3>
<form action="" method="post">
<input type="text" name="name" id="" placeholder="Name">
<input type="number" name="price" id="" placeholder="Price">
<input type="number" name="weight" id="" placeholder="Weight">
<button type="submit" name="create">Submit</button>
</form>


<?php
if (isset($_POST['create'])) {
        $params = [
            ':name' => $_POST['name'],
            ':price' => $_POST['price'],
            ':weight' => $_POST['weight'],
        ];
        $query = $db->prepare("INSERT INTO products(name, price, weight) VALUES(:name, :price, :weight)");
        
        if ($query->execute($params)) {
            exit(header('Location:/fullstack-php-beginner/products'));
        } else {
            echo "terjadi kesalahan pada server";
        }
        
}

require_once '../templates/footer.php';
?>