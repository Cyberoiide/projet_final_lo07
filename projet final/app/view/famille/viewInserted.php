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
    if ($results) { // confirmation d'ajout de famille
      echo ("<h3>La nouvelle famille a été ajoutée </h3>");
      echo ("<ul>");
      echo ("<li>id = " . $results . "</li>");
      echo ("<li>nom = " . $_GET['nom'] . "</li>");
      echo ("</ul>");
    } else {
      echo ("<h3>Problème d'insertion de la famille</h3>");
      echo ("id = " . $_GET['nom']);
    }

    echo ("</div>");

    include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
    ?>
    <!-- ----- fin viewInserted -->