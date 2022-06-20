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
  <p>C'est la meilleure famille de la région ....</p>
</div>
<p />
<!-- ----- fin fragmentGenealogieJumbotron -->