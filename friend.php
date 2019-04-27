<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>

<div class="jumbotron">
  <h1 class="display-4"><center>Ma liste d'amis</center></h1>
</div>

<!-- Three Line List with secondary info and action -->
<style>
.demo-list-three {
  width: 650px;
}

</style>

<?php $mysqli  = bdd_connexion() ;?>



<table width=100% class="mdl-data-table mdl-js-data-table">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric"></th>
      <th class="mdl-data-table__cell--non-numeric">Nom</th>
      <th class="mdl-data-table__cell--non-numeric">Prénom</th>
      <th class="mdl-data-table__cell--non-numeric">Balance</th>
      <th class="mdl-data-table__cell--non-numeric"></th>
    </tr>
  </thead>
  <tbody>
  	  <?php 
  	  $mon_id = $_SESSION['user']['id_m'];
      $nb_amis = nb_amis($mysqli,$mon_id);
      $j=1;
      while($j<$nb_amis){
		  $id = liste_amis1($mysqli,$mon_id,$j); ?>
    	  <tr>
		  <td class="mdl-data-table__cell--non-numeric">
		  	
		  	<?php 
		  	echo "<a href=\"my_friend.php?id_ami=$id\">";
		  	$image = image_m_avec_id_m($mysqli, $id);
		  	echo "<img src=$image class='demo-avatar'>"; 
		  	echo "</a>";?>
		  	
		  </td>
		  <td class="mdl-data-table__cell--non-numeric">
		  	<?php 
		  	echo "<a href=\"my_friend.php?id_ami=$id\">";
		  	echo nom_m_avec_id_m($mysqli, $id); 
		  	echo "</a>";?>
		  </td>
		  <td class="mdl-data-table__cell--non-numeric">
		  	<?php 
		  	echo "<a href=\"my_friend.php?id_ami=$id\">";
		  	echo prenom_m_avec_id_m($mysqli, $id); 
		  	echo "</a>";?>
		  </td>
		  <td class="mdl-data-table__cell--non-numeric">
		  	<?php echo balance_ami($mysqli, $mon_id, $id);
		  	echo "\n";
		  	$balance = balance_ami($mysqli, $mon_id, $id);
		  	if ($balance==0){
		  		echo '<img src="images/equal.svg" height=60% />';
		  	}
		  	if ($balance>0){
		  		echo '<img src="images/upload.svg" height=60% />';
		  	}
		  	if ($balance<0){
		  		echo '<img src="images/download.svg" height=60% />';
		  	}?>
		  </td>
		  <td class="mdl-data-table__cell--non-numeric">      	
		  	<a href="#" onclick="supprimer_ami($mysqli, $mon_id, $id);"><img src="images/delete-button.svg" height=60%></a>
		  <?php $j=$j+1;?>
      </td>
  	  <?php } ?>
    </tr>
  </tbody>
</table>


<?php include("includes/footer.php"); ?>