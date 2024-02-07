<?php

declare(strict_types=1);

namespace Acme\App\Repository;

use Acme\Framework\Database;

class PokemonRepository
{
    public function __construct(
        private Database $db
    ) {
    }

    public function insertPokemon(array $params): int
    {
        $query = 'INSERT INTO pokemon_ico.training_pokemon (name) VALUES (:name)';

        $pokemonId = (int) $this->db->insertQuery($query, $params);

        return $pokemonId;
    }
}
