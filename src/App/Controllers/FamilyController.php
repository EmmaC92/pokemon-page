<?php

namespace Acme\App\Controllers;

use Acme\Framework\TemplateEngine;
use Acme\Framework\utils\Randomizer;
use Acme\Framework\models\pokemon\PokemonIterable;

class FamilyController
{
    public function __construct(
        private Randomizer $randomizer,
        private TemplateEngine $views
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

        echo $this->views->render('/home.php', [
            'pokemonArray' => $this->pokemonArray,
            'title' => 'Pokemon App | Family'
        ]);
    }

    private function checkAndRetrieveParams(): string|int
    {
        if (!isset($_GET[self::POKEMON_ID])) {
            return $this->randomizer->getRandomPokemonId();
        }

        return $_GET[self::POKEMON_ID];
    }
}
