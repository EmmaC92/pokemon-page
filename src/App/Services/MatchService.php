<?php

declare(strict_types=1);

namespace Acme\App\Services;

use Acme\Framework\Database;
use Acme\Framework\models\pokemon\TrainingPokemon;

class MatchService
{
    public function __construct(
        private Database $db
    ) {
    }

    public function saveNewMatch(TrainingPokemon $first, TrainingPokemon $second, string $who_won): void
    {
        $query =
            "INSERT INTO 
                    pokemon_ico.pokemon_match (first_pokemon_id, second_pokemon_id, who_won) 
                  VALUES (:first_pokemon_id, :second_pokemon_id, :who_won)";

        $params = [
            'first_pokemon_id' => $first->getId(),
            'second_pokemon_id' => $second->getId(),
            'who_won' => $who_won,
        ];

        $this->db->simpleQuery($query, $params);
    }
}
