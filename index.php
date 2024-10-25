

<h2>
    Fullstack PHP Beginner
</h2>

<form action="" method="post">
    <button type="submit" name="login">LOGIN</button>
</form>

<?php
    require_once 'global.php';

    session_start();
    // login
    if (isset($_POST['login'])) {
        $_SESSION["login"] = true;
        exit(header("Location:http://$_SERVER[HTTP_HOST]/$rootUrl/products"));
    }

    require_once 'templates/footer.php';
?>