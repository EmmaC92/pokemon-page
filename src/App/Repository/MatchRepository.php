<?php

declare(strict_types=1);

namespace Acme\App\Repository;

use Acme\Framework\Database;

class MatchRepository
{
    public function __construct(
        private Database $db
    ) {
    }

    public function insertMatch(array $params): void
    {
        $query =
            "INSERT INTO
                    pokemon_ico.pokemon_match (first_pokemon_id, second_pokemon_id, who_won) 
                  VALUES (:first_pokemon_id, :second_pokemon_id, :who_won)";

        $this->db->simpleQuery($query, $params);
    }
}
