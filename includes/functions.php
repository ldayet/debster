<?php

include("config.php");
session_start() ;
$id = get_session_id();
$mysqli  = bdd_connexion() ;


function get_session_id(){
  if(isset($_SESSION['user'])) {
    return $_SESSION['user']['id_m'];
  }
}

# Permet de recuperer l'id avec le pseudo
function id_m_avec_pseudo_m($pseudo)
{
  $bdd = bdd_connexion();
	if(pseudo_dans_bdd($pseudo) == false)
	{
		return false;
	}
	$requete = mysqli_query($bdd, "SELECT * FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['pseudo_m'] == $pseudo)
       {
       		return $donnees['id_m'];
       }
    }
    mysqli_close($bdd);
}

# Permet de recuperer le pseudo avec l'id
function pseudo_m_avec_id_m($id)
{
  $bdd = bdd_connexion();
	$requete = mysqli_query($bdd, "SELECT * FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)
       {
       		return $donnees['pseudo_m'];
       }
    }
    mysqli_close($bdd);
}

# Permet de recuperer l'image avec l'id
function image_m_avec_id_m($id)
{
  $bdd = bdd_connexion();
  $requete = mysqli_query($bdd, "SELECT * FROM membres");
  while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)
       {
          return $donnees['image_m'];
       }
    }
    mysqli_close($bdd);
}

# Permet de recuperer le nom avec l'id
function nom_m_avec_id_m($id)
{
  $bdd = bdd_connexion();
	$requete = mysqli_query($bdd, "SELECT * FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)
       {
       		return ucfirst($donnees['nom_m']);
       }
    }
    mysqli_close($bdd);
}

# Permet de recuperer le prenom avec l'id
function prenom_m_avec_id_m($id)

{
  $bdd = bdd_connexion();
	$requete = mysqli_query($bdd, "SELECT * FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)
       {
       		return ucfirst($donnees['prenom_m']);
       }
    }
    mysqli_close($bdd);
}
function fullname_id($id){
  
  return nom_m_avec_id_m($id)." ".prenom_m_avec_id_m($id);
  
}

# Permet de recuperer le mail avec l'id
function mail_m_avec_id_m($id)
{
  $bdd = bdd_connexion();
	$requete = mysqli_query($bdd, "SELECT * FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)
       {
       		return $donnees['email_m'];
       }
    }
    mysqli_close($bdd);
}

# Permet de recuperer le mdp avec l'id
function mdp_m_avec_id_m($id)
{
  $bdd = bdd_connexion();
	$requete = mysqli_query($bdd, "SELECT * FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)
       {
       		return $donnees['mdp_m'];
       }
    }
    mysqli_close($bdd);
}

function liste_amis1($id, $i)
{
  $bdd = bdd_connexion();
  $requete = mysqli_query($bdd, "SELECT * FROM membres");
  while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)
       {
          #on recupere la chaine de charactere de la colonne "amis"
          $char_amis = $donnees['amis_m'];
       }
    }
    #on convertie cette chaine de caractère en tableau
    $tab_amis = explode("|", $char_amis);
    mysqli_close($bdd);
    return $tab_amis[$i];
}

function nb_amis($id)
{
  $bdd = bdd_connexion();
  $requete = mysqli_query($bdd, "SELECT * FROM membres");
  while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)

       {
         
          #on recupere la chaine de charactere de la colonne "amis"
          $char_amis = $donnees['amis_m'];
       }
    }
    
    #on convertie cette chaine de caractère en tableau
    $tab_amis = explode("|", $char_amis);
    mysqli_close($bdd);
    return sizeof($tab_amis);
}

#une fonction qui me permet d'ajouter un ami (mail ou pseudo ou id)
function ajouter_ami($id_moi, $info_ami){
  $bdd = bdd_connexion();
  $requete = mysqli_query($bdd, "SELECT * FROM membres");
  # on recupere l'id de l'ami a ajouter selon le pseudo ou le mail
  while ($donnees = mysqli_fetch_assoc($requete))
  {
    #on regarde si on ajoute avec le pseudo et on récupère l'id
    if  ($donnees['pseudo_m'] == $info_ami)
    {   
      $info_ami = $donnees['id_m'];
    }
    #on regarde si on ajoute par mail et on recupere l'id
    if  ($donnees['email_m'] == $info_ami)
    {   
      $info_ami = $donnees['id_m'];
    } 
      # on recupere notre liste d'ami
     if  ($donnees['id_m'] == $id_moi)
     {
      #on recupere la chaine de charactere de la colonne "amis"
      $char_amis = $donnees['amis_m'];
     }
  }
  
  $tab_amis = explode("|", $char_amis);
  $i = 0;
  while ($i<sizeof($tab_amis))
  {
    if($tab_amis[$i] == $info_ami){
      echo "vous avez deja cette personne en amis";
      $i = $i+1;
      mysqli_close($bdd);
      return 0;
    }
    $i = $i+1;
  }
  $req = "UPDATE `membres` SET `amis_m` = '$char_amis|$info_ami' WHERE `membres`.`id_m` = $id_moi";
  mysqli_query($bdd, $req);
  mysqli_close($bdd);
  return 1;
}

#une fonction qui me permet de supprimer un ami (pseudo, mail ou id)
function supprimer_ami( $id_moi, $info_ami){
  $bdd = bdd_connexion();
  $requete = mysqli_query($bdd, "SELECT * FROM membres");
  # on recupere l'id de l'ami a ajouter selon le pseudo ou le mail
  while ($donnees = mysqli_fetch_assoc($requete))
  {
    #on regarde si on ajoute avec le pseudo et on récupère l'id
    if  ($donnees['pseudo_m'] == $info_ami)
    {   
      $info_ami = $donnees['id_m'];
    }
    #on regarde si on ajoute par mail et on recupere l'id
    if  ($donnees['email_m'] == $info_ami)
    {   
      $info_ami = $donnees['id_m'];
    } 
    # on recupere notre liste d'ami
    if  ($donnees['id_m'] == $id_moi)
    {
      #on recupere la chaine de charactere de la colonne "amis"
      $char_amis = $donnees['amis_m'];
    }
  }
  $tab_amis = explode("|", $char_amis);
  $i = 0;
  while ($i<sizeof($tab_amis))
  {
    if($tab_amis[$i] == $info_ami){
      $tab_amis[$i] = 0;
      unset($tab_amis[$i]);
      $i = $i+1;
      mysqli_close($bdd);
      return 0;
    }
    $req = "UPDATE `membres` SET `amis_m` = '|$tab_amis[$i]' WHERE `membres`.`id_m` = $id_moi";
  mysqli_query($bdd, $req);
    $i = $i+1;
  }
  mysqli_close($bdd);
  return 1;
}

#une fonction qui calcule ce que je dois a un ami hors groupe
function dette_ami($idmoi, $idami)
{
  $bdd = bdd_connexion();
  $requete = mysqli_query($bdd, "SELECT * FROM transactions");
  $dette = 0;
  while ($donnees = mysqli_fetch_assoc($requete))
  {
    if  ($donnees['id_src'] == $idmoi && $donnees['id_dest'] == $idami && $donnees['statut_t'] == 'ouvert' && $donnees['id_groupe'] == NULL)
    {
      $dette = $dette + $donnees['montant_t'];
    }
  }
  mysqli_close($bdd);
  return $dette;
}

#une fonction qui calcule mes dettes
function dette_moi($bdd, $idmoi)
{
  $requete = mysqli_query($bdd, "SELECT * FROM transactions");
  $dette = 0;
  while ($donnees = mysqli_fetch_assoc($requete))
  {
    if  ($donnees['id_src'] == $idmoi && $donnees['statut_t'] == 'ouvert')
    {
      $dette = $dette + $donnees['montant_t'];
    }
  }
  return $dette;
}

#une fonction qui calcule ce que cet ami me doit hors groupe
function creance_ami($idmoi, $idami)
{
  $bdd = bdd_connexion();
  $requete = mysqli_query($bdd, "SELECT * FROM transactions");
  $creance = 0;
  while ($donnees = mysqli_fetch_assoc($requete))
  {
    if  ($donnees['id_src'] == $idami && $donnees['id_dest'] == $idmoi && $donnees['statut_t'] == 'ouvert' && $donnees['id_groupe'] == NULL)
    {
      $creance = $creance + $donnees['montant_t'];
    }
  }
  mysqli_close($bdd);
  return $creance;
}

#une fonction qui calcule mes creances
function creance_moi($bdd, $idmoi)
{
  $requete = mysqli_query($bdd, "SELECT * FROM transactions");
  $creance = 0;
  while ($donnees = mysqli_fetch_assoc($requete))
  {
    if  ($donnees['id_dest'] == $idmoi && $donnees['statut_t'] == 'ouvert')
    {
      $creance = $creance + $donnees['montant_t'];
    }
  }
  return $creance;
}

#une fonction qui calcule la balance entre les deux hors groupe
function balance_ami($id1, $id2){

  $dette = dette_ami($id1, $id2);
  $creance = creance_ami($id1, $id2);
  $balance = $creance - $dette;

  return $balance;
}

#une fonction pour ajouter une transaction hors groupe
function ajout_transaction($id_src, $id_dest, $montant, $description){
  $bdd = bdd_connexion();
  $date =  date("Y-m-d");
  $requete = "INSERT INTO `transactions` VALUES (NULL,'$date','$id_src','$montant',NULL,'$id_dest','ouvert','$description','0000-00-00','')";
  mysqli_query($bdd,$requete);
  mysqli_close($bdd);
}

#une fonction pour ajouter une transaction hors groupe
function ajout_membre($image, $nom, $prenom, $pseudo, $ddn, $mdp, $email){
  $bdd = bdd_connexion();
  $requete = "INSERT INTO `membres` VALUES (NULL,'$image','$nom','$prenom','$pseudo','$ddn', '$mdp','$email','')";
  mysqli_query($bdd,$requete);
  mysqli_close($bdd);
}

#une fonction qui permet de modifier le montant d'une transaction
function modif_montant($id_t, $montant){
  $bdd = bdd_connexion();
  $requete = "UPDATE `transactions` SET `montant_t` = '$montant' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd,$requete);
  mysqli_close($bdd);
}

#une fonction qui permet de modifier le destinataire d'une transaction
function modif_destinataire($id_t, $id_dest){
  $bdd = bdd_connexion();
  $requete = "UPDATE `transactions` SET `id_dest` = '$id_dest' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete);
  mysqli_close($bdd);
}

#une fonction qui permet de modifier le motif d'une transaction
function modif_motif($id_t, $motif){
  $bdd = bdd_connexion();
  $requete = "UPDATE `transactions` SET `description_t` = '$motif' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete);
  mysqli_close($bdd);
}

#une fonction pour ajouter une transaction de groupe

#une fonction pour annuler une transaction
function annuler_transaction($id_t, $motif){
  $bdd = bdd_connexion();
  $requete = "UPDATE `transactions` SET `statut_t` = 'annule' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete);
  $date = date("Y-m-d");
  $requete1 = "UPDATE `transactions` SET `datef_t` = '$date' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete1);
  $requete2 = "UPDATE `transactions` SET `motif_t` = '$motif' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete2);
  mysqli_close($bdd);
}

#une fonction pour rembourser une transaction
function rembourser_transaction($id_t, $motif){
  $bdd = bdd_connexion();
  $requete = "UPDATE `transactions` SET `statut_t` = 'rembourse' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete);
  $date = date("Y-m-d");
  $requete1 = "UPDATE `transactions` SET `datef_t` = '$date' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete1);
  $requete2 = "UPDATE `transactions` SET `motif_t` = '$motif' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete2);
  mysqli_close($bdd);
}

# Vérifie que le pseudo est dans la base de donnée
function pseudo_dans_bdd($pseudo)
{
  $bdd = bdd_connexion();
	$requete = mysqli_query($bdd, "SELECT pseudo_m FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['pseudo_m'] == $pseudo)
       {
        mysqli_close($bdd);
       		return true;
       }
    }
    mysqli_close($bdd);
	return false;
}



# Fonction qui permet de se connecter a une base de donnnée
function bdd_connexion()
{
  $base = new mysqli(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);
  
	if ($base->connect_errno) 
	{
    	echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	return $base;
}

#escaping sql injections

function input($link,$string){

  $variable = mysqli_real_escape_string($link,$string);
  $variable = htmlspecialchars($variable);

  return $variable ;
}

#ajouter un membre 
function ajouter_membre($nom,$prenom,$pseudo,$ddn,$mdp,$email){
  $mysqli = bdd_connexion();
  $requete = $mysqli->prepare("INSERT INTO `membres`( `nom_m`, `prenom_m`, `pseudo_m`, `ddn_m` ,`mdp_m`, `email_m`) VALUES (?, ?, ?, ?,?, ?)");
  $requete->bind_param("ssssss", $nom,$prenom,$pseudo,$ddn,$mdp,$email);
  $requete->execute();
  mysqli_close($bdd);
  
  
}


# Vérifie que le mail est dans la base de donnée
function email_dans_bdd($email){
  $bdd = bdd_connexion();
	$requete = mysqli_query($bdd, "SELECT email_m FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['email_m'] == $email)
       {
        mysqli_close($bdd);
       		return true;
       }
    }
    mysqli_close($bdd);
	return false;
}

# Permet de recuperer le mot de passe avec le pseudo
function mpd_m_avec_pseudo_m($pseudo)
{
  $bdd = bdd_connexion();
	if(pseudo_dans_bdd($pseudo) == false)
	{
		return false;
	}
	$requete = mysqli_query($bdd, "SELECT * FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['pseudo_m'] == $pseudo)
       {
       		return $donnees['mdp_m'];
       }
    }
}

function get_user_by_pseudo($pseudo)
{
  $mysqli = bdd_connexion();
	if(pseudo_dans_bdd($pseudo) == false)
	{
		return "utilisateur introuvable";
	}
	$requete = mysqli_query($mysqli, "SELECT * FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['pseudo_m'] == $pseudo)
       {
       		return $donnees;
       }
    }
}

function for_logged(){
  if(!isset($_SESSION)){session_start(); }

  if(!isset($_SESSION['user'])){
      $_SESSION['flash']['warning'] = "VEUILLEZ VOUS CONNECTER" ;
      header('Location:login.php');
   }

}

function for_not_logged(){
  if(!isset($_SESSION)){ session_start();}

  if(isset($_SESSION['user'])){  
     $_SESSION['flash']['warning'] = "VOUS ETES DEJA CONNECTÉ" ;
     header('Location:dashboard.php');

  }  

}

#une fonction qui affiche la liste d'amis
function liste_amis($id)
{
  $bdd = bdd_connexion();
	$requete = mysqli_query($bdd, "SELECT * FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)
       {
       		#on recupere la chaine de charactere de la colonne "amis"
       		$char_amis = $donnees['amis_m'];
       }
    }
    #on convertie cette chaine de caractère en tableau
    $tab_amis = explode("|", $char_amis);
    $i = 0;
    echo "<table class='table table-striped'><thead><tr><th scope='col'>Nom</th><th scope='col'>Prénom</th><th scope='col'>Vous doit</th><th scope='col'>Vous lui devez</th><th scope='col'>Balance</th></tr></thead>";
    echo "<tbody>";
    while ($i<sizeof($tab_amis))
    {
    	$prenom_amis = prenom_m_avec_id_m($tab_amis[$i]);
    	$nom_amis = nom_m_avec_id_m($tab_amis[$i]);
    	echo "<tr><td>".$nom_amis."</td><td>".$prenom_amis."</td><td>".dette_ami($id, $tab_amis[$i])."</td><td>".creance_ami($id, $tab_amis[$i])."</td><td>".-balance_ami($id, $tab_amis[$i])."</td></tr>";
    	$i = $i +1;
    }
    echo "</tbody></table>";

}
 
function check_box_amis($id){
  $bdd = bdd_connexion();
	$requete = mysqli_query($bdd, "SELECT * FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)
       {
       		#on recupere la chaine de charactere de la colonne "amis"
       		$char_amis = $donnees['amis_m'];
       }
    }
#on convertie cette chaine de caractère en tableau
$tab_amis = explode("|", $char_amis);
$i = 0;
while ($i<sizeof($tab_amis))
{
    $prenom_amis = prenom_m_avec_id_m($tab_amis[$i]);
    $nom_amis = nom_m_avec_id_m($tab_amis[$i]);
    echo "<div class='custom-control custom-radio'>";
    echo "<input type='checkbox' id ='".$tab_amis[$i]."'  value='".$tab_amis[$i]."' name='friends[]' class='custom-control-input'>";
    echo "<label class='custom-control-label' for='".$tab_amis[$i]."'>".$prenom_amis." ".$nom_amis."</label>";
    echo "</div>";
    $i = $i +1;
}
}



function liste_dettes($id){
  $bdd = bdd_connexion();
  $requete = mysqli_query($bdd, "SELECT * FROM transactions WHERE ");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)
       {
       		#on recupere la chaine de charactere de la colonne "amis"
       		$char_amis = $donnees['amis_m'];
       }
    }

}

?>