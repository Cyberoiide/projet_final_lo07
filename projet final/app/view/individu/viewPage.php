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

        //Nom de l'individu
        echo ("<h1 style='color:#FF0000'>" . $results['individu']['nom'] . " " . $results['individu']['prenom'] . "</h1>");


        //Naissance et déces
        printf(
            "<ul><li>Né le %s à %s</li><li>Décédé le %s à %s</li></ul>",
            $results['evenement']['NAISSANCE']['event_date'],
            $results['evenement']['NAISSANCE']['event_lieu'],
            $results['evenement']['DECES']['event_date'],
            $results['evenement']['DECES']['event_lieu']
        );

        //Parents de l'individu
        echo ("<h2>Parents</h2><ul>");

        if ($results['individu']['pere'] == 0) // si il existe pas, afficher ?
            echo ("<li>Père ?</li>");
        else
            echo ("<li>Père <a href='router2.php?action=individuAffichage&individu_id=" . $results['individu']['pere'] . "'>" . $results['individu']['pere_nom'] . " " . $results['individu']['pere_prenom'] . "</a></li>");
        if ($results['individu']['mere'] == 0) // si elle n'existe pas, afficher ?
            echo ("<li>Mère ?</li>");
        else
            echo ("<li>Mère <a href='router2.php?action=individuAffichage&individu_id=" . $results['individu']['mere'] . "'>" . $results['individu']['mere_nom'] . " " . $results['individu']['mere_prenom'] . "</a></li>");
        echo ("</ul>");


        //Union et enfants
        echo ("<h2>Unions et enfants</h2>");
        echo ("<ul>");
        foreach ($results['union'] as $element) {
            echo ("<li>Union avec <a href='router.php?action=individuAffichage&individu_id=" . $element['id'] . "'>" . $element['nom'] . " " . $element['prenom'] . "</a></li>");
            echo ("<ol>");
            foreach ($element['enfants'] as $enfant) {
                echo ("<li>Enfant <a href='router.php?action=individuAffichage&individu_id=" . $enfant['id'] . "'>" . $enfant['nom'] . " " . $enfant['prenom'] . "</a></li>");
            }
            echo ("</ol>");
            echo ("<br>");
        }
        echo ("</ul>");


        include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
        ?>
        <!-- ----- fin viewInserted -->