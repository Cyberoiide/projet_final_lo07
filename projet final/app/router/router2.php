<!-- ----- debut Router1 -->
<?php

if (empty($_SESSION['titre']))
    session_start();
require('../controller/ControllerVin.php');
require('../controller/ControllerProducteur.php');
require('../controller/ControllerCave.php');
require('../controller/ControllerRecolte.php');
require('../controller/ControllerFamille.php');
require('../controller/ControllerEvenement.php');
require('../controller/ControllerLien.php');
require('../controller/ControllerIndividu.php');

// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur/param/output)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

// Modification du routeur pour prendre en compte l'ensemble des paramètres
$action = $param["action"];

// On supprime l'élément action de la structure
unset($param["action"]);

// Tout ce qui reste sont des arguments 
$args = $param;

// --- Liste des méthodes autorisées
switch ($action) {
  case "familleReadAll":
  case "familleCreate":
  case "familleCreated":
  case "familleReadNoms":
  case "familleReadOne":
    ControllerFamille::$action($args);
    break;

  case "evenementReadAll":
  case "evenementCreate":
  case "evenementCreated":
    ControllerEvenement::$action($args);
    break;

  case "lienReadAll":
  case "lienParentCreate":
  case "lienParentCreated":
  case "lienUnionCreate":
  case "lienUnionCreated":
    ControllerLien::$action($args);
    break;

  case "individuReadAll":
  case "individuCreate":
  case "individuCreated":
  case "individuSelection":
  case "individuAffichage":
    ControllerIndividu::$action($args);
    break;

  case 'CavePropAmelioration':
    ControllerCave::$action($args);

    // Tache par défaut
  default:
    $action = "caveAccueil";
    ControllerCave::$action($args);
}
?>
<!-- ----- Fin Router1 -->