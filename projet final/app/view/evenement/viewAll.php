<!-- ----- début viewAll -->
<?php


require($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentCaveMenu.html';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.php';
    ?>

    <?php

    var_dump($results);

    // on affiche ici les noms des colonnes
    $cols = $results[0];
    // var_dump($cols);

    echo '<table class="table table-striped table-bordered">';
    echo '<thead>';
    // thead
    foreach ($cols as $element) {
      printf(
        "<th scope='col'>
        $element
        </th>"
      );
    }
    echo "</thead>";

    // maintenant on affiche leur contenu
    echo "<tbody>";
    $datas = $results[1];
    // var_dump($datas);

    if (isset($datas)) {
      foreach ($datas as $infos) {
        echo ("<tr>");
        foreach ($cols as $element) {
          echo ("<td>");
          echo ($infos[$element]);
          echo ("</td>");
        }
        echo ("</tr>");
      }
    }
    echo ("</table>");


    ?>

  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewAll -->