<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>
<?php $mysqli  = bdd_connexion() ;
$mon_id = $_SESSION['user']['id_m'];
$id_ami = $_GET['id_ami'];?>

<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Attention!</h4>
  <p>Etes vous sûr de vouloir supprimer <?php echo prenom_m_avec_id_m($id_ami); ?> de votre liste d'amis?</p>
  <hr>
  <p><button type="button" class="btn btn-outline-light">Oui</button> <button type="button" class="btn btn-outline-light">Non</button></p>
</div>

<?php include("includes/footer.php"); ?>
	