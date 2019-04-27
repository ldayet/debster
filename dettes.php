<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>
<?php $mysqli  = bdd_connexion() ;
$mon_id = $_SESSION['user']['id_m'];?>

<div class="jumbotron">
  <h1 class="display-4">
    <center>Mes dettes et créances</center>
  </h1>
</div>


<div class="card-deck">
  <div class="card">
      <li class="list-group-item"><center>Total de mes créances : 
      <?php 
      echo creance_moi($mysqli, $mon_id);
      ?>€
      </center></li>
      <table class="table">
        <?php
        $requete = mysqli_query($mysqli, "SELECT * FROM transactions");
        while ($donnees = mysqli_fetch_assoc($requete))
        {
        ?>
          <tbody>
          <?php 
          if  ($donnees['id_dest'] == $mon_id && $donnees['statut_t'] == 'ouvert')
          {
          ?>
            <tr class="bg-success">
              <td>
                <?php 
                  echo $donnees['montant_t'];
                ?>
                €
              </td>
              <td>
                <?php 
                  echo nom_m_avec_id_m($mysqli,$donnees['id_src']);
                  echo "\n";
                  echo prenom_m_avec_id_m($mysqli,$donnees['id_src']);
                ?>
              </td>
              <td>
                <?php 
                  echo $donnees['description'];
                ?>
              </td>
              <td>
                <?php 
                  echo $donnees['date_t'];
                ?>
              </td>
              <td>
                  <a href="#"><img src="images/checked.svg" height=10%></a>
                  <a href="#"><img src="images/cancel.svg" height=10%></a>
              </td>
            </tr>
            <?php     
            }
            ?>
          </tbody>
        <?php     
        }
        ?>
      </table>
  </div>
  <div class="card">
      <li class="list-group-item"><center>Total de mes dettes : 
      <?php 
      echo dette_moi($mysqli, $mon_id);
      ?>€
      </center></li>
      <table class="table">
        <?php
        $requete = mysqli_query($mysqli, "SELECT * FROM transactions");
        while ($donnees = mysqli_fetch_assoc($requete))
        {
        ?>
          <tbody>
          <?php 
          if  ($donnees['id_src'] == $mon_id && $donnees['statut_t'] == 'ouvert')
          {
          ?>
            <tr class="bg-danger">
              <td>
                <?php 
                  echo $donnees['montant_t'];
                ?>
                €
              </td>
              <td>
                <?php 
                  echo nom_m_avec_id_m($mysqli,$donnees['id_src']);
                  echo "\n";
                  echo prenom_m_avec_id_m($mysqli,$donnees['id_src']);
                ?>
              </td>
              <td>
                <?php 
                  echo $donnees['description'];
                ?>
              </td>
              <td>
                <?php 
                  echo $donnees['date_t'];
                ?>
              </td>
              <td>
                  <a href="#" onclick="rembourser_transaction($mysqli, $donnees['id_t'], 'remboursé')"><img src="images/checked.svg" height=10%></a>
                  <a href="#"><img src="images/cancel.svg" height=10%></a>
              </td>
            </tr>
            <?php     
            }
            ?>
          </tbody>
        <?php     
        }
        ?>
      </table>
  </div>
</div>

<?php include("includes/footer.php"); ?>