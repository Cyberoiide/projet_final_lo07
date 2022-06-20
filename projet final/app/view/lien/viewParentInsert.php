<!-- ----- début viewInsert -->

<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
        include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';
        ?>

        <?php
        var_dump($results);
        ?>


        <!-- FORM START -->
        <form role="form" method='get' action='router2.php'>
            <div class="form-group">

                <!-- hidden value pour appeler la méthode lienParentCreated par le routeur  -->
                <input type="hidden" name='action' value='lienParentCreated'>


                <!-- selection d'un enfant -->
                <label for="individu_id">Sélection d'un enfant : </label>
                <select class="form-control" id='individu_id' name='id_enfant' style="width: 400px">
                    <?php

                    foreach ($results as $enfant) {
                        // on passe 2 paramètres dans le value de option
                        echo ("<option value=" .  $enfant['id'] . ">" .  $enfant['nom'] . " : " . $enfant['prenom'] . "</option>");
                    }

                    ?>
                </select>

                <br>

                <!-- selection d'un parent -->
                <label for="individu_id">Sélection d'un parent : </label>
                <select class="form-control" id='individu_id' name='id_parent' style="width: 400px">
                    <?php
                    foreach ($results as $parent) {
                        // on passe 2 paramètres dans le value de option
                        echo ("<option value=" .  $parent['id'] . ">" .  $parent['nom'] . " : " . $parent['prenom'] . "</option>");
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
    <?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

    <!-- ----- fin viewInsert -->