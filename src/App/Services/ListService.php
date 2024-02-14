<?php

declare(strict_types=1);

namespace Acme\App\Services;

use Acme\Framework\utils\{
    PokemonFileManager,
    Randomizer
};
use Acme\Framework\exceptions\InvalidPokemonIdException;
use Acme\Framework\exceptions\EmptyListException;

class ListService
{
    private const POKEMON_IDS = 'pokemonIds';

    public function __construct(
        private Randomizer $randomizer
    ) {
    }

    public function addPokemonToList(array $ids): array
    {
        $pokemonArray = $this->randomizer->getPokemons($ids);
        foreach ($pokemonArray as $newPokemon) {
            PokemonFileManager::writeNewPokemon($newPokemon);
        }

        return $pokemonArray;
    }

    public function checkAndRetrieveParams(): array|string
    {
        if (!isset($_GET[self::POKEMON_IDS])) {
            throw new InvalidPokemonIdException();
        }

        return str_contains($_GET[self::POKEMON_IDS], ',') ?
            explode(',', str_replace(' ', '', $_GET[self::POKEMON_IDS]))
            :
            $_GET[self::POKEMON_IDS];
    }

    public function getPokemonList(): array
    {
        $pokemonNameArray = PokemonFileManager::ReadPokemonFromList();

        if (empty($pokemonNameArray)) {
            throw new EmptyListException;
        }

        return $this->randomizer->getPokemons($pokemonNameArray);
    }
}
