<?php

namespace Database;

use Database\Interfaces\PDODatabaseInterface;
use PDO;

class PDODatabase implements PDODatabaseInterface
{
    private PDO $db;

    /**
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }


    public function query(string $query): PDOPreparedStatementInterface
    {
        $stmt = $this->pdo->prepare($query);
        return new PDOPreparedStatementInterface($stmt);
    }
}