<!-- ----- debut ModelEvenement -->

<?php
require_once 'Model.php';
require('ModelIndividu.php');


class ModelEvenement
{
    private $famille_id, $id, $iid, $event_type, $event_date, $event_lieu;

    // pas possible d'avoir 2 constructeurs
    public function __construct($famille_id = NULL, $id = NULL, $iid = NULL, $event_type = NULL, $event_date = NULL, $event_lieu = NULL)
    {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($famille_id)) {
            $this->famille_id = $famille_id;
            $this->id = $id;
            $this->iid = $iid;
            $this->event_type = $event_type;
            $this->event_date = $event_date;
            $this->event_lieu = $event_lieu;
        }
    }

    public function getFamilleId()
    {
        return $this->famille_id;
    }

    public function setFamilleId($famille_id)
    {
        $this->famille_id = $famille_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIid()
    {
        return $this->iid;
    }

    public function setIid($iid)
    {
        $this->iid = $iid;
    }

    public function getEventType()
    {
        return $this->event_type;
    }

    public function setEventType($event_type)
    {
        $this->event_type = $event_type;
    }

    public function getEventDate()
    {
        return $this->event_date;
    }

    public function setEventDate($event_date)
    {
        $this->event_date = $event_date;
    }

    public function getEventLieu()
    {
        return $this->event_lieu;
    }

    public function setEventLieu($event_lieu)
    {
        $this->event_lieu = $event_lieu;
    }


    // les grosses méthodes

    // tout le tableau sql
    public static function getAll()
    {
        try {
            $database = Model::getInstance();

            $query = "SELECT * from evenement where famille_id=:famille_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $_SESSION['famille_id']
            ]);

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


    // retourne la liste des évènements pour une famille
    public static function getAllIndividuEvent()
    {
        try {
            $database = Model::getInstance();
            $query_individu = "SELECT * FROM individu WHERE id!=0 and famille_id=:famille_id";

            $statement = $database->prepare($query_individu);
            $statement->execute([
                'famille_id' => $_SESSION['famille_id']
            ]);
            $datas_individu = $statement->fetchAll(PDO::FETCH_ASSOC);

            return array($datas_individu);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }


    // pour insérer un nouvel event
    public static function insert($iid, $event_type, $event_date, $event_lieu)
    {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "SELECT max(id) from evenement";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;
                           
            // ajout d'un nouveau tuple;
            $query = "insert into evenement value (:famille_id, :id, :iid, :event_type, :event_date, :event_lieu)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $_SESSION['famille_id'],
                'id' => $id,
                'iid' => $iid,
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


    // retourne un truc associé à un id
    public static function getOne($id)
    {
        try {
            $database = Model::getInstance();
            $query = "select * from evenement where id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $_SESSION['famille_id'],
                'id' => $id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelEvenement");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

}

// $test1 = new ModelEvenement();
// print_r (ModelEvenement::getOne(1));
?>
<!-- ----- fin ModelEvenement -->