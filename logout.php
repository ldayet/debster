
<?php session_start() ; ?>
<?php

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    $_SESSION['flash']['success'] = "Vous etes maintenant déconnecté." ;
    header('Location: login.php');
}else{
    header('Location: login.php');
}


?>