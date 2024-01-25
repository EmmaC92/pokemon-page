<?php

declare(strict_types=1);

namespace Acme\Framework\models\pokemon;

use Acme\Framework\interfaces\TraineePokemonInterface;
use Acme\Framework\models\pokemon\NormalPokemon;

class TrainingPokemon extends NormalPokemon implements TraineePokemonInterface
{
    public function __construct(
        string $name,
        string $image,
        int $pokedexIndex,
        array $stats,
        array $types,
        array $attacks,
        ?int $id = null,
    ) {
        parent::__construct(
            id: $id,
            name: $name,
            image: $image,
            pokedexIndex: $pokedexIndex,
            stats: $stats,
            types: $types,
            attacks: $attacks
        );

        $this->stats['hp_left'] = $this->stats['hp'];
    }

    public function attack(TrainingPokemon $opponent): array
    {
        $attack = $this->stats['attack'];
        $speed = $this->stats['speed'];
        $totalAttack =  $opponent->defense($attack, $speed);
        return [
            'pokemon' => $this->getName(),
            'attack' => $this->getAttacks(true),
            'value' => $totalAttack
        ];
    }

    public function defense(int $opponentAttack, int $opponentSpeed): int
    {
        $totalAttack = 0;

        if ($this->runOrMissDefense($opponentSpeed)) {
            $totalAttack = $opponentAttack;
        } else {
            $totalAttack = ($opponentAttack >= $this->stats['defense'] ? $opponentAttack - $this->stats['defense'] : 0);
        }

        $this->stats['hp_left']-=$totalAttack;
        return $totalAttack;
    }

    public function runOrMissDefense(int $opponentSpeed): bool
    {
        $speed = $this->stats['speed'];
        return $speed > $opponentSpeed || rand(0, 1);
    }
}
