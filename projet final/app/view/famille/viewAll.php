<!-- ----- début viewAll -->
<?php
require($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';
    ?>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">nom</th>
        </tr>
      </thead>
      <tbody>
        <!-- <h3>Liste des familles</h3> -->
        <?php
        // La liste des famille est dans la variable $results 
        foreach ($results as $element) {
          printf(
            "<tr><td>%d</td><td>%s</td></tr>",
            $element->getId(),
            $element->getNom()
          );
        }
        ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

  <!-- ----- fin viewAll -->