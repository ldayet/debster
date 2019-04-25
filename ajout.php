<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>




<?php
$bdd = bdd_connexion(); 


$id = $_SESSION['user']['id_m'];




?>



<form>
  <fieldset>
    <legend>Ajouter une dépense</legend>


    <div class="form-group">
      <label>Titre</label>
      <input type="text" class="form-control"  placeholder="Titre de la dépense">
    </div>

    <div class="form-group">
    <label>Montant</label>
    <div class="form-group">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">$</span>
      </div>
      <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
        </div>
    </div>
    </div>
    <div class="form-group">
      <label>Débiteurs</label>
     <?php check_box_amis($bdd, $id); ?>
     </div>


    <button type="submit" class="btn btn-primary">Submit</button>
  </fieldset>
</form>


  
  


<?php include("includes/footer.php"); ?>