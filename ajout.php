<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>

<?php

if (isset($_POST['friends']) && isset($_POST['montant']) && isset($_POST['titre']) ) {
  $friends = $_POST['friends'];
  $montant = $_POST['montant'];
  $titre = $_POST['titre'];

  echo "Titre de la depense : ".$titre;
  echo "Titre de la depense : ".$montant;
  echo "You selected the following friends : <br>";
  foreach ($friends as $key => $value) {
    echo fullname_id($value)." <br>";
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