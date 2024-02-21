<?php

namespace Acme\App\Controllers;

use Acme\App\Contracts\PokemonGeneratorInterface;
use Acme\Framework\Contracts\TemplateEngineInterface;
use Acme\Framework\exceptions\InvalidPokemonIdException;

class GenerationController
{

    private const POKEMON_GENERATION = 'pokemonGeneration';
    public function __construct(
        private PokemonGeneratorInterface $pokemonGenerator,
        private TemplateEngineInterface $views
    ) {
    }

    public function getPokemonByGeneration()
    {
        $generation = $this->checkAndRetrieveParams();
        $pokemonArray[] = $this->pokemonGenerator->getPokemon(null, $generation);

        $this->views->renderView('/home.php', [
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
