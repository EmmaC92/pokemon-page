<?php

namespace Acme\App\Controllers;

use Acme\Framework\TemplateEngine;
use Acme\Framework\utils\Randomizer;
use Acme\App\Config\Paths;
use Acme\Framework\models\pokemon\TrainingPokemon;

class MatchController
{
    public function __construct(
        private Randomizer $randomizer,
        private TemplateEngine $views
    ) {
    }

    public function match(): void
    {
        $first = $this->randomizer->getTrainingPokemon();
        $second = $this->randomizer->getTrainingPokemon();
        $attempt = [];

        while ($this->checkHp($first, $second)) {
            $attempt[] = $first->attack($second) ?? 0;
            $attempt[] = $second->attack($first) ?? 0;
        }

        $pokemonArray = [$first, $second];

        echo $this->views->render('/match.php', [
            'pokemonArray' => $pokemonArray,
            'attempt' => $attempt,
            'title' => 'Pokemon App | Match'
        ]);
    }

    private function checkHp(TrainingPokemon $first, TrainingPokemon $second): bool
    {
        return $first->getStats('hp_left') > 0 && $second->getStats('hp_left') > 0;
    }
}
