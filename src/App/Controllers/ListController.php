<?php

namespace Acme\App\Controllers;

use Acme\Framework\utils\{
    PokemonFileManager,
    Randomizer
};
use Acme\Framework\exceptions\EmptyListException;
use Acme\Framework\TemplateEngine;
use Acme\App\Config\Paths;

use Acme\Framework\exceptions\InvalidPokemonIdException;

class ListController
{
    private const POKEMON_IDS = 'pokemonIds';
    public function __construct(
        private Randomizer $randomizer,
        private TemplateEngine $views
    ) {
    }

    public function addPokemonToList(): void
    {
        $ids = $this->checkAndRetrieveParams();
        $pokemonArray = $this->randomizer->getPokemons($ids);
        foreach ($pokemonArray as $newPokemon) {
            PokemonFileManager::writeNewPokemon($newPokemon);
        }

        echo $this->views->render('/home.php', [
            'pokemonArray' => $pokemonArray,
            'title' => 'Pokemon App | Add pokemon'
        ]);
    }

    private function checkAndRetrieveParams(): array|string
    {
        if (!isset($_GET[self::POKEMON_IDS])) {
            throw new InvalidPokemonIdException();
        }

        return $_GET[self::POKEMON_IDS];
    }

    public function getPokemonList(): void
    {
        $pokemonNameArray = PokemonFileManager::ReadPokemonFromList();

        if (empty($pokemonNameArray)) {
            throw new EmptyListException;
        }

        $pokemonArray = $this->randomizer->getPokemons($pokemonNameArray);

        echo $this->views->render('/home.php', [
            'pokemonArray' => $pokemonArray,
            'title' => 'Pokemon App | List'
        ]);
    }
}
