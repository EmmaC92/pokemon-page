<?php

declare(strict_types=1);

namespace Acme\App\Controllers;

use Acme\Framework\Contracts\TemplateEngineInterface;
use Acme\App\Contracts\ListServiceInterface;

class ListController
{
    public function __construct(
        private TemplateEngineInterface $views,
        private ListServiceInterface $listService
    ) {
    }

    public function addPokemonToList(): void
    {
        $ids = $this->listService->checkPokemonIds();
        $pokemonArray = $this->listService->addPokemonToList($ids);

        $this->views->renderView('/home.php', [
            'pokemonArray' => $pokemonArray,
            'title' => 'Pokemon App | Add pokemon'
        ]);
    }

    public function getPokemonList(): void
    {
        $pokemonArray = $this->listService->getPokemonList();

        $this->views->renderView('/home.php', [
            'pokemonArray' => $pokemonArray,
            'title' => 'Pokemon App | List'
        ]);
    }
}
