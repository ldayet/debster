<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>
<?php $id_ami = $_GET['id_ami']; ?>

<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Attention!</h4>
  <p>Etes vous sûr de vouloir supprimer <?php echo prenom_m_avec_id_m($id_ami); ?> de votre liste d'amis?</p>
  <hr>
  <?php
    echo "<p><a href=\"my_friend.php?id_ami=$id_ami&amp;action=5\"><button type=\"button\" class=\"btn btn-outline-light\">Confirmer</button></a> <a href=\"my_friend.php?id_ami=$id_ami&amp;action=6\"><button type=\"button\" class=\"btn btn-outline-light\">Annuler</button></a></p>";
   ?>
</div>

<?php include("includes/footer.php"); ?>
	