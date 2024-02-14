<?php

namespace Acme\Framework\interfaces;

use Acme\Framework\models\pokemon\TrainingPokemon;

Interface TraineePokemonInterface
{
    public function attack(TrainingPokemon $opponent);

    public function defense(int $opponentAttack, int $opponentSpeed);

    public function getStats(string $name = null): array|int;

    public function getId(): int;
}