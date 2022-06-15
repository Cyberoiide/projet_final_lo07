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
    if ($results) {
      echo ("<h3>Le nouveau producteur a été ajouté </h3>");
      echo ("<ul>");
      echo ("<li>id = " . $results . "</li>");
      echo ("<li>nom = " . $_GET['nom'] . "</li>");
      echo ("<li>prénom = " . $_GET['prenom'] . "</li>");
      echo ("<li>région = " . $_GET['region'] . "</li>");
      echo ("</ul>");
    } else {
      echo ("<h3>Problème d'insertion du Producteur</h3>");
      echo ("id = " . $_GET['cru']);
    }

    echo ("</div>");

    include $root . '/app/view/fragment/fragmentCaveFooter.html';
    ?>
    <!-- ----- fin viewInserted -->