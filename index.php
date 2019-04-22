<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); 

$link = bdd_connexion($link, $login, $mdp, $bdd);



?>

<div class="contents">

  <div class="content mdl-color--white mdl-shadow--2dp ">
      <h2>Inviter un ami</h2>
      <div class="content-main">
      <form action="add_friend.php">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input class="mdl-textfield__input" type="text" id="sample3">
          <label class="mdl-textfield__label" for="sample3">Saisir une adresse email</label>
        </div>
      </form>
      </div>

  </div>




  <div class="content mdl-color--white mdl-shadow--2dp ">
      <h2>On vous doit</h2>
      <div class="content-main">
      <h4 class="solde">$57.67</h4>
      </div>
  </div>

</div>

<div class="contents">

<div class="content mdl-color--white mdl-shadow--2dp ">
      <h2>Toutes les dépenses</h2>
      <div class="content-main">
      <ul>
      <li>
          <p>3/21/2019 | Vous avez payé 20$ </p>
        </li>
        <li>
        <p>3/21/2019 | Vous avez payé 20$ </p>
        </li>
        <li>
        <p>3/21/2019 | Vous avez payé 20$ </p>
        </li>
      </ul>
      </div>
  </div>

</div>




<button class="mdl-button mdl-js-button mdl-button--fab mdl-button--raised mdl-js-ripple-effect mdl-button--colored fixed">
    <i class="material-icons">add</i>
    
</button>


<?php include("includes/footer.php"); ?>