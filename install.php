<?php include("includes/config.php"); ?>
<?php

$qDb = "CREATE DATABASE IF NOT EXISTS `heisenberg`";

$qSelDb = "USE heisenberg";

$qTbgroupes = "CREATE TABLE IF NOT EXISTS `groupes` (
  `id_g` int(255) AUTO_INCREMENT NOT NULL  ,
  `nom_g` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `membres_g` text COLLATE latin1_general_ci NOT NULL,
  `description_g` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_g`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$qTbtransactions = "CREATE TABLE IF NOT EXISTS `transactions` (
  `id_t` int(255) AUTO_INCREMENT NOT NULL,
  `date_t` date NOT NULL,
  `id_src` int(255) NOT NULL,
  `montant_t` float NOT NULL,
  `id_groupe` int(255) DEFAULT NULL,
  `id_dest` int(255) NOT NULL,
  `statut_t` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `description_t` text COLLATE latin1_general_ci NOT NULL,
  `datef_t` date DEFAULT NULL,
  `motif_t` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_t`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 ";

$qTbmembres = "CREATE TABLE IF NOT EXISTS `membres` (
  `id_m` int(255) AUTO_INCREMENT NOT NULL,
  `image_m` text COLLATE latin1_general_ci NOT NULL,
  `nom_m` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `prenom_m` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `pseudo_m` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `ddn_m` date DEFAULT NULL,
  `mdp_m` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `email_m` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `amis_m` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY(`id_m`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 ";

$qInitTbgroupes1= "INSERT INTO `groupes` ( `nom_g`, `membres_g`, `description_g`) VALUES ('heisenberg', '1|2|3|4', 'voyage')";
$qInitTbgroupes2= "INSERT INTO `groupes` (`nom_g`, `membres_g`, `description_g`) VALUES ( 'lannister', '4|3|5', 'paiement de dettes')";
$qInitTbgroupes3= "INSERT INTO `groupes` (`nom_g`, `membres_g`, `description_g`) VALUES ('winterfell', '4|5', 'nourriture')";
$qInitTbtransactions1="INSERT INTO `transactions` ( `date_t`, `id_src`, `montant_t`, `id_groupe`, `id_dest`, `statut_t`, `description_t`, `datef_t`, `motif_t`) VALUES ( '2019-04-01', '1', '200', NULL, '2', 'ouvert', 'los pollos hermanos', '2019-04-01', 'NULL' )";
$qInitTbtransactions2="INSERT INTO `transactions` (`date_t`, `id_src`, `montant_t`, `id_groupe`, `id_dest`, `statut_t`, `description_t`, `datef_t`, `motif_t`) VALUES ( '2015-04-01', '3', '200', '1', '2', 'ouvert', 'monstre', '2019-04-01', 'NULL' )";
$qInitTbmembres1= "INSERT INTO `membres` ( `image_m`, `nom_m`, `prenom_m`, `pseudo_m`, `ddn_m`, `mdp_m`, `email_m`, `amis_m`) VALUES ('images/avatars/1.png', 'walter', 'walt', 'heisenberg', '666-06-6', 'mdp', 'walter.walt@enseirb.fr', '2')";
$qInitTbgmembres2= "INSERT INTO `membres` (`image_m`, `nom_m`, `prenom_m`, `pseudo_m`, `ddn_m`, `mdp_m`, `email_m`, `amis_m`) VALUES ('images/avatars/2.png', 'jesse', 'pinkman', 'jesse', '666-06-7', 'mdp', 'pinkman@enseirb.fr', '1')";
$qInitTbgmembres3= "INSERT INTO `membres` (`image_m`, `nom_m`, `prenom_m`, `pseudo_m`, `ddn_m`, `mdp_m`, `email_m`, `amis_m`) VALUES ('images/avatars/1.png', 'John', 'Snow', 'egon', '666-06-7', 'mdp', 'snow@enseirb.fr', '4|1')";
$qInitTbgmembres4= "INSERT INTO `membres` ( `image_m`, `nom_m`, `prenom_m`, `pseudo_m`, `ddn_m`, `mdp_m`, `email_m`, `amis_m`) VALUES ('images/avatars/3.png', 'Arya', 'Arya', 'Ssark', '666-06-7', 'mdp', 'arya@enseirb.fr', '1')";

echo "Connexion au serveur MySQL.";
$con = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD);

echo "Création de la bdd ";
echo "<br>";
mysqli_query($con, $qDb);
echo mysqli_info($con);
echo mysqli_error($con);

echo "Utilisation de la bdd";
echo "<br>";
mysqli_query($con, $qSelDb);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";


echo "Création de la table groupes";
echo "<br>";
mysqli_query($con, $qTbgroupes);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du groupe ...";
echo "<br>";
mysqli_query($con, $qInitTbgroupes1);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du groupe ...";
echo "<br>";
mysqli_query($con, $qInitTbgroupes2);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du groupe ...";
echo "<br>";
mysqli_query($con, $qInitTbgroupes3);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création de la table membres.";
echo "<br>";
mysqli_query($con, $qTbmembres);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du membre ...";
echo "<br>";
mysqli_query($con, $qInitTbmembres1);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du membre ..";
echo "<br>";
mysqli_query($con, $qInitTbgmembres2);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du membre ..";
echo "<br>";
mysqli_query($con, $qInitTbgmembres3);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création du membre ..";
echo "<br>";
mysqli_query($con, $qInitTbgmembres4);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création de la table transaction.";
echo "<br>";
mysqli_query($con, $qTbtransactions);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création de la transaction.";
echo "<br>";
mysqli_query($con, $qInitTbtransactions1);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";

echo "Création de la transaction..";
echo "<br>";
mysqli_query($con, $qInitTbtransactions2);
echo mysqli_info($con);
echo "<br>";
echo mysqli_error($con);
echo "<br>";



mysqli_close($con);
?>
