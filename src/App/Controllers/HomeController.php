<?php

declare(strict_types=1);

namespace Acme\App\Controllers;

use Acme\App\Contracts\PokemonGeneratorInterface;
use Acme\Framework\Contracts\TemplateEngineInterface;
use Acme\App\Services\ValidationService;

class HomeController
{

    private const POKEMON_ID = "pokemonId";

    public function __construct(
        private PokemonGeneratorInterface $pokemonGenerator,
        private TemplateEngineInterface $views,
        private ValidationService $validator
    ) {
    }

    private array $pokemonArray = [];

    public function home()
    {
        $pokemonId = $this->checkAndRetrieveParams();
        $this->pokemonArray[] = $this->pokemonGenerator->getPokemon($pokemonId);

        $this->views->renderView("/home.php", [
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
