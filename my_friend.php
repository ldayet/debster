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

    switch ($action) {
      case 1:
        echo "<div class=\"alert alert-success\" role=\"alert\">";
          $motifr = $_POST['motifr'];
          echo "<h4 class=\"alert-heading\">Transaction remboursée par $motifr</h4>";
          rembourser_transaction($id_t, $motifr);
        echo "</div>";
        break;

      case 2:
      # annuler la demande de remboursement
        echo "<div class=\"alert alert-danger\" role=\"alert\">";
          echo "<h4 class=\"alert-heading\">Transaction non remboursée</h4>";
        echo "</div>";
        break;

      case 3:
      # annuler la transaction
        echo "<div class=\"alert alert-success\" role=\"alert\">";
          $motifa = $_POST['motifa'];
          echo "<h4 class=\"alert-heading\">Transaction annulée</h4>";
          annuler_transaction($id_t, $motifa);
        echo "</div>";
        break;

      case 4:
        # annuler la demande de remboursement
        echo "<div class=\"alert alert-danger\" role=\"alert\">";
          echo "<h4 class=\"alert-heading\">Transaction non annulée</h4>";
        echo "</div>";
        break;

      case 5:
        # supprimer amis mais normalement pas dans cette page
        supprimer_ami($mon_id, $id_ami);
        break;

      case 6:
        echo "<div class=\"alert alert-success\" role=\"alert\">";
          echo "<p>Je confirme que cette transaction entre \n"; 
          echo prenom_m_avec_id_m($id_ami);
          echo "\n et moi a été remboursée</p>";
          echo "<p>Veuillez préciser le moyen de remboursement</p>"; 
          echo "<form method=\"POST\" action=\"my_friend.php?id_ami=$id_ami&amp;action=1&amp;id_t=$id_t\">" ?>
            <div class="form-group">
              <input type="text" class="form-control" name="motifr" placeholder="Moyen de paiement">
            </div>
            <p>
              <button type="submit" class="btn btn-outline-light">Confirmer</button>
          <?php 
          echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=2&amp;id_t=$id_t\"><button type=\"button\" class=\"btn btn-outline-light\">Annuler</button></a></p>";
        echo "</form>";
        echo "</div>";
        break;

      case 7:
        echo "<div class=\"alert alert-danger\" role=\"alert\">";
          echo "<p>Je confirme vouloir annuler cette transaction entre \n";
          echo prenom_m_avec_id_m($id_ami);
          echo "\n et moi.</p>";
          echo "<p>Veuillez préciser le motif de l'annulation</p>";
          echo "<form method=\"POST\" action=\"my_friend.php?id_ami=$id_ami&amp;action=3&amp;id_t=$id_t\">" ?>
            <div class="form-group">
              <input type="text" class="form-control" name="motifa" placeholder="Motif d'annulation">
            </div>
            <p>
              <button type="submit" class="btn btn-outline-light">Confirmer</button>
          <?php 
          echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=4&amp;id_t=$id_t\"><button type=\"button\" class=\"btn btn-outline-light\">Annuler</button></a></p>";
        echo "</form>";
        echo "</div>";
        break;

      case 8:
        #modification d'une transaction
        echo "</div>";
        break;

      default:
        break;
    }

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

<?php 
  if (isset($_GET['vue'])){
    $vue = $_GET['vue'];
    if ($vue == 1){
      ?>
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
                if  ($donnees['id_src'] == $id_ami && $donnees['id_dest'] == $mon_id && $donnees['statut_t'] == 'rembourse' && $donnees['id_groupe'] == NULL)
                {
                ?>
                  <tr class="bg-success">
                    <td>
                      <?php 
                        $id_transaction = $donnees['id_t'];
                        echo $donnees['montant_t'];
                      ?>
                      €
                    </td>
                    <td>
                      <?php 
                      echo $donnees['description_t'];
                      ?>
                    </td>
                    <td>
                      <?php 
                      echo $donnees['date_t'];
                      ?>
                    </td>
                    <td>
                      <?php
                      echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=6&amp;id_t=$id_transaction\">";
                      echo '<img src="images/checked.svg" height=10%></a>';
                      echo "</a>";
                      echo "\n";
                      echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=7&amp;id_t=$id_transaction\">";
                      echo '<img src="images/cancel.svg" height=10%></a>';
                      echo "</a>";    
                      echo "\n";            
                      echo "<a href=\"modif_t.php?id_t=$id_transaction\">";
                      echo '<img src="images/pencil.svg" height=30%></a>';
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
                if  ($donnees['id_src'] == $mon_id && $donnees['id_dest'] == $id_ami && $donnees['statut_t'] == 'rembourse' && $donnees['id_groupe'] == NULL)
                {
                ?>
                  <tr class="bg-danger">
                    <td>
                      <?php 
                        $id_transaction = $donnees['id_t'];
                        echo $donnees['montant_t'];
                      ?>
                      €
                    </td>
                    <td>
                      <?php 
                      echo $donnees['description_t'];
                      ?>
                    </td>
                    <td>
                      <?php 
                      echo $donnees['date_t'];
                      ?>
                    </td>
                    <td>
                      <?php
                      echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=6&amp;id_t=$id_transaction\">";
                      echo '<img src="images/checked.svg" height=10%></a>';
                      echo "</a>";
                      echo "\n";
                      echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=7&amp;id_t=$id_transaction\">";
                      echo '<img src="images/cancel.svg" height=10%></a>';
                      echo "</a>";
                      echo "\n";            
                      echo "<a href=\"modif_t.php?id_t=$id_transaction\">";
                      echo '<img src="images/pencil.svg" height=30%></a>';
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
      <?php
      }
      if ($vue == 2){
      ?>
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
                if  ($donnees['id_src'] == $id_ami && $donnees['id_dest'] == $mon_id && $donnees['statut_t'] == 'annule' && $donnees['id_groupe'] == NULL)
                {
                ?>
                  <tr class="bg-success">
                    <td>
                      <?php 
                        $id_transaction = $donnees['id_t'];
                        echo $donnees['montant_t'];
                      ?>
                      €
                    </td>
                    <td>
                      <?php 
                      echo $donnees['description_t'];
                      ?>
                    </td>
                    <td>
                      <?php 
                      echo $donnees['date_t'];
                      ?>
                    </td>
                    <td>
                      <?php
                      echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=6&amp;id_t=$id_transaction\">";
                      echo '<img src="images/checked.svg" height=10%></a>';
                      echo "</a>";
                      echo "\n";
                      echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=7&amp;id_t=$id_transaction\">";
                      echo '<img src="images/cancel.svg" height=10%></a>';
                      echo "</a>";    
                      echo "\n";            
                      echo "<a href=\"modif_t.php?id_t=$id_transaction\">";
                      echo '<img src="images/pencil.svg" height=30%></a>';
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
                if  ($donnees['id_src'] == $mon_id && $donnees['id_dest'] == $id_ami && $donnees['statut_t'] == 'annule' && $donnees['id_groupe'] == NULL)
                {
                ?>
                  <tr class="bg-danger">
                    <td>
                      <?php 
                        $id_transaction = $donnees['id_t'];
                        echo $donnees['montant_t'];
                      ?>
                      €
                    </td>
                    <td>
                      <?php 
                      echo $donnees['description_t'];
                      ?>
                    </td>
                    <td>
                      <?php 
                      echo $donnees['date_t'];
                      ?>
                    </td>
                    <td>
                      <?php
                      echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=6&amp;id_t=$id_transaction\">";
                      echo '<img src="images/checked.svg" height=10%></a>';
                      echo "</a>";
                      echo "\n";
                      echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=7&amp;id_t=$id_transaction\">";
                      echo '<img src="images/cancel.svg" height=10%></a>';
                      echo "</a>";
                      echo "\n";            
                      echo "<a href=\"modif_t.php?id_t=$id_transaction\">";
                      echo '<img src="images/pencil.svg" height=30%></a>';
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
  <?php } 
  if ($vue == 3){
      ?>
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
                if  ($donnees['id_src'] == $id_ami && $donnees['id_dest'] == $mon_id && $donnees['id_groupe'] == NULL)
                {
                ?>
                  <tr class="bg-success">
                    <td>
                      <?php 
                        $id_transaction = $donnees['id_t'];
                        echo $donnees['montant_t'];
                      ?>
                      €
                    </td>
                    <td>
                      <?php 
                      echo $donnees['description_t'];
                      ?>
                    </td>
                    <td>
                      <?php 
                      echo $donnees['date_t'];
                      ?>
                    </td>
                    <td>
                      <?php
                      echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=6&amp;id_t=$id_transaction\">";
                      echo '<img src="images/checked.svg" height=10%></a>';
                      echo "</a>";
                      echo "\n";
                      echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=7&amp;id_t=$id_transaction\">";
                      echo '<img src="images/cancel.svg" height=10%></a>';
                      echo "</a>";    
                      echo "\n";            
                      echo "<a href=\"modif_t.php?id_t=$id_transaction\">";
                      echo '<img src="images/pencil.svg" height=30%></a>';
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
                if  ($donnees['id_src'] == $mon_id && $donnees['id_dest'] == $id_ami && $donnees['id_groupe'] == NULL)
                {
                ?>
                  <tr class="bg-danger">
                    <td>
                      <?php 
                        $id_transaction = $donnees['id_t'];
                        echo $donnees['montant_t'];
                      ?>
                      €
                    </td>
                    <td>
                      <?php 
                      echo $donnees['description_t'];
                      ?>
                    </td>
                    <td>
                      <?php 
                      echo $donnees['date_t'];
                      ?>
                    </td>
                    <td>
                      <?php
                      echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=6&amp;id_t=$id_transaction\">";
                      echo '<img src="images/checked.svg" height=10%></a>';
                      echo "</a>";
                      echo "\n";
                      echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=7&amp;id_t=$id_transaction\">";
                      echo '<img src="images/cancel.svg" height=10%></a>';
                      echo "</a>";
                      echo "\n";            
                      echo "<a href=\"modif_t.php?id_t=$id_transaction\">";
                      echo '<img src="images/pencil.svg" height=30%></a>';
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
  <?php } ?> 
  <?php } 
  else
  {?>  
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
                    </td>
                    <td>
                      <?php 
                      echo $donnees['description_t'];
                      ?>
                    </td>
                    <td>
                      <?php 
                      echo $donnees['date_t'];
                      ?>
                    </td>
                    <td>
                      <?php
                      echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=6&amp;id_t=$id_transaction\">";
                      echo '<img src="images/checked.svg" height=10%></a>';
                      echo "</a>";
                      echo "\n";
                      echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=7&amp;id_t=$id_transaction\">";
                      echo '<img src="images/cancel.svg" height=10%></a>';
                      echo "</a>";    
                      echo "\n";            
                      echo "<a href=\"modif_t.php?id_t=$id_transaction\">";
                      echo '<img src="images/pencil.svg" height=30%></a>';
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
                    </td>
                    <td>
                      <?php 
                      echo $donnees['description_t'];
                      ?>
                    </td>
                    <td>
                      <?php 
                      echo $donnees['date_t'];
                      ?>
                    </td>
                    <td>
                      <?php
                      echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=6&amp;id_t=$id_transaction\">";
                      echo '<img src="images/checked.svg" height=10%></a>';
                      echo "</a>";
                      echo "\n";
                      echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;action=7&amp;id_t=$id_transaction\">";
                      echo '<img src="images/cancel.svg" height=10%></a>';
                      echo "</a>";
                      echo "\n";            
                      echo "<a href=\"modif_t.php?id_t=$id_transaction\">";
                      echo '<img src="images/pencil.svg" height=30%></a>';
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
  <?php } ?> 


<hr>
<center>
<div class="btn-group" role="group" aria-label="Basic example">
  <?php
  echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;vue=3\">";
  echo "<button type=\"button\" class=\"btn btn-primary\">Toutes</button>";
  echo "</a>";
  echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;vue=1\">";
  echo "<button type=\"button\" class=\"btn btn-primary\">Remboursées</button>";
  echo "</a>";
  echo "<a href=\"my_friend.php?id_ami=$id_ami&amp;vue=2\">";
  echo "<button type=\"button\" class=\"btn btn-primary\">Annulées</button>";
  echo "</a>";
  echo "<a href=\"my_friend.php?id_ami=$id_ami\">";
  echo "<button type=\"button\" class=\"btn btn-primary\">Ouvertes</button>";
  echo "</a>";
  ?>
</div>
</center>

<?php include("includes/footer.php"); ?>