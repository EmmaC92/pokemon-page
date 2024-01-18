<?php

declare(strict_types=1);

namespace Acme\Framework;

use PDO, PDOException;

class Database
{

    private PDO $connection;

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

    public function query(string $query)
    {
        $this->connection->query($query);
    }
}
