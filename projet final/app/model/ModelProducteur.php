<!-- ----- debut ModelProducteur -->

<?php
require_once 'Model.php';

class ModelProducteur
{
    private $id, $nom, $prenom, $region;

    // pas possible d'avoir 2 constructeurs
    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $region = NULL)
    {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->region = $region;
        }
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNom($nom)
    {
        $this->nom = $nom;
    }

    function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    function setRegion($region)
    {
        $this->region = $region;
    }

    function getId()
    {
        return $this->id;
    }

    function getNom()
    {
        return $this->nom;
    }

    function getPrenom()
    {
        return $this->prenom;
    }

    function getRegion()
    {
        return $this->region;
    }


    // retourne une liste des id
    public static function getAllId()
    {
        try {
            $database = Model::getInstance();
            $query = "select id from producteur";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getMany($query)
    {
        try {
            $database = Model::getInstance();
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelProducteur");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getAll()
    {
        try {
            $database = Model::getInstance();
            $query = "select * from producteur";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelProducteur");
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
            $query = "select * from producteur where id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelProducteur");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($nom, $prenom, $region)
    {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from producteur";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into producteur value (:id, :nom, :prenom, :region)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'region' => $region
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function getRegionNoDoublons()
    {

        try {
            $database = Model::getInstance();
            $requete = "SELECT DISTINCT region from producteur order by region";

            $statement = $database->query($requete);
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);

            return $results;

        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function getNbProducteurParRegion() {
        try {
            $database = Model::getInstance();
            $requete = "SELECT region, COUNT(*) FROM producteur GROUP BY region";

            $statement = $database->query($requete);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $results;

        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function update()
    {
        echo ("ModelProducteur : update() TODO ....");
        return null;
    }

    public static function delete($id) {
        try {
          $database = Model::getInstance();
    
          $results = ModelProducteur::getOne($id);
          $query = "DELETE FROM producteur WHERE id = :id";
          $statement = $database->prepare($query);
          $statement->execute([
                  'id' => $id
          ]);
          return $results[0];
          
        } catch (PDOException $e) {
          printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
          return -1;
        }
      }
    

    
}
?>
<!-- ----- fin ModelProducteur -->