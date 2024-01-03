<?php

declare(strict_types=1);

namespace Acme\App\Controllers;

use Acme\Framework\utils\Randomizer;
use Acme\Framework\TemplateEngine;

class HomeController
{

    private const POKEMON_ID = "pokemonId";

    public function __construct(
        private Randomizer $randomizer,
        private TemplateEngine $views
    ) {
    }

    private array $pokemonArray = [];

    public function home()
    {
        $pokemonId = $this->checkAndRetrieveParams();
        $this->pokemonArray[] = $this->randomizer->getPokemon($pokemonId);

        echo $this->views->render("/home.php", [
            'pokemonArray'  => $this->pokemonArray,
            'title' => 'Pokemon App | Home'
        ]);
    }

    private function checkAndRetrieveParams(): string|null
    {
        if (!isset($_GET[self::POKEMON_ID])) {
            return null;
        }

        return $_GET[self::POKEMON_ID];
    }
}
