<!-- ----- debut ControllerIndividu -->
<?php
require_once '../model/ModelIndividu.php';

class ControllerIndividu
{

    // --- Liste des Individus
    public static function individuReadAll()
    {
        $results = ModelIndividu::getAll();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/individu/viewAll.php';
        if (DEBUG)
            echo ("ControllerIndividu : individuReadAll : vue = $vue");
        require($vue);
    }

    // Affiche un individu particulier (id)
    public static function individuReadOne()
    {
        $individu_id = $_GET['id'];
        $results = ModelIndividu::getOne($individu_id);

        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/individu/viewAll.php';
        require($vue);
    }

    // Affiche le formulaire de creation d'un individu
    public static function individuCreate()
    {
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/individu/viewInsert.php';
        require($vue);
    }

    public static function individuCreated()
    {
        // ajouter une validation des informations du formulaire
        $results = ModelIndividu::insert(
            htmlspecialchars($_GET['nom']),
            htmlspecialchars($_GET['prenom']),
            htmlspecialchars($_GET['sexe'])
        );
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/individu/viewInserted.php';
        require($vue);
    }

    public static function individuSelection()
    {
        $results = ModelIndividu::getAllIndividu();
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/individu/viewSelectionIndividu.php';
        require($vue);
    }

    public static function individuAffichage($arg)
    {
        //Demande de toutes les infos sur l'individu
        $results = ModelIndividu::getInfoIndividu($arg['individu_id']);
        
        //Construction de la vue page d'un individu
        include 'config.php';
        $vue = $root . '/app/view/individu/viewPage.php';
        require($vue);
    }
}
?>
<!-- ----- fin ControllerIndividu -->