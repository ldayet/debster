<?php include("includes/footer.php"); ?>

<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>

<?php

$id_t = $_GET['id_t'];
if ($_SERVER["REQUEST_METHOD"] == "POST"){

if (isset($_POST['description']) || isset($_POST['montant']) || isset($_POST['id']) ) {
  $description = $_POST['description'];
  $montant = $_POST['montant'];

    modif_montant($id_t, $montant);
    modif_destinataire($id_t, $id);
    modif_motif($id_t, $description);
  
  $_SESSION['flash']['success'] = "La transaction a bien été modifiée";
  header('Location:modif_t.php?id_t=$id_t');

}
}
if (isset($id_t)){

?>

<form method="POST" action="">
  <fieldset>
    <legend>Modifier une dépense</legend>

    	<?php
        $requete = mysqli_query($mysqli, "SELECT * FROM transactions");
        while ($donnees = mysqli_fetch_assoc($requete))
        {
        	if($donnees['id_t']==$id_t){
        ?>
              <div class="form-group" action="modif.php?id_t=$id_t">
    			<label for="description">Description</label>
        		<input type="text" class="form-control" name="description" value="<?php echo $donnees['description_t'];?>">
        		<label for="description">Montant</label>
        		<input type="number" class="form-control" name="montant" value="<?php echo $donnees['montant_t'];?>">
			    <label>Destinataire</label>
     			<?php check_box_amis($id); ?>
              </div>
              <p>
                <button type="submit" class="btn btn-primary">Modifier</button>
            <?php
        	}
    	} ?>

  </fieldset>
</form>


  
  


<?php }
include("includes/footer.php"); ?>