<?php

declare(strict_types=1);

namespace Acme\App\Services;

use Acme\App\Repository\MatchRepository;
use Acme\App\Services\PokemonService;
use Acme\Framework\utils\Randomizer;
use Acme\Framework\models\pokemon\TrainingPokemon;

class MatchService
{
    public function __construct(
        private MatchRepository $matchRepository,
        private Randomizer $randomizer,
        private PokemonService $pokemonService,
    ) {
    }

    public function createTrainingPokemonsForMatch()
    {
        $first = $this->randomizer->getTrainingPokemon();
        $second = $this->randomizer->getTrainingPokemon();

        $this->pokemonService->savePokemon($first);
        $this->pokemonService->savePokemon($second);

        return [
            $first,
            $second
        ];
    }

    public function startMatch(array $pokemons): array
    {
        [$first, $second] = $pokemons;
        $attempt = [];

        while ($this->checkHp($first, $second)) {
            $attempt[] = $first->attack($second) ?? 0;
            $attempt[] = $second->attack($first) ?? 0;
        }

        $whoWon = $this->whoWon($first, $second);

        $this->saveNewMatch($first, $second, $whoWon);

        return $attempt;
    }

    private function saveNewMatch(TrainingPokemon $first, TrainingPokemon $second, string $who_won): void
    {
        $params = [
            'first_pokemon_id' => $first->getId(),
            'second_pokemon_id' => $second->getId(),
            'who_won' => $who_won,
        ];

        $this->matchRepository->insertMatch($params);
    }

    public function whoWon(TrainingPokemon $first, TrainingPokemon $second): string
    {
        return $first->getStats('hp_left') > 0 ? 'first' : ($second->getStats('hp_left') > 0 ? 'second' : 'draw');
    }

    private function checkHp(TrainingPokemon $first, TrainingPokemon $second): bool
    {
        return $first->getStats('hp_left') > 0 && $second->getStats('hp_left') > 0;
    }
}
