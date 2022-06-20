<!-- ----- debut fragmentGenealogieJumbotron -->

<?php

if (isset($_SESSION["nom"])) {
  $val = "Famille " . $_SESSION["nom"];
} else {
  $val = "Pas de famille selectionée";
}
?>

<div class="jumbotron">
  <h1><?php echo($val); ?> </h1>
</div>
<p />
<!-- ----- fin fragmentGenealogieJumbotron -->