<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>




<?php
$bdd = bdd_connexion(); 


$id = $_SESSION['user']['id_m'];

#check_box_groupe($bdd, $id);


?>



<form>
  <fieldset>
    <legend>Ajouter une dépense</legend>


    <div class="form-group">
      <label>Password</label>
      <input type="password" class="form-control"  placeholder="Password">
    </div>




    <button type="submit" class="btn btn-primary">Submit</button>
  </fieldset>
</form>


  
  


<?php include("includes/footer.php"); ?>