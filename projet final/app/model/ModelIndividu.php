<!-- ----- debut ModelIndividu -->

<?php
require_once 'Model.php';
require_once 'ModelFamille.php';

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


    // tout le tableau sql
    public static function getAll()
    {
        try {
            $database = Model::getInstance();

            $query = "SELECT * from individu where id > 0";
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

    public static function getAllIndividu()
    {
        try {
            $database = Model::getInstance();
            $query_individu = "SELECT * from individu where id > 0";

            $statement = $database->prepare($query_individu);
            $statement->execute();
            $datas_individu = $statement->fetchAll(PDO::FETCH_ASSOC);

            return array($datas_individu);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }


    public static function insert($nom, $prenom, $sexe)
    {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from individu";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // crée une liste avec tous les noms de famille
            // $query = "select nom from individu";
            // $statement = $database->query($query);
            // while ($resultats = $statement->fetch()) {
            //     $array_noms = $resultats;
            // }

            // on check si le nom de famille existe deja ou nom
            // if (in_array($nom, $array_noms)) {
            // }

            // quel est le famille_id du nom de la personne renseignée ?
            $statement = $database->prepare("SELECT famille_id from individu where nom = :nom");
            $statement->execute([
                'nom' => $nom,
            ]);


            if ($statement->rowCount() > 0) { // si la famille existe, ajouter l'individu dedans 

                $tuple2 = $statement->fetch();
                $famille_id = $tuple2['0'];

                $query = "INSERT into individu values (:famille_id, :id, :nom, :prenom, :sexe, 0, 0)";
                $new_statement = $database->prepare($query);
                $new_statement->execute([
                    'famille_id' => $famille_id,
                    'id' => $id,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'sexe' => $sexe
                ]);
            } else { // sinon, il faut créer la famille et ajouter l'individu dedans

                $famille_id = ModelFamille::insert($nom);
                $query = "INSERT into individu values (:famille_id, :id, :nom, :prenom, :sexe, 0, 0)";
                $new_statement = $database->prepare($query);
                $new_statement->execute([
                    'famille_id' => $famille_id,
                    'id' => $id,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'sexe' => $sexe
                ]);
            }

            return array($famille_id, $id);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
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

    public static function getInfoIndividu($famille_id, $individu_id)
    {
        try {
            $info_individu=[]; // création du tableau 
            $database = Model::getInstance();

            // récupérations de toutes les infos sur la personne de la base de donnée individu
            $query = "SELECT * from individu where famille_id = :famille_id and id=:id";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $famille_id,
                'id' => $individu_id
            ]);
            $results = $statement->fetchAll();
            $info_individu['individu'] = $results[0]; // maintenant, on a un tableau avec une dimension en plus "individu" où on va pouvoir retrouver par la suite toutes les variables de la table individu

            
            // récupérations des parents de l'individu

            // on commence par le père
            $query = "SELECT * from individu where id=:id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $info_individu['individu']['pere']
            ]);
            $results = $statement->fetchAll();
            $infos['individu']['pere_nom'] = $results[0]['nom'];
            $infos['individu']['pere_prenom'] = $results[0]['prenom'];
            
            //puis pour la mère :
            $query = "select * from individu where id=:id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $infos['individu']['mere'],
            ]);
            $results = $statement->fetchAll();
            $infos['individu']['mere_nom'] = $results[0]['nom'];
            $infos['individu']['mere_prenom'] = $results[0]['prenom'];

            return $info_individu;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }

    }
}
?>
<!-- ----- fin ModelIndividu -->