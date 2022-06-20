<!-- ----- début viewInsert -->

<?php

require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
        include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';
        
        
        $datas_individu = $results[0];
        ?>

        <!-- FORM START -->
        <form role="form" method='get' action='router2.php'>
            <div class="form-group">

                <!-- hidden value pour appeler la méthode evenementCreated par le routeur  -->
                <input type="hidden" name='action' value='evenementCreated'>


                <!-- selection d'un individu -->
                <label for="individu_id">Sélection d'un individu : </label>
                <select class="form-control" id='individu_id' name='individu_id' style="width: 400px">
                    <?php
                    foreach ($datas_individu as $individu) {
                        // on passe l'id de l'individu dans le value du option
                        echo ("<option value=" .  $individu['id'] . ">" .  $individu['nom'] . " : " . $individu['prenom'] . "</option>");
                    }
                    ?>
                </select>

                <br>

                <!-- selection d'un type d'event -->
                <label for="event_type">Sélection un type d'évènement : </label>
                <select class="form-control" id='"event_type' name='event_type' style="width: 400px">
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
    <?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

    <!-- ----- fin viewInsert -->