<?php

namespace Acme\App\Controllers;

use Acme\Framework\TemplateEngine;
use Acme\Framework\utils\Randomizer;
use Acme\App\Services\{
    MatchService,
    PokemonService
};
use Acme\Framework\models\pokemon\TrainingPokemon;

class MatchController
{
    public function __construct(
        private Randomizer $randomizer,
        private MatchService $matchService,
        private PokemonService $pokemonService,
        private TemplateEngine $views
    ) {
    }

    public function match(): void
    {
        $first = $this->randomizer->getTrainingPokemon();
        $second = $this->randomizer->getTrainingPokemon();

        $this->pokemonService->savePokemon($first);
        $this->pokemonService->savePokemon($second);

        $attempt = [];

        while ($this->checkHp($first, $second)) {
            $attempt[] = $first->attack($second) ?? 0;
            $attempt[] = $second->attack($first) ?? 0;
        }

        $pokemonArray = [$first, $second];

        $whoWon = $this->whoWon($first, $second);

        $this->matchService->saveNewMatch($first, $second, $whoWon);

        echo $this->views->render('/match.php', [
            'pokemonArray' => $pokemonArray,
            'attempt' => $attempt,
            'title' => 'Pokemon App | Match'
        ]);
    }

    private function whoWon(TrainingPokemon $first, TrainingPokemon $second): string
    {
        return $first->getStats('hp_left') > 0 ? 'first' : ($second->getStats('hp_left') > 0 ? 'second' : 'draw');
    }

    private function checkHp(TrainingPokemon $first, TrainingPokemon $second): bool
    {
        return $first->getStats('hp_left') > 0 && $second->getStats('hp_left') > 0;
    }
}
