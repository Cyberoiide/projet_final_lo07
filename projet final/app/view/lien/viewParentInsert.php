<!-- ----- début viewInsert -->

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

        <?php
        // var_dump($results);

        $datas_individu = $results[0];
        var_dump($datas_individu);
        // /*     var_dump($datas_event); */
        ?>


        <!-- FORM START -->
        <form role="form" method='get' action='router2.php'>
            <div class="form-group">

                <!-- hidden value pour appeler la méthode lienParentCreated par le routeur  -->
                <input type="hidden" name='action' value='lienParentCreated'>


                <!-- selection d'un enfant -->
                <label for="individu_id">Sélection d'un enfant : </label>
                <select class="form-control" id='individu_id' name='ids_enfant' style="width: 400px">
                    <?php

                    foreach ($datas_individu as $enfant) {
                        // on passe 2 paramètres dans le value de option
                        echo ("<option value=" .  $enfant['id'] . "|" . $enfant["famille_id"] . ">" .  $enfant['nom'] . " : " . $enfant['prenom'] . "</option>");
                    }

                    ?>
                </select>

                <br>

                <!-- selection d'un parent -->
                <label for="individu_id">Sélection d'un parent : </label>
                <select class="form-control" id='individu_id' name='ids_parent' style="width: 400px">
                    <?php
                    foreach ($datas_individu as $parent) {
                        // on passe 2 paramètres dans le value de option
                        echo ("<option value=" .  $parent['id'] . "|" . $parent["famille_id"] . "|" . $parent['sexe'] . ">" .  $parent['nom'] . " : " . $parent['prenom'] . "</option>");
                    }
                    ?>
                </select>


                <br>
            </div>
            <p />

            <!-- submit -->
            <button class="btn btn-primary" type="submit">Go</button>
        </form>
        <p />



    </div>
    <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

    <!-- ----- fin viewInsert -->