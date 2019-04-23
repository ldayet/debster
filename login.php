<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>



<div class="content">

<?php


 $mdpErr = $pseudoErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {



  
  
  $mysqli  = bdd_connexion(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE) ;
  $errors = 0;

  if (empty($_POST["pseudo"])) {
    $pseudoErr = "Champ obligatoire";
    $errors++;
  }else if(!pseudo_dans_bdd($mysqli, $_POST["pseudo"])) {
          $pseudoErr = "Sorry, this username doesn't exist.";
          $errors++;
  }else{
    $pseudo = $_POST['pseudo'];
    }

if (empty($_POST["mdp"])) {
    $mdpErr = "Champ obligatoire";
    $errors++;
} else {
    $mdp = $_POST['mdp'];
}

if ($errors == 0) {

    $mdp_t = mpd_m_avec_pseudo_m($mysqli, $pseudo);

    if ($mdp == $mdp_t) {

        $_SESSION['user'] =  get_user_by_pseudo($mysqli, $pseudo);
        
        $_SESSION['flash']['success'] = "Vous etes maintenant connecté." ;
        header('Location: index.php');
    }else{
      $_SESSION['flash']['warning'] = "Mot de passe incorrecte." ;
        header('Location: login.php');
    }
}



}
?>
<form class="form-horizontal" autocomplete="on" method="POST" action="">

  <fieldset>


    <div class="form-group">
      <label for="textArea">Pseudo</label>
      <input type="text" class="form-control <?php if($pseudoErr){echo "is-invalid";} ?>" name="pseudo" placeholder="Entrer votre pseudo">
      <?php if($pseudoErr): ?>
      <div class="invalid-feedback"><?php echo $pseudoErr ; ?></div>
      <?php endif; ?>
    </div>





    <div class="form-group">
      <label for="textArea">Mot de passe</label>
      <input type="password" class="form-control <?php if($mdpErr){echo "is-invalid";} ?>" name="mdp" placeholder="Entrer un mot de passe">
      <?php if($mdpErr): ?>
      <div class="invalid-feedback"><?php echo $mdpErr ; ?></div>
      <?php endif; ?>
    </div>


    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-dark">Effacer</button>
        <button type="submit" class="btn btn-primary">M'authentifier</button>
      </div>
    </div>


    </fieldset>
  </form>
  </div>


<?php include("includes/footer.php"); ?>
