<!-- ----- début viewInserted -->
<?php


require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
  <div class="container">
    <?php

    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';
    ?>
    <!-- ===================================================== -->
    <?php

    var_dump($results);

    // ici results = event_id (juste id quoi)
    if ($results) {
      echo ("<h3>Confirmation de la création d'un évènement </h3>");
      echo ("<ul>");
      echo ("<li>famille_id = " . $_SESSION['famille_id'] . "</li>");
      echo ("<li>individu_id = " . $results . "</li>");
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

    include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
    ?>
    <!-- ----- fin viewInserted -->