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

    public static function lienParentCreated() {      
        $parent = ModelLien::insertParent(
            htmlspecialchars($_GET['id_enfant']),
            htmlspecialchars($_GET['id_parent']));
       
    // ----- Construction chemin de la vue
    include 'config.php';
    $vue = $root . '/app/view/lien/viewParentInserted.php';
    require ($vue);
}

public static function lienUnionCreate() {
       //récupération des individus
       $results = ModelLien::getAllIndividu();
       // ----- Construction chemin de la vue du formulaire d'ajout
       include 'config.php';
       $vue = $root . '/app/view/lien/viewUnionInsert.php';
       require ($vue);
   }
   
public static function lienUnionCreated() {      
        $results = ModelLien::insertUnion(htmlspecialchars($_GET['id_homme']),
                htmlspecialchars($_GET['id_femme']),htmlspecialchars($_GET['type'])
                ,htmlspecialchars($_GET['date']),htmlspecialchars($_GET['lieu']));
       
    // ----- Construction chemin de la vue
    include 'config.php';
    $vue = $root . '/app/view/lien/viewUnionInserted.php';
    require ($vue);
}


   
   
}

?>
<!-- ----- fin ControllerLien -->