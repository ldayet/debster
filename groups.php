<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>



<?php if(isset($_GET['id']) && id_exists($_GET['id']) && id_in_group($id,$_GET['id'])): ?>
<?php 
$id_g = $_GET['id'];
$group = groupe_avec_id_g($id_g); 

?>





        <?php include("includes/groupe_depenses.php") ?>



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