<?php

declare(strict_types=1);

namespace Acme\App\Contracts;

use Acme\Framework\models\pokemon\AbstractPokemon;

interface PokemonGeneratorInterface
{

    public const POKEMON_ID_RANGE = [
        'first_id' => 1,
        'last_id' => 386
    ];

    /**
     * first pokemon generation 
     * @var int
     */
    public const FIRST_GENERATION = 1;

    /**
     * second pokemon generation 
     * @var int
     */
    public const SECOND_GENERATION = 2;

    /**
     * second pokemon generation 
     * @var int
     */
    public const THIRD_GENERATION = 3;

    public function getPokemon(string|int $slug = null, int $generation = null): AbstractPokemon;

    public function getPokemonSpecies(string|int $pokemonId): mixed;

    public function getPokemonEvolutionChain(string|int $evolucionChainId): mixed;

    public function getRandomPokemonId(int $minId = 1, int $maxId = 381): int;
}
