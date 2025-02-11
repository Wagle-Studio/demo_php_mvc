<?php

namespace Src;

use PDO;
use PDOException;

require_once __DIR__ . "/../conf.php";

class Database
{
    protected PDO $database;

    public function __construct()
    {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;

        try {
            $this->database = new PDO($dsn, DB_USER, DB_PSWD);
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }
}
