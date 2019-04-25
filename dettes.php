<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>






<?php 
$bdd =bdd_connexion(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);
liste_amis($bdd, $_SESSION['user']['id_m'] );
 ?>



<?php include("includes/footer.php"); ?>