<?php

namespace Acme\App\Controllers;

use Acme\App\Services\{
    MatchService
};
use Acme\Framework\Contracts\TemplateEngineInterface;

class MatchController
{
    public function __construct(
        private MatchService $matchService,
        private TemplateEngineInterface $views
    ) {
    }

    public function match(): void
    {
        $trainingPokemons = $this->matchService->createTrainingPokemonsForMatch();

        $attempt = $this->matchService->startMatch($trainingPokemons);

        echo $this->views->renderView('/match.php', [
            'pokemonArray' => $trainingPokemons,
            'attempt' => $attempt,
            'title' => 'Pokemon App | Match'
        ]);
    }
}
