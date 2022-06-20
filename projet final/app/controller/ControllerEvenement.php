<!-- ----- debut ControllerEvenement -->
<?php
require_once '../model/ModelEvenement.php';

class ControllerEvenement
{
    // --- Liste des évènements
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

    // Récupère tous les évènement + Affiche le formulaire de creation d'un evenement
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
        $iid = $_GET['individu_id'];      // id de l'invividu
        
        $results = ModelEvenement::insert(
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