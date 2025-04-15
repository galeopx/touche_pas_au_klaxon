<?php
/**
 * Connection à la base de données
 * 
 * @package Touche Pas Au Klaxon
 */

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    /**
     * Constructeur: établit la connexion à la base de données
     */
    public function __construct()
    {
        // Configuration DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_EMULATE_PREPARES => false
        );

        // Création de l'instance PDO
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo 'Erreur de connexion : ' . $this->error;
        }
    }

    /**
     * Prépare la requête SQL
     * 
     * @param string $sql La requête à préparer
     */
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    /**
     * Lie les valeurs aux paramètres de la requête
     * 
     * @param string $param Le nom du paramètre
     * @param mixed $value La valeur à lier
     * @param mixed $type Le type de la valeur (optionnel)
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Exécute la requête préparée
     * 
     * @return bool
     */
    public function execute()
    {
        return $this->stmt->execute();
    }

    /**
     * Récupère tous les enregistrements en tant qu'objets
     * 
     * @return array
     */
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    /**
     * Récupère un seul enregistrement en tant qu'objet
     * 
     * @return object
     */
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch();
    }

    /**
     * Récupère le nombre de lignes affectées
     * 
     * @return int
     */
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    /**
     * Récupère le dernier ID inséré
     * 
     * @return int
     */
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}