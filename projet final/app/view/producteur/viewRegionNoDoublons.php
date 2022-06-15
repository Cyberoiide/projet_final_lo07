<!-- ----- début viewAll -->
<?php

require($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentCaveMenu.html';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
    ?>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">Liste sans doublon des régions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // La liste des vins est dans une variable $results 
        var_dump($results);
        foreach ($results as $element) {

        //   var_dump($element);
          printf(
            "<tr><td>%s</td></tr>", $element);
        }
        ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewAll -->