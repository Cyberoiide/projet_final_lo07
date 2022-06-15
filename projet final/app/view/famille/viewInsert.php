<!-- ----- début viewInsert -->

<?php

session_start();

require($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentCaveMenu.html';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.php';
    ?>

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
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewInsert -->