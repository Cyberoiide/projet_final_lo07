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
            var_dump($results);
            echo ("<h3>Le vin a été supprimé</h3>");
            echo ("<ul>");
            echo("<li>id = " . $results->getId() . "</li>");
            echo("<li>cru = " . $results->getCru() . "</li>");
            echo("<li>annee = " . $results->getAnnee() . "</li>");
            echo("<li>degre = " . $results->getDegre() . "</li>");
            echo ("</ul>");
        } else {
            echo ("<h3>Problème d'insertion du Vin</h3>");
            echo ("id = " . $_GET['cru']);
        }

        echo ("</div>");

        include $root . '/app/view/fragment/fragmentCaveFooter.html';
        ?>
        <!-- ----- fin viewInserted -->