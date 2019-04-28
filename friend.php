<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>

<div class="jumbotron">
  <h1 class="display-3">Mes amis</h1>
</div>





<table width=100% class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
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
  	  $mon_id = $id;
      $nb_amis = nb_amis($mon_id);
      $j=0;
      while($j<$nb_amis){
		  $id = liste_amis1($mon_id,$j); ?>
    	  <tr>
		  <td class="mdl-data-table__cell--non-numeric">
		  	
		  	<?php 
		  	$image = image_m_avec_id_m($id);
		  	echo "<img src=$image class='demo-avatar'>"; ?>
		  </td>
		  <td class="mdl-data-table__cell--non-numeric">
		  	<?php echo nom_m_avec_id_m($id); ?>
		  </td>
		  <td class="mdl-data-table__cell--non-numeric">
		  	<?php echo prenom_m_avec_id_m($id); ?>
		  </td>
		  <td class="mdl-data-table__cell--non-numeric">
		  	<?php echo balance_ami($mon_id, $id);
		  	echo "\n";
		  	$balance = balance_ami($mon_id, $id);
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
		  	<?php 
		  	echo "<a href=\"delete_friend.php?id_ami=$id\">";
		  	echo '<img src="images/delete-button.svg" height=60%></a>';
		  	echo "</a>";?>
		  <?php $j=$j+1;?>
      </td>
  	  <?php } ?>
    </tr>
  </tbody>
</table>


<?php include("includes/footer.php"); ?>