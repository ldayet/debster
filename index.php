<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_not_logged(); ?>

<div class="jumbotron">
  <h1 class="display-4">DEBSTER </h1>
  <p class="lead">DEBSTER EST UNE APPLICATION WEB DE GESTION DE DETTES ET CRÉANCES</p>
  <hr class="my-4">
  <h2>DESCRIPTION DE L'APPLICATION</h2>
  <ul>
    <li>Inscription des utilisateurs, mecanisme d’authentification.</li>
    <li>Carnet des amis.</li>
    <li>Gestion de dettes/créances avec ses amis.</li>
    <li>Gestion de groupes d’amis et ses dépenses.</li>
  </ul>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="register.php" role="button">S'inscrire</a>
  </p>
</div>


<?php include("includes/footer.php"); ?>