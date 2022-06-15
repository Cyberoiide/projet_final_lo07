<!-- ----- debut ControllerEvenement -->
<?php
require_once '../model/ModelEvenement.php';

class ControllerEvenement
{
    // --- Liste des rvenements
    public static function evenementReadAll()
    {
        $results = ModelEvenement::getAll();

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/evenement/viewAll.php';
        if (DEBUG)
            echo ("ControllerEvenement : evenementReadAll : vue = $vue");
        require($vue);
    }

    // Récupère tous les vins et producteurs + Affiche le formulaire de creation d'un evenement
    public static function evenementCreate()
    {
        $results = ModelEvenement::getAllIndividuEvent();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/evenement/viewInsert.php';
        require($vue);
    }

    public static function evenementCreated()
    {
        $ids = explode('|', $_GET['ids']);
        $famille_id = $ids[1];
        $iid = $ids[0];      
        
        $results = ModelEvenement::insert(
            $famille_id,
            $iid,
            htmlspecialchars($_GET['event_type']),
            htmlspecialchars($_GET['event_date']),
            htmlspecialchars($_GET['event_lieu'])
        );
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/evenement/viewInserted.php';
        require($vue);
    }
}
?>
<!-- ----- fin ControllerEvenement -->