
<?php 
$bdd = bdd_connexion();
$requete = mysqli_query($bdd, "SELECT * FROM transactions WHERE id_groupe = $id_g ");

?>


<div class="accordion" id="accordionExample">

<?php while ($donnees = mysqli_fetch_assoc($requete)): ?>
<?php  $dst = explode("|", $donnees['id_dest']);  ?>
  <div class="card">
    <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      <h3  class="float-left mb-0" >
        
          <?php echo $donnees['description_t']; ?>
        
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
             
        <?php if($dst[$i] != ""): ?>
             <div class="text-right">
                    <?php echo fullname_id($dst[$i]); ?> doit <?php echo $donnees['montant_t']/sizeof($dst) ?>
                    <img class='demo-avatar2' src='<?php echo image_m_avec_id_m($dst[$i]) ?>'>
                    
            </div>
            
            <?php endif; ?>
        <?php endfor ?>
        
      </div>
    </div>
  </div>

<?php endwhile; ?>

</div>
