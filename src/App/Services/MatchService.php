<?php

declare(strict_types=1);

namespace Acme\App\Services;

use Acme\App\Repository\MatchRepository;
use Acme\App\Services\PokemonService;
use Acme\Framework\interfaces\TraineePokemonInterface;
use Acme\Framework\Contracts\TrainingPokemonGeneratorInterface;

class MatchService
{
    public function __construct(
        private PokemonService $pokemonService,
        private MatchRepository $matchRepository,
        private TrainingPokemonGeneratorInterface $trainingPokemonGenerator,
    ) {
    }

    public function createTrainingPokemonsForMatch(): array
    {
        $first = $this->trainingPokemonGenerator->getTrainingPokemon();
        $second = $this->trainingPokemonGenerator->getTrainingPokemon();

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

    private function saveNewMatch(TraineePokemonInterface $first, TraineePokemonInterface $second, string $who_won): void
    {
        $params = [
            'first_pokemon_id' => $first->getId(),
            'second_pokemon_id' => $second->getId(),
            'who_won' => $who_won,
        ];

        $this->matchRepository->insertMatch($params);
    }

    public function whoWon(TraineePokemonInterface $first, TraineePokemonInterface $second): string
    {
        return $first->getStats('hp_left') > 0 ? 'first' : ($second->getStats('hp_left') > 0 ? 'second' : 'draw');
    }

    private function checkHp(TraineePokemonInterface $first, TraineePokemonInterface $second): bool
    {
        return $first->getStats('hp_left') > 0 && $second->getStats('hp_left') > 0;
    }
}
