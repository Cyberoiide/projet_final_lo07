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

    <form role="form" method='get' action='router2.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='producteurCreated'>
        <label for="id">nom : </label><input type="text" name='nom' size='75' value='Bosle'>
        <label for="id">prénom : </label><input type="text" name='prenom' value='Clement'>
        <label for="id">region : </label><input type="text" name='region' value='Cipete Selatan'>
      </div>
      <p />
      <button class="btn btn-primary" type="submit">Go</button>
    </form>
    <p />
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewInsert -->