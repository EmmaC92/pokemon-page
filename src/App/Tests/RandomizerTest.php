<?php

declare(strict_types=1);

namespace Acme\App\Tests;

use PHPUnit\Framework\TestCase;
use Acme\Framework\utils\Randomizer;
use Acme\Framework\exceptions\InvalidPokemonIdException;

class RandomizerTest extends TestCase
{
    private ?Randomizer $randomizer;

    public function test_getPokemon_check_pokemon_by_generation()
    {
        $newPokemonFirstGen = $this->randomizer->getPokemon(
            slug: null,
            generation: 1
        );

        $newPokemonSecondGen = $this->randomizer->getPokemon(
            slug: null,
            generation: 2
        );

        $newPokemonThirdGen = $this->randomizer->getPokemon(
            slug: null,
            generation: 3
        );

        $pokemonFirstGenId = $newPokemonFirstGen->getPokedexIndex();
        $pokemonSecondGenId = $newPokemonSecondGen->getPokedexIndex();
        $pokemonThirdGenId = $newPokemonThirdGen->getPokedexIndex();

        $this->assertGreaterThanOrEqual(1, $pokemonFirstGenId);
        $this->assertLessThanOrEqual(151, $pokemonFirstGenId);

        $this->assertGreaterThanOrEqual(152, $pokemonSecondGenId);
        $this->assertLessThanOrEqual(251, $pokemonSecondGenId);

        $this->assertGreaterThanOrEqual(252, $pokemonThirdGenId);
        $this->assertLessThanOrEqual(386, $pokemonThirdGenId);
    }

    public function test_getRandomPokemonId_check_pokemon_id_range()
    {
        $randPokemonId = $this->randomizer->getRandomPokemonId();

        $this->assertGreaterThanOrEqual(1, $randPokemonId);
        $this->assertLessThanOrEqual(386, $randPokemonId);
    }

    public function test_getRandomPokemonId_check_exception()
    {
        $this->expectException(InvalidPokemonIdException::class);

        $invalidPokemonId = 0;

        $this->randomizer->getRandomPokemonId($invalidPokemonId);
    }

    public function tearDown(): void
    {
        $this->randomizer = null;
    }

    public function setUp(): void
    {
        $this->randomizer = new Randomizer();
    }
}
