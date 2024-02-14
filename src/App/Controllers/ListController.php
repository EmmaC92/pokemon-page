<?php

declare(strict_types=1);

namespace Acme\App\Controllers;

use Acme\Framework\utils\{
    PokemonFileManager,
    Randomizer
};
use Acme\Framework\exceptions\InvalidPokemonIdException;
use Acme\Framework\exceptions\EmptyListException;
use Acme\Framework\TemplateEngine;
use Acme\App\Services\ListService;

class ListController
{
    public function __construct(
        private Randomizer $randomizer,
        private TemplateEngine $views,
        private ListService $listService
    ) {
    }

    public function addPokemonToList(): void
    {
        $ids = $this->listService->checkAndRetrieveParams();
        $pokemonArray = $this->listService->addPokemonToList($ids);

        $this->render('/home.php', [
            'pokemonArray' => $pokemonArray,
            'title' => 'Pokemon App | Add pokemon'
        ]);
    }

    public function getPokemonList(): void
    {
        $pokemonArray = $this->listService->getPokemonList();

        $this->render('/home.php', [
            'pokemonArray' => $pokemonArray,
            'title' => 'Pokemon App | List'
        ]);
    }

    private function render(string $template, array $params): void
    {
        echo $this->views->render($template, $params);
    }
}
