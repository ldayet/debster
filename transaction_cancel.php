<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>
<?php $mysqli  = bdd_connexion() ;
$mon_id = $_SESSION['user']['id_m'];
$id_ami = $_GET['id_ami'];?>

<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Transaction annulé</h4>
  <p>Je confirme vouloir annuler cette transaction entre <?php 
  	echo prenom_m_avec_id_m($id_ami); ?> et moi.</p>
  <p>Veuillez préciser le motif de l'annulation</p>

  <hr>
  <?php
    echo "<p><a href=\"my_friend.php?id_ami=$id_ami&amp;action=3\"><button type=\"button\" class=\"btn btn-outline-light\">Confirmer</button></a> <a href=\"my_friend.php?id_ami=$id_ami&amp;action=4\"><button type=\"button\" class=\"btn btn-outline-light\">Annuler</button></a></p>";
   ?>
</div>

<?php include("includes/footer.php"); ?>