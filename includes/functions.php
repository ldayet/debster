<?php

include("config.php");

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
       		return $donnees['mail_m'];
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
    if  ($donnees['mail_m'] == $info_ami)
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
      $info_amis = $donnees['id_m'];
    }
    #on regarde si on ajoute par mail et on recupere l'id
    if  ($donnees['mail_m'] == $info_ami)
    {   
      $info_amis = $donnees['id_m'];
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
    if($tab_amis[$i] == $info_amis){
      $tab_amis[$i] = $tab_amis[sizeof($tab_amis)-1];
      unset($tab_amis[sizeof($tab_amis)-1]);
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
  $requete = "INSERT INTO `transactions` (`id_t`, `date_t`, `id_src`, `id_dest`, `montant_t`, `id_group`, `statut_t`, `description_t`) VALUES (?,?,?,?,?,?,?,?)";
  $stmt = mysqli_prepare($bdd, $requete);

  mysqli_stmt_bind_param($stmt, "ssssssss", $val1, $val2, $val3, $val4, $val5, $val6, $val7, $val8);

  $val1 = NULL;
  $date = date("Y-m-d");
  $val2 = $date;
  $val3 = $id_src;
  $val4 = $id_dest;
  $val5 = $montant;
  $val6 = NULL;
  $val7 = 'ouvert';
  $val8 = $description;
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

#une fonction pour ajouter une transaction de groupe
function ajout_transaction_groupe($bdd, $id_src, $id_dest, $montant, $id_groupe, $description){
  $requete = "INSERT INTO `transactions` (`id_t`, `date_t`, `id_src`, `id_dest`, `montant_t`, `id_group`, `statut_t`, `description_t`) VALUES (?,?,?,?,?,?,?,?)";
  $stmt = mysqli_prepare($bdd, $requete);

  mysqli_stmt_bind_param($stmt, "ssssssss", $val1, $val2, $val3, $val4, $val5, $val6, $val7, $val8);

  $val1 = NULL;
  $date = date("Y-m-d");
  $val2 = $date;
  $val3 = $id_src;
  $val4 = $id_dest;
  $val5 = $montant;
  $val6 = $id_groupe;
  $val7 = 'ouvert';
  $val8 = $description;
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}
#une fonction pour fermer une transaction
function fermer_transaction($bdd, $id_t){
  $requete = "UPDATE `transactions` SET `statut_t` = 'ferme' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete);
}

#une fonction pour annuler une transaction
function annuler_transaction($bdd, $id_t){
  $requete = "UPDATE `transactions` SET `statut_t` = 'annule' WHERE `transactions`.`id_t` = $id_t";
  mysqli_query($bdd, $requete);
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

# TEST en local
#$bdd = bdd_connexion('localhost', 'root', '','eisen');
#echo "\n";
#echo id_m_avec_pseudo_m($bdd, 'lulud33');
#echo "\n";
#echo pseudo_m_avec_id_m($bdd, 1);
#echo "\n";
#echo liste_amis($bdd, 1);
#echo "\n";
#echo dette_ami($bdd, 2, 1);
#echo "\n";
#echo creance_ami($bdd, 2, 1);
#echo "\n";
#echo balance_ami($bdd, 2, 1);
#ajout_transaction($bdd, 2, 1, 10, NULL, "resto");
#echo ajouter_ami($bdd,2,'lulud33');
#echo supprimer_ami($bdd,2,'mimolie');



function input($link,$string){

  $variable = mysqli_real_escape_string($link,$string);
  $variable = htmlspecialchars($variable);

  return $variable ;
}

function ajouter_membre($mysqli,$nom,$prenom,$pseudo,$email,$age,$mdp){

  $requete = $mysqli->prepare("INSERT INTO `membres`( `nom_m`, `prenom_m`, `pseudo_m`, `ddn_m` ,`mdp_m`, `email_m`) VALUES (?, ?, ?, ?,?, ?)");
  $requete->bind_param("ssssss", $nom,$prenom,$pseudo,$ddn,$mdp,$email);
  $requete->execute();
  
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
?>