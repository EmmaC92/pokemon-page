<?php

namespace Acme\App\Controllers;

use Acme\Framework\TemplateEngine;
use Acme\App\Services\{
    MatchService
};

class MatchController
{
    public function __construct(
        private MatchService $matchService,
        private TemplateEngine $views
    ) {
    }

    public function match(): void
    {
        $trainingPokemons = $this->matchService->createTrainingPokemonsForMatch();

        $attempt = $this->matchService->startMatch($trainingPokemons);

        echo $this->views->render('/match.php', [
            'pokemonArray' => $trainingPokemons,
            'attempt' => $attempt,
            'title' => 'Pokemon App | Match'
        ]);
    }
}
