<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>



<div class="jumbotron">
  <h1 class="display-4">Hello, <?php echo prenom_m_avec_id_m($id) ; ?>
</h1>
  <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <hr class="my-4">
  <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
  </p>
</div>

<div class="card-deck">
  <div class="card">
    
    <div class="card-body">
      <h5 class="card-title">SOLDE TOTAL</h5>
      
      <p class="card-text">On vous doit : $<?php echo creance_moi($id) ?></p>
      <p class="card-text">Vous devez : $<?php echo dette_moi($id) ?></p>
      <p class="card-text">Solde : <?php echo creance_moi($id)-dette_moi($id) ?></p>
            
      

    </div>
  </div>
  <div class="card">
  
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text"> This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>



<?php include("includes/footer.php"); ?>