<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>
<?php $mysqli  = bdd_connexion() ;
$mon_id = $_SESSION['user']['id_m'];
$id_ami = $_GET['id_ami'];
$page_precedente = $_GET['page'];
$id_transaction = $_GET['id_t'];
$motifErr = "";?>

<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Transaction remboursée</h4>
  <p>Je confirme que cette transaction entre <?php 
  	echo prenom_m_avec_id_m($id_ami); ?> et moi a été remboursée</p>
  <p>Veuillez préciser le moyen de remboursement</p>

  <hr>
  <?php
  	if($page_precedente == 1){
    	echo "<p><a href=\"my_friend.php?id_ami=$id_ami&amp;action=1&amp;id_t=$id_transaction\"><button type=\"button\" class=\"btn btn-outline-light\">Confirmer</button></a> <a href=\"my_friend.php?id_ami=$id_ami&amp;action=2&amp;id_t=$id_transaction\"><button type=\"button\" class=\"btn btn-outline-light\">Annuler</button></a></p>";
    } else if($page_precedente == 0) {
    	echo "<p><a href=\"dettes.php?id_ami=$id_ami&amp;action=1&amp;id_t=$id_transaction\"><button type=\"button\" class=\"btn btn-outline-light\">Confirmer</button></a> <a href=\"dettes.php?id_ami=$id_ami&amp;action=2&amp;id_t=$id_transaction\"><button type=\"button\" class=\"btn btn-outline-light\">Annuler</button></a></p>";
    }
   ?>
</div>

<?php include("includes/footer.php"); ?>