<!-- ----- debut ControllerGenealogie -->
<?php

class ControllerGenealogie
{
    // --- page d'acceuil
    public static function genealogieAccueil()
    {
        include 'config.php';
        $vue = $root . '/app/view/viewGenealogieAccueil.php';
        if (DEBUG)
            echo ("ControllerVin : genealogieAccueil : vue = $vue");
        require($vue);
    }
}