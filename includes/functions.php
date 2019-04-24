<?php

include("config.php");

# Fonction qui permet de se connecter a une base de donnnée
function bdd_connexion($link, $login, $mdp, $bdd)
{
  $base = new mysqli($link, $login, $mdp, $bdd);
  
  if ($base->connect_errno) 
  {
      echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
  }
  return $base;
}
# Connexion base en local
$bdd = bdd_connexion('localhost', 'root', '','eisen');

# Permet de recuperer l'id avec le pseudo
function id_m_avec_pseudo_m($bdd, $pseudo)
{
	if(pseudo_dans_bdd($bdd, $pseudo) == false)
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
}

# Permet de recuperer le pseudo avec l'id
function pseudo_m_avec_id_m($bdd, $id)
{
	$requete = mysqli_query($bdd, "SELECT * FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)
       {
       		return $donnees['pseudo_m'];
       }
    }
}

# Permet de recuperer l'image avec l'id
function image_m_avec_id_m($bdd, $id)
{
  $requete = mysqli_query($bdd, "SELECT * FROM membres");
  while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)
       {
          return $donnees['image_m'];
       }
    }
}

# Permet de recuperer le nom avec l'id
function nom_m_avec_id_m($bdd, $id)
{
	$requete = mysqli_query($bdd, "SELECT * FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)
       {
       		return $donnees['nom_m'];
       }
    }
}

# Permet de recuperer le prenom avec l'id
function prenom_m_avec_id_m($bdd, $id)
{
	$requete = mysqli_query($bdd, "SELECT * FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)
       {
       		return $donnees['prenom_m'];
       }
    }
}

# Permet de recuperer le mail avec l'id
function mail_m_avec_id_m($bdd, $id)
{
	$requete = mysqli_query($bdd, "SELECT * FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)
       {
       		return $donnees['email_m'];
       }
    }
}

# Permet de recuperer le mdp avec l'id
function mdp_m_avec_id_m($bdd, $id)
{
	$requete = mysqli_query($bdd, "SELECT * FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)
       {
       		return $donnees['mdp_m'];
       }
    }
}

# Permet de recuperer la date de naissance avec l'id
function ddn_m_avec_id_m($bdd, $id)
{
  $requete = mysqli_query($bdd, "SELECT * FROM membres");
  while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['id_m'] == $id)
       {
          return $donnees['ddn_m'];
       }
    }
}

#une fonction qui affiche la liste d'amis
function liste_amis($bdd, $id)
{
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
    	$prenom_amis = prenom_m_avec_id_m($bdd, $tab_amis[$i]);
    	$nom_amis = nom_m_avec_id_m($bdd, $tab_amis[$i]);
    	echo $prenom_amis;
      echo "\n";
    	echo $nom_amis;
      echo "\n";
      echo balance_ami($bdd, $id, $tab_amis[$i]);
      echo "\n";
    	#rajouter balance groupe
    	$i = $i +1;
    }
}

#une fonction qui me permet d'ajouter un ami (mail ou pseudo ou id)
function ajouter_ami($bdd, $id_moi, $info_ami){
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
      return 0;
    }
    $i = $i+1;
  }
  $req = "UPDATE `membres` SET `amis_m` = '$char_amis|$info_ami' WHERE `membres`.`id_m` = $id_moi";
  mysqli_query($bdd, $req);
  return 1;
}

#une fonction qui me permet de supprimer un ami (pseudo, mail ou id)
function supprimer_ami($bdd, $id_moi, $info_ami){
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
      return 0;
    }
    $req = "UPDATE `membres` SET `amis_m` = '|$tab_amis[$i]' WHERE `membres`.`id_m` = $id_moi";
  mysqli_query($bdd, $req);
    $i = $i+1;
  }
  return 1;
}

#une fonction qui calcule ce que je dois a un ami hors groupe
function dette_ami($bdd, $idmoi, $idami)
{
  $requete = mysqli_query($bdd, "SELECT * FROM transactions");
  $dette = 0;
  while ($donnees = mysqli_fetch_assoc($requete))
  {
    if  ($donnees['id_src'] == $idmoi && $donnees['id_dest'] == $idami && $donnees['statut_t'] == 'ouvert' && $donnees['id_group'] == NULL)
    {
      $dette = $dette + $donnees['montant_t'];
    }
  }
  return $dette;
}

#une fonction qui calcule ce que cet ami me doit hors groupe
function creance_ami($bdd, $idmoi, $idami)
{
  $requete = mysqli_query($bdd, "SELECT * FROM transactions");
  $creance = 0;
  while ($donnees = mysqli_fetch_assoc($requete))
  {
    if  ($donnees['id_src'] == $idami && $donnees['id_dest'] == $idmoi && $donnees['statut_t'] == 'ouvert' && $donnees['id_group'] == NULL)
    {
      $creance = $creance + $donnees['montant_t'];
    }
  }
  return $creance;
}

#une fonction qui calcule la balance entre les deux hors groupe
function balance_ami($bdd, $id1, $id2){
  $dette = dette_ami($bdd, $id1, $id2);
  $creance = creance_ami($bdd, $id1, $id2);
  $balance = $creance - $dette;
  return $balance;
}

#une fonction pour ajouter une transaction hors groupe
function ajout_transaction($bdd, $id_src, $id_dest, $montant, $description){
  $date =  date("Y-m-d");
  $requete = "INSERT INTO `transactions` VALUES (NULL,'$date','$id_src','$montant',NULL,'$id_dest','ouvert','$description','0000-00-00','')";
  mysqli_query($bdd,$requete);
}

#une fonction pour ajouter une transaction hors groupe
function ajout_membre($bdd, $image, $nom, $prenom, $pseudo, $ddn, $mdp, $email){
  $requete = "INSERT INTO `membres` VALUES (NULL,'$image','$nom','$prenom','$pseudo','$ddn', '$mdp','$email','')";
  mysqli_query($bdd,$requete);
}

#une fonction qui permet de modifier le montant d'une transaction
function modif_montant($bdd, $id_t, $montant){
  $requete = "UPDATE `transactions` SET `montant_t` = '$montant' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd,$requete);
}

#une fonction qui permet de modifier le destinataire d'une transaction
function modif_destinataire($bdd, $id_t, $id_dest){
  $requete = "UPDATE `transactions` SET `id_dest` = '$id_dest' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete);
}

#une fonction qui permet de modifier le motif d'une transaction
function modif_motif($bdd, $id_t, $motif){
  $requete = "UPDATE `transactions` SET `description_t` = '$motif' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete);
}

#une fonction pour ajouter une transaction de groupe

#une fonction pour annuler une transaction
function annuler_transaction($bdd, $id_t, $motif){
  $requete = "UPDATE `transactions` SET `statut_t` = 'annule' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete);
  $date = date("Y-m-d");
  $requete1 = "UPDATE `transactions` SET `datef_t` = '$date' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete1);
  $requete2 = "UPDATE `transactions` SET `motif_t` = '$motif' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete2);
}

#une fonction pour rembourser une transaction
function rembourser_transaction($bdd, $id_t, $motif){
  $requete = "UPDATE `transactions` SET `statut_t` = 'rembourse' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete);
  $date = date("Y-m-d");
  $requete1 = "UPDATE `transactions` SET `datef_t` = '$date' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete1);
  $requete2 = "UPDATE `transactions` SET `motif_t` = '$motif' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete2);
}

# Vérifie que le pseudo est dans la base de donnée
function pseudo_dans_bdd($bdd, $pseudo)
{
	$requete = mysqli_query($bdd, "SELECT pseudo_m FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['pseudo_m'] == $pseudo)
       {
       		return true;
       }
    }
	return false;
}

function input($link,$string){

  $variable = mysqli_real_escape_string($link,$string);
  $variable = htmlspecialchars($variable);

  return $variable ;
}

# Vérifie que le mail est dans la base de donnée
function email_dans_bdd($bdd, $email){

	$requete = mysqli_query($bdd, "SELECT email_m FROM membres");
	while ($donnees = mysqli_fetch_assoc($requete))
    {
       if  ($donnees['email_m'] == $email)
       {
       		return true;
       }
    }
	return false;
}

# Permet de recuperer le mot de passe avec le pseudo
function mpd_m_avec_pseudo_m($bdd, $pseudo)
{
	if(pseudo_dans_bdd($bdd, $pseudo) == false)
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

function get_user_by_pseudo($mysqli, $pseudo)
{
	if(pseudo_dans_bdd($mysqli, $pseudo) == false)
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

# Fonction qui permet d'afficher la liste des dettes par ami
function liste_dette_ami($bdd, $id_moi, $id_ami){
  $requete = mysqli_query($bdd, "SELECT * FROM transactions");
  while ($donnees = mysqli_fetch_assoc($requete))
  {
    if  ($donnees['id_src'] == $id_moi && $donnees['id_dest'] == $id_ami && $donnees['statut_t'] == 'ouvert' && $donnees['id_group'] == NULL)
    {
      echo $donnees['montant_t'];
      echo "\n";
      echo $donnees['date_t'];
      echo "\n";
      echo $donnees['motif_t'];
    }
  }
}

# Fonction qui permet d'afficher la liste des creance par ami
function liste_creance_ami($bdd, $id_moi, $id_ami){
  $requete = mysqli_query($bdd, "SELECT * FROM transactions");
  while ($donnees = mysqli_fetch_assoc($requete))
  {
    if  ($donnees['id_src'] == $id_ami && $donnees['id_dest'] == $id_moi && $donnees['statut_t'] == 'ouvert' && $donnees['id_group'] == NULL)
    {
      echo $donnees['montant_t'];
      echo "\n";
      echo $donnees['date_t'];
      echo "\n";
      echo $donnees['motif_t'];
    }
  }
}

/*# Fonction qui permet d'afficher la liste de mes dette par groupe
#ATTENTION NON TESTE
function liste_dette_groupe($bdd, $id_moi){
  $requete = mysqli_query($bdd, "SELECT * FROM transactions");
  while ($donnees = mysqli_fetch_assoc($requete))
  {
    if  ($donnees['id_src'] == $id_moi && $donnees['statut_t'] == 'ouvert' && $donnees['id_group'] != NULL)
    {
      echo $donnees['montant_t'];
      echo "\n"
      echo $donnees['date_t'];
      echo "\n"
      echo $donnees['motif_t']
      echo "\n"
      $groupe = $donnees['id_group']
      $req = "SELECT `nom_g` FROM groupes WHERE `groupes`.`id_g` = $groupe";
      $nomgroupe = mysqli_query($bdd, $req);
      echo $nomgroupe;
    }
  }
}

# Fonction qui permet d'afficher la liste de mes creances par groupe
#ATTENTION NON TESTE
function liste_creance_groupe($bdd, $id_moi){
  $requete = mysqli_query($bdd, "SELECT * FROM transactions");
  while ($donnees = mysqli_fetch_assoc($requete))
  {
    if  ($donnees['id_dest'] == $id_moi && $donnees['statut_t'] == 'ouvert' && $donnees['id_group'] != NULL)
    {
      echo $donnees['montant_t'];
      echo "\n"
      echo $donnees['date_t'];
      echo "\n"
      echo $donnees['motif_t']
      echo "\n"
      $groupe = $donnees['id_group']
      $req = "SELECT `nom_g` FROM groupes WHERE `groupes`.`id_g` = $groupe";
      $nomgroupe = mysqli_query($bdd, $req);
      echo $nomgroupe;
    }
  }
}

# Fonction qui affiche la liste des transactions par groupe
function liste_creance_groupe($bdd, $id_group){
  $requete = mysqli_query($bdd, "SELECT * FROM transactions");
  while ($donnees = mysqli_fetch_assoc($requete))
  {
    if  ($donnees['statut_t'] == 'ouvert' && $donnees['id_group'] == $id_group)
    {
      echo $donnees['montant_t'];
      echo "\n"
      echo $donnees['date_t'];
      echo "\n"
      echo $donnees['motif_t']
      echo "\n"
      $groupe = $donnees['id_group']
      $req = "SELECT `nom_g` FROM groupes WHERE `groupes`.`id_g` = $groupe";
      $nomgroupe = mysqli_query($bdd, $req);
      echo $nomgroupe;
    }
  }
}*/

# Fonction qui permet d'afficher la liste de toutes mes transactions

# Fonction pour créer un groupe
function ajout_groupe($bdd, $nom, $description){
  $requete = "INSERT INTO `groupes` VALUES (NULL,'$nom','','$description')";
  mysqli_query($bdd,$requete);
}

# Fonction pour ajouter un membre au groupe
function ajout_membre_groupe($bdd, $id_group, $info_ami){
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
  }
  $requete1 = mysqli_query($bdd, "SELECT * FROM groupes");
  while ($donnees1 = mysqli_fetch_assoc($requete1))
  {
      # on recupere notre liste d'ami
     if  ($donnees1['id_g'] == $id_group)
     {
      #on recupere la chaine de charactere de la colonne "amis"
      $char_group = $donnees1['membres_g'];
     }
  }
  $tab_group = explode("|", $char_group);
  $i = 0;
  while ($i<sizeof($tab_group))
  {
    if($tab_group[$i] == $info_ami){
      echo "cette personne fait deja partie du groupe";
      $i = $i+1;
      return 0;
    }
    $i = $i+1;
  }
  $req = "UPDATE `groupes` SET `membres_g` = '$char_amis|$info_ami' WHERE `groupes`.`id_g` = $id_group";
  mysqli_query($bdd, $req);
  return 1;
}

# Fonction pour supprimer un membre de groupe (uniquement si aucune transaction en cours)
function supprimer_membre_groupe($bdd, $id_groupe, $info_ami){
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
  }
  $requete1 = mysqli_query($bdd, "SELECT * FROM groupes");
  while ($donnees1 = mysqli_fetch_assoc($requete1))
  {
      # on recupere notre liste d'ami
     if  ($donnees1['id_g'] == $id_groupe)
     {
      #on recupere la chaine de charactere de la colonne "amis"
      $char_group = $donnees1['membres_g'];
     }
  }
  $tab_group = explode("|", $char_group);
  $i = 0;
  while ($i<sizeof($tab_group))
  {
    if($tab_group[$i] == $info_ami){
      $tab_group[$i] = 0;
      unset($tab_group[$i]);
      $i = $i+1;
      return 0;
    }
    $req = "UPDATE `groupes` SET `membres_g` = '|$tab_group[$i]' WHERE `groupes`.`id_g` = $id_groupe";
  mysqli_query($bdd, $req);
    $i = $i+1;
  }
  return 1;
}

# Fonction pour ajouter une dépense de groupe
?>