<!-- ----- debut ControllerRecolte -->
<?php
require_once '../model/ModelRecolte.php';

class ControllerRecolte
{
    // --- Liste des recoltes
    public static function recolteReadAll()
    {
        $results = ModelRecolte::getAll();

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/recolte/viewAll.php';
        if (DEBUG)
            echo ("ControllerRecolte : recolteReadAll : vue = $vue");
        require($vue);
    }

    // Récupère tous les vins et producteurs + Affiche le formulaire de creation d'un recolte
    public static function recolteCreate()
    {
        $results = ModelRecolte::getAllVinProd();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/recolte/viewInsert.php';
        require($vue);
    }

    public static function recolteCreated()
    {
        $results = ModelRecolte::insert(
            htmlspecialchars($_GET['producteur_id']),
            htmlspecialchars($_GET['vin_id']),
            htmlspecialchars($_GET['quantite'])
        );
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/recolte/viewInserted.php';
        require($vue);
    }
}
?>
<!-- ----- fin ControllerRecolte -->