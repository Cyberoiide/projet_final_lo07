<!-- ----- debut ModelFamille -->

<?php
require_once 'Model.php';

class ModelFamille
{
    private $id, $nom;

    // pas possible d'avoir 2 constructeurs
    public function __construct($id = NULL, $nom = NULL)
    {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->id = $id;
            $this->nom = $nom;
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

    function getId()
    {
        return $this->id;
    }

    function getNom()
    {
        return $this->nom;
    }


    // début des grosses méthodes

    // retourne une liste avec toutes les familles
    public static function getAll()
    {
        try {
            $database = Model::getInstance();
            $query = "select * from famille";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelFamille");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }


    // retourne une liste des id

    public static function getAllNom()
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT nom from famille ORDER by id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getOne($nom)
    {
        try {
            $database = Model::getInstance();
            $query = "select * from famille where nom = :nom";
            $statement = $database->prepare($query);
            $statement->execute([
                'nom' => $nom
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelFamille");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($nom)
    {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from famille";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into famille value (:id, :nom)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'nom' => $nom,
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
            $requete = "SELECT DISTINCT region from famille order by region";

            $statement = $database->query($requete);
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);

            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function getNbFamilleParRegion()
    {
        try {
            $database = Model::getInstance();
            $requete = "SELECT region, COUNT(*) FROM famille GROUP BY region";

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
        echo ("ModelFamille : update() TODO ....");
        return null;
    }

    public static function delete($id)
    {
        try {
            $database = Model::getInstance();

            $results = ModelFamille::getOne($id);
            $query = "DELETE FROM famille WHERE id = :id";
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
<!-- ----- fin ModelFamille -->