<!-- ----- début viewInserted -->
<?php
session_start();

require($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php

    include $root . '/app/view/fragment/fragmentCaveMenu.html';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.php';
    ?>
    <!-- ===================================================== -->
    <?php

    var_dump($results);

    // ici results = event_id (juste id quoi)
    if ($results) {
      echo ("<h3>Confirmation de la création d'un évènement </h3>");
      echo ("<ul>");
      echo ("<li>famille_id = " . $results[0] . "</li>");
      echo ("<li>individu_id = " . $results[1] . "</li>");
      echo ("<li>nom = " . $_GET["nom"] . "</li>");
      echo ("<li>prenom = " . $_GET["prenom"] . "</li>");
      echo ("<li>sexe = " . $_GET["sexe"] . "</li>");
      echo ("<li>pere = 0 </li>");
      echo ("<li>mere = 0 </li>");
      echo ("</ul>");
    } else {
      echo ("<h3>Problème d'insertion de l'évènement</h3>");
      echo ("id = " . $results);
    }

    echo ("</div>");

    include $root . '/app/view/fragment/fragmentCaveFooter.html';
    ?>
    <!-- ----- fin viewInserted -->