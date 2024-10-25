<?php
require_once __DIR__ . '/../connection.php';
require_once '../global.php';

session_start();
if(!isset($_SESSION["login"])){
    $_SESSION["login"] = false;
}

if (!$_SESSION["login"]) {
    exit(header("Location:http://$_SERVER[HTTP_HOST]/$rootUrl"));
}
?>

<!-- menu -->
<a href="">Products</a> <br>
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
        exit(header("Location:http://$_SERVER[HTTP_HOST]/$rootUrl"));
    }


}
?>