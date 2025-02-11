<?php

namespace Src\Repositories;

use PDO;
use Src\Database;

class AbstractRepository extends Database
{
    protected string $table;
    protected string $className;

    public function __construct(string $table, string $className)
    {
        parent::__construct();

        $this->table = $table;
        $this->className = $className;
    }

    public function findAll()
    {
        $query = "SELECT * FROM {$this->table}";
        $results = $this->database->query($query);

        return $results->fetchAll(PDO::FETCH_CLASS, $this->className) ?? [];
    }


    public function find(int $id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id = :id";
        $request = $this->database->prepare($query);

        $request->execute(["id" => $id]);

        $request->setFetchMode(PDO::FETCH_CLASS, $this->className);
        $result = $request->fetch();

        return $result ?? null;
    }
}
