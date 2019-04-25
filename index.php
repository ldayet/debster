<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_not_logged(); ?>

<div class="jumbotron">
  <h1 class="display-4">Hello </h1>
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
  </p>
</div>

<form action="login.php">


<button type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-button--raised mdl-js-ripple-effect mdl-button--colored fixed">
    <i class="material-icons"> <a href="login.php">add</a></i>
    
</button>

</form>
<?php include("includes/footer.php"); ?>