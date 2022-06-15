<!-- ----- debut ControllerProducteur -->
<?php
require_once '../model/ModelProducteur.php';

class ControllerProducteur
{

    // --- Liste des Producteurs
    public static function producteurReadAll()
    {
        $results = ModelProducteur::getAll();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/producteur/viewAll.php';
        if (DEBUG)
            echo ("ControllerProducteur : producteurReadAll : vue = $vue");
        require($vue);
    }

    // Affiche un formulaire pour sélectionner un id qui existe
    public static function producteurReadId($args)
    {
        $results = ModelProducteur::getAllId();

        $target = $args['target'];
        if (DEBUG) echo ("ControllerVin:vinReadId : target = $target </br>");

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/producteur/viewId.php';
        require($vue);
    }

    // Affiche un producteur particulier (id)
    public static function producteurReadOne()
    {
        $producteur_id = $_GET['id'];
        $results = ModelProducteur::getOne($producteur_id);

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/producteur/viewAll.php';
        require($vue);
    }

    // Affiche le formulaire de creation d'un producteur
    public static function producteurCreate()
    {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/producteur/viewInsert.php';
        require($vue);
    }

    // Affiche un formulaire pour récupérer les informations d'un nouveau producteur.
    // La clé est gérée par le systeme et pas par l'internaute
    public static function producteurCreated()
    {
        // ajouter une validation des informations du formulaire
        $results = ModelProducteur::insert(
            htmlspecialchars($_GET['nom']),
            htmlspecialchars($_GET['prenom']),
            htmlspecialchars($_GET['region'])
        );
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/producteur/viewInserted.php';
        require($vue);
    }

    // Liste sans doublons des régions 
    public static function producteurRegionNoDoublons()
    {
        $results = ModelProducteur::getRegionNoDoublons();

        include 'config.php';
        $vue = $root . '/app/view/producteur/viewRegionNoDoublons.php';
        if (DEBUG)
            echo ("ControllerProducteur : producteurReadAll : vue = $vue");
        require($vue);
    }

    public static function producteurNbProdParRegion() {

        $results = ModelProducteur::getNbProducteurParRegion();

        include 'config.php';
        $vue = $root . '/app/view/producteur/viewNbProdParRegion.php';
        if (DEBUG)
            echo ("ControllerProducteur : producteurReadAll : vue = $vue");
        require($vue);
    }

    public static function producteurDeleted() {
        $prod_id = $_GET['id'];
        $results = ModelProducteur::delete($prod_id);

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/producteur/viewDeleted.php';
        require($vue);
    }
}
?>
<!-- ----- fin ControllerProducteur -->