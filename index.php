
<h2>
    PHP Beginner by Kodehack
</h2>

<a href="products">Data Products</a>
<form action="" method="post">
    <button type="submit" name="login">LOGIN</button>
</form>


<?php
    session_start();
    // login
    if (isset($_POST['login'])) {
        $_SESSION["login"] = true;
        $url = "php-beginner/products";
        exit(header("Location:http://$_SERVER[HTTP_HOST]/$url"));
    }

    require_once 'templates/footer.php';
?>