<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>



<?php if(isset($_GET['id']) && id_exists($_GET['id']) && id_in_group($id,$_GET['id'])): ?>
<?php 
$id_g = $_GET['id'];
$group = groupe_avec_id_g($id_g); 
?>

<div class="jumbotron">
  <h1 class="display-3"><?php echo ucfirst($group['nom_g']); ?></h1>
  <hr class="my-4">
  <h4>DESCRIPTION: </h4>
  <p><?php echo ucfirst($group['description_g']); ?></p>
  <hr class="my-4">
  <h4>PARTICIPANTS: </h4>
  <p><?php get_group_avatars($id,$id_g); ?></p>
  </span>
</div>







<?php else: ?>
<div class="jumbotron">
  <h1 class="display-3">Mes groupes</h1>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
</div>

<?php afficher_table_groupes($id); ?>



<?php endif; ?>

<script>
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>

<?php include("includes/footer.php"); ?>