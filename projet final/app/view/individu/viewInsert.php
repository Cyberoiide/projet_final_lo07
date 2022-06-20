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

        <form role="form" method='get' action='router2.php'>
            <div class="form-group">
                <input type="hidden" name='action' value='individuCreated'>
                <label for="id">nom ? </label> <br>
                <input type="text" name='nom' size='75' value='Bosle'>

                <br><br>

                <label for="id">prénom ? </label> <br>
                <input type="text" name='prenom' value='Clement'>

                <br> <br>

                <label for="id">sexe : </label> <br>

                <input type="radio" id="masculin" name="sexe" value="H">
                <label for="masculin">masculin</label>

                <input type="radio" id="feminin" name="sexe" value="F">
                <label for="feminin">feminin</label>
            </div>
            <p />
            <button class="btn btn-primary" type="submit">Go</button>
        </form>
        <p />
    </div>
    <?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

    <!-- ----- fin viewInsert -->