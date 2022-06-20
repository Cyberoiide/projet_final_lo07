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

    <!-- formulaire pour ajouter une famille -->
    <form role="form" method='get' action='router2.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='familleCreated'>
        <label for="id">nom : </label> <br>
        <input type="text" name='nom' size='75' value=''>
      </div>
      <p />
      <button class="btn btn-primary" type="submit">Go</button>
    </form>
    <p />
  </div>
  <?php include $root . '/app/view/fragment/fragmentGenealogieFooter.html'; ?>

  <!-- ----- fin viewInsert -->