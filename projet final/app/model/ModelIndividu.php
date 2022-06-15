<!-- ----- debut ModelIndividu -->

<?php
require_once 'Model.php';

class ModelIndividu
{
    private $famille_id, $id, $nom, $prenom, $sexe, $pere, $mere;

    // pas possible d'avoir 2 constructeurs
    public function __construct($famille_id = NULL, $id = NULL, $nom = NULL, $prenom = NULL, $sexe = NULL, $pere = NULL, $mere = NULL)
    {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($famille_id) and !is_null($id)) {
            $this->famille_id = $famille_id;
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->sexe = $sexe;
            $this->pere = $pere;
            $this->mere = $mere;
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

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getSexe()
    {
        return $this->sexe;
    }

    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    public function getPere()
    {
        return $this->pere;
    }

    public function setPere($pere)
    {
        $this->pere = $pere;
    }

    public function getMere()
    {
        return $this->mere;
    }

    public function setMere($mere)
    {
        $this->mere = $mere;
    }


    public static function getAll()
    {
        try {
            $database = Model::getInstance();
            $query = "select * from individu";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getOne($id)
    {
        try {
            $database = Model::getInstance();
            $query = "select * from individu where id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelIndividu");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getFamille($nom)
    {
        try {
            $database = Model::getInstance();
            $query = "select famille_id from individu where nom = :nom";
            $statement = $database->prepare($query);
            $statement->execute([
                'nom' => $nom
            ]);
            $results = $statement->fetch();
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    
}
?>
<!-- ----- fin ModelIndividu -->