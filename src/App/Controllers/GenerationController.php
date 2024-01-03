<?php

namespace Acme\App\Controllers;

use Acme\Framework\TemplateEngine;
use Acme\Framework\utils\Randomizer;
use Acme\Framework\exceptions\InvalidPokemonIdException;

class GenerationController
{
    
    private const POKEMON_GENERATION = 'pokemonGeneration';
    public function __construct(
        private Randomizer $randomizer,
        private TemplateEngine $views
    ) {
    }

    public function getPokemonByGeneration()
    {
        $generation = $this->checkAndRetrieveParams();
        $pokemonArray[] = $this->randomizer->getPokemon(null, $generation);

        echo $this->views->render('/home.php', [
            'pokemonArray' => $pokemonArray,
            'title' => 'Pokemon App | Generation'
        ]);
    }

    private function checkAndRetrieveParams(): array|string
    {
        if (!isset($_GET[self::POKEMON_GENERATION])) {
            throw new InvalidPokemonIdException();
        }

        return $_GET[self::POKEMON_GENERATION];
    }
}
