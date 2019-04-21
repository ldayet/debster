<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>


<div class="content">  

<form>
  <fieldset>


    <div class="form-group">
      <label for="exampleInputEmail1">Prenom</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrer votre prenom">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Nom</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrer votre nom">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Pseudo</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrer votre pseudo">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Mot de passe</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Confirmer le mot de passe</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>

    <div class="form-group">
      <label for="exampleInputFile">Picture</label>
      <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
      <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
    </div>

    <button type="reset" class="btn btn-dark">Clear</button>
    <button type="submit" class="btn btn-primary">Submit</button>
  </fieldset>
</form>

</div>

<?php include("includes/footer.php"); ?>