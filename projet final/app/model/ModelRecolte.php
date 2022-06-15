<!-- ----- debut ModelRecolte -->

<?php
require_once 'Model.php';

class ModelRecolte
{
    private $producteur_id, $vin_id, $quantite;

    // pas possible d'avoir 2 constructeurs
    public function __construct($producteur_id = NULL, $vin_id = NULL, $quantite = NULL)
    {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($producteur_id)) {
            $this->producteur_id = $producteur_id;
            $this->vin_id = $vin_id;
            $this->quantite = $quantite;
        }
    }

    function setProducteur_id($producteur_id)
    {
        $this->producteur_id = $producteur_id;
    }

    function setVin_id($vin_id)
    {
        $this->vin_id = $vin_id;
    }

    function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    function getProducteur_id()
    {
        return $this->producteur_id;
    }

    function getVin_id()
    {
        return $this->vin_id;
    }

    function getQuantite()
    {
        return $this->quantite;
    }


    // retourne une liste des id
    public static function getAllId()
    {
        try {
            $database = Model::getInstance();
            $query = "select id from recolte";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // tout le tableau sql
    public static function getAll()
    {
        try {
            $database = Model::getInstance();

            $query = "select region, cru, annee, degre, nom, prenom, quantite from vin, producteur, recolte where recolte.vin_id = vin.id and recolte.producteur_id = producteur.id order by region";
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


    // retourne la liste de vins et de producteurs
    public static function getAllVinProd()
    {
        try {
            $database = Model::getInstance();
            $query_vin = "select id,cru,annee from vin";
            $query_prod = "select id,nom,prenom,region from producteur";

            $statement = $database->prepare($query_vin);
            $statement->execute();
            $datas_vin = $statement->fetchAll(PDO::FETCH_ASSOC);

            $statement1 = $database->prepare($query_prod);
            $statement1->execute();

            $datas_prod = $statement1->fetchAll(PDO::FETCH_ASSOC);

            return array($datas_vin, $datas_prod);

        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }


    // pour insérer une nouvelle récolte
    public static function insert($producteur_id, $vin_id, $quantite)
    {
        try {
            $database = Model::getInstance();
            $query = "select * from recolte where producteur_id = :producteur_id and vin_id = :vin_id ";
            $testExistence = $database->prepare($query);
            $testExistence->execute([
                'producteur_id' => $producteur_id,
                'vin_id' => $vin_id
            ]);
            if ($testExistence->rowCount() > 0) {
                $query = "SET FOREIGN_KEY_CHECKS = 0;"
                    . "update recolte set quantite = :quantite where producteur_id = :producteur_id and vin_id = :vin_id;"
                    . "SET FOREIGN_KEY_CHECKS = 1; ";
                $statement = $database->prepare($query);
                $statement->execute([
                    'producteur_id' => $producteur_id,
                    'vin_id' => $vin_id,
                    'quantite' => $quantite
                ]);
                return array($vin_id, $producteur_id, 0);
            } else {
                // ajout d'un nouveau tuple;
                $query = "SET FOREIGN_KEY_CHECKS = 0;"
                    . "insert into recolte value ( :producteur_id, :vin_id, :quantite);"
                    . "SET FOREIGN_KEY_CHECKS = 1;";
                $statement = $database->prepare($query);
                $statement->execute([
                    'producteur_id' => $producteur_id,
                    'vin_id' => $vin_id,
                    'quantite' => $quantite
                ]);
                return array($vin_id, $producteur_id, 1);
            }
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
            $query = "select * from recolte where id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelRecolte");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function delete($id)
    {
        try {
            $database = Model::getInstance();

            $results = ModelRecolte::getOne($id);
            $query = "DELETE FROM recolte WHERE id = :id";
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
<!-- ----- fin ModelRecolte -->