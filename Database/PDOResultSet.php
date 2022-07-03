<?php

namespace Database;

use Database\Interfaces\PDOResultSetInterface;
use Generator;
use PDOStatement;

class PDOResultSet implements PDOResultSetInterface
{
    private PDOStatement  $PDOStatement;

    /**
     * @param PDOStatement $PDOResultSet
     */
    public function __construct(PDOStatement $PDOResultSet)
    {
        $this->PDOStatement = $PDOResultSet;
    }

    public function fetch($className): Generator
    {
        while ($row = $this->PDOStatement->fetch($className))
        {
            yield $row;
        }
    }
}