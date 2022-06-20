
<!-- ----- début viewParentInserted -->
<?php
require ($root . '/app/view/fragment/fragmentGenealogieHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentGenealogieMenu.html';
    include $root . '/app/view/fragment/fragmentGenealogieJumbotron.php';
    ?>
    <!-- ===================================================== -->
    <?php
    if ($parent!=-1) {
     echo ("<h3>Confirmation de la création d'un lien parent/enfant</h3>");
     echo("<ul>");
     echo ("<li>id_".$parent." = ".$_GET['id_parent']. "</li>");
     echo ("<li>id_enfant = " . $_GET['id_enfant'] . "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème de création du lien</h3>");
     echo ("<li>id_parent = ".$_GET['id_parent']. "</li>");
     echo ("<li>id_enfant = " . $_GET['id_enfant'] . "</li>");
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentGenealogieFooter.html';
    ?>
    <!-- ----- fin viewParentInserted --> 


