<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">

    <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
    
    <div class="mdl-layout__header-row" 
   style=" color: white;
    background-color: #263238;"
>

        <span class="mdl-layout-title"><?php echo basename($_SERVER["SCRIPT_FILENAME"], '.php') ?> </span>

    </header>


<div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
    <div class="logo">
      <h1>DEBSTER</h1>
      <h6>Your favorite app</h6>
    </div>

    <?php if (isset($_SESSION['user'])) : ?>   
  <header class="demo-drawer-header">

    <img src=<?php echo $_SESSION['user']['image_m']; ?> class="demo-avatar">
    <div class="demo-avatar-dropdown">
      <span><?php echo $_SESSION['user']['nom_m']." ".$_SESSION['user']['prenom_m'] ; ?></span>
       </div>
  </header>
  <?php endif; ?>
  <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
  <?php if (isset($_SESSION['user'])) : ?> 

  <a class="mdl-navigation__link" href="dashboard.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">dashboard</i>Tableau de bord</a>
  <a class="mdl-navigation__link" href="profil.php0"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">face</i>Mon profil</a>
  <a class="mdl-navigation__link" href="dettes.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">attach_money</i>Dettes et créances</a>
  <a class="mdl-navigation__link" href="amis.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">sentiment_satisfied_alt</i>Amis</a>

  <a class="mdl-navigation__link" href="logout.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">not_interested</i>Se déconnecter</a>

  <?php else: ?>
  <a class="mdl-navigation__link" href="index.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">dashboard</i>Accueil</a>
  <a class="mdl-navigation__link" href="login.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">face</i>Se connecter</a>
  <a class="mdl-navigation__link" href="register.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">face</i>S'inscrire</a>
  <a class="mdl-navigation__link" href="contact.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">attach_money</i>Contact</a>
  <?php endif; ?>
  </nav>
</div>

<main class="mdl-layout__content mdl-color--grey-100">
<div class="mdl-grid demo-content">
<div class="container">


<?php 

      if(isset($_SESSION['flash'])){
        foreach($_SESSION['flash'] as $type => $message){
           echo"<div class='alert alert-dismissible alert-$type'> <button type='button' class='close' data-dismiss='alert'>&times;</button>$message </div>";
          
        }
        unset($_SESSION['flash']);
      }

?>





