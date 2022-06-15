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
        $datas_event = $results[1];
    // /*     var_dump($datas_event); */
        ?>


        <!-- FORM START -->
        <form role="form" method='get' action='router2.php'>
            <div class="form-group">

                <!-- hidden value pour appeler la méthode evenementCreated par le routeur  -->
                <input type="hidden" name='action' value='evenementCreated'>


                <!-- selection d'un individu -->
                <label for="individu_id">Sélection d'un individu : </label>
                <select class="form-control" id='individu_id' name='ids' style="width: 200px">
                    <?php

                    foreach ($datas_individu as $individu) {
                        // on passe 2 paramètres dans le value de option
                        echo ("<option value=" .  $individu['id'] . "|" . $individu["famille_id"] . ">" .  $individu['nom'] . " : " . $individu['prenom'] . "</option>");
                    }

                    ?>
                </select>

                <?php 
                // var_dump($_GET('ids'));
                ?>

                <br>

                <!-- selection d'un type d'event -->
                <label for="event_type">Sélection un type d'évènement : </label>
                <select class="form-control" id='"event_type' name='event_type' style="width: 200px">
                    <option value="NAISSANCE">NAISSANCE</option>
                    <option value="DECES">DECES</option>
                </select>

                <br>

                <!-- selection d'une date d'event -->
                <label for="event_date">Date ? AAAA-MM-JJ</label> <br>
                <input type="text" name='event_date' size='75' value='2022-06-15'>

                <br><br>

                <!-- selection d'une date d'event -->
                <label for="event_lieu">Lieu ?</label> <br>
                <input type="text" name='event_lieu' size='75' value='Troyes'>

            </div>
            <p />

            <!-- submit -->
            <button class="btn btn-primary" type="submit">Go</button>
        </form>
        <p />



    </div>
    <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

    <!-- ----- fin viewInsert -->