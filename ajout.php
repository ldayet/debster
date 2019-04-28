<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST"){

if (isset($_POST['friends']) && isset($_POST['montant']) && isset($_POST['titre']) ) {
  $friends = $_POST['friends'];
  $montant = $_POST['montant'];
  $titre = $_POST['titre'];


  foreach ($friends as $key => $value) {
    ajout_transaction($id, $value, $montant, $titre);
  }
  $_SESSION['flash']['success'] = "La depense a été bien ajoutée";
  header('Location:ajout.php');
}else{
  $_SESSION['flash']['warning'] = "Veuillez remplir tout les champs.";
  header('Location:ajout.php');
}


}


?>

<form method="POST" action="">
  <fieldset>
    <legend>Ajouter une dépense</legend>


    <div class="form-group">
      <label>Titre</label>
      <input type="text" class="form-control"  name="titre" placeholder="Titre de la dépense">
    </div>

    <div class="form-group">
    <label>Montant</label>
    <div class="form-group">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">$</span>
      </div>
      <input type="text" name="montant" class="form-control" >
        </div>
    </div>
    </div>
    <div class="form-group">
      <label>Débiteurs</label>
     <?php check_box_amis($id); ?>
     </div>


    <button type="submit" class="btn btn-primary">Submit</button>
  </fieldset>
</form>


  
  


<?php include("includes/footer.php"); ?>