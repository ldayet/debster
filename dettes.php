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
      echo creance_moi($mon_id);
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
                <?php     
                echo "\n";            
                #echo "<a href=\"transaction_cancel.php?id_ami=$id_ami\">";
                echo '<img src="images/pencil.svg" height=30%></a>';
                #echo "</a>";
                ?>
              </td>
              <td>
                <?php
                  $id_transaction = $donnees['id_t'];
                  $id_ami=$donnees['id_src'];
                  echo nom_m_avec_id_m($donnees['id_src']);
                  echo "\n";
                  echo prenom_m_avec_id_m($donnees['id_src']);
                echo "\n"; 
                #echo "<a href=\"transaction_cancel.php?id_ami=$id_ami\">";
                echo '<img src="images/pencil.svg" height=30%></a>';
                #echo "</a>";
                ?>
              </td>
              <td>
                <?php 
                  echo $donnees['description_t'];
                  echo "\n"; 
                #echo "<a href=\"transaction_cancel.php?id_ami=$id_ami\">";
                echo '<img src="images/pencil.svg" height=30%></a>';
                #echo "</a>";
                ?>
              </td>
              <td>
                <?php 
                  echo $donnees['date_t'];
                  echo "\n"; 
                #echo "<a href=\"transaction_cancel.php?id_ami=$id_ami\">";
                echo '<img src="images/pencil.svg" height=30%></a>';
                #echo "</a>";
                ?>
              </td>
              <td>
                <?php
                echo "<a href=\"transaction_ok.php?id_ami=$id_ami&amp;page=0&amp;id_t=$id_transaction\">";
                echo '<img src="images/checked.svg" height=10%></a>';
                echo "</a>";
                echo "\n";
                echo "<a href=\"transaction_cancel.php?id_ami=$id_ami&amp;page=0&amp;id_t=$id_transaction\">";
                echo '<img src="images/cancel.svg" height=10%></a>';
                echo "</a>";
                ?>
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
      echo dette_moi($mon_id);
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
                <?php     
                echo "\n";            
                #echo "<a href=\"transaction_cancel.php?id_ami=$id_ami\">";
                echo '<img src="images/pencil.svg" height=30%></a>';
                #echo "</a>";
                ?>
              </td>
              <td>
                <?php 
                  $id_transaction = $donnees['id_t'];
                  $id_ami=$donnees['id_src'];
                  echo nom_m_avec_id_m($donnees['id_src']);
                  echo "\n";
                  echo prenom_m_avec_id_m($donnees['id_src']);
                  echo "\n"; 
                #echo "<a href=\"transaction_cancel.php?id_ami=$id_ami\">";
                echo '<img src="images/pencil.svg" height=30%></a>';
                #echo "</a>";
                ?>
              </td>
              <td>
                <?php 
                  echo $donnees['description_t'];
                  echo "\n"; 
                #echo "<a href=\"transaction_cancel.php?id_ami=$id_ami\">";
                echo '<img src="images/pencil.svg" height=30%></a>';
                #echo "</a>";
                ?>
              </td>
              <td>
                <?php 
                  echo $donnees['date_t'];
                  echo "\n"; 
                #echo "<a href=\"transaction_cancel.php?id_ami=$id_ami\">";
                echo '<img src="images/pencil.svg" height=30%></a>';
                #echo "</a>";
                ?>
              </td>
              <td>
                <?php
                echo "<a href=\"transaction_ok.php?id_ami=$id_ami&amp;page=0&amp;id_t=$id_transaction\">";
                echo '<img src="images/checked.svg" height=10%></a>';
                echo "</a>";
                echo "\n";
                echo "<a href=\"transaction_cancel.php?id_ami=$id_ami&amp;page=0&amp;id_t=$id_transaction\">";
                echo '<img src="images/cancel.svg" height=10%></a>';
                echo "</a>";
                ?>
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