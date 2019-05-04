<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); 
$mon_id = get_session_id();
if (isset($_GET['id_ami'])){
	$id_ami = $_GET['id_ami'];
}
if (isset($_GET['action'])){
  $action = $_GET['action'];

  if($action == 5){?>
  	<div class="alert alert-danger" role="alert">
  		<h4 class="alert-heading">Attention!</h4>
  		<p>Etes vous sûr de vouloir supprimer <?php echo prenom_m_avec_id_m($id_ami); ?> de votre liste d'amis?</p>
  		<hr>
  		<?php
    	echo "<p><a href=\"friend.php?id_ami=$id_ami&amp;action=9\"><button type=\"button\" class=\"btn btn-outline-light\">Confirmer</button></a> <a href=\"friend.php?id_ami=$id_ami&amp;action=10\"><button type=\"button\" class=\"btn btn-outline-light\">Annuler</button></a></p>";
   		?>
		</div>
<?php }

	if($action == 9){
        echo "<div class=\"alert alert-success\" role=\"alert\">";
          echo "<h4 class=\"alert-heading\">Amis supprimé</h4>";
          supprimer_amis($mon_id, $id_ami);
        echo "</div>";
	 }

	if($action == 10){
        echo "<div class=\"alert alert-danger\" role=\"alert\">";
          echo "<h4 class=\"alert-heading\">Amis non supprimé</h4>";
        echo "</div>";
	 }

} ?>

<div class="jumbotron">
  <h1 class="display-4"><center>Ma liste d'amis</center></h1>
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
	<?php $amis = liste_amis($id); ?>

	<?php var_dump($amis); ?>

  <?php for ($i=0; $i <sizeof($amis) ; $i++): ?>

	<?php $ami = $amis[$i]; ?>

    	  <tr>

		  <td class="mdl-data-table__cell--non-numeric">
				  	
		  	<img src="<?php echo image_m_avec_id_m($ami); ?>" class='demo-avatar'>
		  	
		  </td>

		  <td class="mdl-data-table__cell--non-numeric">
		  	
		  	
		  	<?php echo nom_m_avec_id_m($ami); ?>
		  	
		  </td>
		  <td class="mdl-data-table__cell--non-numeric">
		  	
		  	
		  	<?php echo prenom_m_avec_id_m($ami); ?>
		  	
		  </td>


		  <td class="mdl-data-table__cell--non-numeric">
		  	<?php echo balance_ami($id, $ami);
		  	echo "\n";
		  	$balance = balance_ami($id, $ami);
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
		  	echo "<a href=\"friend.php?id_ami=$id&amp;action=5\">";
		  	echo '<img src="images/delete-button.svg" height=60%></a>';
		  	echo "</a>";?>
		  </td>

  	  <?php endfor; ?>
    </tr>
  </tbody>
</table>


<?php include("includes/footer.php"); ?>