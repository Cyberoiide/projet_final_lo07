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
          <th scope="col">id</th>
          <th scope="col">nom</th>
          <th scope="col">prenom</th>
          <th scope="col">region</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // La liste des vins est dans une variable $results 
        // var_dump($results);
        foreach ($results as $element) {
          // print_r($val);
          // echo "<br>";
          // echo $val->getId();

          // var_dump($element);
          // echo ("<tr><td>" . $val . "</td></tr>");

          printf(
            "<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>",
            $element->getId(),
            $element->getNom(),
            $element->getPrenom(),
            $element->getRegion()
          );
        }
        ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewAll -->