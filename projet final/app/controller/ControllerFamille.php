
<!-- ----- debut ControllerFamille -->
<?php

require_once '../model/ModelFamille.php';

class ControllerFamille
{

    // --- Liste des Familles
    public static function familleReadAll()
    {
        $results = ModelFamille::getAll();
        // ----- Construction chemin de la vue
        include 'config.php';
        $_SESSION['titre']="Pas de famille sélectionnée";
        $vue = $root . '/app/view/famille/viewAll.php';
        if (DEBUG)
            echo ("ControllerFamille : familleReadAll : vue = $vue");
        require($vue);
    }

    // Affiche une famille particulière
    public static function familleReadOne()
    {
        $famille_nom = $_GET['nom'];
        $results = ModelFamille::getOne($famille_nom);
        $_SESSION['titre']=$_GET['nom'];
        $_SESSION['famille_id']=$results[0]->getId();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/viewConfirmNom.php';
        require($vue);
    }

    public static function familleReadNoms()
    {
        $results = ModelFamille::getAllNom();

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/viewNoms.php';
        require($vue);
    }

    // Affiche le formulaire de creation d'un famille
    public static function familleCreate()
    {   $_SESSION['titre']="Pas de famille sélectionnée";
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/viewInsert.php';
        require($vue);
    }

    // Affiche un formulaire pour récupérer les informations d'un nouveau famille.
    // La clé est gérée par le systeme et pas par l'internaute
    public static function familleCreated()
    {
        // ajouter une validation des informations du formulaire
        $results = ModelFamille::insert(
            htmlspecialchars($_GET['nom']),
        );
        $_SESSION['titre']=$_GET['nom'];
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/viewInserted.php';
        require($vue);
    }


    // Liste sans doublons des régions 
    public static function familleRegionNoDoublons()
    {
        $results = ModelFamille::getRegionNoDoublons();

        include 'config.php';
        $vue = $root . '/app/view/famille/viewRegionNoDoublons.php';
        if (DEBUG)
            echo ("ControllerFamille : familleReadAll : vue = $vue");
        require($vue);
    }

    public static function familleNbProdParRegion() {

        $results = ModelFamille::getNbFamilleParRegion();

        include 'config.php';
        $vue = $root . '/app/view/famille/viewNbProdParRegion.php';
        if (DEBUG)
            echo ("ControllerFamille : familleReadAll : vue = $vue");
        require($vue);
    }

    public static function familleDeleted() {
        $prod_id = $_GET['id'];
        $results = ModelFamille::delete($prod_id);

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/famille/viewDeleted.php';
        require($vue);
    }
}
?>
<!-- ----- fin ControllerFamille -->