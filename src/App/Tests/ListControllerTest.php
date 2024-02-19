<?php

declare(strict_types=1);

namespace Acme\App\Tests;

use PHPUnit\Framework\TestCase;
use Acme\App\Services\ListService;
use Acme\Framework\Container;
use Acme\App\Config\Paths;
use Acme\Framework\exceptions\InvalidPokemonIdException;

class ListControllerTest extends TestCase
{
    private ?ListService $serviceInstance;

    private const PATH_TO_DEFINITIONS = Paths::SOURCE . "App/container-definitions.php";

    public function test_checkAndRetrieveParams_returntype_string()
    {
        $_GET['pokemonIds'] = '10';
        $result = $this->serviceInstance->checkPokemonIds();
        $expect = '10';

        $this->assertIsString($result);
        $this->assertEquals($result, $expect);
    }

    public function test_checkAndRetrieveParams_returntype_array()
    {
        $_GET['pokemonIds'] = '10,10';
        $result = $this->serviceInstance->checkPokemonIds();
        $expect = [
            '10',
            '10'
        ];

        $this->assertIsArray($result);
        $this->assertEquals($result, $expect);
    }

    public function test_checkAndRetrieveParams_exception_when_param_is_not_set()
    {
        unset($_GET['pokemonIds']);
        $this->expectException(InvalidPokemonIdException::class);
        $this->serviceInstance->checkPokemonIds();
    }

    public function test_getPokemonList_is_array()
    {
        $result = $this->serviceInstance->getPokemonList();
        $this->assertIsArray($result);
    }

    protected function setUp(): void
    {
        $containerDefinition = include self::PATH_TO_DEFINITIONS;
        $container = new Container();
        $container->addDefinition($containerDefinition);
        $this->serviceInstance = $container->resolve(ListService::class);
    }

    protected function tearDown(): void
    {
        $this->serviceInstance = null;
    }
}
