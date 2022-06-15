<!-- ----- début viewInserted -->
<?php
require($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentCaveMenu.html';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
    ?>
    <!-- ===================================================== -->
    <?php
    var_dump($results);

    if ($results) {
      if ($results[2] == 1) {
        echo ("<h3>La nouvelle recolte a été ajouté</h3>");
      } elseif ($results[2] == 0) {
        echo ("<h3>La recolte a été mise à jour</h3>");
      }


      echo ("<ul>");
      echo ("<li>vin_id = " . $_GET['vin_id'] . "</li>");
      echo ("<li>prod_id = " . $_GET['producteur_id'] . "</li>");
      echo ("<li>quantite = " . $_GET['quantite'] . "</li>");
      echo ("</ul>");
    } else {
      echo ("<h3>Problème d'insertion de la recolte</h3>");
      echo ("id = " . $_GET['vin_id']);
    }

    echo ("</div>");
    include $root . '/app/view/fragment/fragmentCaveFooter.html';
    ?>
    <!-- ----- fin viewInserted -->