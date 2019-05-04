
<?php 
$requete = mysqli_query($mysqli, "SELECT * FROM transactions WHERE id_groupe = $id_g ORDER BY date_t desc");

?>

<div class="jumbotron">
  <h1 class="display-3"><?php echo ucfirst($group['nom_g']); ?></h1>
  <hr class="my-4">
  <h4>DESCRIPTION: </h4>
  <p><?php echo ucfirst($group['description_g']); ?></p>
  <hr class="my-4">
  <h4>PARTICIPANTS: </h4>
  <p><?php get_group_avatars($id,$id_g); ?></p>
  <hr class="my-4">
  <a class="btn btn-success btn-lg" href="groups.php?action=supprimer&id_g=<?php echo $id_g ?>" role="button">Ajouter des participants</a>
  <a class="btn btn-danger btn-lg" href="#" role="button">Supprimer le groupe</a>
  <a class="btn btn-warning btn-lg" href="#" role="button">Ajouter des participants</a>

  </span>
</div>

<div class="accordion" id="accordionExample">

<?php while ($donnees = mysqli_fetch_assoc($requete)): ?>
<br>
<?php  $dst = array_values(array_filter(explode("|", $donnees['id_dest'])));  ?>
  <div class="card">
    <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      <h3  class="float-left mb-0" >
        
          <?php echo $donnees['description_t']; ?> (<?php echo $donnees['statut_t']; ?>)
        
         <h3 class="float-right mb-0"><?php echo $donnees['date_t']; ?></h3>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <p>
            <img class='demo-avatar2' src='<?php echo image_m_avec_id_m($donnees['id_src']) ?>'>
            <?php echo fullname_id($donnees['id_src']); ?> à payé <?php echo $donnees['montant_t'] ?>  
        </p>
      
        <?php for ($i=0; $i <sizeof($dst) ; $i++) : ?> 
             
        
             <div class="text-right">
                    <?php echo fullname_id($dst[$i]); ?> doit <?php echo $donnees['montant_t']/(1+sizeof($dst)) ?>
                    <img class='demo-avatar2' src='<?php echo image_m_avec_id_m($dst[$i]) ?>'>
                    
            </div>
            
            
        <?php endfor ?>
        
      </div>
    </div>
  </div>

<?php endwhile; ?>

</div>
