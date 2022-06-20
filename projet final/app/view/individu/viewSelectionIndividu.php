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
        // // var_dump($results);

        $datas_individu = $results[0];
        // var_dump($datas_individu);
        ?>


        <!-- FORM START -->
        <form role="form" method='get' action='router2.php'>
            <div class="form-group">

                <!-- hidden value pour appeler la méthode lienParentCreated par le routeur  -->
                <input type="hidden" name='action' value='individuAffichage'>


                <!-- selection d'un individu -->
                <label for="individu_id">Sélection d'un individu : </label>
                <select class="form-control" id='individu_id' name='individu_id' style="width: 200px">
                    <?php

                    foreach ($datas_individu as $individu) {
                        // on passe l'id de l'individu sélectionné dans le value de option
                        echo ("<option value=" .  $individu['id'] . ">" .  $individu['nom'] . " : " . $individu['prenom'] . "</option>");
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