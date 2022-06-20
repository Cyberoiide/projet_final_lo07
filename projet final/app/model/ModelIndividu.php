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

            $query = "SELECT * FROM individu WHERE id!=0 and famille_id=:famille_id";
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

    public static function getAllIndividu()
    {
        try {
            $database = Model::getInstance();
            $query_individu = "SELECT * from individu where id > 0 and famille_id=:famille_id";

            $statement = $database->prepare($query_individu);
            $statement->execute(['famille_id' => $_SESSION['famille_id']]);
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
            $query = "select max(id) from individu where famille_id=:famille_id";
            $statement = $database->prepare($query);
            $statement->execute(['famille_id' => $_SESSION['famille_id']]);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple individu
            $query = "insert into individu value (:famille_id, :id, :nom, :prenom, :sexe, 0, 0)";
            $statement = $database->prepare($query);
            $statement->execute([
                'famille_id' => $_SESSION['famille_id'],
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'sexe' => $sexe
            ]);
            return $id;

            return array($id);
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

    public static function getInfoIndividu($id)
    {
        try {
            // - Création du array de toutes les infos présentes dans l'affichage
            $infos_individu = [];
            $database = Model::getInstance();

            //Récupération des infos de l'individu
            $query = "SELECT * from individu where id=:id and famille_id=:famille_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'famille_id' => $_SESSION['famille_id']
            ]);
            $results = $statement->fetchAll();
            $infos_individu['individu'] = $results[0];


            //Ajout des noms et prénoms des parents

            // on commence par le père :
            $query = "select nom,prenom from individu where id=:id and famille_id=:famille_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $infos_individu['individu']['pere'],
                'famille_id' => $_SESSION['famille_id']
            ]);
            $results = $statement->fetchAll();
            $infos_individu['individu']['pere_nom'] = $results[0]['nom']; // on rentre le nom du père
            $infos_individu['individu']['pere_prenom'] = $results[0]['prenom']; // et son prénom

            // ensuite on ajoute la mère :
            $query = "select nom,prenom from individu where id=:id and famille_id=:famille_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $infos_individu['individu']['mere'],
                'famille_id' => $_SESSION['famille_id']
            ]);
            $results = $statement->fetchAll();
            $infos_individu['individu']['mere_nom'] = $results[0]['nom']; // on ajoute dans notre grand tableau le nom de la mère
            $infos_individu['individu']['mere_prenom'] = $results[0]['prenom']; // et son prénom


            // Récupération des évènements

            // Naissance :
            $query = "SELECT event_date, event_lieu from evenement where event_type='NAISSANCE' and iid=:iid and famille_id=:famille_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'iid' => $id,
                'famille_id' => $_SESSION['famille_id']
            ]);
            $results = $statement->fetchAll();

            // on va chercher la date de la naissance
            if (empty($results[0]['event_date']))
                $infos_individu['evenement']['NAISSANCE']['event_date'] = '?'; // si rien on met ?
            else
                $infos_individu['evenement']['NAISSANCE']['event_date'] = $results[0]['event_date'];

            // le lieu
            if (empty($results[0]['event_lieu']))
                $infos_individu['evenement']['NAISSANCE']['event_lieu'] = '?';
            else
                $infos_individu['evenement']['NAISSANCE']['event_lieu'] = $results[0]['event_lieu'];

            // Décès : on fait la meme chose que pour la naissance
            $query = "select event_date,event_lieu from evenement where event_type='DECES' and iid=:id and famille_id=:famille_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'famille_id' => $_SESSION['famille_id']
            ]);
            $results = $statement->fetchAll();
            if (empty($results[0]['event_date']))
                $infos_individu['evenement']['DECES']['event_date'] = '?';
            else
                $infos_individu['evenement']['DECES']['event_date'] = $results[0]['event_date'];
            if (empty($results[0]['event_lieu']))
                $infos_individu['evenement']['DECES']['event_lieu'] = '?';
            else
                $infos_individu['evenement']['DECES']['event_lieu'] = $results[0]['event_lieu'];


            //Récupération des unions et des enfants
            $query = "SELECT iid1, iid2, lien_type from lien where (iid1=:id or iid2=:id) and famille_id=:famille_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'famille_id' => $_SESSION['famille_id']
            ]);
            $results = $statement->fetchAll();
            $infos_individu['union'] = []; // initialisation du sous-tableau union pour y mettre après tous les paquets d'unions qui vont venir

            //Récupération des enfants
            $i = 0;
            foreach ($results as $element) {
                $infos_individu['union'][$i] = [];
                if ($element['iid1'] == $id)
                    $infos_individu['union'][$i]['id'] = $element['iid2'];
                else
                    $infos_individu['union'][$i]['id'] = $element['iid1'];

                //Recherche du nom et prénom la personne de l'union
                $query = "select nom, prenom from individu where id=:id and famille_id=:famille_id";
                $statement = $database->prepare($query);
                $statement->execute([
                    'id' => $infos_individu['union'][$i]['id'],
                    'famille_id' => $_SESSION['famille_id']
                ]);
                $results = $statement->fetchAll();
                $infos_individu['union'][$i]['nom'] = $results[0]['nom'];
                $infos_individu['union'][$i]['prenom'] = $results[0]['prenom'];

                //Recherche enfants
                $query = "select id, nom, prenom from individu where pere=:id and mere=:id2 and famille_id=:famille_id";
                $statement = $database->prepare($query);
                if ($infos_individu['individu']['sexe'] == 'H') {
                    $statement->execute([
                        'id2' => $infos_individu['union'][$i]['id'],
                        'id' => $id,
                        'famille_id' => $_SESSION['famille_id']
                    ]);
                } else {
                    $statement->execute([
                        'id2' => $id,
                        'id' => $infos_individu['union'][$i]['id'],
                        'famille_id' => $_SESSION['famille_id']
                    ]);
                }
                $results = $statement->fetchAll();
                $infos_individu['union'][$i]['enfants'] = $results;
                $i++;
            }



            return $infos_individu;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
?>
<!-- ----- fin ModelIndividu -->