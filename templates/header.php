<?php
require_once __DIR__ . '/../connection.php';
// header('Content-type: text/plain');

session_start();
if(!isset($_SESSION["login"])){
    $_SESSION["login"] = false;
}

if (!$_SESSION["login"]) {
    $url = "php-beginner";
    exit(header("Location:http://$_SERVER[HTTP_HOST]/$url"));
}
?>

<!-- menu -->
<a href="/php-beginner/products">Products</a> <br>
<?php
if($_SESSION["login"]){
    echo "
        <form action='' method='post'>
            <button type='submit' name='logout'>LOGOUT</button>
        </form>
    ";

    if (isset($_POST['logout'])) {
        // $_SESSION["login"] = false;
        session_unset();
        $url = "php-beginner";
        exit(header("Location:http://$_SERVER[HTTP_HOST]/$url"));
    }


}
?>