<?php

declare(strict_types=1);

namespace Acme\App\Controllers;

use Acme\Framework\utils\Randomizer;
use Acme\Framework\TemplateEngine;
use Acme\App\Services\ValidationService;

class HomeController
{

    private const POKEMON_ID = "pokemonId";

    public function __construct(
        private Randomizer $randomizer,
        private TemplateEngine $views,
        private ValidationService $validator
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
        $this->validator->validateId($_GET);
        return array_key_exists(self::POKEMON_ID, $_GET) ? $_GET[self::POKEMON_ID] : null;
    }
}
