<!-- ----- début viewId -->
<?php
session_start();
require($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentCaveMenu.html';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.php';
    var_dump($results);


    // $results contient un tableau avec la liste des clés.
    ?>

    <form role="form" method='get' action='router2.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='familleReadOne'>
        <label for="nom">Nom : </label> 
        <select class="form-control" name='nom' id='nom' style="width: 100px">
          <?php
          foreach ($results as $nom)
            printf(
              "<option>%s</option>",
              $nom
            );
          ?>
        </select>
      </div>
      <p />
      <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
    <p />
  </div>

  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewId -->