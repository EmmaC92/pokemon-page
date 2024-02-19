<?php

declare(strict_types=1);

namespace Acme\App\Services;

use Acme\Framework\utils\{

    PokemonFileManager
};
use Acme\App\Contracts\PokemonGeneratorInterface;
use Acme\Framework\exceptions\InvalidPokemonIdException;
use Acme\Framework\exceptions\EmptyListException;
use Acme\App\Contracts\ListServiceInterface;

class ListService implements ListServiceInterface
{
    private const POKEMON_IDS = 'pokemonIds';

    public function __construct(
        private PokemonGeneratorInterface $pokemonGenerator
    ) {
    }

    public function addPokemonToList(array $ids): array
    {
        $pokemonArray = $this->pokemonGenerator->getPokemons($ids);
        foreach ($pokemonArray as $newPokemon) {
            PokemonFileManager::writeNewPokemon($newPokemon);
        }

        return $pokemonArray;
    }

    public function checkPokemonIds(mixed $params = null): array|string
    {
        $params = $_GET;

        if (!isset($params[self::POKEMON_IDS])) {
            throw new InvalidPokemonIdException();
        }

        return str_contains($params[self::POKEMON_IDS], ',') ?
            explode(',', str_replace(' ', '', $params[self::POKEMON_IDS]))
            :
            $params[self::POKEMON_IDS];
    }

    public function getPokemonList(): array
    {
        $pokemonNameArray = PokemonFileManager::ReadPokemonFromList();

        if (empty($pokemonNameArray)) {
            throw new EmptyListException;
        }

        return $this->pokemonGenerator->getPokemons($pokemonNameArray);
    }
}
