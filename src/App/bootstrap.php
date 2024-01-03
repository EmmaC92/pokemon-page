<?php

declare(strict_types=1);

require __DIR__ . "/../../vendor/autoload.php";

use Acme\Framework\App;
use Acme\App\Config\{
    Routes,
    Paths
};

use function Acme\App\Config\registerMiddleware;

$app = new App(Paths::SOURCE . "App/container-definitions.php")  ;

Routes::registerRoutes($app);
registerMiddleware($app);

return $app;
