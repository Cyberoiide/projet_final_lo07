<!-- ----- debut ControllerLien -->
<?php
require_once '../model/ModelLien.php';

class ControllerLien
{
    // --- Liste des liens
    public static function lienReadAll()
    {
        $results = ModelLien::getAll();

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/lien/viewAll.php';
        if (DEBUG)
            echo ("ControllerLien : lienReadAll : vue = $vue");
        require($vue);
    }

    public static function lienParentCreate()
    {
        $results = ModelLien::getAllIndividu();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/lien/viewParentInsert.php';
        require($vue);
    }
}

?>
<!-- ----- fin ControllerLien -->