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

            $query = "SELECT * from lien WHERE famille_id=:famille_id";
            $statement = $database->prepare($query);
            $statement->execute(['famille_id' => $_SESSION['famille_id']]);

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
            $query = "SELECT * FROM individu WHERE id!=0 and famille_id=:famille_id";
            $statement = $database->prepare($query);
            $statement->execute(['famille_id' => $_SESSION['famille_id']]);

            $datas_individu = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $datas_individu;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }


    public static function insertParent($id_enfant, $id_parent)
    {
        try {
            $database = Model::getInstance();

            // recherche du sexe du parent
            $query = "SELECT sexe from individu where famille_id = :famille_id and id=:id_parent";
            $statement = $database->prepare($query);
            $statement->execute([
                'id_parent' => $id_parent, 
                'famille_id' => $_SESSION['famille_id']]);
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            $sexe = $results[0]; // juste une seule variable dans $sexe (M ou F)

            // update du lien de parenté pour l'enfant selon le sexe du parent
            if ($sexe == 'H') {
                $query = "UPDATE individu SET pere = :id_parent WHERE famille_id = :famille_id AND id = :id_enfant;";
                $parent = 'pere';
            } else {
                $query = "UPDATE individu SET mere = :id_parent WHERE famille_id = :famille_id AND id = :id_enfant;";
                $parent = 'mere';
            }
            $statement = $database->prepare($query);
            $statement->execute([
                'id_parent' => $id_parent,
                'famille_id' => $_SESSION['famille_id'],
                'id_enfant' => $id_enfant
            ]);
            return $parent;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function insertUnion($id_homme, $id_femme, $event_type, $event_date, $event_lieu)
    {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from lien";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple évènement;
            $query = "insert into lien value (:famille_id, :id, :iid1, :iid2, :event_type, :event_date, :event_lieu)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $_SESSION['famille_id'],
                'id' => $id,
                'iid1' => $id_homme,
                'iid2' => $id_femme,
                'event_type' => $event_type,
                'event_date' => $event_date,
                'event_lieu' => $event_lieu
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
}
