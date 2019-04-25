<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>




<div class="jumbotron">
  <h1 class="display-4">Hello, <?php echo $_SESSION['user']['prenom_m'] ; ?>
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
      <h5 class="card-title">Card title</h5>

  
            <form action="#">
                <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" type="email" id="username"/>
                    <label class="mdl-textfield__label" for="username">Email</label>
                </div>
                <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Log in</button>
            </form>
      

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
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>


<form action="login.php">


<button type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-button--raised mdl-js-ripple-effect mdl-button--colored fixed">
    <i class="material-icons"> <a href="login.php">add</a></i>
    
</button>

</form>
<?php include("includes/footer.php"); ?>