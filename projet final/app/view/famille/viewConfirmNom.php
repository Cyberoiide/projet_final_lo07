<!-- ----- début viewInserted -->
<?php


require($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
    <div class="container">
        <?php

        var_dump($results);

        $_SESSION['nom'] = $_GET['nom'];

        include $root . '/app/view/fragment/fragmentCaveMenu.html';
        include $root . '/app/view/fragment/fragmentCaveJumbotron.php';
        ?>
        <!-- ===================================================== -->
        <?php

        if ($results) {
            echo ("<h3>Confirmation de la sélection d'une famille </h3>");
            printf(
                "La famille %s (%d) est maintenant sélectionnée",
                $results[0]->getNom(),
                $results[0]->getId()
            );
        } else {
            echo ("<h3>Problème d'insertion de la famille</h3>");
            echo ("id = " . $_GET['nom']);
        }

        echo ("</div>");

        include $root . '/app/view/fragment/fragmentCaveFooter.html';
        ?>
        <!-- ----- fin viewInserted -->