<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>


<?php for_not_logged(); ?>


<?php


$nomErr = $prenomErr = $emailErr = $ddnErr = $mdpErr = $mdpcErr = $pseudoErr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {


  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $pseudo = $_POST['pseudo'];
  $email = $_POST['email'];
  $ddn = $_POST['ddn'];
  $mdp = $_POST['mdp'];
  $mdpc = $_POST['mdpc'];

  $mysqli  = bdd_connexion(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE) ;

  $errors = 0;


  if (empty($_POST["nom"])) {
    $nomErr = "Champ obligatoire";
    $errors++;
  }
  if (empty($_POST["prenom"])) {
    $prenomErr = "Champ obligatoire";
    $errors++;
  }
  if (empty($_POST["pseudo"])) {
    $pseudoErr = "Champ obligatoire";
    $errors++;
  }else if(pseudo_dans_bdd($mysqli, $pseudo)) {
          $pseudoErr = "Sorry, that username is taken. Try another";
          $errors++;
  }
  if (empty($_POST["email"])) {
    $emailErr = "Champ obligatoire";
    $errors++;
  }else if(email_dans_bdd($mysqli, $email)) {
    $emailErr = "Sorry, that email is taken. Try another";
    $errors++;
  }
  
  if (empty($_POST["ddn"])) {
    $ddnErr = "Champ obligatoire";
    $errors++;
  }
  if (empty($_POST["mdp"])) {
    $mdpErr = "Champ obligatoire";
    $errors++;
  }
  if (empty($_POST["mdpc"])) {
    $mdpcErr = "Champ obligatoire";
    $errors++;
  }else if($_POST["mdp"] != $_POST["mdpc"]) {
          $mdpcErr = "Passwords should match";
          $errors++;
  }

  if (!$errors) {

   ajouter_membre($mysqli,$nom,$prenom,$pseudo,$ddn,$mdp,$email);
   

   $_SESSION['flash']['success'] = "Vous etes maintenant connecté." ;
   $_SESSION['user'] =  get_user_by_pseudo($mysqli, $pseudo);
   header('Location: dashboard.php');

    

}





}
?>

<div class="content">  


<form class="form-horizontal" autocomplete="on" method="POST" action="">

  <fieldset>

    <div class="form-group ">
      <label for="textArea">Nom</label>
      <input type="text" class="form-control <?php if($nomErr){echo "is-invalid";} ?>" name="nom" placeholder="Entrer votre nom">
      <?php if($nomErr): ?>
      <div class="invalid-feedback"><?php echo $nomErr ; ?></div>
      <?php endif; ?>     
    </div>

    <div class="form-group">
      <label for="textArea">Prénom</label>
      <input type="text" class="form-control <?php if($prenomErr){echo "is-invalid";} ?>" name="prenom" placeholder="Entrer votre prenom">
      <?php if($prenomErr): ?>
      <div class="invalid-feedback"><?php echo $prenomErr ; ?></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="textArea">Pseudo</label>
      <input type="text" class="form-control  <?php if($pseudoErr){echo "is-invalid";} ?> " name="pseudo" placeholder="Entrer votre pseudo">
      <?php if($pseudoErr): ?>
      <div class="invalid-feedback"><?php echo $pseudoErr ; ?></div>
      <?php endif; ?>

    </div>

    <div class="form-group">
      <label for="textArea">Email</label>
      <input type="email" class="form-control <?php if($emailErr){echo "is-invalid";} ?>  " name="email" placeholder="Entrer votre email">
      <?php if($emailErr): ?>
      <div class="invalid-feedback"><?php echo $emailErr ; ?></div>
      <?php endif; ?>
    </div>

    <div class="form-group">
      <label for="textArea">Date de naissance</label><div class="valid-feedback">mois/jour/année</div>
      <input class="form-control <?php if($dnnErr){echo "is-invalid";} ?> " type="date" value="<?php echo date('Y-m-d'); ?>" id="example-date-input" name="ddn">
      <div class="valid-feedback">mois/jour/année</div>
      <?php if($ddnErr): ?>
      <div class="invalid-feedback"><?php echo $ddnErr ; ?></div>
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
      <label for="textArea">Confirmer le mot de passe</label>
      <input type="password" class="form-control <?php if($mdpcErr){echo "is-invalid";} ?>" name="mdpc" placeholder="Repeter votre mot de passe">
      <?php if($mdpcErr): ?>
      <div class="invalid-feedback"><?php echo $mdpcErr ; ?></div>
      <?php endif; ?>
    </div>


    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-dark">Effacer</button>
        <button type="submit" class="btn btn-primary">M'inscrire</button>
      </div>
    </div>


  </fieldset>

</form>

</div>

<?php include("includes/footer.php"); ?>