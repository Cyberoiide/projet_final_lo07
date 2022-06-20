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

    // confirmation ajout d'un évènement
    if ($results) {   // ici results = event_id (juste id quoi)
      echo ("<h3>Confirmation de la création d'un évènement </h3>");
      echo ("<ul>");
      echo ("<li>famille_id = " . $_SESSION['famille_id'] . "</li>");
      echo ("<li>individu_id = " . $iid . "</li>");
      echo ("<li>event_id = " . $results . "</li>");
      echo ("<li>event_type = " . $_GET["event_type"] . "</li>");
      echo ("<li>event_date = " . $_GET["event_date"] . "</li>");
      echo ("<li>event_lieu = " . $_GET["event_lieu"] . "</li>");
      echo ("</ul>");
    } else {
      echo ("<h3>Problème d'insertion de l'évènement</h3>");
      echo ("id = " . $results);
    }

    echo ("</div>");

    include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
    ?>
    <!-- ----- fin viewInserted -->