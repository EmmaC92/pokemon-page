<?php

namespace Acme\App\Controllers;

use Acme\App\Contracts\PokemonGeneratorInterface;
use Acme\Framework\models\pokemon\PokemonIterable;
use Acme\Framework\Contracts\TemplateEngineInterface;

class FamilyController
{
    public function __construct(
        private PokemonGeneratorInterface $pokemonGenerator,
        private TemplateEngineInterface $views
    ) {
    }

    private const POKEMON_ID = "pokemonFamily";

    private array $pokemonArray = [];

    public function family()
    {
        $pokemonFamilyId = $this->checkAndRetrieveParams();

        $pokemonIterable = new PokemonIterable($pokemonFamilyId);
        foreach ($pokemonIterable as $key => $pokemon) {
            error_log("$key|$pokemon");
            $this->pokemonArray[] = $pokemon;
        }

        $this->views->renderView('/home.php', [
            'pokemonArray' => $this->pokemonArray,
            'title' => 'Pokemon App | Family'
        ]);
    }

    private function checkAndRetrieveParams(): string|int
    {
        if (!isset($_GET[self::POKEMON_ID])) {
            return $this->pokemonGenerator->getRandomPokemonId();
        }

        return $_GET[self::POKEMON_ID];
    }
}
