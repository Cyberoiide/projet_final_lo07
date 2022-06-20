<!-- ----- début viewInserted -->
<?php


require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
    <div class="container">
        <?php

        var_dump($results);

        $_SESSION['nom'] = $_GET['nom'];

        include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
        include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';
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

        include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
        ?>
        <!-- ----- fin viewInserted -->