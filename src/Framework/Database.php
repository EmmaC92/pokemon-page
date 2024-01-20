<?php

declare(strict_types=1);

namespace Acme\Framework;

use PDO, PDOException, PDOStatement;

class Database
{

    private PDO $connection;
    private PDOStatement $stmt;

    public function __construct(
        string $driver,
        array $configs,
        string $username,
        string $password
    ) {
        $configs = http_build_query(data: $configs, arg_separator: ';');
        $dsn = "{$driver}:{$configs}";

        try {
            $this->connection = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            die("couldn't connect to the database\n");
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function query(string $query, array $params = []): Database
    {
        $this->stmt = $this->connection->prepare($query);

        $this->stmt->execute($params);

        return $this;
    }
}
