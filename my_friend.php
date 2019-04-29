<?php include("includes/header.php"); ?>

<?php include("includes/navbar.php"); ?>

<?php for_logged(); ?>

<?php 
$mon_id = get_session_id();
$id_ami = $_GET['id_ami'];
if (isset($_GET['action'])){
  $action = $_GET['action'];

  if (isset($_GET['id_t'])){
    $id_t = $_GET['id_t'];


  }
}
?>

<div class="jumbotron">
  <h1 class="display-4">
    <center>
    <?php 
    $image = image_m_avec_id_m($id_ami);
    echo "<img src=$image class='demo-avatar'>";
    echo "\n";
    echo prenom_m_avec_id_m($id_ami);
    echo "\n";
    echo nom_m_avec_id_m($id_ami); 
    ?>
    </center>
  </h1>
</div>

<div class="card-deck">
  <div class="card">
      <li class="list-group-item"><center>Total des créances : 
      <?php 
      echo creance_ami($mon_id, $id_ami);
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
          if  ($donnees['id_src'] == $id_ami && $donnees['id_dest'] == $mon_id && $donnees['statut_t'] == 'ouvert' && $donnees['id_groupe'] == NULL)
          {
          ?>
            <tr class="bg-success">
              <td>
                <?php 
                  $id_transaction = $donnees['id_t'];
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
                echo "<a href=\"transaction_ok.php?id_ami=$id_ami&amp;page=1&amp;id_t=$id_transaction\">";
                echo '<img src="images/checked.svg" height=10%></a>';
                echo "</a>";
                echo "\n";
                echo "<a href=\"transaction_cancel.php?id_ami=$id_ami&amp;page=1&amp;id_t=$id_transaction\">";
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
      <li class="list-group-item"><center>Total des dettes : 
      <?php 
      echo dette_ami($mon_id, $id_ami);
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
          if  ($donnees['id_src'] == $mon_id && $donnees['id_dest'] == $id_ami && $donnees['statut_t'] == 'ouvert' && $donnees['id_groupe'] == NULL)
          {
          ?>
            <tr class="bg-danger">
              <td>
                <?php 
                  $id_transaction = $donnees['id_t'];
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
                echo "<a href=\"transaction_ok.php?id_ami=$id_ami&amp;page=1&amp;id_t=$id_transaction\">";
                echo '<img src="images/checked.svg" height=10%></a>';
                echo "</a>";
                echo "\n";
                echo "<a href=\"transaction_cancel.php?id_ami=$id_ami&amp;page=1&amp;id_t=$id_transaction\">";
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