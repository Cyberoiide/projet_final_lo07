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

    public static function individuAffichage()
    {
        $ids = explode('|', $_GET['ids']);
        $famille_id = $ids[1];
        $individu_id = $ids[0];

        $results = ModelIndividu::getInfoIndividu(
            $famille_id,
            $individu_id,
        );
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/evenement/viewInserted.php';
        require($vue);
    }
}
?>
<!-- ----- fin ControllerIndividu -->