
<!-- ----- début viewUnionInserted -->
<?php
require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentCaveMenu.html';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.php';
    ?>
    <!-- ===================================================== -->
    <?php
    if ($results) {
     echo ("<h3>Confirmation de la création d'un lien union</h3>");
     echo("<ul>");
     echo ("<li>famille_id = " . $_SESSION['famille_id'] . "</li>");
     echo ("<li>homme_id = " . $_GET['id_homme'] . "</li>");
     echo ("<li>homme_id = " . $_GET['id_femme'] . "</li>");
     /*echo ("<li>event_id = " . $results . "</li>");*/
     echo ("<li>lien_type = " . $_GET['type'] . "</li>");
     echo ("<li>lien_date = " . $_GET['date'] . "</li>");
     echo ("<li>lien_lieu = " . $_GET['lieu'] . "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème de création du lien union</h3>");
     echo ("id = " . $id);
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.html';
    ?>
    <!-- ----- fin viewUnionInserted --> 


