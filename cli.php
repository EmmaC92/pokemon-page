<?php

include __DIR__ . '/src/Framework/Database.php';
include __DIR__ . '/vendor/autoload.php';

use Acme\Framework\Database;
use Dotenv\Dotenv;
use Acme\App\Config\Paths;

$dotenv = Dotenv::createImmutable(Paths::ROOT);
$dotenv->load();

$db = new Database(
    $_ENV['DB_DRIVER'],
    [
        'host' => $_ENV['DB_HOST'],
        'port' => $_ENV['DB_PORT']
    ],
    $_ENV['DB_USERNAME'],
    $_ENV['DB_PASSWORD']
);

try {

    $db->getConnection()->beginTransaction();

    $sqlFile = file_get_contents('./database.sql');

    $stmt = $db->getConnection()->prepare($sqlFile);

    $stmt->execute();

    $db->getConnection()->commit();
} catch (\Exception $e) {
    error_log("ERROR: " . $e->getMessage());
    if ($db->getConnection()->inTransaction()) {
        $db->getConnection()->rollBack();
        echo ("transaction failed");
    }
}

echo "Database connected.\n";
