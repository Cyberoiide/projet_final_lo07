<!-- ----- debut ModelLien -->

<?php
require_once 'Model.php';

class ModelLien
{
    private $famille_id, $id, $iid1, $iid2, $lien_type, $lien_date, $lien_lieu;

    // pas possible d'avoir 2 constructeurs
    public function __construct($famille_id = NULL, $id = NULL, $iid1 = NULL, $iid2 = NULL, $lien_type = NULL, $lien_date = NULL, $lien_lieu = NULL)
    {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->famille_id = $famille_id;
            $this->id = $id;
            $this->iid1 = $iid1;
            $this->iid2 = $iid2;
            $this->lien_type = $lien_type;
            $this->lien_date = $lien_date;
            $this->lien_lieu = $lien_lieu;
        }
    }

    public function getFamille_id()
    {
        return $this->famille_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIid1()
    {
        return $this->iid1;
    }

    public function getIid2()
    {
        return $this->iid2;
    }

    public function getLien_type()
    {
        return $this->lien_type;
    }

    public function getLien_date()
    {
        return $this->lien_date;
    }

    public function getLien_lieu()
    {
        return $this->lien_lieu;
    }

    public function setFamille_id($famille_id)
    {
        $this->famille_id = $famille_id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIid1($iid1)
    {
        $this->iid1 = $iid1;
    }

    public function setIid2($iid2)
    {
        $this->iid2 = $iid2;
    }

    public function setLien_type($lien_type)
    {
        $this->lien_type = $lien_type;
    }

    public function setLien_date($lien_date)
    {
        $this->lien_date = $lien_date;
    }

    public function setLien_lieu($lien_lieu)
    {
        $this->lien_lieu = $lien_lieu;
    }


    // grosses méthodes


    // récupère tous les liens
    public static function getAll()
    {
        try {
            $database = Model::getInstance();

            $query = "select * from lien";
            $statement = $database->prepare($query);
            $statement->execute();

            // noms des attributs
            $colcount = $statement->columnCount();
            for ($i = 0; $i < $colcount; $i++) {
                $cols[] = $statement->getColumnMeta($i)['name'];
            }

            while ($resultat = $statement->fetch(PDO::FETCH_ASSOC)) {
                $datas[] = $resultat;
            }

            return array($cols, $datas);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // retourne la liste des individus
    public static function getAllIndividu()
    {
        try {
            $database = Model::getInstance();
            $query_individu = "select * from individu";

            $statement = $database->prepare($query_individu);
            $statement->execute();
            $datas_individu = $statement->fetchAll(PDO::FETCH_ASSOC);

            return array($datas_individu);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
