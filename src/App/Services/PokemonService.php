<?php

declare(strict_types=1);

namespace Acme\App\Services;

use Acme\Framework\Database;
use Acme\Framework\models\pokemon\TrainingPokemon;

class PokemonService
{

    public function __construct(
        private Database $db
    ) {
    }

    public function savePokemon(TrainingPokemon &$pokemon): TrainingPokemon
    {
        $query = 'INSERT INTO pokemon_ico.training_pokemon (name) VALUES (:name)';
        $params = [
            'name' => $pokemon->getName()
        ];

        $pokemonId = (int) $this->db->insertQuery($query, $params);

        $pokemon->setId($pokemonId);

        return $pokemon;
    }
}
