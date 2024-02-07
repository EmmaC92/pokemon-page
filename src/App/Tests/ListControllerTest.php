<?php

declare(strict_types=1);

namespace Acme\App\Tests;

use PHPUnit\Framework\TestCase;
use Acme\App\Controllers\ListController;
use Acme\Framework\Container;
use Acme\App\Config\Paths;

class ListControllerTest extends TestCase
{

    private ?Container $container;

    private const PATH_TO_DEFINITIONS = Paths::SOURCE . "App/container-definitions.php";

    public function test_checkAndRetrieveParams()
    {
        $controllerInstance = $this->container->resolve(ListController::class);

        $_GET['pokemonIds'] = '10';

        $result = $controllerInstance->checkAndRetrieveParams();

        $this->assertIsString($result);
    }

    protected function setUp(): void
    {
        $this->container = new Container();
        $containerDefinition = include self::PATH_TO_DEFINITIONS;
        $this->container->addDefinition($containerDefinition);
    }

    protected function tearDown(): void
    {
        $this->container = null;
    }
}
