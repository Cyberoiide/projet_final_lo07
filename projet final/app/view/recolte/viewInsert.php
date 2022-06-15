<!-- ----- début viewInsert -->

<?php
require($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentCaveMenu.html';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
    ?>

    <?php
    $datas_vin = $results[0];
    // var_dump($datas_vin);
    $datas_prod = $results[1];
    // var_dump($datas_prod);
    ?>


    <!-- FORM START -->
    <form role="form" method='get' action='router2.php'>
      <div class="form-group">

        <input type="hidden" name='action' value='recolteCreated'>

        <!-- selection d'un vin -->
        <label for="vin_id">Sélection d'un vin : </label>
        <select class="form-control" id='vin_id' name='vin_id' style="width: 200px">
          <?php

          foreach ($datas_vin as $vins) {
            echo ("<option value=" .  $vins['id'] . ">" .  $vins['id'] . " : " . $vins['cru'] . " : " . $vins['annee'] . "</option>");
          }

          ?>
        </select>

        <br>


        <!-- selection d'un producteur -->
        <label for="producteur_id">Sélection d'un producteur : </label>
        <select class="form-control" id='"producteur_id' name='producteur_id' style="width: 200px">
          <?php
          foreach ($datas_prod as $producteurs) {
            echo ("<option value=" .  $producteurs['id'] . ">" .  $producteurs['id'] . " : " . $producteurs['nom'] . " : " . $producteurs['prenom'] . ":" . $producteurs['region'] . "</option>");
          }
          ?>
        </select>

        <br>

        <!-- selection quantité -->
        <label for="quantite">quantité : </label>        <br>
        <input type="number" name='quantite'>

      </div>
      <p />

      <!-- submit -->
      <button class="btn btn-primary" type="submit">Go</button>
    </form>
    <p />



  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewInsert -->